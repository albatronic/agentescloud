<?php

/**
 * CONTROLLER FOR Tarifas
 * @copyright: ALBATRONIC 
 * @date 05.08.2015 23:03:22

 * Extiende a la clase controller
 */
class TarifasController extends Controller {

    protected $entity = "Tarifas";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

    /**
     * Genera una listado por pantalla en base al filtro.
     * Puede recibir un filtro adicional
     *
     * @param integer $idArticulo
     * @return array con el template y valores a renderizar
     */
    public function listFormAction($idArticulo = '') {

        if ($this->values['permisos']['permisosModulo']['CO'] && is_object($this->listado)) {

            $objeto = new $this->entity();
            $tabla = $objeto->getDataBaseName() . "." . $objeto->getTableName();
            unset($objeto);

            if ($idArticulo == '') {
                $idArticulo = $this->request[2];
            }
            $aditionalFilter = "(IdArticulo='{$idArticulo}') and ({$tabla}.Deleted='0')";

            $this->values['listado'] = $this->listado->getAll($aditionalFilter);
            // Pongo una tarifa vacia al principio
            //$tarifa = new Tarifas();
            //$tarifa->setIdArticulo($idArticulo);
            //$datos[] = $tarifa;
            foreach ($this->values['listado']['data'] as $item) {
                $datos[] = $item;
            }

            $this->values['listado']['data'] = $datos;
            $template = $this->entity . '/listForm.html.twig';
        } else {
            $template = '_global/forbiden.html.twig';
        }

        return array('template' => $template, 'values' => $this->values);
    }

    /**
     * Crea un registro nuevo
     *
     * Siempre viene por POST
     * Si viene por POST crea un registro
     *
     * @return array con el template y valores a renderizar
     */
    public function newFormAction() {

        $this->values['linkBy']['id'] = 'IdArticulo';

        if ($this->values['permisos']['permisosModulo']['IN']) {
            switch ($this->request["METHOD"]) {

                case 'POST': //CREAR NUEVO REGISTRO
                    //COGER EL LINK A LA ENTIDAD PADRE
                    if ($this->values['linkBy']['id'] != '') {
                        $this->values['linkBy']['value'] = $this->request[$this->entity][$this->values['linkBy']['id']];
                    }

                    $datos = new $this->entity();
                    $datos->bind($this->request[$this->entity]);

                    if ($datos->valida(array())) {
                        $datos->create();
                        $this->values['alertas'] = $datos->getAlertas();

                        //Recargo el objeto para refrescar las propiedas que
                        //hayan podido ser objeto de algun calculo durante el proceso
                        //de guardado.
                        $datos = new $this->entity($datos->getPrimaryKeyValue());
                        $this->values['datos'] = $datos;
                    } else {
                        $this->values['datos'] = $datos;
                        $this->values['errores'] = $datos->getErrores();
                        $this->values['alertas'] = $datos->getAlertas();
                    }
                    unset($datos);
                    return $this->listFormAction($this->values['linkBy']['value']);
                    break;
            }
        } else {
            return array('template' => '_global/forbiden.html.twig');
        }
    }

    /**
     * Edita, actualiza o borrar un registro
     *
     * Viene siempre por POST
     * Actualiza o Borrar según el valor de $this->request['accion']
     *
     * @return array con el template y valores a renderizar
     */
    public function editFormAction() {

        $this->values['linkBy']['id'] = 'IdArticulo';

        //COGER DEL REQUEST EL LINK A LA ENTIDAD PADRE
        if ($this->values['linkBy']['id'] != '') {
            $this->values['linkBy']['value'] = $this->request[$this->entity][$this->values['linkBy']['id']];
        }

        switch ($this->request['accion']) {
            case 'G': //GUARDAR DATOS
                if ($this->values['permisos']['permisosModulo']['UP']) {
                    $datos = new Tarifas($this->request['Tarifas']['Id']);
                    $datos->bind($this->request[$this->entity]);
                    if ($datos->valida(array())) {
                        $datos->save();
                        $this->values['errores'] = $datos->getErrores();
                        $this->values['alertas'] = $datos->getAlertas();

                        //Recargo el objeto para refrescar las propiedas que
                        //hayan podido ser motivo de algun calculo durante el proceso
                        //de guardado.
                        $datos = new Tarifas($this->request['Tarifas']['Id']);
                    } else {
                        $this->values['errores'] = $datos->getErrores();
                        $this->values['alertas'] = $datos->getAlertas();
                    }

                    $this->values['datos'] = $datos;
                    unset($datos);
                    return $this->listFormAction($this->values['linkBy']['value']);
                } else {
                    return array('template' => '_global/forbiden.html.twig');
                }
                break;

            case 'B': //BORRAR DATOS
                if ($this->values['permisos']['permisosModulo']['DE']) {
                    $datos = new Tarifas($this->request['Tarifas']['Id']);

                    if ($datos->erase()) {
                        $datos = new $this->entity();
                        $this->values['datos'] = $datos;
                        $this->values['errores'] = array();
                    } else {
                        $this->values['datos'] = $datos;
                        $this->values['errores'] = $datos->getErrores();
                    }
                    unset($datos);
                    return $this->listFormAction($this->values['linkBy']['value']);
                } else {
                    return array('template' => '_global/forbiden.html.twig');
                }
                break;
        }
    }

}
