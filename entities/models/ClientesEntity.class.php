<?php

/**
 * @copyright ALBATRONIC
 * @date 14.06.2015 19:52:04
 */

/**
 * @orm:Entity(Clientes)
 */
class ClientesEntity extends EntityComunes {

    /**
     * @orm GeneratedValue
     * @orm Id
     * @var integer
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Id;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $RazonSocial;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $NombreComercial;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Cif;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Direccion;

    /**
     * @var entities\Paises
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdPais = '68';

    /**
     * @var entities\Provincias
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdProvincia = '0';

    /**
     * @var entities\Municipios
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdPoblacion = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $CodigoPostal;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $ApdoCorreos;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Telefono;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Fax;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Movil;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $EMail;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Web;

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $CContable;

    /**
     * @var entities\Rutas
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdRuta = '0';

    /**
     * @var entities\Actividades
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdActividad = '0';

    /**
     * @var entities\GruposCompras
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdGrupoCompras = '0';

    /**
     * @var entities\FormasPago
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $IdFormaPago = '0';

    /**
     * @var integer
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $DiaDePago = '0';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Iva = '0';

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $RecargoEqu = '0';

    /**
     * @var string
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Avisos;

    /**
     * @var entities\ValoresSN
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Vigente = '0';

    /**
     * @var entities\Sexos
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Sexo = '1';

    /**
     * @var entities\Tratamientos
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $Tratamiento = '1';

    /**
     * @var date
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $FechaNacimiento = '0000-00-00';

    /**
     * @var string
     */
    protected $Login;

    /**
     * @var string
     */
    protected $Password;

    /**
     * @var integer
     */
    protected $Catalogos;

    /**
     * @var string
     */
    protected $Banco;

    /**
     * @var string
     */
    protected $DireccionBanco;

    /**
     * @var string
     */
    protected $Iban;

    /**
     * @var string
     */
    protected $Bic;

    /**
     * @var string
     */
    protected $Mandato;

    /**
     * @var date
     * @assert NotBlank(groups="AgtClientes")
     */
    protected $FechaMandato = '0000-00-00';

    /**
     * Nombre de la conexion a la BD
     * @var string
     */
    protected $_conectionName = 'datos';

    /**
     * Nombre de la tabla física
     * @var string
     */
    protected $_tableName = 'AgtClientes';

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
        'Paises',
        'Provincias',
        'Municipios',
        'Rutas',
        'Actividades',
        'GruposCompras',
        'FormasPago',
        'ValoresSN',
        'Sexos',
        'Tratamientos',
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

    public function setRazonSocial($RazonSocial) {
        $this->RazonSocial = trim($RazonSocial);
    }

    public function getRazonSocial() {
        return $this->RazonSocial;
    }

    public function setNombreComercial($NombreComercial) {
        $this->NombreComercial = trim($NombreComercial);
    }

    public function getNombreComercial() {
        return $this->NombreComercial;
    }

    public function setCif($Cif) {
        $this->Cif = trim($Cif);
    }

    public function getCif() {
        return $this->Cif;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = trim($Direccion);
    }

    public function getDireccion() {
        return $this->Direccion;
    }

    public function setIdPais($IdPais) {
        $this->IdPais = ($IdPais instanceof Paises) ? $IdPais->getPrimaryKeyValue() : $IdPais;
    }

    public function getIdPais() {
        if (!($this->IdPais instanceof Paises)) {
            $this->IdPais = new Paises($this->IdPais);
        }
        return $this->IdPais;
    }

    public function setIdProvincia($IdProvincia) {
        $this->IdProvincia = ($IdProvincia instanceof Provincias) ? $IdProvincia->getPrimaryKeyValue() : $IdProvincia;
    }

    public function getIdProvincia() {
        if (!($this->IdProvincia instanceof Provincias)) {
            $this->IdProvincia = new Provincias($this->IdProvincia);
        }
        return $this->IdProvincia;
    }

    public function setIdPoblacion($IdPoblacion) {
        $this->IdPoblacion = ($IdPoblacion instanceof Municipios) ? $IdPoblacion->getPrimaryKeyValue() : $IdPoblacion;
    }

    public function getIdPoblacion() {
        if (!($this->IdPoblacion instanceof Municipios)) {
            $this->IdPoblacion = new Municipios($this->IdPoblacion);
        }
        return $this->IdPoblacion;
    }

    public function setCodigoPostal($CodigoPostal) {
        $this->CodigoPostal = trim($CodigoPostal);
    }

    public function getCodigoPostal() {
        return $this->CodigoPostal;
    }

    public function setApdoCorreos($ApdoCorreos) {
        $this->ApdoCorreos = trim($ApdoCorreos);
    }

    public function getApdoCorreos() {
        return $this->ApdoCorreos;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = trim($Telefono);
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function setFax($Fax) {
        $this->Fax = trim($Fax);
    }

    public function getFax() {
        return $this->Fax;
    }

    public function setMovil($Movil) {
        $this->Movil = trim($Movil);
    }

    public function getMovil() {
        return $this->Movil;
    }

    public function setEMail($EMail) {
        $this->EMail = trim($EMail);
    }

    public function getEMail() {
        return $this->EMail;
    }

    public function setWeb($Web) {
        $this->Web = trim($Web);
    }

    public function getWeb() {
        return $this->Web;
    }

    public function setCContable($CContable) {
        $this->CContable = trim($CContable);
    }

    public function getCContable() {
        return $this->CContable;
    }

    public function setIdRuta($IdRuta) {
        $this->IdRuta = ($IdRuta instanceof Rutas) ? $IdRuta->getPrimaryKeyValue() : $IdRuta;
    }

    public function getIdRuta() {
        if (!($this->IdRuta instanceof Rutas)) {
            $this->IdRuta = new Rutas($this->IdRuta);
        }
        return $this->IdRuta;
    }

    public function setIdActividad($IdActividad) {
        $this->IdActividad = ($IdActividad instanceof Actividades) ? $IdActividad->getPrimaryKeyValue() : $IdActividad;
    }

    public function getIdActividad() {
        if (!($this->IdActividad instanceof Actividades)) {
            $this->IdActividad = new Actividades($this->IdActividad);
        }
        return $this->IdActividad;
    }

    public function setIdGrupoCompras($IdGrupoCompras) {
        $this->IdGrupoCompras = ($IdGrupoCompras instanceof GruposCompras) ? $IdGrupoCompras->getPrimaryKeyValue() : $IdGrupoCompras;
    }

    public function getIdGrupoCompras() {
        if (!($this->IdGrupoCompras instanceof GruposCompras)) {
            $this->IdGrupoCompras = new GruposCompras($this->IdGrupoCompras);
        }
        return $this->IdGrupoCompras;
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

    public function setDiaDePago($DiaDePago) {
        $this->DiaDePago = $DiaDePago;
    }

    public function getDiaDePago() {
        return $this->DiaDePago;
    }

    public function setIva($Iva) {
        $this->Iva = ($Iva instanceof ValoresSN) ? $Iva->getPrimaryKeyValue() : $Iva;
    }

    public function getIva() {
        if (!($this->Iva instanceof ValoresSN)) {
            $this->Iva = new ValoresSN($this->Iva);
        }
        return $this->Iva;
    }

    public function setRecargoEqu($RecargoEqu) {
        $this->RecargoEqu = ($RecargoEqu instanceof ValoresSN) ? $RecargoEqu->getPrimaryKeyValue() : $RecargoEqu;
    }

    public function getRecargoEqu() {
        if (!($this->RecargoEqu instanceof ValoresSN)) {
            $this->RecargoEqu = new ValoresSN($this->RecargoEqu);
        }
        return $this->RecargoEqu;
    }

    public function setAvisos($Avisos) {
        $this->Avisos = trim($Avisos);
    }

    public function getAvisos() {
        return $this->Avisos;
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

    public function setSexo($Sexo) {
        $this->Sexo = ($Sexo instanceof Sexos) ? $Sexo->getPrimaryKeyValue() : $Sexo;
    }

    public function getSexo() {
        if (!($this->Sexo instanceof Sexos)) {
            $this->Sexo = new Sexos($this->Sexo);
        }
        return $this->Sexo;
    }

    public function setTratamiento($Tratamiento) {
        $this->Tratamiento = ($Tratamiento instanceof Tratamientos) ? $Tratamiento->getPrimaryKeyValue() : $Tratamiento;
    }

    public function getTratamiento() {
        if (!($this->Tratamiento instanceof Tratamientos)) {
            $this->Tratamiento = new Tratamientos($this->Tratamiento);
        }
        return $this->Tratamiento;
    }

    public function setFechaNacimiento($FechaNacimiento) {
        $date = new Fecha($FechaNacimiento);
        $this->FechaNacimiento = $date->getFecha();
        unset($date);
    }

    public function getFechaNacimiento() {
        $date = new Fecha($this->FechaNacimiento);
        $ddmmaaaa = $date->getddmmaaaa();
        unset($date);
        return $ddmmaaaa;
    }

    public function setLogin($Login) {
        $this->Login = trim($Login);
    }

    public function getLogin() {
        return $this->Login;
    }

    public function setPassword($Password) {
        $this->Password = trim($Password);
    }

    public function getPassword() {
        return $this->Password;
    }

    public function setCatalogos($Catalogos) {
        $this->Catalogos = $Catalogos;
    }

    public function getCatalogos() {
        return $this->Catalogos;
    }

    public function setBanco($Banco) {
        $this->Banco = trim($Banco);
    }

    public function getBanco() {
        return $this->Banco;
    }

    public function setDireccionBanco($DireccionBanco) {
        $this->DireccionBanco = trim($DireccionBanco);
    }

    public function getDireccionBanco() {
        return $this->DireccionBanco;
    }

    public function setIban($Iban) {
        $this->Iban = trim($Iban);
    }

    public function getIban() {
        return $this->Iban;
    }

    public function setBic($Bic) {
        $this->Bic = trim($Bic);
    }

    public function getBic() {
        return $this->Bic;
    }

    public function setMandato($Mandato) {
        $this->Mandato = trim($Mandato);
    }

    public function getMandato() {
        return $this->Mandato;
    }

    public function setFechaMandato($FechaMandato) {
        $date = new Fecha($FechaMandato);
        $this->FechaMandato = $date->getFecha();
        unset($date);
    }

    public function getFechaMandato() {
        $date = new Fecha($this->FechaMandato);
        $ddmmaaaa = $date->getddmmaaaa();
        unset($date);
        return $ddmmaaaa;
    }

}

// END class AgtClientes

