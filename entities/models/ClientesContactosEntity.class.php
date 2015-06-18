<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 22:39:21
 */

/**
 * @orm:Entity(ClientesContactos)
 */
class ClientesContactosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtClientesContactos")
     */
    protected $Id;

    /**
     * @var entities\Clientes
     * @assert NotBlank(groups="AgtClientesContactos")
     */
    protected $IdCliente;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientesContactos")
     */
    protected $Cargo;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientesContactos")
     */
    protected $Nombre;

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
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtClientesContactos';

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

    public function setIdCliente($IdCliente) {
        $this->IdCliente = ($IdCliente instanceof Clientes) ? $IdCliente->getPrimaryKeyValue() : $IdCliente;
    }

    public function getIdCliente() {
        if (!($this->IdCliente instanceof Clientes)) {
            $this->IdCliente = new Clientes($this->IdCliente);
        }
        return $this->IdCliente;
    }

    public function setCargo($Cargo) {
        $this->Cargo = trim($Cargo);
    }

    public function getCargo() {
        return $this->Cargo;
    }

    public function setNombre($Nombre) {
        $this->Nombre = trim($Nombre);
    }

    public function getNombre() {
        return $this->Nombre;
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

}

// END class AgtClientesContactos

