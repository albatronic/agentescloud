<?php

/**
 * CONTROLLER FOR Actividades
 * @copyright: ALBATRONIC 
 * @date 14.06.2015 19:39:36

 * Extiende a la clase controller
 */
class ActividadesController extends Controller {

    protected $entity = "Actividades";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
