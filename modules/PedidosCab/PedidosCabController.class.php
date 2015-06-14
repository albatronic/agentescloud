<?php

/**
 * CONTROLLER FOR PedidosCab
 * @copyright: ALBATRONIC 
 * @date 22.02.2015 14:40:48

 * Extiende a la clase controller
 */
class PedidosCabController extends Controller {

    protected $entity = "PedidosCab";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

    public function editAction() {

        $resultado = parent::editAction();
        if ($this->request['accion'] == 'Borrar') {
            $resultado = $this->listAction();
        }

        return $resultado;
    }

    public function listAction($aditionalFilter = '') {
        $aditionalFilter .= "(IdSucursal='{$_SESSION['usuarioPortal']['SucursalActiva']['Id']}')";
        return parent::listAction($aditionalFilter);
    }

    public function listadoAction($aditionalFilter = '') {
        $aditionalFilter .= "(IdSucursal='{$_SESSION['usuarioPortal']['SucursalActiva']['Id']}')";
        return parent::listadoAction($aditionalFilter);
    }

    public function enviaConfirmacionAction($idPedido = '') {

        if ($idPedido == '') {
            $idPedido = $this->request[2];
        }

        if ($idPedido != '') {
            PedidosCab::enviaConfimacion($idPedido);
            $this->values['mensaje'] = "Se ha enviado aviso de confirmación del pedido al cliente.";
        } else {
            $this->values['mensaje'] = "No se ha indicado el pedido.";
        }

        return array('values' => $this->values, 'template' => $this->entity . "/confirmacion.html.twig");
    }

    /**
     * Anula una línea de pedido.
     * 
     * Esto puede disparar el envío de notificación a
     * cliente por pedido completo
     * 
     * @param string $primaryKeyMD5
     * @return array
     */
    public function AnularLineaAction($primaryKeyMD5 = '') {

        if ($primaryKeyMD5 == '') {
            $primaryKeyMD5 = $this->request[2];
        }

        $linea = new PedidosLineas();
        $linea = $linea->find("PrimaryKeyMD5", $primaryKeyMD5);
        $linea->setIdEstado(9);
        $linea->save();

        // Ver si el pedido está totalmente recepcionado y si procede,
        // enviar notificación para que el cliente pase por tienda a recoger
        $pedido = $linea->getIdPedido();
        $puedePasarARecoger = ( ($pedido->estaTotalmenteRecepcionado()) && (!$pedido->getAvisoRecepcionParcial()->getIDTipo()) );
        if ($puedePasarARecoger) {
            if ($pedido->avisoRecogida()) {
                $this->values['alertas'] = "Se ha notificado al cliente que pase a recoger el pedido";
            } else {
                $this->values['errores'] = "Hubo un error al intentar notificar al cliente para que pase a recoger el pedido";
            }
        }
        
        // Coger el id del pedido y devolver el template de edición
        $this->request[2] = $linea->getIdPedido()->getPrimaryKeyMD5();

        return $this->editAction();
    }

}
