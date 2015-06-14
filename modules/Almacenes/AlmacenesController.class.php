<?php
/**
* CONTROLLER FOR Almacenes
* @copyright: ALBATRONIC 
* @date 14.06.2015 22:40:18

* Extiende a la clase controller
*/

class AlmacenesController extends Controller {

	protected $entity = "Almacenes";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
