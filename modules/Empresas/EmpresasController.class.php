<?php
/**
* CONTROLLER FOR Empresas
* @copyright: ALBATRONIC 
* @date 14.06.2015 17:11:50

* Extiende a la clase controller
*/

class EmpresasController extends Controller {

	protected $entity = "Empresas";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
