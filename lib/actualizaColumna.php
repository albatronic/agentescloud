<?php

/*
 * ACTUALIZA UNA COLUMNA DE UNA ENTIDAD
 *
 * Es llamado por AJAX
 *
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 27.05.2011
 */


include_once "../bin/albatronic/autoloader.inc.php";

$v = $_GET;

$entidad = $v['entidad'];
$idEntidad = $v['idEntidad'];
$columna = $v['columna'];

$objeto = new $entidad($idEntidad);
$objeto->{"set$columna"}($v['valor']);
$objeto->save();
unset($objeto);

$tag = "";

echo $tag;
