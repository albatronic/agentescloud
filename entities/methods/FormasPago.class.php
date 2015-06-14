<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:46:25
 */

/**
 * @orm:Entity(FormasPago)
 */
class FormasPago extends FormasPagoEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

}
