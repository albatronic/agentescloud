<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Monedas)
 */
class MonedasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="Agtmonedas")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="Agtmonedas")
     */
    protected $Codigo;

    /**
     * @var string
     * @assert NotBlank(groups="Agtmonedas")
     */
    protected $Moneda;

    /**
     * @var string
     */
    protected $Simbolo;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtMonedas';

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

    public function setCodigo($Codigo) {
        $this->Codigo = trim($Codigo);
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function setMoneda($Moneda) {
        $this->Moneda = trim($Moneda);
    }

    public function getMoneda() {
        return $this->Moneda;
    }

    public function setSimbolo($Simbolo) {
        $this->Simbolo = trim($Simbolo);
    }

    public function getSimbolo() {
        return $this->Simbolo;
    }

}

// END class Agtmonedas

