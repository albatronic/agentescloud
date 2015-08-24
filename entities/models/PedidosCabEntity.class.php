<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 23:09:15
 */

/**
 * @orm:Entity(PedidosCab)
 */
class PedidosCabEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Id;

    /**
     * @var entities\Firmas
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $IdFirma = '0';

    /**
     * @var entities\Clientes
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $IdCliente = '0';

    /**
     * @var entities\ClientesDEntrega
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $IdDirec = '0';

    /**
     * @var entities\Almacenes
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $IdAlmacen = '0';

    /**
     * @var entities\Usuarios
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $IdAgente = '0';

    /**
     * @var string
     */
    protected $SuPedido;

    /**
     * @var string
     */
    protected $Referencia;

    /**
     * @var date
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Fecha;

    /**
     * @var date
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $FechaEntrega = '0000-00-00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $ComisionAgente = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $ComisionSubagente = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Descuentos = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $DescuentoProntoPago = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $BaseImponible1 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Iva1 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $CuotaIva1 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Recargo1 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $CuotaRecargo1 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $BaseImponible2 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Iva2 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $CuotaIva2 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Recargo2 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $CuotaRecargo2 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $BaseImponible3 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Iva3 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $CuotaIva3 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Recargo3 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $CuotaRecargo3 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $TotalBases = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $TotalIva = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $TotalRecargo = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $TotalPedido = '0.00';

    /**
     * @var string
     */
    protected $Incidencias;

    /**
     * @var entities\EstadosPedidos
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $IdEstado = '0';

    /**
     * @var entities\FormasPago
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $FormaPago = '';

    /**
     * @var entities\Agencias
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Agencia = '';

    /**
     * @var string
     */
    protected $Portes;

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Imprimir = '0';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtPedidosCab")
     */
    protected $Servido = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtPedidosCab';

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
        'Almacenes',
        'Usuarios',
        'EstadosPedidos',
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

    public function setIdAlmacen($IdAlmacen) {
        $this->IdAlmacen = ($IdAlmacen instanceof Almacenes) ? $IdAlmacen->getPrimaryKeyValue() : $IdAlmacen;
    }

    public function getIdAlmacen() {
        if (!($this->IdAlmacen instanceof Almacenes)) {
            $this->IdAlmacen = new Almacenes($this->IdAlmacen);
        }
        return $this->IdAlmacen;
    }

    public function setIdAgente($IdAgente) {
        $this->IdAgente = ($IdAgente instanceof Usuarios) ? $IdAgente->getPrimaryKeyValue() : $IdAgente;
    }

    public function getIdAgente() {
        if (!($this->IdAgente instanceof Usuarios)) {
            $this->IdAgente = new Usuarios($this->IdAgente);
        }
        return $this->IdAgente;
    }

    public function setSuPedido($SuPedido) {
        $this->SuPedido = trim($SuPedido);
    }

    public function getSuPedido() {
        return $this->SuPedido;
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

    public function setFechaEntrega($FechaEntrega) {
        $date = new Fecha($FechaEntrega);
        $this->FechaEntrega = $date->getFecha();
        unset($date);
    }

    public function getFechaEntrega() {
        $date = new Fecha($this->FechaEntrega);
        $ddmmaaaa = $date->getddmmaaaa();
        unset($date);
        return $ddmmaaaa;
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

    public function setTotalPedido($TotalPedido) {
        $this->TotalPedido = $TotalPedido;
    }

    public function getTotalPedido() {
        return $this->TotalPedido;
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

    public function setFormaPago($FormaPago) {
        $this->FormaPago = trim($FormaPago);
    }

    public function getFormaPago() {
        return $this->FormaPago;
    }

    public function setAgencia($Agencia) {
        $this->Agencia = trim($Agencia);
    }

    public function getAgencia() {
        return $this->Agencia;
    }

    public function setPortes($Portes) {
        $this->Portes = trim($Portes);
    }

    public function getPortes() {
        return $this->Portes;
    }

    public function setImprimir($Imprimir) {
        $this->Imprimir = ($Imprimir instanceof ValoresSN) ? $Imprimir->getPrimaryKeyValue() : $Imprimir;
    }

    public function getImprimir() {
        if (!($this->Imprimir instanceof ValoresSN)) {
            $this->Imprimir = new ValoresSN($this->Imprimir);
        }
        return $this->Imprimir;
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

}

// END class AgtPedidosCab

