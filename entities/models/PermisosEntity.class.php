<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Permisos)
 */
class PermisosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="Agtpermisos")
     */
    protected $Id;

    /**
     * @var entities\Perfiles
     * @assert NotBlank(groups="Agtpermisos")
     */
    protected $IdPerfil;

    /**
     * @var entities\Modulos
     * @assert NotBlank(groups="Agtpermisos")
     */
    protected $NombreModulo;

    /**
     * @var string
     * @assert NotBlank(groups="Agtpermisos")
     */
    protected $Funcionalidades;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtPermisos';

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
        'Perfiles',
        'Modulos',
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
        $this->IdPerfil = ($IdPerfil instanceof Perfiles) ? $IdPerfil->getPrimaryKeyValue() : $IdPerfil;
    }

    public function getIdPerfil() {
        if (!($this->IdPerfil instanceof Perfiles))
            $this->IdPerfil = new Perfiles($this->IdPerfil);
        return $this->IdPerfil;
    }

    public function setNombreModulo($NombreModulo) {
        $this->NombreModulo = trim($NombreModulo);
    }

    public function getNombreModulo() {
        //if (!($this->NombreModulo instanceof Modulos))
        //    $this->NombreModulo = new Modulos($this->NombreModulo);
        return $this->NombreModulo;
    }

    public function setFuncionalidades($Funcionalidades) {
        $this->Funcionalidades = trim($Funcionalidades);
    }

    public function getFuncionalidades() {
        return $this->Funcionalidades;
    }

}

// END class Agtpermisos

