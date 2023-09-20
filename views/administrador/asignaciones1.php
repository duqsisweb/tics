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

    <!-- Asegúrate de cargar jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
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
        </style>



        <section style="margin-top: 100px;">


            <!--  -->
            <?php require '../../views/navasignaciones.php'; ?>


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

                <!-- AQUI MUESTRA LAS SECCION  CELULAR -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCelular" value="2" name="selecciondelcelular">
                                <label class="form-check-label" for="flexSwitchCheckCelular">Celulares</label>
                            </div>
                        </div>

                        <div class="col-md-2" id="fila1celular" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2celular" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcelular">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3celular" style="display: none; font-family: 'Courier New', monospace;"></div>

                        <div class="col-md-2" id="fila4celular" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalcelularinformacion">Ver información</button>
                        </div>
                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  ACCESORIOS -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckAccesorios" value="1" name="selecciondelaccesorio">
                                <label class="form-check-label" for="flexSwitchCheckAccesorios">Accesorios</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1accesorios" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2accesorios" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalaccesorios">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3accesorios" style="display: none; font-family: 'Courier New', monospace;"></div>

                        <div class="col-md-2" id="fila4accesorios" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalcelularinformacion">Ver información</button>
                        </div>

                    </div>
                </div>

            <?php
            }
            ?>
        </section>



        <!-- MODAL DE CELULARES -->
        <div class="modal fade" id="modalcelular" tabindex="-1" aria-labelledby="modalcelularLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcelularLabel">
                            <h6>Equipo Celular para el Cargo: <?php echo $cargo ?></h6>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE CELULARES VER INFORMACION -->
        <div class="modal fade" id="modalcelularinformacion" tabindex="-1" aria-labelledby="modalcelularinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcelularinformacionLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE ACCESORIOS-->
        <div class="modal fade" id="modalaccesorios" tabindex="-1" aria-labelledby="modalaccesoriosLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalaccesoriosLabel">
                            <h6>Accesorios para el Cargo: <?php echo $cargo ?></h6>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        1
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        


        <!-- enviar el nombre como parametro para asignacion -->
        <strong id="Usua_asigna" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>
        <!-- enviar el nombre como parametro para remover asignacion  -->
        <strong id="Usua_retira" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>

    </body>


    <script>
        function updateTipoComputador(radio) {
            document.getElementById('tipocomputador').value = radio.value;
        }

        function updateDescripcionedcomunicacion(radio) {
            document.getElementById('tipo_edcomunicacion').value = radio.value;
        }

        function updateDescripcionperifericos(radio) {
            document.getElementById('tipo_perifericos').value = radio.value;
        }

        function updateDescripcionalmacenamiento(radio) {
            document.getElementById('tipo_almacenamiento').value = radio.value;
        }

        function updateDescripcionsimcard(radio) {
            document.getElementById('tipo_simcard').value = radio.value;
        }

        function updateDescripciondvr(radio) {
            document.getElementById('tipo_dvr').value = radio.value;
        }

        function updateDescripcioncctv(radio) {
            document.getElementById('tipo_cctv').value = radio.value;
        }

        function updateDescripciontorre(radio) {
            document.getElementById('tipo_torre').value = radio.value;
        }
    </script>

    <!-- SCRIPT DE CHECKS CELULARES -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckCelular').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1celular').show();
                    $('#fila2celular').show();
                    $('#fila3celular').show();
                    $('#fila4celular').show();
                } else {
                    $('#fila1celular').hide();
                    $('#fila2celular').hide();
                    $('#fila3celular').hide();
                    $('#fila4celular').hide();
                }
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS ACCESORIOS -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckAccesorios').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1accesorios').show();
                    $('#fila2accesorios').show();
                    $('#fila3accesorios').show();
                    $('#fila4accesorios').show();
                } else {
                    $('#fila1accesorios').hide();
                    $('#fila2accesorios').hide();
                    $('#fila3accesorios').hide();
                    $('#fila4accesorios').hide();
                }
            });
        });
    </script>



    <!-- AJAX PARA CONSULTA DE CELULARES -->
    <script>
        $(document).ready(function() {
            $('#fila4celular button').on('click', function() {
                var tipocomputador = $('#tipocomputador').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'informacion/consultacelularinformacion.php',
                    type: 'POST',
                    data: {
                        tipocomputador: tipocomputador,
                        empresa: empresaOption,

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalcelularinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });
            });
        });

        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $.ajax({

            url: 'consultas/consultacelular.php',
            type: 'POST',
            data: {
                empresa: empresaOptionValue,
                primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",
                cedula: "<?php echo htmlspecialchars($cedula); ?>",
                cargo: "<?php echo htmlspecialchars($cargo); ?>",

            },
            success: function(response) {
                $('#modalcelular .modal-body').html(response); // Agrega los resultados al cuerpo del modal
            }
        });
    </script>

    <!-- AJAX PARA CONSULTA DE ACCESORIOS -->
    <script>
        $(document).ready(function() {
            $('#fila4accesorios button').on('click', function() {
                var tipocomputador = $('#tipocomputador').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                // $.ajax({
                //     url: 'informacion/consultaaccesoriosinformacion.php',
                //     type: 'POST',
                //     data: {
                //         tipocomputador: tipocomputador,
                //         empresa: empresaOption,

                //         primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                //         segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                //         primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                //         segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                //         cedula: "<?php echo htmlspecialchars($cedula); ?>",
                //         cargo: "<?php echo htmlspecialchars($cargo); ?>"
                //     },
                //     success: function(response) {
                //         $('#modalaccesoriosinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                //     }
                // });
            });
        });

        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $.ajax({

            url: 'consultas/consultaaccesorios.php',
            type: 'POST',
            data: {
                empresa: empresaOptionValue,
                primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",
                cedula: "<?php echo htmlspecialchars($cedula); ?>",
                cargo: "<?php echo htmlspecialchars($cargo); ?>",

            },
            success: function(response) {
                $('#modalaccesorios .modal-body').html(response); // Agrega los resultados al cuerpo del modal
            }
        });
    </script>




    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN CELULAR-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckCelular').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3celular').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3celular();
                } else {
                    $('#fila3celular').hide();
                }
            });
            $('#fila2celular button').on('click', function() {
                $('#fila3celular').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3celular();
            });
        });

        function actualizarFila3celular() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichacelular.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3celular').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>

    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN ACCESORIOS-->
    <!-- <script>
        $(document).ready(function() {
            $('#flexSwitchCheckAccesorios').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3accesorios').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3accesorios();
                } else {
                    $('#fila3accesorios').hide();
                }
            });
            $('#fila2accesorios button').on('click', function() {
                $('#fila3accesorios').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3accesorios();
            });
        });

        function actualizarFila3accesorios() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: '', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3accesorios').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script> -->





    <script>
        document.getElementById('asisteInput').addEventListener('input', function() {
            var selectedValue = this.value;
            var cedulaIndex = selectedValue.lastIndexOf('-'); // Índice del último guión
            if (cedulaIndex !== -1) {
                this.value = selectedValue.substring(cedulaIndex + 1).trim(); // Eliminar espacio adicional antes de la cédula
            }
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

    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>