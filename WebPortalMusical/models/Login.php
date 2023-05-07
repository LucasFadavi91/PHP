<?php 

    require_once __DIR__ ."/../db/db.php";


        function validarDatosFinal($username, $passcode) {
        # Función : validarDatosFinal
        # Parametros:
        # -$username 
        #   -$passcode
        # Funcionalidad: 
        #  Crea una sesion con con los parametros dados por el usuario previamente  
        #     verificando que estos existen y habiendolos validado 
        # Estructuras utilizadas array, bucle, select
        #
        # retorna: null en caso de que el usuario no exista o bien establece la sesion
        #
        # Código realizado por Lucas Fadavi
        #
        # Fecha 08/02/2021    

            try {
        

                global $conexion;

                // Validación de error
                if ($conexion == "ERROR") {
                    header("location: logout.php");
                }

                // Consulta
                $sql = "SELECT * FROM customer WHERE email = :username AND LastName = :passcode";

                $resultado = $conexion->prepare($sql);
                $resultado->execute(array(":username"=>$username, ":passcode"=>$passcode));

                $resultado_contado = $resultado->rowCount();

                session_start();
                
                //Si devuelve 1 (true) establezco el login 
                if ($resultado_contado == 1) {
                    $_SESSION["username"] = $username;
                    $_SESSION["passcode"] = $passcode;  

                } else {
                    $_SESSION["error"] = "ERROR";

                }

                
            }catch (PDOException $ex) {
                    echo "<p>Ha ocurrido un error al devolver los datos. <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
                    header("location: ./../index.php");
                    return null;
                    
                }

        }

?>
