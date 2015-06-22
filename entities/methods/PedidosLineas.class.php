<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 23:09:11
 */

/**
 * @orm:Entity(PedidosLineas)
 */
class PedidosLineas extends PedidosLineasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

}
