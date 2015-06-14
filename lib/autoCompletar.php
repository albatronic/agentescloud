<?php

/**
 * UTILIDADES DE AUTOCOMPLETAR.
 *
 * ESTE SCRIPT ES LLAMADO POR LAS FUNCIONES AJAX.
 * DEVUELVE UN STRING CON CODIGO HTML QUE SERÁ UTILIZADO
 * PARA REPOBLAR EL TAG HTML QUE CORRESPONDA
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @copyright Informatica ALBATRONIC
 * @since 27.05.2011
 */

// Notificar solamente errores de ejecución
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once "../bin/albatronic/autoloader.inc.php";


switch ($_GET['entidad']) {

    // BUSCA CLIENTES DE LA SUCURSAL EN CURSO POR %RAZONSOCIAL% y $NOMBRECOMERCIAL%
    case 'clientes':
        $filtro = "RazonSocial LIKE '%{$_GET['term']}%' OR Email LIKE '%{$_GET['term']}%' OR Telefono LIKE '%{$_GET['term']}%' OR Movil LIKE '%{$_GET['term']}%'";
        $cliente = new Clientes();
        $rows = $cliente->cargaCondicion("*", $filtro, "RazonSocial");
        unset($cliente);
        
        $arrayElementos = array();
        foreach ($rows as $row) {
            $row['value'] = $row['RazonSocial'];
            array_push($arrayElementos, $row);
        }

        // El array creado se devuelve en formato JSON, requerido asi
        // por el autocomplete de jQuery
        print_r(json_encode($arrayElementos));
        exit;
        break;

    // BUSCA PAISES POR %Pais%
    case 'paises':
        $pais = new Paises();
        $rows = $pais->cargaCondicion("Id, Pais as Value", "Pais LIKE '%{$_GET['term']}%'", "Pais");
        unset($pais);
        break;

    // BUSCA PROVINCIAS POR %Provincia%
    case 'provincias':
        $filtro = "Provincia LIKE '%{$_GET['term']}%'";
        if ($_GET['filtroAdicional'])
            $filtro .= " and IDPais='{$_GET['filtroAdicional']}'";

        $provincia = new Provincias();
        $rows = $provincia->cargaCondicion("Id, Provincia as Value", $filtro, "Provincia");
        unset($provincia);
        break;

    // BUSCA MUNICIPIOS POR %Municipio%
    case 'municipios':
        $filtro = "Municipio LIKE '%{$_GET['term']}%'";
        if ($_GET['filtroAdicional'])
            $filtro .= " and IdProvincia='{$_GET['filtroAdicional']}'";
        $municipio = new Municipios();
        $rows = $municipio->cargaCondicion("Id, Municipio as Value", $filtro, "Municipio");
        unset($municipio);
        break;

    // BUSCA MONEDAS POR %Moneda%
    case 'monedas':
        $filtro = "Moneda LIKE '%{$_GET['term']}%'";
        $moneda = new Monedas();
        $rows = $moneda->cargaCondicion("Id, Moneda as Value", $filtro, "Moneda");
        unset($moneda);
        break;

    // BUSCA ZONAS HORARIAS POR %zonaHoraria%
    case 'zonasHorarias':
        $filtro = "Zona LIKE '%{$_GET['term']}%'";
        $zona = new ZonasHorarias();
        $rows = $zona->cargaCondicion("Id as Id, Zona as Value", $filtro, "Zona");
        unset($zona);
        break;
}

// Creo el array de obetos que se va a devolver
// El compo value se codifica en utf8 porque se supone que van caracteres
$arrayElementos = array();
foreach ($rows as $value) {
    array_push($arrayElementos, array('id' => $value["Id"], 'value' => $value["Value"]));
}

// El array creado se devuelve en formato JSON, requerido asi
// por el autocomplete de jQuery
print_r(json_encode($arrayElementos));

