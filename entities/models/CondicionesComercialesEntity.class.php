<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:11:59
 */

/**
 * @orm:Entity(CondicionesComerciales)
 */
class CondicionesComercialesEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtCondicionesComerciales")
	 */
	protected $Id;
	/**
	 * @var entities\Firmas
	 * @assert NotBlank(groups="AgtCondicionesComerciales")
	 */
	protected $IdFirma = '0';
	/**
	 * @var entities\Familias
	 * @assert NotBlank(groups="AgtCondicionesComerciales")
	 */
	protected $IdFamilia = '0';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtCondicionesComerciales")
	 */
	protected $IdCondicion = '0';
	/**
	 * @var integer
	 */
	protected $Descuento1 = '0.00';
	/**
	 * @var integer
	 */
	protected $Descuento2 = '0.00';
	/**
	 * @var integer
	 */
	protected $Comision = '0.00';
	/**
	 * @var string
	 */
	protected $FormaPago;
	/**
	 * Nombre de la conexion a la BD
	 * @var string
	 */
	protected $_conectionName = '';
	/**
	 * Nombre de la tabla física
	 * @var string
	 */
	protected $_tableName = 'AgtCondicionesComerciales';
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
			'Familias',
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

	public function setIdFamilia($IdFamilia) {
		$this->IdFamilia = ($IdFamilia instanceof Familias) ? $IdFamilia->getPrimaryKeyValue() : $IdFamilia;
	}
	public function getIdFamilia() {
		if (!($this->IdFamilia instanceof Familias)) {
			$this->IdFamilia = new Familias($this->IdFamilia);
		}
		return $this->IdFamilia;
	}

	public function setIdCondicion($IdCondicion) {
		$this->IdCondicion = $IdCondicion;
	}
	public function getIdCondicion() {
		return $this->IdCondicion;
	}

	public function setDescuento1($Descuento1) {
		$this->Descuento1 = $Descuento1;
	}
	public function getDescuento1() {
		return $this->Descuento1;
	}

	public function setDescuento2($Descuento2) {
		$this->Descuento2 = $Descuento2;
	}
	public function getDescuento2() {
		return $this->Descuento2;
	}

	public function setComision($Comision) {
		$this->Comision = $Comision;
	}
	public function getComision() {
		return $this->Comision;
	}

	public function setFormaPago($FormaPago) {
		$this->FormaPago = trim($FormaPago);
	}
	public function getFormaPago() {
		return $this->FormaPago;
	}

} // END class AgtCondicionesComerciales

