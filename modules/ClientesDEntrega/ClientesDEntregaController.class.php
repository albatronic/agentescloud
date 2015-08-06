<?php

/**
 * CONTROLLER FOR ClientesDEntrega
 * @copyright: ALBATRONIC 
 * @date 18.06.2015 22:39:29

 * Extiende a la clase controller
 */
class ClientesDEntregaController extends Controller {

    protected $entity = "ClientesDEntrega";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }
    /**
     * Genera una listado por pantalla en base al filtro.
     * Puede recibir un filtro adicional
     *
     * @param integer $idCliente
     * @return array con el template y valores a renderizar
     */
    public function listFormAction($idCliente = '') {

        if ($this->values['permisos']['permisosModulo']['CO'] && is_object($this->listado)) {

            $objeto = new $this->entity();
            $tabla = $objeto->getDataBaseName() . "." . $objeto->getTableName();
            unset($objeto);

            if ($idCliente == '') {
                $idCliente = $this->request[2];
            }
            $aditionalFilter = "(IdCliente='{$idCliente}') and ({$tabla}.Deleted='0')";

            $this->values['listado'] = $this->listado->getAll($aditionalFilter);
            // Pongo una contato vacia al principio
            $contato = new $this->entity();
            $contato->setIdCliente($idCliente);
            $datos[] = $contato;
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

        $this->values['linkBy']['id'] = 'IdCliente';

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

        $this->values['linkBy']['id'] = 'IdCliente';

        //COGER DEL REQUEST EL LINK A LA ENTIDAD PADRE
        if ($this->values['linkBy']['id'] != '') {
            $this->values['linkBy']['value'] = $this->request[$this->entity][$this->values['linkBy']['id']];
        }

        switch ($this->request['accion']) {
            case 'G': //GUARDAR DATOS
                if ($this->values['permisos']['permisosModulo']['UP']) {
                    $datos = new $this->entity($this->request[$this->entity]['Id']);
                    $datos->bind($this->request[$this->entity]);
                    if ($datos->valida(array())) {
                        $datos->save();
                        $this->values['errores'] = $datos->getErrores();
                        $this->values['alertas'] = $datos->getAlertas();

                        //Recargo el objeto para refrescar las propiedas que
                        //hayan podido ser motivo de algun calculo durante el proceso
                        //de guardado.
                        $datos = new $this->entity($this->request[$this->entity]['Id']);
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
                    $datos = new $this->entity($this->request[$this->entity]['Id']);

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
