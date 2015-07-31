<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 22:39:21
 */

/**
 * @orm:Entity(ClientesContactos)
 */
class ClientesContactos extends ClientesContactosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Nombre : '';
    }

}
