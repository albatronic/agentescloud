<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 23:09:15
 */

/**
 * @orm:Entity(PedidosCab)
 */
class PedidosCab extends PedidosCabEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

    /**
     * Borra un pedido y sus líneas
     * Siempre que esté en estado 0 (no facturado por completo)
     *
     * @return boolean
     */
    public function erase() {
        $this->conecta();

        if (is_resource($this->_dbLink)) {
            $query = "DELETE FROM {$this->getDataBaseName()}.{$this->getTableName()} WHERE `Id`='{$this->Id}' AND IdEstado='0'";
            if ($this->_em->query($query)) {
                //Borrar líneas de pedidos
                $lineas = new PedidosLineas();
                $lineas->queryDelete("`IdPedido`='{$this->Id}'");
                unset($lineas);
            } else {
                $this->_errores = $this->_em->getError();
            }
            $this->_em->desConecta();
        }
        unset($this->_em);

        return (count($this->_errores) == 0);
    }

    /**
     * Recalcula los importes del pedido en base a sus lineas
     * Actualiza las propiedades de totales pero no salva los datos.
     * IMPORTANTE: Para que los calculos tomen efecto hay que llamar al método save()
     */
    public function recalcula() {

        //Calcular los totales, desglosados por tipo de iva.
        $lineas = new PedidosLineas();
        $rows = $lineas->cargaCondicion("sum(Importe) as Bruto", "IdPedido='{$this->Id}'");
        $bruto = ($rows[0]['Bruto']) ? $rows[0]['Bruto'] : 0;

        //SI TIENE DESCUENTO, CALCULO EL PORCENTAJE QUE SUPONE RESPECTO AL IMPORTE BRUTO
        //PARA REPERCUTUIRLO PORCENTUALMENTE A CADA BASE
        $pordcto = 0;
        if (($this->getDescuentos() != 0) && ($bruto != 0)) {
            $pordcto = round(100 * ($this->getDescuentos() / $bruto), 2);
        }

        $rows = $lineas->cargaCondicion("Iva, sum(Importe) as Importe", "(IdPedido='{$this->Id}') group by Iva order by Iva");

        $totbases = 0;
        $totiva = 0;
        $bases[0] = $bases[1] = $bases[2] = array('b' => 0, 'i' => 0, 'ci' => 0);

        foreach ($rows as $key => $row) {
            $importe = $row['Importe'] * (1 - $pordcto / 100);
            $cuotaiva = round($importe * $row['Iva'] / 100, 2);
            $totbases += $importe;
            $totiva += $cuotaiva;

            $bases[$key] = array(
                'b' => $importe,
                'i' => $row['Iva'],
                'ci' => $cuotaiva,
            );
        }

        $totalPedido = $totbases + $totiva;

        //Calcular el peso, volumen y n. de bultos de los productos inventariables
        //$query = "select sum(articulos.Peso*pedidos_lineas.Unidades) as Peso, sum(articulos.volumen*pedidos_lineas.Unidades) as Volumen, sum(Unidades) as Bultos from articulos,pedidos_lineas where (pedidos_lineas.IdArticulo=articulos.IdArticulo) and (articulos.Inventario='1') and (pedidos_lineas.IdPedido='" . $this->getIdPedido() . "')";
        //$this->_em->query($query);
        //$rows = $this->_em->fetchResult();

        $this->setBaseImponible1($bases[0]['b']);
        $this->setIva1($bases[0]['i']);
        $this->setCuotaIva1($bases[0]['ci']);
        $this->setBaseImponible2($bases[1]['b']);
        $this->setIva2($bases[1]['i']);
        $this->setCuotaIva2($bases[1]['ci']);
        $this->setBaseImponible3($bases[2]['b']);
        $this->setIva3($bases[2]['i']);
        $this->setCuotaIva3($bases[2]['ci']);
        $this->setTotalBases($totbases);
        $this->setTotalIva($totiva);
        $this->setTotalPedido($totalPedido);
        //$this->setPeso($rows[0]['Peso']);
        //$this->setVolumen($rows[0]['Volumen']);
        //$this->setBultos($rows[0]['Bultos']);
    }

    /**
     * Hace una copia del pedido.
     * Genera otro pedido en base al actual.
     * IMPORTANTE: SE TOMAN LOS PRECIOS ACTUALES DE LOS ARTICULOS.
     *
     * @return integer El id del pedido generado
     */
    public function duplica() {

        $idOrigen = $this->Id;

        // Crear la cabecera del pedido
        $destino = $this;
        $destino->setId('');
        $destino->setIdEstado(0);
        $destino->setFecha(date('d-m-Y'));
        $destino->setFechaEntrega('00-00-0000');
        $destino->setSuPedido('');
        $destino->setReferencia('');
        $destino->setObservations('Duplicado del pedido n. ' . $idOrigen);
        $destino->setIncidencias('');
        $idDestino = $destino->create();

        // Crear las líneas de pedido
        $linea = new PedidosLineas();
        $rows = $linea->cargaCondicion("Id", "IdPedido='{$idOrigen}'", "Id ASC");
        unset($linea);
        foreach ($rows as $row) {
            $lineaDestino = new PedidosLineas($row['Id']);
            $lineaDestino->setId('');
            $lineaDestino->setIdPedido($idDestino);
            $lineaDestino->setPrimaryKeyMD5('');
            $lineaDestino->valida(); // Toma los precios vigentes (tarifa, promociones, etc)
            $lineaDestino->create();
        }
        unset($lineaDestino);

        return $idDestino;
    }

    /**
     * Guarda la informacion (update)
     */
    public function save() {
        $this->recalcula();
        parent::save();
    }

    /**
     * Devuelve array de objetos pedidos lineas de pedido en curso
     * 
     * @return \PedidosLineas Array de objetos PedidosLineas
     */
    public function getLineas() {

        $array = array();

        $lineas = new PedidosLineas();
        $rows = $lineas->cargaCondicion("Id", "IdPedido='{$this->Id}'", "Id ASC");
        unset($lineas);
        foreach ($rows as $row) {
            $array[] = new PedidosLineas($row['Id']);
        }

        return $array;
    }

    static function getCsv($idPedido) {

        $pedido = new PedidosCab($idPedido);

        $cabecera = '"Firma";"' . $pedido->getIdFirma()->getRazonSocial() . '"\n';
        $cabecera .= '"Cliente";"' . $pedido->getIdCliente()->getRazonSocial() . '"\n';
        $cabecera .= '"Dir. Entrega";"' . $pedido->getIdDirec()->getDireccion() . '"\n';
        $cabecera .= '"Fecha";"' . $pedido->getFecha() . '"\n';
        $cabecera .= '"S/Pedido";"' . $pedido->getSuPedido() . '"\n';
        $cabecera .= '"Observaciones";"' . $pedido->getObservations() . '"\n';
        $cabecera .= '"Forma de Pago";"' . $pedido->getFormaPago() . '"\n';
        $cabecera .= '"Agencia Tte.";"' . $pedido->getAgencia() . '"\n\n';

        $lineas = '"Articulo";"Descripcion";"Unidades";"Precio";"Descuento1";"Descuento2";"Descuento3";"Importe"\n';

        foreach ($pedido->getLineas() as $linea) {
            $lineas .= '"' . $linea->getIdArticulo()->getCodigo() . '";' .
                    '"' . $linea->getIdArticulo()->getDescripcion() . '";' .
                    '"' . $linea->getUnidades() . '";' .
                    '"' . $linea->getPrecio() . '";' .
                    '"' . $linea->getDescuento1() . '";' .
                    '"' . $linea->getDescuento2() . '";' .
                    '"' . $linea->getDescuento3() . '";' .
                    '"' . $linea->getImporte() . '"\n';
        }

        $csv = $lineas;

        $fileCsv = Archivo::getTemporalFileName("export", "csv");
        $archivo = new Archivo($fileCsv);
        if (!$archivo->write($csv)) {
            $fileCsv = "";
        }

        return $fileCsv;
    }

}
