<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Tus datos
    $destino = "mdkjoel@hotmail.com"; // <-- reemplazar por correo real
    $asunto = "Nuevo mensaje desde Huellitas";

    // Datos del formulario
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["mensaje"]);

    // Validar campos
    if (empty($nombre) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor completá todos los campos correctamente.";
        exit;
    }

    // Cuerpo del mensaje
    $cuerpo = "Nombre: $nombre\n";
    $cuerpo .= "Correo: $email\n\n";
    $cuerpo .= "Mensaje:\n$mensaje\n";

    // Encabezados
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Enviar correo
    if(mail($destino, $asunto, $cuerpo, $headers)) {
        echo "¡Mensaje enviado correctamente!";
    } else {
        echo "Error al enviar el mensaje. Intentá de nuevo.";
    }

} else {
    echo "Acceso no permitido.";
}

