<?php
    session_start();

    if(isset($_SESSION['Usuario']))
        header("Location: session.php");
    else
        header("Location: inicio.php");
        
?>