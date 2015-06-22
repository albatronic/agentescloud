<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 22:30:40
 */

/**
 * @orm:Entity(ArticulosEstados)
 */
class ArticulosEstados extends ArticulosEstadosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Estado : '';
    }

}
