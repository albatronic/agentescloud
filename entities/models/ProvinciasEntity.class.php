<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:06
 */

/**
 * @orm:Entity(Provincias)
 */
class ProvinciasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="Agtprovincias")
     */
    protected $Id;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="Agtprovincias")
     */
    protected $IdPais = '68';

    /**
     * @var string
     */
    protected $Codigo;

    /**
     * @var string
     * @assert NotBlank(groups="Agtprovincias")
     */
    protected $Provincia;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtProvincias';

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
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Clientes', 'ParentColumn' => 'IdProvincia'),         
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Firmas', 'ParentColumn' => 'IdProvincia'),         
    );

    /**
     * Relacion de entidades de las que esta depende
     * @var string
     */
    protected $_childEntities = array(
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

    public function setIdPais($IdPais) {
        $this->IdPais = $IdPais;
    }

    public function getIdPais() {
        if (!($this->IdPais instanceof Paises))
            $this->IdPais = new Paises($this->IdPais);
        return $this->IdPais;
    }

    public function setCodigo($Codigo) {
        $this->Codigo = trim($Codigo);
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function setProvincia($Provincia) {
        $this->Provincia = trim($Provincia);
    }

    public function getProvincia() {
        return $this->Provincia;
    }

}

// END class Agtprovincias

