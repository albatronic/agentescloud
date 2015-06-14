<?php
/**
* CONTROLLER FOR Paises
* @copyright: ALBATRONIC 
* @date 18.12.2014 00:24:08

* Extiende a la clase controller
*/

class PaisesController extends Controller {

	protected $entity = "Paises";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
