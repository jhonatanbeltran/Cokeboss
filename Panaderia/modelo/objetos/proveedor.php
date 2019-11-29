<?php

/**
    *class Proveedor
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
 */
class proveedor {
    private $id_proveedor;
    private $nombre_proveedor;
    private $direccion_proveedor;
    private $telefono_proveedor;
    private $descripcion_proveedor;
    
    function __construct($id_proveedor, $nombre_proveedor, $direccion_proveedor, $telefono_proveedor, $descripcion_proveedor) {
        $this->id_proveedor = $id_proveedor;
        $this->nombre_proveedor = $nombre_proveedor;
        $this->direccion_proveedor = $direccion_proveedor;
        $this->telefono_proveedor = $telefono_proveedor;
        $this->descripcion_proveedor = $descripcion_proveedor;
    }
    
    function getId_proveedor() {
        return $this->id_proveedor;
    }

    function getNombre_proveedor() {
        return $this->nombre_proveedor;
    }

    function getDireccion_proveedor() {
        return $this->direccion_proveedor;
    }

    function getTelefono_proveedor() {
        return $this->telefono_proveedor;
    }

    function getDescripcion_proveedor() {
        return $this->descripcion_proveedor;
    }

    function setId_proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }

    function setNombre_proveedor($nombre_proveedor) {
        $this->nombre_proveedor = $nombre_proveedor;
    }

    function setDireccion_proveedor($direccion_proveedor) {
        $this->direccion_proveedor = $direccion_proveedor;
    }

    function setTelefono_proveedor($telefono_proveedor) {
        $this->telefono_proveedor = $telefono_proveedor;
    }

    function setDescripcion_proveedor($descripcion_proveedor) {
        $this->descripcion_proveedor = $descripcion_proveedor;
    }



}



