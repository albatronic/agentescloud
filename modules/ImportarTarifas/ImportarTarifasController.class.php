<?php

/**
 * Description of ImportarTarifasController
 *
 * @author sergio
 */
class ImportarTarifasController extends Controller {

    protected $entity = "ImportarTarifas";

    public function IndexAction() {

        $this->values['firma'] = new Firmas();
        return parent::IndexAction();
    }

    public function ImportarAction() {

        $idFirma = $this->request['IdFirma'];
        $idFamilia = $this->request['IdFamilia'];

        $file = $this->request['FILES']['archivo'];
        if ($file['error'] != 0) {
            $this->values['errores'][] = "Error al subir el archivo";
        }
        if (($file['size'] == 0) || ( ($file['type'] !== 'text/csv') && ($file['type'] !== 'text/plain') )) {
            $this->values['errores'][] = "El archivo está vacio o no es un csv correcto";
        }
        if (!is_uploaded_file($file['tmp_name'])) {
            $this->values['errores'][] = "El archivo no se ha subido correctamente";
        }

        if (count($this->values['errores']) == 0) {
            $resultado = $this->cargarLineas($idFirma, $idFamilia, $file['tmp_name']);
            $this->values['errores'] = $resultado['errores'];
            $this->values['items'] = $resultado['items'];
            $this->values['titulos'] = $resultado['titulos'];
        }

        $this->values['IdFirma'] = $idFirma;
        $this->values['IdFamilia'] = $idFamilia;

        return $this->IndexAction();
    }

    private function cargarLineas($idFirma, $idFamilia, $archivoCsv) {

        $nLinea = 0;
        $errores = array();
        $items = array();

        $articulo = new Articulos();

        $csv = new Archivo($archivoCsv);
        $csv->setColumnsDelimiter(";");

        if ($csv->open()) {
            $columnas = $csv->readline(); //print_r($columnas);
            while ($linea = $csv->readLine()) {
                $nLinea ++; //print_r($linea);
                foreach ($linea as $key => $value) {
                    $items[$nLinea][$columnas[$key]] = $value;
                }
            }
            $csv->close();
        } else {
            $errores[] = "No se ha podido abrir el archivo cargado";
        }
        //print_r($items);
        unset($articulo);

        return array('titulos' => $columnas, 'items' => $items, 'errores' => $errores);
    }

}
