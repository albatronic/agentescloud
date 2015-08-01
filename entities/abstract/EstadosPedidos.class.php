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
        array('Id' => '0', 'Value' => 'Pte. Servir'),
        array('Id' => '1', 'Value' => 'Semi facturado'),
        array('Id' => '2', 'Value' => 'Facturado'),
    );
}
