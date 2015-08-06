<?php
/**
* CONTROLLER FOR Vencimientos
* @copyright: ALBATRONIC 
* @date 05.08.2015 21:13:11

* Extiende a la clase controller
*/

class VencimientosController extends Controller {

	protected $entity = "Vencimientos";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
