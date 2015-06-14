<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Notificar solamente errores de ejecución
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (file_exists("../yaml/lib/sfYaml.php")) {
    include "../yaml/lib/sfYaml.php";
} else {
    die("NO EXISTE LA CLASE PARA LEER ARCHIVOS YAML\n");
}

// ---------------------------------------------------------------
// ACTIVAR EL AUTOLOADER DE CLASES Y FICHEROS A INCLUIR
// ---------------------------------------------------------------
include_once "Autoloader.class.php";
$path = str_replace("/bin/albatronic", "", __DIR__);
$path = str_replace("\\bin\\albatronic", "", $path); // Para el caso de msdos
Autoloader::setCacheFilePath($path . '/tmp/class_path_cache.txt');
Autoloader::excludeFolderNamesMatchingRegex('/^CVS|\..*$/');
Autoloader::setClassPaths(array(
    __DIR__ . "/",
    $path . '/entities/methods/',
    $path . '/entities/models/',
    $path . '/entities/abstract/',
));
spl_autoload_register(array('Autoloader', 'loadClass'));

$config = sfYaml::load('../../config/config.yml');
$_SESSION['conections'] = $config['config']['conections'];
$_SESSION['debug'] = $config['config']['debug'];
$_SESSION['idiomas']['actual'] = 0;
$_SESSION['usuarioPortal']['Id'] = 1;

$prompt = "\niPhp> ";

echo "\nPhp Interpreter v1.0";
echo "\nalbatronic Package\n\n";
echo $prompt;

while ($command = trim(fgets(STDIN))) {
    eval("{$command};");
    echo $prompt;
}
