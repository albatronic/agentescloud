<?php
/**
* CONTROLLER FOR Zonashorarias
* @copyright: ALBATRONIC 
* @date 16.12.2014 22:23:06

* Extiende a la clase controller
*/

class ZonashorariasController extends Controller {

	protected $entity = "Zonashorarias";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
