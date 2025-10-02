<?php
session_start();
include "../controllers/conection.php";

// Si no hay sesión, lo mandamos a login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login_user.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta con INNER JOIN para traer info de productos
$stmt = $connection->prepare("
    SELECT c.id AS carrito_id, c.cantidad, p.nombre, p.precio
    FROM carrito c
    INNER JOIN products p ON c.producto_id = p.id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h1 class="mb-4">🛒 Mi Carrito</h1>

    <a href="catalogo.php" class="btn btn-secondary mb-3">⬅ Seguir comprando</a>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                while ($row = $result->fetch_assoc()): 
                    $subtotal = $row['precio'] * $row['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><img src="<?php echo $row['imagen']; ?>" alt="" width="70"></td>
                        <td>$<?php echo number_format($row['precio'], 2); ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <!-- Botón para eliminar -->
                            <form method="POST" action="eliminar_carrito.php" style="display:inline;">
                                <input type="hidden" name="carrito_id" value="<?php echo $row['carrito_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3 class="text-end">Total: $<?php echo number_format($total, 2); ?></h3>

        <div class="text-end">
            <a href="checkout.php" class="btn btn-success">Finalizar compra</a>
        </div>

    <?php else: ?>
        <p>No tienes productos en tu carrito 😢</p>
    <?php endif; ?>

</body>
</html>
