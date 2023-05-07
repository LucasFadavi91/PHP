<?php


session_start();
    //Compruebo si ya hay una sesion establecida 
    if (isset($_SESSION["username"]) && isset($_SESSION["passcode"])) {
        
        require_once("models/Validar.php");
        $validar = validarDatos();

        include_once("views/menu.php");
        
    } else {

        if (isset($_SESSION["error"])) {
        
            echo "Usuario y/o contraseña incorrecto";
            unset($_SESSION["error"]);
    
        }

        include_once("views/login.php");
    }



?>
