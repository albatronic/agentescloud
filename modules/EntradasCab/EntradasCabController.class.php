<?php
/**
* CONTROLLER FOR EntradasCab
* @copyright: ALBATRONIC 
* @date 05.08.2015 21:13:19

* Extiende a la clase controller
*/

class EntradasCabController extends Controller {

	protected $entity = "EntradasCab";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
