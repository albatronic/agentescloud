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

    public function ImportarAction() {

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

        $articulo = new Articulos();

        $csv = new Archivo($archivoCsv);
        $csv->setColumnsDelimiter(";");

        if ($csv->open()) {
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
                        $pedidoLinea = new PedidosLineas();
                        $pedidoLinea->setIdPedido($idPedido);
                        $pedidoLinea->setIdFirma($idFirma);
                        $pedidoLinea->setIdFamilia($row['IdFamilia']);
                        $pedidoLinea->setIdCliente($idCliente);
                        $pedidoLinea->setIdArticulo($row['Id']);
                        $pedidoLinea->setDescripcion($row['Descripcion']);
                        $pedidoLinea->setUnidades($unidades);
                        $pedidoLinea->setPrecio($row['Pvd']);
                        $id = $pedidoLinea->create();
                        if (!$id) {
                            $errores[] = "Línea {$nLinea}: No se pudo crear la línea de pedido.";
                        }
                    } else {
                        $errores[] = "Línea {$nLinea}: El artículo {$codigo} no existe.";
                    }
                }
            }
            $csv->close();
        } else {
            $errores[] = "No se ha podido abrir el archivo cargado";
        }

        unset($articulo);
        unset($pedidoLinea);

        return $errores;
    }

}
