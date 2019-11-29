<?php
    session_start();
    if(!isset($_SESSION['Usuario']))
        header("Location: index.php");

    
      
        header("Location: ../controller/admin/clienteadd.php");

?>