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
     * Devuelve el top de clientes
     * @param int $periodo
     * @param int $nItems
     * @return array
     */
    static function getTopClientes($periodo = 3, $nItems = 10) {

        // Construir la parte del filtro que depende del periodo
        switch ($periodo) {
            case '' :
                $periodo = 0;
            case '0': // Ultimo mes
                $diferenciaDias = -30;
                $titlePeriodo = "Último mes";
                break;
            case '1': // Ultimo Trimestre
                $diferenciaDias = -90;
                $titlePeriodo = "Últime trimestre";
                break;
            case '2': // Ultimo Semestre
                $diferenciaDias = -180;
                $titlePeriodo = "Último Semestre";
                break;
            case '3': // Ultimo año
                $diferenciaDias = -365;
                $titlePeriodo = "Últimos 12 meses";
                break;
            case '4': // Todo, 20 años hacia atrás
                $diferenciaDias = -7300;
                $titlePeriodo = "Todos los datos";
                break;
        }

        $fecha = new Fecha();
        $desdeFecha = $fecha->sumaDias($diferenciaDias);
        unset($fecha);

        $cliente = new Clientes();
        $clienteTabla = $cliente->getDataBaseName() . "." . $cliente->getTableName();
        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();
        unset($pedidos);

        $em = new EntityManager($cliente->getConectionName());
        if ($em->getDbLink()) {
            $query = "SELECT t2.RazonSocial as name, SUM(t1.TotalBases) as y
                FROM {$pedidosTabla} as t1, {$clienteTabla} as t2
                WHERE t1.IdCliente=t2.Id AND t1.Fecha>='{$desdeFecha}' 
                GROUP BY t1.IdCliente
                ORDER BY SUM(t1.TotalBases) DESC LIMIT {$nItems}";
            //echo $query;
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($cliente);

        return array(
            'title' => "TOP-{$nItems} Clientes. {$titlePeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
                //'query' => $query,
        );
    }

    /**
     * Devuelve las ventas por periodos
     * 
     * @param int $periodo 0= todo, 1 = últimos 365 días
     * @return array
     */
    static function getVentas($periodo = 0) {

        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();

        switch ($periodo) {
            case "0":
                $tituloPeriodo = "Todos los años";
                $query = "select YEAR(p.Fecha) name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p "
                        . "group by YEAR(p.Fecha) "
                        . "ORDER BY YEAR(p.Fecha) ASC";
                break;
            case "1":
                $tituloPeriodo = "Últimos 12 meses";
                $fecha = new Fecha();
                $desdeFecha = $fecha->sumaDias(-365);
                unset($fecha);
                $query = "select DATE_FORMAT(p.Fecha,'%Y-%b') name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p "
                        . "where p.Fecha>'{$desdeFecha}' "
                        . "group by DATE_FORMAT(p.Fecha,'%Y-%b') "
                        . "order by DATE_FORMAT(p.Fecha,'%Y-%m') ASC";
                break;
            default:
        }

        $em = new EntityManager($pedidos->getConectionName());
        if ($em->getDbLink()) {
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($pedidos);

        return array(
            'title' => "Ventas {$tituloPeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
                //'query' => $query,
        );
    }

    /**
     * Devuelve las ventas de un cliente en un periodo
     * @param int $idCliente
     * @param int $periodo 0=Todos los años, 1=los últimos 12 meses
     */
    static function getVentasCliente($idCliente, $periodo = 0) {

        $cliente = new Clientes($idCliente);
        $razonSocial = $cliente->getRazonSocial();
        unset($cliente);

        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();

        switch ($periodo) {
            case '0':
                $tituloPeriodo = "Todos los años";
                $query = "select YEAR(p.Fecha) name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p "
                        . "where p.IdCliente='{$idCliente}' "
                        . "group by YEAR(p.Fecha) "
                        . "order by YEAR(p.Fecha) ASC";
                break;
            case '1':
                $tituloPeriodo = "Últimos 12 meses";
                $fecha = new Fecha();
                $desdeFecha = $fecha->sumaDias(-365);
                unset($fecha);
                $query = "select DATE_FORMAT(p.Fecha,'%Y-%b') name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p "
                        . "where p.IdCliente='{$idCliente}' and p.Fecha>'{$desdeFecha}' "
                        . "group by DATE_FORMAT(p.Fecha,'%Y-%b') "
                        . "order by DATE_FORMAT(p.Fecha,'%Y-%m') ASC";
                break;
            default:
        }

        $em = new EntityManager($pedidos->getConectionName());
        if ($em->getDbLink()) {
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($pedidos);

        return array(
            'title' => "Ventas del cliente {$razonSocial}. {$tituloPeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
            'query' => $query,
        );
    }

    /**
     * Devuelve las ventas de una firma en un periodo
     * @param int $idFirma
     * @param int $periodo 0=Todos los años, 1=los últimos 12 meses
     */
    static function getVentasFirma($idFirma, $periodo = 0) {

        $firma = new Firmas($idFirma);
        $razonSocial = $firma->getRazonSocial();
        unset($firma);

        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();

        switch ($periodo) {
            case '0':
                $tituloPeriodo = "Todos los años";
                $query = "select YEAR(p.Fecha) name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p "
                        . "where p.IdFirma='{$idFirma}' "
                        . "group by YEAR(p.Fecha) "
                        . "order by YEAR(p.Fecha) ASC";
                break;
            case '1':
                $tituloPeriodo = "Últimos 12 meses";
                $fecha = new Fecha();
                $desdeFecha = $fecha->sumaDias(-365);
                unset($fecha);
                $query = "select DATE_FORMAT(p.Fecha,'%Y-%b') name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p "
                        . "where p.IdFirma='{$idFirma}' and p.Fecha>'{$desdeFecha}' "
                        . "group by DATE_FORMAT(p.Fecha,'%Y-%b') "
                        . "order by DATE_FORMAT(p.Fecha,'%Y-%m') ASC";
                break;
            default:
        }

        $em = new EntityManager($pedidos->getConectionName());
        if ($em->getDbLink()) {
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($pedidos);

        return array(
            'title' => "Ventas de la firma {$razonSocial}. {$tituloPeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
            'query' => $query,
        );
    }

    /**
     * Devuelve las ventas de un cliente en el periodo por firmas
     * 
     * @param int $idCliente
     * @param int $periodo 0=todo, 1=últimos 12 meses
     * @return array
     */
    static function getVentasClienteFirmas($idCliente, $periodo = 0) {

        $cliente = new Clientes($idCliente);
        $razonSocial = $cliente->getRazonSocial();
        unset($cliente);
        
        $firma = new Firmas();
        $firmaTabla = $firma->getDataBaseName() . "." . $firma->getTableName();
        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();
        unset($pedidos);

        switch ($periodo) {
            case '0':
                $tituloPeriodo = "Todos los años";                
                $query = "select f.RazonSocial name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p, {$firmaTabla} f "
                        . "where p.IdCliente='{$idCliente}' and f.Id=p.IdFirma "
                        . "group by f.RazonSocial "
                        . "order by sum(p.TotalBases) DESC";
                break;
            case '1':
                $tituloPeriodo = "Últimos 12 meses";
                $fecha = new Fecha();
                $desdeFecha = $fecha->sumaDias(-365);
                unset($fecha);
                $query = "select f.RazonSocial name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p, {$firmaTabla} f "
                        . "where p.IdCliente='{$idCliente}' and f.Id=p.IdFirma and p.Fecha>'{$desdeFecha}' "
                        . "group by f.RazonSocial "
                        . "order by sum(p.TotalBases) DESC";                
                break;
            default:
        }


        $em = new EntityManager($firma->getConectionName());
        if ($em->getDbLink()) {
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($firma);

        return array(
            'title' => "Ventas del cliente {$razonSocial} desglosadas por firmas. {$tituloPeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
            'query' => $query,
        );
    }

    /**
     * Devuelve las ventas de una firma en el periodo por clientes
     * 
     * @param int $idFirma
     * @param int $periodo 0=todo, 1=últimos 12 meses
     * @return array
     */
    static function getVentasFirmaClientes($idFirma, $periodo = 0) {

        $firma = new Firmas($idFirma);
        $razonSocial = $firma->getRazonSocial();
        
        $cliente = new Clientes();
        $clienteTabla = $cliente->getDataBaseName() . "." . $cliente->getTableName();
        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();
        unset($pedidos);

        switch ($periodo) {
            case '0':
                $tituloPeriodo = "Todos los años";                
                $query = "select c.RazonSocial name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p, {$clienteTabla} c "
                        . "where p.IdFirma='{$idFirma}' and c.Id=p.IdCliente "
                        . "group by c.RazonSocial "
                        . "order by sum(p.TotalBases) DESC";
                break;
            case '1':
                $tituloPeriodo = "Últimos 12 meses";
                $fecha = new Fecha();
                $desdeFecha = $fecha->sumaDias(-365);
                unset($fecha);
                $query = "select c.RazonSocial name, sum(p.TotalBases) y "
                        . "from {$pedidosTabla} p, {$clienteTabla} c "
                        . "where p.IdFirma='{$idFirma}' and c.Id=p.IdCliente and p.Fecha>'{$desdeFecha}' "
                        . "group by c.RazonSocial "
                        . "order by sum(p.TotalBases) DESC";                
                break;
            default:
        }


        $em = new EntityManager($firma->getConectionName());
        if ($em->getDbLink()) {
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($firma);

        return array(
            'title' => "Ventas de la firma {$razonSocial} desglosadas por clientes. {$tituloPeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
            'query' => $query,
        );
    }

    static function getTopFirmas($periodo = 3, $nItems = 10) {

        // Construir la parte del filtro que depende del periodo
        switch ($periodo) {
            case '' :
                $periodo = 0;
            case '0': // Ultimo mes
                $diferenciaDias = -30;
                $titlePeriodo = "Último mes";
                break;
            case '1': // Ultimo Trimestre
                $diferenciaDias = -90;
                $titlePeriodo = "Últime trimestre";
                break;
            case '2': // Ultimo Semestre
                $diferenciaDias = -180;
                $titlePeriodo = "Último Semestre";
                break;
            case '3': // Ultimo año
                $diferenciaDias = -365;
                $titlePeriodo = "Últimos 12 meses";
                break;
            case '4': // Todo, 20 años hacia atrás
                $diferenciaDias = -7300;
                $titlePeriodo = "Todos los datos";
                break;
        }

        $fecha = new Fecha();
        $desdeFecha = $fecha->sumaDias($diferenciaDias);
        unset($fecha);

        $firma = new Firmas();
        $clienteTabla = $firma->getDataBaseName() . "." . $firma->getTableName();
        $pedidos = new PedidosCab();
        $pedidosTabla = $pedidos->getDataBaseName() . "." . $pedidos->getTableName();
        unset($pedidos);

        $em = new EntityManager($firma->getConectionName());
        if ($em->getDbLink()) {
            $query = "SELECT t2.RazonSocial as name, SUM(t1.TotalBases) as y
                FROM {$pedidosTabla} as t1, {$clienteTabla} as t2
                WHERE t1.IdFirma=t2.Id AND t1.Fecha>='{$desdeFecha}' 
                GROUP BY t1.IdFirma
                ORDER BY SUM(t1.TotalBases) DESC LIMIT {$nItems}";
            //echo $query;
            $em->query($query);
            $rows = $em->fetchResult();
            $em->desConecta();
        }
        unset($firma);

        return array(
            'title' => "TOP-{$nItems} Firmas. {$titlePeriodo}",
            'serieName' => "Ventas",
            'serie' => $rows,
        );
    }

}
