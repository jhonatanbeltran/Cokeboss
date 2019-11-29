<?php

    /**
    *class Daoinventario_temp
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoinventario_temp extends Conexion{
    	
    	function _construct(){
    	}

    	function addInventarioTemp(inventario_temp $inventario_temp){
            $sql = "INSERT INTO INVENTARIO_TEMP(ID_INVENTARIO_TEMP,ID_ITEM_ORDEN,ID_PRODUCTO,ID_PROCESO,ESTADO,TIEMPO,DESCRIPCION) VALUES(:id_inventario_tmp,:id_item_orden,:id_producto,:id_proceso,:estado,:tiempo,:descripcion)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_inventario_tmp',$inventario_temp->getId_invetario_tmp(),PDO::PARAM_STR);
            $statment->bindValue(':id_item_orden',$inventario_temp->getId_item_orden(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$inventario_temp->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_proceso',$inventario_temp->getId_proceso(),PDO::PARAM_STR);
            $statment->bindValue(':estado',$inventario_temp->getEstado(),PDO::PARAM_BOOL);
            $statment->bindValue(':tiempo',$inventario_temp->getTiempo(),PDO::PARAM_TIME);
            $statment->bindValue(':descripcion',$inventario_temp->getDescripcion(),PDO::PARAM_STR);
            $statment->execute();
    	}
        
        function deleteInventarioTemp(inventario_temp $inventario_temp){
            $sql = "DELETE FROM INVENTARIO_TEMP WHERE ID_INVENTARIO_TEMP=:id_inventario_temp";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_inventario_tmp',$inventario_temp->getId_invetario_tmp(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateInventarioTemp(inventario_temp $inventario_temp){
            $sql = "UPDATE INVENTARIO_TEMP SET ID_ITEM_ORDEN=:id_item_orden,ID_PRODUCTO=:id_producto,ID_PROCESO=:id_proceso,ESTADO=:estado,TIEMPO=:tiempo,DESCRIPCION=:descripcion WHERE ID_INVENTARIO_TEMP=:id_inventario_temp";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_item_orden',$inventario_temp->getId_item_orden(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$inventario_temp->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_proceso',$inventario_temp->getId_proceso(),PDO::PARAM_STR);
            $statment->bindValue(':estado',$inventario_temp->getEstado(),PDO::PARAM_BOOL);
            $statment->bindValue(':tiempo',$inventario_temp->getTiempo(),PDO::PARAM_TIME);
            $statment->bindValue(':descripcion',$inventario_temp->getDescripcion(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario_tmp',$inventario_temp->getId_invetario_tmp(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllInventarioTemp(){
            $sql = "SELECT * FROM INVENTARIO_TEMP";
            $statment = $this->openSession($sql);
            $inventario_temps = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $inventario_temp = new inventario_temp($fila['id_inventario_tmp'],$fila['id_item_orden'],$fila['id_producto'],$fila['id_proceso'],$fila['estado'],$fila['tiempo'],$fila['descripcion']);
                array_push($inventario_temps,$inventario_temp);
            }

            return $inventario_temps;
        }

    }
?>