<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 21:32:23
 */

/**
 * @orm:Entity(Familias)
 */
class Familias extends FamiliasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
