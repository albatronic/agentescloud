<?php

/**
 * @copyright ALBATRONIC
 * @date 16.12.2014 22:23:05
 */

/**
 * @orm:Entity(Perfiles)
 */
class Perfiles extends PerfilesEntity {

    public function __toString() {
        return ($this->Id) ? $this->Perfil : '';
    }

    public function fetchAll($column = '', $default = true) {

        if ($column == '') {
            $column = $this->Nombre;
        }

        // Filtro para no mostrar el perfil de superadministrador
        $filtro = ($_SESSION['usuarioPortal']['Id'] != 1) ? "(Id<>'1')" : "(1)";
        // Filtro para mostrar solo los perfiles de menor rango que
        // el del usuario actual
        $filtro .= " and (Id>'{$_SESSION['usuarioPortal']['IdPerfil']}')";

        $this->conecta();

        if (is_resource($this->_dbLink)) {
            $query = "SELECT " . $this->getPrimaryKeyName() . " as Id, $column as Value FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE (Deleted = '0') AND ($filtro) ORDER BY $column ASC";
            $this->_em->query($query);
            //echo $query;
            $rows = $this->_em->fetchResult();
            $this->setStatus($this->_em->numRows());
        }

        if ($default == TRUE) {
            array_unshift($rows, array('Id' => '', 'Value' => ':: Indique un Valor'));
        }

        return $rows;
    }

}
