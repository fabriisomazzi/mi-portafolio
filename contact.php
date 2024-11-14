<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["mail"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validar que todos los campos están completos
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, completa todos los campos correctamente.";
        exit;
    }

    // Configurar destinatario y asunto
    $recipient = "tu-correo@ejemplo.com";  // Reemplaza con tu dirección de correo
    $email_subject = "Nuevo mensaje de $name: $subject";

    // Crear el contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Encabezados de correo
    $email_headers = "From: $name <$email>";

    // Enviar el correo
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        echo "Tu mensaje ha sido enviado. ¡Gracias!";
    } else {
        echo "Ocurrió un problema al enviar el mensaje. Inténtalo nuevamente.";
    }
} else {
    echo "Hubo un error al enviar el formulario.";
}
?>
