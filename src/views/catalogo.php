<?php
session_start();
include "../controllers/conection.php";

// Contador de productos en el carrito
$total_carrito = 0;
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $stmt = $connection->prepare("SELECT SUM(cantidad) AS total FROM carrito WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $total_carrito = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
}
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo | Hatter's Club</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
  <!-- Header -->
  <header class="header fixed-top">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.html">Hatter's Club</a>

        <!-- Buscador central -->
        <!-- <div class="search-container mx-auto d-none d-lg-block">
          <div class="input-group search-box">
            <input type="text" class="form-control" placeholder="Buscar..." id="catalogSearch">
            <button class="btn btn-outline" type="button" id="searchButton">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div> -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link" href="index.html">INICIO</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" id="marcasDropdown" role="button" data-bs-toggle="dropdown">
                MARCAS
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-filter="all">Todas las marcas</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="catalogo.php?brand=dandy" data-filter="dandy">Dandy Hats</a></li>
                <li><a class="dropdown-item" href="catalogo.php?brand=31hats" data-filter="31hats">31 Hats</a></li>
                <li><a class="dropdown-item" href="catalogo.php?brand=barbas" data-filter="barbas">Barbas Hats</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link active" href="catalogo.php">NUESTRO CATÁLOGO</a></li>
            <li class="nav-item"><a class="nav-link" href="destacados.html">TENDENCIAS</a></li>
            <li class="nav-item"><a class="nav-link" href="contacto.html">CONTÁCTANOS</a></li>

            <!-- Iconos de usuario/carrito -->
            <li class="nav-item ms-3">
              <div class="nav-icons">
                <a href="../views/login_user.php" class="text-dark me-3"><i class="bi bi-person"></i></a>
                <a href="../controllers/carrito.php" class="text-dark position-relative">
                  <i class="bi bi-bag"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $total_carrito; ?>
                  </span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Catálogo -->
  <section class="catalog-section py-5 mt-5">
    <div class="container">
      <h1 class="section-title text-center mb-4">NUESTRO CATÁLOGO</h1>

      <!-- Filtros y ordenamiento -->
      <div class="row mb-4">
        <div class="col-md-8">
          <div class="filter-buttons">
            <button class="btn btn-outline-dark active" data-filter="all">TODAS</button>
            <button class="btn btn-outline-dark" data-filter="dandy">DANDY HATS</button>
            <button class="btn btn-outline-dark" data-filter="31hats">31 HATS</button>
            <button class="btn btn-outline-dark" data-filter="barbas">BARBAS HATS</button>
          </div>
        </div>
        <div class="col-md-4 text-end">
          <select class="form-select" id="sortSelect">
            <option value="featured">Ordenar por: Destacados</option>
            <option value="price-low">Precio: Menor a Mayor</option>
            <option value="price-high">Precio: Mayor a Menor</option>
            <option value="name">Nombre A-Z</option>
          </select>
        </div>
      </div>

      <!-- Productos en grid como el primer diseño -->
      <div class="catalog-grid" id="productsContainer">
        <?php
        $sql = "SELECT * FROM products"; // puedes filtrar por marca si quieres
        $result = $connection->query($sql);

        while ($producto = $result->fetch_assoc()) {
        ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
              <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?></p>

                <?php if (isset($_SESSION['user_id'])): ?>
                  <!-- Usuario logueado: muestra botón -->
                  <form action="../controllers/agregar_carrito.php" method="POST">
                    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                    <button type="submit" class="btn btn-dark">Agregar al carrito</button>
                  </form>
                <?php else: ?>
                  <!-- Usuario NO logueado: muestra enlace -->
                  <a href="login.php" class="btn btn-secondary">Inicia sesión para comprar</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-dark text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4">
          <h5>SNAPS BY HATTERS CLUB</h5>
          <p>Donde el estilo urbano se encuentra con la tradición. Las mejores gorras para todos los estilos.</p>
          <div class="social-icons">
            <a href="https://www.instagram.com/emmnueel_/" class="text-white me-3"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/groups/378553431957941?locale=es_LA" class="text-white me-3"><i class="bi bi-facebook"></i></a>
            <a href="https://www.tiktok.com/@hatters.club" class="text-white me-3"><i class="bi bi-tiktok"></i></a>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6 mb-4">
          <h5>NAVEGACIÓN</h5>
          <ul class="list-unstyled">
            <li><a href="index.html" class="text-white-50">Inicio</a></li>
            <li><a href="catalogo.php" class="text-white-50">Catálogo</a></li>
            <li><a href="contacto.html" class="text-white-50">Contacto</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
          <h5>MARCAS</h5>
          <ul class="list-unstyled">
            <li><a href="catalogo.php?brand=dandy" class="text-white-50">Dandy Hats</a></li>
            <li><a href="catalogo.php?brand=31hats" class="text-white-50">31 Hats</a></li>
            <li><a href="catalogo.php?brand=barbas" class="text-white-50">Barbas Hats</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3 mb-4">
          <h5>CONTACTO</h5>
          <ul class="list-unstyled">
            <li><i class="bi bi-envelope me-2"></i>info@snaps.com</li>
            <li><i class="bi bi-telephone me-2"></i>+1 234 567 890</li>
            <li><i class="bi bi-geo-alt me-2"></i>Ciudad De Metepec, México</li>
          </ul>
        </div>
      </div>
      
      <hr class="my-4">
      
      <div class="text-center">
        <p>&copy;HATTERS CLUB. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script personalizado para catálogo -->
  <script src="../js/catalog.js"></script>
</body>

</html>