<?php

/**
 * CONTROLLER FOR Aplicaciones
 * @copyright: ALBATRONIC 
 * @date 17.12.2014 12:00:58

 * Extiende a la clase controller
 */
class AplicacionesController extends Controller {

    protected $entity = "Aplicaciones";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
