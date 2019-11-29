<?php

    /**
    *class Daoproducto
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daoproveedor extends Conexion{
    	
    	function _construct(){
    	}
        
    	function addProveedor(proveedor $proveedor){

            $sql = "INSERT INTO PROVEEDOR(ID_PROVEEDOR,NOMBRE_PROVEEDOR,DIRECCION_PROVEEDOR,TELEFONO_PROVEEDOR,DESCRIPCION_PROVEEDOR) VALUES( :id_proveedor,:nombre_proveedor,:direccion_proveedor,:telefono_proveedor,:descripcion_proveedor)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_proveedor',$proveedor->getId_proveedor(),PDO::PARAM_STR);
            $statment->bindValue(':nombre_proveedor',$proveedor->getNombre_proveedor(),PDO::PARAM_STR);
            $statment->bindValue(':direccion_proveedor',$proveedor->getDireccion_proveedor(),PDO::PARAM_STR);
            $statment->bindValue(':telefono_proveedor',$proveedor->getTelefono_proveedor(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion_proveedor',$proveedor->getDescripcion_proveedor(),PDO::PARAM_INT);
            $statment->execute();
    	}
        
        function deleteProveedor(proveedor $proveedor){
            $sql = "DELETE FROM PROVEEDOR WHERE ID_PROVEEDOR=:id_proveedor";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_proveedor',$proveedor->getId_proveedor(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateProveedor(proveedor $proveedor){
            $sql = "UPDATE PROVEEDOR SET NOMBRE_PROVEEDOR=:nombre_proveedor,DIRECCION_PROVEEDOR=:direccion_proveedor,TELEFONO_PROVEEDOR=:telefono_proveedor,DESCRIPCION_PROVEEDOR=:descripcion_proveedor WHERE ID_PROVEEDOR=:id_proveedor";
            $statment = $this->openSession($sql);

            $statment->bindValue(':nombre_proveedor',$proveedor->getNombre_proveedor(),PDO::PARAM_STR);
            $statment->bindValue(':direccion_proveedor',$proveedor->getDireccion_proveedor(),PDO::PARAM_STR);
            $statment->bindValue(':telefono_proveedor',$proveedor->getTelefono_proveedor(),PDO::PARAM_INT);
            $statment->bindValue(':descripcion_proveedor',$proveedor->getDescripcion_proveedor(),PDO::PARAM_INT);
            $statment->bindValue(':id_proveedor',$proveedor->getId_proveedor(),PDO::PARAM_STR);

            $statment->execute();
        }

        function findAllProveedor(){
            $sql = "SELECT * FROM PROVEEDOR";
            $statment = $this->openSession($sql);
            $proveedor = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $proveedor = new proveedor($fila['id_proveedor'],$fila['nombre_proveedor'],$fila['direccion_proveedor'],$fila['telefono_proveedor'],$fila['peso_producto'],$fila['descripcion_proveedor']);
                array_push($proveedor,$proveedor);
            }

            return $producto;
        }

    }

?>