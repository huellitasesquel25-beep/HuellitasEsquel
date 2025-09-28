<?php
// Verificamos que se haya enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizamos los campos
    $nombre  = htmlspecialchars(trim($_POST["nombre"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    // Validamos email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo no es válido.";
        exit;
    }

    // Configuración
    $destinatario = "huellitas.esquel25@gmail.com"; // 👈 poné acá tu correo real
    $asunto = "Nuevo mensaje desde Huellitas";

    // Armamos el contenido
    $cuerpo  = "Nombre: $nombre\n";
    $cuerpo .= "Correo: $email\n\n";
    $cuerpo .= "Mensaje:\n$mensaje\n";

    // Cabeceras
    $headers  = "From: Huellitas <no-reply@tudominio.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envío
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        echo "¡Gracias $nombre! Tu mensaje fue enviado correctamente.";
    } else {
        echo "Lo sentimos, hubo un error al enviar el mensaje. Intentalo más tarde.";
    }
} else {
    echo "Acceso no permitido.";
}

