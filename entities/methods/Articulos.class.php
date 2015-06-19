<?php

/**
 * @copyright ALBATRONIC
 * @date 19.06.2015 21:09:00
 */

/**
 * @orm:Entity(Articulos)
 */
class Articulos extends ArticulosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
