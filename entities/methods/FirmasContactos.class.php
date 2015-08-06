<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 22:39:21
 */

/**
 * @orm:Entity(FirmasContactos)
 */
class FirmasContactos extends FirmasContactosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Nombre : '';
    }

}
