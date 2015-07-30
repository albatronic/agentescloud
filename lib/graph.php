<?php

/*
 * Obtiene datos en formato JSON para los gráficos
 *
 * Es llamado por AJAX
 *
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 5.07.2015
 */

include_once "../bin/albatronic/autoloader.inc.php";

$v = $_GET;

switch ($v['accion']) {
    case 'topClientes':
        $result = DashBoard::getTopClientes($v['periodo'], $v['nItems']);
        break;
    case 'topFirmas':
        $result = DashBoard::getTopFirmas($v['periodo'], $v['nItems']);
        break;
    case 'ventas':
        $result = DashBoard::getVentas($v['periodo']);
        break;
    case 'cliente':
        $result = DashBoard::getVentasCliente($v['idCliente'], $v['periodo']);
        break;
    case 'firma':
        $result = DashBoard::getVentasFirma($v['idFirma'], $v['periodo']);
        break;
    case 'clienteFirmas':
        $result = DashBoard::getVentasClienteFirmas($v['idCliente'], $v['periodo']);
        break;
    case 'firmaClientes':
        $result = DashBoard::getVentasFirmaClientes($v['idFirma'], $v['periodo']);
        break;
    default:
        $result = array();
}

$json = json_encode($result);
echo $json;
