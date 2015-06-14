<?php

/**
 * @copyright ALBATRONIC
 * @date 18.02.2015 22:50:07
 */

/**
 * @orm:Entity(Usuarios)
 */
class UsuariosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $Nombre;

    /**
     * @var string
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $Apellidos;

    /**
     * @var string
     */
    protected $DNI;

    /**
     * @var string
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
    protected $Fax;

    /**
     * @var string
     */
    protected $Movil;

    /**
     * @var string
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $EMail;

    /**
     * @var string
     */
    protected $Password;

    /**
     * @var string
     */
    protected $TokenLogin;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $NLogin = '0';

    /**
     * @var datetime
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $UltimoLogin = '0000-00-00 00:00:00';

    /**
     * @var entities\Perfiles
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $IdPerfil = '0';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtUsuarios")
     */
    protected $Activo = '1';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtUsuarios';

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
        'Perfiles',
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

    public function setNombre($Nombre) {
        $this->Nombre = trim($Nombre);
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = trim($Apellidos);
    }

    public function getApellidos() {
        return $this->Apellidos;
    }

    public function setDNI($DNI) {
        $this->DNI = trim($DNI);
    }

    public function getDNI() {
        return $this->DNI;
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

    public function setPassword($Password) {
        $this->Password = trim($Password);
    }

    public function getPassword() {
        return $this->Password;
    }

    public function setTokenLogin($TokenLogin) {
        $this->TokenLogin = trim($TokenLogin);
    }

    public function getTokenLogin() {
        return $this->TokenLogin;
    }

    public function setNLogin($NLogin) {
        $this->NLogin = $NLogin;
    }

    public function getNLogin() {
        return $this->NLogin;
    }

    public function setUltimoLogin($UltimoLogin) {
        $this->UltimoLogin = $UltimoLogin;
    }

    public function getUltimoLogin() {
        return $this->UltimoLogin;
    }

    public function setIdPerfil($IdPerfil) {
        $this->IdPerfil = ($IdPerfil instanceof Perfiles) ? $IdPerfil->getPrimaryKeyValue() : $IdPerfil;
    }

    public function getIdPerfil() {
        if (!($this->IdPerfil instanceof Perfiles)) {
            $this->IdPerfil = new Perfiles($this->IdPerfil);
        }
        return $this->IdPerfil;
    }

    public function setActivo($Activo) {
        $this->Activo = ($Activo instanceof ValoresSN) ? $Activo->getPrimaryKeyValue() : $Activo;
    }

    public function getActivo() {
        if (!($this->Activo instanceof ValoresSN)) {
            $this->Activo = new ValoresSN($this->Activo);
        }
        return $this->Activo;
    }

}

// END class AgtUsuarios

