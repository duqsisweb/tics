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
        $datosEquipos = hvcomputador($conexion, $nombreEquipo);

        // Si se encontraron resultados, configurar la bandera en true
        if (!empty($datosEquipos)) {
            $mostrarTabla = true;
        }
    }
?>


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
                        <input type="submit" class="btn btn-success" name='consultar' value="Consultar" id="btncolor">
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div>
            <br>
        </div>



        <?php
        // Verificar si se debe mostrar la tabla o el mensaje
        if ($mostrarTabla) {
            // Mostrar la tabla y los resultados
        ?>
            <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                <thead>
                    <tr class="encabezado table-dark">
                        <th>ID</th>
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
                        <th>TARGETA VIDEO</th>
                        <th>ESTADO</th>
                        <th>ESTADO GESTION</th>
                        <th>FECHA DE MODIFICACION</th>
                        <th>USUARIO QUE MODIFICO</th>
                        <th>USUARIO QUE ASIGNO</th>
                        <th>FECHA QUE ASIGNO</th>
                        <th>CEDULA DEL EMPLEADO</th>
                        <th>CARDO DEL EMPLEADO</th>
                        <th>PRIMER NOMBRE EMPELADO</th>
                        <th>SEGUNDO NOMBRE EMPLEADO</th>
                        <th>PRIMER APELLIDO EMPLEADO</th>
                        <th>SEFUNDO APELLIDO EMPLEADO</th>
                        <th>ESTADO DE ASIGNACIÓN</th>
                        <th>OBSERVACIONES DE ASIGNACION</th>
                        <th>LINK DE ASIGNACIÓNES</th>
                        <th>OBSERVACIONES DE DEVOLUCIÓN</th>
                        <th>LINK DE DEVOLUCIÓN</th>
                        <th>FECHA RETIRA</th>
                        <th>USUARIO RETIRA</th>
                        <th>USUARIO MANTENIMIENTO</th>
                        <th>FECHA MANTENIMIENTO INICIO</th>
                        <th>FECHA MANTENIMIENTO FINAL</th>
                        <th>OBSERVACIONES DE MANTENIMIENTO</th>
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
                            foreach ($row as $key => $value) {
                                if ($key === 'Estado' && $value === 'Asignado') {
                                    echo "<td>$value</td>";
                                } else {
                                    echo "<td>" . $value . "</td>";
                                }
                            }
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