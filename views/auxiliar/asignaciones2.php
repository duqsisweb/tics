    <?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
    error_reporting(0);

    include '../../conexionbd.php';
    if (isset($_SESSION['usuario'])) {
        require '../../function/funciones.php';
    ?>

        <!DOCTYPE html>
        <html lang="en">

        <!-- HEAD -->
        <?php
        require '../../views/head.php';
        ?>



        <style>
            #suggestions-container {
                display: none;
                margin-top: 10px;
            }

            #suggestions {
                width: 100%;
            }
        </style>

        <body>

            <style>
                #app {
                    max-width: 400px;
                    margin: 0 auto;
                }
            </style>


            <!-- NAV -->
            <?php
            require '../../views/nav.php';
            ?>

            <section style="margin-top: 100px;">


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-2"></div>

                                <div class="col-md-6" style="margin: 50px 0px 0px 0px;">
                                    <label for="" class="form-label">NOMBRE</label>
                                    <input type="text" class="form-control" id="identificacion" placeholder="" name="" required>
                                    <div id="suggestions-container">
                                        <select id="suggestions" class="form-control"></select>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <label for="" class="form-label">Cédula</label>
                                    <input type="text" id="CEDULA" value="<?php echo $CEDULA ?>">
                                    <span id="cedulaSpan"></span>

                                </div>
                            </div>
                        </div>
                    </div>




                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const identificacionInput = document.getElementById("identificacion");
                            const suggestionsSelect = document.getElementById("suggestions");
                            const suggestionsContainer = document.getElementById("suggestions-container");
                            const cedulaInput = document.getElementById("CEDULA"); // Asegúrate de que el ID sea "CEDULA" y no "cedula"

                            identificacionInput.addEventListener("input", function() {
                                const inputValue = identificacionInput.value;

                                if (inputValue.length >= 3) {
                                    console.log("Haciendo petición AJAX...");
                                    const xhr = new XMLHttpRequest();
                                    xhr.open("GET", `autocomplete.php?inputValue=${inputValue}`, true);

                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                console.log("Respuesta AJAX recibida");
                                                const response = JSON.parse(xhr.responseText);

                                                suggestionsSelect.innerHTML = ""; // Limpiar opciones anteriores

                                                response.forEach(item => {
                                                    const option = document.createElement("option");
                                                    option.value = item.NOMBRE;
                                                    option.setAttribute("data-cedula", item.CEDULA);
                                                    option.textContent = `${item.NOMBRE} ${item.NOMBRE2} ${item.APELLIDO} ${item.APELLIDO2} - Cédula: ${item.CEDULA} - Cargo: ${item.CARGO} - Código: ${item.CODIGO}`;
                                                    suggestionsSelect.appendChild(option);
                                                });

                                                suggestionsContainer.style.display = "block";
                                            } else {
                                                console.error("Error en la petición AJAX");
                                            }
                                        }
                                    };

                                    suggestionsSelect.addEventListener("change", function() {
                                        const selectedOption = suggestionsSelect.options[suggestionsSelect.selectedIndex];
                                        if (selectedOption) {
                                            const cedula = selectedOption.getAttribute("data-cedula");
                                            console.log("Cédula seleccionada:", cedula);
                                            cedulaInput.value = cedula;
                                        }
                                    });
                                    // Agrega esto después del bloque de código anterior
                                    if (suggestionsSelect.options.length === 1) {
                                        const cedula = suggestionsSelect.options[0].getAttribute("data-cedula");
                                        console.log("Cédula seleccionada:", cedula);
                                        cedulaInput.value = cedula;
                                    }

                                    xhr.send();
                                } else {
                                    suggestionsContainer.style.display = "none";
                                }
                            });
                        });
                    </script>

            </section>
        </body>

        </html>

    <?php } else { ?>
        <script languaje "JavaScript">
            alert("Acceso Incorrecto");
            window.location.href = "../login.php";
        </script><?php
                } ?>