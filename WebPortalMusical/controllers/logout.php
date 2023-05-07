<?php 

//inicio la sesion
session_start();
 
//Reseteo variables de sesion
$_SESSION = array();
 
//Destruyo la sesion
session_destroy();
 
//Redirecciono a la pagina de entrada
header("location: ./../index.php");
exit;
?>
