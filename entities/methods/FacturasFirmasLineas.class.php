<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:12:37
 */

/**
 * @orm:Entity(FacturasFirmasLineas)
 */
class FacturasFirmasLineas extends FacturasFirmasLineasEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
