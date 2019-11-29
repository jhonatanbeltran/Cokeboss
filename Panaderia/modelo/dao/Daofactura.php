<?php

    /**
    *class Daofactura
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daofactura extends Conexion{
    	
    	function _construct(){
    	}

    	function addFactura(factura $factura){
            $sql = "INSERT INTO FACTURA(ID_FACTURA,ID_COMPRA,ID_PROVEEDOR_INV_MAT,CANTIDAD,PRECIO,IVA,TOTAL,FECHA) VALUES(:id_factura,:id_compra,:id_proveedor_inv_mat,:cantidad,:precio,:iva,:total,:fecha)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_factura',$factura->getId_factura(),PDO::PARAM_STR);
            $statment->bindValue(':id_compra',$factura->getId_compra(),PDO::PARAM_STR);
            $statment->bindValue(':id_proveedor_inv_mat',$factura->getId_proveedor_inv_mat(),PDO::PARAM_STR);
            $statment->bindValue(':cantidad',$factura->getCantidad(),PDO::PARAM_INT);
            $statment->bindValue(':precio',$factura->getPrecio(),PDO::PARAM_INT);
            $statment->bindValue(':iva',$factura->getIva(),PDO::PARAM_INT);
            $statment->bindValue(':total',$factura->getTotal(),PDO::PARAM_INT);
            $statment->bindValue(':fecha',$factura->getFecha(),PDO::PARAM_DATE);
            $statment->execute();
    	}
        
        function deleteFactura(factura $factura){
            $sql = "DELETE FROM FACTURA WHERE ID_FACTURA=:id_factura";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_factura',$factura->getId_factura(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateFactura(factura $factura){
            $sql = "UPDATE FACTURA SET ID_COMPRA=:id_compra,ID_PROVEEDOR_INV_MAT=:id_proveedor_inv_mat,CANTIDAD=:cantidad,PRECIO=:precio,IVA=:iva,TOTAL=:total,FECHA=:fecha";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_compra',$factura->getId_compra(),PDO::PARAM_STR); 
            $statment->bindValue(':id_proveedor_inv_mat',$factura->getId_proveedor_inv_mat(),PDO::PARAM_STR);
            $statment->bindValue(':cantidad',$factura->getCantidad(),PDO::PARAM_INT);
            $statment->bindValue(':precio',$factura->getPrecio(),PDO::PARAM_INT);
            $statment->bindValue(':iva',$factura->getIva(),PDO::PARAM_INT);
            $statment->bindValue(':total',$factura->getTotal(),PDO::PARAM_INT);
            $statment->bindValue(':fecha',$factura->getFecha(),PDO::PARAM_DATE);
            $statment->bindValue(':id_factura',$factura->getId_factura(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllFactura(){
            $sql = "SELECT * FROM FACTURA";
            $statment = $this->openSession($sql);
            $facturas = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $factura = new factura($fila['id_factura'],$fila['id_compra'],$fila['id_proveedor_inv_mat'],$fila['cantidad'],$fila['precio'],$fila['iva'],$fila['total'],$fila['fecha']);
                array_push($facturas,$factura);
            }

            return $facturas;
        }

    }

?>