<?php

/**
 * Contadores
 * 
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright INFORMATICA ALBATRONIC SL
 * @since 15.02.2012 12:41:19
 */

/**
 * @orm:Entity(contadores)
 */
class ContadoresEntity extends EntityComunes {

    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @assert:NotBlank(groups="contadores")
     */
    protected $Id;
    /**
     * @orm:Column(type="tinyint")
     * @assert:NotBlank(groups="contadores")
     * @var entities\TiposContadores
     */
    protected $IdTipo;
    /**
     * @orm:Column(type="string")
     * @assert:NotBlank(groups="contadores")
     */
    protected $Serie;
    /**
     * @orm:Column(type="integer")
     * @assert:NotBlank(groups="contadores")
     */
    protected $Contador = '0';
    /**
     * @orm:Column(type="tinyint")
     * @assert:NotBlank(groups="contadores")
     * @var entities\ValoresSN
     */
    protected $Predefinido = '0';
    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';
    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtContadores';
    /**
     * Nombre de la PrimaryKey
     * @var string
     */
    protected $_primaryKeyName = 'Id';
    /**
     * Relacion de entidades que dependen de esta
     * @var string
     */
    protected $_parentEntities = array(
        array('SourceColumn' => 'IdTipo', 'ParentEntity' => 'Contadores', 'ParentColumn' => 'IdTipo'),
    );
    /**
     * Relacion de entidades de las que esta depende
     * @var string
     */
    protected $_childEntities = array(
        'TiposContadores',
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

    public function setIdTipo($IdTipo) {
        $this->IdTipo = $IdTipo;
    }

    public function getIdTipo() {
        if (!($this->IdTipo instanceof TiposContadores))
            $this->IdTipo = new TiposContadores($this->IdTipo);
        return $this->IdTipo;
    }

    public function setSerie($Serie) {
        $this->Serie = trim($Serie);
    }

    public function getSerie() {
        return $this->Serie;
    }

    public function setContador($Contador) {
        $this->Contador = $Contador;
    }

    public function getContador() {
        return $this->Contador;
    }

    public function setPredefinido($Predefinido) {
        $this->Predefinido = $Predefinido;
    }

    public function getPredefinido() {
        if (!($this->Predefinido instanceof ValoresSN))
            $this->Predefinido = new ValoresSN($this->Predefinido);
        return $this->Predefinido;
    }

}