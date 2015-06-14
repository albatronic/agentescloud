<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 22:28:35
 */

/**
 * @orm:Entity(GruposCompras)
 */
class GruposCompras extends GruposComprasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
