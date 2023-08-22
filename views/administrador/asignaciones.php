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



            <!-- SELECT EMPRESA / CEDULA Y FICHA TECNICA -->
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
                                                    <?php
                                                    foreach ($arr as $row) {
                                                        $nombreCompleto = $row['NOMBRE'] . ' ' . $row['NOMBRE2'] . ' ' . $row['APELLIDO'] . ' ' . $row['APELLIDO2'];
                                                        $cedula = $row['CEDULA'];
                                                        $cargo = $row['CARGO'];

                                                        echo '<h6 class="card-title"><strong>' . $nombreCompleto . '</strong></h6>';
                                                        echo '<p class=""><strong>Cedula: ' . $cedula . '</strong></p>';
                                                        echo '<p class=""><strong>Cargo: ' . $cargo . '</strong></p>';
                                                    }
                                                    ?>
                                                    <input type="text" name="empresaOption" id="empresaOption" value=<?php echo $empresaOption ?>></input>
                                                    
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


                <!-- AQUI MUESTRA LAS SECCION  COMPUTADOR -->
                <div class="container " style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-3 ">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" name="selecciondelcomputador">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Cumputador</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1" style="display: none;">
                            <!-- CONSULTA POR MEDIO DE CHECKS -->
                            <?php
                            include '../../conexionbd.php';
                            $consulta = "SELECT id, nombre_tipo_comp FROM [ControlTIC].[dbo].[tipo_comp]";
                            $resultado = odbc_exec($conexion, $consulta);
                            ?>

                            <form>
                                <?php
                                while ($fila = odbc_fetch_array($resultado)) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre_tipo_comp'];
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_comp" id="tipo_comp_<?php echo $id; ?>" value="<?php echo $id; ?>" onchange="updateTipoComputador(this)">
                                        <label class="form-check-label" for="tipo_comp_<?php echo $id; ?>">
                                            <?php echo $nombre; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="text" name="tipocomputador" id="tipocomputador" value="">

                            </form>
                        </div>

                        <div class="col-md-2" id="fila2" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcomputador">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-5" id="fila3" style="display: none;text-align: center;">

                            <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#verinfocomputador" aria-expanded="false" aria-controls="verinfocomputador">
                                VER INFORMACIÓN
                            </button>
                            </p>

                            <div class="collapse" id="verinfocomputador">
                                <div class="card card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="table-dark">
                                                <th scope="col">Tipo Caracteristica</th>
                                                <th scope="col">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody id="nombreEquipoDisplay">
                                            <!-- Aquí se insertarán las filas de la tabla con los datos -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="datosRecolectadosDialog" title="Datos Recolectados">
                                <!-- Aquí se mostrarán los datos recolectados -->
                            </div>


                        </div>

                    </div>
                </div>


                <button  class="btn btn-primary" name="asignar" id="asignar">Asignar</button>



            <?php
            }
            ?>
        </section>


        <!-- MODAL DE COMPUTADORES-->
        <div class="modal fade" id="modalcomputador" tabindex="-1" aria-labelledby="modalcomputadorLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcomputadorLabel">Listado de Equipos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </body>



    <!-- SCRIPT DE CHECKS COMPUTADOR -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckDefault').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1').show();
                } else {
                    $('#fila1').hide();
                    $('#fila2').hide();
                    $('#fila3').hide();
                }
            });

            $('input[name="tipo_comp"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2').show();
                } else {
                    $('#fila2').hide();
                }
            });

            $('#fila2 button').on('click', function() {
                $('#fila3').show();
            });
        });
    </script>


    <script>
        function updateTipoComputador(radio) {
            document.getElementById('tipocomputador').value = radio.value;
        }
    </script>


    <!-- AJAX DE CHECK LISTADO COMPUTADORES -->
    <script>
        $(document).ready(function() {
            $('#fila2 button').on('click', function() {
                var tipocomputador = $('#tipocomputador').val(); // Obtén el valor del campo oculto
                var empresaOption = $('#empresaOption').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultas/consultacomputador.php', // Cambia esto a la ruta correcta
                    type: 'POST',
                    data: {
                        tipocomputador: tipocomputador,
                        empresaOption: empresaOption
                    },
                    success: function(response) {
                        $('#modalcomputador .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            $('#saveChangesModalButton').on('click', function() {
                var selectedRowData = $('input[name="flexRadioDefault"]:checked').closest('tr').find('td:not(:last-child)');

                $('#nombreEquipoDisplay').empty(); // Limpiar la tabla antes de agregar nuevos datos

                selectedRowData.each(function(index) {
                    var fieldName = $(this).closest('table').find('thead th:eq(' + index + ')').text();
                    var fieldValue = $(this).text();

                    $('#nombreEquipoDisplay').append('<tr><td>' + fieldName + '</td><td>' + fieldValue + '</td></tr>');
                });
                $('#fila3').show();
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#asignar').on('click', function() {
                var selectedRowData = $('input[name="flexRadioDefault"]:checked')
                    .closest('tr')
                    .find('td:not(:last-child)');

                var dataToInsert = {};

                selectedRowData.each(function(index) {
                    var fieldName = $(this)
                        .closest('table')
                        .find('thead th:eq(' + index + ')')
                        .text();
                    var fieldValue = $(this).text();

                    dataToInsert[fieldName] = fieldValue;
                });

                $.ajax({
                    url: 'consultas/insertar_en_bd.php', // Cambia esto a la ruta correcta del script que manejará la inserción
                    type: 'POST',
                    data: dataToInsert,
                    success: function(response) {
                        // Mostrar los datos recolectados en un cuadro de diálogo
                        $('#datosRecolectadosDialog').html('<p>Datos recolectados:</p><pre>' + JSON.stringify(dataToInsert, null, 2) + '</pre>');
                        $('#datosRecolectadosDialog').dialog({
                            resizable: false,
                            height: 'auto',
                            width: 400,
                            modal: true,
                            buttons: {
                                'Aceptar': function() {
                                    $(this).dialog('close');
                                }
                            }
                        });

                        // Mostrar un mensaje de éxito
                        alert('Datos insertados correctamente.');
                    }
                });
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