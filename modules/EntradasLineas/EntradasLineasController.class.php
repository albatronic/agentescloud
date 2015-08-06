<?php
/**
* CONTROLLER FOR EntradasLineas
* @copyright: ALBATRONIC 
* @date 05.08.2015 21:13:24

* Extiende a la clase controller
*/

class EntradasLineasController extends Controller {

	protected $entity = "EntradasLineas";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
