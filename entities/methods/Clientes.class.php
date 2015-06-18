<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:52:04
 */

/**
 * @orm:Entity(Clientes)
 */
class Clientes extends ClientesEntity {

    public function __toString() {
        return ($this->Id) ? $this->RazonSocial : '';
    }

}
