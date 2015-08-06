<?php
/**
* CONTROLLER FOR CondicionesComerciales
* @copyright: ALBATRONIC 
* @date 05.08.2015 21:11:59

* Extiende a la clase controller
*/

class CondicionesComercialesController extends Controller {

	protected $entity = "CondicionesComerciales";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
