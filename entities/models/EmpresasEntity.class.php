<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 17:04:25
 */

/**
 * @orm:Entity(Empresas)
 */
class EmpresasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $RazonSocial;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Cif;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Direccion;

    /**
     * @var entities\Municipios
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $IdMunicipio = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $CodigoPostal = '0';

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $IdProvincia = '18';

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $IdPais = '68';

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Telefono;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Fax;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Web;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $EMail;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Iban;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $Bic;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $SufijoRemesas = '000';

    /**
     * @var integer
     */
    protected $DigitosCuentaContable = '10';

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $RegistroMercantil;

    /**
     * @var string
     * @assert NotBlank(groups="AgtEmpresas")
     */
    protected $LicenciaActividad;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtEmpresas';

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
        'Municipios',
        'Provincias',
        'Paises',
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

    public function setIdMunicipio($IdMunicipio) {
        $this->IdMunicipio = ($IdMunicipio instanceof Municipios) ? $IdMunicipio->getPrimaryKeyValue() : $IdMunicipio;
    }

    public function getIdMunicipio() {
        if (!($this->IdMunicipio instanceof Municipios)) {
            $this->IdMunicipio = new Municipios($this->IdMunicipio);
        }
        return $this->IdMunicipio;
    }

    public function setCodigoPostal($CodigoPostal) {
        $this->CodigoPostal = trim($CodigoPostal);
    }

    public function getCodigoPostal() {
        return $this->CodigoPostal;
    }

    public function setIdProvincia($IdProvincia) {
        $this->IdProvincia = ($IdProvincia instanceof Provincias) ? $IdProvincia->getPrimaryKeyValue() : $IdProvincia;
    }

    public function getIdProvincia() {
        if (!($this->IdProvincia instanceof Provincias)) {
            $this->IdProvincia = new Provincias($this->IdProvincia);
        }
        return $this->IdProvincia;
    }

    public function setIdPais($IdPais) {
        $this->IdPais = ($IdPais instanceof Paises) ? $IdPais->getPrimaryKeyValue() : $IdPais;
    }

    public function getIdPais() {
        if (!($this->IdPais instanceof Paises)) {
            $this->IdPais = new Paises($this->IdPais);
        }
        return $this->IdPais;
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

    public function setWeb($Web) {
        $this->Web = trim($Web);
    }

    public function getWeb() {
        return $this->Web;
    }

    public function setEMail($EMail) {
        $this->EMail = trim($EMail);
    }

    public function getEMail() {
        return $this->EMail;
    }

    public function setIban($Iban) {
        $this->Iban = trim($Iban);
    }

    public function getIban() {
        return $this->Iban;
    }

    public function setBic($Bic) {
        $this->Bic = trim($Bic);
    }

    public function getBic() {
        return $this->Bic;
    }

    public function setSufijoRemesas($SufijoRemesas) {
        $this->SufijoRemesas = trim($SufijoRemesas);
    }

    public function getSufijoRemesas() {
        return $this->SufijoRemesas;
    }

    public function setDigitosCuentaContable($DigitosCuentaContable) {
        $this->DigitosCuentaContable = $DigitosCuentaContable;
    }

    public function getDigitosCuentaContable() {
        return $this->DigitosCuentaContable;
    }

    public function setRegistroMercantil($RegistroMercantil) {
        $this->RegistroMercantil = trim($RegistroMercantil);
    }

    public function getRegistroMercantil() {
        return $this->RegistroMercantil;
    }

    public function setLicenciaActividad($LicenciaActividad) {
        $this->LicenciaActividad = trim($LicenciaActividad);
    }

    public function getLicenciaActividad() {
        return $this->LicenciaActividad;
    }

}

// END class AgtEmpresas

