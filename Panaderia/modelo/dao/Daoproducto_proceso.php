<?php

    /**
    *class Daoproducto
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoproducto_proceso extends Conexion{
    	
    	function _construct(){
    	}
       
    private $id_producto;
    private $id_proceso;
    private $tiempo;
    private $descripcion;
    private $estado;
    private $proceso_or;

    	function addProducto_proceso(producto_proceso $producto_proceso){
            $sql = "INSERT INTO PRODUCTO_PROCESO(ID_PRODUCTO,ID_PROCESO,TIEMPO,DECRIPCION,ESTADO,PROCESO_OR) VALUES(:id_producto,:id_proceso,:tiempo,:decripcion,:estado,:proceso_or)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_producto',$producto_proceso->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_proceso',$producto_proceso->getId_proceso(),PDO::PARAM_STR);
            $statment->bindValue(':tiempo',$producto_proceso->getTiempo(),PDO::PARAM_STR);
            $statment->bindValue(':decripcion',$producto_proceso->getDescripcion(),PDO::PARAM_INT);
            $statment->bindValue(':estado',$producto_proceso->getEstado(),PDO::PARAM_INT);
            $statment->bindValue(':proceso_or',$producto_proceso->getProceso_or(),PDO::PARAM_INT);

            $statment->execute();
    	}
        
        function deleteProducto_proceso(producto_proceso $producto_proceso){
            $sql = "DELETE FROM PRODUCTO_PROCESO WHERE ID_PRODUCTO=:id_producto AND ID_PROCESO=id_proceso";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_producto',$producto_proceso->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_proceso',$producto_proceso->getId_proceso(),PDO::PARAM_STR);

            $statment->execute();
        }

        function updateProducto_proceso(producto_proceso $producto_proceso){
            $sql = "UPDATE PRODUCTO_PROCESO SET TIEMPO=:tiempo,DECRIPCION=:decripcion,ESTADO=:estado,PROCESO_OR=:proceso_or WHERE ID_PRODUCTO=:id_producto AND ID_PROCESO=:id_proceso";
            $statment = $this->openSession($sql);
           
            $statment->bindValue(':tiempo',$producto_proceso->getTiempo(),PDO::PARAM_STR);
            $statment->bindValue(':decripcion',$producto_proceso->getDescripcion(),PDO::PARAM_INT);
            $statment->bindValue(':estado',$producto_proceso->getEstado(),PDO::PARAM_INT);
            $statment->bindValue(':proceso_or',$producto_proceso->getProceso_or(),PDO::PARAM_INT);
            $statment->bindValue(':id_producto',$producto_proceso->getId_producto(),PDO::PARAM_STR);
            $statment->bindValue(':id_proceso',$producto_proceso->getId_proceso(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllProducto_materia(){
            $sql = "SELECT * FROM PRODUCTO_PROCESO";
            $statment = $this->openSession($sql);
            $producto_proceso = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $producto_proceso = new producto_proceso($fila['id_producto'],$fila['id_proceso'],$fila['tiempo'],$fila['decripcion'],$fila['estado'],$fila['proceso_or']);
                array_push($producto_proceso,$producto_proceso);
            }



            return $producto_proceso;
        }

    }

?>