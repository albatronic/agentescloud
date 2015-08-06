<?php

/**
 * @copyright ALBATRONIC
 * @date 06.08.2015 17:03:43
 */

/**
 * @orm:Entity(Promociones)
 */
class Promociones extends PromocionesEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

}
