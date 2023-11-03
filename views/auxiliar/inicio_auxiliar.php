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

            <div class="alert alert-success" role="alert">
                <p><?php echo utf8_encode($_SESSION['NOMBRE']); ?> Auxiliar</p>
            </div>

            <!-- PRIMER BLOQUE -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Ingresos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Ingresar productos al stock</h5>
                                <p class="card-text">Simplifica la gestión de inventarios.</p>
                                <a href="ingresos.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Inventario
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Equipos en el inventario</h5>
                                <p class="card-text">Optimiza tu control de activos</p>
                                <a href="inventario.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Estado
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Estado de equipos</h5>
                                <p class="card-text">Monitoriza la condición de tus activos</p>
                                <a href="estados.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- SEGUNDO BLOQUE -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Historial de Equipos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Hoja de vida de equipos</h5>
                                <p class="card-text">Rastrea el historial de tus activos</p>
                                <a href="hojadevida.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Actualización de equipos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Mantenimiento Correctivo</h5>
                                <p class="card-text">Solucion de harware de manera eficaz</p>
                                <a href="mantenimiento_correctivo/mantenimiento_correctivo_computador.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                MANTENIMIENTO DE EQUIPOS
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Mantenimiento Preventivo</h5>
                                <p class="card-text">Asegura la durabilidad de tus equipos</p>
                                <a href="mantenimiento_preventivo/mantenimiento_preventivo_computador.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- TERCER BLOQUE -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Asignaciones
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Asignar Equipos</h5>
                                <p class="card-text">Controla la distribución de recursos</p>
                                <a href="asignaciones.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Asignaciones
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Equipos Asignados</h5>
                                <p class="card-text">Gestion y visualizacion de forma eficiente</p>
                                <a href="asignacionesusuario.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Remover Asignación
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Devolución de equipos</h5>
                                <p class="card-text">Flujo de recursos con acta</p>
                                <a href="desasignacionesusuario.php" class="btn btn-success">Ingresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <!-- CUARTO BLOQUE -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Complementos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> AGREGAR COMPLEMENTOS</h5>
                                <p class="card-text">Personaliza y amplía al sistema de gestión de inventarios</p>
                                <a href="" class="btn btn-success" id="ingresarBtn">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                Usuarios
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">USUARIOS DEL SISTEMA GESTION TICS</h5>
                                <p class="card-text">Registro de usuarios</p>
                                <a href="" class="btn btn-success" id="ingresarBtn2">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Remover Asignación</h5>
                                <p class="card-text">Aquí puede liberar o remover equipos de los usuarios</p>
                                <a href="devoluciones.php" class="btn btn-success">Ingresar</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

        </section>

    </body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el botón por su ID
            const ingresarBtn = document.getElementById("ingresarBtn");

            // Agrega un evento de clic al botón
            ingresarBtn.addEventListener("click", function(e) {
                e.preventDefault(); // Evita la navegación por enlace

                // Muestra la alerta de SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: ' ¡No tienes permisos!',
                    footer: ''
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el botón por su ID
            const ingresarBtn = document.getElementById("ingresarBtn2");

            // Agrega un evento de clic al botón
            ingresarBtn.addEventListener("click", function(e) {
                e.preventDefault(); // Evita la acción por defecto del enlace (navegación)

                // Muestra la alerta de SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: ' ¡No tienes permisos!',
                    footer: ''
                });
            });
        });
    </script>


    <script>
        // Función para obtener la fecha y hora actual en español
        function getCurrentDateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            return now.toLocaleDateString('es-ES', options);
        }

        // Función para actualizar la fecha en la página
        function updateLastAccessTime() {
            const lastAccessTimeElement = document.getElementById('last-access-time');
            if (lastAccessTimeElement) {
                const currentDateTime = getCurrentDateTime();
                lastAccessTimeElement.textContent = 'Último acceso: ' + currentDateTime;
            }
        }

        // Llama a la función para actualizar la fecha cuando la página se carga
        window.addEventListener('load', updateLastAccessTime);

        // También puedes actualizar la fecha periódicamente, por ejemplo, cada 60 segundos
        setInterval(updateLastAccessTime, 60000);
    </script>




    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>