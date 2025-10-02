<?php
// Incluye save_user.php para procesar el POST
include "../controllers/save_user.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hatters Club | Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow form-card">
      <h3 class="text-center mb-4">Regístrate para comprar</h3>

      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" class="form-control" name="username" placeholder="Nombre de usuario" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
        </div>

        <div class="input-group mb-4">
          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
          <input type="email" class="form-control" name="email" placeholder="Correo electrónico" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrarme</button>
      </form>
    </div>
  </div>
</body>
</html>
