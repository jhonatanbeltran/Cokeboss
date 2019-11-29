<?php


    class Conexion{
        
        var $db;

        function __construct(){
        }

        function conexion(){
                $db_host="localhost";
                $db_user="root";
                $db_pass="";
                $db_name="cakeboss";
                $this->db = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        function openSession($query){
                $this->Conexion();
                $statment = $this->db->prepare($query);
                return $statment;
        }
    }

?>