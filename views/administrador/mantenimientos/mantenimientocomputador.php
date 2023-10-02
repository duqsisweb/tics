<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
error_reporting(0);

include '../../../conexionbd.php';
if (isset($_SESSION['usuario'])) {
    require '../../../function/funciones.php';
?>

    <style>
        .hidden-cell {
            display: none;
        }

        .columnas {
            margin-top: 30px;
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
            <!-- NAVINGRESOS -->
            <?php require '../estilosadmin/navinventario.php'; ?>

            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container">
                    <div>
                        <h3>MANTENIMIENTO CORRECTIVO DE COMPUTADORES</h3>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                            <thead>
                                <tr class="encabezado table-dark">
                                    <th>ID</th>
                                    <th class="hidden-cell">Service Tag</th>
                                    <th>Serial Equipo</th>
                                    <th>Nombre Equipo</th>
                                    <th>Nombre Sede</th>
                                    <th>Nombre Empresa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Tipo Comp.</th>
                                    <th>Tipo Ram</th>
                                    <th>Ram</th>
                                    <th>Tipo Disco</th>
                                    <th>Capacidad Disco</th>
                                    <th>Procesador</th>
                                    <th>Propietario</th>
                                    <th>Proveedor</th>
                                    <th>Sistema Operativo</th>
                                    <th>Serial Cargador</th>
                                    <th>Dominio</th>
                                    <th>Tipo Usuario</th>
                                    <th class="hidden-cell" >Serial Activo</th>
                                    <th>Targeta Video</th>
                                    <th>ESTADO</th>
                                    <th>INICIO MANTENIMIENTO</th>
                                    <th>FIN MANTENIMIENTO</th>
                                    <th>DIAS RESTANTES</th>
                                    <th class="hidden-cell">OBSERVACIONES DE MANTENIMIENTO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Llama a la función y almacena los resultados en $equipos
                                $equipos = mantenimientopreventivocomputador($conexion);

                                // Itera sobre los resultados y muestra cada fila de la tabla
                                foreach ($equipos as $equipo) {
                                    echo "<tr>";
                                    echo "<td>" . $equipo['id'] . "</td>";
                                    echo '<td class="hidden-cell">' . $equipo['Service_tag'] . '</td>';
                                    echo "<td>" . $equipo['Serial_equipo'] . "</td>";
                                    echo "<td>" . $equipo['Nombre_equipo'] . "</td>";
                                    echo "<td>" . $equipo['Sede'] . "</td>";
                                    echo "<td>" . $equipo['Empresa'] . "</td>";
                                    echo "<td>" . $equipo['Marca_computador'] . "</td>";
                                    echo "<td>" . $equipo['Modelo_computador'] . "</td>";
                                    echo "<td>" . $equipo['Tipo_comp'] . "</td>";
                                    echo "<td>" . $equipo['Tipo_ram'] . "</td>";
                                    echo "<td>" . $equipo['Memoria_ram'] . "</td>";
                                    echo "<td>" . $equipo['Tipo_discoduro'] . "</td>";
                                    echo "<td>" . $equipo['Capacidad_discoduro'] . "</td>";
                                    echo "<td>" . $equipo['Procesador'] . "</td>";
                                    echo "<td>" . $equipo['Propietario'] . "</td>";
                                    echo "<td>" . $equipo['Proveedor'] . "</td>";
                                    echo "<td>" . $equipo['Sistema_Operativo'] . "</td>";
                                    echo "<td>" . $equipo['Serial_cargador'] . "</td>";
                                    echo "<td>" . $equipo['Dominio'] . "</td>";
                                    echo "<td>" . $equipo['Tipo_usuario'] . "</td>";
                                    echo '<td class="hidden-cell">' . $equipo['Serial_activo_fijo'] . '</td>';
                                    echo "<td>" . $equipo['Targeta_Video'] . "</td>";
                                    echo "<td>" . $equipo['Estado'] . "</td>";
                                    echo "<td>" . $equipo['Fecha_mantenimiento_inicio'] . "</td>";
                                    echo "<td>" . $equipo['Fecha_mantenimiento_fin'] . "</td>";
                                    echo '<td id="dias_restantes_' . $equipo['id'] . '"></td>';
                                    echo '<td class="hidden-cell">' . $equipo['observaciones_mantenimiento'] . '</td>';
                                    echo "<td><button type=\"button\" class=\"btn btn-success open-modal\" data-bs-toggle=\"modal\" data-bs-target=\"#modalcomputador\" data-id=\"" . $equipo['id'] . "\">Ver</button></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- MODAL DE COMPUTADORES-->
            <div class="modal fade" id="modalcomputador" tabindex="-1" aria-labelledby="modalcomputadorLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalcomputadorLabel">
                                <h6> </h6>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Aquí se llenará el contenido de la consulta  -->
                        </div>
                        <div class="modal-footer">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <strong id="Usua_mantenimiento" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>







        </section>
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





    <script type="text/javascript">
        $(document).ready(function() {
            // Escuchar el clic en los botones "Ver listado"
            $(".open-modal").click(function() {
                // Obtener el ID de la fila seleccionada
                var equipoId = $(this).data("id");

                // Obtén el contenido de la etiqueta <strong> con el id "nombreStrong"
                var nombre2 = $('#Usua_mantenimiento').text();

                // Realizar una solicitud AJAX para obtener los datos
                $.ajax({
                    type: "POST", // Puedes cambiar el método HTTP según tus necesidades
                    url: "../ajaxmantenimientos/ajaxmantenimientocomputador.php", // Reemplaza "tu_script_php.php" con la URL de tu script PHP que maneja la consulta
                    data: {
                        id: equipoId,
                        Usua_mantenimiento: nombre2 // Incluye el contenido de la etiqueta <strong> como parámetro
                    }, // Enviar el ID como parámetro
                    success: function(response) {
                        // Llenar el contenido del modal con la respuesta de la consulta
                        $(".modal-body").html(response);
                    }
                });
            });
        });
    </script>


    <!-- script para las fechas y dais restantes -->
    <script type="text/javascript">
        // Función para calcular los días restantes y actualizar la celda correspondiente
        function actualizarDiasRestantes() {
            <?php
            foreach ($equipos as $equipo) {
                // Calcula los días restantes en JavaScript
                echo "var inicio = new Date('" . $equipo['Fecha_mantenimiento_inicio'] . "');";
                echo "var fin = new Date('" . $equipo['Fecha_mantenimiento_fin'] . "');";
                echo "var ahora = new Date();";
                echo "var diasRestantes = Math.floor((fin - ahora) / (1000 * 60 * 60 * 24));";

                // Actualiza la celda con los días restantes
                echo "$('#dias_restantes_" . $equipo['id'] . "').text(diasRestantes);";
            }
            ?>
        }

        // Llama a la función para calcular y actualizar los días restantes al cargar la página
        actualizarDiasRestantes();

        // Actualiza los días restantes cada minuto (puedes ajustar este intervalo)
        setInterval(actualizarDiasRestantes, 60000); // Actualiza cada 1 minuto
    </script>






<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>