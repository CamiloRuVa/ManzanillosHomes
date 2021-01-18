<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'connect.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fec_nac=$_POST['fec_nac'];
$correo = $_POST['correo'];
$con1 = $_POST['con1'];
$con2 = $_POST['con2'];



if($con1==$con2){
    $contraseña = password_hash($con1, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, nacimiento, correo, contra) VALUES ('$nombre', '$fec_nac', '$correo','$contraseña')";
    if (!mysqli_query($conn, $sql)) {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    enviar($correo,$nombre);

    mysqli_close($conn);
    header("Location:../IniSesion.html");
}
else{
    die("las contraseñas no son iguales");
}

function enviar($correo,$nombre){
    // ENVIO DE CORREO //


    require 'libreria/PHPmailer/Exception.php';
    require 'libreria/PHPmailer/PHPMailer.php';
    require 'libreria/PHPmailer/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //CONFIGURACION DEL SERVIDOR
        $mail->SMTPDebug = 0;                      					 // [0]NO MOSTRAR INFO. [2] MOSTRAR INFO. DEL ENVIO
        $mail->isSMTP();                                             // PROTOCOLO USADO [SMTP]
        $mail->Host       = 'smtp.gmail.com';                        // SERVIDOR QUE SE UTILIZA [GMAIL]
        $mail->SMTPAuth   = true;                                    // AUTENTICACION DE SMTP
        $mail->Username   = 'ManzanillosHouses@gmail.com';           // CORREO QUE SE UTILIZARA
        $mail->Password   = 'ManzaH3$4';                             // CONTRASE�A DEL CORREO
        $mail->SMTPSecure = 'ssl';         							 // TLS / SSL
        $mail->Port       =  465;                                    // CON TLS[587] CON SSL[465]
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mensaje = 
        '<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bienvenido</title>
        </head>
        <body>
            <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
                <tr>
                    <td style="background-color: #09f829; text-align: left; padding: 0">
                        <a href="https://jolly-lamarr-47ddfe.netlify.app/">
                            <img width="20%" style="display:block; margin: 1.5% 3%" src="https://i.postimg.cc/T2k2sP6z/unnamed.png">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0">
                        <img style="padding: 0; display: block" src="https://i.postimg.cc/bYb0Jnwh/EB-AW3905.jpg" width="100%">
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #ecf0f1">
                        <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                            <h2 style="color: #e67e22; margin: 0 0 7px">Te damos la bienvenida a Manzanillo Homes</h2>
                            <p style="margin: 2px; font-size: 15px">
                                Tu correo ha sido registrado en nuestra plataforma, esperamos que encuentres tu casa deseada, un saludo.</p>
                            <div style="width: 100%; text-align: center"></br></br>
                                <a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href="https://jolly-lamarr-47ddfe.netlify.app/">Ir a la página</a>	
                            </div>
                            <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Manzanillo Homes</p>
                        </div>
                    </td>
                </tr>
            </table>
        </body>
        </html>';


        $mail->setFrom('ManzanillosHouses@gmail.com', 'Manzanillos Houses');   		// INFORMACION DEL REMITENTE
        $mail->addAddress($correo, $nombre);    			// INFORMACION DEL DESTINATARIO	

        //$mail->addAttachment('temp/2.png');    	// ADICIONALES(IMAGEN)
        
        // CONTENIDO
        $mail->isHTML(true);                                  
        $mail->Subject = 'ASUNTO MUY IMPORTANTE 2';
        $mail->Body    =$mensaje;
        
        // MENSAJE DE EXITO/ERROR
        $mail->send();
        //echo 'ENVIO EXITOSO';
        
        header("Location:../cambiar-contra2.html");
    } catch (Exception $e) {
        echo "NO SE PUDO ENVIAR: {$mail->ErrorInfo}";
    }
}

?>