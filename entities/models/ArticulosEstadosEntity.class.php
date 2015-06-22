<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 22:30:40
 */

/**
 * @orm:Entity(ArticulosEstados)
 */
class ArticulosEstadosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtArticulosEstados")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtArticulosEstados")
     */
    protected $Estado;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtArticulosEstados';

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
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'IdEstado1'),
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'IdEstado2'),
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'IdEstado3'),
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'IdEstado4'),
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'IdEstado5'),
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

    public function setEstado($Estado) {
        $this->Estado = trim($Estado);
    }

    public function getEstado() {
        return $this->Estado;
    }

}

// END class AgtArticulosEstados

