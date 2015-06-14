<?php

/**
 * CONTROLLER FOR Clientes
 * @copyright: ALBATRONIC 
 * @date 16.12.2014 22:23:04

 * Extiende a la clase controller
 */
class ClientesController extends Controller {

    protected $entity = "Clientes";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }
}
