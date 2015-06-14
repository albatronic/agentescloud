
<?php

/**
 * Clase estática para realizar las operaciones
 * con el carrito de la compra
 * 
 * @author Sergio Pérez <info@albatronic.com>
 * 
 */
class ErpCarrito {

    static $errores;
    static $alertas;

    /**
     * Devuelve array con dos elementos:
     * 
     * lineas => array de objetos líneas de carrito
     * totales => array('Unidades,'Importe')
     * 
     * @return array
     */
    static function getCarrito() {

        $carrito = new Carrito();

        $lineas = array();

        $filtro = "Sesion='{$_SESSION['IdSesion']}'";
        $rows = $carrito->cargaCondicion("Id", $filtro, "Id ASC");
        foreach ($rows as $row) {
            $lineas[] = self::getLinea($row['Id'])->iterator();
        }
        unset($carrito);

        return array("lineas" => $lineas, "totales" => self::getTotales());
    }

    /**
     * Devuele el objeto linea del carrito en curso cuyo id es $idLinea
     * 
     * @param integer $idLinea
     * @return \Carrito
     */
    static function getLinea($idLinea) {
        return new Carrito($idLinea);
    }

    /**
     * Devuelve array con los ids de los artículos del carrito
     * @return array
     */
    static function getArrayIDSArticulos() {

        $array = array();

        $filtro = "Sesion='{$_SESSION['IdSesion']}'";
        $carrito = new Carrito();
        $rows = $carrito->cargaCondicion("IDArticulo", $filtro, "Id ASC");
        unset($carrito);

        foreach ($rows as $row) {
            $array[$row['IDArticulo']] = $row['IDArticulo'];
        }

        return $array;
    }

    /**
     * Añade o incrementa un artículo al carrito asociado
     * a la sesión en curso
     * 
     * @param array $articulo Array con los datos del articulo
     * @param integer $unidades Las unidades de producto
     * @return integer El id de la línea creada
     */
    static function addProduct($articulo, $unidades = 1) {

        $unidades = ($unidades < 1) ? 1 : $unidades;

        $filtro = "Sesion='{$_SESSION['IdSesion']}' and Sku='{$articulo->Sku}'";
        $carrito = new Carrito();
        $rows = $carrito->cargaCondicion("Id", $filtro);
        if (isset($rows[0]['Id'])) {
            $carrito = new Carrito($rows[0]['Id']);

            $carrito->setUnidades($carrito->getUnidades() + $unidades);
            $carrito->setImporte($carrito->getUnidades() * $carrito->getPrecio());
            $id = ($carrito->save()) ? $rows[0]['Id'] : 0;
            self::$errores = $carrito->getErrores();
            self::$alertas = $carrito->getAlertas();
        } else {
            $ivaIncluido = 1; //($_SESSION['varEnv']['Pro']['ivaIncluido']) ? 1 : 0;

            $carrito->setsesion($_SESSION['IdSesion']);
            $carrito->setIpOrigen($_SERVER['REMOTE_ADDR']);
            $carrito->setUserAgent($_SERVER['HTTP_USER_AGENT']);
            $carrito->setIdSucursal($_SESSION['usuarioPortal']['SucursalActiva']['Id']);
            $carrito->setIdDistribuidora($articulo->IdDistribuidora);
            $carrito->setIdUsuario($_SESSION['usuarioPortal']['Id']);
            $carrito->setSku($articulo->Sku);
            $carrito->setEan($articulo->Ean);
            $carrito->setDescripcion($articulo->Titulo);
            $carrito->setAutor($articulo->Autor);
            $carrito->setEditorial($articulo->Editorial);
            $carrito->setUnidades($unidades);
            $carrito->setPrecio($articulo->Precio);
            $carrito->setUrlImagen($articulo->urlimagen);
            $carrito->setDescuento($articulo->Descuento);
            $carrito->setPvd($articulo->Precio * (1 - $articulo->Descuento / 100));
            $carrito->setImporte($carrito->getUnidades() * $carrito->getPrecio());
            $carrito->setIva($articulo->Iva);
            //$carrito->setRecargo($articulo->getIDIva()->getRecargo());
            $carrito->setEstado(0);
            $carrito->setIvaIncluido($ivaIncluido);
            $id = $carrito->create();
            self::$errores = $carrito->getErrores();
            self::$alertas = $carrito->getAlertas();
            unset($articulo);
        }
        unset($carrito);

        return $id;
    }

    /**
     * Borrar una línea del carrito de la sesion en curso
     * 
     * @param integer $idLinea El id de la linea
     * @return boolean True se el borrado ha sido ok
     */
    static function removeProduct($idLinea) {

        $carrito = new Carrito();
        $filtro = "Sesion='{$_SESSION['IdSesion']}' and Id='{$idLinea}'";
        $ok = ($carrito->queryDelete($filtro) > 0);
        unset($carrito);

        return $ok;
    }

    /**
     * Actualiza la línea $idLinea del carrito en curso con las
     * unidades $unidades de producto, actualizando también el importe de la línea
     * 
     * @param integer $idLinea El id de la línea a actualizar
     * @param decimal $unidades El número de unidades de producto a actulizar
     * @return integer El id de la línea actualizada
     */
    static function updateProduct($idLinea, $unidades) {

        $carrito = new Carrito($idLinea);
        $idLinea = $carrito->getId();
        if ($idLinea) {
            $carrito->setUnidades($unidades);
            $carrito->setImporte($carrito->getPrecio() * $unidades); // * (1 - $carrito->getDescuento() / 100));
            $carrito->save();
            self::$errores = $carrito->getErrores();
            self::$alertas = $carrito->getAlertas();
        }

        return $idLinea;
    }

    /**
     * Devuelve array con los totales del carrito
     * de la sesion en curso.
     * 
     * El array tiene dos elementos: Unidades, Importe
     * 
     * @return array Array con los totales
     */
    static function getTotales() {

        $carrito = new Carrito();
        $filtro = "Sesion='{$_SESSION['IdSesion']}'";
        $rows = $carrito->cargaCondicion("sum(Unidades) as Unidades, sum(Importe) as Importe", $filtro);

        foreach ($_SESSION['carrito'] as $key => $value) {
            $rows[0][$key] = $value;
        }
        $rows[0]['total'] = $rows[0]['Importe'] + $rows[0]['gastosEnvio'];

        //Quitar los decimales de las unidades
        $rows[0]['Unidades'] = number_format($rows[0]['Unidades'], 0);

        return $rows[0];
    }

    /**
     * Crea pedido web en base a lo que hay
     * en el carrito de la sesion en curso.
     * 
     * Si ya hubiera un pedido asociado a esa sesion,
     * lo borra y lo crea de nuevo
     * 
     * @param integer $idCliente EL id del cliente
     * @param boolean $avisoRecepcionParcial
     * @return integer $idPedido
     */
    static function creaPedido($idCliente, $avisoRecepcionParcial = 0) {

        if ($avisoRecepcionParcial == '') {
            $avisoRecepcionParcial = 0;
        }
        
        $carrito = new Carrito();
        $filtro = "Sesion='{$_SESSION['IdSesion']}'";
        $rows = $carrito->cargaCondicion("*", $filtro, "Id ASC");
        unset($carrito);

        $totales = self::getTotales();

        $pedido = new PedidosCab();
        $pedido->setIdSucursal($_SESSION['usuarioPortal']['SucursalActiva']['Id']);
        $pedido->setIdUsuario($_SESSION['usuarioPortal']['Id']);
        $pedido->setIdCliente($idCliente);
        $pedido->setFecha(date('Y-m-d H:i:s'));
        $pedido->setNItems($totales['Unidades']);
        $pedido->setImporte($totales['total']);
        $pedido->setAvisoRecepcionParcial($avisoRecepcionParcial);
        $idPedido = $pedido->create();

        if ($idPedido > 0) {
            // Crear las líneas
            foreach ($rows as $row) {
                $linea = new PedidosLineas();
                $linea->setIdPedido($idPedido);
                $linea->setIdSucursal($row['IdSucursal']);
                $linea->setIdDistribuidora($row['IdDistribuidora']);
                $linea->setIdUsuario($row['IdUsuario']);
                $linea->setIdCliente($idCliente);
                $linea->setSku($row['Sku']);
                $linea->setEan($row['Ean']);
                $linea->setDescripcion($row['Descripcion']);
                $linea->setAutor($row['Autor']);
                $linea->setEditorial($row['Editorial']);
                $linea->setUrlImagen($row['UrlImagen']);
                $linea->setUnidades($row['Unidades']);
                $linea->setPrecio($row['Precio']);
                $linea->setDescuento($row['Descuento']);
                $linea->setPvd($row['Pvd']);
                $linea->setImporte($row['Importe']);
                $linea->setIva($row['Iva']);
                $linea->setRecargo($row['Recargo']);
                $linea->setIdEstado(0);
                $linea->setIvaIncluido($row['IvaIncluido']);
                $linea->create();
                //print_r($linea->getErrores());
            }
        }

        return $idPedido;
    }

    /**
     * Vacia el carrito de la sesion en curso
     * 
     * @return boolean True si éxito
     */
    static function vaciaCarrito() {

        $carrito = new Carrito();
        $filtro = "Sesion='{$_SESSION['IdSesion']}'";
        $ok = ($carrito->queryDelete($filtro) > 0);
        unset($carrito);

        return $ok;
    }

    static function getErrores() {
        return self::$errores;
    }

    static function getAlertas() {
        return self::$alertas;
    }

}
