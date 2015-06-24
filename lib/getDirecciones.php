<?php

/*
 * DEVUELVE LAS FAMILIAS DE UNA FIRMA EN EL FORMATO
 * INDICADO EN EL PARÁMETRO 'formato'
 *
 * Es llamado por AJAX
 *
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 19.06.2015
 */


include_once "../bin/albatronic/autoloader.inc.php";

$v = $_GET;

$formato = strtoupper($v['formato']);

$obj = new Clientes($v['idCliente']);
$rows = $obj->getDirecciones();
unset($obj);

switch ($formato) {
    case '':
    case 'JSON':
        $tag = json_encode($rows);
        break;
    default:
        $tag = "";
        break;
}

echo $tag;
