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

           
            <?php require '../../views/navinventario.php'; ?>


            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container">
                    <div>
                        <h3>CAMBIO DE ESTADO DE LOS EQUIPOS</h3>
                    </div>
                </div>
            </div>

            <!-- Primer bloque -->
            <div class="container" style="text-align: center;margin-bottom: 50px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/pc-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">COMPUTADORAS</h5>
                                <p class="card-text"></p>
                                <a href="estados/estado_computadores.php" class="btn btn-success">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/celular-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">CELULARES</h5>
                                <p class="card-text"></p>
                                <a href="estados/estado_celulares.php" class="btn btn-success">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/accesorios-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">Accesorios</h5>
                                <p class="card-text"></p>
                                <a href="stock/stock_accesorios.php" class="btn btn-success disabled">Seleccionar</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/edcomunicacion-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">E. DE COMUNICACIÓN</h5>
                                <p class="card-text"></p>
                                <a href="estados/estado_edcomunicacion.php" class="btn btn-success">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Segundo bloque    -->
            <div class="container" style="text-align: center;margin-bottom: 50px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/video-bean-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">PERIFERICOS</h5>
                                <p class="card-text"></p>
                                <a href="estados/estado_perifericos.php" class="btn btn-success">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/discos-duros-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">ALMACENAMIENTO</h5>
                                <p class="card-text"></p>
                                <a href="estados/estado_almacenamiento.php" class="btn btn-success">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/simcard.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">SIMCARD</h5>
                                <p class="card-text"></p>
                                <a href="estados/estado_simcard.php" class="btn btn-success">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/image/dvr.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">DVR</h5>
                                <p class="card-text"></p>
                                <a href="" class="btn btn-success disabled">Seleccionar</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Tercer bloque     -->
            <!-- <div class="container" style="text-align: center;margin-bottom: 50px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                        <img src="../../assets/image/cctv-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">CCTV</h5>
                                <p class="card-text"></p>
                                <a href="" class="btn btn-success disabled">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                        <img src="../../assets/image/torre-modified.png" class="card-img-top mx-auto" alt="..." style="width: 150px;">
                            <div class="card-body">
                                <h5 class="card-title">Torre</h5>
                                <p class="card-text"></p>
                                <a href="" class="btn btn-success disabled">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


        </section>
    </body>

    </html>

<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>