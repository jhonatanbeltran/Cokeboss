<?php

    /**
    *class Daoproducto
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daopedido extends Conexion{
    	
    	function _construct(){
    	}
        /*
        MANOLO REVISE ESTO POFAVO
        ESTO PA QUE SE ACUERDE
        POFAVO
        D:
        D:
        D:
        */
    	function addPedido(pedido $pedido){
            $sql = "INSERT INTO PEDIDO(ID_PEDIDO,DOCUMENTO_CLIENTE,ID_PRODUCTO,ID_INVENTARIO,FECHA_INVENTARIO,CANTIDAD_PEDIDO,PRECIO_PEDIDO,TIEMPO_PEDIDO,ESTADO,TOTAL_PEDIDO) VALUES(:id_pedido,:documento_cliente,:id_producto,:id_inventario,:fecha_inventario,:cantidad_pedido,:precio_pedido,:tiempo_pedido,:estado,:total_pedido)";
            $statment = $this->openSession($sql);
            //REVISE POFAVO
            $statment->bindValue(':id_pedido',$pedido->getId_pedido(),PDO::PARAM_STR);
            $statment->bindValue(':documento_cliente',$pedido->getDocumento_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$pedido->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario',$pedido->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':fecha_inventario',$pedido->getFecha_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':cantidad_pedido',$pedido->getCantidad_pedido(),PDO::PARAM_INT);
            $statment->bindValue(':precio_pedido',$pedido->getPrecio_pedido(),PDO::PARAM_INT);
            $statment->bindValue(':tiempo_pedido',$pedido->getTiempo_pedido(),PDO::PARAM_INT);
            $statment->bindValue(':estado',$pedido->getEstado(),PDO::PARAM_INT);
            $statment->bindValue(':total_pedido',$pedido->getTotal_pedido(),PDO::PARAM_INT);
            $statment->execute();
    	}
        
        function deleteProducto_materia(producto_materia $producto_materia){
            $sql = "DELETE FROM PRODUCTO_MATERIA WHERE ID_MATERIA_PRIMA=:id_materia_prima AND ID_PRODUCTO=:id_producto";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_materia_prima',$producto_materia->getId_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$producto_materia->getId_producto(),PDO::PARAM_STR);

            $statment->execute();
        }

        function updateProducto_materia(producto_materia $producto_materia){
            $sql = "UPDATE PRODUCTO_MATERIA SET ID_INVENTARIO=:id_inventario,FECHA_INVENTARIO=:fecha_inventario,PESO_PRODUCTO_MATERIA=:peso_producto_materia,CANTIDAD_PRODUCTO_MATERIA=:cantidad_producto_materia WHERE ID_MATERIA_PRIMA=:id_materia_prima AND ID_PRODUCTO=:id_producto";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_inventario',$producto_materia->getId_inventario(),PDO::PARAM_STR);
            $statment->bindValue(':fecha_inventario',$producto_materia->getFecha_inventario(),PDO::PARAM_INT);
            $statment->bindValue(':peso_producto_materia',$producto_materia->getPeso_producto_materia(),PDO::PARAM_INT);
            $statment->bindValue(':cantidad_producto_materia',$producto_materia->getCantidad_producto_materia(),PDO::PARAM_INT);
            $statment->bindValue(':id_materia_prima',$producto_materia->getId_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':id_producto',$producto_materia->getId_producto(),PDO::PARAM_STR);
            
            $statment->execute();
        }

        function findAllProducto_materia(){
            $sql = "SELECT * FROM PRODUCTO_MATERIA";
            $statment = $this->openSession($sql);
            $producto_materia = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $producto_materia = new producto_materia($fila['id_materia_prima'],$fila['id_producto'],$fila['id_inventario'],$fila['fecha_inventario'],$fila['peso_producto_materia'],$fila['cantidad_producto_materia']);
                array_push($producto_materia,$producto_materia);
            }

            return $producto_materia;
        }

    }

?>