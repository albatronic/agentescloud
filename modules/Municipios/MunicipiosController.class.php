<?php
/**
* CONTROLLER FOR Municipios
* @copyright: ALBATRONIC 
* @date 18.12.2014 00:58:11

* Extiende a la clase controller
*/

class MunicipiosController extends Controller {

	protected $entity = "Municipios";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
