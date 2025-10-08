<?php
session_start();
include "../controllers/conection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$producto_id = $_POST['producto_id'] ?? null;

if (!$producto_id) {
    die("Error: no se recibió el ID del producto.");
}

// Verificar si ya existe en el carrito
$stmt = $connection->prepare("SELECT * FROM carrito WHERE user_id = ? AND producto_id = ?");
$stmt->bind_param("ii", $user_id, $producto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt = $connection->prepare("UPDATE carrito SET cantidad = cantidad + 1 WHERE user_id = ? AND producto_id = ?");
    $stmt->bind_param("ii", $user_id, $producto_id);
    $stmt->execute();
} else {
    $stmt = $connection->prepare("INSERT INTO carrito (user_id, producto_id, cantidad) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $user_id, $producto_id);
    $stmt->execute();
}

header("Location: ../views/catalogo.php?msg=agregado");
exit();
?>
