<?php

/*
 * DEVUELVE LOS ARTICULOS EN PROMOCION PARA LA FIRMA Y FAMILIA INDICADA
 * INDICADO EN EL PARÁMETRO 'formato'
 *
 * Es llamado por AJAX
 *
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 06.08.2015
 */


include_once "../bin/albatronic/autoloader.inc.php";

$v = $_GET;

$formato = strtoupper($v['formato']);

$promociones = array();
$promos = Articulos::getPromocionesFirmaFamilia($v['idFirma'],$v['idFamilia'], false);
foreach($promos as $promo) {
    $promo = new Promociones($promo['Id']);
    $promociones[] = $promo->iterator();
}

switch ($formato) {
    case '':
    case 'JSON':
        $tag = json_encode($promociones);
        break;
    default:
        $tag = "";
        break;
}

echo $tag;
