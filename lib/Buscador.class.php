<?php

/**
 * Description of Buscador
 * 
 * Realizar las busquedas de libros en todos los
 * distribuidores
 * 
 * Se apoya en los webservices implementados
 * para cada distribuidora
 *
 * @author Sergio Pérez <info@albatronic.com>
 */
class Buscador {

    static function busca($texto) {

        $distribuidoras = array(
            'Arnoia' => WSArnoia::busca($texto),
            'Azeta' => WSAzeta::busca($texto),
             //...
        );

        // Fusionar todos los array en uno, poniendo de
        // forma consecutiva los artículos con el mismo EAN
        $resultado = array();
        foreach ($distribuidoras as $key => $libros) {
            
        }
        return $distribuidoras;
    }

}
