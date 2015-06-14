<?php

/**
 * @copyright ALBATRONIC
 * @date 17.12.2014 12:02:28
 */

/**
 * @orm:Entity(Modulos)
 */
class ModulosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtModulos")
     */
    protected $Id;

    /**
     * @var entities\Aplicaciones
     * @assert NotBlank(groups="AgtModulos")
     */
    protected $CodigoApp;

    /**
     * @var string
     * @assert NotBlank(groups="AgtModulos")
     */
    protected $NombreModulo;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtModulos")
     */
    protected $Nivel = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtModulos")
     */
    protected $Titulo;

    /**
     * @var string
     */
    protected $Descripcion;

    /**
     * @var string
     * @assert NotBlank(groups="AgtModulos")
     */
    protected $Funcionalidades;

    /**
     * @var string
     */
    protected $Icon;

    /**
     * @var integer
     */
    protected $BelongsTo = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtModulos';

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
        'Aplicaciones',
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

    public function setCodigoApp($CodigoApp) {
        $this->CodigoApp = trim($CodigoApp);
    }

    public function getCodigoApp() {
        if (!($this->CodigoApp instanceof Aplicaciones))
            $this->CodigoApp = new Aplicaciones($this->CodigoApp);
        return $this->CodigoApp;
    }

    public function setNombreModulo($NombreModulo) {
        $this->NombreModulo = trim($NombreModulo);
    }

    public function getNombreModulo() {
        return $this->NombreModulo;
    }

    public function setNivel($Nivel) {
        $this->Nivel = $Nivel;
    }

    public function getNivel() {
        return $this->Nivel;
    }

    public function setTitulo($Titulo) {
        $this->Titulo = trim($Titulo);
    }

    public function getTitulo() {
        return $this->Titulo;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = trim($Descripcion);
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setFuncionalidades($Funcionalidades) {
        $this->Funcionalidades = trim($Funcionalidades);
    }

    public function getFuncionalidades() {
        return $this->Funcionalidades;
    }

    public function setIcon($Icon) {
        $this->Icon = trim($Icon);
    }

    public function getIcon() {
        return $this->Icon;
    }

}

// END class AgtModulos

