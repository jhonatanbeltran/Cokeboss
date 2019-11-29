<?php

    /**
    *class Daocliente
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daocliente extends Conexion{
    	
    	function _construct(){
    	}

    	function addCliente(cliente $cliente){
       //     echo '-----';
            $sql = "INSERT INTO CLIENTE (DOCUMENTO_CLIENTE,NOMBRE_CLIENTE,APELLIDO_CLIENTE,DIRECCION_CLIENTE,TELEFONO_CLIENTE,ID_TIPO_CLIENTE,EMAIL)VALUES(:documento_cliente,:nombre_cliente,:apellido_cliente,:direccion_cliente,:telefono_cliente,:id_tipo_cliente,:email)";
            $statment = $this->openSession($sql);
            /*
            echo $cliente->getDocumento_cliente();
            echo ' ';
            echo $cliente->getNombre_cliente();
            echo ' ';
            echo $cliente->getApellido_cliente();
            echo ' ';*/
           // echo $cliente->getId_tipo_cliente();
            //echo ' ';
           // echo $cliente->getDireccion_cliente();
         //   echo ' ';
            //echo $cliente->getTelefono_cliente();
            //echo ' ';
       //     echo $cliente->getEmail();
            $statment->bindValue(':documento_cliente',$cliente->getDocumento_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':nombre_cliente',$cliente->getNombre_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':apellido_cliente',$cliente->getApellido_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':direccion_cliente',$cliente->getDireccion_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':telefono_cliente',$cliente->getTelefono_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':id_tipo_cliente',$cliente->getId_tipo_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':email',$cliente->getEmail(),PDO::PARAM_STR);
            $statment->execute();
    	}
        
        function deleteCliente(cliente $cliente){
            $sql = "DELETE FROM CLIENTE WHERE DOCUMENTO_CLIENTE=:documento_cliente";
            $statment = $this->openSession($sql);
            $statment->bindValue(':documento_cliente',$cliente->getDocumento_cliente(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateCliente(cliente $cliente){
            $sql = "UPDATE CLIENTE SET NOMBRE_CLIENTE=:nombre_cliente,APELLIDO_CLIENTE=:apellido_cliente,DIRECCION_CLIENTE=:direccion_cliente,TELEFONO_CLIENTE=:telefono_cliente,ID_TIPO_CLIENTE=:id_tipo_cliente,EMAIL=:email WHERE DOCUMENTO_CLIENTE=:documento_cliente";
            $statment = $this->openSession($sql);
            $statment->bindValue(':nombre_cliente',$cliente->getNombre_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':apellido_cliente',$cliente->getApellido_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':direccion_cliente',$cliente->getDireccion_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':telefono_cliente',$cliente->getTelefono_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':id_tipo_cliente',$cliente->getId_tipo_cliente(),PDO::PARAM_STR);
            $statment->bindValue(':email',$cliente->getEmail(),PDO::PARAM_STR);
            $statment->bindValue(':documento_cliente',$cliente->getDocumento_cliente(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllBuscarCl($id,$nombre){
            $sql = "SELECT * FROM CLIENTE WHERE DOCUMENTO_CLIENTE=:documento_cliente AND NOMBRE_CLIENTE=:nombre_cliente";
            $statment = $this->openSession($sql);
            $statment->bindParam(':documento_cliente', $id, PDO::PARAM_STR);
            $statment->bindParam(':nombre_cliente', $nombre, PDO::PARAM_STR);
            $statment->execute();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)) {
                $cliente = new cliente($fila['documento_cliente'],$fila['nombre_cliente'],$fila['apellido_cliente'],$fila['direccion_cliente'],$fila['telefono_cliente']
                 ,$fila['id_tipo_cliente'],$fila['email']);
                return 0;
            }

            return 1;
        }

    }

?>