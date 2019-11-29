<?php

    /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

class inventario {
    private $id_inventario;
    private $fechainventario;
    function __construct($id_inventario, $fechainventario) {
        $this->id_inventario = $id_inventario;
        $this->fechainventario = $fechainventario;
    }
    function getId_inventario() {
        return $this->id_inventario;
    }

    function getFechainventario() {
        return $this->fechainventario;
    }

    function setId_inventario($id_inventario) {
        $this->id_inventario = $id_inventario;
    }

    function setFechainventario($fechainventario) {
        $this->fechainventario = $fechainventario;
    }


}
