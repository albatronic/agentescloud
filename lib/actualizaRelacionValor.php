<?php

/*
 * Actualiza la relación N a M entre entidades e id de entidades
 *
 * Es llamado por AJAX
 *
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 03.02.2013
 */

include_once "../bin/albatronic/autoloader.inc.php";

$v = $_GET;

$relacion = new Relaciones();
$idRelacion = $relacion->getIdRelacion($v['entidadOrigen'], $v['idOrigen'], $v['entidadDestino'], $v['idDestino']);

if (!$idRelacion) {
    $relacion = new Relaciones();
    $relacion->setEntidadOrigen($v['entidadOrigen']);
    $relacion->setIdEntidadOrigen($v['idOrigen']);
    $relacion->setEntidadDestino($v['entidadDestino']);
    $relacion->setIdEntidadDestino($v['idDestino']);
    $relacion->setObservations($v['valor']);
    $relacion->create();
} else {
    // Quitar la relación
    $relacion = new Relaciones($idRelacion);
    $relacion->setObservations($v['valor']);    
    $relacion->save();
}

$tag = $relacion->getErrores();
unset($relacion);
echo json_encode($tag);
