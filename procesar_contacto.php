<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    try {
        // Preparar la consulta para insertar los datos en la tabla contacto
        $stmt = $conn->prepare("
            INSERT INTO contacto (fecha, correo, nombre, asunto, comentario)
            VALUES (NOW(), :correo, :nombre, :asunto, :comentario)
        ");
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->execute();

        // Devolver el mensaje de éxito y el comentario formateado
        echo "<div class='comment-box'>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($nombre) . "</p>";
        echo "<p><strong>Correo:</strong> " . htmlspecialchars($correo) . "</p>";
        echo "<p><strong>Comentario:</strong></p>";
        echo "<p>" . htmlspecialchars($comentario) . "</p>";
        echo "</div>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

