<?php

    /**
    *class Daopedido_orden
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daopedido_orden extends Conexion{
    	
    	function _construct(){
    	}

    	function addPedidoOrden(pedido_orden $pedido_orden){
            $sql = "INSERT INTO PEDIDO_ORDEN (ID_PEDIDO_ORDEN,DOCUMENTO_CLIENTE,DESCRIPCION_PEDIDO_ORDEN) VALUES(:id_pedido_orden,:documento_cliente,:descripcion_pedido_orden)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_pedido_orden',$pedido_orden->getId_pedido_orden(),PDO::PARAM_STR);
            $statment->bindValue(':documento_cliente',$pedido_orden->getDocumento_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':descripcion_pedido_orden',$pedido_orden->getDescripcion_pedido_orden(),PDO::PARAM_STR);
            $statment->execute();
    	}
        
        function deletePedidoOrden(pedido_orden $pedido_orden){
            $sql = "DELETE FROM PEDIDO_ORDEN WHERE ID_PEDIDO_ORDEN=:id_pedido_orden";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_pedido_orden',$pedido_orden->getId_pedido_orden(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updatePedidoOrden(pedido_orden $pedido_orden){
            $sql = "UPDATE PEDIDO_ORDEN SET DOCUMENTO_CLIENTE=:documento_cliente,DESCRIPCION_PEDIDO_ORDEN=:descripcion_pedido_orden WHERE ID_PEDIDO_ORDEN=:id_pedido_orden";
            $statment = $this->openSession($sql);
            $statment->bindValue(':documento_cliente',$pedido_orden->getDocumento_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':descripcion_pedido_orden',$pedido_orden->getDescripcion_pedido_orden(),PDO::PARAM_STR);
            $statment->bindValue(':id_pedido_orden',$pedido_orden->getId_pedido_orden(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllPedidoOrden(){
            $sql = "SELECT * FROM PEDIDO_ORDEN";
            $statment = $this->openSession($sql);
            $pedido_ordenes = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $pedido_orden = new pedido_orden($fila['id_pedido_orden'],$fila['documento_cliente'],$fila['descripcion_pedido_orden']);
                array_push($pedido_ordenes,$pedido_orden);
            }

            return $pedido_ordenes;
        }

    }

?>