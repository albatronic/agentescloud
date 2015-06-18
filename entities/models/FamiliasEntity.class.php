<?php

/**
 * @copyright ALBATRONIC
 * @date 18.06.2015 21:32:23
 */

/**
 * @orm:Entity(Familias)
 */
class FamiliasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtFamilias")
     */
    protected $Id;

    /**
     * @var entities\Firmas
     * @assert NotBlank(groups="AgtFamilias")
     */
    protected $IdFirma;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFamilias")
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
    protected $_tableName = 'AgtFamilias';

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
        'Firmas',
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

    public function setIdFirma($IdFirma) {
        $this->IdFirma = ($IdFirma instanceof Firmas) ? $IdFirma->getPrimaryKeyValue() : $IdFirma;
    }

    public function getIdFirma() {
        if (!($this->IdFirma instanceof Firmas)) {
            $this->IdFirma = new Firmas($this->IdFirma);
        }
        return $this->IdFirma;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = trim($Descripcion);
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

}

// END class AgtFamilias

