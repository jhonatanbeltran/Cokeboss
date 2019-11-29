<?php

/**
    *class Pedido
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class pedido {
    
    private $id_pedido;
    private $documento_cliente;
    private $id_producto;
    private $id_inventario;
    private $fecha_inventario;
    private $cantidad_pedido;
    private $precio_pedido;
    private $tiempo_pedido;
    private $estado;
    private $total_pedido;
    
    function __construct($id_pedido, $documento_cliente, $id_producto, $id_inventario, $fecha_inventario, $cantidad_pedido, $precio_pedido, $tiempo_pedido, $estado, $total_pedido) {
        $this->id_pedido = $id_pedido;
        $this->documento_cliente = $documento_cliente;
        $this->id_producto = $id_producto;
        $this->id_inventario = $id_inventario;
        $this->fecha_inventario = $fecha_inventario;
        $this->cantidad_pedido = $cantidad_pedido;
        $this->precio_pedido = $precio_pedido;
        $this->tiempo_pedido = $tiempo_pedido;
        $this->estado = $estado;
        $this->total_pedido = $total_pedido;
    }
    
    function getId_pedido() {
        return $this->id_pedido;
    }

    function getDocumento_cliente() {
        return $this->documento_cliente;
    }

    function getId_producto() {
        return $this->id_producto;
    }

    function getId_inventario() {
        return $this->id_inventario;
    }

    function getFecha_inventario() {
        return $this->fecha_inventario;
    }

    function getCantidad_pedido() {
        return $this->cantidad_pedido;
    }

    function getPrecio_pedido() {
        return $this->precio_pedido;
    }

    function getTiempo_pedido() {
        return $this->tiempo_pedido;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTotal_pedido() {
        return $this->total_pedido;
    }

    function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    function setDocumento_cliente($documento_cliente) {
        $this->documento_cliente = $documento_cliente;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setId_inventario($id_inventario) {
        $this->id_inventario = $id_inventario;
    }

    function setFecha_inventario($fecha_inventario) {
        $this->fecha_inventario = $fecha_inventario;
    }

    function setCantidad_pedido($cantidad_pedido) {
        $this->cantidad_pedido = $cantidad_pedido;
    }

    function setPrecio_pedido($precio_pedido) {
        $this->precio_pedido = $precio_pedido;
    }

    function setTiempo_pedido($tiempo_pedido) {
        $this->tiempo_pedido = $tiempo_pedido;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTotal_pedido($total_pedido) {
        $this->total_pedido = $total_pedido;
    }



}
?>