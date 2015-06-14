<?php

/**
 * @copyright ALBATRONIC
 * @date 18.12.2014 00:58:11
 */

/**
 * @orm:Entity(Municipios)
 */
class Municipios extends MunicipiosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Municipio : '';
    }

}
