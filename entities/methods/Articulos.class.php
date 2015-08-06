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

    /**
     * Devuelve array de objetos promociones del artículo en curso
     * 
     * @param boolean $soloVigentes Por defecto solo las vigentes
     * @return \Promociones Array de objetos promociones
     */
    public function getPromociones($soloVigentes= true) {
        
        $array = array();
        
        $hoy = date('Y-m-d');
        $filtro = ($soloVigentes) ? "(FechaLimite>'{$hoy}')" : "(1)";
        $filtro .= " and (IdArticulo='{$this->Id}')";
        //echo $filtro;
        $promo = new Promociones();
        $rows = $promo->querySelect("Id",$filtro,"FechaLimite ASC");
        unset($promo);
        
        foreach($rows as $row) {
            $array[] = new Promociones($row['Id']);
        }
        
        return $array;
    }
    
    static public function getPromocionesFirmaFamilia($idFirma, $idFamilia, $soloVigentes = true) {
        
        $rows = array();
        
        $promo = new Promociones();
        $database = $promo->getDataBaseName();
        $table = $promo->getTableName();
        $promo->conecta();
        if (is_resource($promo->_dbLink)) {

            $query = "SELECT p.Id "
                    . "FROM {$database}.{$table} p, {$database}.AgtArticulos a "
                    . "WHERE p.IdArticulo=a.Id AND "
                    . " a.IdFirma='{$idFirma}' AND "
                    . " a.IdFamilia='{$idFamilia}'";
            //echo $query,"<br/>";
            $promo->_em->query($query);
            $rows = $promo->_em->fetchResult();
        }
        
        return $rows;
    }

}
