<?php

/**
 * @copyright ALBATRONIC
 * @date 20.02.2015 18:01:22
 */

/**
 * @orm:Entity(Relaciones)
 */
class RelacionesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtRelaciones")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtRelaciones")
     */
    protected $EntidadOrigen;

    /**
     * @var string
     * @assert NotBlank(groups="AgtRelaciones")
     */
    protected $IdEntidadOrigen = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtRelaciones")
     */
    protected $EntidadDestino;

    /**
     * @var string
     * @assert NotBlank(groups="AgtRelaciones")
     */
    protected $IdEntidadDestino = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = '';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtRelaciones';

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

    public function setEntidadOrigen($EntidadOrigen) {
        $this->EntidadOrigen = trim($EntidadOrigen);
    }

    public function getEntidadOrigen() {
        return $this->EntidadOrigen;
    }

    public function setIdEntidadOrigen($IdEntidadOrigen) {
        $this->IdEntidadOrigen = trim($IdEntidadOrigen);
    }

    public function getIdEntidadOrigen() {
        return $this->IdEntidadOrigen;
    }

    public function setEntidadDestino($EntidadDestino) {
        $this->EntidadDestino = trim($EntidadDestino);
    }

    public function getEntidadDestino() {
        return $this->EntidadDestino;
    }

    public function setIdEntidadDestino($IdEntidadDestino) {
        $this->IdEntidadDestino = trim($IdEntidadDestino);
    }

    public function getIdEntidadDestino() {
        return $this->IdEntidadDestino;
    }

}

// END class AgtRelaciones

