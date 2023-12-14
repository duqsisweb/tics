<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .zoom-button {
            transition: transform 0.3s; /* Agregar una transición suave de 0.3 segundos */
        }

        .zoom-button:hover {
            transform: scale(1.2); /* Hacer zoom al 120% cuando el mouse está sobre el botón */
        }
    </style>
    <title>Menú de Navegación</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button type="button" class="btn btn-light zoom-button" id="volverAtras"><i class="fas fa-arrow-left"></i> Volver Atrás</button>
                    <a href="http://192.168.10.17:9090/tics/views/auxiliar/inicio_auxiliar.php" class="btn btn-light zoom-button"><i class="fas fa-home"></i> Inicio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<script>
    // Función que se ejecuta cuando se hace clic en el botón
    document.getElementById("volverAtras").addEventListener("click", function() {
        window.history.back(); // Navega hacia atrás en el historial del navegador
    });
</script>

</body>
</html>
