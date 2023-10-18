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
                <p><?php echo utf8_encode($_SESSION['NOMBRE']); ?> Coordinador</p>
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
                                <h5 class="card-title">Ingresar Productos al stock</h5>
                                <p class="card-text">Aquí puede ingresar Dispositivos o Maquinas de computo al inventario</p>
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
                                <h5 class="card-title">Equipos En El Inventario</h5>
                                <p class="card-text">...</p>
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
                                <h5 class="card-title">Estado De Equipos</h5>
                                <p class="card-text">Aquí puede visualizar el estado de las máquinas o dispositivos</p>
                                <a href="estadoequipos.php" class="btn btn-success">Ingresar</a>
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
                                <h5 class="card-title">HV de Equipos</h5>
                                <p class="card-text">...</p>
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
                                <p class="card-text">...</p>
                                <a href="actualizaciondeequipos.php" class="btn btn-success">Ingresar</a>
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
                                <p class="card-text">...</p>
                                <a href="mantenimientos/mantenimientocomputador.php" class="btn btn-success">Ingresar</a>
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
                                <h5 class="card-title">Asignar Equipos a Usuarios</h5>
                                <p class="card-text">Aquí puede asignar los dispositivos o equipos a los trabajadores</p>
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
                                <h5 class="card-title">Usuarios con Equipos Asignados</h5>
                                <p class="card-text">Aquí puede verificar que Dispositivos o Máquinas están asociadas a los usuarios</p>
                                <a href="asignacionesusuario.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- <div class="card text-center">
                            <div class="card-header">
                                Devoluciones
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Remover Asignación</h5>
                                <p class="card-text">Aquí puede liberar o remover equipos de los usuarios</p>
                                <a href="devoluciones.php" class="btn btn-success">Ingresar</a>
                            </div>
                        </div> -->
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
                                AGREGAR COMPLEMENTOS
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> AGREGAR COMPLEMENTOS</h5>
                                <p class="card-text"></p>
                                <a href="complementos.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Usuarios con Equipos Asignados</h5>
                                <p class="card-text">Aquí puede verificar que Dispositivos o Máquinas están asociadas a los usuarios</p>
                                <a href="asignacionesusuario.php" class="btn btn-success">Ingresar</a>
                            </div>

                        </div>
                    </div> -->

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