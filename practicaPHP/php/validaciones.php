<?php
function iniciarSesion($usuario, $password){
    if($usuario=='admin' AND $password=='clave'){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $usuario;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5*60); //Duración de 5 minutos
        return true;
    }else{
        return false;
    }
}
?>