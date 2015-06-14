<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:24:25
 */

/**
 * @orm:Entity(Agencias)
 */
class Agencias extends AgenciasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Agencia : '';
    }

}
