<?php
/**
* CONTROLLER FOR Emailbox
* @copyright: ALBATRONIC 
* @date 16.12.2014 22:23:05

* Extiende a la clase controller
*/

class EmailboxController extends Controller {

	protected $entity = "Emailbox";
	protected $parentEntity = "";

	public function IndexAction() {
		return $this->listAction();
	}
}
