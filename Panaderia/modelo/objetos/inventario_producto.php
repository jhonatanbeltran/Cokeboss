<?php

    /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

class inventario_producto {
    
    private $id_producto;
    private $id_inventario;
    private $fecha_inventario;
    private $cantidad_inv_producto;
    private $descripcion;
    private $estado;
    private $precio;
    
    function __construct($id_producto, $id_inventario, $fecha_inventario, $cantidad_inv_producto, $descripcion, $estado, $precio) {
        $this->id_producto = $id_producto;
        $this->id_inventario = $id_inventario;
        $this->fecha_inventario = $fecha_inventario;
        $this->cantidad_inv_producto = $cantidad_inv_producto;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->precio = $precio;
    }

    function getId_producto() {
        return $this->id_producto;
    }
    function getPrecio() {
        return $this->precio;
    }

    function getId_inventario() {
        return $this->id_inventario;
    }

    function getFecha_inventario() {
        return $this->fecha_inventario;
    }

    function getCantidad_inv_producto() {
        return $this->cantidad_inv_producto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
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

    function setCantidad_inv_producto($cantidad_inv_producto) {
        $this->cantidad_inv_producto = $cantidad_inv_producto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setPrecio($precio) {
        $this->precio = $precio;
    }


    
}
