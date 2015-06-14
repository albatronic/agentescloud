<?php
/**
* CONTROLLER FOR Proveedores
* @copyright: ALBATRONIC 
* @date 16.12.2014 22:23:05

* Extiende a la clase controller
*/

class ProveedoresController extends Controller {

	protected $entity = "Proveedores";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
