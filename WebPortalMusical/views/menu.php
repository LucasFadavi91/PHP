<?php

//Inicio la sesion
session_start();

//Esto es para chequear si el usuario sigue logeado o existe una sesion
if (!isset($_SESSION["username"]) || $_SESSION["username"] === false) {
  exit("No estas logeado");
  
}
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Web musical</title>
	<meta charset="utf-8" />
	<meta name="author" value="Lucas Fadavi" />
</head>
<body>
	<h1>Bienvenido <?php echo htmlspecialchars($_SESSION["username"]) ?></h1>
	<li><a href="./../controllers/logout.php">Cerrar sesión</a></li>
	<li><a href="downmusic.php">Descargar musica</a></li>
	<li><a href="histfacturas.php">Consultar historial de facturas</a></li>
	<li><a href="facturas.php">Consultar facturas entre dos fechas</a></li>
	<li><a href="ranking.php">Consultar descargas entre dos fechas</a></li>
</body>
</html>

