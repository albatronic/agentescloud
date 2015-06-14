<?php
/**
* CONTROLLER FOR Funcionalidades
* @copyright: ALBATRONIC 
* @date 16.12.2014 22:23:05

* Extiende a la clase controller
*/

class FuncionalidadesController extends Controller {

	protected $entity = "Funcionalidades";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
