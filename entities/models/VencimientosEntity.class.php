<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:13:11
 */

/**
 * @orm:Entity(Vencimientos)
 */
class VencimientosEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtVencimientos")
	 */
	protected $Id;
	/**
	 * @var entities\FemitidasCab
	 * @assert NotBlank(groups="AgtVencimientos")
	 */
	protected $IdFactura = '0';
	/**
	 * @var date
	 */
	protected $Fecha;
	/**
	 * @var integer
	 */
	protected $Importe = '0.00';
	/**
	 * Nombre de la conexion a la BD
	 * @var string
	 */
	protected $_conectionName = '';
	/**
	 * Nombre de la tabla física
	 * @var string
	 */
	protected $_tableName = 'AgtVencimientos';
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
			'FemitidasCab',
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

	public function setIdFactura($IdFactura) {
		$this->IdFactura = ($IdFactura instanceof FemitidasCab) ? $IdFactura->getPrimaryKeyValue() : $IdFactura;
	}
	public function getIdFactura() {
		if (!($this->IdFactura instanceof FemitidasCab)) {
			$this->IdFactura = new FemitidasCab($this->IdFactura);
		}
		return $this->IdFactura;
	}

	public function setFecha($Fecha) {
		$date = new Fecha($Fecha);
		$this->Fecha = $date->getFecha();
		unset($date);
	}
	public function getFecha() {
		$date = new Fecha($this->Fecha);
		$ddmmaaaa = $date->getddmmaaaa();
		unset($date);
		return $ddmmaaaa;
	}

	public function setImporte($Importe) {
		$this->Importe = $Importe;
	}
	public function getImporte() {
		return $this->Importe;
	}

} // END class AgtVencimientos

