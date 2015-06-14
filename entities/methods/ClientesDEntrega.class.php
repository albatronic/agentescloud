<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 18:44:15
 */

/**
 * @orm:Entity(ClientesDEntrega)
 */
class ClientesDEntrega extends ClientesDEntregaEntity {

    public function __toString() {
        return ($this->Id) ? $this->Direccion : '';
    }

}
