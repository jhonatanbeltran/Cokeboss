<?php

/**
    *class Producto Materia
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
 */
class producto_materia {
    
    private $id_materia_prima;
    private $id_producto;
    private $id_inventario;
    private $fecha_inventario;
    private $peso_producto_materia;
    private $cantidad_producto_materia;
    
    function __construct($id_materia_prima, $id_producto, $id_inventario, $fecha_inventario, $peso_producto_materia, $cantidad_producto_materia) {
        $this->id_materia_prima = $id_materia_prima;
        $this->id_producto = $id_producto;
        $this->id_inventario = $id_inventario;
        $this->fecha_inventario = $fecha_inventario;
        $this->peso_producto_materia = $peso_producto_materia;
        $this->cantidad_producto_materia = $cantidad_producto_materia;
    }
    
    function getId_materia_prima() {
        return $this->id_materia_prima;
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

    function getPeso_producto_materia() {
        return $this->peso_producto_materia;
    }

    function getCantidad_producto_materia() {
        return $this->cantidad_producto_materia;
    }

    function setId_materia_prima($id_materia_prima) {
        $this->id_materia_prima = $id_materia_prima;
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

    function setPeso_producto_materia($peso_producto_materia) {
        $this->peso_producto_materia = $peso_producto_materia;
    }

    function setCantidad_producto_materia($cantidad_producto_materia) {
        $this->cantidad_producto_materia = $cantidad_producto_materia;
    }



}
