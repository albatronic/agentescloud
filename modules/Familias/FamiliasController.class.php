<?php

/**
 * CONTROLLER FOR Familias
 * @copyright: ALBATRONIC 
 * @date 18.06.2015 21:32:23

 * Extiende a la clase controller
 */
class FamiliasController extends Controller {

    protected $entity = "Familias";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
