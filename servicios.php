<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/subjefatura-sinfondo-2.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/leaflet.css">

    <style>
        #map { height: 600px; }
    </style>

    <title>Servicios</title>
</head>
<body>

<header class="header shadow p-1 mb-5 bg-body-tertiary rounded">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand">
                <img src="image/ciudad-logo-sinfondo.png" alt="Policia_ciudad" width="60" height="55">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto justify-content-center">
                    <li class="nav-item">
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

    

    <div id="map"></div>

    <script src="js/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Añadir capa GeoJSON al mapa
        var geojsonLayer = L.geoJSON(<?php echo $geojson_string; ?>).addTo(map);
    </script>

    
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
