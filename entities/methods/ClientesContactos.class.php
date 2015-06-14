<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 18:44:00
 */

/**
 * @orm:Entity(ClientesContactos)
 */
class ClientesContactos extends ClientesContactosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Nombre : '';
    }

}
