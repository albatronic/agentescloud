<?php

/**
 * @copyright ALBATRONIC
 * @date 06.02.2015 21:44:08
 */

/**
 * @orm:Entity(Variables)
 */
class VariablesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtVariables")
     */
    protected $Id;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtVariables")
     */
    protected $IdPerfil = 0;

    /**
     * @var string
     * @assert NotBlank(groups="AgtVariables")
     */
    protected $Variable;

    /**
     * @var string
     */
    protected $Yml;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtVariables';

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

    public function setIdPerfil($IdPerfil) {
        $this->IdPerfil = $IdPerfil;
    }

    public function getIdPerfil() {
        return $this->IdPerfil;
    }

    public function setVariable($Variable) {
        $this->Variable = trim($Variable);
    }

    public function getVariable() {
        return $this->Variable;
    }

    public function setYml($Yml) {
        $this->Yml = trim($Yml);
    }

    public function getYml() {
        return $this->Yml;
    }

}
