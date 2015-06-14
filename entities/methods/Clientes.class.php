<?php

/**
 * @copyright ALBATRONIC
 * @date 21.12.2014 21:14:57
 */

/**
 * @orm:Entity(Clientes)
 */
class Clientes extends ClientesEntity {

    public function __toString() {
        return ($this->Id) ? $this->RazonSocial : '';
    }

}
