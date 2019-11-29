<?php

/**
    *class Tipo producto
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
 */
class tipo_producto {
    private $id_tipo_producto;
    private $nombre_tipo_producto;
    private $descripcion_tipo_producto;
    
    function __construct($id_tipo_producto, $nombre_tipo_producto, $descripcion_tipo_producto) {
        $this->id_tipo_producto = $id_tipo_producto;
        $this->nombre_tipo_producto = $nombre_tipo_producto;
        $this->descripcion_tipo_producto = $descripcion_tipo_producto;
    }
    
    function getId_tipo_producto() {
        return $this->id_tipo_producto;
    }

    function getNombre_tipo_producto() {
        return $this->nombre_tipo_producto;
    }

    function getDescripcion_tipo_producto() {
        return $this->descripcion_tipo_producto;
    }

    function setId_tipo_producto($id_tipo_producto) {
        $this->id_tipo_producto = $id_tipo_producto;
    }

    function setNombre_tipo_producto($nombre_tipo_producto) {
        $this->nombre_tipo_producto = $nombre_tipo_producto;
    }

    function setDescripcion_tipo_producto($descripcion_tipo_producto) {
        $this->descripcion_tipo_producto = $descripcion_tipo_producto;
    }



}
