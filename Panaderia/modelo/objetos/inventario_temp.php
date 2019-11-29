<?php

 /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class inventario_temp {
    
    private $id_invetario_tmp;
    private $id_item_orden;
    private $id_producto;
    private $id_proceso;
    private $estado;
    private $tiempo;
    private $descripcion;
    
    function __construct($id_invetario_tmp, $id_item_orden, $id_producto, $id_proceso, $estado, $tiempo, $descripcion) {
        $this->id_invetario_tmp = $id_invetario_tmp;
        $this->id_item_orden = $id_item_orden;
        $this->id_producto = $id_producto;
        $this->id_proceso = $id_proceso;
        $this->estado = $estado;
        $this->tiempo = $tiempo;
        $this->descripcion = $descripcion;
    }
    
    function getId_invetario_tmp() {
        return $this->id_invetario_tmp;
    }

    function getId_item_orden() {
        return $this->id_item_orden;
    }

    function getId_producto() {
        return $this->id_producto;
    }

    function getId_proceso() {
        return $this->id_proceso;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTiempo() {
        return $this->tiempo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId_invetario_tmp($id_invetario_tmp) {
        $this->id_invetario_tmp = $id_invetario_tmp;
    }

    function setId_item_orden($id_item_orden) {
        $this->id_item_orden = $id_item_orden;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setId_proceso($id_proceso) {
        $this->id_proceso = $id_proceso;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }



}
