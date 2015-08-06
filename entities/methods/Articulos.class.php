<?php

/**
 * @copyright ALBATRONIC
 * @date 19.06.2015 21:09:00
 */

/**
 * @orm:Entity(Articulos)
 */
class Articulos extends ArticulosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Descripcion : '';
    }

    public function create() {

        $id = parent::create();

        if ($id > 0) {
            $this->crearTarifas();
        }

        return $id;
    }

    public function erase() {

        $idArticulo = $this->Id;

        $ok = parent::erase();
        if ($ok) {
            // Borrar las tarifas
            $tarifas = new Tarifas();
            $tarifas->queryDelete("IdArticulo='{$idArticulo}'");
            unset($tarifas);
        }

        return $ok;
    }

    /**
     * Crear 10 tarifas para el artículo en curso
     */
    private function crearTarifas() {

        for ($i = 1; $i < 11; $i++) {
            $tarifa = new Tarifas();
            $tarifa->setIdTarifa($i);
            $tarifa->setIdArticulo($this->Id);
            $tarifa->setPrecio($this->Pvd);
            $tarifa->create();
        }
    }

}
