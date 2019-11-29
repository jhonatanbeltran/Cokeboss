<?php

    /**
    *class Daoinventario_producto
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoinventario_producto extends Conexion{
    	
    	function _construct(){
    	}

    	function addInventarioProducto(inventario_producto $inventario_producto){
            $sql = "INSERT INTO INVENTARIO_PRODUCTO(ID_PRODUCTO,ID_INVENTARIO,FECHA_INVENTARIO,CANTIDAD_INV_PRODUCTO,DESCRIPCION,ESTADO,PRECIO) VALUES(:id_producto,:id_inventario,:fecha_inventario,:cantidad_inv_producto,:descripcion,:estado,:precio)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_producto',$inventario_producto->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario',$inventario_producto->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':fecha_inventario',$inventario_producto->getFecha_inventario(),PDO::PARAM_DATE);
            $statment->bindValue(':cantidad_inv_producto',$inventario_producto->getCantidad_inv_producto(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion',$inventario_producto->getDescripcion(),PDO::PARAM_STR);
            $statment->bindValue(':estado',$inventario_producto->getEstado(),PDO::PARAM_BOOL);
            $statment->bindValue(':precio',$inventario_producto->getPrecio(),PDO::PARAM_INT);
            $statment->execute();
    	}
        
        function deleteInventarioProducto(inventario_producto $inventario_producto){
            $sql = "DELETE FROM INVENTARIO_PRODUCTO WHERE ID_PRODUCTO=:id_producto AND ID_INVENTARIO=:id_inventario AND FECHA_INVENTARIO=:fecha_inventario";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_producto',$inventario_producto->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario',$inventario_producto->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':fecha_inventario',$inventario_producto->getFecha_inventario(),PDO::PARAM_DATE);
            $statment->execute();
        }

        function updateInventarioProducto(inventario_producto $inventario_producto){
            $sql = "UPDATE INVENTARIO_PRODUCTO SET CANTIDAD_INV_PRODUCTO=:cantidad_inv_producto,DESCRIPCION=:descripcion,ESTADO=:estado,PRECIO=:precio WHERE ID_PRODUCTO=:id_producto AND ID_INVENTARIO=:id_inventario AND FECHA_INVENTARIO=:fecha_inventario";
            $statment = $this->openSession($sql);
            $statment->bindValue(':cantidad_inv_producto',$inventario_producto->getCantidad_inv_producto(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion',$inventario_producto->getDescripcion(),PDO::PARAM_STR);
            $statment->bindValue(':estado',$inventario_producto->getEstado(),PDO::PARAM_BOOL);
            $statment->bindValue(':id_producto',$inventario_producto->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario',$inventario_producto->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':precio',$inventario_producto->getPrecio(),PDO::PARAM_INT);
            $statment->bindValue(':fecha_inventario',$inventario_producto->getFecha_inventario(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllInventarioProducto($n){
            $sql = "SELECT * FROM INVENTARIO_PRODUCTO WHERE ID_PRODUCTO=:id_producto";
            $statment = $this->openSession($sql);
            $statment->bindParam(':id_producto',$n,PDO::PARAM_STR);
            $statment->execute();
            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                if($fila['id_producto']==$n){

                return $inventario_producto = new inventario_producto($fila['id_producto'],$fila['id_inventario'],$fila['fecha_inventario'],$fila['cantidad_inv_producto'],$fila['descripcion'],$fila['estado'],$fila['precio']);
                }
            }

            return null;
        }


        function findAllProductoex(){
            $sql = "SELECT * FROM INVENTARIO_PRODUCTO";
            $statment = $this->openSession($sql);
            $statment->execute();
            $productos = array();
            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)) {
                 $inventario_producto = new inventario_producto($fila['id_producto'],$fila['id_inventario'],$fila['fecha_inventario'],$fila['cantidad_inv_producto'],$fila['descripcion'],$fila['estado'],$fila['precio']);
                 array_push($productos,$inventario);
                }            
            return $productos;
            
        }

    }
?>