<?php
        /**
    *class UsersDAO
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
    */
    include_once('../modelo/objetos/usuario.php');

    class Daousuario extends Conexion{
    	
    	function _construct(){
    	}
        function addUser(usuario $user){
            $sql = "INSERT INTO USUARIO(IDENTIFICADOR,CONTRASENA) VALUES(:Identificador,:Contrasena)";
            $statment = $this->openSession($sql);
            $statment->bindValue(':Contrasena',$user->getUser_password(),PDO::PARAM_STR);
            $statment->bindValue(':Identificador',$user->getUser_code(),PDO::PARAM_STR);
            $statment->execute();
    	}
        

        //SOLO SE PODRA ACTUALIZAR EL PARAMETRO PHONE Y PHONE_INDICATIVE
        function updateContrasena(usuario $user){
            $sql = "UPDATE USUARIO SET CONTRASENA=:Contrasena WHERE IDENTIFICADOR=:Identificador";
            $statment = $this->openSession($sql);
            $statment->bindValue(':Contrasena',$user->getUser_password(),PDO::PARAM_STR);
            $statment->bindValue(':Identificador',$user->getUser_code(),PDO::PARAM_STR);
            $statment->execute();
        }

        function login($email, $password){
            $sql = "SELECT * FROM USUARIO WHERE IDENTIFICADOR=:Identificador AND CONTRASENA=:Contrasena";
            $statment = $this->openSession($sql);
            $statment->bindParam(':Identificador', $email, PDO::PARAM_STR);
            $statment->bindParam(':Contrasena', $password, PDO::PARAM_STR);
            $statment->execute();
        
            while ($fila = $statment->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new usuario($fila['Identificador'],$fila['Contrasena']);
                return 0;
            }

            return 1;
        }

    }

?>