<?php
/**
* CONTROLLER FOR PedidosCab
* @copyright: ALBATRONIC 
* @date 22.06.2015 23:09:15

* Extiende a la clase controller
*/

class PedidosCabController extends Controller {

	protected $entity = "PedidosCab";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
