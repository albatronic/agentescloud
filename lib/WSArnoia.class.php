<?php

/**
 * Description of WSArnoia
 *
 * @author Sergio Pérez <info@albatronic.com>
 */
class WSArnoia extends WebService {

    /**
     * El id de Arnoia de la tabla de distribuidoras
     * @var integer
     */
    static $idDistribuidora = 1;

    /**
     * Estados en los que se considera que el producto es comprable.
     * @var array
     */
    static $estadosComprable = array('Disponible', 'En breve');

    /**
     * La url del servicio web
     * @var string
     */
    static $urlEndPoint = "http://www.arnoia.com/serviciosweb/vips/index.php?service=";

    /**
     * Parámetros para el cacheo de consultas
     * @var array
     */
    static $memCache = array(
        'activo' => false,
        'host' => 'localhost',
        'port' => 11211,
        'expire' => 1800, // Número de segundos a mantener la consulta
    );

    /**
     * Tiempo de espera para las peticiones al servidor
     * @var integer
     */
    static $timeOut = 10;
    static $resultado = array();

    static function busca($titulo) {

        // Coger el código de tienda que tiene la sucursal actual para Arnoia
        $sucursal = new Sucursales($_SESSION['usuarioPortal']['SucursalActiva']['Id']);
        $codigoTienda = $sucursal->getCodigoTiendaDistribuidora(self::$idDistribuidora);
        unset($sucursal);

        $xmlcontent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><BookSearch_IN><Header><sentDateTime>" . date('c') . "</sentDateTime></Header>";
        $xmlcontent .= "<cod_gesdis>{$codigoTienda}</cod_gesdis>";
        $xmlcontent .= ($ISBN != "" ? "<ISBN>" . $ISBN . "</ISBN>" : "<ISBN/>");
        $xmlcontent .= ($titulo != "" ? "<Titulo>" . $titulo . "</Titulo>" : "<Titulo/>");
        $xmlcontent .= ($autor != "" ? "<Autor>" . $autor . "</Autor>" : "<Autor/>");
        $xmlcontent .= ($editorial != "" ? "<Editorial>" . $editorial . "</Editorial>" : "<Editorial/>");
        $xmlcontent .= ($estudio != "" ? "<Estudio>" . $estudio . "</Estudio>" : "<Estudio/>");
        $xmlcontent .= ($curso != "" ? "<Curso>" . $curso . "</Curso>" : "<Curso/>");
        $xmlcontent .= ($asignatura != "" ? "<Asignatura>" . $asignatura . "</Asignatura>" : "<Asignatura/>");
        $xmlcontent .= ($comunidad != "" ? "<ComunidadAutonoma>" . $comunidad . "</ComunidadAutonoma>" : "<ComunidadAutonoma/>");
        $xmlcontent .= ($idioma != "" ? "<Idioma>" . $idioma . "</Idioma>" : "<Idioma/>");
        $xmlcontent .= "</BookSearch_IN>";
        $xmlcontent = utf8_encode($xmlcontent);

        if (!self::$memCache['activo']) {
            $result = self::getRequest(self::$urlEndPoint . "busqueda", "POST", "datos={$xmlcontent}", false, self::$timeOut);
            $resultado = ($result['info']['http_code'] == '200') ? json_decode($result['result']) : array();
            self::postProcesoBusqueda($resultado);
        } else {
            $keyMemcache = md5(self::$idDistribuidora . $titulo);
            $memCache = new Memcache();
            $memCache->connect(self::$memCache['host'], self::$memCache['port']);
            self::$resultado = $memCache->get($keyMemcache);
            if (!self::$resultado) {
                $result = self::getRequest(self::$urlEndPoint . "busqueda", "POST", "datos={$xmlcontent}", false, self::$timeOut);
                $resultado = ($result['info']['http_code'] == '200') ? json_decode($result['result']) : array();
                self::postProcesoBusqueda($resultado);
                $memCache->set($keyMemcache, self::$resultado, MEMCACHE_COMPRESSED, self::$memCache['expire']);
                //echo "Meto en cache ", $titulo, " Respuesta: <br/>";//print_r($response);
            } else {
                //echo "Saco de cache ", $titulo," Respuesta: <br/>";//print_r($response);
            }
        }

        return self::$resultado;
    }

    static private function postProcesoBusqueda($resultado) {

        $variables = new Variables('Pro', 'Env');
        $margenGlobal = $variables->getNode("margenGlobal");
        unset($variables);
        if ($margenGlobal < 0) {
            $margenGlobal = 0;
        }

        $distribuidora = new Distribuidoras(self::$idDistribuidora);
        $codDistribuidora = $distribuidora->getCodigo();
        $nombreDistribuidora = $distribuidora->getRazonSocial();
        unset($distribuidora);

        foreach ($resultado as $key => $item) {

            // Hacer que el índice del array sea el ean
            $keyISBN = $item->ISBN;
            self::$resultado[$keyISBN] = $item;

            // Poner un id único
            self::$resultado[$keyISBN]->id = $codDistribuidora . "-" . self::$resultado[$keyISBN]->codigo;
            self::$resultado[$keyISBN]->Sku = self::$resultado[$keyISBN]->codigo;
            self::$resultado[$keyISBN]->Ean = self::$resultado[$keyISBN]->ISBN;

            // Validar la url de la imagen
            if (!self::$resultado[$keyISBN]->urlimagen) {
                self::$resultado[$keyISBN]->urlimagen = "images/NOportada.jpg";
            }

            // Poner el nodo del código de distribuidora
            self::$resultado[$keyISBN]->CodDistribuidora = $codDistribuidora;
            self::$resultado[$keyISBN]->IdDistribuidora = self::$idDistribuidora;
            self::$resultado[$keyISBN]->NombreDistribuidora = $nombreDistribuidora;

            //print_r(self::$resultado);
            // Calcular el pvp de los eventuales libros con precio libre
            // El nodo "Precio" será el precio de costo que hay que incrementar
            // con el margen comercial y el porcentaje de iva
            if ((self::$resultado[$keyISBN]->precio_libre == 'S') || (self::$resultado[$keyISBN]->tipo_articulo == 'P')) {
                $codEditorial = substr(self::$resultado[$keyISBN]->codigo, 0, 3);
                $obj = new Editoriales();
                $editorial = $obj->find("CodigoEditorial", $codEditorial);
                $margenEditorial = $editorial->getMargen();
                unset($editorial);
                $margen = ($margenEditorial > 0) ? $margenEditorial : $margenGlobal;
                self::$resultado[$keyISBN]->Precio = self::$resultado[$keyISBN]->Precio * (1 + $margen / 100);
            }

            // Incrementar el IVA
            self::$resultado[$keyISBN]->Precio = self::$resultado[$keyISBN]->Precio * (1 + self::$resultado[$keyISBN]->Iva / 100);

            // Poner si es comprable o no en base a la disponibilidad
            self::$resultado[$keyISBN]->Comprable = in_array(self::$resultado[$keyISBN]->Disponibilidad, self::$estadosComprable);
        }
    }

    /**
     * Hace reserva en Arnoia y marca cada linea
     * de pedido con el estado 1 (En tramite Distribuidora) si se
     * ha producido la reserva. En caso contrario deja el estado a 0
     * 
     * SE RESERVAN PEDIDOS COMPLETOS.
     * Si falta stock de algún producto, se anula el pedido a Arnoia
     * 
     * @param array $articulos
     * @return array
     */
    static function reservar(array $articulos) {

        $xmlcontent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $xmlcontent .= "<OrderSave_IN><Header><sentDateTime>" . date('c') . "</sentDateTime></Header>";
        $xmlcontent .= "<ListaLibros>";
        foreach ($articulos as $articulo) {
            $xmlcontent .= "<Libro>";
            $xmlcontent .= "<idLineaPedido>{$articulo['idLineaPedido']}</idLineaPedido>";
            $xmlcontent .= "<Cliente>{$articulo['cliente']}</Cliente>";
            $xmlcontent .= "<Codigo>{$articulo['sku']}</Codigo>";
            $xmlcontent .= "<Cantidad>{$articulo['unidades']}</Cantidad>";
            $xmlcontent .= "</Libro>";
        }
        $xmlcontent .= "</ListaLibros></OrderSave_IN>";
        $xmlcontent = utf8_encode($xmlcontent);

        $result = self::getRequest(self::$urlEndPoint . "pedido", "POST", "datos={$xmlcontent}", false, self::$timeOut);
        $status = ($result['info']['http_code'] == '200') ? 'OK' : 'KO';
        self::$resultado = ($status == 'OK') ? json_decode($result['result']) : array();

        //print_r(self::$resultado);
        // Recorro el resultado y marco las líneas
        // de pedido que han sido confirmadas por arnoia
        if ($status == 'OK') {

            LogOperaciones::anota(
                    "RESERVAR EN ARNOIA", $status, sfYaml::dump($articulos), print_r(self::$resultado, true), self::$idDistribuidora, self::$resultado[0]->cod_pedido);

            $pedidoCompleto = true;

            foreach (self::$resultado as $item) {
                if ($item->can_pedida != $item->can_reservada) {
                    $pedidoCompleto = false;
                }
                // Actualizar todas las lineas con el número de pedido de la distribuidora
                // y el número de veces que se ha intentado pedir
                $lineas = new PedidosLineas($item->idLineaPedido);
                $lineas->setPedidoDistribuidora($item->cod_pedido);
                $lineas->setNumeroIntentos($lineas->getNumeroIntentos() + 1);
                $lineas->save();
                //$lineas->queryUpdate(array('PedidoDistribuidora' => $item->cod_pedido), "Id='{$item->idLineaPedido}' and IdEstado='0'");
            }

            if ($pedidoCompleto) {
                // Cambiar el estado de las líneas a 1 (En trámite Distribuidor)
                reset(self::$resultado);
                $lineas = new PedidosLineas();
                foreach (self::$resultado as $item) {
                    if ($item->can_pedida == $item->can_reservada) {
                        $lineas->queryUpdate(array('IdEstado' => 1), "Id='{$item->idLineaPedido}' and IdEstado='0'");
                        // Cambiar el estado de la cabecera del pedido
                        $linea = new PedidosLineas($item->idLineaPedido);
                        $pedido = new PedidosCab($linea->getIdPedido()->getId());
                        $pedido->setIdEstado(1);
                        $pedido->save();
                    }
                }
            } else {
                // No hay suficiente stock. Se le comunica a Arnoia que no queremos el pedido
                self::anulaPedido("ANULAR PEDIDO EN ARNOIA. STOCK INSUFICIENTE", self::$resultado[0]->cod_pedido);
            }
        } else {
            LogOperaciones::anota(
                    "RESERVAR EN ARNOIA. Fallo en la llamada", $status, $xmlcontent, print_r($result, true), self::$idDistribuidora, self::$resultado[0]->cod_pedido);
        }

        return array(
            'pedidoCompleto' => $pedidoCompleto,
            'resultado' => self::$resultado
        );
    }

    /**
     * Hace una llamada a Arnoia indicando que anule un pedido
     * 
     * @param integer $codigoPedido Código de pedido de Arnoia
     * @return type
     */
    static function anulaPedido($mensaje, $codigoPedido) {

        // Para obtener el código de cliente asignado por la distribuidora
        // a la tienda de la que hay que anular el pedido.
        $lineas = new PedidosLineas();
        $rows = $lineas->cargaCondicion("IdSucursalPedido", "PedidoDistribuidora='{$codigoPedido}'", "Id limit 1");
        $sucursal = new Sucursales($rows[0]['IdSucursalPedido']);
        $codigoCliente = $sucursal->getCodigoTiendaDistribuidora(self::$idDistribuidora);
        unset($sucursal);
        unset($lineas);


        $xmlcontent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $xmlcontent .= "<borrado>";
        $xmlcontent .= "<Cliente>{$codigoCliente}</Cliente>";
        $xmlcontent .= "<cod_pedido>{$codigoPedido}</cod_pedido>";
        $xmlcontent .= "</borrado>";
        $xmlcontent = utf8_encode($xmlcontent);

        $result = self::getRequest(self::$urlEndPoint . "borrarPedido", "POST", "datos={$xmlcontent}", false, self::$timeOut);
        $status = ($result['info']['http_code'] == '200') ? 'OK' : 'KO';
        $resultado = ($status == 'OK') ? json_decode($result['result']) : array();

        LogOperaciones::anota(
                $mensaje, $status, $xmlcontent, print_r($resultado, true), self::$idDistribuidora, $codigoPedido);
        //echo "<br/>Petición:<br/>", $xmlcontent;
        //echo "Resultado:<br/>"; print_r($result);

        return $resultado;
    }

    /**
     * Envía confirmación de pedido a Arnoia,
     * indicando para cada código de pedido Arnoia el
     * código de pedido VIPS
     * 
     * @param array $pedido
     */
    static function confirmar(array $pedido) {

        $xmlcontent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $xmlcontent .= "<root><cod_pedido_gesdis>{$pedido['orderWeb']}</cod_pedido_gesdis>";
        $xmlcontent .= "<num_pedido_SAP>{$pedido['orderVips']}</num_pedido_SAP></root>";
        $xmlcontent = utf8_encode($xmlcontent);

        $result = self::getRequest(self::$urlEndPoint . "confirmaPedidoSAP", "POST", "datos={$xmlcontent}", false, self::$timeOut);
        $status = ($result['info']['http_code'] == '200') ? 'OK' : 'KO';
        $resultado = ($status == 'OK') ? json_decode($result['result']) : array();

        //echo "<br/>Petición:<br/>", $xmlcontent;
        //echo "Resultado:<br/>";
        //print_r($result);

        LogOperaciones::anota("ENVIO CONFIRMACION PEDIDOS A DISTRIBUIDORA", $status, print_r($pedido, true), print_r($resultado, true), self::$idDistribuidora, $pedido['orderWeb'], $pedido['orderVips']);

        return $resultado;
    }

}
