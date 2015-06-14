<?php
/**
* CONTROLLER FOR Provincias
* @copyright: ALBATRONIC 
* @date 16.12.2014 22:23:06

* Extiende a la clase controller
*/

class ProvinciasController extends Controller {

	protected $entity = "Provincias";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
