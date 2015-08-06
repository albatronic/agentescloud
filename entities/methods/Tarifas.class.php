<?php

/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 23:03:22
 */

/**
 * @orm:Entity(Tarifas)
 */
class Tarifas extends TarifasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

}
