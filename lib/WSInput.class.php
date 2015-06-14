<?php

/**
 * Description of WSInput
 *
 * Servicios web que reciben feedback de Vips
 * 
 * El número de pedido tramitado en SAP
 * Notificación de recepción de mercancía en la Plataforma (Almacén Central)
 * 
 * @author Sergio Pérez <info@albatronic.com>
 * @since 12.03.2015
 */
class WSInput {

    /**
     * Realiza la confirmación de pedidos por parte de VIPS
     * 
     * SE PUEDE HACER CONFIRMACIÓN PARCIAL DEL LOTE DE PEDIDOS RECIBIDOS
     * 
     * @param array $orders Array de parejas codigo pedido web - codigo de pedido Vips
     * @return array
     */
    static function confirmOrder($orders) {

        $pedidos = array();

        if (count($orders) > 0) {

            // Comprobar que todos los pedidos web a confirmar 
            // existen y están pendientes de confirmar por Vips
            foreach ($orders as $order) {
                $lineasPedido = PedidosLineas::getLineasDistribuidora($order['orderWeb']);
                if (count($lineasPedido) == 0) {
                    $pedidos[] = array(
                        'orderWeb' => $order['orderWeb'],
                        'orderVips' => $order['orderVips'],
                        'status' => 'KO',
                        'message' => 'Order web not found',
                    );
                } elseif ($lineasPedido[0]['IdEstado'] != 2) {
                    // Pedido web encontrado pero no está en situación de
                    // ser confirmado (Estado 2 = Pte confirmar Vips)
                    $pedidos[] = array(
                        'orderWeb' => $order['orderWeb'],
                        'orderVips' => $order['orderVips'],
                        'status' => 'KO',
                        'message' => 'Order web already confirmed',
                    );
                } else {
                    $pedidos[] = array(
                        'orderWeb' => $order['orderWeb'],
                        'orderVips' => $order['orderVips'],
                        'status' => 'OK',
                        'message' => '',
                    );
                }
            }

            LogOperaciones::anota("CONFIRMACION PEDIDOS DESDE VIPS", "OK", print_r($orders, true), print_r($pedidos, true), 0);

            // Marcar los pedidos recibidos y confirmar a la distribuidora
            $lineaPedido = new PedidosLineas();
            foreach ($pedidos as $order) {
                if ($order['status'] == 'OK') {
                    // Marco las líneas de pedido como confirmadas
                    PedidosLineas::confirmaVips($order['orderWeb'], $order['orderVips']);

                    // Envio a la distribuidora la confirmación 
                    $idPedido = (int) substr($order['orderWeb'], 0, 7);
                    $idDistribuidora = (int) substr($order['orderWeb'], 7, 3);

                    $linea = new PedidosLineas();
                    $rows = $linea->cargaCondicion("IdDistribuidora, PedidoDistribuidora", "IdPedido='{$idPedido}' and IdDistribuidora='{$idDistribuidora}'", "Id limit 1");
                    $row = $rows[0];

                    switch ($row['IdDistribuidora']) {
                        case '1':
                            WSArnoia::confirmar(array('orderWeb' => $row['PedidoDistribuidora'], 'orderVips' => $order['orderVips']));
                            break;
                    }

                    unset($linea);
                }
            }
        }

        return $pedidos;
    }

    /**
     * Confirma la recepción de líneas de pedidos en la plataforma
     * Este método es llamado desde SAP
     * 
     * @param array $orders
     * @return array
     */
    static function confirmInputPlataforma($orders) {

        if (count($orders) > 0) {

            $errores = 0;
            $nRecepciones = 0;
            $lineaPedido = new PedidosLineas();

            foreach ($orders as $key => $order) {
                // Le quito los tres últimos dígitos, que son el codigo de la distribuidora.
                $numPedido = (int) substr($order['orderWeb'],0,-3);
                $filtro = "Id='{$order['linea']}' and IdPedido='{$numPedido}' and PedidoVips='{$order['orderVips']}' and Ean='{$order['ean']}'";
                $rows = $lineaPedido->cargaCondicion("Id,IdEstado", $filtro);
                $row = $rows[0];
                if ($row['Id'] > 0) {
                    if ($row['IdEstado'] == 3) {
                        $lineaPedido->queryUpdate(array(
                            'DocumentoRecepcion' => $order['orderUni'], 'RecibidoPlataforma' => $order['cantidad'], 'IdEstado' => '4'), "Id='{$row['Id']}'");
                        $nRecepciones = $nRecepciones + 1;
                        $orders[$key]['status'] = 'OK';
                        $orders[$key]['message'] = "";
                    } else {
                        // Estado incorrecto
                        $orders[$key]['status'] = 'KO';
                        $orders[$key]['message'] = "Incorrect status ({$row['IdEstado']})";
                        $errores = $errores + 1;
                    }
                } else {
                    // Pedido no encontrado
                    $orders[$key]['status'] = 'KO';
                    $orders[$key]['message'] = "Order not found";
                    $errores = $errores + 1;
                }
            }

            if ($errores) {
                $result = array(
                    'status' => 'KO',
                    'message' => 'Some web orders not found or status incorrect.',
                );
            } else {
                $result = array(
                    'status' => 'OK',
                    'message' => count($nRecepciones) . ' web orders received in platform',
                );
            }
        } else {
            $result = array(
                'status' => 'KO',
                'message' => 'No orders found to received in platform'
            );
        }

        $result['orders'] = $orders;

        LogOperaciones::anota("RECEPCION PEDIDOS PLATAFORMA VIPS", $result['status'], print_r($orders, true), print_r($result, true), 0);

        return $result;
    }

    /**
     * Devuelve firma en base64 encode
     * 
     * @param string $key
     * @param string $text
     * @return string
     */
    static function getSignature($key, $text) {
        return base64_encode($key . $text);
    }

}
