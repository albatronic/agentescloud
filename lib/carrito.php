<?php

/**
 * GESTION DE CARRITO DE LA COMPRA
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 08.02.2014
 */
session_start();

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

if (!file_exists('../config/config.yml')) {
    echo "NO EXISTE EL FICHERO DE CONFIGURACION";
    exit;
}

if (file_exists("../bin/yaml/lib/sfYaml.php")) {
    include "../bin/yaml/lib/sfYaml.php";
} else {
    echo "NO EXISTE LA CLASE PARA LEER ARCHIVOS YAML";
    exit;
}

// ---------------------------------------------------------------
// CARGO LOS PARAMETROS DE CONFIGURACION.
// ---------------------------------------------------------------
$config = sfYaml::load('../config/config.yml');
$app = $config['config']['app'];

// ---------------------------------------------------------------
// ACTIVAR EL AUTOLOADER DE CLASES Y FICHEROS A INCLUIR
// ---------------------------------------------------------------
define("APP_PATH", $_SERVER['DOCUMENT_ROOT'] . $app['path'] . "/");
include_once "../" . $app['framework'] . "Autoloader.class.php";
Autoloader::setCacheFilePath(APP_PATH . 'tmp/class_path_cache.txt');
Autoloader::excludeFolderNamesMatchingRegex('/^CVS|\..*$/');
Autoloader::setClassPaths(array(
    '../' . $app['framework'],
    '../entities/',
    '../lib/',
));
spl_autoload_register(array('Autoloader', 'loadClass'));

//----------------------------------------------------------------
// ACTIVAR EL MOTOR TWIG PARA LOS TEMPLATES.
//----------------------------------------------------------------
$twig = $config['config']['twig'];
$motor = "../" . $twig['motor'];
if (file_exists($motor)) {
    include_once $motor;
    Twig_Autoloader::register();

    $cache = "../". $twig['cache_folder'];
    if ($cache != '')
        $ops['cache'] = $cache;
    $debug = $twig['debug_mode'];
    if ($debug != '')
        $ops['debug'] = $debug;
    $charset = $twig['charset'];
    if ($charset != '')
        $ops['charset'] = $charset;
    $ops['autoescape'] = true;
    $loader = new Twig_Loader_Filesystem("../" . $twig['templates_folder']);
    $twig = new Twig_Environment($loader, $ops);
    $twig->getExtension('core')->setNumberFormat(2, ',', '.');
} else {
    die("NO SE PUEDE ENCONTRAR EL MOTOR TWIG");
}

$parametros = $_REQUEST['parametros'];
$accion = $parametros['accion'];
$datos = $parametros['datos'];

$errores = $alertas = array();

$articulo = json_decode($datos['Articulo']);

switch ($accion) {
    case 'add':
        $idLinea = ErpCarrito::addProduct($articulo, $datos['Unidades']);
        if (!$idLinea) {
            $errores = ErpCarrito::getErrores();
        } else {
            $alertas = ErpCarrito::getAlertas();
        }
        break;

    case 'remove':
        $ok = ErpCarrito::removeProduct($datos['Id']);
        if (!$ok) {
            $errores = ErpCarrito::getErrores();
        } else {
            $alertas = ErpCarrito::getAlertas();
        }
        break;
        
    case 'update':
        $idLinea = ErpCarrito::updateProduct($datos['Id'],$datos['Unidades']);
        if (!$idLinea) {
            $errores = ErpCarrito::getErrores();
        } else {
            $alertas = ErpCarrito::getAlertas();
        }        
        break;
}

$status = 'ok';
if (count($errores))
    $status = "error";
if (count($alertas))
    $status = "alerta";

$linea = isset($idLinea) ? ErpCarrito::getLinea($idLinea)->iterator() : array();

$twig->addGlobal('appPath', $app['path']);
$htmlMiniCarrito = $twig->render('Carrito/miniCarrito.html.twig', array('carrito' => ErpCarrito::getCarrito()));

$resultado = array(
    'status' => $status,
    'accion' => $accion,
    'linea' => $linea,
    'totales' => ErpCarrito::getTotales(),
    'errores' => $errores,
    'alertas' => $alertas,
    'htmlMinicarrito' => $htmlMiniCarrito,
);

$tag = json_encode($resultado);

echo $tag;
