<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 23:09:11
 */

/**
 * @orm:Entity(PedidosLineas)
 */
class PedidosLineasEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Id;

    /**
     * @var entities\PedidosCab
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $IdPedido = '0';

    /**
     * @var entities\Firmas
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $IdFirma = '0';

    /**
     * @var entities\Familias
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $IdFamilia = '0';

    /**
     * @var entities\Articulos
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $IdArticulo = '0';

    /**
     * @var entities\Articulos
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $IdCliente = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Descripcion;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Unidades = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Precio = '0.000';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Descuento1 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Descuento2 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Descuento3 = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Importe = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Iva = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $ComisionAgente = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $ComisionSubagente = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $UnidadesPtesFacturar = '0.00';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtPedidosLineas")
     */
    protected $Facturar = '0';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtPedidosLineas';

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
        'PedidosCab',
        'Firmas',
        'Familias',
        'Articulos',
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

    public function setIdPedido($IdPedido) {
        $this->IdPedido = ($IdPedido instanceof PedidosCab) ? $IdPedido->getPrimaryKeyValue() : $IdPedido;
    }

    public function getIdPedido() {
        if (!($this->IdPedido instanceof PedidosCab)) {
            $this->IdPedido = new PedidosCab($this->IdPedido);
        }
        return $this->IdPedido;
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

    public function setIdCliente($IdCliente) {
        $this->IdCliente = ($IdCliente instanceof Clientes) ? $IdCliente->getPrimaryKeyValue() : $IdCliente;
    }

    public function getIdCliente() {
        if (!($this->IdCliente instanceof Clientes)) {
            $this->IdCliente = new Clientes($this->IdCliente);
        }
        return $this->IdCliente;
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

    public function setUnidadesPtesFacturar($UnidadesPtesFacturar) {
        $this->UnidadesPtesFacturar = $UnidadesPtesFacturar;
    }

    public function getUnidadesPtesFacturar() {
        return $this->UnidadesPtesFacturar;
    }

    public function setFacturar($Facturar) {
        $this->Facturar = ($Facturar instanceof ValoresSN) ? $Facturar->getPrimaryKeyValue() : $Facturar;
    }

    public function getFacturar() {
        if (!($this->Facturar instanceof ValoresSN)) {
            $this->Facturar = new ValoresSN($this->Facturar);
        }
        return $this->Facturar;
    }

}

// END class AgtPedidosLineas

