<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:11:59
 */

/**
 * @orm:Entity(CondicionesComerciales)
 */
class CondicionesComerciales extends CondicionesComercialesEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
