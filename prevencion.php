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
    


    <title>Document</title>
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
        <p class="h2">Prevención y Delitos</p>
        </div>
    </div>
    <br>


<!-- inicio modulo busqueda de PERSONA CONTROLADA -->
<div style="margin-left: 10px;">
    <p class="h5">Busqueda de personas controladas</p>
    <form action="" method="POST" class="mb-3">
        <input type="text" class="col-md-4" id="busqueda_persona" name="busqueda_persona" placeholder="Buscar por número de DNI">
        <button type="submit" name="buscar_persona" class="btn btn-success">Buscar</button>
        <button type="submit" name="limpiar_datos" class="btn btn-warning">Limpiar</button>
    </form>
</div>
<br>

<?php
include_once 'conexion.php'; //conecto con la base de datos

// Verificar si se ha enviado el formulario
if(isset($_POST['busqueda_persona'])) {
    // Obtener el término de búsqueda ingresado por el usuario
    $termino_busqueda = $_POST['busqueda_persona'];

    // Incluir la clase de conexión a la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conexionDB();

    try {
        // Consulta SQL para buscar la persona en la base de datos por el número de DNI
        $sql = "SELECT * FROM public.control_poblacional_1c WHERE dni = :busqueda_persona";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Bind de parámetros
        $stmt->bindParam(':busqueda_persona', $termino_busqueda);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados de la consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla responsiva
        if(is_array($resultados) && count($resultados) > 0) {
            echo "<div class='table-responsive'>";
            echo "<table id='persona_controlada' class='table table-bordered table-striped'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>Registro ID</th>";
            echo "<th>Fecha y Hora del control</th>";
            echo "<th>Lugar de Control</th>";
            echo "<th>Nacionalidad</th>";
            echo "<th>Numero de DNI</th>";
            echo "<th>Apellido</th>";
            echo "<th>Nombre</th>";
            echo "<th>División que controló</th>";
            echo "<th>Personal que identificó</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($resultados as $resultado) {
                echo "<tr>";
                echo "<td>" . $resultado['id'] . "</td>";
                echo "<td>" . $resultado['start'] . "</td>";
                echo "<td>" . $resultado['direccion_control'] . "</td>";
                echo "<td>" . $resultado['Nacionalidad'] . "</td>";
                echo "<td>" . $resultado['dni'] . "</td>";
                echo "<td>" . $resultado['Apellido'] . "</td>";
                echo "<td>" . $resultado['Nombres'] . "</td>";
                echo "<td>" . $resultado['Destino'] . "</td>";
                echo "<td>" . $resultado['personal_identificador'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo " $termino_busqueda";
        }
    } catch(PDOException $e) {
        echo "Error al realizar la búsqueda: " . $e->getMessage();
    }
}

?>


<!-- fin modulo busqueda de PERSONA CONTROLADA -->

   <!-- SEPARADOR-->
   
   <hr class="border border-primary border-3 opacity-75">

   <!-- inicio modulo busqueda de sumario -->

<div style="margin-left: 10px;">

    <p class="h5">Busqueda de sumarios</p>
    <form action="" method="POST" class="mb-3">  
        <input type="text" class="col-md-4" id="busqueda_sumario" name="buscar" placeholder="Buscar de palabra dentro de la declaración:" >
        <button type="submit" name="enviar_busqueda" class="btn btn-success">Buscar</button>
        <button type="submit" name="limpiar_datos" class="btn btn-warning">Limpiar</button>
    </form>
    <br>
    <?php
    // Verificar si se ha enviado el formulario
    if(isset($_POST['buscar'])) {
        // Obtener el término de búsqueda ingresado por el usuario
        $termino_busqueda = $_POST['buscar'];

        // Verificar si el término de búsqueda no está vacío
        if (!empty($termino_busqueda)) {
            // Incluir el archivo de conexión a la base de datos
            include_once 'conexion.php';

            // Establecer conexión a la base de datos
            $conexion = new Conexion();
            $conn = $conexion->conexionDB();

            try {
                // Consulta SQL para buscar la palabra en la columna 'acta' y obtener el número de 'codigo_gap'
                $sql = "SELECT * FROM public.delitos_informaticos WHERE acta LIKE ?";

                // Preparar la consulta
                $stmt = $conn->prepare($sql);

                // Comodines para permitir coincidencias parciales
                $param = "%$termino_busqueda%";
                $stmt->bindParam(1, $param);

                // Ejecutar la consulta
                $stmt->execute();

                // Obtener los resultados de la consulta
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Cerrar la conexión a la base de datos
                $conn = null;

                // Mostrar los resultados en una tabla dinámica
                if(count($resultados) > 0) {
                  echo "<h2>Resultados de la búsqueda:</h2>";
                  echo "<div class='table-responsive'>";
                  echo "<table id='tabla_delitos_inf' class='table table-bordered table-striped'>";
                  echo "<thead class='thead-dark'>";
                  echo "<tr><th>Número de Sumario</th><th>Fecha</th><th>Delito</th><th>Modalidad</th><th>Acta</th></tr>";
                  echo "</thead>";
                  echo "<tbody>";
                  foreach($resultados as $resultado) {
                      echo "<tr>";
                      echo "<td>" . $resultado['codigo_gap'] . "</td>";
                      echo "<td>" . $resultado['fecha_hasta'] . "</td>";
                      echo "<td>" . $resultado['delito'] . "</td>";
                      echo "<td>" . $resultado['modalidad'] . "</td>";
                      echo "<td>" . $resultado['acta'] . "</td>";
                      echo "</tr>";
                  }
                  echo "</tbody>";
                  echo "</table>";
                  echo "</div>";
              } else {
                  echo "No se encontraron resultados para la palabra: $termino_busqueda";
              }
              
            } catch(PDOException $e) {
                echo "Error al realizar la búsqueda: " . $e->getMessage();
            }
        } else {
            echo "";
        }
    }
    ?>
</div>


<!-- fin modulo busqueda de sumario -->

<hr class="border border-primary border-3 opacity-75">

<!-- Inicio modulo busqueda por Delito o numero de sumario -->
<div style="margin-left: 10px;">
<form action="" method="POST" class="mb-3">
  <div>
    <p for="" class="h5 col-md-4">Selecciona el tipo de búsqueda deseado</p>
    <input type="radio" id="bus_num_sum" name="tipo_busqueda" value="sumario" checked>
    <label for="bus_num_sum" class="col-md-4">Búsqueda por Núm. Sumario</label><br>
    <input type="radio" id="bus_del" name="tipo_busqueda" value="delito">
    <label for="bus_del" class="col-md-4">Búsqueda por Delitos</label><br>
  </div>
  <br>
  <div id="input_busqueda">
    <p class="h5" id="label_busqueda" for="busqueda">Ingrese el término de búsqueda:</p>
    <input class="col-md-4" type="text" id="busqueda" name="busqueda" placeholder="Busquda por número de Sumario o Delito">
    <button type="submit" name="buscar" class="btn btn-success">Buscar</button>
    <button type="submit" name="limpiar_datos" class="btn btn-warning">Limpiar</button>
  </div>
  <br>
    
</form>
</div> 
  <?php
   include_once 'conexion.php'; //conecto con la base de datos

   // Inicializar la variable $sql
   $sql = "";

   // Verificar si se ha enviado el formulario
  if (isset($_POST['tipo_busqueda']) && isset($_POST['busqueda'])) {
    $tipo_busqueda = $_POST['tipo_busqueda'];
    $termino_busqueda = strtolower($_POST['busqueda']);


    
    // Incluir la clase de conexión a la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conexionDB();

    try {
        // Consulta SQL para buscar en función del tipo de búsqueda
        if ($tipo_busqueda === 'sumario') {
            $sql = "SELECT * FROM public.delitos WHERE LOWER(sumario) = LOWER(:busqueda)";
        } else if ($tipo_busqueda === 'delito') {
            $sql = "SELECT * FROM public.delitos WHERE LOWER(delito) = LOWER(:busqueda)";
        }

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Bind de parámetros
        $stmt->bindParam(':busqueda', $termino_busqueda);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados de la consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla responsiva
        if(is_array($resultados) && count($resultados) > 0) {
            echo "<div class='table-responsive' >";
            echo "<table id='tabla_busqueda_delitos' class='table table-bordered table-striped'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>Núm. Sumario</th>";
            echo "<th>Año</th>";
            echo "<th>Fecha</th>";
            echo "<th>Delito</th>";
            echo "<th>Modalidad</th>";
            echo "<th>Comisaria</th>";
            echo "<th>Lugar del Hecho</th>";
            echo "<th>Hora</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($resultados as $resultado) {
                echo "<tr>";
                echo "<td>" . $resultado['sumario'] . "</td>";
                echo "<td>" . $resultado['anio'] . "</td>";
                echo "<td>" . $resultado['fecha_hasta'] . "</td>";
                echo "<td>" . $resultado['delito'] . "</td>";
                echo "<td>" . $resultado['modalidad'] . "</td>";
                echo "<td>" . $resultado['comisaria_hecho'] . "</td>";
                echo "<td>" . $resultado['tipo_lugar_hecho'] . "</td>";
                echo "<td>" . $resultado['hora'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "<script>";


            echo "document.addEventListener('DOMContentLoaded', function() {";
            echo "  const busqueda_delito = document.getElementById('tabla_busqueda_delitos');";
            echo "  if (busqueda_delito) {";
            echo "    busqueda_delito.scrollIntoView({ behavior: 'smooth' });"; // Desplazar suavemente hacia la tabla
            echo "  }";
            echo "});";
            echo "</script>";




        } else {
            echo " $termino_busqueda";
        }
    } catch(PDOException $e) {
        echo "Error al realizar la búsqueda: " . $e->getMessage();
    }
}
?>
    <!-- fin modulo busqueda de Delito -->

    <hr class="border border-primary border-3 opacity-75">

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

<script> // funcion para limpiar la tabla de busqueda por dni
    document.addEventListener('DOMContentLoaded', function() {
        // Función para limpiar la tabla de resultados
        function limpiarTabla() {
            console.log('Limpiando resultados de búsqueda...');
            var resultadosBusqueda = document.getElementById('resultados_busqueda');
            if (resultadosBusqueda) {
                resultadosBusqueda.innerHTML = ''; // Eliminar el contenido de la tabla
            } else {
                console.error('No se encontró el elemento con ID "resultados_busqueda"');
            }
        }

        // Obtener el botón de limpieza por su ID
        var botonLimpiar = document.getElementById('limpiar_datos');

        // Agregar evento de clic al botón de limpieza
        botonLimpiar.addEventListener('click', limpiarTabla);
    });
</script>

<script> // limpiar tabla de busqueda de palabras
    // Función para limpiar la tabla de resultados
    function limpiarResultados() {
        // Seleccionar la tabla de resultados por su clase
        var tablaResultados = document.querySelector('.table-responsive');

        // Verificar si se encontró la tabla
        if (tablaResultados) {
            // Eliminar el contenido de la tabla
            tablaResultados.innerHTML = "<p></p>";
        } else {
            console.error('No se encontró la tabla de resultados.');
        }
    }

    // Esperar a que el documento HTML esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el botón de limpiar por su nombre
        var botonLimpiar = document.querySelector('button[name="limpiar_datos"]');

        // Verificar si se encontró el botón de limpiar
        if (botonLimpiar) {
            // Agregar un evento de clic al botón de limpiar
            botonLimpiar.addEventListener('click', limpiarResultados);
        } else {
            console.error('No se encontró el botón de limpiar.');
        }
    });
</script>

<script> // limpiar tabla de busqueda de palabras
    // Función para limpiar la tabla de resultados
    function limpiarResultados() {
        // Seleccionar la tabla de resultados por su clase
        var tablaResultados = document.querySelector('.table-responsive');

        // Verificar si se encontró la tabla
        if (tablaResultados) {
            // Eliminar el contenido de la tabla
            tablaResultados.innerHTML = "";
        } else {
            console.error('No se encontró la tabla de resultados.');
        }
    }

    // Esperar a que el documento HTML esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el botón de limpiar por su nombre
        var botonLimpiar = document.querySelector('button[name="tabla_delitos"]');

        // Verificar si se encontró el botón de limpiar
        if (botonLimpiar) {
            // Agregar un evento de clic al botón de limpiar
            botonLimpiar.addEventListener('click', limpiarResultados);
        } else {
            console.error('No se encontró el botón de limpiar.');
        }
    });
</script>

