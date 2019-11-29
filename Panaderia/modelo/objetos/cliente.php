<?php

    /**
    *class CLiente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class cliente{
    	
        private $documento_cliente;
        private $nombre_cliente;
        private $apellido_cliente;
    	private $direccion_cliente;
        private $telefono_cliente;
        private $id_tipo_cliente;
        private $email;
        function __construct($documento_cliente, $nombre_cliente, $apellido_cliente, $direccion_cliente, $telefono_cliente, $id_tipo_cliente, $email) {
            $this->documento_cliente = $documento_cliente;
            $this->nombre_cliente = $nombre_cliente;
            $this->apellido_cliente = $apellido_cliente;
            $this->direccion_cliente = $direccion_cliente;
            $this->telefono_cliente = $telefono_cliente;
            $this->id_tipo_cliente = $id_tipo_cliente;
            $this->email = $email;
        }
        function getDocumento_cliente() {
            return $this->documento_cliente;
        }

        function getNombre_cliente() {
            return $this->nombre_cliente;
        }

        function getApellido_cliente() {
            return $this->apellido_cliente;
        }

        function getDireccion_cliente() {
            return $this->direccion_cliente;
        }

        function getTelefono_cliente() {
            return $this->telefono_cliente;
        }

        function getId_tipo_cliente() {
            return $this->id_tipo_cliente;
        }

        function getEmail() {
            return $this->email;
        }

        function setDocumento_cliente($documento_cliente) {
            $this->documento_cliente = $documento_cliente;
        }

        function setNombre_cliente($nombre_cliente) {
            $this->nombre_cliente = $nombre_cliente;
        }

        function setApellido_cliente($apellido_cliente) {
            $this->apellido_cliente = $apellido_cliente;
        }

        function setDireccion_cliente($direccion_cliente) {
            $this->direccion_cliente = $direccion_cliente;
        }

        function setTelefono_cliente($telefono_cliente) {
            $this->telefono_cliente = $telefono_cliente;
        }

        function setId_tipo_cliente($id_tipo_cliente) {
            $this->id_tipo_cliente = $id_tipo_cliente;
        }

        function setEmail($email) {
            $this->email = $email;
        }


    }

?>