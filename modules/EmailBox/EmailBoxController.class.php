<?php

/**
 * CONTROLLER FOR EmailBox
 * @copyright: ALBATRONIC 
 * @date 16.12.2014 22:23:05

 * Extiende a la clase controller
 */
class EmailBoxController extends Controller {

    protected $entity = "EmailBox";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

}
