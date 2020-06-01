<?php
session_start();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    
    if($usuario=='admin' AND $password=='clave'){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $usuario;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5*60); //Duración de 5 minutos
    }else{
        $_SESSION['loggedin'] = false;
    }

    header('Location: ../?p=inicio');
?>