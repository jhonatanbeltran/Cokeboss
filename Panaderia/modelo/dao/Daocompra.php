<?php

    /**
    *class Daocompra
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daocompra extends Conexion{
    	
    	function _construct(){
    	}

    	function addCompra(compra $compra){
            $sql = "INSERT INTO COMPRA(ID_COMPRA,DESCRIPCION_COMPRA) VALUES(:id_compra,:descripcion_compra)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_compra',$compra->getId_compra(),PDO::PARAM_STR);
            $statment->bindValue(':descripcion_compra',$compra->getDescripcion_compra(),PDO::PARAM_STR);
            $statment->execute();
    	}
        
        function deleteCompra(compra $compra){
            $sql = "DELETE FROM COMPRA WHERE ID_COMPRA=:id_compra";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_compra',$compra->getId_compra(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateCompra(compra $compra){
            $sql = "UPDATE COMPRA SET DESCRIPCION_COMPRA=:descripcion_compra WHERE ID_COMPRA=:id_compra";
            $statment = $this->openSession($sql);
            $statment->bindValue(':descripcion_compra',$compra->getDescripcion_compra(),PDO::PARAM_STR);
            $statment->bindValue(':id_compra',$compra->getId_compra(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllCompra(){
            $sql = "SELECT * FROM COMPRA";
            $statment = $this->openSession($sql);
            $compras = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $compra = new compra($fila['id_compra'],$fila['descripcion_compra']);
                array_push($compras,$compra);
            }

            return $compras;
        }

    }

?>