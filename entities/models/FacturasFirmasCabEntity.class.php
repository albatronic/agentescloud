<?php
/**
 * @copyright ALBATRONIC
 * @date 05.08.2015 21:12:31
 */

/**
 * @orm:Entity(FacturasFirmasCab)
 */
class FacturasFirmasCabEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Id;
	/**
	 * @var string
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Serie;
	/**
	 * @var entities\Firmas
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdFirma = '0';
	/**
	 * @var entities\Clientes
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdCliente = '0';
	/**
	 * @var entities\ClientesDEntrega
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdDirec = '0';
	/**
	 * @var entities\Usuarios
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdSubagente = '0';
	/**
	 * @var string
	 */
	protected $SuFactura;
	/**
	 * @var string
	 */
	protected $Referencia;
	/**
	 * @var date
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Fecha = '0000-00-00';
	/**
	 * @var string
	 */
	protected $LiquidacionFirma;
	/**
	 * @var string
	 */
	protected $LiquidacionSubagente;
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $ComisionAgente = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $ComisionSubagente = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Descuentos = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $DescuentoProntoPago = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $GastosEnvio = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $BaseImponible1 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Iva1 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $CuotaIva1 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Recargo1 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $CuotaRecargo1 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $BaseImponible2 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Iva2 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $CuotaIva2 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Recargo2 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $CuotaRecargo2 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $BaseImponible3 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Iva3 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $CuotaIva3 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Recargo3 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $CuotaRecargo3 = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $TotalBases = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $TotalIva = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $TotalRecargo = '0.00';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $TotalFactura = '0.00';
	/**
	 * @var string
	 */
	protected $Incidencias;
	/**
	 * @var entities\EstadosPedidos
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdEstado = '0';
	/**
	 * @var entities\FormasPago
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdFormaPago = '0';
	/**
	 * @var string
	 */
	protected $DomicilioPago;
	/**
	 * @var entities\Agencias
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $IdAgencia = '0';
	/**
	 * @var string
	 */
	protected $Portes;
	/**
	 * @var entities\ValoresSN
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Liquidar = '0';
	/**
	 * @var entities\ValoresSN
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $Servido = '0';
	/**
	 * @var integer
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
	 */
	protected $NivelJerarquico = '1';
	/**
	 * @var entities\ValoresSN
	 * @assert NotBlank(groups="AgtFacturasFirmasCab")
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
	protected $_tableName = 'AgtFacturasFirmasCab';
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
			'Clientes',
			'ClientesDEntrega',
			'Usuarios',
			'EstadosPedidos',
			'FormasPago',
			'Agencias',
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

	public function setSerie($Serie) {
		$this->Serie = trim($Serie);
	}
	public function getSerie() {
		return $this->Serie;
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

	public function setIdCliente($IdCliente) {
		$this->IdCliente = ($IdCliente instanceof Clientes) ? $IdCliente->getPrimaryKeyValue() : $IdCliente;
	}
	public function getIdCliente() {
		if (!($this->IdCliente instanceof Clientes)) {
			$this->IdCliente = new Clientes($this->IdCliente);
		}
		return $this->IdCliente;
	}

	public function setIdDirec($IdDirec) {
		$this->IdDirec = ($IdDirec instanceof ClientesDEntrega) ? $IdDirec->getPrimaryKeyValue() : $IdDirec;
	}
	public function getIdDirec() {
		if (!($this->IdDirec instanceof ClientesDEntrega)) {
			$this->IdDirec = new ClientesDEntrega($this->IdDirec);
		}
		return $this->IdDirec;
	}

	public function setIdSubagente($IdSubagente) {
		$this->IdSubagente = ($IdSubagente instanceof Usuarios) ? $IdSubagente->getPrimaryKeyValue() : $IdSubagente;
	}
	public function getIdSubagente() {
		if (!($this->IdSubagente instanceof Usuarios)) {
			$this->IdSubagente = new Usuarios($this->IdSubagente);
		}
		return $this->IdSubagente;
	}

	public function setSuFactura($SuFactura) {
		$this->SuFactura = trim($SuFactura);
	}
	public function getSuFactura() {
		return $this->SuFactura;
	}

	public function setReferencia($Referencia) {
		$this->Referencia = trim($Referencia);
	}
	public function getReferencia() {
		return $this->Referencia;
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

	public function setLiquidacionFirma($LiquidacionFirma) {
		$this->LiquidacionFirma = trim($LiquidacionFirma);
	}
	public function getLiquidacionFirma() {
		return $this->LiquidacionFirma;
	}

	public function setLiquidacionSubagente($LiquidacionSubagente) {
		$this->LiquidacionSubagente = trim($LiquidacionSubagente);
	}
	public function getLiquidacionSubagente() {
		return $this->LiquidacionSubagente;
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

	public function setDescuentos($Descuentos) {
		$this->Descuentos = $Descuentos;
	}
	public function getDescuentos() {
		return $this->Descuentos;
	}

	public function setDescuentoProntoPago($DescuentoProntoPago) {
		$this->DescuentoProntoPago = $DescuentoProntoPago;
	}
	public function getDescuentoProntoPago() {
		return $this->DescuentoProntoPago;
	}

	public function setGastosEnvio($GastosEnvio) {
		$this->GastosEnvio = $GastosEnvio;
	}
	public function getGastosEnvio() {
		return $this->GastosEnvio;
	}

	public function setBaseImponible1($BaseImponible1) {
		$this->BaseImponible1 = $BaseImponible1;
	}
	public function getBaseImponible1() {
		return $this->BaseImponible1;
	}

	public function setIva1($Iva1) {
		$this->Iva1 = $Iva1;
	}
	public function getIva1() {
		return $this->Iva1;
	}

	public function setCuotaIva1($CuotaIva1) {
		$this->CuotaIva1 = $CuotaIva1;
	}
	public function getCuotaIva1() {
		return $this->CuotaIva1;
	}

	public function setRecargo1($Recargo1) {
		$this->Recargo1 = $Recargo1;
	}
	public function getRecargo1() {
		return $this->Recargo1;
	}

	public function setCuotaRecargo1($CuotaRecargo1) {
		$this->CuotaRecargo1 = $CuotaRecargo1;
	}
	public function getCuotaRecargo1() {
		return $this->CuotaRecargo1;
	}

	public function setBaseImponible2($BaseImponible2) {
		$this->BaseImponible2 = $BaseImponible2;
	}
	public function getBaseImponible2() {
		return $this->BaseImponible2;
	}

	public function setIva2($Iva2) {
		$this->Iva2 = $Iva2;
	}
	public function getIva2() {
		return $this->Iva2;
	}

	public function setCuotaIva2($CuotaIva2) {
		$this->CuotaIva2 = $CuotaIva2;
	}
	public function getCuotaIva2() {
		return $this->CuotaIva2;
	}

	public function setRecargo2($Recargo2) {
		$this->Recargo2 = $Recargo2;
	}
	public function getRecargo2() {
		return $this->Recargo2;
	}

	public function setCuotaRecargo2($CuotaRecargo2) {
		$this->CuotaRecargo2 = $CuotaRecargo2;
	}
	public function getCuotaRecargo2() {
		return $this->CuotaRecargo2;
	}

	public function setBaseImponible3($BaseImponible3) {
		$this->BaseImponible3 = $BaseImponible3;
	}
	public function getBaseImponible3() {
		return $this->BaseImponible3;
	}

	public function setIva3($Iva3) {
		$this->Iva3 = $Iva3;
	}
	public function getIva3() {
		return $this->Iva3;
	}

	public function setCuotaIva3($CuotaIva3) {
		$this->CuotaIva3 = $CuotaIva3;
	}
	public function getCuotaIva3() {
		return $this->CuotaIva3;
	}

	public function setRecargo3($Recargo3) {
		$this->Recargo3 = $Recargo3;
	}
	public function getRecargo3() {
		return $this->Recargo3;
	}

	public function setCuotaRecargo3($CuotaRecargo3) {
		$this->CuotaRecargo3 = $CuotaRecargo3;
	}
	public function getCuotaRecargo3() {
		return $this->CuotaRecargo3;
	}

	public function setTotalBases($TotalBases) {
		$this->TotalBases = $TotalBases;
	}
	public function getTotalBases() {
		return $this->TotalBases;
	}

	public function setTotalIva($TotalIva) {
		$this->TotalIva = $TotalIva;
	}
	public function getTotalIva() {
		return $this->TotalIva;
	}

	public function setTotalRecargo($TotalRecargo) {
		$this->TotalRecargo = $TotalRecargo;
	}
	public function getTotalRecargo() {
		return $this->TotalRecargo;
	}

	public function setTotalFactura($TotalFactura) {
		$this->TotalFactura = $TotalFactura;
	}
	public function getTotalFactura() {
		return $this->TotalFactura;
	}

	public function setIncidencias($Incidencias) {
		$this->Incidencias = trim($Incidencias);
	}
	public function getIncidencias() {
		return $this->Incidencias;
	}

	public function setIdEstado($IdEstado) {
		$this->IdEstado = ($IdEstado instanceof EstadosPedidos) ? $IdEstado->getPrimaryKeyValue() : $IdEstado;
	}
	public function getIdEstado() {
		if (!($this->IdEstado instanceof EstadosPedidos)) {
			$this->IdEstado = new EstadosPedidos($this->IdEstado);
		}
		return $this->IdEstado;
	}

	public function setIdFormaPago($IdFormaPago) {
		$this->IdFormaPago = ($IdFormaPago instanceof FormasPago) ? $IdFormaPago->getPrimaryKeyValue() : $IdFormaPago;
	}
	public function getIdFormaPago() {
		if (!($this->IdFormaPago instanceof FormasPago)) {
			$this->IdFormaPago = new FormasPago($this->IdFormaPago);
		}
		return $this->IdFormaPago;
	}

	public function setDomicilioPago($DomicilioPago) {
		$this->DomicilioPago = trim($DomicilioPago);
	}
	public function getDomicilioPago() {
		return $this->DomicilioPago;
	}

	public function setIdAgencia($IdAgencia) {
		$this->IdAgencia = ($IdAgencia instanceof Agencias) ? $IdAgencia->getPrimaryKeyValue() : $IdAgencia;
	}
	public function getIdAgencia() {
		if (!($this->IdAgencia instanceof Agencias)) {
			$this->IdAgencia = new Agencias($this->IdAgencia);
		}
		return $this->IdAgencia;
	}

	public function setPortes($Portes) {
		$this->Portes = trim($Portes);
	}
	public function getPortes() {
		return $this->Portes;
	}

	public function setLiquidar($Liquidar) {
		$this->Liquidar = ($Liquidar instanceof ValoresSN) ? $Liquidar->getPrimaryKeyValue() : $Liquidar;
	}
	public function getLiquidar() {
		if (!($this->Liquidar instanceof ValoresSN)) {
			$this->Liquidar = new ValoresSN($this->Liquidar);
		}
		return $this->Liquidar;
	}

	public function setServido($Servido) {
		$this->Servido = ($Servido instanceof ValoresSN) ? $Servido->getPrimaryKeyValue() : $Servido;
	}
	public function getServido() {
		if (!($this->Servido instanceof ValoresSN)) {
			$this->Servido = new ValoresSN($this->Servido);
		}
		return $this->Servido;
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

} // END class AgtFacturasFirmasCab

