<?php

/**
 * @copyright ALBATRONIC
 * @date 18.12.2014 00:58:11
 */

/**
 * @orm:Entity(Municipios)
 */
class MunicipiosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtMunicipios")
     */
    protected $Id;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="AgtMunicipios")
     */
    protected $IdPais;

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="AgtMunicipios")
     */
    protected $IdProvincia;

    /**
     * @var string
     * @assert NotBlank(groups="AgtMunicipios")
     */
    protected $Codigo;

    /**
     * @var string
     * @assert NotBlank(groups="AgtMunicipios")
     */
    protected $DigitoControl;

    /**
     * @var string
     * @assert NotBlank(groups="AgtMunicipios")
     */
    protected $Municipio;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtMunicipios';

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
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Clientes', 'ParentColumn' => 'IdPoblacion'),         
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Firmas', 'ParentColumn' => 'IdPoblacion'),         
    );

    /**
     * Relacion de entidades de las que esta depende
     * @var string
     */
    protected $_childEntities = array(
        'Paises',
        'Provincias',
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

    public function setCodigo($Codigo) {
        $this->Codigo = trim($Codigo);
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function setDigitoControl($DigitoControl) {
        $this->DigitoControl = trim($DigitoControl);
    }

    public function getDigitoControl() {
        return $this->DigitoControl;
    }

    public function setMunicipio($Municipio) {
        $this->Municipio = trim($Municipio);
    }

    public function getMunicipio() {
        return $this->Municipio;
    }

}

// END class AgtMunicipios

