<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
error_reporting(0);

include '../../../conexionbd.php';
if (isset($_SESSION['usuario'])) {
    require '../../../function/funciones.php';
?>

    <!DOCTYPE html>
    <html lang="en">

    <style>
        .hidden-cell {
            display: none;
        }

        .form-select-sm {
            width: 200px;
            /* Ajusta el ancho según tus necesidades. */
        }
    </style>

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
                        <h3>ESTADO DE CELULARES</h3>
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
                                    <th>TIPO DE MAQUINA</th>
                                    <th>IMEI</th>
                                    <th>SERIAL</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>FECHA INGRESO CEL</th>
                                    <th>CAPACIDAD</th>
                                    <th>CAPACIDAD DE RAM</th>
                                    <th>ESTADO</th>
                                    <th class="hidden-cell">ESTADO ID</th>
                                    <th>GESTION</th>
                                    <th>FECHA DE GARANTIA</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $datosEquipos = obtenerDatosEquiposcelularesasignados($conexion); // Llama a la función para obtener los datos
                                foreach ($datosEquipos as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['tipo_maquina'] . "</td>";
                                    echo "<td>" . $row['imei'] . "</td>";
                                    echo "<td>" . $row['serial_equipo_celular'] . "</td>";
                                    echo "<td>" . $row['marca'] . "</td>";
                                    echo "<td>" . $row['modelo'] . "</td>";
                                    echo "<td>" . $row['fecha_ingreso_cel'] . "</td>";
                                    echo "<td>" . $row['capacidad'] . "</td>";
                                    echo "<td>" . $row['ram_celular'] . "</td>";
                                    echo "<td>" . $row['estado'] . "</td>";
                                    echo "<td class='hidden-cell' >" . $row['estadoid'] . "</td>";
                                    echo "<td>" . $row['gestion'] . "</td>";
                                    echo "<td>" . $row['fecha_garantia_cel'] . "</td>";

                                    // Verificar si el estado no es "Asignado" para mostrar el select y el botón
                                    if ($row['estado'] !== 'ASIGNADO' && $row['estado'] !== 'BAJA') {
                                        echo '<td>';
                                        echo '<select class="form-select estadoid-select" aria-label="Default select example" required>';
                                        echo '<option value="" selected disabled>Seleccionar</option>'; // Opción inválida
                                        echo '<option value="1">CONFIGURACION</option>';
                                        echo '<option value="2">BAJA</option>';
                                        echo '<option value="3">VENDIDO</option>';
                                        echo '<option value="5">PROVEEDOR</option>';
                                        echo '<option value="6">STOCK</option>';
                                        echo '</select>';
                                        echo '<br>';
                                        echo '<button type="button" class="btn btn-warning btn-ajustarcomp asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
                                        echo '</td>';
                                    } else {
                                        echo '<td></td>'; // Espacio en blanco si el estado es "Asignado" o "Baja"
                                    }

                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- SE CREA ESTE INPUT PARA CAMBIAR EL PARAMETRO DE USUARIO/USUA_CREA Y TOME EL VALOR
                                    SE DEJA OCULTO -->
                        <div>
                            <input type="hidden" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>">
                        </div>


                    </div>
                </div>
            </div>

        </section>
    </body>



    </html>

    <!-- SCRIPT ALERTA CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <!-- AJAX CELULAR -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustarcomp"
            $('.btn-ajustarcomp').click(function() {


                // VALIDAR SI EL USUARIO NO SELECCIONA NINGUNA OPCION EN EL SELECT O AJUSTES
                var button = $(this);
                var select = button.closest('tr').find('.estadoid-select');
                var selectedValue = select.val();

                // Validar si se ha seleccionado una opción válida
                if (selectedValue === "" || selectedValue === null) {
                    Swal.fire('Seleccione una opción válida', '', 'warning');
                    return;
                }
                // FIN DEL VALIDADOR

                // Obtener el valor del usuario de $_SESSION['usuario']
                var usuario = "<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>";

                // Obtener todos los valores de la fila
                var rowData = $(this).closest('tr').find('td').map(function() {
                    return $(this).text();
                }).get();

                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estadoid-select').val();
                var selectedValue2 = rowData[9];

                // Obtener el IDToUpdate de la última columna de la fila
                var idToUpdate = $(this).data('id');

                console.log("Valores de la fila:", rowData);
                console.log("ID a actualizar:", idToUpdate);
                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("Valor seleccionado en el select2:", selectedValue2);

                // Crear un objeto con los datos que deseas enviar por AJAX
                var rowDataObj = {
                    idToUpdate: idToUpdate,
                    estado: selectedValue,
                    estado2: selectedValue2,
                    rowData: rowData,
                    usuario: usuario
                };

                // Mostrar la alerta Swal antes de hacer la solicitud AJAX
                Swal.fire({
                    title: '¿Desea guardar los cambios?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `No guardar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                        $.ajax({
                            type: "POST",
                            url: "../ajax_estados/estado_celular.php",
                            data: rowDataObj,
                            success: function(response) {
                                console.log("Respuesta del servidor:", response);
                                Swal.fire('¡Guardado!', '', 'success');
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(error) {
                                console.error("Error al actualizar el estado:", error);
                                Swal.fire('Error', 'Error al actualizar el estado', 'error');
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Los cambios no se guardan', '', 'info');
                    }
                });
            });
        });
    </script>



<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>