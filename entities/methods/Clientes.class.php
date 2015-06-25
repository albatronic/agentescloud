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
