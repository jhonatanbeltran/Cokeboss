<?php

    /**
    *class Daomateria_prima
    *@autor:Henry Geovanny Ortega Mantilla
    *@date: 2019/01/10
    *@version:1.0
    */

    class Daomateria_prima extends Conexion{
    	
    	function _construct(){
    	}

    	function addMateriaPrima(materia_prima $materia_prima){
            $sql = "INSERT INTO MATERIA_PRIMA(ID_MATERIA_PRIMA,NOMBRE_MATERIA_PRIMA,ESTADO_MATERIA_PRIMA,DESCRIPCION_MATERIA_PRIMA) VALUES(:id_materia_prima,:nombre_materia_prima,:estado_materia_prima,:descripcion_materia_prima)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_materia_prima',$materia_prima->getId_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':nombre_materia_prima',$materia_prima->getNombre_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':estado_materia_prima',$materia_prima->getEstado_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':descripcion_materia_prima',$materia_prima->getDescripcion_materia_prima(),PDO::PARAM_STR);
            $statment->execute();
    	}
        
        function deleteMateriaPrima(materia_prima $materia_prima){
            $sql = "DELETE FROM MATERIA_PRIMA WHERE ID_MATERIA_PRIMA=:id_materia_prima";
            $statment = $this->openSession($sql);
            $statment->bindValue(':id_materia_prima',$materia_prima->getId_materia_prima(),PDO::PARAM_STR);
            $statment->execute();
        }

        function updateMateriaPrima(materia_prima $materia_prima){
            $sql = "UPDATE MATERIA_PRIMA SET NOMBRE_MATERIA_PRIMA=:nombre_materia_prima,ESTADO_MATERIA_PRIMA=:estado_materia_prima,DESCRIPCION_MATERIA_PRIMA=:descripcion_materia_prima WHERE ID_MATERIA_PRIMA=:id_materia_prima";
            $statment = $this->openSession($sql);
            $statment->bindValue(':nombre_materia_prima',$materia_prima->getNombre_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':estado_materia_prima',$materia_prima->getEstado_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':descripcion_materia_prima',$materia_prima->getDescripcion_materia_prima(),PDO::PARAM_STR);
            $statment->bindValue(':id_materia_prima',$materia_prima->getId_materia_prima(),PDO::PARAM_STR);
            $statment->execute();
        }

        function findAllMateriaPrima(){
            $sql = "SELECT * FROM MATERIA_PRIMA";
            $statment = $this->openSession($sql);
            $materia_primas = array();

            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)){
                $materia_prima = new materia_prima($fila['id_materia_prima'],$fila['nombre_materia_prima'],$fila['estado_materia_prima'],$fila['descripcion_materia_prima']);
                array_push($materia_primas,$materia_prima);
            }

            return $materia_primas;
        }

    }

?>