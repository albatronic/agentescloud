<?php

/**
 * CONTROLLER FOR Modulos
 * @copyright: ALBATRONIC 
 * @date 17.12.2014 12:02:28

 * Extiende a la clase controller
 */
class ModulosController extends Controller {

    protected $entity = "Modulos";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
