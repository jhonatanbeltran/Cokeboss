<?php

    /**
    *class Daoproducto
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoproveedor_inv_mat extends Conexion{
    	
    	function _construct(){
    	}
        
    	function addProveedor_inv_mat(proveedor_inv_mat $proveedor_inv_mat){

            $sql = "INSERT INTO PROVEEDOR_INV_MAT(ID_PROVEEDOR_INV_MAT,ID_PROVEEDOR,ID_MATERIA_PRIMA,ID_INVENTARIO,FECHA_INVENTARIO,CANTIDAD_PROVEEDOR_INV_MAT) VALUES( :id_proveedor_inv_mat,:id_proveedor,:id_materia_prima,:id_inventario,:fecha_inventario,:cantidad_proveedor_inv_mat)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_proveedor_inv_mat',$proveedor_inv_mat->getId_proveedor_inv_mat(),PDO::PARAM_STR);
            $statment->bindValue(':id_proveedor',$proveedor_inv_mat->getId_proveedor(),PDO::PARAM_STR);
            $statment->bindValue(':id_materia_prima',$proveedor_inv_mat->getId_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario',$proveedor_inv_mat->getId_inventario(),PDO::PARAM_INT);
            $statment->bindValue(':fecha_inventariox',$proveedor_inv_mat->getFecha_inventario(),PDO::PARAM_INT);
            $statment->bindValue(':cantidad_proveedor_inv_mat',$proveedor_inv_mat->getCantidad_proveedor_inv_mat(),PDO::PARAM_INT);

            $statment->execute();
    	}
        
        function deleteProveedor_inv_mat(proveedor_inv_mat $proveedor_inv_mat){
            $sql = "DELETE FROM PROVEEDOR_INV_MAT WHERE ID_PRODUCTO=:id_producto";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_proveedor_inv_mat',$proveedor_inv_mat->getId_proveedor_inv_mat(),PDO::PARAM_STR);

            $statment->execute();
        }

        function updateProveedor_inv_mat(proveedor_inv_mat $proveedor_inv_mat){
            $sql = "UPDATE PROVEEDOR_INV_MAT SET ID_PROVEEDOR=:id_proveedor,ID_MATERIA_PRIMA=id_materia_prima,ID_INVENTARIO=:id_inventario,FECHA_INVENTARIO=:fecha_inventario,CANTIDAD_PROVEEDOR_INV_MAT=:cantidad_proveedor_inv_mat WHERE ID_PROVEEDOR_INV_MAT=:id_proveedor_inv_mat";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_materia_prima',$proveedor_inv_mat->getId_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':id_inventario',$proveedor_inv_mat->getId_inventario(),PDO::PARAM_INT);
            $statment->bindValue(':fecha_inventariox',$proveedor_inv_mat->getFecha_inventario(),PDO::PARAM_INT);
            $statment->bindValue(':cantidad_proveedor_inv_mat',$proveedor_inv_mat->getCantidad_proveedor_inv_mat(),PDO::PARAM_INT);
            $statment->bindValue(':id_proveedor_inv_mat',$proveedor_inv_mat->getId_proveedor_inv_mat(),PDO::PARAM_STR);
            $statment->bindValue(':id_proveedor',$proveedor_inv_mat->getId_proveedor(),PDO::PARAM_STR);
           
            $statment->execute();
        }

        function findAllProveedor_inv_mat(){
            $sql = "SELECT * FROM PROVEEDOR_INV_MAT";
            $statment = $this->openSession($sql);
            $proveedor_inv_mat = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $proveedor_inv_mat = new proveedor_inv_mat($fila['id_proveedor_inv_mat'],$fila['id_proveedor'],$fila['id_materia_prima'],$fila['id_inventario'],$fila['fecha_inventario'],$fila['cantidad_proveedor_inv_mat']);
                array_push($proveedor_inv_mat,$proveedor_inv_mat);
            }

            return $proveedor_inv_mat;
        }

    }

?>