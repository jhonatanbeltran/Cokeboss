<?php

/**
    *class Producto proceso
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
 */
class producto_proceso {
    private $id_producto;
    private $id_proceso;
    private $tiempo;
    private $descripcion;
    private $estado;
    private $proceso_or;
    
    function __construct($id_producto, $id_proceso, $tiempo, $descripcion, $estado, $proceso_or) {
        $this->id_producto = $id_producto;
        $this->id_proceso = $id_proceso;
        $this->tiempo = $tiempo;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->proceso_or = $proceso_or;
    }
    
    function getId_producto() {
        return $this->id_producto;
    }

    function getId_proceso() {
        return $this->id_proceso;
    }

    function getTiempo() {
        return $this->tiempo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getProceso_or() {
        return $this->proceso_or;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setId_proceso($id_proceso) {
        $this->id_proceso = $id_proceso;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setProceso_or($proceso_or) {
        $this->proceso_or = $proceso_or;
    }



}
