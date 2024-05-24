<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/subjefatura-sinfondo-2.png">


    <link rel="stylesheet" href="css/estilo.css"/>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.rtl.min.css">  
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">    
    <link rel="stylesheet" href="css/bootstrap-reboot.rtl.min.css"> 
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">


    <title>Servicios</title>
</head>


<body class="contenedor">
<header class="header shadow p-1 mb-5 bg-body-tertiary rounded">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" >
            <img src="image/ciudad-logo-sinfondo.png" alt="Policia_ciudad" width="60" height="55">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php"><b>Inicio</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="administracion.php">Administración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="prevencion.php">Prevención</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comunas.php">Comunas</a>
                </li>
            </ul>
        </div>

        <a class="navbar-brand"> 
            <img src="image/subjefatura-sinfondo-2.png" alt="subjefatura" width="60" height="55">
        </a>
    </div>
</nav>
    </header>

    <div class="container">
      <div class="text-center fs-1 fw-bold">  
         <p>División Apoyo y Seguimiento</p> 
      </div>
      
        <div class="text-center">
        <p class="h2">Administración</p>
        </div>
    </div>
    <br>



    
    <div class="form_general">

        <div class="row align-items-start">
            <div class="col-3">
                <form class="tam-formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="mb-3">
                      <label for="lp" class="form-label">Legajo Personal</label>
                      <input type="number" class="form-control" name="adm_lp" id="adm_lp" aria-describedby="Legajo">
                    </div>
                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre: </label>
                      <input type="text" class="form-control" name="adm_nombre" id="adm_nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="adm_apellido" id="adm_apellido">
                      </div>
                    <button type="submit" value="Enviar" name='submit' class="btn btn-primary">Enviar</button>
                  </form>
                  <?php 
                  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
                      // Aquí procesas los datos del formulario
                        $lp = $_POST["adm_lp"];
                        $nombre = $_POST["adm_nombre"];
                        $apellido = $_POST["adm_apellido"];
        
                      // Aquí llamas a la función para insertar los datos en la base de datos
                      include_once 'conexion.php';
                      conexion::insertarDatos_administracio($lp, $nombre, $apellido);
                      }
    ?>
                   
                </div>
          </div>
       
    </div>
      
    <footer>    
    <div class="bg-light py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-0">© 2024 Diseñado por la División Apoyo y Seguimiento.</p>
      </div>
    </div>
</footer>
   
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.esm.js"></script>
    <script src="js/bootstrap.esm.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
  
</body>
</html>