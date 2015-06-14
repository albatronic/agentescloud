<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Proveedores)
 */
class ProveedoresEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $RazonSocial;

    /**
     * @var string
     */
    protected $NombreComercial;

    /**
     * @var string
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $Cif;

    /**
     * @var string
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $Direccion;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $IdPais = '68';

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $IdProvincia = '0';

    /**
     * @var entities\Municipios
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $IdPoblacion = '0';

    /**
     * @var string
     * @assert NotBlank(groups="Agtproveedores")
     */
    protected $CodigoPostal = '00000';

    /**
     * @var string
     */
    protected $Telefono;

    /**
     * @var string
     */
    protected $Fax;

    /**
     * @var string
     */
    protected $Movil;

    /**
     * @var string
     */
    protected $EMail;

    /**
     * @var string
     */
    protected $Web;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtProveedores';

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
        'Paises',
        'Provincias',
        'Municipios',
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

    public function setNombreComercial($NombreComercial) {
        $this->NombreComercial = trim($NombreComercial);
    }

    public function getNombreComercial() {
        return $this->NombreComercial;
    }

    public function setCif($Cif) {
        $this->Cif = trim($Cif);
    }

    public function getCif() {
        return $this->Cif;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = trim($Direccion);
    }

    public function getDireccion() {
        return $this->Direccion;
    }

    public function setIdPais($IdPais) {
        $this->IdPais = $IdPais;
    }

    public function getIdPais() {
        if (!($this->IdPais instanceof Paises))
            $this->IdPais = new Paises($this->IdPais);
        return $this->IdPais;
    }

    public function setIdProvincia($IdProvincia) {
        $this->IdProvincia = $IdProvincia;
    }

    public function getIdProvincia() {
        if (!($this->IdProvincia instanceof Provincias))
            $this->IdProvincia = new Provincias($this->IdProvincia);
        return $this->IdProvincia;
    }

    public function setIdPoblacion($IdPoblacion) {
        $this->IdPoblacion = $IdPoblacion;
    }

    public function getIdPoblacion() {
        if (!($this->IdPoblacion instanceof Municipios))
            $this->IdPoblacion = new Municipios($this->IdPoblacion);
        return $this->IdPoblacion;
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

    public function setFax($Fax) {
        $this->Fax = trim($Fax);
    }

    public function getFax() {
        return $this->Fax;
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

    public function setWeb($Web) {
        $this->Web = trim($Web);
    }

    public function getWeb() {
        return $this->Web;
    }

}

// END class Agtproveedores

