<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 20:07:08
 */

/**
 * @orm:Entity(Rutas)
 */
class Rutas extends RutasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
