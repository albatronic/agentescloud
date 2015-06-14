<?php

/**
 * @copyright ALBATRONIC
 * @date 17.12.2014 12:00:58
 */

/**
 * @orm:Entity(Aplicaciones)
 */
class AplicacionesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtAplicaciones")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAplicaciones")
     */
    protected $CodigoApp;

    /**
     * @var string
     * @assert NotBlank(groups="AgtAplicaciones")
     */
    protected $NombreApp;

    /**
     * @var string
     */
    protected $Descripcion;

    /**
     * @var string
     */
    protected $Icon;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'emp';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtAplicaciones';

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

    public function setCodigoApp($CodigoApp) {
        $this->CodigoApp = trim($CodigoApp);
    }

    public function getCodigoApp() {
        return $this->CodigoApp;
    }

    public function setNombreApp($NombreApp) {
        $this->NombreApp = trim($NombreApp);
    }

    public function getNombreApp() {
        return $this->NombreApp;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = trim($Descripcion);
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setIcon($Icon) {
        $this->Icon = trim($Icon);
    }

    public function getIcon() {
        return $this->Icon;
    }

}

// END class AgtAplicaciones

