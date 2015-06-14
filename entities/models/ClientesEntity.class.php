<?php

/**
 * @copyright ALBATRONIC
 * @date 18.02.2015 22:48:12
 */

/**
 * @orm:Entity(Clientes)
 */
class ClientesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $RazonSocial;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Nif;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Direccion;

    /**
     * @var string
     */
    protected $Pais = 'España';

    /**
     * @var string
     */
    protected $Provincia;

    /**
     * @var string
     */
    protected $Poblacion;

    /**
     * @var string
     */
    protected $CodigoPostal;

    /**
     * @var string
     */
    protected $Telefono;

    /**
     * @var string
     */
    protected $Movil;

    /**
     * @var string
     */
    protected $EMail;

    /**
     * @var entities\Sexos
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Sexo = '1';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtClientes';

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
        'Sexos',
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

    public function setRazonSocial($RazonSocial) {
        $this->RazonSocial = trim($RazonSocial);
    }

    public function getRazonSocial() {
        return $this->RazonSocial;
    }

    public function setNif($Nif) {
        $this->Nif = trim($Nif);
    }

    public function getNif() {
        return $this->Nif;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = trim($Direccion);
    }

    public function getDireccion() {
        return $this->Direccion;
    }

    public function setPais($Pais) {
        $this->Pais = trim($Pais);
    }

    public function getPais() {
        return $this->Pais;
    }

    public function setProvincia($Provincia) {
        $this->Provincia = trim($Provincia);
    }

    public function getProvincia() {
        return $this->Provincia;
    }

    public function setPoblacion($Poblacion) {
        $this->Poblacion = trim($Poblacion);
    }

    public function getPoblacion() {
        return $this->Poblacion;
    }

    public function setCodigoPostal($CodigoPostal) {
        $this->CodigoPostal = trim($CodigoPostal);
    }

    public function getCodigoPostal() {
        return $this->CodigoPostal;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = trim($Telefono);
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function setMovil($Movil) {
        $this->Movil = trim($Movil);
    }

    public function getMovil() {
        return $this->Movil;
    }

    public function setEMail($EMail) {
        $this->EMail = trim($EMail);
    }

    public function getEMail() {
        return $this->EMail;
    }

    public function setSexo($Sexo) {
        $this->Sexo = ($Sexo instanceof Sexos) ? $Sexo->getPrimaryKeyValue() : $Sexo;
    }

    public function getSexo() {
        if (!($this->Sexo instanceof Sexos)) {
            $this->Sexo = new Sexos($this->Sexo);
        }
        return $this->Sexo;
    }

}

// END class AgtClientes

