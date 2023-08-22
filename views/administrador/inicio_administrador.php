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

<!-- PARTE DEL HEAD -->
        <?php
        require '../../views/head.php';
        ?>
   

    <body>


    <!-- PARTE DEL NAV -->
    <?php
        require '../../views/nav.php';
    ?>

        <section style="margin-top: 100px;">

            <div class="alert alert-danger" role="alert">
            <p><?php echo utf8_encode($_SESSION['NOMBRE']);?> Administrador</p>
            </div>
      

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Ingresos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Ingresar Productos al stock</h5>
                                <p class="card-text">Aquí puede ingresar Dispositivos o Maquinas de computo al inventario</p>
                                <a href="ingresos.php" class="btn btn-primary">Ingresar</a>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                               Asignaciones
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Asignacion de Equipos a Personal</h5>
                                <p class="card-text">Aquí puede asignar los dispositivos o equipos a los trabajadores</p>
                                <a href="asignaciones.php" class="btn btn-primary">Ingresar</a>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Featured
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Featured
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Featured
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Featured
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            <div class="card-footer text-body-secondary">
                                2 days ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </section>

    </body>









    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>