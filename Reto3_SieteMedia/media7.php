<HTML>
    <HEAD> 
        <TITLE> Siete y media </TITLE>
        <meta charset="utf-8">  
        <meta name="author" content="Lucas Fadavi"> 
    </HEAD>
    <BODY>
<?php

#Lucas Fadavi Solanilla

    include_once('./media7_fun.php');

    $nombre1 = sanear($_POST['nombre1']);
    $nombre2 = sanear($_POST['nombre2']);
    $nombre3 = sanear($_POST['nombre3']);
    $nombre4 = sanear($_POST['nombre4']);
    $apuesta = sanear($_POST['apuesta']);
    $numcartas = sanear($_POST['numcartas']);
 

   //Esto muestra la baraja de cartas 
   $baraja=cartas($numcartas);

   //Esto guarda los nombres de los jugadores en un array
   $nombres=array($nombre1, $nombre2, $nombre3, $nombre4);

   //Esto guarda en un array los jugadores con sus correspondientes cartas
   $jugadores=jugadores($baraja, $numcartas, $nombres);
 
   //Esto guarda en un array las puntuaciones
   $puntuaciones=puntuaciones($baraja, $jugadores, $nombres);

   //Esto es la maxima puntuacion
   $maxAux=getMaxima($puntuaciones, $apuesta);

   //Esto es el bote
   $bote=getBote($puntuaciones, $apuesta);

   //Esto muestra la frase ganadora y el premio
   $botexjugador=ganadores($puntuaciones, $maxAux, $bote);

   //Esto muestra la tabla de los jugadores con sus cartas
   mostrarjugadores($baraja, $jugadores, $numcartas, $nombre1, $nombre2, $nombre3, $nombre4);

   $fichero=apuesta($puntuaciones, $botexjugador, $maxAux);
  
   //Imprimir fichero en pantalla
   imprimirFIchero($fichero);

?>
</BODY>
</HTML>