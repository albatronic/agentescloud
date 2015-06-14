<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 17:04:25
 */

/**
 * @orm:Entity(Empresas)
 */
class Empresas extends EmpresasEntity {

    public function __toString() {
        return ($this->Id) ? $this->RazonSocial : '';
    }

}
