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
                        <h3>INVENTARIO DE CELULARES</h3>
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
                                    <th>IMEI</th>
                                    <th>SERIAL</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>FECHA DE GARANTIA</th>
                                    <th>ALMACENAMIENTO</th>
                                    <th>RAM</th>
                                    <th>ESTADO</th>
                                    <th>GESTION</th>
                                    <th>FECHA DE GARANTIA</th>
                                    <th>USUARIO CREACION</th>
                                    <th>FECHA DE CREACION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = " SELECT mc.[id] 
                                ,tipomaquin.[nombre_maquina] as tipo_maquina 
                                ,[imei] 
                                ,[serial_equipo_celular] 
                                ,[marca] 
                                ,[modelo] 
                                ,[fecha_ingreso_cel] 
                                ,[capacidad] 
                                ,[ram_celular] 
                                ,estad.[nombre_estado] AS [Estado] 
                                ,gestio.[estado_gestion] as gestion 
                                ,[fecha_garantia_cel] 
                                ,usuamov
                                ,fechamov
                                FROM [ControlTIC].[dbo].[maquina_celular] AS mc 
                                JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
                                JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.[Estado] = estad.[id] 
                                JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion = gestio.[id] ";
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