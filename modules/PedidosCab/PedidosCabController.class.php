<?php

/**
 * CONTROLLER FOR PedidosCab
 * @copyright: ALBATRONIC 
 * @date 22.06.2015 23:09:15

 * Extiende a la clase controller
 */
class PedidosCabController extends Controller {

    protected $entity = "PedidosCab";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

    /**
     * Hace una copia del pedido.
     * Genera otro pedido en base al actual.
     * IMPORTANTE: SE TOMAN LOS PRECIOS ACTUALES DE LOS ARTICULOS
     *
     * @return array Template y values
     */
    public function duplicarAction() {
        if ($this->values['permisos']['permisosModulo']['IN']) {

            $datos = new PedidosCab($this->request['PedidosCab']['Id']);
            $idPedidoNuevo = $datos->duplica();
            $this->values['errores'] = $datos->getErrores();
            $this->values['alertas'] = $datos->getAlertas();
            unset($datos);

            $this->values['datos'] = new PedidosCab($idPedidoNuevo);

            return array('template' => $this->entity . '/edit.html.twig', 'values' => $this->values);
        } else {
            return array('template' => '_global/forbiden.html.twig');
        }
    }

    /**
     * Envia por email el albaran en formato PDF
     * @return <type>
     */
    public function enviarAction() {

        switch ($this->request['accion']) {
            case 'Enviar':
                $para = $this->request['Para'];
                $de = $this->request['De'];
                $deNombre = $this->request['DeNombre'];
                $conCopia = $this->request['Cc'];
                $conCopiaOculta = $this->request['Cco'];
                $asunto = $this->request['Asunto'];
                $mensaje = $this->request['Mensaje'];
                $adjuntos = array($this->request['Adjunto'],);

                $envio = new Mail();
                $ok = $envio->send($para, $de, $deNombre, $conCopia, $conCopiaOculta, $asunto, $mensaje, $adjuntos);
                if ($ok) {
                    $entidad = new $this->entity($this->request['PedidosCab']['IDPedido']);
                    $entidad->auditaEmail();
                    unset($entidad);
                    $this->values['resultadoEnvio'][] = "Envío con éxito";
                } else {
                    $this->values['resultadoEnvio'] = $envio->getMensaje();
                }
                unset($envio);
                break;

            case 'CambioFormato':
                $datos = new PedidosCab($this->request['PedidosCab']['IDPedido']);
                $formatos = DocumentoPdf::getFormatos($this->entity);
                $formato = $this->request['Formato'];
                if ($formato == '')
                    $formato = 0;

                $this->values['archivo'] = $this->generaPdf($this->entity, array('0' => $datos->getIDPedido()), $formato);
                $this->values['email'] = array(
                    'Para' => $this->request['Para'],
                    'De' => $this->request['De'],
                    'DeNombre' => $this->request['DeNombre'],
                    'Cc' => $this->request['Cc'],
                    'Cco' => $this->request['Cco'],
                    'Asunto' => $this->request['Asunto'],
                    'Formatos' => $formatos,
                    'Formato' => $formato,
                    'Mensaje' => $this->request['Mensaje'],
                    'idPedido' => $datos->getIDPedido(),
                );
                break;

            case '':
                $datos = new $this->entity($this->request[$this->entity]['IDPedido']);
                $formatos = DocumentoPdf::getFormatos($this->entity);
                $formato = $this->request['Formato'];
                if ($formato == '')
                    $formato = 0;

                $this->values['archivo'] = $this->generaPdf($this->entity, array('0' => $datos->getIDPedido()), $formato);
                $this->values['email'] = array(
                    'Para' => $datos->getIDProveedor()->getEMail(),
                    'De' => $_SESSION['usuarioPortal']['email'], //$datos->getIDAgente()->getIDAgente()->getEMail(),
                    'DeNombre' => $datos->getIDAgente()->getNombre(),
                    'Cco' => $_SESSION['usuarioPortal']['email'],
                    'Asunto' => 'Pedido n. ' . $datos->getIDPedido(),
                    'Formatos' => $formatos,
                    'Formato' => $formato,
                    'Mensaje' => 'Le adjunto el pedido ' . $datos->getIDPedido() . "\n\nUn saludo.",
                    'idPedido' => $datos->getIDPedido(),
                );
                break;
        }

        return parent::enviarAction();
    }

    /**
     * Genera un array con la informacion necesaria para imprimir el documento
     * Recibe un array con los ids de pedido
     *
     * @param integer $idsDocumento Array con los ids de pedido
     * @return array Array con dos elementos: master es un objeto pedido y detail es un array de objetos lineas de pedido
     */
    protected function getDatosDocumento(array $idsDocumento) {

        $master = array();
        $detail = array();

        // Recorro el array de los albaranes a imprimir
        foreach ($idsDocumento as $key => $idDocumento) {
            // Instancio la cabecera del pedido
            $master[$key] = new PedidosCab($idDocumento);

            // LLeno el array con objetos de lineas de pedido
            $lineas = array();
            $pedidoLineas = new PedidosLineas();
            $rows = $pedidoLineas->cargaCondicion('IDLinea', "IDPedido='{$idDocumento}'", "IDLinea ASC");
            foreach ($rows as $row) {
                $lineas[] = new PedidosLineas($row['IDLinea']);
            }
            $detail[$key] = $lineas;
        }

        return array(
            'master' => $master,
            'detail' => $detail,
        );
    }

    /**
     * Carga lineas en el pedido en curso en base a un csv
     * 
     * @return type
     */
    public function ImportarAction() {

        if ($this->values['permisos']['permisosModulo']['UP']) {

            $pedido = new PedidosCab($this->request['PedidosCab']['Id']);
            
            if ($pedido->getIdEstado()->getIDTipo() == 0) {
                $file = $this->request['FILES']['pedidoCsv'];
                if ($file['error'] != 0) {
                    $this->values['errores'][] = "Error al subir el archivo";
                }
                if (($file['size'] == 0) || ( ($file['type'] !== 'text/csv') && ($file['type'] !== 'text/plain') )) {
                    $this->values['errores'][] = "El archivo está vacio o no es un csv correcto";
                }
                if (!is_uploaded_file($file['tmp_name'])) {
                    $this->values['errores'][] = "El archivo no se ha subido correctamente";
                }

                if (count($this->values['errores']) == 0) {
                    $this->values['errores'] = $this->cargarLineas($this->request['PedidosCab']['Id'], $this->request['PedidosCab']['IdFirma'], $this->request['PedidosCab']['IdCliente'], $file['tmp_name']);
                }
            } else {
                $this->values['errores'][] = "El pedido está {$pedido->getIdEstado()}, no se puede modificar";
            }
        } else {
            $this->values['errores'][] = "No tiene permisos para modificar pedidos";
        }

        $datos = new $this->entity($this->request['PedidosCab']['Id']);
        if ($datos->getStatus()) {
            $this->values['datos'] = $datos;
        } else {
            $this->values['errores'] = array("Valor no encontrado. El objeto que busca no existe. Es posible que haya sido eliminado por otro usuario.");
        }

        $template = $this->entity . '/edit.html.twig';
        return array('template' => $template, 'values' => $this->values);
    }

    private function cargarLineas($idPedido, $idFirma, $idCliente, $archivoCsv) {

        $nLinea = 0;
        $errores = array();

        $csv = new Archivo($archivoCsv);
        $csv->setColumnsDelimiter(";");

        if ($csv->open()) {
            $articulo = new Articulos();
            while ($linea = $csv->readLine()) {
                $nLinea ++;
                $codigo = trim($linea[0]);
                $unidades = trim($linea[1]);
                if ($codigo != '') {
                    $filtro = "IdFirma='{$idFirma}' and (Codigo='{$codigo}' or CodigoEAN='{$codigo}')";
                    //echo $filtro,"\n";
                    $rows = $articulo->cargaCondicion("Id,IdFamilia,Codigo,Descripcion,Pvd", $filtro);
                    $row = $rows[0];
                    if ($row['Id'] != '') {
                        $articulo = new Articulos($row['Id']);
                        $pedidoLinea = new PedidosLineas();
                        $pedidoLinea->setIdPedido($idPedido);
                        $pedidoLinea->setIdFirma($idFirma);
                        $pedidoLinea->setIdFamilia($row['IdFamilia']);
                        $pedidoLinea->setIdCliente($idCliente);
                        $pedidoLinea->setIdArticulo($row['Id']);
                        $pedidoLinea->setDescripcion($row['Descripcion']);
                        $pedidoLinea->setUnidades($unidades);
                        $pedidoLinea->setPrecio($row['Pvd']);
                        $pedidoLinea->setIva($articulo->getIdIva()->getIva());
                        $pedidoLinea->setImporte($unidades * $row['Pvd']);
                        $id = $pedidoLinea->create();
                        if (!$id) {
                            $errores[] = "Línea {$nLinea}: No se pudo crear la línea de pedido.";
                        }
                    } else {
                        $errores[] = "Línea {$nLinea}: El artículo {$codigo} no existe o no pertenece a la firma del pedido.";
                    }
                }
            }

            $csv->close();
            unset($articulo);
            unset($pedidoLinea);

            // Recalcular los totales del pedido
            if (count($errores) == 0) {
                $pedido = new PedidosCab($idPedido);
                $pedido->save();
                unset($pedido);
            }
        } else {
            $errores[] = "No se ha podido abrir el archivo cargado";
        }

        return $errores;
    }

}
