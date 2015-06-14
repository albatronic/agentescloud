<?php

/**
 * Description of SMS
 * 
 * CLASE PARA LA GESTION DE SMS CON LA API DE MOVISTAR
 *
 * @author Sergio Pérez <info@albatronic.com>
 */
include_once ('IXR_Library.php'); //Libreria para el uso de xml-rpc

class SMS {

    static $url = "https://www.mensajerianegocios.movistar.es/SrvConexion";
    static $user = "B069516F-JMANGULO@";
    static $passw = "110d0dd4034";

    /**
     * Envía mensajes a un array de destinatarios
     * 
     * El array de entrada debe ser:
     * 
     * $mensajes = array(
     *                array('637xxxxxx','texto del mensaje','texto que identifica al enviador'),
     *                //array(),
     *             );
     * 
     * @param array $mensajes
     * @return array
     */
    static function send(array $mensajes) {

        if (count($mensajes)) {
            $client = new IXR_Client(self::$url);
            $client->query('MensajeriaNegocios.enviarSMS', self::$user, self::$passw, $mensajes);
            return $client->getResponse();
        }
    }

}
