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
    <?php
    require '../../views/head.php';
    ?>


    <!-- Estilos para cambiar borde de color -->
    <style>
        .empresa-1 {
            border-color: rgb(247, 4, 4) !important;
            /* Otros estilos... */
        }

        .empresa-2 {
            border-color: rgb(5, 87, 28);
            /* Otros estilos... */
        }

        .empresa-3 {
            border-color: rgb(138, 137, 147);
            /* Otros estilos... */
        }

        .background-container {
            position: relative;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.8;
            padding-top: 50px;
            padding-left: 190px;
            /* Ajusta la opacidad y el padding según tus necesidades */
        }

        .card-body {
            background-color: white !important;
            opacity: 0.9 !important;
        }
    </style>


    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
        ?>

        <section style="margin-top: 100px;">

            <!-- NAV -->
            <?php
            require '../../views/navasignaciones.php';
            ?>





            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container" style="text-align: center;">
                    <div>
                        <h3>DEVOLUCIONES</h3>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                Generar Acta de equipos devueltos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Generar Actas por Usuario</h5>
                                <p class="card-text">Al realizar un retiro de equipo asignado , aquí podra buscar el usuario y generar acta con los equipos devueltos
                                </p>
                                <a href="desasignacionesusuario.php" class="btn btn-success">Ingresar</a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                Historial de devoluciones
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> Historial de Devoluciones por Usuario</h5>
                                <p class="card-text">Aqui puede visualizar el historial de las devoluciones realizadas por un usuario
                                </p>
                                <a href="equiposdevueltosusuario.php" class="btn btn-success">Ingresar</a>
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
    </script>
    <?php
} ?>