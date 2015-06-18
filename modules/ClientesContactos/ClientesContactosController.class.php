<?php

/**
 * CONTROLLER FOR ClientesContactos
 * @copyright: ALBATRONIC 
 * @date 18.06.2015 22:39:21

 * Extiende a la clase controller
 */
class ClientesContactosController extends Controller {

    protected $entity = "ClientesContactos";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
