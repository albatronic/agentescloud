<?php
/**
* CONTROLLER FOR PedidosLineas
* @copyright: ALBATRONIC 
* @date 22.06.2015 23:09:11

* Extiende a la clase controller
*/

class PedidosLineasController extends Controller {

	protected $entity = "PedidosLineas";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
