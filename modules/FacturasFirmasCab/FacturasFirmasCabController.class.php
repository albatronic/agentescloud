<?php
/**
* CONTROLLER FOR FacturasFirmasCab
* @copyright: ALBATRONIC 
* @date 05.08.2015 21:12:31

* Extiende a la clase controller
*/

class FacturasFirmasCabController extends Controller {

	protected $entity = "FacturasFirmasCab";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
