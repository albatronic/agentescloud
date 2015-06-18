<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 23:33:42
 */

/**
 * @orm:Entity(Articulos)
 */
class Articulos extends ArticulosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
