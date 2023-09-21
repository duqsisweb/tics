<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
error_reporting(0);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
            <?php require '../../views/navinventario.php'; ?>
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
                    <div class="col-md-4">
                        <form method="POST">
                            <input class="form-control" type="text" name="Nombre_equipo" style="width: 100%;" id="Nombre_equipo" required>

                            <h5 style="text-align: center;"></h5>
                            <input type="submit" class="btn btn-success" name='consultar' value="Consultar" id="btncolor">
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                <thead>
                    <tr class="encabezado table-dark">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
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
    

    </body>

    </html>

<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>