<?php
require_once "conection.php";
session_start();

$error = ""; // Variable para almacenar el mensaje de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $email    = trim($_POST["email"]);

    // Validaciones básicas
    if (empty($username) || empty($password) || empty($email)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo electrónico inválido.";
    } elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Verificar si usuario o correo ya existe
        $check = $connection->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "El usuario o correo ya está registrado. Intenta con otro.";
        } else {
            // Hashear la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertar nuevo usuario
            $stmt = $connection->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $email);

            if ($stmt->execute()) {
                // ✅ Guardar datos en sesión automáticamente
                $_SESSION['user_id'] = $stmt->insert_id; // último id insertado
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                // Redirigir al inicio ya logueado
                header("Location: ../views/index.html");
                exit();
            } else {
                $error = "Error al registrar: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
    $connection->close();
}
?>
