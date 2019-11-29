<?php

/**
    *class Pedido Orden
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class pedido_orden {
    
    private $id_pedido_orden;
    private $documento_cliente;
    private $descripcion_pedido_orden;
    
    function __construct($id_pedido_orden, $documento_cliente, $descripcion_pedido_orden) {
        $this->id_pedido_orden = $id_pedido_orden;
        $this->documento_cliente = $documento_cliente;
        $this->descripcion_pedido_orden = $descripcion_pedido_orden;
    }
    
    function getId_pedido_orden() {
        return $this->id_pedido_orden;
    }

    function getDocumento_cliente() {
        return $this->documento_cliente;
    }

    function getDescripcion_pedido_orden() {
        return $this->descripcion_pedido_orden;
    }

    function setId_pedido_orden($id_pedido_orden) {
        $this->id_pedido_orden = $id_pedido_orden;
    }

    function setDocumento_cliente($documento_cliente) {
        $this->documento_cliente = $documento_cliente;
    }

    function setDescripcion_pedido_orden($descripcion_pedido_orden) {
        $this->descripcion_pedido_orden = $descripcion_pedido_orden;
    }



}
