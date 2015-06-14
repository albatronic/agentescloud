<?php
/**
* CONTROLLER FOR GruposCompras
* @copyright: ALBATRONIC 
* @date 14.06.2015 22:28:35

* Extiende a la clase controller
*/

class GruposComprasController extends Controller {

	protected $entity = "GruposCompras";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
