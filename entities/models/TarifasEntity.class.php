<?php

/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 23:03:22
 */

/**
 * @orm:Entity(Tarifas)
 */
class TarifasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtTarifas")
     */
    protected $Id;

    /**
     * @var entities\Articulos
     * @assert NotBlank(groups="AgtTarifas")
     */
    protected $IdArticulo = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtTarifas")
     */
    protected $IdTarifa = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtTarifas")
     */
    protected $Precio = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtTarifas")
     */
    protected $NivelJerarquico = '1';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtTarifas")
     */
    protected $Publish = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtTarifas';

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
        'Articulos',
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

    public function setIdArticulo($IdArticulo) {
        $this->IdArticulo = ($IdArticulo instanceof Articulos) ? $IdArticulo->getPrimaryKeyValue() : $IdArticulo;
    }

    public function getIdArticulo() {
        if (!($this->IdArticulo instanceof Articulos)) {
            $this->IdArticulo = new Articulos($this->IdArticulo);
        }
        return $this->IdArticulo;
    }

    public function setIdTarifa($IdTarifa) {
        $this->IdTarifa = $IdTarifa;
    }

    public function getIdTarifa() {
        return $this->IdTarifa;
    }

    public function setPrecio($Precio) {
        $this->Precio = $Precio;
    }

    public function getPrecio() {
        return $this->Precio;
    }

    public function setNivelJerarquico($NivelJerarquico) {
        $this->NivelJerarquico = $NivelJerarquico;
    }

    public function getNivelJerarquico() {
        return $this->NivelJerarquico;
    }

    public function setPublish($Publish) {
        $this->Publish = ($Publish instanceof ValoresSN) ? $Publish->getPrimaryKeyValue() : $Publish;
    }

    public function getPublish() {
        if (!($this->Publish instanceof ValoresSN)) {
            $this->Publish = new ValoresSN($this->Publish);
        }
        return $this->Publish;
    }

}

// END class AgtTarifas

