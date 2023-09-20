<?php header('Content-Type: text/html; charset=UTF-8');

session_start();
error_reporting(0);

include '../conexionbd.php';
if (isset($_SESSION['usuario'])) {

?>
    <!DOCTYPE html>
    <html lang="es">

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <a class="navbar-brand">
            <h6 style="color:aliceblue;margin-left: 10px;">CONTROL & <br> GESTIÓN <br> DE INVENTARIOS</h6>
        </a>
        <a href="">
            <img class="logo" style="margin-right: 100px;" src="../assets/image/faviconplanta.png">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div id="">
                    <a href=""><img id="inicioavatar" class="logo" src="../assets/image/perfil.png"></a>
                </div>
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    <h6 style="color:aliceblue">CONTROL Y GESTIÓN DE INVENTARIOS</h6>
                    <p class="user"> Usuario <br><?php echo utf8_encode($_SESSION['usuario']); ?></p>
                    <p class="user"> Nombre <br><?php echo utf8_encode($_SESSION['NOMBRE']); ?></p>
                </h5>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./inicio.php">Inicio </a>
                    </li>
                    <a class="btn btn-danger btnCloseSesion" href="../closeSesion.php" role="button">Cerrar Sesión</a>
                </ul>
            </div>
        </div>
        </div>
    </nav>


    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>