<?php

    /**
    *class Daoitem_orden
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoitem_orden extends Conexion{
    	
    	function _construct(){
    	}

    	function addItemOrden(item_orden $item_orden){
            $sql = "INSERT INTO ITEM_ORDEN(ID_ITEM_ORDEN,ID_PEDIDO_ORDEN,ID_PRODUCTO,CANTIDAD,DESCRIPCION,FECHA) VALUES(:id_item_orden,:id_pedido_orden,:id_producto,:cantidad,:descripcion,:fecha)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_item_orden',$item_orden->getId_item_orden(),PDO::PARAM_STR);
            $statment->bindValue(':id_pedido_orden',$item_orden->getId_pedido_orden(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$item_orden->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':cantidad',$item_orden->getCantidad(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion',$item_orden->getDescripcion(),PDO::PARAM_STR);
            $statment->bindValue(':fecha',$item_orden->getFecha(),PDO::PARAM_DATE);
            $statment->execute();
    	}
        
        function deleteItemOrden(item_orden $item_orden){
            $sql = "DELETE FROM ITEM_ORDEN WHERE ID_ITEM_ORDEN=:id_item_orden";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_item_orden',$item_orden->getId_item_orden(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateItemOrden(item_orden $item_orden){
            $sql = "UPDATE ITEM_ORDEN SET ID_PEDIDO_ORDEN=:id_pedido_orden,ID_PRODUCTO=:id_producto,CANTIDAD=:cantidad,DESCRIPCION=:descripcion,FECHA=:fecha WHERE ID_ITEM_ORDEN=:id_item_orden";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_pedido_orden',$item_orden->getId_pedido_orden(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$item_orden->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':cantidad',$item_orden->getCantidad(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion',$item_orden->getDescripcion(),PDO::PARAM_STR);
            $statment->bindValue(':fecha',$item_orden->getFecha(),PDO::PARAM_DATE);
            $statment->bindValue(':id_item_orden',$item_orden->getId_item_orden(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllItemOrden(){
            $sql = "SELECT * FROM ITEM_ORDEN";
            $statment = $this->openSession($sql);
            $item_ordenes = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $item_orden = new item_orden($fila['id_item_orden'],$fila['id_pedido_orden'],$fila['id_producto'],$fila['cantidad'],$fila['descripcion'],$fila['fecha']);
                array_push($item_ordenes,$item_orden);
            }

            return $item_ordenes;
        }

    }
?>