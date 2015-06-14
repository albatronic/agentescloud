<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:46:25
 */

/**
 * @orm:Entity(FormasPago)
 */
class FormasPagoEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $Descripcion;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $NumeroVctos = '1';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $DiaPrimerVcto = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $DiasIntervalo = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $CContable = '0000000000';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $AnotarEnCaja = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $RecargoFinanciero = '0.00000';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtFormasPago")
     */
    protected $DescuentoFinanciero = '0.00000';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtFormasPago';

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

    public function setDescripcion($Descripcion) {
        $this->Descripcion = trim($Descripcion);
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setNumeroVctos($NumeroVctos) {
        $this->NumeroVctos = $NumeroVctos;
    }

    public function getNumeroVctos() {
        return $this->NumeroVctos;
    }

    public function setDiaPrimerVcto($DiaPrimerVcto) {
        $this->DiaPrimerVcto = $DiaPrimerVcto;
    }

    public function getDiaPrimerVcto() {
        return $this->DiaPrimerVcto;
    }

    public function setDiasIntervalo($DiasIntervalo) {
        $this->DiasIntervalo = $DiasIntervalo;
    }

    public function getDiasIntervalo() {
        return $this->DiasIntervalo;
    }

    public function setCContable($CContable) {
        $this->CContable = trim($CContable);
    }

    public function getCContable() {
        return $this->CContable;
    }

    public function setAnotarEnCaja($AnotarEnCaja) {
        $this->AnotarEnCaja = ($AnotarEnCaja instanceof ValoresSN) ? $AnotarEnCaja->getPrimaryKeyValue() : $AnotarEnCaja;
    }

    public function getAnotarEnCaja() {
        if (!($this->AnotarEnCaja instanceof ValoresSN)) {
            $this->AnotarEnCaja = new ValoresSN($this->AnotarEnCaja);
        }
        return $this->AnotarEnCaja;
    }

    public function setRecargoFinanciero($RecargoFinanciero) {
        $this->RecargoFinanciero = $RecargoFinanciero;
    }

    public function getRecargoFinanciero() {
        return $this->RecargoFinanciero;
    }

    public function setDescuentoFinanciero($DescuentoFinanciero) {
        $this->DescuentoFinanciero = $DescuentoFinanciero;
    }

    public function getDescuentoFinanciero() {
        return $this->DescuentoFinanciero;
    }

}

// END class AgtFormasPago

