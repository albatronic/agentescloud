<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:13:24
 */

/**
 * @orm:Entity(EntradasLineas)
 */
class EntradasLineas extends EntradasLineasEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
