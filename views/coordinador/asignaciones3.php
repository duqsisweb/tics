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

    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
        ?>

        <section style="margin-top: 100px;">


            <!-- Estilos para cambiar borde de color -->
            <style>
                .empresa-1 {
                    border-color: rgb(247, 4, 4) !important;
                    /* Otros estilos... */
                }

                .empresa-2 {
                    border-color: rgb(5, 87, 28);
                    /* Otros estilos... */
                }

                .empresa-3 {
                    border-color: rgb(138, 137, 147);
                    /* Otros estilos... */
                }

                .background-container {
                    position: relative;
                }

                .background-image {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0.8;
                    padding-top: 50px;
                    padding-left: 190px;
                    /* Ajusta la opacidad y el padding según tus necesidades */
                }

                .card-body {
                    background-color: white !important;
                    opacity: 0.9 !important;
                }
            </style>

            <?php
            // SELECT PARA HACER LA CONSULTA
            if (isset($_POST['consultar'])) {

                $CEDULA = $_POST['CEDULA'];
                $empresaOption = $_POST['empresa'];
                $backgroundImage = '';

                switch ($empresaOption) {
                    case 1:
                        $empresa = 'DUQUESA';
                        $con = $conexion;
                        $backgroundImage = "duquesa_logo.png";
                        break;
                    case 2:
                        $empresa = 'Palmeras2013';
                        $con = $conexion2;
                        $backgroundImage = "logopalmeras.png";
                        break;
                    case 3:
                        $empresa = 'J25';
                        $con = $conexion2;
                        $backgroundImage = "logoj25.png";
                        break;
                    default:
                        // Opción inválida
                        // Se puede mostrar un mensaje de error o tomar alguna otra acción
                        break;
                }

                if (isset($con)) {
                    $data = odbc_exec($con, "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM $empresa..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 and CEDULA = '$CEDULA'");
                    $arr = array(); // Inicializar el arreglo para almacenar los resultados
                    while ($Element = odbc_fetch_array($data)) {
                        $arr[] = $Element;
                    }
                }

                if (!empty($arr)) {
                    // Mostrar la tarjeta con la información del usuario
                    $nombreCompleto = $arr[0]['NOMBRE'] . ' ' . $arr[0]['NOMBRE2'] . ' ' . $arr[0]['APELLIDO'] . ' ' . $arr[0]['APELLIDO2'];
                    $cedula = $arr[0]['CEDULA'];
                    $cargo = $arr[0]['CARGO'];

                    $showSections = true;

                    //  MENSAJES SI LA CONSULTA ES EXITOSA O NO HAY INFORMACIÓN
                    echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Éxito</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                </div>
                <div class="toast-body">
                    Consulta satisfactoria.
                </div>
            </div>';
                    echo '<script>
            var toastEl = document.querySelector(".toast");
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
          </script>';
                } else {
                    // Mostrar un mensaje de error
                    echo '<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                </div>
                <div class="toast-body">
                    No se encontraron registros para la consulta.
                </div>
            </div>';
                    echo '<script>
            var toastEl = document.querySelector(".toast");
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
          </script>';
                }
            }

            ?>



            <!-- SELECT CAPOS EMPRESA / CEDULA Y FICHA TECNICA -->
            <form method="POST">
                <div class="container">
                    <div class="row">


                        <div class="col-md-3" style="margin: 50px 0px 0px 0px;">
                            <label for="" class="form-label">Empresa</label>
                            <select name="empresa" class="form-select" aria-label="Default select example" required>
                                <option selected disabled>SELECCIONE EMPRESA</option>
                                <option value="1">Duquesa S.A. BIC</option>
                                <option value="2">Palmeras del Llano S.A. BIC</option>
                                <option value="3">J25</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="" class="form-label">NOMBRE</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
                            <div id="suggestions-container">
                                <select id="suggestions" class="form-control"></select>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2" style="margin: 50px 0px 0px 0px;">
                        <label for="" class="form-label">Identificación</label>
                        <input type="text" class="form-control" id="" placeholder="" name="CEDULA" pattern="[0-9]+" required>
                    </div>

                    <div class="col-md-2">
                        <div style="margin: 80px 0px 0px 0px;text-align: center;">
                            <button type="submit" class="btn btn-success" name="consultar" id="consultar">CONSULTAR</button>
                        </div>
                    </div>

                    <!-- SECCION TARGETA DE PERFIL -->
                    <div class="col-md-2">
                        <?php if (isset($showSections) && $showSections) : ?> <!-- Comprueba si se debe mostrar la sección -->
                            <div class="card mb-3 <?php echo 'empresa' . $empresaOption; ?>">
                                <div class="row g-0 background-container">
                                    <?php if (!empty($backgroundImage)) : ?> <!-- Comprueba si hay una imagen de fondo definida -->
                                        <div class="background-image" style="background-image: url('../../assets/image/<?php echo $backgroundImage; ?>');"></div>
                                    <?php endif; ?>
                                    <div class="col-md-4">
                                        <!-- <img src="../../assets/image/perfil.png" class="img-fluid rounded-start" alt="..."> -->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <?php foreach ($arr as $row) {
                                                    $nombreCompleto = $row['NOMBRE'] . ' ' . $row['NOMBRE2'] . ' ' . $row['APELLIDO'] . ' ' . $row['APELLIDO2'];
                                                    $primernombre = $row['NOMBRE'];
                                                    $segundonombre = $row['NOMBRE2'];
                                                    $primerapellido = $row['APELLIDO'];
                                                    $segundoapellido = $row['APELLIDO2'];
                                                    $cedula = $row['CEDULA'];
                                                    $cargo = $row['CARGO'];

                                                    // Agrega los valores como valores de entrada ocultos
                                                    echo '<input type="hidden" name="primernombre" value="' . htmlspecialchars($primernombre) . '">';
                                                    echo '<input type="hidden" name="segundonombre" value="' . htmlspecialchars($segundonombre) . '">';
                                                    echo '<input type="hidden" name="primerapellido" value="' . htmlspecialchars($primerapellido) . '">';
                                                    echo '<input type="hidden" name="segundoapellido" value="' . htmlspecialchars($segundoapellido) . '">';
                                                    echo '<input type="hidden" name="cedula" value=" id="cedula"' . htmlspecialchars($cedula) . '">';
                                                    echo '<input type="hidden" name="cargo" value="' . htmlspecialchars($cargo) . '">';

                                                    // Muestra los valores en el card-body si lo deseas
                                                    echo '<h6 class="card-title"><strong>' . $nombreCompleto . '</strong></h6>';
                                                    echo '<p class=""><strong>Cedula: ' . $cedula . '</strong></p>';
                                                    echo '<p class=""><strong>Cargo: ' . $cargo . '</strong></p>';
                                                } ?>
                                                <input type="hidden" name="empresaOption" id="empresaOption" value="<?php echo $empresaOption ?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
                </div>

            </form>

            <!-- DEPENDIENDO SI HAY INFORMACION DE USUARIO, EL SISTEMA MOSTRARA LOS DATOS SI NO PUES PERMANECERAN OCULTOS  -->
            <?php
            if (isset($showSections)) {
            ?>





            <?php
            }
            ?>
        </section>







    </body>




    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const nombreInput = document.getElementById("nombre");
        const suggestionsSelect = document.getElementById("suggestions");
        const suggestionsContainer = document.getElementById("suggestions-container");
        const cedulaInput = document.getElementById("CEDULA");

        nombreInput.addEventListener("input", function() {
            const inputValue = nombreInput.value.trim(); // Elimina espacios en blanco al principio y al final

            if (inputValue.length >= 3) {
                console.log("Haciendo petición AJAX...");
                const xhr = new XMLHttpRequest();
                xhr.open("GET", `autocomplete3.php?inputValue=${inputValue}`, true);

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


    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>