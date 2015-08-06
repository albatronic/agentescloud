<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:13:11
 */

/**
 * @orm:Entity(Vencimientos)
 */
class Vencimientos extends VencimientosEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
