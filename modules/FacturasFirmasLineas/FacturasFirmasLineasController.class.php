<?php
/**
* CONTROLLER FOR FacturasFirmasLineas
* @copyright: ALBATRONIC 
* @date 05.08.2015 21:12:37

* Extiende a la clase controller
*/

class FacturasFirmasLineasController extends Controller {

	protected $entity = "FacturasFirmasLineas";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
