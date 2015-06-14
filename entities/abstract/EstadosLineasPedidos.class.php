<?php

/**
 * Define los estados de las líneas de pedidos de compra
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @copyright Informática ALBATRONIC, SL
 * @since 19-nov-2011
 *
 */
class EstadosLineasPedidos extends Tipos {

    protected $tipos = array(
        array('Id' => '0', 'Value' => 'Pte. Confirmar'),
        array('Id' => '1', 'Value' => 'En trámite Distribuidor'),
        array('Id' => '2', 'Value' => 'Pte. Confirmar VIPS'),
        array('Id' => '3', 'Value' => 'Pedido en firme'),
        array('Id' => '4', 'Value' => 'Recepcionado Central'),
        array('Id' => '5', 'Value' => 'Recepcionado Tienda'),
        array('Id' => '6', 'Value' => 'Recepcion notificada'),
        array('Id' => '9', 'Value' => 'Anulado'),
    );

}
