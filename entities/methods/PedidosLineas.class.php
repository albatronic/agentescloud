<?php

/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 23:09:11
 */

/**
 * @orm:Entity(PedidosLineas)
 */
class PedidosLineas extends PedidosLineasEntity {

    public function __toString() {
        return ($this->Id) ? $this->Id : '';
    }

    /**
     * Validaciones antes de actualizar o crear
     */
    public function valida() {
        
        unset($this->_errores);

        return ( count($this->_errores) == 0 );
    }

    /**
     * Marca la linea de pedido como anulada. Es el caso
     * de pedidos entregados parcialmente para que no aparezcan
     * en el proceso de conformación de facturas
     */
    public function anula() {
        $this->Deleted = 1;
        $this->DeletedAt = date('Y-m-d H:i:s');
        $this->DeletedBy = $_SESSION['usuarioPortal']['Id'];
        $this->save();
    }

    /**
     * Valida antes del borrado
     * Devuelve TRUE o FALSE
     * Si hay errores carga el array $this->_errores
     * @return boolean
     */
    public function validaBorrado() {

        parent::validaBorrado();

        if ($this->UnidadesPtesFacturar == 0) {
            $this->_errores[] = "No se puede borrar la línea. Está facturada";
        }
        return (count($this->_errores) == 0);
    }

}
