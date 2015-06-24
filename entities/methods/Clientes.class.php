<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:52:04
 */

/**
 * @orm:Entity(Clientes)
 */
class Clientes extends ClientesEntity {

    public function __toString() {
        return ($this->Id) ? $this->RazonSocial : '';
    }

    /**
     * Devuelve array (Id,Value) con las direcciones del cliente en curso
     * 
     * @param string $columna El nombre de la columna a devolver como descripción
     * @return array
     */
    public function getDirecciones($columna = "Direccion") {

        $obj = new ClientesDEntrega();
        $rows = $obj->cargaCondicion("Id,{$columna}  Value", "IdCliente='{$this->Id}'", $columna);
        unset($obj);
        return $rows;
    }
}
