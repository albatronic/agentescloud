<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 23:09:15
 */

/**
 * @orm:Entity(PedidosCab)
 */
class PedidosCab extends PedidosCabEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

}
