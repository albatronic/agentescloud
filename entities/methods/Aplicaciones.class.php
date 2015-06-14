<?php

/**
 * @copyright ALBATRONIC
 * @date 17.12.2014 12:00:58
 */

/**
 * @orm:Entity(Aplicaciones)
 */
class Aplicaciones extends AplicacionesEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

    public function fetchAll($column = '', $default = true) {

        if ($column == '') {
            $column = $this->NombreApp;
        }

        $rows = $this->querySelect("CodigoApp as Id, {$column} as Value", "(Deleted = '0')", "{$column} ASC");

        if ($default == TRUE) {
            array_unshift($rows, array('Id' => '', 'Value' => ':: Indique un Valor'));
        }

        return $rows;
    }

}
