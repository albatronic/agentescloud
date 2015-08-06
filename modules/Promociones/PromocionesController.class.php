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

}
