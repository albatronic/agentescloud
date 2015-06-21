<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:24:25
 */

/**
 * @orm:Entity(Agencias)
 */
class AgenciasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $Agencia;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $Telefono;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $Fax;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $Web;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $EMail;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtAgencias")
     */
    protected $CosteEstandar = '0.00';

    /**
     * @var string
     */
    protected $UrlTracking;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtAgencias';

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
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Firmas', 'ParentColumn' => 'IdAgencia'),        
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

    public function setAgencia($Agencia) {
        $this->Agencia = trim($Agencia);
    }

    public function getAgencia() {
        return $this->Agencia;
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

    public function setCosteEstandar($CosteEstandar) {
        $this->CosteEstandar = $CosteEstandar;
    }

    public function getCosteEstandar() {
        return $this->CosteEstandar;
    }

    public function setUrlTracking($UrlTracking) {
        $this->UrlTracking = trim($UrlTracking);
    }

    public function getUrlTracking() {
        return $this->UrlTracking;
    }

}

// END class AgtAgencias

