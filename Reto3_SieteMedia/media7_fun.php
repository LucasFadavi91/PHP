<HTML>
    <HEAD> 
        <TITLE> Funciones - siete y media </TITLE>
        <meta charset="utf-8">   
        <meta name="author" content="Lucas Fadavi">
    </HEAD>
  <BODY>
<?php

#Lucas Fadavi Solanilla

/*Funcion: mostrar y generar cartas
Parametros $numcartas
Estructuras utilizadas array asociativo
valor de retorno: $baraja*/
function cartas($numcartas) {

  
    $baraja = array("1C"=> 1.0, "1D"=> 1.0, "1P"=> 1.0, "1T"=> 1.0, 
    "2C"=> 2.0, "2D"=> 2.0, "2P"=> 2.0, "2T"=> 2.0, 
    "3C"=> 3.0, "3D"=> 3.0, "3P"=> 3.0, "3T"=> 3.0, 
    "4C"=> 4.0, "4D"=> 4.0, "4P"=> 4.0, "4T"=> 4.0,
    "5C"=> 5.0, "5D"=> 5.0, "5P"=> 5.0, "5T"=> 5.0, 
    "6C"=> 6.0, "6D"=> 6.0, "6P"=> 6.0, "6T"=> 6.0,
    "7C"=> 7.0, "7D"=> 7.0, "7P"=> 7.0, "7T"=> 7.0, 
    "JC"=> 0.5, "JD"=> 0.5, "JP"=> 0.5, "JT"=> 0.5,
    "KC"=> 0.5, "KD"=> 0.5, "KP"=> 0.5, "KT"=> 0.5, 
    "QC"=> 0.5, "QD"=> 0.5, "QP"=> 0.5, "QT"=> 0.5);

   
  
    foreach($baraja as $card => $valor) {
      //echo "<img src='./images/$card.PNG' width='70' height='100'>";
      
     //echo $valor;
     //echo $card." ";

    }
      
      //var_dump($baraja);
      
      return $baraja;
       
}


/* Funcion: mostrar y generar jugadores
Parametros $baraja, $numcartas, $nombres
Estructuras utilizadas arrays, bucles
valor de retorno: $jugadores*/
function jugadores($baraja, $numcartas, $nombres){

  //Esto es un array auxiliar de la baraja
  $cartas=array();

  $i=0;
  foreach($baraja as $card => $valor) {/*aqui en total lo que hago es guardar el nombre de las 
                                          cartas en el array auxiliar*/
    $cartas[$i]=$card;
    $i++;
    //echo $card;
  }

  //Mezcla las cartas (Barajear)
 shuffle($cartas);

  for ($j=0; $j < 4; $j++) {
    $jugadores[$nombres[$j]]=array();
      for ($c=0; $c < $numcartas; $c++) { /*aqui en mi array de jugadores que contiene los nombres
        de cada jugador, que previamente hemos guardado en el array de nombre, es defido es decir
        se le asigna un numero de cartas para mas adelante mostrarlo en la tabla*/

        $carta = array_shift($cartas); //coge la primera carta de la baraja
         
        array_push($jugadores[$nombres[$j]], $carta); //introduce a cada jugador las cartas que va a tener en su array

          
       }

  }
        
      //var_dump($jugadores);
      return $jugadores;

}

/* Funcion: Imprimir jugadores en la tabla
Parametros $baraja, $jugadores, $numcartas
Estructuras utilizadas tabla, bucle
valor de retorno: nada */
function mostrarjugadores($baraja, $jugadores, $numcartas ){

  //$users=array($nombre1,$nombre2,$nombre3,$nombre4);
  //$baraja=cartas($numcartas);

  
  echo "<table border='1'> ";
  
  foreach($jugadores as $nombre => $cartas) {
    
    echo "<tr>";
    echo "<td>".$nombre."</td>";

    for ($j=0; $j < count($cartas); $j++) {
        $card=$cartas[$j];
    
      echo "<td><img src='./images/$card.PNG' width='70' height='100'></td>";
     
          }
      }

      echo "</tr>";
      //var_dump($jugadores);
      echo "</table>";

}

/* Funcion: guarda las puntuaciones de cada jugador en un array
Parametros $baraja, $jugadores, $nombres
Estructuras utilizadas bucles, array
valor de retorno: $puntuaciones */
function puntuaciones($baraja, $jugadores, $nombres){

for ($i=0; $i < 4; $i++) {
  $puntuaciones[$nombres[$i]] = 0;
  /*$puntuaciones["maquina"] = 0;
  $puntuaciones["fiera"] = 0;
  $puntuaciones["listo"] = 0;*/

}
  
  $j=0;
  foreach($jugadores as $nombre => $cartas) { //tengo los jugadores con los nombres de sus cartas
  
    for ($c=0; $c < count($cartas); $c++) {
 
      foreach($baraja as $carta => $valor) { //tengo el valor de cada carta
    
        if($cartas[$c] == $carta) { //Esto asigna a cada carta por su nombre el valor correspondiente
        
          $puntuaciones[$nombre] += $valor; //tengo los nombres de cada jugador y su puntuacion
          $j++;
          
              }
  
          }
  
      }
      $j=0;
      
  }
  //var_dump($puntuaciones);
  return $puntuaciones;
  
}

/* Funcion: obtengo las maximas puntuaciones
Parametros $puntuaciones, $apuesta
Estructuras utilizadas bucles, condiciones
valor de retorno: $maxAux */
function getMaxima($puntuaciones, $apuesta){

  $maxAux=0;

  foreach($puntuaciones as $nombre => $puntos){

    if($puntos>$maxAux && $puntos <= 7.5) {
      $maxAux=$puntos;
    }  

  }

  return $maxAux;

}

/* Funcion: obtengo la cantidad total del bote
Parametros $puntuaciones, $apuesta
Estructuras utilizadas bucles, condiciones
valor de retorno: $bote */
function getBote($puntuaciones, $apuesta){

  $maxAux=0;

  foreach($puntuaciones as $nombre => $puntos){

    if($puntos>$maxAux && $puntos <= 7.5) {
      $maxAux=$puntos;
    }  

  }
  //echo $maxAux ."<br>";

  if($maxAux==7.5){

      $bote=$apuesta*0.8;

  }elseif($maxAux==0){   

      $bote=$apuesta;  

  }else{

      $bote=$apuesta*0.5;

  }

  //echo $bote;
  return $bote;

}

/* Funcion: obtengo la cantidad del bote que le corresponde a cada jugador
Parametros $puntuaciones, $maxAux, $bote
Estructuras utilizadas bucles, condiciones
valor de retorno: $botexjugador */
function ganadores($puntuaciones, $maxAux, $bote){

  $cont=0;

  foreach($puntuaciones as $nombre => $puntos){

      if($puntos==$maxAux){

        echo $nombre." ha ganado la partida con una puntuacion de ".$maxAux;
        echo "<br>";
        $cont++;
        //echo $cont;
      }
  }
      if($cont!=0){

        $botexjugador=$bote/$cont;
        echo "Los ganadores han obtenido ".$botexjugador." de premio";
        echo "<br>";

      }else{

        $botexjugador=$bote;
        echo "No ha habido ganadores y el bote es ".$botexjugador;
        echo "<br>";

    }

  return $botexjugador;

}

/* Funcion: escribe en el fichero apuestas las iniciales de cada jugador
con su puntuacion y el premio que les corresponde 
Parametros $puntuaciones, $botexjugador, $maxAux
Estructuras utilizadas bucles, condiciones, fichero
valor de retorno: "apuestas_".$fechaPartida.".txt" */
function apuesta($puntuaciones, $botexjugador, $maxAux){

  
  date_default_timezone_set('Europe/Madrid');

  $fechaPartida=date("dmyHis");

  $fichero = fopen("apuestas_$fechaPartida.txt", "w+");

  $cont=0;

  foreach($puntuaciones as $nombre => $puntos){

    $posinicial2=strposX($nombre, " ", 1)+1;

    $iniciales=substr($nombre, 0, 1).substr($nombre, $posinicial2, 1);
  

    if($puntos==$maxAux){
      fwrite($fichero, $iniciales."#".$puntos."#".$botexjugador);
      fwrite($fichero, chr(10));

      $cont++;

    }else{
      fwrite($fichero, $iniciales."#".$puntos."#"."0");
      fwrite($fichero, chr(10));

      }
  }
    
    fwrite($fichero, "TOTALPREMIOS"."#".$cont."#".$botexjugador*$cont);

    fclose($fichero);

  return ("apuestas_".$fechaPartida.".txt");

}

/*Encuentra un elemento en una determinada posicion*/
function strposX($haystack, $needle, $number){

      if($number == '1'){
          return strpos($haystack, $needle);
      }elseif($number > '1'){
          return strpos($haystack, $needle, strposX($haystack, $needle, $number - 1) + strlen($needle));
      }else{
          return error_log('Error: Value for parameter $number is out of range');
      }
  }

  /*Sanea los datos*/
  function sanear($data) {

    $data = trim($data); //Elimina espacios a izquierda y derecha

    $data = stripslashes($data); //Elimina backslashes \

    $data = htmlspecialchars($data); //Interpreta correctamente los caracteres especiales HTML

    return $data;

  }

  //No la uso
  function change_key( $array, $old_key, $new_key ) {

    if( ! array_key_exists( $old_key, $array ) )
        return $array;
  
    $keys = array_keys( $array );
    $keys[ array_search( $old_key, $keys ) ] = $new_key;
  
    return array_combine( $keys, $array );
    
  }

 /*
Imprimir el contenido del fichero en pantalla. Los nombres, puntos y premios
return:no hay
*/
function imprimirFichero($fichero){

  echo "<br>";
  echo "Fichero <strong>".$fichero."</strong><br><br>";

	$myfile = fopen($fichero, "r");
	while(!feof($myfile)) {
  		echo fgets($myfile) . "<br>";
	}
	fclose($myfile);
} 

?>
</BODY>
</HTML>
