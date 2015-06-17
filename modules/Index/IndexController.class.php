<?php

/**
 * Description of IndexController
 *
 * @author info@albatronic.com
 */
class IndexController extends Controller {

    protected $entity = "Index";

    public function __construct($request) {

        // Cargar lo que viene en el request
        $this->request = $request;

        // Cargar la configuracion del modulo (modules/moduloName/config.yml)
        $this->form = new Form($this->entity);

        // Cargar los permisos.
        // Si la entidad no está sujeta a control de permisos, se habilitan todos
        if ($this->form->getPermissionControl()) {
            $this->permisos = ($this->parentEntity == '') ? new ControlAcceso($this->entity) : new ControlAcceso($this->parentEntity);
        } else {
            $this->permisos = new ControlAcceso();
        }

        $this->values['titulo'] = $this->form->getTitle();
        $this->values['ayuda'] = $this->form->getHelpFile();
        $this->values['permisos'] = $this->permisos->getPermisos();
        $this->values['enCurso'] = $this->values['permisos']['enCurso'];
        $this->values['request'] = $this->request;
    }

    public function LoginAction() {

        switch ($this->request["METHOD"]) {
            case 'GET':
                $template = "login.html.twig";
                break;

            case 'POST':
                $usuario = new Usuarios();
                $rows = $usuario->cargaCondicion("Id", "Email='{$this->request['email']}' and Activo='1'");
                $usuario = new Usuarios($rows[0]['Id']);
                if ($usuario->getId()) {
                    if ($usuario->getPassword() !== $this->request['password']) {
                        $this->values['mensaje'] = "Contraseña incorrecta";
                        $template = "login.html.twig";
                    } else {
                        $usuario->logea();
                        $template = "index.html.twig";
                    }
                } else {
                    $this->values['mensaje'] = "No existe ningún usuario con ese email";
                    $template = "login.html.twig";
                }
                break;
        }

        return array(
            'template' => "{$this->entity}/{$template}",
            'values' => $this->values,
        );
    }

    /**
     * Logeo rápido: http://dominio/Index/FastLogin/<token>
     * @return array
     */
    public function FastLoginAction() {

        switch ($this->request["METHOD"]) {
            case 'POST':
                $template = "login.html.twig";
                break;

            case 'GET':
                $usuario = new Usuarios();
                $rows = $usuario->cargaCondicion("Id", "PrimaryKeyMD5='{$this->request[2]}' and Activo='1'");
                $usuario = new Usuarios($rows[0]['Id']);
                if ($usuario->getId()) {
                    $usuario->logea();
                    $template = "index.html.twig";
                } else {
                    $this->values['mensaje'] = "Usuario inexistente o desactivado";
                    $template = "login.html.twig";
                }
                break;
        }

        return array(
            'template' => "{$this->entity}/{$template}",
            'values' => $this->values,
        );
    }

    public function RecordarAction() {

        $email = $this->request['email'];

        $usuario = new Usuarios();
        $rows = $usuario->cargaCondicion("Id", "Email='{$email}' and Activo='1'");
        $usuario = new Usuarios($rows[0]['Id']);

        if ($usuario->getId()) {
            if ($usuario->getPassword()) {
                $password = $usuario->getPassword();
            } else {
                $passw = new Password(6);
                $password = $passw->genera();
                $usuario->setPassword($password);
                $usuario->save();
            }
            $asunto = "Recordatorio de contraseña";
            $mensaje = "Su contraseña para acceder a la intranet es {$password}";
            $mail = new Mail();
            $ok = $mail->send($usuario->getEMail(), $asunto, $mensaje);
            //$ok = true;
            $this->values['mensaje'] = ($ok) ? "Se le ha enviado un correo con la contraseña" : $mail->getMensaje();
        } else {
            $this->values['mensaje'] = "No existe ningún usuario registrado con ese email";
        }
        unset($usuario);

        $this->values['accion'] = "Recordar";

        return array(
            "template" => "{$this->entity}/login.html.twig",
            "values" => $this->values,
        );
    }

    public function LogoutAction() {
        $_SESSION['usuarioPortal'] = array();
        return $this->LoginAction();
    }

    /**
     * Carga en la sesión las variables de entorno y web del proyecto
     */
    protected function cargaVariables() {

        // Variables de entorno del proyecto
        if (!isset($_SESSION['VARIABLES']['EnvPro'])) {
            $variables = new CpanVariables('Pro', 'Env');
            $this->varEnvPro = $variables->getValores();
            $_SESSION['VARIABLES']['EnvPro'] = $this->varEnvPro;
        } else
            $this->varEnvPro = $_SESSION['VARIABLES']['EnvPro'];
        $this->values['varEnvPro'] = $this->varEnvPro;

        // Variables web del proyecto
        if (!isset($_SESSION['VARIABLES']['WebPro'])) {
            $variables = new CpanVariables('Pro', 'Web');
            $this->varWebPro = $variables->getValores();
            $_SESSION['VARIABLES']['WebPro'] = $this->varWebPro;
        } else
            $this->varWebPro = $_SESSION['VARIABLES']['WebPro'];
        $this->values['varWebPro'] = $this->varWebPro;

        unset($variables);
    }

    public function importarAction() {

        $this->importClientes();
        $this->importFirmas();
        $this->importRutas();
        $this->importGruposCompras();
    }

    private function importGruposCompras() {
        
        $file = getcwd() . "/docs/docs1/import/GRUPO_COMPRAS.txt";
        $array = $this->leeCsv($file);
        $obj = new GruposCompras();
        $obj->truncate();
        foreach ($array as $item) {
            //print_r($item);
            $obj = new GruposCompras();
            $obj->setId($item['IDGrupo']);
            $obj->setDescripcion(utf8_encode($item['Descripcion']));
            $id = $obj->create();
            if (!$id) {
                print_r($obj->getErrores());
            }
        }          
    }
    
    private function importRutas() {
        
        $file = getcwd() . "/docs/docs1/import/RUTAS.txt";
        $array = $this->leeCsv($file);
        $obj = new Rutas();
        $obj->truncate();
        foreach ($array as $item) {
            //print_r($item);
            $obj = new Rutas();
            $obj->setId($item['IDRUTA']);
            $obj->setDescripcion(utf8_encode($item['NOMBRE']));
            $obj->setObservations(utf8_encode($item['OBSERVACIONES']));
            $id = $obj->create();
            if (!$id) {
                print_r($obj->getErrores());
            }
        }          
    }
    
    private function importFirmas() {
        
        $file = getcwd() . "/docs/docs1/import/FIRMAS.txt";
        $array = $this->leeCsv($file);
        $obj = new Firmas();
        $obj->truncate();
        foreach ($array as $item) {
            //print_r($item);
            $obj = new Firmas();
            $obj->setId($item['IDFIRMA']);
            $obj->setRazonSocial(utf8_encode($item['RAZON_SOCIAL']));
            $obj->setCif($item['NIF']);
            $obj->setDireccion($item['DOMICILIO']);
            $obj->setCodigoPostal($item['COD_POSTAL']);
            $obj->setApdoCorreos($item['APDO_CORREOS']);
            $obj->setTelefono($item['TELEFONOS']);
            $obj->setFax($item['FAX']);
            $obj->setWeb($item['WEB']);            
            $obj->setEmailGerente($item['EMAILGERENTE']);
            $obj->setEmailPedidos($item['EMAILPEDIDOS']);
            $obj->setEmailSoporteTecnico($item['EMAILSOPORTETECNICO']);
            $obj->setGerente(utf8_encode($item['GERENTE']));
            $obj->setDirectorComercial(utf8_encode($item['DIRECTOR COMERCIAL']));
            $obj->setPlazoEntrega($item['PLAZO_ENTREGA']);
            $obj->setSinPortes(utf8_encode($item['SIN PORTES']));
            //$obj->setIdAgencia($item['AGENCIATTE']);
            $obj->setObservations(utf8_encode($item['OBSERVACIONES']));
            $obj->setVigente($item['VIGENTE']);
            $id = $obj->create();
            if (!$id) {
                print_r($obj->getErrores());
            }
        }        
    }
    
    private function importClientes() {
        
        $file = getcwd() . "/docs/docs1/import/CLIENTES.txt";
        $array = $this->leeCsv($file);
        $obj = new Clientes();
        $obj->truncate();
        foreach ($array as $item) {
            //print_r($item);
            $obj = new Clientes();
            $obj->setId($item['IDCLIENTE']);
            $obj->setRazonSocial(utf8_encode($item['RAZONSOCIAL']));
            $obj->setNombreComercial(utf8_encode($item['NOMBRECOMERCIAL']));
            $obj->setCif($item['NIF']);
            $obj->setDireccion($item['DIRECCION']);
            $obj->setCodigoPostal($item['CODPOSTAL']);
            $obj->setApdoCorreos($item['APDOCORREOS']);
            $obj->setTelefono($item['TELEFONOS']);
            $obj->setFax($item['FAX']);
            $obj->setEmail($item['EMAIL']);
            $obj->setWeb($item['WEB']);
            $obj->setBanco($item['BANCO']);
            $obj->setDireccionBanco($item['DIRECCION BANCO']);
            $obj->setIban($item['CUENTA CORRIENTE']);
            $obj->setAvisos($item['OBSERVACIONES']);
            $obj->setVigente($item['VIGENTE']);
            $obj->setCatalogos($item['CATALOGOS']);
            $obj->setIdRuta($item['IDRUTA']);
            $obj->setIdGrupoCompras($item['IDGRUPOCOMPRAS']);
            $id = $obj->create();
            if (!$id) {
                print_r($obj->getErrores());
            }
        }        
    }
    
    private function leeCsv($file) {

        $archivo = new Archivo($file);
        $archivo->setColumnsDelimiter(";");
        $archivo->setColumnsEnclosure("\"");

        $array = array();
        if ($archivo->open()) {
            // Leer la cabecera
            $titulos = $archivo->readLine();
            // Leer el contenido
            $i = -1;
            while ($row = $archivo->readLine()) {
                $i ++;
                foreach ($titulos as $key => $titulo) {
                    $array[$i][$titulo] = $row[$key];
                }
            }
            $archivo->close();
        }
        unset($archivo);
        return $array;
    }

}
