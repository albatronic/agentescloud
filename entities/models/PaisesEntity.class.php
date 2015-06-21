<?php

/**
 * @copyright ALBATRONIC
 * @date 18.12.2014 00:24:08
 */

/**
 * @orm:Entity(Paises)
 */
class PaisesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtPaises")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtPaises")
     */
    protected $Codigo;

    /**
     * @var string
     * @assert NotBlank(groups="AgtPaises")
     */
    protected $Pais;

    /**
     * @var entities\Monedas
     */
    protected $IdMoneda = '0';

    /**
     * @var entities\ZonasHorarias
     */
    protected $IdZonaHoraria = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPaises")
     */
    protected $Latitud = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPaises")
     */
    protected $Longitud = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtPaises';

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
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Clientes', 'ParentColumn' => 'IdPais'),         
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Firmas', 'ParentColumn' => 'IdPais'),          
    );

    /**
     * Relacion de entidades de las que esta depende
     * @var string
     */
    protected $_childEntities = array(
        'Monedas',
        'ZonasHorarias',
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

    public function setCodigo($Codigo) {
        $this->Codigo = trim($Codigo);
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function setPais($Pais) {
        $this->Pais = trim($Pais);
    }

    public function getPais() {
        return $this->Pais;
    }

    public function setIdMoneda($IdMoneda) {
        $this->IdMoneda = $IdMoneda;
    }

    public function getIdMoneda() {
        if (!($this->IdMoneda instanceof Monedas))
            $this->IdMoneda = new Monedas($this->IdMoneda);
        return $this->IdMoneda;
    }

    public function setIdZonaHoraria($IdZonaHoraria) {
        $this->IdZonaHoraria = $IdZonaHoraria;
    }

    public function getIdZonaHoraria() {
        if (!($this->IdZonaHoraria instanceof ZonasHorarias))
            $this->IdZonaHoraria = new ZonasHorarias($this->IdZonaHoraria);
        return $this->IdZonaHoraria;
    }

    public function setLatitud($Latitud) {
        $this->Latitud = $Latitud;
    }

    public function getLatitud() {
        return $this->Latitud;
    }

    public function setLongitud($Longitud) {
        $this->Longitud = $Longitud;
    }

    public function getLongitud() {
        return $this->Longitud;
    }

}

// END class AgtPaises

