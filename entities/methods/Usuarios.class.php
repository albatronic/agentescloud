<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:06
 */

/**
 * @orm:Entity(Usuarios)
 */
class Usuarios extends UsuariosEntity {

    public function __toString() {
        return ($this->Id) ? $this->Nombre : '';
    }

    public function getNombreApellidos() {
        return $this->Nombre . " " . $this->Apellidos;
    }

    public function logea() {

        //$sucursales = $this->getSucursales();

        // Establece la variable de sesión
        $_SESSION['usuarioPortal'] = array(
            'Id' => $this->getId(),
            'Nombre' => $this->getNombre(),
            'IdPerfil' => $this->getIdPerfil()->getId(),
            'Email' => $this->getEMail(),
            'Menu' => $this->getArrayMenu(),
            //'Sucursales' => $sucursales,
            //'ListaSucursales' => $this->getListaSucursales(),
            //'SucursalActiva' => $sucursales[0],
        );

        // Actualiza el contador de logins
        $usuario = new Usuarios($this->Id);
        $usuario->NLogin ++;
        $usuario->UltimoLogin = date("Y-m-d H:i:s");
        $usuario->save();
        unset($usuario);
    }

    public function getArrayMenu() {
        $menu = $this->getOpciones(0, 0);
        foreach ($menu as $keyOpcion => $opcion) {
            $menu[$keyOpcion]['hijos'] = $this->getOpciones($opcion['Id'], 1);
            // Menu de segundo nivel jerárquico
            //foreach ($menu[$keyOpcion]['hijos'] as $keySubOpcion => $subOpciones) {
            //    $menu[$keyOpcion]['hijos'][$keySubOpcion]['hijos'] = $this->getOpciones($subOpciones['Id'], 2);
            //}
        }

        return $menu;
    }

    public function getOpciones($de, $nivel) {
        $rows = array();
        $em = new EntityManager($this->getConectionName());
        if ($em->getDbLink()) {
            $query = "
                select m.Id,m.CodigoApp,m.Titulo ,p.NombreModulo, p.Funcionalidades, m.Icon
                from {$this->getDataBaseName()}.AgtPermisos as p, {$this->getDataBaseName()}.AgtModulos as m
                where m.NombreModulo = p.NombreModulo and m.BelongsTo='{$de}' and m.Nivel='{$nivel}' and
                p.IdPerfil = '{$this->getIdPerfil()->getId()}' AND
                LOCATE('AC',p.Funcionalidades)
                order by m.Id ASC";
                //echo $query,"<br/>";
            $em->query($query);
            $rows = $em->fetchResult();
        } else {
            echo "NO HAY CONEXION CON LA BASE DE DATOS";
        }
        unset($em);
        return $rows;
    }

    /**
     * Devuelve un array con todas las sucursales
     * a las que tiene acceso el usuario logeado.
     *
     *
     * Si el usuario puede acceder a todas las sucursales y se activa a TRUE
     * el parámetro $opcionTodas, se añade un valor más en el array
     * con la opcion '** Todas **'
     *
     * @param boolean $opcionTodas
     * @return array
    public function getSucursales($opcionTodas = TRUE) {

        if ($this->IdSucursal < 1) {
            //Puede acceder a todas
            $sucursal = new Sucursales();
            $sucursales = $sucursal->cargaCondicion("Id as Id, Nombre as Value","1","Nombre ASC");
            if ($opcionTodas) {
                $sucursales[] = array('Id' => '', 'Value' => '** Todas **');
            }
            unset($sucursal);
        } else {
            //Puede acceder solo a una
            $sucursal = $this->getIdSucursal();
            $sucursales[] = array(
                'Id' => $sucursal->getId(),
                'Value' => $sucursal->getNombre(),
            );
        }
        return $sucursales;
    }
     * 
     */

    /**
     * Devuelve lista separadas por como con los id's
     * de las sucursales a las que tiene acceso
     * 
     * @return string
    public function getListaSucursales() {

        $array = $this->getSucursales(false);

        foreach ($array as $value) {
            $lista .= "{$value['Id']},";
        }
        $lista = substr($lista, 0, -1);

        return $lista;
    }
     * 
     */
    
    /**
     * 
     * @param type $column
     * @param type $default
     * @return string
     */
    public function fetchAll($column = '', $default = true) {

        if ($column == '') {
            $column = $this->Nombre;
        }

        // Filtro para no mostrar al superadmin
        //$filtro = ($_SESSION['usuarioPortal']['Id'] != 1) ? "Id<>'1'" : "1";
        // Si no es administrador, filtro para mostrar solo los usuarios de la tienda en curso
        $filtro = "IdPerfil >= '{$_SESSION['usuarioPortal']['IdPerfil']}'";
        $rows = $this->querySelect($this->getPrimaryKeyName() . " as Id, {$column} as Value", "(Deleted = '0') AND ({$filtro})", "{$column} ASC");

        if ($default == TRUE) {
            array_unshift($rows, array('Id' => '', 'Value' => ':: Indique un Valor'));
        }

        return $rows;
    }

    /**
     * Devuelve array con los usuarios
     * que son responsables (perfiles 2 y 3)
     * 
     * @return array
     */
    public function getResponsables() {

        $rows = $this->querySelect($this->getPrimaryKeyName() . " as Id, Nombre as Value", "Deleted='0' and (IdPerfil=2 or IdPerfil=3)");

        return $rows;
    }

    public function validaLogico() {
        parent::validaLogico();
        //if ($this->IdSucursal == '') {
        //    $this->IdSucursal = NULL;
        //}
    }

    /**
     * Devuelve true/false según el usuario tenga
     * acceso a la sucursal indicada
     * 
     * @param integer $idSucursal
     * @return boolean
    public function tieneAccesoSucursal($idSucursal) {

        $tieneAcceso = false;

        $rows = $this->getSucursales();
        foreach ($rows as $row) {
            if ($idSucursal == $row['Id']) {
                $tieneAcceso = true;
                break;
            }
        }

        return $tieneAcceso;
    }
     * 
     */

}
