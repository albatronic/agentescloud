<?php
/**
* CONTROLLER FOR FormasPago
* @copyright: ALBATRONIC 
* @date 14.06.2015 19:46:25

* Extiende a la clase controller
*/

class FormasPagoController extends Controller {

	protected $entity = "FormasPago";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
