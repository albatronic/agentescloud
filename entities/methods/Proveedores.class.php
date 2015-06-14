<?php
/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Proveedores)
 */
class Proveedores extends ProveedoresEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
