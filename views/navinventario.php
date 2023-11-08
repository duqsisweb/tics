<style>
    .zoom-button {
    transition: transform 0.3s; /* Agregar una transición suave de 0.3 segundos */
}

.zoom-button:hover {
    transform: scale(1.2); /* Hacer zoom al 120% cuando el mouse está sobre el botón */
}

</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
              <button type="button" class="btn btn-light zoom-button" id="volverAtras">Volver Atrás</button>
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