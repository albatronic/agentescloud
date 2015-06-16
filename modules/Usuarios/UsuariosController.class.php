<?php

/**
 * CONTROLLER FOR Usuarios
 * @copyright: ALBATRONIC 
 * @date 16.12.2014 22:23:06

 * Extiende a la clase controller
 */
class UsuariosController extends Controller {

    protected $entity = "Usuarios";
    protected $parentEntity = "";

    public function IndexAction() {
        return $this->listAction();
    }

    public function listAction($aditionalFilter = '') {

        // Si el usuario no es el super, no muestro al super
        $filtroUsuario = ($_SESSION['usuarioPortal']['IdPerfil'] <> 1) ? "(Id<>1)" : "(1)";

        if ($aditionalFilter != '') {
            $aditionalFilter .= " and ";
        }
        $aditionalFilter .= "{$filtroUsuario}";

        return parent::listAction($aditionalFilter);
    }

    public function listadoAction($aditionalFilter = '') {

        // Si el usuario no es el super, no muestro al super
        $filtroUsuario = ($_SESSION['usuarioPortal']['IdPerfil'] <> 1) ? "(Id<>1)" : "(1)";

        if ($aditionalFilter != '') {
            $aditionalFilter .= " and ";
        }
        $aditionalFilter .= "{$filtroUsuario}";

        return parent::listadoAction($aditionalFilter);
    }

    public function exportarAction($aditionalFilter = '') {
        
        // Si el usuario no es el super, no muestro al super
        $filtroUsuario = ($_SESSION['usuarioPortal']['IdPerfil'] <> 1) ? "(Id<>1)" : "(1)";

        if ($aditionalFilter != '') {
            $aditionalFilter .= " and ";
        }
        $aditionalFilter .= "{$filtroUsuario}";

        return parent::exportarAction($aditionalFilter);
    }

}
