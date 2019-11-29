<?php

/**
    *class Producto
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class producto {
    private $id_producto;
    private $id_tipo_producto;
    private $nombre_producto;
    private $estado_producto;
    private $peso_producto;
    private $descripcion_producto;
    
    function __construct($id_producto, $id_tipo_producto, $nombre_producto, $estado_producto, $peso_producto, $descripcion_producto) {
        $this->id_producto = $id_producto;
        $this->id_tipo_producto = $id_tipo_producto;
        $this->nombre_producto = $nombre_producto;
        $this->estado_producto = $estado_producto;
        $this->peso_producto = $peso_producto;
        $this->descripcion_producto = $descripcion_producto;
    }
    
    function getId_producto() {
        return $this->id_producto;
    }

    function getId_tipo_producto() {
        return $this->id_tipo_producto;
    }

    function getNombre_producto() {
        return $this->nombre_producto;
    }

    function getEstado_producto() {
        return $this->estado_producto;
    }

    function getPeso_producto() {
        return $this->peso_producto;
    }

    function getDescripcion_producto() {
        return $this->descripcion_producto;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setId_tipo_producto($id_tipo_producto) {
        $this->id_tipo_producto = $id_tipo_producto;
    }

    function setNombre_producto($nombre_producto) {
        $this->nombre_producto = $nombre_producto;
    }

    function setEstado_producto($estado_producto) {
        $this->estado_producto = $estado_producto;
    }

    function setPeso_producto($peso_producto) {
        $this->peso_producto = $peso_producto;
    }

    function setDescripcion_producto($descripcion_producto) {
        $this->descripcion_producto = $descripcion_producto;
    }



}
?>