<?php

    /**
    *class Daoinventario
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoinventario extends Conexion{
    	
    	function _construct(){
    	}

    	function addInventario(inventario $inventario){
            $sql = "INSERT INTO INVENTARIO(ID_INVENTARIO,FECHA_INVENTARIO) VALUES(:id_inventario,:fecha_inventario)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_inventario',$inventario->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':fecha_inventario',$inventario->getFechainventario(),PDO::PARAM_DATE);
            $statment->execute();
    	}
        
        function deleteInventario(inventario $inventario){
            $sql = "DELETE FROM INVENTARIO WHERE ID_INVENTARIO=:id_inventario AND FECHA_INVENTARIO=:fecha_inventario";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_inventario',$inventario->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':fecha_inventario',$inventario->getFechainventario(),PDO::PARAM_DATE);
            $statment->execute();
        }

        function findAllInventario(){
            $sql = "SELECT * FROM INVENTARIO";
            $statment = $this->openSession($sql);
            $inventarios = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $inventario = new inventario($fila['id_inventario'],$fila['fecha_inventario']);
                array_push($inventarios,$inventario);
            }

            return $inventarios;
        }

    }

?>