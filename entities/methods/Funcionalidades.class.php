<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Funcionalidades)
 */
class Funcionalidades extends FuncionalidadesEntity {

    public function __toString() {
        return $this->getId();
    }

    /**
     * Devuelve un array(Id,Value) con las funcionalidades posibles
     * @return array Array con las funcionalidades
     */
    public function getArrayFuncionalidades() {
        return $this->cargaCondicion("Codigo as Id, Titulo as Value", "1", "Id ASC");
    }

    /**
     * Devueve un string separado por comas con las funcionalidades
     * @return string Las funcionalidades
     */
    public function getStringFuncionalidades() {
        $array = $this->getArrayFuncionalidades();

        foreach ($array as $funcionalidad) {
            $string .= $funcionalidad['Id'] . ",";
        }

        $string = substr($string, 0, -1);

        return $string;
    }

}
