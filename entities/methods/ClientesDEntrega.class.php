<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 22:39:29
 */

/**
 * @orm:Entity(ClientesDEntrega)
 */
class ClientesDEntrega extends ClientesDEntregaEntity {

    public function __toString() {
        return ($this->Id) ? $this->Direccion : '';
    }

}
