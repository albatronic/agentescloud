<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:52:10
 */

/**
 * @orm:Entity(Firmas)
 */
class Firmas extends FirmasEntity {

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
    public function fetchAll($column = '', $default = true, $soloVigentes=true) {

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
     * Devuelve array (Id,Value) con las familias de la firma en curso
     * 
     * @param string $columna El nombre de la columna a devolver como descripción
     * @return array
     */
    public function getFamilias($columna = "Descripcion") {

        $familias = new Familias();
        $rows = $familias->cargaCondicion("Id,{$columna}  Value", "IdFirma='{$this->Id}'", "Descripcion");
        unset($familias);
        return $rows;
    }

}
