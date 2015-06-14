<?php

/**
 * class Entity
 *
 * Realiza las tareas comunes a todas las entidades de datos.
 * Esta clase es extendida por cada entidad.
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @copyright Informática ALBATRONIC, SL
 * @since 10-jun-2011
 *
 */
class Entity {

    /**
     * Objeto de conexion a la base de datos
     * @var database
     */
    protected $_em;

    /**
     * Link a la base de datos
     * @var dbLink
     */
    protected $_dbLink = null;

    /**
     * Array con los eventuales errores
     * @var array
     */
    protected $_errores;

    /**
     * Array con las eventuales alertas, que sin
     * ser errores interesa que sean notificadas
     * @var array
     */
    protected $_alertas;

    /**
     * Indica el numero de filas devueltas por el
     * ultimo método que ha accedido a la entidad (load, cargaCondicion, etc)
     *
     * @var integer
     */
    protected $_status;

    /**
     * El nombre de la base de datos donde está la entidad
     * @var string
     */
    protected $_dataBaseName;

    /**
     * Array con los ids de las entidades hijas
     * @var array 
     */
    private $_hijos = array();

    /**
     * Array con los ids de las entidades padre
     * @var array
     */
    private $_padres = array();

    /**
     * CONSTRUCTOR
     */
    public function __construct($primaryKeyValue = '', $showDeleted = FALSE) {

        $this->_tableName = ($_SESSION['idiomas']['actual'] > 0) ?
                str_replace("*", $_SESSION['idiomas']['actual'], $this->_tableName) :
                str_replace("*", "", $this->_tableName);

        $this->setPrimaryKeyValue($primaryKeyValue);
        $this->load($showDeleted);
    }

    /**
     * Realiza la conexión a la base de datos apoyándose en EntityManager
     *
     * Y establece los valores de las propiedades
     *
     *   * $this->_dbLink
     *   * $this->_dataBaseName
     */
    protected function conecta() {

        if (!is_resource($this->_dbLink)) {
            $this->_em = new EntityManager($this->getConectionName());
            $this->_dbLink = $this->_em->getDbLink();
            $this->_dataBaseName = $this->_em->getDataBase();
            $this->_errores = $this->_em->getError();
            //echo "conecto {$this->_tableName} {$this->_dbLink}<br/>";
        }
    }

    /**
     * Carga las propiedades del objeto con los valores de la base de datos.
     * SIEMPRE Y CUANDO SE HAYA ESTABLECIDO EL VALOR DE LA PRIMARYKEY
     */
    protected function load($showDeleted = FALSE) {
        if ($this->getPrimaryKeyValue() != '') {

            $this->conecta();

            $filtro = "(`{$this->_primaryKeyName}`='{$this->getPrimaryKeyValue()}')";
            if ($showDeleted == FALSE)
                $filtro .= " AND (Deleted = '0')";

            if (is_resource($this->_dbLink)) {
                $query = "SELECT * FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE {$filtro}";

                if ($this->_em->query($query)) {
                    $this->setStatus($this->_em->numRows());

                    if ($this->getStatus() > 0) {
                        $rows = $this->_em->fetchResult();
                        foreach ($rows[0] as $key => $value) {
                            $column_name = str_replace('-', '_', $key);
                            $this->{"set$column_name"}($value);
                        }
                    }
                } else
                    $this->_errores[] = $this->_em->getError();

                $this->_em->desConecta();
            } else
                $this->_errores[] = $this->_em->getError();
        }
    }

    /**
     * Actualiza un objeto de la entidad.
     * @return boolean
     *
     */
    public function save() {

        $this->conecta();

        if (is_resource($this->_dbLink)) {
            // Auditoria
            $this->setModifiedAt(date('Y-m-d H:i:s'));
            $this->setModifiedBy($_SESSION['usuarioPortal']['Id']);

            // Compongo los valores iterando el objeto
            $values = '';
            foreach ($this as $key => $value) {
                if ((substr($key, 0, 1) != '_') and ( $key != $this->getPrimaryKeyName())) {
                    if (is_null($value)) {
                        $values .= "`" . $key . "` = NULL,";
                    } else {
                        $values .= "`" . $key . "` = '" . mysql_real_escape_string($value, $this->_dbLink) . "',";
                    }
                }
            }
            // Quito la coma final
            $values = substr($values, 0, -1);
            $query = "UPDATE `{$this->_dataBaseName}`.`{$this->_tableName}` SET {$values} WHERE `{$this->getPrimaryKeyName()}` = '{$this->getPrimaryKeyValue()}'";
            //echo $query;
            if (!$this->_em->query($query)) {
                $this->_errores = $this->_em->getError();
            }
        }

        return ( count($this->_errores) == 0);
    }

    /**
     * Inserta un objeto en la entidad.
     *
     * @return int El valor del último ID insertado
     */
    public function create() {

        $this->conecta();

        $lastId = NULL;

        if (is_resource($this->_dbLink)) {
            // Auditoria
            $this->setCreatedAt(date('Y-m-d H:i:s'));
            $this->setCreatedBy($_SESSION['usuarioPortal']['Id']);

            // Compongo las columnas y los valores iterando el objeto
            $columns = '';
            $values = '';
            foreach ($this as $key => $value) {
                if (substr($key, 0, 1) != '_') {
                    $columns .= "`" . $key . "`,";
                    if ($key == "PrimaryKeyMD5") {
                        $values .= "'" . str_replace(".", "-", uniqid($_SESSION['usuarioPortal']['Id'], true)) . "',";
                    } elseif (is_null($value) or ( ($key == $this->getPrimaryKeyName()) and ($value == '') )) {
                        $values .= "NULL,";
                    } else {
                        $values .= "'" . mysql_real_escape_string($value, $this->_dbLink) . "',";
                    }
                }
            }
            // Quito las comas finales
            $columns = substr($columns, 0, -1);
            $values = substr($values, 0, -1);

            $query = "INSERT INTO `{$this->_dataBaseName}`.`{$this->_tableName}` ({$columns}) VALUES ({$values})";
            //echo $query,"\n";
            if (!$this->_em->query($query)) {
                $this->_errores = $this->_em->getError();
            } else {
                $lastId = (!$this->getPrimaryKeyValue()) ? $this->_em->getInsertId() : $this->getPrimaryKeyValue();
                $this->setPrimaryKeyValue($lastId);
            }
        }

        return $lastId;
    }

    /**
     * Marca como borrado un registro.
     *
     * Hace las validaciones de integridad previas el borrado pero NO
     * hace el borrado físico.
     *
     * @return boolean
     */
    public function delete() {

        $validacion = $this->validaBorrado();

        if ($validacion) {
            $this->conecta();

            if (is_resource($this->_dbLink)) {
                // Auditoria
                $fecha = date('Y-m-d H:i:s');
                $query = "UPDATE `{$this->_dataBaseName}`.`{$this->_tableName}` SET `Deleted` = '1', `DeletedAt` = '{$fecha}', `DeletedBy` = '{$_SESSION['usuarioPortal']['Id']}' WHERE `{$this->_primaryKeyName}` = '{$this->getPrimaryKeyValue()}'";
                if (!$this->_em->query($query))
                    $this->_errores = $this->_em->getError();
                else {
                    // Borrar la eventual url amigable
                    //$url = new CpanUrlAmigables();
                    //$url->borraUrl($_SESSION['idiomas']['actual'], $this->getClassName(), $this->getPrimaryKeyValue());
                    //unset($url);
                    // Borrar los eventuales documentos
                    //$doc = new CpanDocs();
                    //$doc->borraDocs($this->getClassName(), $this->getPrimaryKeyValue(), "%");
                    //unset($doc);
                }
                //$this->_em->desConecta();
            } else {
                $this->_errores = $this->_em->getError();
            }
            //unset($this->_em);
            $validacion = (count($this->_errores) == 0);
        }

        return $validacion;
    }

    /**
     * Borra físicamente un registro (delete).
     *
     * Antes de borrar realiza validaciones de integridad de datos
     *
     * @return boolean
     */
    public function erase() {

        $validacion = $this->validaBorrado();

        if ($validacion) {
            $this->conecta();

            if (is_resource($this->_dbLink)) {
                $query = "DELETE FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE `{$this->_primaryKeyName}` = '{$this->getPrimaryKeyValue()}'";
                if (!$this->_em->query($query))
                    $this->_errores = $this->_em->getError();
                else {
                    // Borrar la eventual url amigable
                    //$url = new CpanUrlAmigables();
                    //$url->borraUrl($_SESSION['idiomas']['actual'], $this->getClassName(), $this->getPrimaryKeyValue());
                    //unset($url);
                    // Borrar los eventuales documentos
                    //$doc = new CpanDocs();
                    //$doc->borraDocs($this->getClassName(), $this->getPrimaryKeyValue(), "%");
                    //unset($doc);
                }
                //$this->_em->desConecta();
            } else
                $this->_errores = $this->_em->getError();
            //unset($this->_em);
            $validacion = (count($this->_errores) == 0);
        }

        return $validacion;
    }

    /**
     * Carga las propiedades del objeto con los valores pasados en el array.
     * Los índices del array deben coincidir con los nombre de las propiedades.
     * Las propiedades que no tengan correspondencia con elementos del array
     * no serán cargadas.
     *
     * La función de este método equivale a realizar manualmente todos los
     * set's de las propiedades del objeto.
     *
     * @param array $datos
     */
    public function bind(array $datos) {
        foreach ($datos as $key => $value) {
            if (method_exists($this, "set{$key}")) {
                $this->{"set$key"}($value);
            }
        }
    }

    /**
     * Carga las propiedades del objeto con los valores pasados en el array $valores.
     *
     * El array $valores tendrá tantos elmentos como columnas, y para cada elemento
     * debe haber un subelemento llamado 'default', cuyo valor será el que se cargue.
     *
     * Los índices del array deben coincidir con los nombre de las propiedades.
     *
     * Las propiedades que no tengan correspondencia con elementos del array
     * no serán cargadas.
     *
     * @param array $valores Array con los valores pon defecto
     */
    public function setDefaultValues(array $valores) {
        foreach ($valores as $key => $values) {
            if ($values['default'])
                $this->{"set$key"}($values['default']);
        }
    }

    /**
     * Valida la información cargada en las propiedades del objeto
     * respecto a las reglas pasadas en el array $rules y que
     * provienen del nodo <validator> del archivo config.yml
     * correspondiente al controller del objeto.
     *
     * Si alguna columna no cumple la regla, le carga el valor por defecto
     *
     * Carga los array de errores y alertas si procede.
     *
     * @param array $rules Array con las reglas de validacion
     * @return boolean True si hay errores
     */
    public function valida(array $rules) {
        unset($this->_errores);

        if ((count($this->_errores) === 0) && (count($rules) > 0)) {
            foreach ($rules as $key => $value) {

                // Si no tiene valor, le pongo el de por defecto
                if ($this->{$key} == '') {
                    $this->{$key} = $value['default'];
                }

                switch ($value['type']) {
                    case 'string':
                        //Validar los items que no pueden ser nulos
                        $this->{$key} = trim($this->{$key});
                        if ($this->{$key} == '') {
                            $this->_errores[] = $value['title'] . ": " . $value['message'];
                        }
                        break;

                    case 'integer':
                    case 'decimal':
                        $valor = $this->{$key};
                        $minimo = (integer) $value['minimo'];
                        $maximo = (integer) $value['maximo'];
                        $controlRango = ($minimo || $maximo);

                        if (is_numeric($valor)) {
                            if ($controlRango) {
                                if (($valor < $minimo) || ($valor > $maximo)) {
                                    $this->_errores[] = $value['title'] . ": Valor fuera del rango (" . $minimo . "-" . $maximo . ")";
                                }
                            }
                        } else {
                            $this->_errores[] = $value['title'] . ": " . $valor . " " . $value['message'];
                        }
                        break;

                    case 'date':
                        break;

                    case 'datetime':
                        break;

                    case 'cif':
                        break;

                    case 'email':
                        $email = new Mail();
                        if (!$email->compruebaEmail($this->{$key})) {
                            $this->_errores[] = $value['title'] . ": No cumple las reglas de un email correcto.";
                        }
                        unset($email);
                        break;
                }
            }

            $this->validaLogico();
        }

        return ( count($this->_errores) == 0 );
    }

    /**
     * Realiza validaciones lógicas
     *
     * Los errores los pone en $this->_errores[]
     * Las alertas las pone en $this->_alertas[]
     * Este método lo debe complementar la entidad que lo necesite
     */
    protected function validaLogico() {

        if ($this->BelongsTo == $this->getPrimaryKeyValue()) {
            $this->BelongsTo = 0;
            $this->_alertas[] = "El objeto no puede pertenecer a el mismo";
        }

        if ($this->getPrimaryKeyValue() != '') {
            // Estoy validando antes de actualizar
            if (($this->IsSuper || $this->IsDefault) and ( $_SESSION['usuarioPortal']['IdPerfil'] != '1'))
                $this->_errores[] = "No se puede modificar, es un valor reservado";
        }

        // Asignar el nivel Jerárquico
        $nivelPadre = 0;
        if ($this->BelongsTo != 0) {
            $objetoPadre = new $this($this->BelongsTo);
            $nivelPadre = $objetoPadre->getNivelJerarquico();
            unset($objetoPadre);
        }
        $this->setNivelJerarquico($nivelPadre + 1);
    }

    /**
     * Validaciones de integridad referencial
     *
     * Las validaciones se hacen en base al array $this->_parentEntities
     * donde se definen las entidades que referencian a esta
     *
     * Si hay errores carga el array $this->_errores
     *
     * @return boolean
     */
    protected function validaBorrado() {
        unset($this->_errores);

        // No se puede borrar si el objeto es un valor predeterminado y el usuario
        // no es el super
        if (($this->IsDefault) AND ( $_SESSION['usuarioPortal']['IdPerfil'] != 1))
            $this->_errores[] = "No se puede eliminar. Es un valor predeterminado";

        // No se puede borrar si el objeto es un valor SUPER y el usuario
        // no es el super
        if (($this->IsSuper) AND ( $_SESSION['usuarioPortal']['IdPerfil'] != 1))
            $this->_errores[] = "No se puede eliminar. Es un valor reservado";

        // Validacion de integridad referencial respecto a entidades que usan a esta        
        if (count($this->_errores) == 0) {
            if (is_array($this->_parentEntities)) {
                foreach ($this->_parentEntities as $entity) {
                    $entidad = new $entity['ParentEntity']();
                    $condicion = $entity['ParentColumn'] . "='" . $this->$entity['SourceColumn'] . "'";
                    $rows = $entidad->cargaCondicion($entity['ParentColumn'], $condicion);
                    $n = count($rows);
                    if ($n > 0) {
                        $this->_errores[] = "Imposible eliminar. Hay {$n} relaciones con {$entity['ParentEntity']}";
                    }
                }
            }
        }

        return (count($this->_errores) == 0);
    }

    /**
     * Carga datos en un array en funcion de una condicion where y orderBy
     *
     * @param string $columnas Relacion de las columnas seperadas por coma
     * @param string $condicion Condicion de filtrado que se utiliza en la clausula where (sin la cláusula WHERE)
     * @param string $orderBy Ordenacion, debe incluir la/s columna/s y el tipo ASC/DESC (sin la cláusula ORDER BY)
     * @param boolean $showDeleted Devolver o no los registros marcados como borrados, por defecto no se devuelven
     * @return array $rows Array con las columnas devueltas
     */
    public function cargaCondicion($columnas = '*', $condicion = '(1=1)', $orderBy = '', $showDeleted = FALSE) {
        $this->conecta();

        if (is_resource($this->_dbLink)) {

            if ($orderBy != '') {
                $orderBy = 'ORDER BY ' . $orderBy;
            }

            if ($showDeleted == FALSE) {
                $condicion = "(Deleted = '0') AND " . $condicion;
            }

            $query = "SELECT {$columnas} FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE {$condicion} {$orderBy}";
            $this->_em->query($query);
            //echo $query,"</br>";
            $this->setStatus($this->_em->numRows());
            $rows = $this->_em->fetchResult();
        }

        return $rows;
    }

    /**
     * Ejecuta una sentencia update sobre la entidad
     * 
     * @param array $array Array de parejas columna, valor
     * @param string $condicion Condicion del where (sin el where)
     * @return int El número de filas afectadas
     */
    public function queryUpdate($array, $condicion = '1') {

        $filasAfectadas = 0;

        $this->conecta();
        if (is_resource($this->_dbLink)) {

            foreach ($array as $key => $value) {
                $valores .= "{$key}='{$value}',";
            }

            // Quito la coma final
            $valores = substr($valores, 0, -1);

            $query = "UPDATE `{$this->_dataBaseName}`.`{$this->_tableName}` SET {$valores} WHERE ({$condicion})";
            $this->_em->query($query);
            //echo $query,"<br/>";
            $filasAfectadas = $this->_em->getAffectedRows();
        }

        return $filasAfectadas;
    }

    /**
     * Ejecuta una sentencia delete sobre la entidad
     * 
     * @param string $condicion Condicion del where (sin el where)
     * @return int El número de filas afectadas
     */
    public function queryDelete($condicion) {

        $filasAfectadas = 0;

        $this->conecta();
        if (is_resource($this->_dbLink)) {

            $query = "DELETE FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE ({$condicion})";
            //echo $query;
            $this->_em->query($query);
            $filasAfectadas = $this->_em->getAffectedRows();
        }

        return $filasAfectadas;
    }

    /**
     * Ejecuta una sentencia SELECT sobre la entidad
     * 
     * @param string $columnas Las columnas a obtener separadas por comas
     * @param string $condicion Condicion del where (sin el where)
     * @param string $orden Criterio de orden
     * @return array Array de resultado
     */
    public function querySelect($columnas, $condicion = '1', $orden = '') {

        $rows = array();

        $orden = ($orden == '') ? '' : "ORDER BY {$orden}";

        $this->conecta();
        if (is_resource($this->_dbLink)) {

            $query = "SELECT {$columnas} FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE {$condicion} {$orden}";
            //echo $query,"<br/>";
            $this->_em->query($query);
            $rows = $this->_em->fetchResult();
        }

        return $rows;
    }

    /**
     * Borra todos los registros de la tabla
     * 
     * @return void
     */
    public function truncate() {

        $this->conecta();
        if (is_resource($this->_dbLink)) {
            $query = "TRUNCATE TABLE `{$this->_dataBaseName}`.`{$this->_tableName}`";
            $this->_em->query($query);
        }
    }

    /**
     * Devuelve un objeto cuyo valor de la columna $columna es igual a $valor
     *
     * @param string $columna El nombre de la columna
     * @param variant $valor El valor a buscar
     * @param boolean $showDeleted Devolver o no los registros marcados como borrados, por defecto no se devuelven
     * @return this El objeto encontrado
     */
    public function find($columna, $valor, $showDeleted = FALSE) {

        $condicion = "({$columna} = '{$valor}')";

        if ($showDeleted == FALSE) {
            $condicion .= " AND (Deleted = '0')";
        }

        $this->conecta();

        if (is_resource($this->_dbLink)) {

            $query = "SELECT {$this->_primaryKeyName} FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE ({$condicion})";
            //echo $query;
            $this->_em->query($query);
            $this->setStatus($this->_em->numRows());
            $rows = $this->_em->fetchResult();
        }

        $id = (isset($rows[0])) ? $rows[0][$this->_primaryKeyName] : '';
        return new $this($id, $showDeleted);
    }

    /**
     * Devuelve un array con todos los registros de la entidad
     *
     * Cada elemento tiene la primarykey y el valor de $column
     *
     * Si no se indica valor para $column, se mostrará los valores
     * de la primarykey
     *
     * Su utilidad es básicamente para generar listas desplegables de valores
     *
     * El array devuelto es:
     *
     * array (
     *      '0' => array('Id' => valor primaryKey, 'Value'=> valor de la columna $column),
     *      '1' => .......
     * )
     *
     * @param string $column El nombre de columna a mostrar
     * @param boolean $default Si se añade o no el valor 'Indique Valor'
     * @return array Array de valores Id, Value
     */
    public function fetchAll($column = '', $default = true) {

        if ($column == '') {
            $column = $this->getPrimaryKeyName();
        }

        $rows = $this->querySelect($this->getPrimaryKeyName() . " as Id, {$column} as Value", "(Deleted = '0')", "{$column} ASC");

        if ($default == TRUE) {
            array_unshift($rows, array('Id' => '', 'Value' => ':: Indique un Valor'));
        }

        return $rows;
    }

    /**
     * Localiza el primer registro en orden ascendente segun la Primary Key
     *
     * @return mixed el valor de la primary key de menor valor
     */
    public function getFirstId() {

        $id = "";

        $this->conecta();

        if (is_resource($this->_dbLink)) {
            $query = "SELECT `{$this->getPrimaryKeyName()}` FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE Deleted = '0' ORDER BY `{$this->getPrimaryKeyName()}` ASC Limit 1";
            $this->_em->query($query);
            $row = $this->_em->fetchResult();
            $this->setStatus($this->_em->numRows());
            $id = $row[0][$this->getPrimaryKeyName()];
        }

        return $id;
    }

    /**
     * Localiza el primer registro en orden ascendente segun la Primary Key
     *
     * @return Entity El objeto cuya primaryKey es menor
     */
    public function getFirstObject() {
        $clase = get_class($this);
        return new $clase($this->getFirstId());
    }

    /**
     * Localiza el ultimo registro en orden ascendente segun la Primary Key
     *
     * @return mixed el valor de la primary key de mayor valor
     */
    public function getLastId() {

        $id = "";

        $this->conecta();

        if (is_resource($this->_dbLink)) {
            $query = "SELECT `{$this->getPrimaryKeyName()}` FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE Deleted = '0' ORDER BY `{$this->getPrimaryKeyName()}` DESC Limit 1";
            $this->_em->query($query);
            $row = $this->_em->fetchResult();
            $this->setStatus($this->_em->numRows());
            $id = $row[0][$this->getPrimaryKeyName()];
        }

        return $id;
    }

    /**
     * Localiza el ultimo registro en orden ascendente segun la Primary Key
     *
     * @return Entity El objeto cuya primaryKey es mayor
     */
    public function getLastObject() {
        $clase = get_class($this);
        return new $clase($this->getLastId());
    }

    /**
     * Devuelve el número de registros activos (deleted=0)
     * que tiene la entidad
     *
     * @param string $criterio Clausa para el WHERE para poder contar un subconjunto de registros
     * @return integer
     */
    public function getNumberOfRecords($criterio = '1') {

        $nRegistros = 0;

        $this->conecta();

        if (is_resource($this->_dbLink)) {
            $query = "SELECT COUNT({$this->getPrimaryKeyName()}) as NumeroDeRegistros FROM `{$this->_dataBaseName}`.`{$this->_tableName}` WHERE ({$criterio}) AND (Deleted = '0')";
            $this->_em->query($query);
            $row = $this->_em->fetchResult();
            $nRegistros = $row[0]['NumeroDeRegistros'];
        }

        return $nRegistros;
    }

    /**
     * Actualiza las propiedades de auditoria de impresion
     */
    public function auditaImpresion() {

        if (method_exists($this, 'setPrintedAt')) {
            $this->setPrintedAt(date('Y-m-d H:i:s'));
            $this->setPrintedBy($_SESSION['usuarioPortal']['Id']);
            $this->save();
        }
    }

    /**
     * Actualiza las propiedades de auditoria de envio pòr email
     */
    public function auditaEmail() {

        if (method_exists($this, 'setEmailedAt')) {
            $this->setEmailedAt(date('Y-m-d H:i:s'));
            $this->setEmailedBy($_SESSION['usuarioPortal']['Id']);
            $this->save();
        }
    }

    /**
     * Devuelve un array con objetos documentos asociados
     * a la entidad e id de entidad en curso
     *
     * @param string $tipo El tipo de documento, se admite '%'
     * @param string $criterio Expresión lógica a incluir en el criterio de filtro
     * @param string $orderCriteria El criterio de ordenación
     * @return array Array de objetos documentos
     */
    public function getDocuments($tipo = 'image%', $criterio = '1', $orderCriteria = 'SortOrder ASC') {

        $docs = new CpanDocs();

        $arrayDocs = $docs->getDocs($this->getClassName(), $this->getPrimaryKeyValue(), $tipo, $criterio, $orderCriteria);
        unset($docs);

        return $arrayDocs;
    }

    /**
     * Devuelve el número de documentos asociados a la entidad
     *
     * @param string $tipo El tipo de documento, se admite '%'
     * @param string $criterio Expresión lógica a incluir en el criterio de filtro
     * @return integer El número de documentos
     */
    public function getNumberOfDocuments($tipo = 'image%', $criterio = '1') {

        $docs = new CpanDocs();

        $nDocs = $docs->getNumberOfDocs($this->getClassName(), $this->getPrimaryKeyValue(), $tipo, $criterio);
        unset($docs);

        return $nDocs;
    }

    /**
     * Devuelve el pathname de la imagen de diseño (no el thumbnail) $nImagen
     * 
     * @param integer $nImagen El número de imagén de diseño. Opcional, defecto la 1
     * @return string el path de la imagen
     */
    public function getPathNameImagenN($nImagen = 1) {

        $imagenes = $this->getDocuments('image' . $nImagen, "IsThumbnail='0'");

        $pathName = (count($imagenes)) ? $imagenes[0]->getPathName() : "";
        return $pathName;
    }

    /**
     * Devuelve el pathname del thumbnail de la imagen de diseño $nImagen
     * 
     * @param integer $nImagen El número de imagén de diseño. Opcional, defecto la 1
     * @return string el path de la imagen
     */
    public function getPathNameThumbnailN($nImagen = 1) {

        $imagenes = $this->getDocuments('image' . $nImagen, "IsThumbnail='1'");

        $pathName = (count($imagenes)) ? $imagenes[0]->getPathName() : "";
        return $pathName;
    }

    /**
     * Devuelve un array cuyo índice es el nombre de la propiedad
     * y el valor es el valor de dicha propiedad
     * No devuelve las propiedades que empiezan por guión bajo "_"
     *
     * @return array Array con los valores de las propiedades de la entidad
     */
    public function iterator() {
        $values = array();
        foreach ($this as $key => $value) {
            if (substr($key, 0, 1) != "_") {
                $values[$key] = $value;
            }
        }
        return $values;
    }

    /**
     * Devuelve un array con los nombres de las propiedades de la entidad.
     *
     * No devuelve las propiedades que empiezan por guión bajo "_"
     *
     * El array es del tipo ('Id'=> ..., 'Value'=>....)
     *
     * @return array Array con los valores de las propiedades de la entidad
     */
    public function getColumnsNames() {

        $columns = array();

        foreach ($this as $key => $value) {
            if (substr($key, 0, 1) != "_") {
                $columns[] = array(
                    'Id' => $key,
                    'Value' => $key
                );
            }
        }

        return $columns;
    }

    /**
     * Le asigna un valor a la propiedad que corresponde
     * a la primaryKey
     * @param variant $primaryKeyValue
     */
    public function setPrimaryKeyValue($primaryKeyValue) {
        $this->{$this->_primaryKeyName} = $primaryKeyValue;
    }

    /**
     * Devuelve el valor de la primarykey del objeto actual
     * @return mixed PrimaryKey Value
     */
    public function getPrimaryKeyValue() {
        return $this->{"get$this->_primaryKeyName"}();
    }

    /**
     * Devuelve el valor de la columna indicada.
     * Devuelve el número de caracteres indicados en el segundo parámetro.
     * Si el valor del segundo parámetro es inferior a 1, devuelve todo el string.
     * Es de gran utilidad para el listado genérico por pantalla.
     *
     * @param string $column El nombre de la columna
     * @param integer $length El numero de caracteres a devolver
     * @return variant
     */
    public function getColumnValue($column, $length = 0) {
        $cadena = $this->{"get$column"}();
        if (is_object($cadena)) {
            $cadena = $cadena->__toString();
        }
        if ($length > 0) {
            $cadena = substr($cadena, 0, $length);
        }
        return $cadena;
    }
    
    /**
     * Devuelve el objeto correspondiente al valor
     * de la columna indicada.
     * Es de gran utilidad para el listado genérico por pantalla.
     *
     * @param string $column El nombre de la columna
     * @return variant Objeto
     */
    public function getColumnObject($column) {
        return $this->{"get$column"}();
    }
    
    /**
     * Devuelve el objeto en formato JSON
     * 
     * @param array $arrayColumnas Array con los nombres de las columnas que se quieren obtener. Por defecto todas
     * @return json
     */
    public function getJson($arrayColumnas = array()) {

        if (!count($arrayColumnas)) {
            $array = $this->iterator();
        } else {
            foreach ($arrayColumnas as $columna) {
                $array[$columna] = $this->$columna;
            }
        }

        return json_encode($array);
    }

    /**
     * Devuelve un array con los errores generados por la entidad
     * @return array
     */
    public function getErrores() {
        return $this->_errores;
    }

    /**
     * Devuelve un array con las alertas generadas por la entidad
     * Una alerta es un aviso y no tiene categoría de error
     * @return array
     */
    public function getAlertas() {
        return $this->_alertas;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }

    /**
     * Devuelve un valor numérico indicando el número
     * de registros obtenidos en la última consulta.
     *
     * @return integer
     */
    public function getStatus() {
        return $this->_status;
    }

    /**
     * Devuelve el nombre de la PrimaryKey de la entidad
     * @return string PrimaryKey Name
     */
    public function getPrimaryKeyName() {
        return $this->_primaryKeyName;
    }

    /**
     * Cambia el nombre físico de la tabla
     * 
     * @param string $TableName El nombre físico de la tabla
     */
    public function setTableName($TableName) {
        $this->_tableName = $TableName;
    }

    /**
     * Devuelve el nombre de la tabla física que representa la entidad
     * @return string _tableName
     */
    public function getTableName() {
        return $this->_tableName;
    }

    /**
     * Devuelve el nombre absoluto de la conexión a la BD donde está
     * la entidad en curso
     *
     * @return string Nombre de la conexión
     */
    public function getConectionName() {

        if ($this->_conectionName == '') {
            // Si no se ha indicado explicatamente, se toma la
            // primera conexión definidad en config/config.yml
            reset($_SESSION['conections']);
            list($conection, $nada) = each($_SESSION['conections']);
            $this->_conectionName = $conection;
        }
        return $this->_conectionName;
    }

    public function setConectionName(array $conection) {
        $this->_conectionName = $conection;
    }

    /**
     * Devuelve el nombre físico de la BD donde está la entidad en curso
     *
     * @return string Nombre de la BD
     */
    public function getDataBaseName() {
        $em = new EntityManager($this->getConectionName());
        $dataBaseName = $em->getDataBase();
        unset($em);
        return $dataBaseName;
    }

    /**
     * Devuelve el nombre de la clase
     *
     * @return string El nombre de la clase
     */
    public function getClassName() {
        return get_class($this);
    }

}
