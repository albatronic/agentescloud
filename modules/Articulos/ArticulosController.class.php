<?php

/**
 * CONTROLLER FOR Articulos
 * @copyright: ALBATRONIC 
 * @date 18.06.2015 23:33:42

 * Extiende a la clase controller
 */
class ArticulosController extends Controller {

    protected $entity = "Articulos";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction('Vigente=1');
    }

}
