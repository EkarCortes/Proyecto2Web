<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alkar - Soluciones Tecnológicas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/sidebar.css">
</head>
<body>
  <!-- Barra lateral y botón de alternar (como en el ejemplo anterior) -->
  <button class="toggle-btn" id="toggleButton" style="right: 20px; left: auto;"><i class="bi bi-list"></i></button>

  <!-- Barra lateral -->
  <div class="sidebar" id="sidebar">
    <a href="index.php" class="sidebar-link">Inicio</a>
    <a href="gestion_empleados.php">Gestión de Empleados</a>
    <a href="gestion_roles.php">Gestión de Roles</a>
    <a href="gestion_departamentos.php">Gestión de Departamentos</a>
  </div>

  <!-- Contenido principal -->
  <div class="content" id="content">
    <div class="row">
    <div class="container-fluid">
        <section id="head_principal" class="container-fluid text-center flex-column justify-content-center align-items-center">
            <h1 class="mt-4">Bienvenido a Alkar - Soluciones Tecnológicas</h1>
            <p>Ofrecemos soluciones innovadoras en tecnología para ayudar a tu empresa a crecer y evolucionar en un mundo digital.</p>
          </section>
          
      <!-- Sección "Quiénes somos" -->
      <div id="quienes-somos" class="company-info mt-5">
        <h2 class="section-title">¿Quiénes somos?</h2>
        <p>En <strong>Alkar</strong>, somos una empresa que se dedica a vender todo tipo de tecnologías, además de ofrecer servicios para armar infraestructuras y desarrollar aplicaciones personalizadas. Nos especializamos en soluciones tecnológicas avanzadas que optimizan los procesos empresariales y transforman el funcionamiento de los negocios.</p>
      </div>
      
      <!-- Sección "Qué hacemos" -->
      <div id="que-hacemos" class="company-info mt-5">
        <h2 class="section-title">¿Qué hacemos?</h2>
        <p>En <strong>Alkar</strong>, nos especializamos en ofrecer <span class="highlight">soluciones tecnológicas integrales</span> que impulsan la transformación digital y optimizan el rendimiento empresarial. Proporcionamos una amplia gama de servicios, incluyendo:</p>
        <ul>
          <li>Venta de todo tipo de tecnologías</li>
          <li>Armado de infraestructuras tecnológicas</li>
          <li>Desarrollo de software personalizado</li>
          <li>Consultoría en tecnología</li>
          <li>Automatización de procesos empresariales</li>
          <li>Desarrollo de aplicaciones móviles</li>
          <li>Integración de sistemas</li>
        </ul>
      </div>
      
      <!-- Sección "Nuestros productos" -->
      <div id="nuestros-productos" class="mt-5">
        <h2 class="section-title">Nuestros productos</h2>
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="card product-card">
              <img src="./img/producto1.jpg" alt="Producto 1">
              <div class="card-body">
                <h5 class="card-title">MAG B550 TOMAHAWK</h5>
                <p class="card-text">Una placa base ATX de MSI equipada con el chipset B550, compatible con procesadores AMD Ryzen de tercera generación y superiores. Ofrece soporte para PCIe 4.0, un sistema de alimentación robusto para un rendimiento estable, y varias opciones de expansión.</p>
                <a href="#" class="btn btn-primary">Más información</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card product-card">
              <img src="./img/podructo2.jpg" alt="Producto 2">
              <div class="card-body">
                <h5 class="card-title">Intel Core i7 14700KF</h5>
                <p class="card-text">Un procesador de alto rendimiento de la 14ª generación de Intel, diseñado para usuarios que buscan potencia y eficiencia en tareas exigentes. Cuenta con múltiples núcleos y hilos, lo que lo hace ideal para gaming, creación de contenido y aplicaciones intensivas.</p>
                <a href="#" class="btn btn-primary">Más información</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card product-card">
              <img src="./img/producto3.jpg" alt="Producto 3">
              <div class="card-body">
                <h5 class="card-title">Fuente de poder 1000W ROG-THOR-1000P2-EVA-GAMING</h5>
                <p class="card-text">Una fuente de poder de 1000W con certificación 80 PLUS Platinum, diseñada para gamers y entusiastas. Cuenta con un diseño exclusivo inspirado en Evangelion, pantalla OLED para monitorear el consumo de energía.</p>
                <a href="#" class="btn btn-primary">Más información</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- Pie de página -->
    <footer class="footer">
      <p>&copy; 2024 Alkar - Soluciones Tecnológicas. Todos los derechos reservados.</p>
    </footer>

    
    
  </div> 
  </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="./js/sidebar.js"></script>
  
</body>
</html>
