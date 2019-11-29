<?php

    /**
    *class Users
    *@autor:Jhonatan Andres Beltran Caceres
    *@date: 2019/01/10
    *@version:1.0
    */

    class usuario{
    	
    	private $user_code;
        private $user_password;

        function __construct($user_code, $user_password) {
            $this->user_code = $user_code;
            $this->user_password = md5($user_password);
        }

        function getUser_code() {
            return $this->user_code;
        }

      
       
        function getUser_password() {
            return $this->user_password;
        }

        function setUser_code($user_code) {
            $this->user_code = $user_code;
        }

        function setUser_password($user_password) {
            $this->user_password = md5($user_password);
        }

    }

?>