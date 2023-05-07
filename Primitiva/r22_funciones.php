<HTML>
    <HEAD> <TITLE> Funciones - primitiva </TITLE>
     <meta charset="utf-8">   
    </HEAD>
    <BODY>
<?php

#Lucas Fadavi Solanilla

/*Parametros $fecha
Funcion: mostrar y generar combinacion
Estructuras utilizadas array
valor de retorno: $combinacion*/

function combinacionG($fecha) {

    $combinacion=array();

    echo "<img src='primitiva.jpg' width='' height=''>";
    echo "<p>Lotería Primitiva de España / <strong> Sorteo ".substr($fecha, 8,2)."-".substr($fecha, 5,2)."-".substr($fecha, 0,4)."</strong></p>";

     echo "<h4>¡Combinación premiada del sorteo!</h4>";
      for ($i = 0; $i < 6; $i++) {
       do {
         $num = rand(1, 49);
       } while(in_array($num,$combinacion));

       $combinacion[$i] = $num;

       //Para mostrar las imagenes de las bolas
       echo "<img src='r22_bolasprimitiva/$num.PNG' width='45' height='45'>";
        
      }

      //Numero complementario
      do {
		    $num = rand(1, 49);
			
		    } while(in_array($num,$combinacion));
	
          $combinacion[$i] = $num;

          echo "<br>";
          echo "<br><strong>Complementario: <br></strong>";
          echo "<img src='r22_bolasprimitiva/$num.PNG' width='45' height='45'>";

          //Reintegro
          $num = rand(0, 9);
      
          $combinacion[$i+1] = $num;

           echo "<br>";
           echo "<br><strong>Reintegro: <br></strong>";
           echo "<img src='r22_bolasprimitiva/rbola$num.PNG' width='45' height='45'>";
           echo "<br>";

            return $combinacion;

          }

/*Parametros ninguno $recaudacion, $fecha, &$cont6, &$cont5C, 
&$cont5, &$cont4, &$cont3, &$contRein
Funcion: mostrar y calcular premios
Estructuras utilizadas array/fichero
valor de retorno: Ninguno*/  

    function premios($recaudacion, $fecha, $contadores){

      /*El valor del los premios de cada categoria es 0 porque por razones que
      desconozco no me coge el valor de los contadores y por lo tanto no 
      hace la division de los premios, sin embargo si le doy unos valores
      predefinidos a los contadores como se muestra abajo, si hace lo que tiene
      que hacer la funcion y muestra valores en las categorias de premios*/ 
       
      /*$cont6=0; 
      $cont5C=0; 
      $cont5=2;
      $cont4=4; 
      $cont3=5; 
      $contRein=10;*/

      //var_dump($contadores);

      
        $fechasorteo=substr($fecha, 8,2).substr($fecha, 5,2).substr($fecha, 0,4);
       

        $premios = fopen("premiosorteo_$fechasorteo.txt", "w+");

            $porcentaje = 80;
            $recaudacion;
            $newRecaudacion = ($porcentaje / 100) * $recaudacion;

            $c6r = ($newRecaudacion/100) * 40;
            $c5masr = ($newRecaudacion/100) * 30;
            $c5r = ($newRecaudacion/100) * 15;
            $c4r = ($newRecaudacion/100) * 5;
            $c3r = ($newRecaudacion/100) * 8;
            $crr = ($newRecaudacion/100) * 2;

            if($contadores[0]!=0){

              $c6 = $c6r/$contadores[0];

            }else{

              $c6=0;
            }
            fwrite($premios,  "C6#".$c6.PHP_EOL);

            if($contadores[1]!=0){

              $c5mas = $c5masr/$contadores[1];
            
            }else{

              $c5mas=0;
            }
            fwrite($premios,  "C5+#".$c5mas.PHP_EOL);

            if($contadores[2]!=0){

              $c5 = $c5r/$contadores[2];
            
            }else{

              $c5=0;
            }
            fwrite($premios,  "C5#".$c5.PHP_EOL);

            if($contadores[3]!=0){

              $c4 = $c4r/$contadores[3];
            
            }else{

              $c4=0;
            }
            fwrite($premios,  "C4#".$c4.PHP_EOL);

            if($contadores[4]!=0){

              $c3 = $c3r/$contadores[4];
            
            }else{

              $c3=0;
            }
            fwrite($premios,  "C3#".$c3.PHP_EOL);

            if($contadores[5]!=0){

              $cr = $crr/$contadores[5]; 
            
            }else{

              $cr=0;
            }
            fwrite($premios,  "CR#".$cr.PHP_EOL);
          
            fclose($premios);
        
    
        /*fwrite($premios,  "C6#".$c6.PHP_EOL."C5+#".$c5mas.PHP_EOL."C5#".$c5.PHP_EOL.
        "C4#".$c4.PHP_EOL."C3#".$c3.PHP_EOL."CR#".$cr)."<br>";
        
        fclose($premios);
        */

            
    } 
/*Parametros $combinacion
Funcion: muestra los aciertos en cada una de las apuestas
Estructuras utilizadas array/fichero
valor de retorno: Ninguno*/ 

    function contarAciertos($combinacion){

       /*Defino posiciones para poder compararlas */
        $combinacionAux=array($combinacion[0],$combinacion[1],$combinacion[2],
        $combinacion[3],$combinacion[4],$combinacion[5]);
        //var_dump($combinacionAux);

        $cont6=0;
        $cont5C=0;
        $cont5=0;
        $cont4=0;
        $cont3=0;
        $cont2=0;
        $cont1=0;
        $cont0=-1;#En -1 para que no cuente en las estadisticas la primera linea que tiene 0 aciertos
        $contRein=0;
       
        /*contJugadas lo inicializo en -1 para que no cuente la primera linea en las 
        estadisticas */

        $contJugadas=-1;
        $needle='-';
        $datos = file("r22_primitiva2.txt");
        
        foreach ($datos as $linea=>$fila) {
          $aciertoRein=0;
          $aciertoCom=0;

          /*Comentarios para mi: */
          $apuesta=array();

          #Para ver el contenido de una fila          
          /*echo $fila;
          echo "<br>";*/
          $contJugadas++;
          
          /*creo estas variables que me van a servir para determinar la posicion
          del $needle que es mi separador de campos, de esta manera al incrementarlas
          en un futuro van a ir mostrandome el contenido que hay entre los separadores
          sin lugar de definirlas constantemente*/


          $primerguion=1;#primera aparicion del guion obviando el ID de la apuesta
          $segundoguion=2;#segunda aparicion del guion 
  
          /*Este for me sirve para recorrer los 6 primeros numeros y de esta manera
          $num me va a devolver el contenido que hay en los separadores*/
          for($n=0; $n <= 5; $n++){

          $comienzo=strposX($fila, $needle, $primerguion)+1;
          $final=strposX($fila, $needle, $segundoguion);
          $num=substr($fila, $comienzo, ($final-$comienzo));
          /*Esto me va a devolver el contenido entre separadores, siempre tendre que pasar 
          posicionInicial y posicion final, al menos que quiera algo concreto*/
          
          $apuesta[$n]=$num;#guardo los seis primeros numeros

          #Para ver el valor de $num      
          /*echo $num;
          echo "<br>";*/

          $primerguion++;
          $segundoguion++;
    
        }
    
        #Septima ocurrencia del $needle +1 para coger el contenido
          $comienzo=strposX($fila, $needle, 7)+1;
          $final=strposX($fila, $needle, 8);#termina en esa misma posicion que "recoge"
          $complementario=substr($fila, $comienzo, ($final-$comienzo));
          #Para ver el valor de $complementario 
          /*echo $complementario;
          echo "<br>";*/

          $apuesta[6]=$complementario;

          /*Es la ultima posicion de la linea por eso tiene que ser -1, pero en este caso
          es -3 porque hay que sumarle dos saltos de linea*/
          $reintegro=substr($fila,-3);
          #Para ver el valor de $reintegro 
          /*echo $reintegro;
          echo "<br>";*/

          $apuesta[7]=$reintegro;
          /*Defino posiciones para poder compararlas */
          $apuestaAux=array($apuesta[0],$apuesta[1],$apuesta[2],
          $apuesta[3],$apuesta[4],$apuesta[5]);

          /*Compara los valores que tienen en comun los dos arrays */
          $coincidencias = array_intersect($combinacionAux, $apuesta);
          //var_dump($combinacion);
          $contAciertos=count($coincidencias);
          if($apuesta[6]==$combinacion[6]){
              $aciertoCom=1;
          }
          if($apuesta[7]==$combinacion[7]){
            $aciertoRein=1;
          }
          /*
          Muestra los aciertos por cada linea
          echo "Numero de aciertos: ".$contAciertos."<br>";
          echo "<br>";*/
          contarGanadores($contAciertos, $aciertoCom, $aciertoRein, $cont6, $cont5C, $cont5, $cont4, $cont3, $cont2, $cont1, $cont0, $contRein);
          
          
      }
          echo "&nbsp&nbsp&nbspApuesta Jugadas: <strong>".$contJugadas."</strong>";
          echo "<br>";
          echo "<br>";

        echo "<ul>  
        <li> Acertantes 6 números: <strong>".$cont6."</strong></li>
        <li> Acertantes 5 números + Complementario: <strong>".$cont5C."</strong></li>
        <li> Acertantes 5 números: <strong>".$cont5."</strong></li>
        <li> Acertantes 4 números: <strong>".$cont4."</strong></li>
        <li> Acertantes 3 números: <strong>".$cont3."</strong></li>
        <li> Acertantes Reintegros: <strong>".$contRein."</strong></li>
        <li> Acertantes 2 números: <strong>".$cont2."</strong></li>
        <li> Acertantes 1 números: <strong>".$cont1."</strong></li>
        <li> Acertantes 0 números: <strong>".$cont0."</strong></li>
        </ul>";

        //list ($cont6, $cont5C, $cont5, $cont4, $cont3, $contRein) = contarAciertos() ;

        $contadores=array();
        array_push($contadores, $cont6, $cont5C, $cont5, $cont4, $cont3, $contRein);

        //var_dump($contadores);

       return $contadores;
  
    }

/*Parametros $contAciertos, &$aciertoCom, &$aciertoRein, &$cont6, &$cont5C, &$cont5, &$cont4, &$cont3, &$cont2, &$cont1, &$cont0, &$contRein
Funcion: para contar ganadores
Estructuras utilizadas condiciones anidadas
valor de retorno: Ninguno*/  

    function contarGanadores($contAciertos, &$aciertoCom, &$aciertoRein, &$cont6, &$cont5C, &$cont5, &$cont4, &$cont3, &$cont2, &$cont1, &$cont0, &$contRein){

      if ($contAciertos == 6) {
        $cont6++;
      }
      if ($contAciertos == 5 && $aciertoCom == 1) {
        $cont5C++;
      }
      if ($contAciertos == 5 && $aciertoCom == 0) {
        $cont5++;
      }
      if ($contAciertos == 4) {
        $cont4++;
      }
      if ($contAciertos == 3) {
        $cont3++;
      }
      if ($contAciertos == 2 && $aciertoRein ==0) {
        $cont2++;
      }
      if ($contAciertos == 1 && $aciertoRein ==0) {
        $cont1++;
      }
      if ($contAciertos == 0 && $aciertoRein ==0) {
        $cont0++;
      }
      if ($aciertoRein==1 && ($contAciertos == 0 || $contAciertos == 1 || $contAciertos == 2)) {
        $contRein++;
      
      }
      /*contarGanadores($contAciertos, $aciertoCom, $aciertoRein, $cont6, $cont5C, $cont5, $cont4, $cont3, $cont2, $cont1, $cont0, $contRein);*/
     
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

?>
</BODY>
</HTML>