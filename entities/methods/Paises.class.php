<?php

/**
 * @copyright ALBATRONIC
 * @date 18.12.2014 00:24:08
 */

/**
 * @orm:Entity(Paises)
 */
class Paises extends PaisesEntity {

    public function __toString() {
        return ($this->Id) ? $this->Pais : '';
    }

}
