<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Monedas)
 */
class Monedas extends MonedasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Moneda : '';
    }

}
