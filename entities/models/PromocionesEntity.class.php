<?php

/**
 * @copyright ALBATRONIC
 * @date 06.08.2015 17:03:43
 */

/**
 * @orm:Entity(Promociones)
 */
class PromocionesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtPromociones")
     */
    protected $Id;

    /**
     * @var entities\Articulos
     * @assert NotBlank(groups="AgtPromociones")
     */
    protected $IdArticulo = '0';

    /**
     * @var date
     */
    protected $FechaLimite;

    /**
     * @var integer
     */
    protected $CantidadMinima = '0.00';

    /**
     * @var integer
     */
    protected $PrecioNeto = '0.00';

    /**
     * @var integer
     */
    protected $Descuento = '0.00';

    /**
     * @var integer
     */
    protected $Comision = '0.00';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtPromociones';

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

    public function setFechaLimite($FechaLimite) {
        $date = new Fecha($FechaLimite);
        $this->FechaLimite = $date->getFecha();
        unset($date);
    }

    public function getFechaLimite() {
        $date = new Fecha($this->FechaLimite);
        $ddmmaaaa = $date->getddmmaaaa();
        unset($date);
        return $ddmmaaaa;
    }

    public function setCantidadMinima($CantidadMinima) {
        $this->CantidadMinima = $CantidadMinima;
    }

    public function getCantidadMinima() {
        return $this->CantidadMinima;
    }

    public function setPrecioNeto($PrecioNeto) {
        $this->PrecioNeto = $PrecioNeto;
    }

    public function getPrecioNeto() {
        return $this->PrecioNeto;
    }

    public function setDescuento($Descuento) {
        $this->Descuento = $Descuento;
    }

    public function getDescuento() {
        return $this->Descuento;
    }

    public function setComision($Comision) {
        $this->Comision = $Comision;
    }

    public function getComision() {
        return $this->Comision;
    }

}

// END class AgtPromociones

