<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:06
 */

/**
 * @orm:Entity(Provincias)
 */
class Provincias extends ProvinciasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Provincia : '';
    }

}
