<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:06
 */

/**
 * @orm:Entity(Zonashorarias)
 */
class ZonashorariasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="Agtzonashorarias")
     */
    protected $Id;

    /**
     * @var string
     */
    protected $Zona;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtZonashorarias';

    /**
     * Nombre de la PrimaryKey
     * @var string
     */
    protected $_primaryKeyName = 'Id';

    /**
     * Array con las columnas de la primarykey
     * @var array
     */
    protected $_arrayPrimaryKeys = array('Id');

    /**
     * Relacion de entidades que dependen de esta
     * @var string
     */
    protected $_parentEntities = array(
    );

    /**
     * Relacion de entidades de las que esta depende
     * @var string
     */
    protected $_childEntities = array(
        'ValoresSN',
    );

    /**
     * GETTERS Y SETTERS
     */
    public function setId($Id) {
        $this->Id = $Id;
    }

    public function getId() {
        return $this->Id;
    }

    public function setZona($Zona) {
        $this->Zona = trim($Zona);
    }

    public function getZona() {
        return $this->Zona;
    }

}

// END class Agtzonashorarias

