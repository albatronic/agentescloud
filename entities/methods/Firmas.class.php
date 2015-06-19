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
