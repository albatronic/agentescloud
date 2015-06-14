<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:39:36
 */

/**
 * @orm:Entity(Actividades)
 */
class Actividades extends ActividadesEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
