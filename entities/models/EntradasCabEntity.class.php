<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:13:19
 */

/**
 * @orm:Entity(EntradasCab)
 */
class EntradasCabEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtEntradasCab")
	 */
	protected $Id;
	/**
	 * @var date
	 */
	protected $Fecha;
	/**
	 * @var string
	 */
	protected $Documento;
	/**
	 * @var entities\Almacenes
	 */
	protected $IdAlmacen = '0';
	/**
	 * @var entities\Firmas
	 */
	protected $IdFirma = '0';
	/**
	 * @var tinyint
	 */
	protected $Recepcionado = '0';
	/**
	 * Nombre de la conexion a la BD
	 * @var string
	 */
	protected $_conectionName = '';
	/**
	 * Nombre de la tabla física
	 * @var string
	 */
	protected $_tableName = 'AgtEntradasCab';
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
			'Almacenes',
			'Firmas',
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

	public function setDocumento($Documento) {
		$this->Documento = trim($Documento);
	}
	public function getDocumento() {
		return $this->Documento;
	}

	public function setIdAlmacen($IdAlmacen) {
		$this->IdAlmacen = ($IdAlmacen instanceof Almacenes) ? $IdAlmacen->getPrimaryKeyValue() : $IdAlmacen;
	}
	public function getIdAlmacen() {
		if (!($this->IdAlmacen instanceof Almacenes)) {
			$this->IdAlmacen = new Almacenes($this->IdAlmacen);
		}
		return $this->IdAlmacen;
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

	public function setRecepcionado($Recepcionado) {
		$this->Recepcionado = $Recepcionado;
	}
	public function getRecepcionado() {
		if (!($this->Recepcionado instanceof ValoresSN))
			$this->Recepcionado = new ValoresSN($this->Recepcionado);
		return $this->Recepcionado;
	}

} // END class AgtEntradasCab

