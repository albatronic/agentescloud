<?php

/**
 * Description of WSVips
 * 
 * SERVICIO WEB SOAP QUE HACE LLAMADAS AL SAP DE VIPS
 *
 * @author Sergio Pérez <info@albatronic.com>
 * @since 27.02.2015
 */
class WSVips {

    /**
     * Indica el entorno de trabajo
     * dev = desarrollo; prod = produccion
     * Por defecto es desarrollo
     */
    static $entorno = '';

    /**
     * Credenciales de desarrollo y producción
     */
    static $arrayCredenciales = array(
        // Desarrollo 
        'dev' => array(
            'wsdl' => 'http://wssapdes.grupovips.com:8004/sap/bc/srt/wsdl/bndg_54DD04798AD40203E1008000808000C3/wsdl11/allinone/standard/document?sap-client=123',
            'endpointEnvioPedidos'   => 'https://wssapdes.grupovips.com:443/sap/bc/srt/rfc/sap/zle_ws_envio_pedidos/123/zle_ws_envio_pedidos/zle_ws_envio_pedidos',
            'endpointEnvioRecepcion' => 'https://wssapdes.grupovips.com:443/sap/bc/srt/rfc/sap/zle_ws_recepcion_pedidos/123/zle_ws_recepcion_pedidos/zle_ws_recepcion_pedidos',
            'login' => 'WSTREVENQUE', //Usuario
            'password' => 'Athletic2015*', //Clave
        ),
        // Producción
        'prod' => array(
            'wsdl' => 'http://wssappro.grupovips.com:443/sap/bc/srt/wsdl/bndg_54ED72019C983886E10080028080008A/wsdl11/allinone/ws_policy/document?sap-client=123',
            'endpointEnvioPedidos'   => 'https://wssappro.grupovips.com:443/sap/bc/srt/rfc/sap/zle_ws_envio_pedidos/123/zle_ws_envio_pedidos/zle_ws_envio_pedidos',
            'endpointEnvioRecepcion' => 'https://wssappro.grupovips.com:443/sap/bc/srt/rfc/sap/zle_ws_recepcion_pedidos/123/zle_ws_recepcion_pedidos/zle_ws_recepcion_pedidos',
            'login' => 'WSTREVENQUE', //Usuario
            'password' => 'Athletic2015*', //Clave
        ),
    );

    /**
     * Credenciales activas. Se inicializan al activar el entorno
     * @var type 
     */
    static $credenciales = array(
        'wsdl' => '',
        'endpointEnvioPedidos' => '',
        'endpointEnvioRecepcion' => '',
        'key' => '', //Usuario
        'pass' => '', //Clave        
    );

    /**
     * Envia un paquete de pedidos a VIPS para su tramitación
     * 
     * El array de pedidos tiene dos dimensiones: idTienda y lineas de pedidos
     * 
     * @param string $tipoEntrega (D=Directa a la tienda, A=En la plataforma)
     * @param int $idDistribuidora
     * @param array $pedidos
     */
    static function enviaPedidos($tipoEntrega, $idDistribuidora, array $pedidos) {

        foreach ($pedidos as $keyTienda => $rows) {

            $i = 0;
            $pedido = array();
            $sucursal = new Sucursales($keyTienda);

            foreach ($rows as $row) {
                $linea = new PedidosLineas($row->idLineaPedido);
                $idPedido = $linea->getIdPedido()->getId();
                $numPedido = $idPedido * 1000 + $linea->getIdDistribuidora()->getId();
                $pedido[] = array(
                    "Zpedidoweb" => $numPedido,
                    "Zfecpedido" => date("Ymd"),
                    "Zproveedor" => $linea->getIdDistribuidora()->getCodigo(),
                    "Ztipoped" => $tipoEntrega,
                    "Zlinea" => $linea->getId(),
                    "Zunidad" => $sucursal->getCodigo(),
                    "Zcodean" => $linea->getEan(),
                    "Zcantidad" => (int) $linea->getUnidades(), // Sin decimales
                    "Zdescrip" => substr($linea->getDescripcion(), 0, 40),
                    "Zpreciovta" => str_pad($linea->getPrecio() * 100, 8, "0", STR_PAD_LEFT),
                    "Zpreciocosto" => str_pad($linea->getPvd() * 100, 8, "0", STR_PAD_LEFT),
                    "Zautor" => utf8_encode(substr($linea->getAutor(), 0, 35)),
                    "Zeditorial" => utf8_encode(substr($linea->getEditorial(), 0, 50)),
                    "Zporciva" => str_pad($linea->getIva() * 100, 5, "0", STR_PAD_LEFT),
                );
            }
            //echo "<BR/>PEDIDO PARA VIPS<BR/>";
            //print_r($pedido);

            $codPedidoDistribuidora = $rows[0]->cod_pedido;

            self::enviaPedido($idDistribuidora, $codPedidoDistribuidora, $pedido);
        }
    }

    /**
     * Envia un pedido a VIPS para su tramitación
     * 
     * @param int $idDistribuidora
     * @param string $codPedidoDistribuidora
     * @param array $pedido
     * @return boolean
     */
    static function enviaPedido($idDistribuidora, $codPedidoDistribuidora, array $pedido) {

        self::setEntorno();

        $options = array(
            'trace' => false,
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS + SOAP_USE_XSI_ARRAY_TYPE,
            'connection_timeout' => 10,
            //'soap_version' => SOAP_1_2,
            //'soap_action' => 'show',
            // Auth credentials for the SOAP request.
            'login' => self::$credenciales['login'],
            'password' => self::$credenciales['password'],
            //'Authorization' => 123456,
            //'language' => 'en',
            'encoding' => 'UTF-8',
            'location' => self::$credenciales['endpointEnvioPedidos'],
        );

        $arrayPedido = array(
            "EtMsgreturn" => array(),
            "ItPedidos" => $pedido,
        );

        $soap = new SoapClient(self::$credenciales['wsdl'], $options);
        try {
            $result = $soap->ZleWsEnvioPedidos($arrayPedido);

            $ok = ($result->EError == '');
            if (!$ok) {
                $asunto = "ERROR VALIDACION PEDIDO ENVIADO A VIPS";
                $mensaje = "<pre>" . print_r($result->EtMsgreturn, true) . "</pre>";
            }
        } catch (SoapFault $exp) {
            $mensaje = "Message: " . $exp->faultstring . "<br />";
            $mensaje .= "Error Code: " . $exp->faultcode . "<br />";
            $mensaje .= "Line: " . $exp->getLine() . "<br />";
            $mensaje .= "Detail:<pre>" . $exp->xdebug_message . "</pre>";
            $mensaje .= "Trace:<pre>" . $exp->getTraceAsString() . "</pre>";
            $asunto = "ERROR AL LLAMAR AL WS VIPS";
            $ok = false;
        }

        if (!$ok) {
            LogOperaciones::anota("ENVIO PEDIDO A VIPS", "KO", print_r($result->ItPedidos, true), $mensaje, $idDistribuidora, $codPedidoDistribuidora, "", true);
        } else {
            // Marcar las lineas de pedido como "En trámite VIPS" IdEstado=2
            // Por seguridad, se comprueba que el estado esté a 1 (En trámite distribuidora)
            $lineas = new PedidosLineas();
            foreach ($pedido as $item) {
                $lineas->queryUpdate(array('IdEstado' => 2), "Id='{$item['Zlinea']}'");
            }
            unset($lineas);
            LogOperaciones::anota("ENVIO PEDIDO A VIPS", "OK", print_r($result->ItPedidos, true), print_r($result->EtMsgreturn, true), $idDistribuidora, $codPedidoDistribuidora);
        }

        return $ok;
    }

    /**
     * Notifica a SAP la recepción producida en tienda, ya
     * sea una recepción directa (desde la distribuidora) o 
     * indirecta (desde plataforma)
     * 
     * @param array $lineasRecibidas Array de objetos líneas de pedidos
     */
    static function notificaRecepcionTienda($lineasRecibidas) {

        self::setEntorno();

        $options = array(
            'trace' => false,
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS + SOAP_USE_XSI_ARRAY_TYPE,
            'connection_timeout' => 10,
            //'soap_version' => SOAP_1_2,
            //'soap_action' => 'show',
            // Auth credentials for the SOAP request.
            'login' => self::$credenciales['login'],
            'password' => self::$credenciales['password'],
            //'Authorization' => 123456,
            //'language' => 'en',
            'encoding' => 'UTF-8',
            'location' => self::$credenciales['endpointEnvioRecepcion'],
        );

        $lineas = array();
        foreach ($lineasRecibidas as $linea) {
            $numPedido = $linea->getIdPedido()->getId() * 1000 + $linea->getIdDistribuidora()->getId();
            $idDistribuidora = $linea->getIdDistribuidora();
            $codPedidoDistribuidora = $linea->getPedidoDistribuidora();
            $lineas[] = array(
                "Zpedidoweb" => $numPedido,
                "Zfecpedido" => $linea->getIdPedido()->getFechaaaammdd(),
                "Zproveedor" => $linea->getIdDistribuidora()->getCodigo(),
                "Zlinea" => $linea->getId(),
                "Zunidad" => $linea->getIdSucursal()->getCodigo(),
                "Zpedidoprov" => $linea->getPedidoVips(),
                "Zcodean" => $linea->getEan(),
                "Zcantidad" => (int) $linea->getUnidades(), // Sin decimales
                "Zcantrec" => (int) $linea->getRecibidoTienda(), // Sin decimales
            );
        }

        $arrayPedido = array(
            "EtMsgreturn" => array(),
            "ItPedidos" => $lineas,
        );

        $soap = new SoapClient(self::$credenciales['wsdl'], $options);
        try {
            $result = $soap->ZleWsRecepcionPedidos($arrayPedido);

            $ok = ($result->EError == '');
            if (!$ok) {
                $asunto = "ERROR VALIDACION RECEPCION ENVIADA A VIPS";
                $mensaje = "<pre>" . print_r($result->EtMsgreturn, true) . "</pre>";
            }
        } catch (SoapFault $exp) {
            $mensaje = "Message: " . $exp->faultstring . "<br />";
            $mensaje .= "Error Code: " . $exp->faultcode . "<br />";
            $mensaje .= "Line: " . $exp->getLine() . "<br />";
            $mensaje .= "Detail:<pre>" . $exp->xdebug_message . "</pre>";
            $mensaje .= "Trace:<pre>" . $exp->getTraceAsString() . "</pre>";
            $asunto = "ERROR AL LLAMAR AL WS VIPS";
            $ok = false;
        }

        if (!$ok) {
            LogOperaciones::anota("ENVIO RECEPCION A VIPS", "KO", print_r($result->ItPedidos, true), $mensaje, $idDistribuidora, $codPedidoDistribuidora, "", true);
        } else {
            // Marcar las lineas de pedido como "En trámite VIPS" IdEstado=2
            // Por seguridad, se comprueba que el estado esté a 1 (En trámite distribuidora)
            $lineas = new PedidosLineas();
            foreach ($lineasRecibidas as $linea) {
                $lineas->queryUpdate(array('IdEstado' => 6), "Id='{$linea->getId()}'");
            }
            unset($lineas);
            LogOperaciones::anota("ENVIO RECEPCION A VIPS", "OK", print_r($result->ItPedidos, true), print_r($result->EtMsgreturn, true), $idDistribuidora, $codPedidoDistribuidora);
        }

        return array("ok" => $ok, "errores" => $result->EtMsgreturn);
    }

    /**
     * Cambia el entorno (dev:desarrollo; prod=produccion)
     */
    static function setEntorno($entorno = '') {

        if (($entorno == '') && (self::$entorno == '')) {
            $entorno = $_SESSION['wsvips_enviroment'];
        }

        self::$entorno = ($entorno != 'prod') ? "dev" : "prod";
        self::$credenciales = self::$arrayCredenciales[self::$entorno];
    }

}
