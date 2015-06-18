<?php

/**
 * CONTROLLER FOR ClientesDEntrega
 * @copyright: ALBATRONIC 
 * @date 18.06.2015 22:39:29

 * Extiende a la clase controller
 */
class ClientesDEntregaController extends Controller {

    protected $entity = "ClientesDEntrega";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
