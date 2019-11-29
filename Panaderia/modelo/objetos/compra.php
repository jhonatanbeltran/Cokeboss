<?php

    /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

class compra {
    private $id_compra;
    private $descripcion_compra;
    function __construct($id_compra, $descripcion_compra) {
        $this->id_compra = $id_compra;
        $this->descripcion_compra = $descripcion_compra;
    }
    function getId_compra() {
        return $this->id_compra;
    }

    function getDescripcion_compra() {
        return $this->descripcion_compra;
    }

    function setId_compra($id_compra) {
        $this->id_compra = $id_compra;
    }

    function setDescripcion_compra($descripcion_compra) {
        $this->descripcion_compra = $descripcion_compra;
    }


}
