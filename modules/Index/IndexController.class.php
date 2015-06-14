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

        $filename = 'tmp/TiendasVipsFebrero2015.csv';
        $data = array();
        if (file_exists($filename)) {
            if (($handle = fopen($filename, 'r')) !== FALSE) {
                while (($item = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $row['Codigo'] = str_pad($item[0], 4, "0", STR_PAD_LEFT);
                    $row['Nombre'] = utf8_encode($item[1]);
                    $row['Pais'] = "España";
                    $row['Direccion'] = utf8_encode($item[2]);
                    $row['CodigoPostal'] = $item[3];
                    $row['Telefono'] = $item[4];
                    $data[] = $row;
                }
                fclose($handle);
            }
        } else {
            echo "No existe el fichero {$filename}";
        }
        //print_r($data);
        echo sfYaml::dump(array('Sucursales' => $data));
    }

}
