<?php

 /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class materia_prima {

    private $id_materia_prima;
    private $nombre_materia_prima;
    private $estado_materia_prima;
    private $descripcion_materia_prima;
    
    function __construct($id_materia_prima, $nombre_materia_prima, $estado_materia_prima, $descripcion_materia_prima) {
        $this->id_materia_prima = $id_materia_prima;
        $this->nombre_materia_prima = $nombre_materia_prima;
        $this->estado_materia_prima = $estado_materia_prima;
        $this->descripcion_materia_prima = $descripcion_materia_prima;
    }
    
    function getId_materia_prima() {
        return $this->id_materia_prima;
    }

    function getNombre_materia_prima() {
        return $this->nombre_materia_prima;
    }

    function getEstado_materia_prima() {
        return $this->estado_materia_prima;
    }

    function getDescripcion_materia_prima() {
        return $this->descripcion_materia_prima;
    }

    function setId_materia_prima($id_materia_prima) {
        $this->id_materia_prima = $id_materia_prima;
    }

    function setNombre_materia_prima($nombre_materia_prima) {
        $this->nombre_materia_prima = $nombre_materia_prima;
    }

    function setEstado_materia_prima($estado_materia_prima) {
        $this->estado_materia_prima = $estado_materia_prima;
    }

    function setDescripcion_materia_prima($descripcion_materia_prima) {
        $this->descripcion_materia_prima = $descripcion_materia_prima;
    }



}
