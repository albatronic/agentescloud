<?php
/**
* CONTROLLER FOR Monedas
* @copyright: ALBATRONIC 
* @date 16.12.2014 22:23:05

* Extiende a la clase controller
*/

class MonedasController extends Controller {

	protected $entity = "Monedas";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
