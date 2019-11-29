<?php

/**
    *class Tipo cliente
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
 */
class tipo_cliente {
    private $id_tipo_cliente;
    private $nombre_tipo_cliente;
    private $descripcion_tipo_cliente;
    
    function __construct($id_tipo_cliente, $nombre_tipo_cliente, $descripcion_tipo_cliente) {
        $this->id_tipo_cliente = $id_tipo_cliente;
        $this->nombre_tipo_cliente = $nombre_tipo_cliente;
        $this->descripcion_tipo_cliente = $descripcion_tipo_cliente;
    }
    
    function getId_tipo_cliente() {
        return $this->id_tipo_cliente;
    }

    function getNombre_tipo_cliente() {
        return $this->nombre_tipo_cliente;
    }

    function getDescripcion_tipo_cliente() {
        return $this->descripcion_tipo_cliente;
    }

    function setId_tipo_cliente($id_tipo_cliente) {
        $this->id_tipo_cliente = $id_tipo_cliente;
    }

    function setNombre_tipo_cliente($nombre_tipo_cliente) {
        $this->nombre_tipo_cliente = $nombre_tipo_cliente;
    }

    function setDescripcion_tipo_cliente($descripcion_tipo_cliente) {
        $this->descripcion_tipo_cliente = $descripcion_tipo_cliente;
    }



}
