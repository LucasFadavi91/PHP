<HTML>
    <HEAD> <TITLE> Primitiva </TITLE>
     <meta charset="utf-8">   
    </HEAD>
    <BODY>
<?php

#Lucas Fadavi Solanilla

    include_once('./r22_funciones.php');

    $fecha = sanear($_POST['fechasorteo']);
    $recaudacion = sanear($_POST['recaudacion']);
    $combinacion = sanear($_POST['combinacion']);
 
    /*Muestro la combinacion ganadora, complementario y reintegro */
    $combinacion=combinacionG($fecha);

    //var_dump($combinacion);
   
    /*Muestro los acertantes*/
    $arrayAciertos=contarAciertos($combinacion);

    /*Para escribir en el fichero */
    $premiados=premios($recaudacion, $fecha, $arrayAciertos);
    echo "<br>";

?>
</BODY>
</HTML>