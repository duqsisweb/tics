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
        $id = $_POST['id'];
        // Llamar a la función con el parámetro de búsqueda
        $datosEquipos = hvdvr($conexion, $id);

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
                        <h3>HV DE DVR</h3>
                    </div>
                </div>
            </div>
        </section>



        <div class="container" style="text-align: center;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="POST">
                        <input class="form-control" type="text" name="id" style="width: 100%;" id="id" placeholder="INGRESE ID" required>

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

        if ($mostrarTabla) {

        ?>
            <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                <thead>
                    <tr class="encabezado table-dark">
                      <th>ID</th>
                      <th>TIPO MAQUINA</th>
                      <th>MARCA DVR</th>
                      <th>MODELO</th>
                      <th>DESCRIPCION</th>
                      <th>CAPACIDAD</th>
                      <th>TIPO DVR</th>
                      <th>SEDE</th>
                      <th>UBICACION</th>
                      <th>SOFTWARE</th>
                      <th>FECHA INGRESO</th>
                      <th>NUMERO DE CANALES</th>
                      <th>NUMERO DE DISCOS</th>
                      <th>DIAS DE GRABACION</th>
                      <th>IP DVR</th>
                      <th>ESTADO</th>
                      <th>FECHA GARANTIA</th>
                      <th>FECHA CREA</th>
                      <th>USUA CREA</th>
                      <th>FECHA MODIFICA</th>
                      <th>USUA MODIFICA</th>
                      <th>FECHA ASIGNA</th>
                      <th>USUA ASIGNA</th>
                      <th>CEDULA</th>
                      <th>CARGO</th>
                      <th>PRIMER NOMBRE</th>
                      <th>SEGUNDO NOMBRE</th>
                      <th>PRIMER APELLIDO</th>
                      <th>SEGUNDO APELLIDO</th>
                      <th>EMPRESA</th>
                      <th>ESTADO DE ASIGNACION</th>
                      <th>OBSERVACIONES DESASIGNA</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['consultar'])) {
                        // Obtener el valor ingresado en el campo Nombre_equipo
                        $id = $_POST['id'];
                        // Llamar a la función con el parámetro de búsqueda
                        $datosEquipos = hvdvr($conexion, $id);
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