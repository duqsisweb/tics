<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
error_reporting(0);

include '../../../conexionbd.php';
if (isset($_SESSION['usuario'])) {
    require '../../../function/funciones.php';

    // Inicializar la variable de bandera
    $mostrarTabla = false;

    // Definir una variable para almacenar los resultados
    $datosEquipos = [];

    if (isset($_POST['consultar'])) {
        // Obtener el valor ingresado en el campo Nombre_equipo
        $nombreEquipo = $_POST['Nombre_equipo'];
        // Llamar a la función con el parámetro de búsqueda
        $datosEquipos = hvcomputadorcab($conexion, $nombreEquipo);

        // Si se encontraron resultados, configurar la bandera en true
        if (!empty($datosEquipos)) {
            $mostrarTabla = true;
        }
    }
?>

    <style>
        .hidden-cell {
            display: none;
        }
    </style>

    <!DOCTYPE html>
    <html lang="en">



    <!-- HEAD -->
    <?php require '../estilosadmin/head.php'; ?>

    <body>

        <!-- NAV -->
        <?php require '../estilosadmin/nav.php'; ?>

        <section style="margin-top: 100px;">
            <!--  -->
            <?php require '../estilosadmin/navinventario.php'; ?>

            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container">
                    <div>
                        <h3>HV DE COMPUTADORES</h3>
                    </div>
                </div>
            </div>

        </section>



        <div class="container" style="text-align: center;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="POST">
                        <input class="form-control" type="text" name="Nombre_equipo" style="width: 100%;" id="Nombre_equipo" placeholder="INGRESE NOMBRE EQUIPO" required>

                        <h5 style="text-align: center;"></h5>
                        <input type="submit" class="btn btn-success" name='consultar' value="Consultar" id="btncolor" autocomplete="off">

                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div>
            <br>
        </div>

        <!-- 1 TABLA CABECERA-->
        <div>
            <!-- 1 TABLA -->
            <?php
            // Verificar si se debe mostrar la tabla o el mensaje
            if ($mostrarTabla) {
                // Mostrar la tabla y los resultados
            ?>
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="" cellspacing="0" style="text-align: center;">
                    <thead style="background-color: #004438;">
                        <tr class="encabezado table-dark">
                            <th>ID MAQUINA</th>
                            <th>TIPO DE MAQUINA</th>
                            <th>SERVICE TAG</th>
                            <th>SERIAL EQUIPO</th>
                            <th>NOMBRE EQUIPO</th>
                            <th>SEDE</th>
                            <th>EMPRESA</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>TIPO</th>
                            <th>TIPO RAM</th>
                            <th>CANTIDAD RAM</th>
                            <th>TIPO DISCO</th>
                            <th>CAPACIDAD DISCO</th>
                            <th>PROCESADOR</th>
                            <th>PROPIETARIO</th>
                            <th>PROVEEDOR</th>
                            <th>SISTEMA OPERATIVO</th>
                            <th>SERIAL CARGADOR</th>
                            <th>DOMINIO</th>
                            <th>TIPO USUARIO</th>
                            <th>SERIAL ACTIVO FIJO</th>
                            <th>FECHA DE INGRESO</th>
                            <th>TARGETA VIDEO</th>
                            <th>ESTADO</th>
                            <th>GESTION</th>
                            <th>FECHA DE GARANTIA</th>
                            <th>INICIO FECHA DE MANTENIMIENTO</th>
                            <th>FIN FECHA DE MANTENIMIENTO</th>
                            <th>DIAS RESTANTES DE MANTENIMIENTO</th>
                            <th>OBSERVACIONES DE ULTIMO MANTENIMIENTO PREVENTIVO</th>
                            <th>OBSERVACIONES DE ULTIMO MANTENIMIENTO CORRECTIVO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>USUARIO</th>
                            <th>FECHA MOVIMIENTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['consultar'])) {
                            // Obtener el valor ingresado en el campo Nombre_equipo
                            $nombreEquipo = $_POST['Nombre_equipo'];
                            // Llamar a la función con el parámetro de búsqueda
                            $datosEquipos = hvcomputadorcab($conexion, $nombreEquipo);
                            foreach ($datosEquipos as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['tipo_maquina'] . "</td>";
                                echo "<td>" . $row['Service_tag'] . "</td>";
                                echo "<td>" . $row['Serial_equipo'] . "</td>";
                                echo "<td>" . $row['Nombre_equipo'] . "</td>";
                                echo "<td>" . $row['Sede'] . "</td>";
                                echo "<td>" . $row['Empresa'] . "</td>";
                                echo "<td>" . $row['Marca_computador'] . "</td>";
                                echo "<td>" . $row['Modelo_computador'] . "</td>";
                                echo "<td>" . $row['Tipo_comp'] . "</td>";
                                echo "<td>" . $row['tipo_memoria_ram'] . "</td>";
                                echo "<td>" . $row['capacidad_ram'] . "</td>";
                                echo "<td>" . $row['Tipo_discoduro'] . "</td>";
                                echo "<td>" . $row['Capacidad_discoduro'] . "</td>";
                                echo "<td>" . $row['Procesador'] . "</td>";
                                echo "<td>" . $row['Propietario'] . "</td>";
                                echo "<td>" . $row['Proveedor'] . "</td>";
                                echo "<td>" . $row['Sistema_Operativo'] . "</td>";
                                echo "<td>" . $row['Serial_cargador'] . "</td>";
                                echo "<td>" . $row['Dominio'] . "</td>";
                                echo "<td>" . $row['Tipo_usuario'] . "</td>";
                                echo "<td>" . $row['Serial_activo_fijo'] . "</td>";
                                echo "<td>" . $row['Fecha_ingreso_c'] . "</td>";
                                echo "<td>" . $row['Targeta_Video'] . "</td>";
                                echo "<td>" . $row['Estado'] . "</td>";
                                echo "<td>" . $row['Gestion'] . "</td>";
                                echo "<td>" . $row['Fecha_garantia_c'] . "</td>";
                                echo "<td>" . $row['Fecha_mantenimiento_inicio'] . "</td>";
                                echo "<td>" . $row['Fecha_mantenimiento_fin'] . "</td>";
                                echo "<td>" . $row['dias_restantes_mantenimiento'] . "</td>";
                                echo "<td>" . $row['observaciones_mantenimiento'] . "</td>";
                                echo "<td>" . $row['observaciones_mantenimiento_c'] . "</td>";
                                echo "<td class='hidden-cell'>" . $row['descripcionmov'] . "</td>";
                                echo "<td><button type='button' class='btn btn-success view-button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-row-id='" . $row['id'] . "'>Ver</button></td>";
                                echo "<td>" . $row['usuamov'] . "</td>";
                                echo "<td>" . $row['fechamov'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>

            <?php
            } else {
                // Mostrar un mensaje si no hay resultados
                echo "<div style='text-align: center;'></div>";
            }
            ?>

        </div>

        <!-- 2 TABLA -->
        <div>
            <?php
            if ($mostrarTabla) {
            ?>
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                    <thead style="background-color: #004438;">
                        <tr class="encabezado table-dark">
                            <th>ID HISTORIAL</th>
                            <th>ID MAQUINA</th>
                            <th>TIPO DE MAQUINA</th>
                            <th>SERVICE TAG</th>
                            <th>SERIAL EQUIPO</th>
                            <th>NOMBRE EQUIPO</th>
                            <th>SEDE</th>
                            <th>EMPRESA</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>TIPO</th>
                            <th>TIPO RAM</th>
                            <th>CANTIDAD RAM</th>
                            <th>TIPO DISCO</th>
                            <th>CAPACIDAD DISCO</th>
                            <th>PROCESADOR</th>
                            <th>PROPIETARIO</th>
                            <th>PROVEEDOR</th>
                            <th>SISTEMA OPERATIVO</th>
                            <th>SERIAL CARGADOR</th>
                            <th>DOMINIO</th>
                            <th>TIPO USUARIO</th>
                            <th>SERIAL ACTIVO FIJO</th>
                            <th>FECHA DE INGRESO</th>
                            <th>TARGETA VIDEO</th>
                            <th>ESTADO</th>
                            <th>ESTADO GESTION</th>
                            <th>FECHA DE GARANTIA</th>
                            <th>CEDULA</th>
                            <th>CARGO</th>
                            <th>PRIMER NOMBRE EMPELADO</th>
                            <th>SEGUNDO NOMBRE EMPLEADO</th>
                            <th>PRIMER APELLIDO EMPLEADO</th>
                            <th>SEGUNDO APELLIDO EMPLEADO</th>
                            <th>LINK DRIVE DE ASIGNACION</th>
                            <th class="hidden-cell">OBSERVACIONES DE ASIGNACION DEL EQUIPO</th>
                            <th>OBSERVACIONES DE ASIGNACION</th>
                            <th class="hidden-cell">OBSERVACIONES RETIRO</th>
                            <th>OBSERVACIONES DE RETIRO</th>
                            <th>LINK DRIVE DE RETIRO</th>
                            <th>FECHA INICIO MANTENIMIENTO</th>
                            <th>FECHA MANTENIMIENTO FINAL</th>
                            <th>DIAS RESTANTES DE MANTENIMIENTO</th>
                            <th>OBSERVACIONES MANTENIMIENTO</th>
                            <th class="hidden-cell">OBSERVACIONES MANTENIMIENTO</th>
                            <th>OBSERVACIONES MANTENIMIENTO CORRECTIVO</th>
                            <th>MOVIMIENTO</th>
                            <th>FECHA MOVIMIENTO</th>
                            <th>USUARIO
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['consultar'])) {
                            // Obtener el valor ingresado en el campo Nombre_equipo
                            $nombreEquipo = $_POST['Nombre_equipo'];
                            // Llamar a la función con el parámetro de búsqueda
                            $datosEquipos = hvcomputador($conexion, $nombreEquipo);
                            foreach ($datosEquipos as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['id_historial'] . "</td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['tipo_maquina'] . "</td>";
                                echo "<td>" . $row['Service_tag'] . "</td>";
                                echo "<td>" . $row['Serial_equipo'] . "</td>";
                                echo "<td>" . $row['Nombre_equipo'] . "</td>";
                                echo "<td>" . $row['Sede'] . "</td>";
                                echo "<td>" . $row['Empresa'] . "</td>";
                                echo "<td>" . $row['Marca_computador'] . "</td>";
                                echo "<td>" . $row['Modelo_computador'] . "</td>";
                                echo "<td>" . $row['Tipo_comp'] . "</td>";
                                echo "<td>" . $row['Tipo_ram'] . "</td>";
                                echo "<td>" . $row['Memoria_ram'] . "</td>";
                                echo "<td>" . $row['Tipo_discoduro'] . "</td>";
                                echo "<td>" . $row['Capacidad_discoduro'] . "</td>";
                                echo "<td>" . $row['Procesador'] . "</td>";
                                echo "<td>" . $row['Propietario'] . "</td>";
                                echo "<td>" . $row['Proveedor'] . "</td>";
                                echo "<td>" . $row['Sistema_Operativo'] . "</td>";
                                echo "<td>" . $row['Serial_cargador'] . "</td>";
                                echo "<td>" . $row['Dominio'] . "</td>";
                                echo "<td>" . $row['Tipo_usuario'] . "</td>";
                                echo "<td>" . $row['Serial_activo_fijo'] . "</td>";
                                echo "<td>" . $row['Fecha_ingreso_c'] . "</td>";
                                echo "<td>" . $row['Targeta_Video'] . "</td>";
                                echo "<td>" . $row['Estado'] . "</td>";
                                echo "<td>" . $row['Gestion'] . "</td>";
                                echo "<td>" . $row['Fecha_garantia_c'] . "</td>";
                                echo "<td>" . $row['cedula'] . "</td>";
                                echo "<td>" . $row['cargo'] . "</td>";
                                echo "<td>" . $row['primernombre'] . "</td>";
                                echo "<td>" . $row['segundonombre'] . "</td>";
                                echo "<td>" . $row['primerapellido'] . "</td>";
                                echo "<td>" . $row['segundoapellido'] . "</td>";
                                echo "<td>  <a target='_blank' href='" . $row['link_computador_asigna'] . "'>" . $row['link_computador_asigna'] . "</a></td>";
                                echo "<td   class='hidden-cell'>" . $row['observaciones_asigna'] . "</td>";
                                echo "<td>  <button type='button' class='btn btn-success view-button2' data-bs-toggle='modal' data-bs-target='#exampleModal2' data-row-id='" . $row['id'] . "'>Ver Información</button></td>";
                                echo "<td   class='hidden-cell'>" . $row['observaciones_desasigna'] . "</td>";
                                echo "<td>  <button type='button' class='btn btn-success view-button3' data-bs-toggle='modal' data-bs-target='#exampleModal3' data-row-id='" . $row['id'] . "'>Ver Información</button></td>";
                                echo "<td>   <a target='_blank' href='" . $row['link_computador_desasigna'] . "'>" . $row['link_computador_desasigna'] . "</a></td>";
                                echo "<td>" . $row['Fecha_mantenimiento_inicio'] . "</td>";
                                echo "<td>" . $row['Fecha_mantenimiento_fin'] . "</td>";
                                echo "<td>" . $row['dias_restantes_mantenimiento'] . "</td>";
                                echo "<td   class='hidden-cell'>" . $row['observaciones_mantenimiento'] . "</td>";
                                echo "<td>  <button type='button' class='btn btn-success view-button4' data-bs-toggle='modal' data-bs-target='#exampleModal4' data-row-id='" . $row['id'] . "'>Ver Información</button></td>";
                                echo "<td>" . $row['observaciones_mantenimiento_c'] . "</td>";
                                echo "<td>" . $row['descripcionmov'] . "</td>";
                                echo "<td>" . $row['fechamov'] . "</td>";
                                echo "<td>" . $row['usuamov'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                // Mostrar un mensaje si no hay resultados
                echo "<div style='text-align: center;'></div>";
            }
            ?>

        </div>


        <!-- MODAL DE CABECERA  -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Descripción</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content">
                            <!-- Aquí se mostrará la información dinámicamente -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE OBSERVACIONES DE ASIGNACION -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal2Label">OBSERVACIONES DE ASIGNACIÓN DEL EQUIPO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content2">
                            <!-- Aquí se mostrará la información dinámicamente -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE OBSERVACIONES DE RETIRO -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal2Label">OBSERVACIONES DE RETIRO DE EQUIPO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content3">
                            <!-- Aquí se mostrará la información dinámicamente -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE OBSERVACIONES DE MANTENIMIENTO PREVENTIVO -->
        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModal4Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal4Label">OBSERVACIONES DE MANTENIMIENTO PREVENTIVO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content4">
                            <!-- Aquí se mostrará la información dinámicamente -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SCRIPT DE OBSERVACIONES DE CABECERA -->
        <script>
            $(document).ready(function() {
                // Manejar el clic en los botones "Ver Detalles"
                $('.view-button').click(function() {
                    var rowId = $(this).data('row-id'); // Obtener el ID de la fila
                    var description = $("td:eq(32)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

                    // Actualizar el contenido del modal con la descripción
                    $('#modal-content').html(description);
                });
            });
        </script>

        <!-- SCRIPT DE OBSERVACIONES DE ASIGNACION -->
        <script>
            $(document).ready(function() {
                // Manejar el clic en los botones "Ver Detalles"
                $('.view-button2').click(function() {
                    var rowId = $(this).data('row-id'); // Obtener el ID de la fila
                    var description = $("td:eq(35)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

                    // Actualizar el contenido del modal con la descripción
                    $('#modal-content2').html(description);
                });
            });
        </script>

        <!-- SCRIPT DE OBSERVACIONES DE RETIRO -->
        <script>
            $(document).ready(function() {
                // Manejar el clic en los botones "Ver Detalles"
                $('.view-button3').click(function() {
                    var rowId = $(this).data('row-id'); // Obtener el ID de la fila
                    var description = $("td:eq(37)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

                    // Actualizar el contenido del modal con la descripción
                    $('#modal-content3').html(description);
                });
            });
        </script>

        <!-- SCRIPT DE OBSERVACIONES DE MANTENIMIENTO PREVENTIVO -->
        <script>
            $(document).ready(function() {
                // Manejar el clic en los botones "Ver Detalles"
                $('.view-button4').click(function() {
                    var rowId = $(this).data('row-id'); // Obtener el ID de la fila
                    var description = $("td:eq(43)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

                    // Actualizar el contenido del modal con la descripción
                    $('#modal-content4').html(description);
                });
            });
        </script>


    </body>

    </html>

    <!-- Inicio DataTable -->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtable').DataTable({
                info: false,
                select: true,
                destroy: true,
                jQueryUI: true,
                paginate: true,
                iDisplayLength: 30,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                    // 'copy', 'csv', 'excel'
                ],
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros por página.',
                    zeroRecords: 'Lo sentimos. No se encontraron registros.',
                    info: 'Mostrando: _START_ de _END_ - Total registros: _TOTAL_',
                    infoEmpty: 'No hay registros aún.',
                    infoFiltered: '(filtrados de un total de _MAX_ registros)',
                    search: 'Búsqueda',
                    LoadingRecords: 'Cargando ...',
                    Processing: 'Procesando...',
                    SearchPlaceholder: 'Comience a teclear...',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente',
                    }
                }
            });
        });
    </script>
    <!-- Fin DataTable -->

<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>