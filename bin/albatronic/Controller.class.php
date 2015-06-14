<?php

/**
 * Description of Controller
 *
 * Controlador común a todos los módulos del Erp
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @date 24-agosto-2012 19:39
 */
class Controller {

    /**
     * Variables enviadas en el request por POST o por GET
     * @var array
     */
    protected $request;

    /**
     * Objeto de la clase 'form' con las propiedades y métodos
     * del formulario obtenidos del fichero de configuracion
     * del formulario en curso
     * @var array
     */
    protected $form;

    /**
     * Valores a devolver al controlador principal para
     * que los renderice con el twig correspondiente
     * @var array
     */
    protected $values;

    /**
     * Objeto de la clase 'controlAcceso'
     * para gestionar los permisos de acceso a los métodos del controller
     * @var ControlAcceso
     */
    protected $permisos;

    /**
     * String con el nombre de la app a la que pertenece el módulo
     * @var string
     */
    protected $app;

    /**
     * Array de entidades enlazables a la actual
     * @var array
     */
    protected $enlazarCon = array();

    /**
     * Array con las variables Web del modulo
     * @var array
     */
    protected $varWebMod;

    /**
     * Array con las variables de entorno del modulo
     * @var array
     */
    protected $varEnvMod;

    /**
     * Array con las variables Web de la app
     * @var array
     */
    protected $varWebApp;

    /**
     * Array con las variables de entorno de la app
     * @var array
     */
    protected $varEnvApp;

    /**
     * Array con las variables de entorno del proyecto
     * @var array
     */
    protected $varEnvPro;

    /**
     * Array con las variables web del proyecto
     * @var array
     */
    protected $varWebPro;

    public function __construct($request) {

        if ($this->entity == '') {
            $this->entity = str_replace('Controller', '', get_class($this));
        }

        // Cargar lo que viene en el request, incluidos los eventuales
        // ficheros a subir
        $this->request = $request;

        // Cargar la configuracion del modulo (modules/moduloName/config.yml)
        $this->form = new Form($this->entity);

        // Pongo la app a la que pertenece
        $this->app = $this->form->getNode('app');

        // Instanciar el objeto listado con los parametros del modulo
        // y los eventuales valores del filtro enviados en el request
        if ($this->form->getTieneListado()) {
            $this->listado = new Listado($this->form, $this->request);
            $this->values['listado'] = array(
                'filter' => $this->listado->getFilter(),
            );
        }

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
        $this->values['tieneListado'] = $this->form->getTieneListado();
        $this->values['request'] = $this->request;
        $this->values['linkBy'] = array(
            'id' => $this->form->getLinkBy(),
            'value' => '',
        );

        // Cargas las variables
        $this->cargaVariables();

        $this->values['atributos'] = $this->form->getAtributos($this->entity); //$this->values['permisos']['enCurso']['modulo']);
        // Poner la solapa activa del formulario
        $this->values['solapaActiva'] = (!isset($this->request['solapaActiva'])) ? '0' : $this->request['solapaActiva'];
        // Poner el acordeon activo de los campos comunes
        $this->values['acordeonActivo'] = (!isset($this->request['acordeonActivo'])) ? '0' : $this->request['acordeonActivo'];

        // Registrar en el archivo log
        if ($_SESSION['debug']['access_log']) {
            Log::write($this->request);
        }
    }

    public function IndexAction() {

        if ($this->values['permisos']['permisosModulo']['AC']) {
            $template = $this->entity . "/index.html.twig";
        } else {
            $template = "_global/forbiden.html.twig";
        }

        return array(
            'template' => $template,
            'values' => $this->values,
        );
    }

    /**
     * Edita, actualiza o borrar un registro
     *
     * Si viene por GET es editar
     * Si viene por POST puede ser actualizar o borrar
     * según el valor de $this->request['accion']
     *
     * @return array con el template y valores a renderizar
     */
    public function editAction() {

        switch ($this->request["METHOD"]) {

            case 'GET':
                if ($this->values['permisos']['permisosModulo']['CO']) {
                    //SI EN LA POSICION 3 DEL REQUEST VIENE ALGO,
                    //SE ENTIENDE QUE ES EL VALOR DE LA CLAVE PARA LINKAR CON LA ENTIDAD PADRE
                    //ESTO SE UTILIZA PARA LOS FORMULARIOS PADRE->HIJO
                    if ($this->request['3'] != '')
                        $this->values['linkBy']['value'] = $this->request['3'];

                    //MOSTRAR DATOS. El ID viene en la posicion 2 del request
                    $datos = new $this->entity();
                    $datos = $datos->find('PrimaryKeyMD5', $this->request[2]);
                    if ($datos->getStatus()) {
                        $this->values['datos'] = $datos;
                        $this->values['errores'] = $datos->getErrores();
                    } else {
                        $this->values['errores'] = array("Valor no encontrado. El objeto que busca no existe. Es posible que haya sido eliminado por otro usuario.");
                    }
                    $template = $this->entity . '/edit.html.twig';
                } else {
                    $template = '_global/forbiden.html.twig';
                }

                return array('template' => $template, 'values' => $this->values);
                break;

            case 'POST':
                //COGER DEL REQUEST EL LINK A LA ENTIDAD PADRE
                if ($this->values['linkBy']['id'] != '') {
                    $this->values['linkBy']['value'] = $this->request[$this->entity][$this->values['linkBy']['id']];
                }

                switch ($this->request['accion']) {
                    case 'Guardar': //GUARDAR DATOS
                        if ($this->values['permisos']['permisosModulo']['UP']) {
                            // Cargo la entidad
                            $datos = new $this->entity($this->request[$this->entity][$this->form->getPrimaryKey()]);
                            // Vuelco los datos del request
                            $datos->bind($this->request[$this->entity]);

                            $rules = $this->form->getRules();
                            if ($datos->valida($rules)) {
                                $this->values['alertas'] = $datos->getAlertas();
                                if (!$datos->save()) {
                                    $this->values['errores'] = $datos->getErrores();
                                }

                                //Recargo el objeto para refrescar las propiedas que
                                //hayan podido ser objeto de algun calculo durante el proceso
                                //de guardado.
                                $datos = new $this->entity($this->request[$this->entity][$datos->getPrimaryKeyName()]);
                            } else {
                                $this->values['errores'] = $datos->getErrores();
                                $this->values['alertas'] = $datos->getAlertas();
                            }
                            $this->values['datos'] = $datos;
                            return array('template' => $this->entity . '/edit.html.twig', 'values' => $this->values);
                        } else {
                            return array('template' => '_global/forbiden.html.twig', 'values' => $this->values);
                        }
                        break;

                    case 'Borrar': //MARCA EL OBJETO COMO BORRADO, PERO NO BORRA FÍSICAMENTE
                        if ($this->values['permisos']['permisosModulo']['DE']) {
                            $datos = new $this->entity($this->request[$this->entity][$this->form->getPrimaryKey()]);
                            $primaryKey = $datos->getPrimaryKeyValue();
                            if ($datos->erase()) {
                                $datos = new $this->entity();
                                $this->values['datos'] = $datos;
                                $this->values['errores'] = array();
                                unset($datos);
                                return array('template' => $this->entity . '/new.html.twig', 'values' => $this->values);
                            } else {
                                $this->values['datos'] = $datos;
                                $this->values['errores'] = $datos->getErrores();
                                $this->values['alertas'] = $datos->getAlertas();
                                unset($datos);
                                return array('template' => $this->entity . '/edit.html.twig', 'values' => $this->values);
                            }
                        } else {
                            return array('template' => '_global/forbiden.html.twig', 'values' => $this->values);
                        }
                        break;
                }
                break;
        }
    }

    /**
     * Crea un registro nuevo
     *
     * Si viene por GET muestra un template vacio
     * Si viene por POST crea un registro
     *
     * @return array con el template y valores a renderizar
     */
    public function newAction() {

        if ($this->values['permisos']['permisosModulo']['IN']) {

            switch ($this->request["METHOD"]) {
                case 'GET': //MOSTRAR FORMULARIO VACIO                
                    //SI EN LA POSICION 2 DEL REQUEST VIENE ALGO,
                    //SE ENTIENDE QUE ES EL VALOR DE LA CLAVE PARA LINKAR CON LA ENTIDAD PADRE
                    //ESTO SE UTILIZA PARA LOS FORMULARIOS PADRE->HIJO
                    if ($this->request['2'] != '')
                        $this->values['linkBy']['value'] = $this->request['2'];

                    $datos = new $this->entity();
                    $datos->setDefaultValues((array) $this->varEnvMod['columns']);
                    $this->values['datos'] = $datos;
                    $this->values['errores'] = array();
                    $template = $this->entity . '/new.html.twig';
                    break;

                case 'POST': //CREAR NUEVO REGISTRO
                    //COGER EL LINK A LA ENTIDAD PADRE
                    if ($this->values['linkBy']['id'] != '') {
                        $this->values['linkBy']['value'] = $this->request[$this->entity][$this->values['linkBy']['id']];
                    }

                    $datos = new $this->entity();
                    $datos->bind($this->request[$this->entity]);

                    $rules = $this->form->getRules();

                    if ($datos->valida($rules)) {
                        $lastId = $datos->create();

                        $this->values['errores'] = $datos->getErrores();
                        $this->values['alertas'] = $datos->getAlertas();

                        //Recargo el objeto para refrescar las propiedades que
                        //hayan podido ser objeto de algun calculo durante el proceso
                        //de guardado
                        if ($lastId) {
                            $datos = new $this->entity($lastId);
                        }
                        $this->values['datos'] = $datos;
                        $template = $this->entity . '/edit.html.twig';
                    } else {
                        $this->values['datos'] = $datos;
                        $this->values['errores'] = $datos->getErrores();
                        $this->values['alertas'] = $datos->getAlertas();
                        $template = $this->entity . '/new.html.twig';
                    }
                    break;
            }
        } else {
            $template = '_global/forbiden.html.twig';
        }

        return array('template' => $template, 'values' => $this->values);
    }

    /**
     * Muestra el template de ayuda asociado al controlador
     * El nombre del template de ayuda está definido en el
     * nodo <help_file> del config.yml del controlador
     * Si no existiera, se muestra un template indicando esta
     * circunstancia
     *
     * @return array con el template a renderizar
     */
    public function helpAction() {
        $template = $this->entity . '/' . $this->form->getHelpFile();
        $file = "modules/" . $template;
        if (!is_file($file) or ( $this->form->getHelpFile() == '')) {
            $template = "_help/noFound.html.twig";
        }

        $values['title'] = $this->form->getTitle();
        $values['idVideo'] = $this->form->getIdVideo();
        $values['urlVideo'] = $this->form->getUrlVideo();

        return array('template' => $template, 'values' => $values);
    }

    /**
     * Genera una listado por pantalla en base al filtro.
     * Puede recibir un filtro adicional
     *
     * @param string $aditionalFilter
     * @return array con el template y valores a renderizar
     */
    public function listAction($aditionalFilter = '') {

        if ($this->values['permisos']['permisosModulo']['CO'] && is_object($this->listado)) {

            $objeto = new $this->entity();
            $tabla = $objeto->getDataBaseName() . "." . $objeto->getTableName();
            unset($objeto);

            if ($aditionalFilter != '') {
                $aditionalFilter .= " AND ";
            }
            $aditionalFilter .= "({$tabla}.Deleted='0')";
            $this->values['listado'] = $this->listado->getAll($aditionalFilter);
            $template = $this->entity . '/list.html.twig';
        } else {
            $template = '_global/forbiden.html.twig';
        }

        return array('template' => $template, 'values' => $this->values);
    }

    /**
     * Genera un listado en formato PDF en base a los parametros obtenidos
     * del fichero listados.yml de cada controlador y los datos filtrados
     * segun el request
     * @return array Template y valores
     */
    public function listadoAction($aditionalFilter = '') {

        if ($this->values['permisos']['permisosModulo']['LI']) {
            // Lee la configuracion del listado
            $formato = new Form($this->entity, 'listados.yml');
            $parametros = $formato->getFormatoListado($this->request['formatoListado']);
            unset($formato);

            $this->values['archivo'] = $this->listado->getPdf($parametros, $aditionalFilter);
            $template = '_global/listadoPdf.html.twig';
        } else {
            $template = "_global/forbiden.html.twig";
        }

        return array('template' => $template, 'values' => $this->values);
    }

    /**
     * Renderiza el documento indicado en $this->values['archivo']
     * @return array Template y valores
     */
    public function imprimirAction() {
        if ($this->values['permisos']['permisosModulo']['LI']) {

            if ($this->request['METHOD'] == 'GET') {
                $idDocumento = $this->request['2'];
                $tipoDocumento = $this->request['3'];
                $formato = $this->request['4'];
            } else {
                $idDocumento = $this->request['idDocumento'];
                $tipoDocumento = $this->request['tipoDocumento'];
                $formato = $this->request['formato'];
            }

            $this->values['archivo'] = $this->generaPdf($tipoDocumento, array('0' => $idDocumento), $formato);
            $template = '_global/documentoPdf.html.twig';
        } else {
            $template = "_global/forbiden.html.twig";
        }

        return array('template' => $template, 'values' => $this->values,);
    }

    /**
     * Enviar por email el documento indicado en $this->values['archivo']
     * @return array Template y valores
     */
    public function enviarAction() {
        return array('template' => $this->entity . '/mail.html.twig', 'values' => $this->values,);
    }

    /**
     * Realiza el proceso de exportación de información en base a
     * los datos que le pasa cada controlador en $this->values['export']
     *
     * Puede generar distintos tipos de archivos (xml, excel).
     * Despues de generar el archivo, muestra un template para descargarlo
     *
     * @return array
     */
    public function exportarAction($aditionalFilter = '') {

        if ($this->values['permisos']['permisosModulo']['EX']) {

            if ($this->values['export']['title'] == '') {
                $this->values['export']['title'] = $this->entity;
            }

            switch ($this->request['exportType']) {
                case 'json':
                    $this->values['export']['file'] = $this->listado->getJson($this->request['formatoListado'], $aditionalFilter);
                    break;
                case 'xml':
                    $this->values['export']['file'] = $this->listado->getXml($this->request['formatoListado'], $aditionalFilter);
                    break;
                case 'xls':
                    $this->values['export']['file'] = $this->listado->getXls($this->request['formatoListado'], $aditionalFilter);
                    break;
                case 'yml':
                    $this->values['export']['file'] = $this->listado->getYaml($this->request['formatoListado'], $aditionalFilter);
                    break;
                case 'csv':
                    $this->values['export']['file'] = $this->listado->getCsv($this->request['formatoListado'], $aditionalFilter);
                    break;
            }

            $template = '_global/exportar.html.twig';
        } else {
            $template = '_global/forbiden.html.twig';
        }
        return array(
            'template' => $template,
            'values' => $this->values,
        );
    }

    /**
     * Genera un documento pdf
     *
     * @param string $tipoDocumento El tipo de documento: albaranes, pedidos, etc.
     * @param array $idsDocumento Array con los ids de la entidad a imprimir. Ej. id de albaran, pedido, etc.
     * @param integer $formato El formato del documento (defecto=0)
     * @return string Nombre del archivo pdf generado con la ruta completa
     */
    protected function generaPdf($tipoDocumento, array $idsDocumento, $formato = 0) {

        // Cargo en un array el archivo de configuracion
        // del tipo de documento y formato
        $config = DocumentoPdf::getConfigFormato($tipoDocumento, $formato);

        // LLamo al método específico de cada controlador para que obtenga
        // la información necesaria del documento.
        // Le paso el array con los ids de documentos (ej: id de albaran, pedido, factura, etc)
        $datos = $this->getDatosDocumento($idsDocumento);

        // CREAR EL DOCUMENTO----------------------------------------------------
        $fichero = Archivo::getTemporalFileName();

        if ($fichero) {
            $pdf = new DocumentoPdf($config['orientation'], $config['unit'], $config['format']);
            $pdf->generaDocumento($config, $datos['master'], $datos['detail'], $fichero);
        }

        return $fichero;
    }

    /**
     * Carga las variables web y de entorno del proyecto, app y módulo
     * @return void
     */
    protected function cargaVariables() {

        // Variables de entorno del proyecto
        if (!isset($_SESSION['VARIABLES']['EnvPro'])) {
            $variables = new Variables('Pro', 'Env');
            $this->varEnvPro = $variables->getValores();
            $_SESSION['VARIABLES']['EnvPro'] = $this->varEnvPro;
        } else
            $this->varEnvPro = $_SESSION['VARIABLES']['EnvPro'];
        $this->values['varEnvPro'] = $this->varEnvPro;
        //if ((count($this->values['varEnvPro']) == 0) and ( $_SESSION['usuarioPortal']['IdPerfil'] == '1'))
        //    $this->values['errores'][] = "No se han definido las variables de entorno del proyecto";

        // Variables web del proyecto
        if (!isset($_SESSION['VARIABLES']['WebPro'])) {
            $variables = new Variables('Pro', 'Web');
            $this->varWebPro = $variables->getValores();
            $_SESSION['VARIABLES']['WebPro'] = $this->varWebPro;
        } else
            $this->varWebPro = $_SESSION['VARIABLES']['WebPro'];
        $this->values['varWebPro'] = $this->varWebPro;
        //if ((count($this->values['varWebPro']) == 0) and ( $_SESSION['usuarioPortal']['IdPerfil'] == '1'))
        //    $this->values['errores'][] = "No se han definido las variables web del proyecto";

        // Variables de entorno del modulo
        $variables = new Variables('Mod', 'Env', $this->entity);
        $this->varEnvMod = $variables->getValores();
        $this->values['varEnvMod'] = $this->varEnvMod;
        $_SESSION['VARIABLES']['EnvMod'] = $this->varEnvMod;
        //if ((count($this->values['varEnvMod']) == 0) and ( $_SESSION['usuarioPortal']['IdPerfil'] == '1'))
        //    $this->values['errores'][] = "No se han definido las variables de entorno del módulo '{$this->entity}'";

        // Variables web del modulo
        if (!isset($_SESSION['VARIABLES']['WebMod'])) {
            $variables = new Variables('Mod', 'Web', $this->entity);
            $this->varWebMod = $variables->getValores();
            $_SESSION['VARIABLES']['WebMod'] = $this->varWebMod;
        } else
            $this->varWebMod = $_SESSION['VARIABLES']['WebMod'];
        $this->values['varWebMod'] = $this->varWebMod;
        //if ((count($this->values['varWebMod']) == 0) and ( $_SESSION['usuarioPortal']['IdPerfil'] == '1'))
        //    $this->values['errores'][] = "No se han definido las variables web del módulo '{$this->entity}'";

        // Variables de entorno de la app
        if (!isset($_SESSION['VARIABLES']['EnvApp'])) {
            $variables = new Variables('App', 'Env', $this->app);
            $this->varEnvApp = $variables->getValores();
            $_SESSION['VARIABLES']['EnvApp'] = $this->varEnvApp;
        } else
            $this->varEnvApp = $_SESSION['VARIABLES']['EnvApp'];
        $this->values['varEnvApp'] = $this->varEnvApp;
        //if ((count($this->values['varEnvApp']) == 0) and ($_SESSION['usuarioPortal']['IdPerfil'] == '1'))
        //    $this->values['errores'][] = "No se han definido las variables de entorno de la App '{$this->app}'";
        // Variables web de la app
        if (!isset($_SESSION['VARIABLES']['WebApp'])) {
            $variables = new Variables('App', 'Web', $this->app);
            $this->varWebApp = $variables->getValores();
            $_SESSION['VARIABLES']['WebApp'] = $this->varWebApp;
        } else
            $this->varWebApp = $_SESSION['VARIABLES']['WebApp'];
        $this->values['varWebApp'] = $this->varWebApp;
        //if ((count($this->values['varWebApp']) == 0) and ($_SESSION['usuarioPortal']['IdPerfil'] == '1'))
        //    $this->values['errores'][] = "No se han definido las variables web de la App '{$this->app}'";

        unset($variables);
    }

    /**
     * Devuelve array (Id,Value) con los idiomas definimos en
     * la variable Web de Proyecto [globales][lang]
     * 
     * Si no se ha definido ninguno, devuelve el español
     * 
     * @return array
     */
    public function getArrayIdiomas() {

        $idiomas = new Idiomas();
        $array = $idiomas->getArrayIdiomas();
        unset($idiomas);

        return $array;
    }

    /**
     * Redirige al método $action del controller indicado
     *
     * @param string $controller El nombre del controller
     * @param string $action El nombre del método. Por defecto el Index
     * @return array
     */
    protected function redirect($controller, $action = "Index") {
        $controlador = "{$controller}Controller";
        $metodo = "{$action}Action";
        $fileController = "modules/{$controller}/{$controller}Controller.class.php";
        if (!file_exists($fileController)) {
            $controlador = "IndexController";
            $metodo = "IndexAction";
            $fileController = "modules/Index/IndexController.class.php";
        }

        include_once($fileController);
        $controller = new $controlador($this->request);
        return $controller->{$metodo}();
    }

    /**
     * Renderiza template desde archivo
     * 
     * @param string $template El path completo al template
     * @param array $values Array de valores
     * @return string Texto html
     */
    static function renderTwigTemplate($template, $values) {

        $loader = new Twig_Loader_Array(array('index' => file_get_contents($template),));
        $twig = new Twig_Environment($loader);

        return $twig->render('index', $values);
    }
    
    /**
     * Renderiza template desde string
     * 
     * @param string $template El path completo al template
     * @param array $values Array de valores
     * @return string Texto html
     */
    static function renderTwigString($template, $values) {

        $loader = new Twig_Loader_Array(array('index' => $template,));
        $twig = new Twig_Environment($loader);

        return $twig->render('index', $values);
    }
    
    /**
     * Devuelve el nombre del archivo css asociado al template
     * @param string $template
     * @return string
     */
    static function getArchivoCss($template) {
        $archivoTemplate = str_replace('html', 'css', $template);
        if (!file_exists("modules/" . $archivoTemplate)) {
            $archivoTemplate = "_global/css.html.twig";
        }
        return $archivoTemplate;
    }

    /**
     * Devuelve el nombre del archivo js asociado al template
     * @param string $template
     * @return string
     */
    static function getArchivoJs($template) {
        $archivoTemplate = str_replace('html', 'js', $template);
        if (!file_exists("modules/" . $archivoTemplate)) {
            $archivoTemplate = "_global/js.html.twig";
        }
        return $archivoTemplate;
    }

}
