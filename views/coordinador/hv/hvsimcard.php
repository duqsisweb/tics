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
        $numero_linea = $_POST['numero_linea'];
        // Llamar a la función con el parámetro de búsqueda
        $datosEquipos = hvsimcard($conexion, $numero_linea);

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
                        <h3>HV DE SIM CARD</h3>
                    </div>
                </div>
            </div>
        </section>



        <div class="container" style="text-align: center;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="POST">
                        <input class="form-control" type="text" name="numero_linea" style="width: 100%;" id="numero_linea" placeholder="INGRESE NUMERO DE LINEA" required autocomplete="off">

                        <h5 style="text-align: center;"></h5>
                        <input type="submit" class="btn btn-success" name='consultar' value="Consultar" id="btncolor">
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div>
            <br>
        </div>


        <!-- 1 TABLA -->
        <div>
            <?php
            if ($mostrarTabla) {

            ?>
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">
                            <th>ID</th>
                            <th>ELEMENTO</th>
                            <th>NUMERO DE LINEA</th>
                            <th>NOMBRE PLAN</th>
                            <th>FECHA APERTURA</th>
                            <th>VALOR PLAN</th>
                            <th>OPERADOR</th>
                            <th>COD CLIENTE</th>
                            <th>OBSERVACIONES</th>
                            <th>FECHA FIN PLAN</th>
                            <th>ESTADO</th>
                            <th>GESTION</th>
                            <th>DESCRIPCIÓN</th>
                            <th>FECHA MOVIMIENTO</th>
                            <th>USUARIO</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['consultar'])) {
                            // Obtener el valor ingresado en el campo Nombre_equipo
                            $numero_linea = $_POST['numero_linea'];
                            // Llamar a la función con el parámetro de búsqueda
                            $datosEquipos = hvsimcardcab($conexion, $numero_linea);
                            foreach ($datosEquipos as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['tipo_maquina'] . "</td>";
                                echo "<td>" . $row['numero_linea'] . "</td>";
                                echo "<td>" . $row['nombre_plan'] . "</td>";
                                echo "<td>" . $row['fecha_apertura'] . "</td>";
                                echo "<td>" . $row['valor_plan'] . "</td>";
                                echo "<td>" . $row['operador'] . "</td>";
                                echo "<td>" . $row['cod_cliente'] . "</td>";
                                echo "<td>" . $row['observaciones_sim'] . "</td>";
                                echo "<td>" . $row['fecha_fin_plan'] . "</td>";
                                echo "<td>" . $row['estado'] . "</td>";
                                echo "<td>" . $row['gestion'] . "</td>";
                                echo "<td class='hidden-cell'>" . $row['descripcionmov'] . "</td>";
                                echo "<td><button type='button' class='btn btn-success view-button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-row-id='" . $row['id'] . "'>Ver</button></td>";
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
                echo "<div style='text-align: center;'>No se encontraron resultados.</div>";
            }
            ?>
        </div>

        <!-- 2 TABLA -->
        <div>
            <?php
            if ($mostrarTabla) {

            ?>
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">
                            <th>ID</th>
                            <th>ID HISTORIAL</th>
                            <th>TIPO</th>
                            <th>NUMERO DE LINEA</th>
                            <th>NOMBRE PLAN</th>
                            <th>FECHA APERTURA</th>
                            <th>VALOR PLAN</th>
                            <th>OPERADOR</th>
                            <th>COD CLIENTE</th>
                            <th>OBSERVACIONES</th>
                            <th>FECHA FIN PLAN</th>
                            <th>ESTADO</th>
                            <th>GESTION</th>

                            <th>CEDULA</th>
                            <th>CARGO</th>
                            <th>PRIMER NOMBRE</th>
                            <th>SEGUNDO NOMBRE</th>
                            <th>PRIMER APELLIDO</th>
                            <th>SEGUNDO APELLIDO</th>

                            <th>LINK DRIVE DE ASIGNACION</th>
                            <th class="hidden-cell">OBSERVACIONES DE ASIGNACIÓN</th>
                            <th>OBSERVACIONES DE ASIGNACIÓN</th>
                            <th class="hidden-cell">OBSERVACIONES RETIRO</th>
                            <th>OBSERVACIONES DE RETIRO</th>
                            <th>LINK DRIVE DE RETIRO</th>

                            <th>DESCRIPCIÓN</th>
                            <th>FECHA MOVIMIENTO</th>
                            <th>USUARIO</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['consultar'])) {
                            // Obtener el valor ingresado en el campo Nombre_equipo
                            $numero_linea = $_POST['numero_linea'];
                            // Llamar a la función con el parámetro de búsqueda
                            $datosEquipos = hvsimcard($conexion, $numero_linea);
                            foreach ($datosEquipos as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['id_historial'] . "</td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['tipo_maquina'] . "</td>";
                                echo "<td>" . $row['numero_linea'] . "</td>";
                                echo "<td>" . $row['nombre_plan'] . "</td>";
                                echo "<td>" . $row['fecha_apertura'] . "</td>";
                                echo "<td>" . $row['valor_plan'] . "</td>";
                                echo "<td>" . $row['operador'] . "</td>";
                                echo "<td>" . $row['cod_cliente'] . "</td>";
                                echo "<td>" . $row['observaciones_sim'] . "</td>";
                                echo "<td>" . $row['fecha_fin_plan'] . "</td>";
                                echo "<td>" . $row['estado'] . "</td>";
                                echo "<td>" . $row['gestion'] . "</td>";

                                echo "<td>" . $row['cedula'] . "</td>";
                                echo "<td>" . $row['cargo'] . "</td>";
                                echo "<td>" . $row['primernombre'] . "</td>";
                                echo "<td>" . $row['segundonombre'] . "</td>";
                                echo "<td>" . $row['primerapellido'] . "</td>";
                                echo "<td>" . $row['segundoapellido'] . "</td>";


                                echo "<td>  <a target='_blank' href='" . $row['link_sim_asigna'] . "'>" . $row['link_sim_asigna'] . "</a></td>";

                                echo "<td   class='hidden-cell'>" . $row['observaciones_asigna_sim'] . "</td>";
                                echo "<td>  <button type='button' class='btn btn-success view-button2' data-bs-toggle='modal' data-bs-target='#exampleModal2' data-row-id='" . $row['observaciones_asigna_sim'] . "'>Ver Información</button></td>";
                                
                                echo "<td   class='hidden-cell'>" . $row['observaciones_desasigna_sim'] . "</td>";
                                echo "<td>  <button type='button' class='btn btn-success view-button3' data-bs-toggle='modal' data-bs-target='#exampleModal3' data-row-id='" . $row['observaciones_desasigna_sim'] . "'>Ver Información</button></td>";
                                
                                echo "<td>   <a target='_blank' href='" . $row['link_sim_desasigna'] . "'>" . $row['link_sim_desasigna'] . "</a></td>";

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
                echo "<div style='text-align: center;'>No se encontraron resultados.</div>";
            }
            ?>
        </div>


    </body>





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

    <!-- SCRIPT DE OBSERVACIONES DE CABECERA -->
    <script>
        $(document).ready(function() {
            // Manejar el clic en los botones "Ver Detalles"
            $('.view-button').click(function() {
                var rowId = $(this).data('row-id'); // Obtener el ID de la fila
                var description = $("td:eq(12)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

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
                var description = $("td:eq(20)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

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
                var description = $("td:eq(22)", $(this).closest("tr")).text(); // Obtener la descripción de la fila correspondiente

                // Actualizar el contenido del modal con la descripción
                $('#modal-content3').html(description);
            });
        });
    </script>



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