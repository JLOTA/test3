<?php
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];

$msj = "Nombre: " . $nombre . "<br>Correo: " . $correo . "<br>Teléfono: " . $telefono . "<br>Mensaje: " . $mensaje;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jota.ele.d10@gmail.com';                     // SMTP username
    $mail->Password   = 'S1n*R3nK0r3S';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('jota.ele.d10@gmail.com', $nombre);
    $mail->addAddress('jota.ele.d10@gmail.com');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Correo enviado desde el servidor';
    $mail->Body    = $msj;
    $mail->AltBody    = $msj;
    $mail->CharSet = 'UTF-8';
	$mail->send();
    echo "<script>
    alert('El mensaje se envío correctamente');
    history.go(-1);
    </script>";

} catch (Exception $e) {
    echo "Hubo un error al enviar al mensaje", $mail->ErrorInfo;
}