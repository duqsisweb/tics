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
                        <h3>INVENTARIO DVR</h3>
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
                                    <th>ELEMENTO</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>CAPACIDAD</th>
                                    <th>TIPO</th>
                                    <th>SEDE</th>
                                    <th>UBICACIÓN</th>
                                    <th>SOFTWARE</th>
                                    <th># CANALES</th>
                                    <th># DISCOS</th>
                                    <th>DIAS DE GRABACIÓN</th>
                                    <th>IP DVR</th>
                                    <th>ESTADO</th>
                                    <th>ESTADO DE ASIGNACION</th>
                                    <th>FECHA DE GARANTIA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = " SELECT  mc.[id] ,tipomaquin.[nombre_maquina] as tipo_maquina ,[marca_dvr] ,[modelo_dvr] ,[descripcion_dvr] ,[capacidad_dvr] ,[tipo_dvr] ,sed.[nombre_sede] as Sede ,[ubicacion_dvr] ,[software] ,[num_canales] ,[num_discos] ,[dias_grabacion] ,[ip_dvr] ,estad.[nombre_estado] as Estado ,estadoa.[nombre_estado] as estado_asignacion ,[fecha_garantia] FROM [ControlTIC].[dbo].[maquina_dvr] as mc LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_dvr = sed.id LEFT JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id LEFT JOIN [ControlTIC].[dbo].estado_asignacion AS estadoa ON mc.estado_asignacion = estadoa.id
                                ";
                                $result = odbc_exec($conexion, $sql);

                                if ($result !== false) {
                                    while ($row = odbc_fetch_array($result)) {
                                        echo "<tr>";
                                        foreach ($row as $value) {
                                            echo "<td>" . $value . "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    odbc_free_result($result);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>