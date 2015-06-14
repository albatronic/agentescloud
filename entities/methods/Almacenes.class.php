<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 22:40:18
 */

/**
 * @orm:Entity(Almacenes)
 */
class Almacenes extends AlmacenesEntity {

    public function __toString() {
        return ($this->Id) ? $this->Nombre : '';
    }

}
