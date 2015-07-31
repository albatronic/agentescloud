<?php

/**
 * CONTROLLER FOR Firmas
 * @copyright: ALBATRONIC 
 * @date 14.06.2015 19:52:10

 * Extiende a la clase controller
 */
class FirmasController extends Controller {

    protected $entity = "Firmas";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction('Vigente=1');
    }

}
