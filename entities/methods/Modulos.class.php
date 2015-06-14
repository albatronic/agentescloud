<?php

/**
 * @copyright ALBATRONIC
 * @date 17.12.2014 12:02:28
 */

/**
 * @orm:Entity(Modulos)
 */
class Modulos extends ModulosEntity {

    public function __toString() {
        return ($this->Id) ? $this->CodigoApp : '';
    }

}
