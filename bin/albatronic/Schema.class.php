<?php

include "SchemaBuilder.class.php";
include '../yaml/lib/sfYaml.php';

class Schema
{
    protected $connection;
    protected $sb;
    protected $sql;
    protected $errores = array();
    static $engineDataBase = array('mysql','postgres');

    public function __construct($connection = '')
    {
        $this->connection = $connection;

        if (is_array($this->connection['POST'])) {
            $this->sb = new SchemaBuilder($this->connection['POST']);
        }
    }

    public function buildTables($arraySchema)
    {
        if (is_array($arraySchema)) {
            $this->sb->buildTables($arraySchema);
        } else {
            $this->errores[] = "No ha seleccionado el archivo con el esquema";
        }
    }

    /**
     * Construye el esquema yml en base las las tablas existentes
     */
    public function buildSchema()
    {
        if (!$this->sb->buildSchema()) {
            $this->errores = $this->sb->getErrores();
        }
    }

    public function loadFixtures($arrayFixtures, $truncateTables = FALSE)
    {
        if (is_array($arrayFixtures)) {
            $this->sb->loadFixtures($arrayFixtures, $truncateTables);
        } else {
            $this->errores[] = "No ha seleccionado el archivo con los datos";
        }
    }

    public function createDataBase()
    {
        return $this->sb->createDataBase();
    }

    public function deleteDataBase()
    {
        return $this->sb->deleteDataBase();
    }

    public function createUser(array $user)
    {
        return $this->sb->createUser($user);
    }

    public function clearTables()
    {
        return $this->sb->clearTables();
    }

    /**
     * ESCRIBE EN EL FICHERO lastConnection.yml LOS DATOS DE LA
     * ULTIMA CONEXIÓN QUE ESTAN EN $_POST
     */
    public function saveCurrentParametersConnection()
    {
        $texto = sfYaml::dump($this->connection);
        $archivo = new Archivo("lastConnection.yml");
        $archivo->write($texto);
        unset($archivo);
    }

    /**
     * LEE DEL FICHERO lastConnection.yml CON LOS DATOS DE CONEXIÓN
     * DE LA ÚLTIMA SESION
     *
     * @return array Array con los parametros $_POST de la última conexión
     */
    public function getLastParametersConnection()
    {
        $parameters = array();

        if (file_exists("lastConnection.yml")) {
            $lastConnection = sfYaml::load('lastConnection.yml');
            $parameters = $lastConnection['POST'];
        }

        return $parameters;
    }

    public function valida()
    {
        $errores = array();

        if ($_FILES['fileNameSchema']['name'] != '') {
            if (!is_uploaded_file($_FILES['fileNameSchema']['tmp_name']))
                $errores[] = "El archivo {$_FILES['fileNameSchema']['name']} no se ha cargado";
        }

        if ($_FILES['fileNameFixtures']['name'] != '') {
            if (!is_uploaded_file($_FILES['fileNameFixtures']['tmp_name']))
                $errores[] = "El archivo {$_FILES['fileNameFixtures']['name']} no se ha cargado";
        }

        if ($_POST['dataBase'] == '')
            $errores[] = "Debe indicar una base de datos";

        return $errores;
    }

    public function getSql()
    {
        return $this->sb->getSql();
    }

    public function getErrores()
    {
        return array_merge($this->errores, $this->sb->getErrores());
    }

    public function getLog()
    {
        return $this->sb->getLog();
    }

}
