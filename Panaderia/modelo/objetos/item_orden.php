<?php

 /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class item_orden {
    
    private $id_item_orden;
    private $id_pedido_orden;
    private $id_producto;
    private $cantidad;
    private $descripcion;
    private $fecha;
    
    function __construct($id_item_orden, $id_pedido_orden, $id_producto, $cantidad, $descripcion, $fecha) {
        $this->id_item_orden = $id_item_orden;
        $this->id_pedido_orden = $id_pedido_orden;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
    }
    function getId_item_orden() {
        return $this->id_item_orden;
    }

    function getId_pedido_orden() {
        return $this->id_pedido_orden;
    }

    function getId_producto() {
        return $this->id_producto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId_item_orden($id_item_orden) {
        $this->id_item_orden = $id_item_orden;
    }

    function setId_pedido_orden($id_pedido_orden) {
        $this->id_pedido_orden = $id_pedido_orden;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }


    

}
