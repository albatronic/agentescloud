<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:12:37
 */

/**
 * @orm:Entity(FacturasFirmasLineas)
 */
class FacturasFirmasLineasEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Id;
	/**
	 * @var entities\FacturasFirmasCab
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $IdFactura = '0';
	/**
	 * @var entities\Firmas
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $IdFirma = '0';
	/**
	 * @var entities\Familias
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $IdFamilia = '0';
	/**
	 * @var entities\Clientes
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $IdCliente = '0';
	/**
	 * @var entities\Articulos
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $IdArticulo = '0';
	/**
	 * @var string
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Descripcion;
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Unidades = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Precio = '0.000';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Descuento1 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Descuento2 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Descuento3 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Importe = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Iva = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $ComisionAgente = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $ComisionSubagente = '0.00';
	/**
	 * @var entities\PedidosCab
	 */
	protected $IdPedido = '0';
	/**
	 * @var entities\PedidosLineas
	 */
	protected $IdLineaPedido = '0';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $NivelJerarquico = '1';
	/**
	 * @var entities\ValoresSN
	 * @assert NotBlank(groups="AgtFacturasFirmasLineas")
	 */
	protected $Publish = '0';
	/**
	 * Nombre de la conexion a la BD
	 * @var string
	 */
	protected $_conectionName = '';
	/**
	 * Nombre de la tabla física
	 * @var string
	 */
	protected $_tableName = 'AgtFacturasFirmasLineas';
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
			'FacturasFirmasCab',
			'Firmas',
			'Familias',
			'Clientes',
			'Articulos',
			'PedidosCab',
			'PedidosLineas',
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

	public function setIdFactura($IdFactura) {
		$this->IdFactura = ($IdFactura instanceof FacturasFirmasCab) ? $IdFactura->getPrimaryKeyValue() : $IdFactura;
	}
	public function getIdFactura() {
		if (!($this->IdFactura instanceof FacturasFirmasCab)) {
			$this->IdFactura = new FacturasFirmasCab($this->IdFactura);
		}
		return $this->IdFactura;
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

	public function setIdCliente($IdCliente) {
		$this->IdCliente = ($IdCliente instanceof Clientes) ? $IdCliente->getPrimaryKeyValue() : $IdCliente;
	}
	public function getIdCliente() {
		if (!($this->IdCliente instanceof Clientes)) {
			$this->IdCliente = new Clientes($this->IdCliente);
		}
		return $this->IdCliente;
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

	public function setDescuento3($Descuento3) {
		$this->Descuento3 = $Descuento3;
	}
	public function getDescuento3() {
		return $this->Descuento3;
	}

	public function setImporte($Importe) {
		$this->Importe = $Importe;
	}
	public function getImporte() {
		return $this->Importe;
	}

	public function setIva($Iva) {
		$this->Iva = $Iva;
	}
	public function getIva() {
		return $this->Iva;
	}

	public function setComisionAgente($ComisionAgente) {
		$this->ComisionAgente = $ComisionAgente;
	}
	public function getComisionAgente() {
		return $this->ComisionAgente;
	}

	public function setComisionSubagente($ComisionSubagente) {
		$this->ComisionSubagente = $ComisionSubagente;
	}
	public function getComisionSubagente() {
		return $this->ComisionSubagente;
	}

	public function setIdPedido($IdPedido) {
		$this->IdPedido = ($IdPedido instanceof PedidosCab) ? $IdPedido->getPrimaryKeyValue() : $IdPedido;
	}
	public function getIdPedido() {
		if (!($this->IdPedido instanceof PedidosCab)) {
			$this->IdPedido = new PedidosCab($this->IdPedido);
		}
		return $this->IdPedido;
	}

	public function setIdLineaPedido($IdLineaPedido) {
		$this->IdLineaPedido = ($IdLineaPedido instanceof PedidosLineas) ? $IdLineaPedido->getPrimaryKeyValue() : $IdLineaPedido;
	}
	public function getIdLineaPedido() {
		if (!($this->IdLineaPedido instanceof PedidosLineas)) {
			$this->IdLineaPedido = new PedidosLineas($this->IdLineaPedido);
		}
		return $this->IdLineaPedido;
	}

	public function setNivelJerarquico($NivelJerarquico) {
		$this->NivelJerarquico = $NivelJerarquico;
	}
	public function getNivelJerarquico() {
		return $this->NivelJerarquico;
	}

	public function setPublish($Publish) {
		$this->Publish = ($Publish instanceof ValoresSN) ? $Publish->getPrimaryKeyValue() : $Publish;
	}
	public function getPublish() {
		if (!($this->Publish instanceof ValoresSN)) {
			$this->Publish = new ValoresSN($this->Publish);
		}
		return $this->Publish;
	}

} // END class AgtFacturasFirmasLineas

