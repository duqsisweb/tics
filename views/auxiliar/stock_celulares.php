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
                                    <?php
                                    $sql = "SELECT TOP 1 * FROM [ControlTIC].[dbo].[maquina_celular]";
                                    $result = odbc_exec($conexion, $sql);

                                    if ($result !== false) {
                                        $row = odbc_fetch_array($result);
                                        foreach ($row as $column_name => $value) {
                                            echo "<th>" . $column_name . "</th>";
                                        }
                                        odbc_free_result($result);
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM [ControlTIC].[dbo].[maquina_celular]";
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