<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:13:19
 */

/**
 * @orm:Entity(EntradasCab)
 */
class EntradasCab extends EntradasCabEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
