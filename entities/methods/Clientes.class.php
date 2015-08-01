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
     * Devuelve un array con todos los registros de la entidad
     *
     * Cada elemento tiene la primarykey y el valor de $column
     *
     * Si no se indica valor para $column, se mostrará los valores
     * de la primarykey
     *
     * Su utilidad es básicamente para generar listas desplegables de valores
     *
     * El array devuelto es:
     *
     * array (
     *      '0' => array('Id' => valor primaryKey, 'Value'=> valor de la columna $column),
     *      '1' => .......
     * )
     *
     * @param string $column El nombre de columna a mostrar
     * @param boolean $default Si se añade o no el valor 'Indique Valor'
     * @return array Array de valores Id, Value
     */
    public function fetchAll($column = '', $default = true, $soloVigentes = true) {

        if ($column == '') {
            $column = $this->getPrimaryKeyName();
        }

        $filtroVigentes = ($soloVigentes) ? "(Vigente='1')" : "(1)";

        $rows = $this->querySelect($this->getPrimaryKeyName() . " as Id, {$column} as Value", "{$filtroVigentes} and (Deleted = '0')", "{$column} ASC");

        if ($default == TRUE) {
            array_unshift($rows, array('Id' => '', 'Value' => ':: Indique un Valor'));
        }

        return $rows;
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

    public function getRelacionFirmas() {

        $array = array();

        // Coger todas las firmas definidas
        $firmas = new Firmas();
        $rows = $firmas->cargaCondicion("Id,RazonSocial", "Vigente='1'", "RazonSocial ASC");
        unset($firmas);
        foreach ($rows as $row) {
            $array[$row['Id']]['Nombre'] = $row["RazonSocial"];
        }

        // Coger el código de cada firma para el cliente
        $relacion = new Relaciones();
        $rows = $relacion->cargaCondicion("IdEntidadDestino,Observations", "EntidadOrigen='Clientes' and IdEntidadOrigen='{$this->Id}' and EntidadDestino='Firmas'");
        foreach ($rows as $row) {
            if ($array[$row['IdEntidadDestino']]['Nombre']) {
                $array[$row['IdEntidadDestino']]['Codigo'] = $row['Observations'];
            }
        }

        return $array;
    }

}
