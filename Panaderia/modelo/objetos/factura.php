<?php

    /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

class factura {
    private $id_factura;
    private $id_compra;
    private $id_proveedor_inv_mat;
    private $cantidad;
    private $precio;
    private $iva;
    private $total;
    private $fecha;
    function __construct($id_factura, $id_compra, $id_proveedor_inv_mat, $cantidad, $precio, $iva, $total, $fecha) {
        $this->id_factura = $id_factura;
        $this->id_compra = $id_compra;
        $this->id_proveedor_inv_mat = $id_proveedor_inv_mat;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->iva = $iva;
        $this->total = $total;
        $this->fecha = $fecha;
    }
    function getId_factura() {
        return $this->id_factura;
    }

    function getId_compra() {
        return $this->id_compra;
    }

    function getId_proveedor_inv_mat() {
        return $this->id_proveedor_inv_mat;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getIva() {
        return $this->iva;
    }

    function getTotal() {
        return $this->total;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId_factura($id_factura) {
        $this->id_factura = $id_factura;
    }

    function setId_compra($id_compra) {
        $this->id_compra = $id_compra;
    }

    function setId_proveedor_inv_mat($id_proveedor_inv_mat) {
        $this->id_proveedor_inv_mat = $id_proveedor_inv_mat;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setIva($iva) {
        $this->iva = $iva;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }


}
