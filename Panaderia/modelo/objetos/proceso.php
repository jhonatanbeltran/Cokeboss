<?php

/**
    *class Proceso
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
 */
class proceso {
    
    private $id_proceso;
    private $nombre_proceso;
    private $tiempo_proceso;
    private $descripcion;
    
    function __construct($id_proceso, $nombre_proceso, $tiempo_proceso, $descripcion) {
        $this->id_proceso = $id_proceso;
        $this->nombre_proceso = $nombre_proceso;
        $this->tiempo_proceso = $tiempo_proceso;
        $this->descripcion = $descripcion;
    }
    
    function getId_proceso() {
        return $this->id_proceso;
    }

    function getNombre_proceso() {
        return $this->nombre_proceso;
    }

    function getTiempo_proceso() {
        return $this->tiempo_proceso;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId_proceso($id_proceso) {
        $this->id_proceso = $id_proceso;
    }

    function setNombre_proceso($nombre_proceso) {
        $this->nombre_proceso = $nombre_proceso;
    }

    function setTiempo_proceso($tiempo_proceso) {
        $this->tiempo_proceso = $tiempo_proceso;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }



}
