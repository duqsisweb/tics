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
                        <h3>INVENTARIO DE COMPUTADORES</h3>
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
                                    <th>SERVICE TAG</th>
                                    <th>SERIAL</th>
                                    <th>NOMBRE DEL EQUIPO</th>
                                    <th>SEDE</th>
                                    <th>EMPRESA</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>TIPO COMPUTADOR</th>
                                    <th>TIPO RAM</th>
                                    <th>CAPACIDAD RAM</th>
                                    <th>TIPO DISCO</th>
                                    <th>CAPACIDAD DE DISCO</th>
                                    <th>PROCESADOR</th>
                                    <th>PROPIETARIO</th>
                                    <th>PROVEEDOR</th>
                                    <th>SISTEMA OPERATIVO Operativo</th>
                                    <th>SERIAL CARGADOR</th>
                                    <th>DOMINIO</th>
                                    <th>TIPO USUARIO</th>
                                    <th>SERIAL ACTIVO</th>
                                    <th>FECHA DE INGRESO</th>
                                    <th>TARGETA DE VIDEO</th>
                                    <th>ESTADO</th>
                                    <th>GESTION</th>
                                    <th>FECHA GARANTIA</th>
                                    <!-- <th>FECHA INICIAL MANTENIMIENTO</th>
                                    <th>FECHA FINAL DE MANTENIMIENTO</th>
                                    <th>DIAS RESTANTES</th>
                                    <th>OBSERVACIONES DE MANTENIMIENTO</th> -->
                                    <th>USUARIO QUE CREO</th>
                                    <th>FECHA DE CREACIÓN</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = " SELECT mc.[id] ,tipo_maquina.[nombre_maquina] as tipo_maquina ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,sed.[nombre_sede] as Sede ,empres.[nombre_empresa] as Empresa ,[Marca_computador] ,[Modelo_computador] ,tipocomp.[nombre_tipo_comp] as Tipo_comp ,tipo_memoria_ram.[nombre_tipo_ram] as tipo_memoria_ram ,capacidad_ram.[capacidad_ram] as capacidad_ram ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro ,[Procesador] ,propietari.[descripcion] as Propietario ,[Proveedor] ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso_c] ,[Targeta_Video] ,estad.[nombre_estado] Estado ,gestio.[estado_gestion] as Gestion ,Fecha_garantia_c ,usuamov, fechamov FROM [ControlTIC].[dbo].[maquina_computador] as mc LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id ";
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