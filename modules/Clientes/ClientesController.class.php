<?php

/**
 * CONTROLLER FOR Clientes
 * @copyright: ALBATRONIC 
 * @date 14.06.2015 19:52:04

 * Extiende a la clase controller
 */
class ClientesController extends Controller {

    protected $entity = "Clientes";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction('Vigente=1');
    }

}
