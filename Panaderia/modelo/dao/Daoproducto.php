<?php

    /**
    *class Daoproducto
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10    
    *@version:1.0
    */
    class Daoproducto extends Conexion{
    	
    	function _construct(){
    	}
        
    	function addProducto(producto $producto){

            $sql = "INSERT INTO PRODUCTO(ID_PRODUCTO,ID_TIPO_PRODUCTO,NOMBRE_PRODUCTO,ESTADO_PRODUCTO,PESO_PRODUCTO,DESCRIPCION_PRODUCTO) VALUES( :id_producto,:id_tipo_producto,:nombre_producto,:estado_producto,:peso_producto,:descripcion_producto)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_producto',$producto->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_tipo_producto',$producto->getId_tipo_producto(),PDO::PARAM_STR);
            $statment->bindValue(':nombre_producto',$producto->getNombre_producto(),PDO::PARAM_STR);
            $statment->bindValue(':estado_producto',$producto->getEstado_producto(),PDO::PARAM_INT);
            $statment->bindValue(':peso_producto',$producto->getPeso_producto(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion_producto',$producto->getDescripcion_producto(),PDO::PARAM_STR);

            $statment->execute();
    	}
        
        function deleteProducto(producto $producto){
            $sql = "DELETE FROM PRODUCTO WHERE ID_PRODUCTO=:id_producto";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_producto',$producto->getId_producto(),PDO::PARAM_STR);

            $statment->execute();
        }

        function updateProducto(producto $producto){
            $sql = "UPDATE PRODUCTO SET ID_TIPO_PRODUCTO=:id_tipo_producto,NOMBRE_PRODUCTO=:nombre_producto,ESTADO_PRODUCTO=:estado_producto,PESO_PRODUCTO=:peso_producto, DESCRIPCION_PRODUCTO=:descripcion_producto WHERE ID_PRODUCTO=:id_producto";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_tipo_producto',$producto->getId_tipo_producto(),PDO::PARAM_STR);
            $statment->bindValue(':nombre_producto',$producto->getNombre_producto(),PDO::PARAM_STR);
            $statment->bindValue(':estado_producto',$producto->getEstado_producto(),PDO::PARAM_INT);
            $statment->bindValue(':peso_producto',$producto->getPeso_producto(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion_producto',$producto->getDescripcion_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$producto->getId_producto(),PDO::PARAM_STR);
            return $statment->execute();
        }

        function findAllProducto($n){
            $sql = "SELECT * FROM PRODUCTO WHERE NOMBRE_PRODUCTO=:nombre_producto";
            $statment = $this->openSession($sql);
            $statment->bindParam(':nombre_producto', $n, PDO::PARAM_STR);
            $statment->execute();
            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)) {
                 $producto = new producto($fila['id_producto'],$fila['id_tipo_producto'],$fila['nombre_producto'],$fila['estado_producto'],$fila['peso_producto'],$fila['descripcion_producto']);
                 return $producto;
            }
            return null;
        }

        function findAllProductoex(){
            $sql = "SELECT * FROM PRODUCTO";
            $statment = $this->openSession($sql);
            $statment->execute();
            $productos = array();
            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)) {
                 $producto = new producto($fila['id_producto'],$fila['id_tipo_producto'],$fila['nombre_producto'],$fila['estado_producto'],$fila['peso_producto'],$fila['descripcion_producto']);
                 array_push($productos,$producto);
                }            
            return $productos;
            
        }


    }

?>