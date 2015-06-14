<?php

/**
 * Clase para envíos de correos electrónicos
 *
 * Está implementado para ser independiente del motor de envíos
 * Si el constructor recibe un objeto mailer, lo utiliza, en caso contrario
 * lo instancia en base a los parametros indicados en el nodo 'mailer'
 * del archivo de configuracion 'config/config.yml' donde por defecto
 * se utiliza la clase Swift-5.0.0
 *
 * Métodos Públicos:
 *
 *  send($para,$de,$deNombre,$asunto,$mensaje, array $adjuntos): envía el email
 *  compruebaEmail($email): comprueba la validez sintáctica del $email
 *
 * @author Sergio Perez. <sergio.perez@albatronic.com>
 * @copyright Informática ALBATRONIC, SL
 * @since 29.05.2011
 */
class Mail {

    private $mailer;
    private $mensaje = array();
    private $config = array();

    public function __construct($config = array()) {

        if (count($config)) {
            $this->config = $config;
        } else {
            // Busco el motor para enviar correos, que debe estar
            // indicado en el nodo 'mailer' del fichero de configuracion
            $this->config = sfYaml::load('config/config.yml');
            $this->config = $this->config['config']['mailer'];
        }

        // Cargo la clase
        if (file_exists($this->config['plugin_dir'] . $this->config['plugin_file'])) {
            include_once $this->config['plugin_dir'] . $this->config['plugin_file'];

            // Create the Transport
            $transport = Swift_SmtpTransport::newInstance()
                    ->setHost($this->config['host'])
                    ->setPort($this->config['port'])
                    ->setUsername($this->config['user_name'])
                    ->setPassword($this->config['password'])
            ;

            // Create the Mailer using your created Transport
            $this->mailer = Swift_Mailer::newInstance($transport);
        } else {
            $this->mensaje[] = "Error: no se ha podido crear el objeto mailer.";
        }
    }

    /**
     * Envia un email
     *
     * @param email_adress $para La dirección del destinatario
     * @param string $asunto El texto del asunto
     * @param string $mensaje El texto de mensaje
     * @param email_adress $de La dirección del remitente. Opcional
     * @param string $deNombre El nombre del remitente. Opcional
     * @param array $conCopia Destinatarios con copia. Opcional
     * @param array $conCopiaOculta Destinatarios con copia oculta. Opcional
     * @param array $adjuntos Array con los nombres de los ficheros adjuntos. Opcional
     * @return string Mensaje de exito o fracaso al enviar
     */
    public function send($para, $asunto, $mensaje, $de = '', $deNombre = '', $conCopia = '', $conCopiaOculta = '', $adjuntos = array()) {

        if ($this->valida($para, $mensaje)) {

            if ($de == '') {
                $de = $this->config['from'];
            }
            if (trim($de) != '') {
                $this->mailer->From = $de;
            }
            if ($deNombre == '') {
                $deNombre = $this->config['from_name'];
            }
            if (trim($deNombre) != '') {
                $this->mailer->FromName = $deNombre;
            }

            // Create a message
            $message = Swift_Message::newInstance($asunto)
                    ->setContentType('text/html')
                    ->setFrom(array($de => $deNombre))
                    ->setTo(array($para))
                    ->setReadReceiptTo($de)
                    ->setPriority(2)
                    ->setBody($mensaje);
            if ($conCopia) {
                if (is_array($conCopia)) {
                    $message->setCc($conCopia);
                } else {
                    $message->setCc(array($conCopia));
                }
            }
            if ($conCopiaOculta) {
                if (is_array($conCopiaOculta)) {
                    $message->setBcc($conCopiaOculta);
                } else {
                    $message->setBcc(array($conCopiaOculta));
                }
            }

            foreach ($adjuntos as $adjunto) {
                $message->attach(Swift_Attachment::fromPath($adjunto));
            }

            $nEnvios = $this->mailer->send($message);
            if (!$nEnvios) {
                $this->mensaje[] = "Fallo al enviar a {$para}.";
            }
        }
        $ok = (count($this->mensaje) == 0);

        if ($this->config['save_sends']) {
            // Anotar en la bandeja de salida
            // -------------------------------------------------
            $mailBox = new EmailBox();
            $mailBox->setIp($_SERVER['REMOTE_ADDR']);
            $mailBox->setDe($de);
            $mailBox->setPara($para);
            $mailBox->setCC($conCopia);
            $mailBox->setCCO($conCopiaOculta);
            $mailBox->setAsunto($asunto);
            $mailBox->setMensaje($mensaje);
            $mailBox->setAdjuntos(json_encode($adjuntos));
            $mailBox->setOk($ok);
            $mailBox->setSmtp(json_encode($this->config));
            $mailBox->setObservations(json_encode($this->mensaje));
            $mailBox->create();
            unset($mailBox);
            //--------------------------------------------------
        }

        return $ok;
    }

    /**
     * Comprueba que los parámetros sean válidos
     * Devuelve el mensaje de error o NULL si es todo correcto
     *
     * @param email_address $email
     * @param string $contenido
     * @return string
     */
    private function valida($email, $contenido) {

        $this->compruebaEmail($email);

        if (trim($contenido) == "") {
            $this->mensaje[] = "No ha indicado ningun contenido.";
        }

        return (count($this->mensaje) == 0);
    }

    /**
     * Comprueba la validez sintáctica de un email
     * Devuelve true o false
     *
     * @param string $email El correo electrónico
     * @return boolean
     */
    public function compruebaEmail($email) {

        $ok = Swift_Validate::email($email);
        if (!$ok) {
            $this->mensaje[] = "La direccion email indicada no es valida";
        }

        return (count($this->mensaje) == 0);
    }

    /**
     * Devuelve un array con los eventuales mensajes de error
     * @return array Array de mensajes
     */
    public function getMensaje() {
        return $this->mensaje;
    }

}
