<?php
/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:52:10
 */

/**
 * @orm:Entity(Firmas)
 */
class Firmas extends FirmasEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
