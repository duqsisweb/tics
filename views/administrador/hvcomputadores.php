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
    <?php require '../../views/head.php'; ?>

    <body>
        <!-- NAV -->
        <?php require '../../views/nav.php'; ?>


        <section style="margin-top: 100px;">
            <!-- NAVINGRESOS -->
            <?php require '../../views/navinventario.php'; ?>
            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container">
                    <div>
                        <h3>HV DE COMPUTADORES</h3>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                            <thead>
                                <tr class="encabezado table-dark">
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>
                                    <TH></TH>



                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT
                                [id_historial],
                                mc.[id],
                                tipomaquin.[nombre_maquina] as Tipo_maquina,
                                [Service_tag],
                                [Serial_equipo],
                                [Nombre_equipo],
                                sed.[nombre_sede] as Sede,
                                empres.[nombre_empresa] as Empresa,
                                [Marca_computador],
                                [Modelo_computador],
                                tipocomp.[nombre_tipo_comp] as Tipo_comp,
                                [Tipo_ram],
                                [Memoria_ram],
                                tipodisco.[nombre_tipo_discoduro] as Tipo_disco,
                                capacidaddisco.[capacidad_discoduro] as Capacidad_dico,
                                [Procesador],
                                propietari.[descripcion] as Propietario,
                                [Proveedor],
                                sistemao.[nombre_sistema_operativo] as Sistema_O,
                                [Serial_cargador],
                                [Dominio],
                                [Tipo_usuario],
                                [Serial_activo_fijo],
                                [Fecha_ingreso],
                                [Targeta_Video],
                                estad.[nombre_estado] as Estado,
                                gestio.[estado_gestion] as Estado_Gestion,
                                [Fecha_garantia],
                                [Fecha_crea],
                                [Usua_crea],
                                [Fecha_modifica],
                                [Usua_modifica],
                                [Usua_asigna],
                                [Fecha_asigna],
                                [cedula],
                                [cargo],
                                [primernombre],
                                [segundonombre],
                                [primerapellido],
                                [segundoapellido],
                                estadoasigna.[nombre_estado] as Estado_asignacion,
                                [observaciones]
                            FROM [ControlTIC].[dbo].[historial_computador] as mc
                            LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id]
                            LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
                            LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
                            LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
                            LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
                            LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
                            LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
                            LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id
                            LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id
                            LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id
                            LEFT JOIN [ControlTIC].[dbo].estado_asignacion as estadoasigna ON mc.estado_asignacion = estadoasigna.id; ";

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