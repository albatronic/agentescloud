<?php

/**
 * Description of DashBoardController
 *
 * @author info@albatronic.com
 */
class DashBoardController extends Controller {

    protected $entity = "DashBoard";
    
    public function IndexAction() {

        /**
        $this->values['dashboard']['pedidosReiterados'] = DashBoard::getPedidosReiterados();
        $this->values['dashboard']['pedidosPendientes'] = DashBoard::getPedidosPendientes();
        $this->values['dashboard']['pedidosIncidenciaRecepcion'] = DashBoard::getPedidosIncidenciaRecepcion();
        $this->values['sucursal'] = new Sucursales($_SESSION['usuarioPortal']['SucursalActiva']['Id']);
        */
        return parent::IndexAction();
    }

}
