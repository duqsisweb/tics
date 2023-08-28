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

         <!-- NAVINGRESOS -->
         <?php require '../../views/navingresos.php'; ?>

        <section style="margin-top: 100px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="infodetallefactura" cellspacing="0" style="text-align: center;">
                            <thead>
                                <tr class="encabezado table-dark">
                                    <th>ID</th>
                                    <th>Service Tag</th>
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
                                    <th>Serial Activo</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Targeta Video</th>
                                    <th>Estado</th>
                                    <th>Fecha Garantia</th>
                                    <th>Usuario Crea</th>


                                    

                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT  
                                    mc.[id],
                                    mc.[Service_tag],
                                    mc.[Serial_equipo],
                                    mc.[Nombre_equipo],
                                    s.[nombre_sede] AS [Nombre_sede],
                                    e.[nombre_empresa] AS [Nombre_empresa],
                                    mc.[Marca_computador],
                                    mc.[Modelo_computador],
                                    tc.[nombre_tipo_comp] AS [Nombre_tipo_comp],
                                    mc.[Tipo_ram],
                                    mc.[Memoria_ram],
                                    td.[nombre_tipo_discoduro] AS [Nombre_tipo_discoduro],
                                    cd.[capacidad_discoduro] AS [Capacidad_discoduro],
                                    mc.[Procesador],
                                    p.[descripcion] AS [Propietario],
                                    mc.[Proveedor],
                                    so.[nombre_sistema_operativo] AS [Sistema_Operativo],
                                    mc.[Serial_cargador],
                                    mc.[Dominio],
                                    mc.[Tipo_usuario],
                                    mc.[Serial_activo_fijo],
                                    mc.[Fecha_ingreso],
                                    mc.[Targeta_Video],
                                    e2.[nombre_estado] AS [Estado],
                                    mc.[Fecha_garantia],
                                    mc.[Usua_crea]
                                FROM [ControlTIC].[dbo].[maquina_computador] AS mc
                                JOIN [ControlTIC].[dbo].[sede] AS s ON mc.[Sede] = s.[id]
                                JOIN [ControlTIC].[dbo].[empresa] AS e ON mc.[Empresa] = e.[id]
                                JOIN [ControlTIC].[dbo].[tipo_comp] AS tc ON mc.[Tipo_comp] = tc.[id]
                                JOIN [ControlTIC].[dbo].[tipo_discoduro] AS td ON mc.[Tipo_discoduro] = td.[id]
                                JOIN [ControlTIC].[dbo].[capacidad_discoduro] AS cd ON mc.[Capacidad_discoduro] = cd.[id]
                                JOIN [ControlTIC].[dbo].[propietario] AS p ON mc.[Propietario] = p.[id]
                                JOIN [ControlTIC].[dbo].[sistema_operativo] AS so ON mc.[Sistema_Operativo] = so.[id]
                                JOIN [ControlTIC].[dbo].[estado] AS e2 ON mc.[Estado] = e2.[id]";
                                
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

<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>
