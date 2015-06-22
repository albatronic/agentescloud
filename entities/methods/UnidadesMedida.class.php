<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 22:34:01
 */

/**
 * @orm:Entity(UnidadesMedida)
 */
class UnidadesMedida extends UnidadesMedidaEntity {

    public function __toString() {
        return ($this->Id) ? $this->UnidadMedida : '';
    }

}
