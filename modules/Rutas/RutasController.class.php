<?php
/**
* CONTROLLER FOR Rutas
* @copyright: ALBATRONIC 
* @date 14.06.2015 20:07:08

* Extiende a la clase controller
*/

class RutasController extends Controller {

	protected $entity = "Rutas";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
