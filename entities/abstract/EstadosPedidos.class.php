<?php
/**
 * Define los estados de los pedidos de compra
 *
 * @author Sergio Pérez <sergio.perez@albatronic.com>
 * @copyright Informática ALBATRONIC, SL
 * @since 19-nov-2011
 *
 */

class EstadosPedidos extends Tipos {

    protected $tipos = array(
        array('Id' => '0', 'Value' => 'Pte. Confirmar'),
        array('Id' => '1', 'Value' => 'En trámite Distribuidor'),
        array('Id' => '2', 'Value' => 'Pte. Confirmar VIPS'),
        array('Id' => '3', 'Value' => 'Confirmación VIPS Parcial'),
        array('Id' => '4', 'Value' => 'Pedido en firme'),
        array('Id' => '5', 'Value' => 'Recepcionado Central'),
        array('Id' => '6', 'Value' => 'Recepcionado Tienda'),
    );
}
