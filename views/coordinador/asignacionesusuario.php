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

        /* BNT ESTILO ZOMM */
        .btn.zoom-on-hover {
            transition: transform 0.3s ease-in-out;
        }

        .btn.zoom-on-hover:hover {
            transform: scale(1.1);
        }
    </style>


    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
        ?>

        <section style="margin-top: 100px;">

            <!-- NAV -->
            <?php
            require '../../views/navasignaciones.php';
            ?>


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


            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container" style="text-align: center;">
                    <div>
                        <h3>EQUIPOS ASIGNADOS A USUARIOS</h3>
                    </div>
                </div>
            </div>



            <!-- SELECT CAPOS EMPRESA / CEDULA Y FICHA TECNICA -->
            <form method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3" style="margin: 50px 0px 0px 0px;">
                            <label class="form-label">Empresa</label>
                            <select id="empresaSelect" name="empresa" class="form-select" aria-label="Default select example" required>
                                <option selected disabled>SELECCIONE EMPRESA</option>
                                <option value="1">Duquesa S.A. BIC</option>
                                <option value="2">Palmeras del Llano S.A. BIC</option>
                                <option value="3">J25</option>
                            </select>
                        </div>

                        <div class="col-md-2" style="margin: 50px 0px 0px 0px;display: none;">
                            <label class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identificacionInput" placeholder="" name="CEDULA" pattern="[0-9]+" required>
                        </div>

                        <div class="col-md-2" style="margin: 50px 0px 0px 0px;">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input list="asiste" class="form-control" type="text" id="nombreInput" name="asiste" required>
                                <datalist id="asiste">
                                    <?php
                                    include '../../../conexionbd.php';
                                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                                    $result = odbc_exec($conexion, $query);

                                    while ($admon = odbc_fetch_array($result)) {
                                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                                        echo '<option value="' . trim($admon['CEDULA']) . '">' . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . '</option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div style="margin: 80px 0px 0px 0px;text-align: center;">
                                <button type="submit" class="btn btn-success" name="consultar" id="consultar">CONSULTAR</button>
                            </div>
                        </div>

                        <!-- SECCION TARGETA DE PERFIL -->
                        <div class="col-md-5">
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
                if (isset($showSections) && $showSections) {
                ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4" id="fila1" style="display: none; text-align: center; "></div>
                            <div class="col-md-4" id="fila2" style="display: none; text-align: center; "></div>
                            <div class="col-md-4" id="fila3" style="display: none; text-align: center; "></div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-md-4" id="fila4" style="display: none; text-align: center; "></div>
                            <div class="col-md-4" id="fila5" style="display: none; text-align: center; "></div>
                            <div class="col-md-4" id="fila6" style="display: none; text-align: center; "></div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4" id="fila7" style="display: none; text-align: center; "></div>
                            <div class="col-md-4" id="fila8" style="display: none; text-align: center; "></div>
                            <div class="col-md-4" id="fila9" style="display: none; text-align: center; "></div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4" id="fila10" style="display: none; text-align: center; "></div>

                        </div>
                    </div>



                    <div style="text-align: center;">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning zoom-on-hover" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Generar Acta
                        </button>


                    </div>


                <?php
                }
                ?>


            <?php
            }
            ?>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Acta</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <!-- .... -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


    </body>





    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            // Obtén la cédula y el cargo del PHP
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            var cargo = '<?php echo $cargo; ?>'; // Obtener el cargo del PHP
            var nombreCompleto = '<?php echo $nombreCompleto; ?>'; // Obtener el nombre completo del PHP
            var empresaOption = $('#empresaOption').val();
            var empresaOptionValue = "<?php echo $empresaOption; ?>";


            // Realiza la solicitud AJAX aquí
            $.ajax({
                url: 'acta2.php',
                method: 'GET',
                data: {
                    cedula: cedula,
                    cargo: cargo,
                    nombreCompleto: nombreCompleto,
                    empresa: empresaOptionValue
                }, // Envía la cédula, el cargo y el nombre completo como parámetros
                // dataType: 'html',
                success: function(response) {
                    $('#exampleModal .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX');
                    console.error('Estado:', status);
                    console.error('Error:', error);
                }
            });
        });
    </script>



    <script>
        // Asegúrate de que jsPDF se haya cargado antes de ejecutar este código
        $(document).ready(function() {
            $('#exampleModal').on('show.bs.modal', function(event) {
                // ... (código previo)

                // Manejador para el botón de descarga en el modal
                $('#descargarPDF').click(function() {
                    // Obtén el contenido del modal
                    var modalContent = $('#ajax-result').html();

                    // Crea un nuevo documento PDF
                    var doc = new jsPDF();

                    // Agrega el contenido del modal al documento PDF
                    doc.fromHTML(modalContent, 15, 15);

                    // Descarga el archivo PDF
                    doc.save('acta.pdf');
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const asisteInput = document.getElementById('nombreInput');
            const identificacionInput = document.getElementById('identificacionInput');
            const asisteDatalist = document.getElementById('asiste');

            asisteInput.addEventListener('change', function() {
                const selectedOption = asisteDatalist.querySelector(`option[value="${asisteInput.value}"]`);
                if (selectedOption) {
                    const cedula = selectedOption.textContent.split(' - ')[1];
                    identificacionInput.value = cedula;
                } else {
                    identificacionInput.value = '';
                }
            });


            empresaSelect.addEventListener('change', function() {
                const selectedOptionValue = empresaSelect.value;
                asisteDatalist.innerHTML = ''; // Limpiar las opciones actuales

                if (selectedOptionValue === '1') {
                    // Consulta para Duquesa S.A. BIC
                    <?php
                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                    $result = odbc_exec($conexion, $query);

                    while ($admon = odbc_fetch_array($result)) {
                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                        echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                    }
                    ?>
                } else if (selectedOptionValue === '2') {
                    // Consulta para Palmeras del Llano S.A. BIC
                    <?php
                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM PALMERAS2013..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                    $result = odbc_exec($conexion2, $query);

                    while ($admon = odbc_fetch_array($result)) {
                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                        echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                    }
                    ?>
                } else if (selectedOptionValue === '3') {
                    // Consulta para Palmeras del Llano S.A. BIC
                    <?php
                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM J25..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                    $result = odbc_exec($conexion2, $query);

                    while ($admon = odbc_fetch_array($result)) {
                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                        echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                    }
                    ?>
                }

            });
        });
    </script>





    <!-- Script y AJAX asignación de COMPUTADOR -->
    <script>
        $(document).ready(function() {
            $('#fila1').show(); // Mostrar #fila3 al cargar la página
            actualizarFila3();

            function actualizarFila3() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichacomputador.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila1').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de CELULAR -->
    <script>
        $(document).ready(function() {
            $('#fila2').show(); // Mostrar #fila2 al cargar la página
            actualizarFila2();

            function actualizarFila2() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichacelular.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila2').html(response);
                    }
                });
            }
        });
    </script>

    <!-- Script y AJAX asignación de  ACCESORIOS -->
    <script>
        $(document).ready(function() {
            $('#fila3').show(); // Mostrar #fila2 al cargar la página
            actualizarFila3();

            function actualizarFila3() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichaaccesorios.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila3').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de EDCOMUNICACION -->
    <script>
        $(document).ready(function() {
            $('#fila4').show(); // Mostrar #fila4 al cargar la página
            actualizarFila4();

            function actualizarFila4() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichaedcomunicacion.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila4').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de PERIFERICOS -->
    <script>
        $(document).ready(function() {
            $('#fila5').show(); // Mostrar #fila4 al cargar la página
            actualizarFila5();

            function actualizarFila5() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichaperifericos.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila5').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de ALMACENAMIENTO -->
    <script>
        $(document).ready(function() {
            $('#fila6').show(); // Mostrar #fila4 al cargar la página
            actualizarFila6();

            function actualizarFila6() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichaalmacenamiento.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila6').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de SIMCARD -->
    <script>
        $(document).ready(function() {
            $('#fila7').show(); // Mostrar #fila4 al cargar la página
            actualizarFila7();

            function actualizarFila7() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichasimcard.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila7').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de DVR -->
    <script>
        $(document).ready(function() {
            $('#fila8').show(); // Mostrar #fila4 al cargar la página
            actualizarFila8();

            function actualizarFila8() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnicaasignaciones/actualizarfichadvr.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila8').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de DVR -->
    <script>
        $(document).ready(function() {
            $('#fila9').show(); // Mostrar #fila4 al cargar la página
            actualizarFila9();

            function actualizarFila9() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnica/actualizarfichacctv.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila9').html(response);
                    }
                });
            }
        });
    </script>
    <!-- Script y AJAX asignación de DVR -->
    <script>
        $(document).ready(function() {
            $('#fila10').show(); // Mostrar #fila4 al cargar la página
            actualizarFila10();

            function actualizarFila10() {
                var cedula = '<?php echo $cedula; ?>';
                $.ajax({
                    url: 'fichatecnica/actualizarfichatorre.php',
                    method: 'GET',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        $('#fila10').html(response);
                    }
                });
            }
        });
    </script>





    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>