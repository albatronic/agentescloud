<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:13:24
 */

/**
 * @orm:Entity(EntradasLineas)
 */
class EntradasLineasEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtEntradasLineas")
	 */
	protected $Id;
	/**
	 * @var entities\EntradasCab
	 */
	protected $IdEntrada = '0';
	/**
	 * @var entities\Firmas
	 * @assert NotBlank(groups="AgtEntradasLineas")
	 */
	protected $IdFirma = '0';
	/**
	 * @var entities\Familias
	 * @assert NotBlank(groups="AgtEntradasLineas")
	 */
	protected $IdFamilia = '0';
	/**
	 * @var entities\Articulos
	 * @assert NotBlank(groups="AgtEntradasLineas")
	 */
	protected $IdArticulo = '0';
	/**
	 * @var string
	 * @assert NotBlank(groups="AgtEntradasLineas")
	 */
	protected $Descripcion;
	/**
	 * @var integer
	 */
	protected $Unidades = '0.00';
	/**
	 * @var integer
	 */
	protected $Precio = '0.00';
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
	protected $_tableName = 'AgtEntradasLineas';
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
			'EntradasCab',
			'Firmas',
			'Familias',
			'Articulos',
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

	public function setIdEntrada($IdEntrada) {
		$this->IdEntrada = ($IdEntrada instanceof EntradasCab) ? $IdEntrada->getPrimaryKeyValue() : $IdEntrada;
	}
	public function getIdEntrada() {
		if (!($this->IdEntrada instanceof EntradasCab)) {
			$this->IdEntrada = new EntradasCab($this->IdEntrada);
		}
		return $this->IdEntrada;
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

	public function setIdArticulo($IdArticulo) {
		$this->IdArticulo = ($IdArticulo instanceof Articulos) ? $IdArticulo->getPrimaryKeyValue() : $IdArticulo;
	}
	public function getIdArticulo() {
		if (!($this->IdArticulo instanceof Articulos)) {
			$this->IdArticulo = new Articulos($this->IdArticulo);
		}
		return $this->IdArticulo;
	}

	public function setDescripcion($Descripcion) {
		$this->Descripcion = trim($Descripcion);
	}
	public function getDescripcion() {
		return $this->Descripcion;
	}

	public function setUnidades($Unidades) {
		$this->Unidades = $Unidades;
	}
	public function getUnidades() {
		return $this->Unidades;
	}

	public function setPrecio($Precio) {
		$this->Precio = $Precio;
	}
	public function getPrecio() {
		return $this->Precio;
	}

	public function setImporte($Importe) {
		$this->Importe = $Importe;
	}
	public function getImporte() {
		return $this->Importe;
	}

} // END class AgtEntradasLineas

