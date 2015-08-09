<?php

/**
 * CONTROLLER FOR Promociones
 * @copyright: ALBATRONIC 
 * @date 06.08.2015 17:03:43

 * Extiende a la clase controller
 */
class PromocionesController extends Controller {

    protected $entity = "Promociones";
    protected $parentEntity = "";

    public function IndexAction() {

        $firma = new Firmas();
        $firmas = $firma->fetchAll('RazonSocial', false);
        unset($firma);
        $this->values['firmas'] = $firmas;

        return parent::IndexAction();
    }

    public function listArticulosAction($idFirma = "", $idFamilia = "") {

        if ($idFirma == '') {
            $idFirma = $this->request[2];
        }

        if ($idFamilia == '') {
            $idFamilia = $this->request[3];
        }

        $this->values['idFirma'] = $idFirma;
        $this->values['idFamilia'] = $idFamilia;
        $this->values['promociones'] = array();
        $this->values['promociones'][] = new Promociones();
        
        $promos = Articulos::getPromocionesFirmaFamilia($idFirma, $idFamilia, false);
        foreach ($promos as $promo) {
            $this->values['promociones'][] = new Promociones($promo['Id']);
        }

        return array('template' => $this->entity . "/listArticulos.html.twig", 'values' => $this->values);        
    }

    /**
     * Crea un registro nuevo
     *
     * Siempre viene por POST
     * Si viene por POST crea un registro
     *
     * @return array con el template y valores a renderizar
     */
    public function newArticulosAction() {

        $this->values['linkBy']['id'] = '';

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
                    return $this->listArticulosAction($this->request['idFirma'], $this->request['idFamilia']);
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
    public function editArticulosAction() {

        $this->values['linkBy']['id'] = '';

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
                    return $this->listArticulosAction($this->request['idFirma'], $this->request['idFamilia']);
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
                    return $this->listArticulosAction($this->request['idFirma'], $this->request['idFamilia']);
                } else {
                    return array('template' => '_global/forbiden.html.twig');
                }
                break;
        }
    }

    public function listClientesAction($idPromocion = "") {

        if ($idPromocion == '') {
            $idPromocion = $this->request[2];
        }
print_r($this->request);
        $this->values['idPromocion'] = $idPromocion;
        $this->values['clientes'] = array();
        $cliente = new Relaciones();
        $cliente->setEntidadOrigen('Promociones');
        $cliente->setIdEntidadOrigen($idPromocion);
        $cliente->setEntidadDestino('Clientes');
        $this->values['clientes'][] = $cliente;
        
        $relacion = new Relaciones();
        $rows = $relacion->cargaCondicion("Id","EntidadOrigen='Promociones' AND IdEntidadOrigen='{$idPromocion}' and EntidadDestino='Clientes'");
        foreach ($rows as $row) {
            $this->values['clientes'][] = new Relaciones($row['Id']);
        }

        return array('template' => $this->entity . "/listClientes.html.twig", 'values' => $this->values);        
    }

    /**
     * Crea un registro nuevo
     *
     * Siempre viene por POST
     * Si viene por POST crea un registro
     *
     * @return array con el template y valores a renderizar
     */
    public function newClientesAction() {

        $this->values['linkBy']['id'] = 'IdPromocion';

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
                    return $this->listClientesAction($this->request['idFirma'], $this->request['idFamilia']);
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
    public function editClientesAction() {

        $this->values['linkBy']['id'] = 'IdPromocion';

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
                    return $this->listClientesAction($this->request['idFirma'], $this->request['idFamilia']);
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
                    return $this->listClientesAction($this->request['idFirma'], $this->request['idFamilia']);
                } else {
                    return array('template' => '_global/forbiden.html.twig');
                }
                break;
        }
    }
}
