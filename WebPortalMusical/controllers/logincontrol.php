<?php 
    if (isset($_POST["username"]) && isset($_POST["passcode"])) {

        require_once("../models/Login.php");
        $validar=validarDatosFinal($_POST["username"], $_POST["passcode"]); //Comprueba las credenciales 
        header("location: ./../views/menu.php");

    } else {
        header("location: ./../index.php");
    }
?>
