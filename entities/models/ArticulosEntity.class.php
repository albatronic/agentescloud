<?php

/**
 * @copyright ALBATRONIC
 * @date 19.06.2015 21:09:00
 */

/**
 * @orm:Entity(Articulos)
 */
class ArticulosEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Id;

    /**
     * @var entities\Firmas
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdFirma;

    /**
     * @var string
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Codigo;

    /**
     * @var string
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Descripcion;

    /**
     * @var string
     */
    protected $Subtitulo;

    /**
     * @var string
     */
    protected $Resumen;

    /**
     * @var string
     */
    protected $ReclamoCorto;

    /**
     * @var string
     */
    protected $ReclamoLargo;

    /**
     * @var entities\Familias
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdCategoria = '0';

    /**
     * @var entities\Familias
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdFamilia = '0';

    /**
     * @var entities\Familias
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdSubfamilia = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Pvd = '0.000';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Pvp = '0.000';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Margen = '0.000';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Pmc = '0.000';

    /**
     * @var entities\TiposIva
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdIva = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $PvpAnterior = '0.000';

    /**
     * @var string
     */
    protected $Etiqueta;

    /**
     * @var string
     */
    protected $CodigoEAN;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Caducidad = '0';

    /**
     * @var string
     */
    protected $Garantia;

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Peso = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Volumen = '0.00';

    /**
     * @var string
     */
    protected $Caracteristicas;

    /**
     * @var datetime
     */
    protected $FechaUltimoPrecio;

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Vigente = '1';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Inventario = '1';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Trazabilidad = '0';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $BajoPedido = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $PackingCompras = '1.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $PackingVentas = '1.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $Merma = '0.00';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $BloqueoStock = '0';

    /**
     * @var entities\ArticulosEstados
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdEstado1 = '0';

    /**
     * @var entities\ArticulosEstados
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdEstado2 = '0';

    /**
     * @var entities\ArticulosEstados
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdEstado3 = '0';

    /**
     * @var entities\ArticulosEstados
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdEstado4 = '0';

    /**
     * @var entities\ArticulosEstados
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $IdEstado5 = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $StockMinimo = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $StockMaximo = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $MinimoVentaAlto = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $MinimoVentaAncho = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $MinimoVenta = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $MultiploAlto = '0.00';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $MultiploAncho = '0.00';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $RecargoEnergetico = '0';

    /**
     * @var entities\UnidadesMedida
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $UMB = '0';

    /**
     * @var entities\UnidadesMedida
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $UMC = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $CUMC = '1.00';

    /**
     * @var entities\UnidadesMedida
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $UMA = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $CUMA = '1.00';

    /**
     * @var entities\UnidadesMedida
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $UMV = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtArticulos")
     */
    protected $CUMV = '1.00';

    /**
     * @var string
     */
    protected $AvisosPedidos;

    /**
     * @var string
     */
    protected $AvisosPresupuestos;

    /**
     * @var string
     */
    protected $AvisosAlbaranes;

    /**
     * @var string
     */
    protected $AvisosFacturas;

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtArticulos';

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
        'TiposIva',
        'ValoresSN',
        'ArticulosEstados',
        'UnidadesMedida',
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

    public function setCodigo($Codigo) {
        $this->Codigo = trim($Codigo);
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = trim($Descripcion);
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setSubtitulo($Subtitulo) {
        $this->Subtitulo = trim($Subtitulo);
    }

    public function getSubtitulo() {
        return $this->Subtitulo;
    }

    public function setResumen($Resumen) {
        $this->Resumen = trim($Resumen);
    }

    public function getResumen() {
        return $this->Resumen;
    }

    public function setReclamoCorto($ReclamoCorto) {
        $this->ReclamoCorto = trim($ReclamoCorto);
    }

    public function getReclamoCorto() {
        return $this->ReclamoCorto;
    }

    public function setReclamoLargo($ReclamoLargo) {
        $this->ReclamoLargo = trim($ReclamoLargo);
    }

    public function getReclamoLargo() {
        return $this->ReclamoLargo;
    }

    public function setIdCategoria($IdCategoria) {
        $this->IdCategoria = ($IdCategoria instanceof Familias) ? $IdCategoria->getPrimaryKeyValue() : $IdCategoria;
    }

    public function getIdCategoria() {
        if (!($this->IdCategoria instanceof Familias)) {
            $this->IdCategoria = new Familias($this->IdCategoria);
        }
        return $this->IdCategoria;
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

    public function setIdSubfamilia($IdSubfamilia) {
        $this->IdSubfamilia = ($IdSubfamilia instanceof Familias) ? $IdSubfamilia->getPrimaryKeyValue() : $IdSubfamilia;
    }

    public function getIdSubfamilia() {
        if (!($this->IdSubfamilia instanceof Familias)) {
            $this->IdSubfamilia = new Familias($this->IdSubfamilia);
        }
        return $this->IdSubfamilia;
    }

    public function setPvd($Pvd) {
        $this->Pvd = $Pvd;
    }

    public function getPvd() {
        return $this->Pvd;
    }

    public function setPvp($Pvp) {
        $this->Pvp = $Pvp;
    }

    public function getPvp() {
        return $this->Pvp;
    }

    public function setMargen($Margen) {
        $this->Margen = $Margen;
    }

    public function getMargen() {
        return $this->Margen;
    }

    public function setPmc($Pmc) {
        $this->Pmc = $Pmc;
    }

    public function getPmc() {
        return $this->Pmc;
    }

    public function setIdIva($IdIva) {
        $this->IdIva = ($IdIva instanceof TiposIva) ? $IdIva->getPrimaryKeyValue() : $IdIva;
    }

    public function getIdIva() {
        if (!($this->IdIva instanceof TiposIva)) {
            $this->IdIva = new TiposIva($this->IdIva);
        }
        return $this->IdIva;
    }

    public function setPvpAnterior($PvpAnterior) {
        $this->PvpAnterior = $PvpAnterior;
    }

    public function getPvpAnterior() {
        return $this->PvpAnterior;
    }

    public function setEtiqueta($Etiqueta) {
        $this->Etiqueta = trim($Etiqueta);
    }

    public function getEtiqueta() {
        return $this->Etiqueta;
    }

    public function setCodigoEAN($CodigoEAN) {
        $this->CodigoEAN = trim($CodigoEAN);
    }

    public function getCodigoEAN() {
        return $this->CodigoEAN;
    }

    public function setCaducidad($Caducidad) {
        $this->Caducidad = $Caducidad;
    }

    public function getCaducidad() {
        return $this->Caducidad;
    }

    public function setGarantia($Garantia) {
        $this->Garantia = trim($Garantia);
    }

    public function getGarantia() {
        return $this->Garantia;
    }

    public function setPeso($Peso) {
        $this->Peso = $Peso;
    }

    public function getPeso() {
        return $this->Peso;
    }

    public function setVolumen($Volumen) {
        $this->Volumen = $Volumen;
    }

    public function getVolumen() {
        return $this->Volumen;
    }

    public function setCaracteristicas($Caracteristicas) {
        $this->Caracteristicas = trim($Caracteristicas);
    }

    public function getCaracteristicas() {
        return $this->Caracteristicas;
    }

    public function setFechaUltimoPrecio($FechaUltimoPrecio) {
        $this->FechaUltimoPrecio = $FechaUltimoPrecio;
    }

    public function getFechaUltimoPrecio() {
        return $this->FechaUltimoPrecio;
    }

    public function setVigente($Vigente) {
        $this->Vigente = ($Vigente instanceof ValoresSN) ? $Vigente->getPrimaryKeyValue() : $Vigente;
    }

    public function getVigente() {
        if (!($this->Vigente instanceof ValoresSN)) {
            $this->Vigente = new ValoresSN($this->Vigente);
        }
        return $this->Vigente;
    }

    public function setInventario($Inventario) {
        $this->Inventario = ($Inventario instanceof ValoresSN) ? $Inventario->getPrimaryKeyValue() : $Inventario;
    }

    public function getInventario() {
        if (!($this->Inventario instanceof ValoresSN)) {
            $this->Inventario = new ValoresSN($this->Inventario);
        }
        return $this->Inventario;
    }

    public function setTrazabilidad($Trazabilidad) {
        $this->Trazabilidad = ($Trazabilidad instanceof ValoresSN) ? $Trazabilidad->getPrimaryKeyValue() : $Trazabilidad;
    }

    public function getTrazabilidad() {
        if (!($this->Trazabilidad instanceof ValoresSN)) {
            $this->Trazabilidad = new ValoresSN($this->Trazabilidad);
        }
        return $this->Trazabilidad;
    }

    public function setBajoPedido($BajoPedido) {
        $this->BajoPedido = ($BajoPedido instanceof ValoresSN) ? $BajoPedido->getPrimaryKeyValue() : $BajoPedido;
    }

    public function getBajoPedido() {
        if (!($this->BajoPedido instanceof ValoresSN)) {
            $this->BajoPedido = new ValoresSN($this->BajoPedido);
        }
        return $this->BajoPedido;
    }

    public function setPackingCompras($PackingCompras) {
        $this->PackingCompras = $PackingCompras;
    }

    public function getPackingCompras() {
        return $this->PackingCompras;
    }

    public function setPackingVentas($PackingVentas) {
        $this->PackingVentas = $PackingVentas;
    }

    public function getPackingVentas() {
        return $this->PackingVentas;
    }

    public function setMerma($Merma) {
        $this->Merma = $Merma;
    }

    public function getMerma() {
        return $this->Merma;
    }

    public function setBloqueoStock($BloqueoStock) {
        $this->BloqueoStock = ($BloqueoStock instanceof ValoresSN) ? $BloqueoStock->getPrimaryKeyValue() : $BloqueoStock;
    }

    public function getBloqueoStock() {
        if (!($this->BloqueoStock instanceof ValoresSN)) {
            $this->BloqueoStock = new ValoresSN($this->BloqueoStock);
        }
        return $this->BloqueoStock;
    }

    public function setIdEstado1($IdEstado1) {
        $this->IdEstado1 = ($IdEstado1 instanceof ArticulosEstados) ? $IdEstado1->getPrimaryKeyValue() : $IdEstado1;
    }

    public function getIdEstado1() {
        if (!($this->IdEstado1 instanceof ArticulosEstados)) {
            $this->IdEstado1 = new ArticulosEstados($this->IdEstado1);
        }
        return $this->IdEstado1;
    }

    public function setIdEstado2($IdEstado2) {
        $this->IdEstado2 = ($IdEstado2 instanceof ArticulosEstados) ? $IdEstado2->getPrimaryKeyValue() : $IdEstado2;
    }

    public function getIdEstado2() {
        if (!($this->IdEstado2 instanceof ArticulosEstados)) {
            $this->IdEstado2 = new ArticulosEstados($this->IdEstado2);
        }
        return $this->IdEstado2;
    }

    public function setIdEstado3($IdEstado3) {
        $this->IdEstado3 = ($IdEstado3 instanceof ArticulosEstados) ? $IdEstado3->getPrimaryKeyValue() : $IdEstado3;
    }

    public function getIdEstado3() {
        if (!($this->IdEstado3 instanceof ArticulosEstados)) {
            $this->IdEstado3 = new ArticulosEstados($this->IdEstado3);
        }
        return $this->IdEstado3;
    }

    public function setIdEstado4($IdEstado4) {
        $this->IdEstado4 = ($IdEstado4 instanceof ArticulosEstados) ? $IdEstado4->getPrimaryKeyValue() : $IdEstado4;
    }

    public function getIdEstado4() {
        if (!($this->IdEstado4 instanceof ArticulosEstados)) {
            $this->IdEstado4 = new ArticulosEstados($this->IdEstado4);
        }
        return $this->IdEstado4;
    }

    public function setIdEstado5($IdEstado5) {
        $this->IdEstado5 = ($IdEstado5 instanceof ArticulosEstados) ? $IdEstado5->getPrimaryKeyValue() : $IdEstado5;
    }

    public function getIdEstado5() {
        if (!($this->IdEstado5 instanceof ArticulosEstados)) {
            $this->IdEstado5 = new ArticulosEstados($this->IdEstado5);
        }
        return $this->IdEstado5;
    }

    public function setStockMinimo($StockMinimo) {
        $this->StockMinimo = $StockMinimo;
    }

    public function getStockMinimo() {
        return $this->StockMinimo;
    }

    public function setStockMaximo($StockMaximo) {
        $this->StockMaximo = $StockMaximo;
    }

    public function getStockMaximo() {
        return $this->StockMaximo;
    }

    public function setMinimoVentaAlto($MinimoVentaAlto) {
        $this->MinimoVentaAlto = $MinimoVentaAlto;
    }

    public function getMinimoVentaAlto() {
        return $this->MinimoVentaAlto;
    }

    public function setMinimoVentaAncho($MinimoVentaAncho) {
        $this->MinimoVentaAncho = $MinimoVentaAncho;
    }

    public function getMinimoVentaAncho() {
        return $this->MinimoVentaAncho;
    }

    public function setMinimoVenta($MinimoVenta) {
        $this->MinimoVenta = $MinimoVenta;
    }

    public function getMinimoVenta() {
        return $this->MinimoVenta;
    }

    public function setMultiploAlto($MultiploAlto) {
        $this->MultiploAlto = $MultiploAlto;
    }

    public function getMultiploAlto() {
        return $this->MultiploAlto;
    }

    public function setMultiploAncho($MultiploAncho) {
        $this->MultiploAncho = $MultiploAncho;
    }

    public function getMultiploAncho() {
        return $this->MultiploAncho;
    }

    public function setRecargoEnergetico($RecargoEnergetico) {
        $this->RecargoEnergetico = ($RecargoEnergetico instanceof ValoresSN) ? $RecargoEnergetico->getPrimaryKeyValue() : $RecargoEnergetico;
    }

    public function getRecargoEnergetico() {
        if (!($this->RecargoEnergetico instanceof ValoresSN)) {
            $this->RecargoEnergetico = new ValoresSN($this->RecargoEnergetico);
        }
        return $this->RecargoEnergetico;
    }

    public function setUMB($UMB) {
        $this->UMB = ($UMB instanceof UnidadesMedida) ? $UMB->getPrimaryKeyValue() : $UMB;
    }

    public function getUMB() {
        if (!($this->UMB instanceof UnidadesMedida)) {
            $this->UMB = new UnidadesMedida($this->UMB);
        }
        return $this->UMB;
    }

    public function setUMC($UMC) {
        $this->UMC = ($UMC instanceof UnidadesMedida) ? $UMC->getPrimaryKeyValue() : $UMC;
    }

    public function getUMC() {
        if (!($this->UMC instanceof UnidadesMedida)) {
            $this->UMC = new UnidadesMedida($this->UMC);
        }
        return $this->UMC;
    }

    public function setCUMC($CUMC) {
        $this->CUMC = $CUMC;
    }

    public function getCUMC() {
        return $this->CUMC;
    }

    public function setUMA($UMA) {
        $this->UMA = ($UMA instanceof UnidadesMedida) ? $UMA->getPrimaryKeyValue() : $UMA;
    }

    public function getUMA() {
        if (!($this->UMA instanceof UnidadesMedida)) {
            $this->UMA = new UnidadesMedida($this->UMA);
        }
        return $this->UMA;
    }

    public function setCUMA($CUMA) {
        $this->CUMA = $CUMA;
    }

    public function getCUMA() {
        return $this->CUMA;
    }

    public function setUMV($UMV) {
        $this->UMV = ($UMV instanceof UnidadesMedida) ? $UMV->getPrimaryKeyValue() : $UMV;
    }

    public function getUMV() {
        if (!($this->UMV instanceof UnidadesMedida)) {
            $this->UMV = new UnidadesMedida($this->UMV);
        }
        return $this->UMV;
    }

    public function setCUMV($CUMV) {
        $this->CUMV = $CUMV;
    }

    public function getCUMV() {
        return $this->CUMV;
    }

    public function setAvisosPedidos($AvisosPedidos) {
        $this->AvisosPedidos = trim($AvisosPedidos);
    }

    public function getAvisosPedidos() {
        return $this->AvisosPedidos;
    }

    public function setAvisosPresupuestos($AvisosPresupuestos) {
        $this->AvisosPresupuestos = trim($AvisosPresupuestos);
    }

    public function getAvisosPresupuestos() {
        return $this->AvisosPresupuestos;
    }

    public function setAvisosAlbaranes($AvisosAlbaranes) {
        $this->AvisosAlbaranes = trim($AvisosAlbaranes);
    }

    public function getAvisosAlbaranes() {
        return $this->AvisosAlbaranes;
    }

    public function setAvisosFacturas($AvisosFacturas) {
        $this->AvisosFacturas = trim($AvisosFacturas);
    }

    public function getAvisosFacturas() {
        return $this->AvisosFacturas;
    }

}

// END class AgtArticulos

