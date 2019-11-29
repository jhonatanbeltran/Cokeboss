<?php

/**
    *class Proveedor inventario mateira
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
 */
class proveedor_inv_mat {
    private $id_proveedor_inv_mat;
    private $id_proveedor;
    private $id_materia_prima;
    private $id_inventario;
    private $fecha_inventario;
    private $cantidad_proveedor_inv_mat;
    
    function __construct($id_proveedor_inv_mat, $id_proveedor, $id_materia_prima, $id_inventario, $fecha_inventario, $cantidad_proveedor_inv_mat) {
        $this->id_proveedor_inv_mat = $id_proveedor_inv_mat;
        $this->id_proveedor = $id_proveedor;
        $this->id_materia_prima = $id_materia_prima;
        $this->id_inventario = $id_inventario;
        $this->fecha_inventario = $fecha_inventario;
        $this->cantidad_proveedor_inv_mat = $cantidad_proveedor_inv_mat;
    }
    
    function getId_proveedor_inv_mat() {
        return $this->id_proveedor_inv_mat;
    }

    function getId_proveedor() {
        return $this->id_proveedor;
    }

    function getId_materia_prima() {
        return $this->id_materia_prima;
    }

    function getId_inventario() {
        return $this->id_inventario;
    }

    function getFecha_inventario() {
        return $this->fecha_inventario;
    }

    function getCantidad_proveedor_inv_mat() {
        return $this->cantidad_proveedor_inv_mat;
    }

    function setId_proveedor_inv_mat($id_proveedor_inv_mat) {
        $this->id_proveedor_inv_mat = $id_proveedor_inv_mat;
    }

    function setId_proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }

    function setId_materia_prima($id_materia_prima) {
        $this->id_materia_prima = $id_materia_prima;
    }

    function setId_inventario($id_inventario) {
        $this->id_inventario = $id_inventario;
    }

    function setFecha_inventario($fecha_inventario) {
        $this->fecha_inventario = $fecha_inventario;
    }

    function setCantidad_proveedor_inv_mat($cantidad_proveedor_inv_mat) {
        $this->cantidad_proveedor_inv_mat = $cantidad_proveedor_inv_mat;
    }



}
?>