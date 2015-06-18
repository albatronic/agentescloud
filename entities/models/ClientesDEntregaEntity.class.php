<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 22:39:29
 */

/**
 * @orm:Entity(ClientesDEntrega)
 */
class ClientesDEntregaEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $Id;

    /**
     * @var entities\Clientes
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $IdCliente;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $Nombre;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $Direccion;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $IdPais = '68';

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $IdProvincia = '0';

    /**
     * @var entities\Municipios
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $IdPoblacion = '0';

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
     */
    protected $EMail;

    /**
     * @var string
     */
    protected $PersonaContacto;

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $EnviarCopiaFactura = '1';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtClientesDEntrega")
     */
    protected $FacturacionIndependiente = '0';

    /**
     * @var entities\Agencias
     */
    protected $AgenciaHabitual = '0';

    /**
     * @var string
     */
    protected $Horario;

    /**
     * @var string
     */
    protected $HorarioLlamadas;

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtClientesDEntrega")
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
    protected $_tableName = 'AgtClientesDEntrega';

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
        'Clientes',
        'Paises',
        'Provincias',
        'Municipios',
        'ValoresSN',
        'Agencias',
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

    public function setIdCliente($IdCliente) {
        $this->IdCliente = ($IdCliente instanceof Clientes) ? $IdCliente->getPrimaryKeyValue() : $IdCliente;
    }

    public function getIdCliente() {
        if (!($this->IdCliente instanceof Clientes)) {
            $this->IdCliente = new Clientes($this->IdCliente);
        }
        return $this->IdCliente;
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

    public function setPersonaContacto($PersonaContacto) {
        $this->PersonaContacto = trim($PersonaContacto);
    }

    public function getPersonaContacto() {
        return $this->PersonaContacto;
    }

    public function setEnviarCopiaFactura($EnviarCopiaFactura) {
        $this->EnviarCopiaFactura = ($EnviarCopiaFactura instanceof ValoresSN) ? $EnviarCopiaFactura->getPrimaryKeyValue() : $EnviarCopiaFactura;
    }

    public function getEnviarCopiaFactura() {
        if (!($this->EnviarCopiaFactura instanceof ValoresSN)) {
            $this->EnviarCopiaFactura = new ValoresSN($this->EnviarCopiaFactura);
        }
        return $this->EnviarCopiaFactura;
    }

    public function setFacturacionIndependiente($FacturacionIndependiente) {
        $this->FacturacionIndependiente = ($FacturacionIndependiente instanceof ValoresSN) ? $FacturacionIndependiente->getPrimaryKeyValue() : $FacturacionIndependiente;
    }

    public function getFacturacionIndependiente() {
        if (!($this->FacturacionIndependiente instanceof ValoresSN)) {
            $this->FacturacionIndependiente = new ValoresSN($this->FacturacionIndependiente);
        }
        return $this->FacturacionIndependiente;
    }

    public function setAgenciaHabitual($AgenciaHabitual) {
        $this->AgenciaHabitual = ($AgenciaHabitual instanceof Agencias) ? $AgenciaHabitual->getPrimaryKeyValue() : $AgenciaHabitual;
    }

    public function getAgenciaHabitual() {
        if (!($this->AgenciaHabitual instanceof Agencias)) {
            $this->AgenciaHabitual = new Agencias($this->AgenciaHabitual);
        }
        return $this->AgenciaHabitual;
    }

    public function setHorario($Horario) {
        $this->Horario = trim($Horario);
    }

    public function getHorario() {
        return $this->Horario;
    }

    public function setHorarioLlamadas($HorarioLlamadas) {
        $this->HorarioLlamadas = trim($HorarioLlamadas);
    }

    public function getHorarioLlamadas() {
        return $this->HorarioLlamadas;
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

// END class AgtClientesDEntrega

