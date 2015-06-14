<?php

/**
 * Clase paa gestionar el DashBoard. Cuadro de mandos
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @copyright Informática ALBATRONIC, SL
 * @since 12-10-2013
 *
 */
class DashBoard {

    /**
     * Devuelve array de objetos de lineas de pedidos
     * que aún no están confirmados por la distribuidora
     * y que han sido reiterados por falta de stock
     * 
     * @param type $idSucursal
     * @return \PedidosLineas
     */
    static function getPedidosReiterados($idSucursal='') {
        
        $array = array();
        
        $idSucursal = ($idSucursal == '') ? $_SESSION['usuarioPortal']['SucursalActiva']['Id'] : $idSucursal;
        
        $lineas = new PedidosLineas();
        $rows = $lineas->cargaCondicion("Id","IdSucursal='{$idSucursal}' and IdEstado=0 and NumeroIntentos>0","IdDistribuidora ASC, CreatedAt ASC");
        unset($lineas);
        
        foreach($rows as $row) {
            $array[] = new PedidosLineas($row['Id']);
        }
        
        return $array;
    }

    static function getPedidosPendientes($idSucursal = '') {
         
        $array = array();
        
        $idSucursal = ($idSucursal == '') ? $_SESSION['usuarioPortal']['SucursalActiva']['Id'] : $idSucursal;
        
        $lineas = new PedidosLineas();
        $rows = $lineas->cargaCondicion("Id","IdSucursal='{$idSucursal}' and IdEstado=3","IdDistribuidora ASC, CreatedAt ASC");
        unset($lineas);
        
        foreach($rows as $row) {
            $array[] = new PedidosLineas($row['Id']);
        }
        
        return $array;       
    }
    

    static function getPedidosIncidenciaRecepcion($idSucursal = '') {
         
        $array = array();
        
        $idSucursal = ($idSucursal == '') ? $_SESSION['usuarioPortal']['SucursalActiva']['Id'] : $idSucursal;
        
        $lineas = new PedidosLineas();
        $rows = $lineas->cargaCondicion("Id","IdSucursal='{$idSucursal}' and IdEstado=4 or IdEstado=5 and Unidades>RecibidoTienda","IdDistribuidora ASC, CreatedAt ASC");
        unset($lineas);
        
        foreach($rows as $row) {
            $array[] = new PedidosLineas($row['Id']);
        }
        
        return $array;       
    }    
}

