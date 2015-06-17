<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:52:10
 */

/**
 * @orm:Entity(Firmas)
 */
class FirmasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $RazonSocial;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $NombreComercial;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Cif;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Direccion;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $IDPais = '68';

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $IDProvincia = '0';

    /**
     * @var entities\Municipios
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $IDPoblacion = '0';

    /**
     * @var string
     */
    protected $CodigoPostal;

    /**
     * @var string
     */
    protected $ApdoCorreos;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Telefono;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Fax;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Movil;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $EMail;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Web;

    /**
     * @var string
     */
    protected $Gerente;

    /**
     * @var string
     */
    protected $DirectorComercial;

    /**
     * @var string
     */
    protected $EmailGerente;

    /**
     * @var string
     */
    protected $EmailPedidos;

    /**
     * @var string
     */
    protected $EmailSoporteTecnico;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $CContable = '0000000000';

    /**
     * @var string
     */
    protected $Banco;

    /**
     * @var string
     */
    protected $DireccionBanco;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Iban;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Bic;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Mandato;

    /**
     * @var date
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $FechaMandato = '0000-00-00';

    /**
     * @var integer
     */
    protected $PlazoEntrega;

    /**
     * @var entities\Agencias
     */
    protected $IdAgencia = '0';

    /**
     * @var integer
     */
    protected $SinPortes = '0.00';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtFirmas")
     */
    protected $Vigente = '1';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtFirmas';

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
        'Agencias',
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

    public function setIDPais($IDPais) {
        $this->IDPais = ($IDPais instanceof Paises) ? $IDPais->getPrimaryKeyValue() : $IDPais;
    }

    public function getIDPais() {
        if (!($this->IDPais instanceof Paises)) {
            $this->IDPais = new Paises($this->IDPais);
        }
        return $this->IDPais;
    }

    public function setIDProvincia($IDProvincia) {
        $this->IDProvincia = ($IDProvincia instanceof Provincias) ? $IDProvincia->getPrimaryKeyValue() : $IDProvincia;
    }

    public function getIDProvincia() {
        if (!($this->IDProvincia instanceof Provincias)) {
            $this->IDProvincia = new Provincias($this->IDProvincia);
        }
        return $this->IDProvincia;
    }

    public function setIDPoblacion($IDPoblacion) {
        $this->IDPoblacion = ($IDPoblacion instanceof Municipios) ? $IDPoblacion->getPrimaryKeyValue() : $IDPoblacion;
    }

    public function getIDPoblacion() {
        if (!($this->IDPoblacion instanceof Municipios)) {
            $this->IDPoblacion = new Municipios($this->IDPoblacion);
        }
        return $this->IDPoblacion;
    }

    public function setCodigoPostal($CodigoPostal) {
        $this->CodigoPostal = trim($CodigoPostal);
    }

    public function getCodigoPostal() {
        return $this->CodigoPostal;
    }

    public function setApdoCorreos($ApdoCorreos) {
        $this->ApdoCorreos = trim($ApdoCorreos);
    }

    public function getApdoCorreos() {
        return $this->ApdoCorreos;
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

    public function setGerente($Gerente) {
        $this->Gerente = trim($Gerente);
    }

    public function getGerente() {
        return $this->Gerente;
    }

    public function setDirectorComercial($DirectorComercial) {
        $this->DirectorComercial = trim($DirectorComercial);
    }

    public function getDirectorComercial() {
        return $this->DirectorComercial;
    }

    public function setEmailGerente($EmailGerente) {
        $this->EmailGerente = trim($EmailGerente);
    }

    public function getEmailGerente() {
        return $this->EmailGerente;
    }

    public function setEmailPedidos($EmailPedidos) {
        $this->EmailPedidos = trim($EmailPedidos);
    }

    public function getEmailPedidos() {
        return $this->EmailPedidos;
    }

    public function setEmailSoporteTecnico($EmailSoporteTecnico) {
        $this->EmailSoporteTecnico = trim($EmailSoporteTecnico);
    }

    public function getEmailSoporteTecnico() {
        return $this->EmailSoporteTecnico;
    }

    public function setCContable($CContable) {
        $this->CContable = trim($CContable);
    }

    public function getCContable() {
        return $this->CContable;
    }

    public function setBanco($Banco) {
        $this->Banco = trim($Banco);
    }

    public function getBanco() {
        return $this->Banco;
    }

    public function setDireccionBanco($DireccionBanco) {
        $this->DireccionBanco = trim($DireccionBanco);
    }

    public function getDireccionBanco() {
        return $this->DireccionBanco;
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

    public function setMandato($Mandato) {
        $this->Mandato = trim($Mandato);
    }

    public function getMandato() {
        return $this->Mandato;
    }

    public function setFechaMandato($FechaMandato) {
        $date = new Fecha($FechaMandato);
        $this->FechaMandato = $date->getFecha();
        unset($date);
    }

    public function getFechaMandato() {
        $date = new Fecha($this->FechaMandato);
        $ddmmaaaa = $date->getddmmaaaa();
        unset($date);
        return $ddmmaaaa;
    }

    public function setPlazoEntrega($PlazoEntrega) {
        $this->PlazoEntrega = $PlazoEntrega;
    }

    public function getPlazoEntrega() {
        return $this->PlazoEntrega;
    }

    public function setIdAgencia($IdAgencia) {
        $this->IdAgencia = ($IdAgencia instanceof Agencias) ? $IdAgencia->getPrimaryKeyValue() : $IdAgencia;
    }

    public function getIdAgencia() {
        if (!($this->IdAgencia instanceof Agencias)) {
            $this->IdAgencia = new Agencias($this->IdAgencia);
        }
        return $this->IdAgencia;
    }

    public function setSinPortes($SinPortes) {
        $this->SinPortes = $SinPortes;
    }

    public function getSinPortes() {
        return $this->SinPortes;
    }

    public function setVigente($Vigente) {
        $this->Vigente = ($Vigente instanceof ValoresSN) ? $Vigente->getPrimaryKeyValue() : $Vigente;
    }

    public function getVigente() {
        if (!($this->Vigente instanceof ValoresSN)) {
            $this->Vigente = new ValoresSN($this->Vigente);
        }
        return $this->Vigente;
    }

}

// END class AgtFirmas

