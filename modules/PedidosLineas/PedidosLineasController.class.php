<?php

/**
 * CONTROLLER FOR PedidosLineas
 * @copyright: ALBATRONIC 
 * @date 06.05.2015 13:13:18

 * Extiende a la clase controller
 */
class PedidosLineasController extends Controller {

    protected $entity = "PedidosLineas";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

    /**
     * Obtiene listado de líneas de pedidos que corresponde
     * a las tiendas a las que tiene acceso el usuario
     * @param string $aditionalFilter
     * @return array
     */
    public function listAction($aditionalFilter = '') {  
        $aditionalFilter .= "(IdSucursal='{$_SESSION['usuarioPortal']['SucursalActiva']['Id']}')";
        return parent::listAction($aditionalFilter);
    }
    /**
     * Obtiene listado de líneas de pedidos que corresponde
     * a las tiendas a las que tiene acceso el usuario
     * @param string $aditionalFilter
     * @return array
     */
    public function listadoAction($aditionalFilter = '') {
        $aditionalFilter .= "(IdSucursal='{$_SESSION['usuarioPortal']['SucursalActiva']['Id']}')";
        return parent::listAction($aditionalFilter);
    }
    /**
     * Anula una línea de pedido.
     * Solo se puede anular si la línea está recepcionada en
     * tienda. Estado = 5
     * 
     * @return array
     */
    public function AnularAction() {

        $datos = $this->request[$this->entity];
        
        if ( ($this->request['METHOD'] === 'POST') and ($datos['Id'] > 0) ) {
            $linea = new PedidosLineas($datos['Id']);
            if ($linea->getId() and $linea->getIdEstado()->getIDTipo() == 5) {
                $linea->setIdEstado(9); //Anulado
                $linea->setObservations($datos['Observations']);
                $ok = $linea->save();
            }
        }

        $this->values['datos'] = new PedidosLineas($datos['Id']);

        return array(
            'template' => $this->entity . '/edit.html.twig',
            'values' => $this->values,
        );
    }

}
