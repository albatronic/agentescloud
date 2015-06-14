<?php
/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:06
 */

/**
 * @orm:Entity(Zonashorarias)
 */
class Zonashorarias extends ZonashorariasEntity {
	public function __toString() {
		return ($this->Id)?$this->Id:'';
	}
}
