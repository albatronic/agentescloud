<?php
/**
* CONTROLLER FOR Agencias
* @copyright: ALBATRONIC 
* @date 14.06.2015 19:24:25

* Extiende a la clase controller
*/

class AgenciasController extends Controller {

	protected $entity = "Agencias";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
