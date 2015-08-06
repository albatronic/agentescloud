<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:12:31
 */

/**
 * @orm:Entity(FacturasFirmasCab)
 */
class FacturasFirmasCab extends FacturasFirmasCabEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
