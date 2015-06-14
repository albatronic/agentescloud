<?php
/**
 * TRAMITA LO PEDIDOS DE ARNOIA
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once "../bin/albatronic/autoloader.inc.php";

$_SESSION['conections'] = $config['config']['conections'];
$_SESSION['debug'] = $config['config']['debug'];
$_SESSION['produccion'] = (strtolower($config['config']['enviroment']) == 'prod');
$_SESSION['idiomas']['actual'] = 0;
$_SESSION['usuarioPortal']['Id'] = 1;

PedidosCab::tramitarPedidosArnoia();

