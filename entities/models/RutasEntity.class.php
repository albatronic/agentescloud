<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 20:07:08
 */

/**
 * @orm:Entity(Rutas)
 */
class RutasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtRutas")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtRutas")
     */
    protected $Descripcion;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtRutas';

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
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Clientes', 'ParentColumn' => 'IdRuta'),         
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

    public function setDescripcion($Descripcion) {
        $this->Descripcion = trim($Descripcion);
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

}

// END class AgtRutas

