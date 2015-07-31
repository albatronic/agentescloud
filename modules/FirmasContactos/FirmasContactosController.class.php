<?php

/**
 * CONTROLLER FOR FirmasContactos
 * @copyright: ALBATRONIC 
 * @date 18.06.2015 22:39:21

 * Extiende a la clase controller
 */
class FirmasContactosController extends Controller {

    protected $entity = "FirmasContactos";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
