<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 22:40:18
 */

/**
 * @orm:Entity(Almacenes)
 */
class AlmacenesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $Nombre;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $Direccion;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $IdPais = '68';

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $IdProvincia = '0';

    /**
     * @var entities\Municipios
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $IdPoblacion = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $CodigoPostal = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $Telefono;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $Fax;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $EMail;

    /**
     * @var entities\AlmacenesTipos
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $Tipo = '0';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtAlmacenes")
     */
    protected $ControlUbicaciones = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtAlmacenes';

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
        'AlmacenesTipos',
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

    public function setDireccion($Direccion) {
        $this->Direccion = trim($Direccion);
    }

    public function getDireccion() {
        return $this->Direccion;
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

    public function setIdProvincia($IdProvincia) {
        $this->IdProvincia = ($IdProvincia instanceof Provincias) ? $IdProvincia->getPrimaryKeyValue() : $IdProvincia;
    }

    public function getIdProvincia() {
        if (!($this->IdProvincia instanceof Provincias)) {
            $this->IdProvincia = new Provincias($this->IdProvincia);
        }
        return $this->IdProvincia;
    }

    public function setIdPoblacion($IdPoblacion) {
        $this->IdPoblacion = ($IdPoblacion instanceof Municipios) ? $IdPoblacion->getPrimaryKeyValue() : $IdPoblacion;
    }

    public function getIdPoblacion() {
        if (!($this->IdPoblacion instanceof Municipios)) {
            $this->IdPoblacion = new Municipios($this->IdPoblacion);
        }
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

    public function setEMail($EMail) {
        $this->EMail = trim($EMail);
    }

    public function getEMail() {
        return $this->EMail;
    }

    public function setTipo($Tipo) {
        $this->Tipo = ($Tipo instanceof AlmacenesTipos) ? $Tipo->getPrimaryKeyValue() : $Tipo;
    }

    public function getTipo() {
        if (!($this->Tipo instanceof AlmacenesTipos)) {
            $this->Tipo = new AlmacenesTipos($this->Tipo);
        }
        return $this->Tipo;
    }

    public function setControlUbicaciones($ControlUbicaciones) {
        $this->ControlUbicaciones = ($ControlUbicaciones instanceof ValoresSN) ? $ControlUbicaciones->getPrimaryKeyValue() : $ControlUbicaciones;
    }

    public function getControlUbicaciones() {
        if (!($this->ControlUbicaciones instanceof ValoresSN)) {
            $this->ControlUbicaciones = new ValoresSN($this->ControlUbicaciones);
        }
        return $this->ControlUbicaciones;
    }

}

// END class AgtAlmacenes

