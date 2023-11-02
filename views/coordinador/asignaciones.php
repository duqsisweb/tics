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

    <!-- Asegúrate de cargar jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
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

        <section style="margin-top: 100px;">


            <!--  -->
            <?php require '../../views/navasignaciones.php'; ?>


            <?php
            // SELECT PARA HACER LA CONSULTA
            if (isset($_POST['consultar'])) {

                $CEDULA = $_POST['CEDULA'];
                $empresaOption = $_POST['empresa'];
                $backgroundImage = '';

                switch ($empresaOption) {
                    case 1:
                        $empresa = 'DUQUESA';
                        $con = $conexion;
                        $backgroundImage = "duquesa_logo.png";
                        break;
                    case 2:
                        $empresa = 'Palmeras2013';
                        $con = $conexion2;
                        $backgroundImage = "logopalmeras.png";
                        break;
                    case 3:
                        $empresa = 'J25';
                        $con = $conexion2;
                        $backgroundImage = "logoj25.png";
                        break;
                    default:
                        // Opción inválida
                        // Se puede mostrar un mensaje de error o tomar alguna otra acción
                        break;
                }

                if (isset($con)) {
                    $data = odbc_exec($con, "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM $empresa..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 and CEDULA = '$CEDULA'");
                    $arr = array(); // Inicializar el arreglo para almacenar los resultados
                    while ($Element = odbc_fetch_array($data)) {
                        $arr[] = $Element;
                    }
                }

                if (!empty($arr)) {
                    // Mostrar la tarjeta con la información del usuario
                    $nombreCompleto = $arr[0]['NOMBRE'] . ' ' . $arr[0]['NOMBRE2'] . ' ' . $arr[0]['APELLIDO'] . ' ' . $arr[0]['APELLIDO2'];
                    $cedula = $arr[0]['CEDULA'];
                    $cargo = $arr[0]['CARGO'];

                    $showSections = true;

                    //  MENSAJES SI LA CONSULTA ES EXITOSA O NO HAY INFORMACIÓN
                    echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="toast-header">
                                        <strong class="me-auto">Éxito</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                                                </div>
                                    <div class="toast-body">
                                        Consulta satisfactoria.
                                    </div>
                                </div>';
                    echo '<script>
                                var toastEl = document.querySelector(".toast");
                                var toast = new bootstrap.Toast(toastEl);
                                toast.show();
                            </script>';
                } else {
                    // Mostrar un mensaje de error
                    echo '<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">Error</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="toast-body">
                                        No se encontraron registros para la consulta.
                                    </div>
                                </div>';
                    echo '<script>
                                var toastEl = document.querySelector(".toast");
                                var toast = new bootstrap.Toast(toastEl);
                                toast.show();
                            </script>';
                }
            }

            ?>


            <!-- TITULO -->
            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container" style="text-align: center;">
                    <div>
                        <h3>ASIGNAR EQUIPOS A USUARIOS</h3>
                    </div>
                </div>
            </div>



            <!-- SELECT CAPOS EMPRESA / CEDULA Y FICHA TECNICA -->
            <form method="POST">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3" style="margin: 50px 0px 0px 0px;">
                            <label class="form-label">Empresa</label>
                            <select id="empresaSelect" name="empresa" class="form-select" aria-label="Default select example" required>
                                <option selected disabled>SELECCIONE EMPRESA</option>
                                <option value="1">Duquesa S.A. BIC</option>
                                <option value="2">Palmeras del Llano S.A. BIC</option>
                                <option value="3">J25</option>
                            </select>
                        </div>

                        <div class="col-md-2" style="margin: 50px 0px 0px 0px;display: none;">
                            <label class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identificacionInput" placeholder="" name="CEDULA" pattern="[0-9]+" required>
                        </div>

                        <div class="col-md-2" style="margin: 50px 0px 0px 0px;">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input list="asiste" class="form-control" type="text" id="nombreInput" name="asiste" required>
                                <datalist id="asiste">
                                    <?php
                                    include '../../../conexionbd.php';
                                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                                    $result = odbc_exec($conexion, $query);

                                    while ($admon = odbc_fetch_array($result)) {
                                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                                        echo '<option value="' . trim($admon['CEDULA']) . '">' . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . '</option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div style="margin: 80px 0px 0px 0px;text-align: center;">
                                <button type="submit" class="btn btn-success" name="consultar" id="consultar">CONSULTAR</button>
                            </div>
                        </div>


                        <!-- SECCION TARGETA DE PERFIL -->
                        <div class="col-md-5">
                            <?php if (isset($showSections) && $showSections) : ?> <!-- Comprueba si se debe mostrar la sección -->
                                <div class="card mb-3 <?php echo 'empresa' . $empresaOption; ?>">
                                    <div class="row g-0 background-container">
                                        <?php if (!empty($backgroundImage)) : ?> <!-- Comprueba si hay una imagen de fondo definida -->
                                            <div class="background-image" style="background-image: url('../../assets/image/<?php echo $backgroundImage; ?>');"></div>
                                        <?php endif; ?>
                                        <div class="col-md-4">
                                            <!-- <img src="../../assets/image/perfil.png" class="img-fluid rounded-start" alt="..."> -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <?php foreach ($arr as $row) {
                                                        $nombreCompleto = $row['NOMBRE'] . ' ' . $row['NOMBRE2'] . ' ' . $row['APELLIDO'] . ' ' . $row['APELLIDO2'];
                                                        $primernombre = $row['NOMBRE'];
                                                        $segundonombre = $row['NOMBRE2'];
                                                        $primerapellido = $row['APELLIDO'];
                                                        $segundoapellido = $row['APELLIDO2'];
                                                        $cedula = $row['CEDULA'];
                                                        $cargo = $row['CARGO'];

                                                        // Agrega los valores como valores de entrada ocultos
                                                        echo '<input type="hidden" name="primernombre" value="' . htmlspecialchars($primernombre) . '">';
                                                        echo '<input type="hidden" name="segundonombre" value="' . htmlspecialchars($segundonombre) . '">';
                                                        echo '<input type="hidden" name="primerapellido" value="' . htmlspecialchars($primerapellido) . '">';
                                                        echo '<input type="hidden" name="segundoapellido" value="' . htmlspecialchars($segundoapellido) . '">';
                                                        echo '<input type="hidden" name="cedula" value=" id="cedula"' . htmlspecialchars($cedula) . '">';
                                                        echo '<input type="hidden" name="cargo" value="' . htmlspecialchars($cargo) . '">';

                                                        // Muestra los valores en el card-body si lo deseas
                                                        echo '<h6 class="card-title"><strong>' . $nombreCompleto . '</strong></h6>';
                                                        echo '<p class=""><strong>Cedula: ' . $cedula . '</strong></p>';
                                                        echo '<p class=""><strong>Cargo: ' . $cargo . '</strong></p>';
                                                    } ?>
                                                    <input type="hidden" name="empresaOption" id="empresaOption" value="<?php echo $empresaOption ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            </form>

            <!-- DEPENDIENDO SI HAY INFORMACION DE USUARIO, EL SISTEMA MOSTRARA LOS DATOS SI NO PUES PERMANECERAN OCULTOS  -->
            <?php
            if (isset($showSections)) {
            ?>

                <!-- AQUI MUESTRA LAS SECCION  COMPUTADOR -->
                <div class="container " style="margin-top: 50px;">
                    <div class="row">
                        <!-- PRIMER BLOQUE CHECK -->
                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" name="selecciondelcomputador">
                                <label class="form-check-label" for="flexSwitchCheckDefault">COMPUTADORAS</label>
                            </div>
                        </div>
                        <!-- SEGUNDO BLOQUE  SELECCION DEL TIPO DE COMPUTADOR-->
                        <div class="col-md-2" id="fila1" style="display: none;">
                            <!-- CONSULTA POR MEDIO DE CHECKS -->
                            <?php
                            include '../../conexionbd.php';
                            $consulta = "SELECT id, nombre_tipo_comp FROM [ControlTIC].[dbo].[tipo_comp]";
                            $resultado = odbc_exec($conexion, $consulta);
                            ?>

                            <form>
                                <?php
                                while ($fila = odbc_fetch_array($resultado)) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre_tipo_comp'];
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_comp" id="tipo_comp_<?php echo $id; ?>" value="<?php echo $id; ?>" onchange="updateTipoComputador(this)">
                                        <label class="form-check-label" for="tipo_comp_<?php echo $id; ?>">
                                            <?php echo $nombre; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="tipocomputador" id="tipocomputador" value="">

                            </form>

                        </div>
                        <!-- TERCER BLOQUE LUEGO DE LA CONSULTA CON EL TIPO DE COMPUTADOR LISTAR -->
                        <div class="col-md-2" id="fila2" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcomputador">
                                Ver listado
                            </button>
                        </div>
                        <!-- CUARTO BLOQUE VERIFICAR SI HAY COMPUTADORES ASIGNADOS -->
                        <div class="col-md-4" id="fila3" style="display: none; font-family: 'Courier New', monospace;"></div>

                        <div class="col-md-2" id="fila4" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcomputadorinformacion">Remover Asignación</button>
                        </div>

                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  CELULAR -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCelular" value="2" name="selecciondelcelular">
                                <label class="form-check-label" for="flexSwitchCheckCelular">CELULARES</label>
                            </div>
                        </div>

                        <div class="col-md-2" id="fila1celular" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2celular" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcelular" id="modalcelularVerListadoButton">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3celular" style="display: none; font-family: 'Courier New', monospace;"></div>

                        <div class="col-md-2" id="fila4celular" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcelularinformacion">Remover Asignación</button>
                        </div>
                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  ACCESORIOS -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckacc" value="3" name="selecciondelacc">
                                <label class="form-check-label" for="flexSwitchCheckacc">ACCESORIOS</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1acc" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2acc" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalacc">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3acc" style="display: none;"></div>

                        <div class="col-md-2" id="fila4acc" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalaccinformacion">Remover Asignación</button>
                        </div>

                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  EDCOMUNICACION -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckedcomunicacion" value="4" name="selecciondeledcomunicacion">
                                <label class="form-check-label" for="flexSwitchCheckedcomunicacion">ELEMENTOS DE COMUNICACIÓN</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1edcomunicacion" style="display: none;">
                            <!-- CONSULTA POR MEDIO DE CHECKS -->

                            <?php
                            include '../../conexionbd.php';
                            $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_edcomunicacion]";
                            $resultado = odbc_exec($conexion, $consulta);
                            ?>

                            <form>
                                <?php
                                while ($fila = odbc_fetch_array($resultado)) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre_descripcion'];
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="descripcion" id="descripcion_<?php echo $id; ?>" value="<?php echo $id; ?>" onchange="updateDescripcionedcomunicacion(this)">
                                        <label class="form-check-label" for="descripcion_<?php echo $id; ?>">
                                            <?php echo $nombre; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="tipo_edcomunicacion" id="tipo_edcomunicacion" value="">

                            </form>
                        </div>

                        <div class="col-md-2" id="fila2edcomunicacion" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaledcomunicacion">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3edcomunicacion" style="display: none;"></div>

                        <div class="col-md-2" id="fila4edcomunicacion" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaledcomunicacioninformacion">Remover Asignación</button>
                        </div>

                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  PERIFERICOS -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckperifericos" value="5" name="selecciondelperifericos">
                                <label class="form-check-label" for="flexSwitchCheckperifericos">PERIFERICOS</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1perifericos" style="display: none;">
                            <!-- CONSULTA POR MEDIO DE CHECKS -->

                            <?php
                            include '../../conexionbd.php';
                            $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_perifericos]";
                            $resultado = odbc_exec($conexion, $consulta);
                            ?>

                            <form>
                                <?php
                                while ($fila = odbc_fetch_array($resultado)) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre_descripcion'];
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="descripcionperifericos" id="descripcionperifericos_<?php echo $id; ?>" value="<?php echo $id; ?>" onchange="updateDescripcionperifericos(this)">
                                        <label class="form-check-label" for="descripcionperifericos_<?php echo $id; ?>">
                                            <?php echo $nombre; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="tipo_perifericos" id="tipo_perifericos" value="">

                            </form>
                        </div>

                        <div class="col-md-2" id="fila2perifericos" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalperifericos">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3perifericos" style="display: none;"></div>

                        <div class="col-md-2" id="fila4perifericos" style="display: none;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalperifericosinformacion">Remover Asignación</button>
                        </div>

                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  ALMACENAMIENTO -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckalmacenamiento" value="6" name="selecciondelalmacenamiento">
                                <label class="form-check-label" for="flexSwitchCheckalmacenamiento">ALMACENAMIENTO</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1almacenamiento" style="display: none;">
                            <!-- CONSULTA POR MEDIO DE CHECKS -->

                            <?php
                            include '../../conexionbd.php';
                            $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_almacenamiento]";
                            $resultado = odbc_exec($conexion, $consulta);
                            ?>

                            <form>
                                <?php
                                while ($fila = odbc_fetch_array($resultado)) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre_descripcion'];
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="descripcionalmacenamiento" id="descripcionalmacenamiento_<?php echo $id; ?>" value="<?php echo $id; ?>" onchange="updateDescripcionalmacenamiento(this)">
                                        <label class="form-check-label" for="descripcionalmacenamiento_<?php echo $id; ?>">
                                            <?php echo $nombre; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="tipo_almacenamiento" id="tipo_almacenamiento" value="">

                            </form>
                        </div>

                        <div class="col-md-2" id="fila2almacenamiento" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalalmacenamiento">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3almacenamiento" style="display: none;"></div>

                        <div class="col-md-2" id="fila4almacenamiento" style="display: none;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalalmacenamientoinformacion">Remover Asignación</button>
                        </div>

                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  SIMCARD -->
                <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchChecksimcard" value="7" name="selecciondelsimcard">
                                <label class="form-check-label" for="flexSwitchChecksimcard">SIMCARD</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1simcard" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2simcard" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalsimcard">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3simcard" style="display: none;"></div>

                        <div class="col-md-2" id="fila4simcard" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalsimcardinformacion">Remover Asignación</button>
                        </div>

                    </div>
                </div>

                <!-- AQUI MUESTRA LAS SECCION  DVR -->
                <!-- <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckdvr" value="8" name="selecciondeldvr">
                                <label class="form-check-label" for="flexSwitchCheckdvr">DVR</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1dvr" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2dvr" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaldvr">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-4" id="fila3dvr" style="display: none;"></div>

                        <div class="col-md-2" id="fila4dvr" style="display: none;text-align: center;">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldvrinformacion">Remover Asignación</button>
                        </div>


                    </div>
                </div> -->

                <!-- AQUI MUESTRA LAS SECCION  CCTV -->
                <!-- <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckcctv" value="9" name="selecciondelcctv">
                                <label class="form-check-label" for="flexSwitchCheckcctv">CCTV</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1cctv" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2cctv" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcctv">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-5" id="fila3cctv" style="display: none;text-align: center;">

                        </div>

                    </div>
                </div> -->

                <!-- AQUI MUESTRA LAS SECCION  CCTV -->
                <!-- <div class="container" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchChecktorre" value="10" name="selecciondeltorre">
                                <label class="form-check-label" for="flexSwitchChecktorre">Torre</label>
                            </div>
                        </div>


                        <div class="col-md-2" id="fila1torre" style="display: none;">

                        </div>

                        <div class="col-md-2" id="fila2torre" style="display: none;">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaltorre">
                                Ver listado
                            </button>
                        </div>

                        <div class="col-md-5" id="fila3torre" style="display: none;text-align: center;">

                        </div>

                    </div>
                </div> -->


                <!-- BOTON DE GENERAR ACTA -->
                <div style="text-align: center;">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Generar Acta
                    </button>
                </div>


            <?php
            }
            ?>
        </section>



        <!-- MODAL DE COMPUTADORES-->
        <div class="modal fade" id="modalcomputador" tabindex="-1" aria-labelledby="modalcomputadorLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcomputadorLabel">
                            <h6>Equipo de Computo para el Cargo: <?php echo $cargo ?></h6>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE COMPUTADORES VER INFORMACION-->
        <div class="modal fade" id="modalcomputadorinformacion" tabindex="-1" aria-labelledby="modalcomputadorinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcomputadorinformacionLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE CELULARES -->
        <div class="modal fade" id="modalcelular" tabindex="-1" aria-labelledby="modalcelularLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcelularLabel">
                            <h6>Equipo Celular para el Cargo: <?php echo $cargo ?></h6>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE CELULARES VER INFORMACION -->
        <div class="modal fade" id="modalcelularinformacion" tabindex="-1" aria-labelledby="modalcelularinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcelularinformacionLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE ACCESORIOS-->
        <div class="modal fade" id="modalacc" tabindex="-1" aria-labelledby="modalaccLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalaccLabel">Listado de Accesorios</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalaccinformacion" tabindex="-1" aria-labelledby="modalaccinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalaccinformacionLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE EDCOMUNICACION -->
        <div class="modal fade" id="modaledcomunicacion" tabindex="-1" aria-labelledby="modaledcomunicacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaledcomunicacionLabel">Listado de Ed Comunicacion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE EDCOMUNICACION VER INFORMACION-->
        <div class="modal fade" id="modaledcomunicacioninformacion" tabindex="-1" aria-labelledby="modaledcomunicacioninformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaledcomunicacioninformacionLabel">Listado de Ed Comunicacion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE PERIFERICOS -->
        <div class="modal fade" id="modalperifericos" tabindex="-1" aria-labelledby="modalperifericosLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalperifericosLabel">Listado de Perifericos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE PERIFERICOS VER INFORMACION -->
        <div class="modal fade" id="modalperifericosinformacion" tabindex="-1" aria-labelledby="modalperifericosinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalperifericosinformacionLabel">Listado de Perifericos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE ALMACENAMIENTO -->
        <div class="modal fade" id="modalalmacenamiento" tabindex="-1" aria-labelledby="modalalmacenamientoLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalalmacenamientoLabel">Listado de Almacenamiento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE ALMACENAMIENTO VER INFORMACION-->
        <div class="modal fade" id="modalalmacenamientoinformacion" tabindex="-1" aria-labelledby="modalalmacenamientoinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalalmacenamientoinformacionLabel">Listado de Almacenamiento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE SIMCARD -->
        <div class="modal fade" id="modalsimcard" tabindex="-1" aria-labelledby="modalsimcardLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalsimcardLabel">Listado de SimCard</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE SIMCARD VER INFORMACION -->
        <div class="modal fade" id="modalsimcardinformacion" tabindex="-1" aria-labelledby="modalsimcardinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalsimcardinformacionLabel">Listado de SimCard</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE DVR -->
        <div class="modal fade" id="modaldvr" tabindex="-1" aria-labelledby="modaldvrLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaldvrLabel">Listado de Perifericos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE DVR VER INFORMACION-->
        <div class="modal fade" id="modaldvrinformacion" tabindex="-1" aria-labelledby="modaldvrinformacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaldvrinformacionLabel">DVR</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se llenará el contenido de la consulta  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DE CCTV -->
        <!-- <div class="modal fade" id="modalcctv" tabindex="-1" aria-labelledby="modalcctvLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalcctvLabel">Listado de CCTV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL DE TORRE -->
        <!-- <div class="modal fade" id="modaltorre" tabindex="-1" aria-labelledby="modaltorreLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaltorreLabel">Listado de Torre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL ACTA -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Acta</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <!-- .... -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <!-- <button type="button" class="btn btn-danger" id="descargarPDF">DESCARGAR</button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- enviar el nombre como parametro para asignacion -->
        <strong id="Usua_asigna" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>
        <!-- enviar el nombre como parametro para remover asignacion  -->
        <strong id="Usua_retira" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>



    </body>



    <!-- SCRIPT MODAL ACTA -->
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            // Obtén la cédula y el cargo del PHP
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            var cargo = '<?php echo $cargo; ?>'; // Obtener el cargo del PHP
            var nombreCompleto = '<?php echo $nombreCompleto; ?>'; // Obtener el nombre completo del PHP
            var empresaOption = $('#empresaOption').val();
            // Realiza la solicitud AJAX aquí
            $.ajax({
                url: 'acta2.php',
                method: 'GET',
                data: {
                    cedula: cedula,
                    cargo: cargo,
                    nombreCompleto: nombreCompleto,
                    empresa: empresaOptionValue

                }, // Envía la cédula, el cargo y el nombre completo como parámetros
                // dataType: 'html',
                success: function(response) {
                    $('#exampleModal .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX');
                    console.error('Estado:', status);
                    console.error('Error:', error);
                }
            });
        });
    </script>

    <script>
        function updateTipoComputador(radio) {
            document.getElementById('tipocomputador').value = radio.value;
        }

        // function updateTipoCelular(radio) {
        //     document.getElementById('tipocelular').value = radio.value;
        // }

        function updateDescripcionedcomunicacion(radio) {
            document.getElementById('tipo_edcomunicacion').value = radio.value;
        }

        function updateDescripcionperifericos(radio) {
            document.getElementById('tipo_perifericos').value = radio.value;
        }

        function updateDescripcionalmacenamiento(radio) {
            document.getElementById('tipo_almacenamiento').value = radio.value;
        }

        function updateDescripcionsimcard(radio) {
            document.getElementById('tipo_simcard').value = radio.value;
        }

        function updateDescripciondvr(radio) {
            document.getElementById('tipo_dvr').value = radio.value;
        }

        function updateDescripcioncctv(radio) {
            document.getElementById('tipo_cctv').value = radio.value;
        }

        function updateDescripciontorre(radio) {
            document.getElementById('tipo_torre').value = radio.value;
        }
    </script>

    <!-- SCRIPT DE CHECKS COMPUTADOR -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckDefault').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1').show();
                    $('#fila2').show();
                    $('#fila4').show();
                } else {
                    $('#fila1').hide();
                    $('#fila2').hide();
                    $('#fila3').hide();
                    $('#fila4').hide();
                }
            });

            $('input[name="tipo_comp"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2').show();
                } else {
                    $('#fila2').hide();
                }
            });

            $('#fila2 button').on('click', function() {
                $('#fila3').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS CELULARES -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckCelular').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1celular').show();
                    $('#fila2celular').show();
                    $('#fila3celular').show();
                    $('#fila4celular').show();
                } else {
                    $('#fila1celular').hide();
                    $('#fila2celular').hide();
                    $('#fila3celular').hide();
                    $('#fila4celular').hide();
                }
            });
        });
    </script>

    <!-- SCRIPT DE CHECKS ACCESORIOS -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckacc').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1acc').show();
                    $('#fila2acc').show();
                    $('#fila3acc').show();
                    $('#fila4acc').show();
                } else {
                    $('#fila1acc').hide();
                    $('#fila2acc').hide();
                    $('#fila3acc').hide();
                    $('#fila4acc').hide();
                }
            });

            $('input[name="descripcionacc"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2acc').show();
                } else {
                    $('#fila2acc').hide();
                }
            });

            $('#fila2acc button').on('click', function() {
                $('#fila3acc').show();
            });
        });
    </script>

    <!-- SCRIPT DE CHECKS EDCOMUNICACION -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckedcomunicacion').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1edcomunicacion').show();
                    $('#fila2edcomunicacion').show();
                    $('#fila3edcomunicacion').show();
                    $('#fila4edcomunicacion').show();
                } else {
                    $('#fila1edcomunicacion').hide();
                    $('#fila2edcomunicacion').hide();
                    $('#fila3edcomunicacion').hide();
                    $('#fila4edcomunicacion').hide();
                }
            });

            $('input[name="descripcion"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2edcomunicacion').show();
                } else {
                    $('#fila2edcomunicacion').hide();
                }
            });

            $('#fila2edcomuniacion button').on('click', function() {
                $('#fila3edcomunicacion').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS PERIFERICOS -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckperifericos').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1perifericos').show();
                    $('#fila2perifericos').show();
                    $('#fila3perifericos').show();
                    $('#fila4perifericos').show();
                } else {
                    $('#fila1perifericos').hide();
                    $('#fila2perifericos').hide();
                    $('#fila3perifericos').hide();
                    $('#fila4perifericos').hide();
                }
            });

            $('input[name="descripcionperifericos"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2perifericos').show();
                } else {
                    $('#fila2perifericos').hide();
                }
            });

            $('#fila2perifericos button').on('click', function() {
                $('#fila3perifericos').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS ALMACENAMIENTO -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckalmacenamiento').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1almacenamiento').show();
                    $('#fila2almacenamiento').show();
                    $('#fila3almacenamiento').show();
                    $('#fila4almacenamiento').show();
                } else {
                    $('#fila1almacenamiento').hide();
                    $('#fila2almacenamiento').hide();
                    $('#fila3almacenamiento').hide();
                    $('#fila4almacenamiento').hide();
                }
            });

            $('input[name="descripcionalmacenamiento"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2almacenamiento').show();
                } else {
                    $('#fila2almacenamiento').hide();
                }
            });

            $('#fila2almacenamiento button').on('click', function() {
                $('#fila3almacenamiento').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS SIMCARD -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchChecksimcard').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1simcard').show();
                    $('#fila2simcard').show();
                    $('#fila3simcard').show();
                    $('#fila4simcard').show();
                } else {
                    $('#fila1simcard').hide();
                    $('#fila2simcard').hide();
                    $('#fila3simcard').hide();
                    $('#fila4simcard').hide();
                }
            });

            $('input[name="descripcionsimcard"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2simcard').show();
                } else {
                    $('#fila2simcard').hide();
                }
            });

            $('#fila2simcard button').on('click', function() {
                $('#fila3simcard').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS DVR -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckdvr').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1dvr').show();
                    $('#fila2dvr').show();
                    $('#fila3dvr').show();
                    $('#fila4dvr').show();
                } else {
                    $('#fila1dvr').hide();
                    $('#fila2dvr').hide();
                    $('#fila3dvr').hide();
                    $('#fila4dvr').hide();
                }
            });

            $('input[name="descripciondvr"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2dvr').show();
                } else {
                    $('#fila2dvr').hide();
                }
            });

            $('#fila2dvr button').on('click', function() {
                $('#fila3dvr').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS CCTV -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckcctv').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1cctv').show();
                    $('#fila2cctv').show();
                    $('#fila3cctv').show();
                } else {
                    $('#fila1cctv').hide();
                    $('#fila2cctv').hide();
                    $('#fila3cctv').hide();
                }
            });

            $('input[name="descripcioncctv"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2cctv').show();
                } else {
                    $('#fila2cctv').hide();
                }
            });

            $('#fila2cctv button').on('click', function() {
                $('#fila3cctv').show();
            });
        });
    </script>
    <!-- SCRIPT DE CHECKS CCTV -->
    <script>
        $(document).ready(function() {
            $('#flexSwitchChecktorre').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila1torre').show();
                    $('#fila2torre').show();
                    $('#fila3torre').show();
                } else {
                    $('#fila1torre').hide();
                    $('#fila2torre').hide();
                    $('#fila3torre').hide();
                }
            });

            $('input[name="descripciontorre"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila2torre').show();
                } else {
                    $('#fila2torre').hide();
                }
            });

            $('#fila2torre button').on('click', function() {
                $('#fila3torre').show();
            });
        });
    </script>




    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN COMPUTADOR-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckDefault').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3();
                } else {
                    $('#fila3').hide();
                }
            });
            $('#fila2 button').on('click', function() {
                $('#fila3').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3();
            });
        });

        function actualizarFila3() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichacomputador.php',
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3').html(response);
                }
            });
        }
    </script>

    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN CELULAR-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckCelular').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3celular').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3celular();
                } else {
                    $('#fila3celular').hide();
                }
            });
            $('#fila2celular button').on('click', function() {
                $('#fila3celular').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3celular();
            });
        });

        function actualizarFila3celular() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichacelular.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3celular').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>

    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN ACCESORIOS-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckacc').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3acc').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3acc();
                } else {
                    $('#fila3acc').hide();
                }
            });
            $('#fila2acc button').on('click', function() {
                $('#fila3acc').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3acc();
            });
        });

        function actualizarFila3acc() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: '', // Archivo PHP que realizará la consulta
                url: 'fichatecnica/actualizarfichaaccesorios.php', // Archivo PHP que realizará la consulta
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3acc').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>

    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN EDCOMUNICACION-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckedcomunicacion').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3edcomunicacion').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3edcomunicacion();
                } else {
                    $('#fila3edcomunicacion').hide();
                }
            });
            $('#fila2edcomunicacion button').on('click', function() {
                $('#fila3edcomunicacion').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3edcomunicacion();
            });
        });

        function actualizarFila3edcomunicacion() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichaedcomunicacion.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3edcomunicacion').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>
    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN PERIFERICOS-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckperifericos').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3perifericos').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3perifericos();
                } else {
                    $('#fila3perifericos').hide();
                }
            });
            $('#fila2perifericos button').on('click', function() {
                $('#fila3perifericos').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3perifericos();
            });
        });

        function actualizarFila3perifericos() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichaperifericos.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3perifericos').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>
    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN ALMACENAMIENTO-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckalmacenamiento').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3almacenamiento').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3almacenamiento();
                } else {
                    $('#fila3almacenamiento').hide();
                }
            });
            $('#fila2almacenamiento button').on('click', function() {
                $('#fila3almacenamiento').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3almacenamiento();
            });
        });

        function actualizarFila3almacenamiento() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichaalmacenamiento.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3almacenamiento').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>
    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN SIMCARD-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchChecksimcard').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3simcard').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3simcard();
                } else {
                    $('#fila3simcard').hide();
                }
            });
            $('#fila2simcard button').on('click', function() {
                $('#fila3simcard').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3simcard();
            });
        });

        function actualizarFila3simcard() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichasimcard.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3simcard').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>
    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN DVR-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckdvr').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3dvr').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3dvr();
                } else {
                    $('#fila3dvr').hide();
                }
            });
            $('#fila2dvr button').on('click', function() {
                $('#fila3dvr').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3dvr();
            });
        });

        function actualizarFila3dvr() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichadvr.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3dvr').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>
    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN CCTV-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchCheckcctv').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3cctv').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3cctv();
                } else {
                    $('#fila3cctv').hide();
                }
            });
            $('#fila2cctv button').on('click', function() {
                $('#fila3cctv').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3cctv();
            });
        });

        function actualizarFila3cctv() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichacctv.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3cctv').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>
    <!-- SCRIPT Y AJAX DE ACTUALIZAR FICHA TECNICA DE ASIGNACIÓN TORRE-->
    <script>
        $(document).ready(function() {
            $('#flexSwitchChecktorre').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fila3torre').show();
                    // Realizar la llamada AJAX para actualizar #fila3
                    actualizarFila3torre();
                } else {
                    $('#fila3torre').hide();
                }
            });
            $('#fila2torre button').on('click', function() {
                $('#fila3torre').show();
                // Realizar la llamada AJAX para actualizar #fila3
                actualizarFila3torre();
            });
        });

        function actualizarFila3torre() {
            var cedula = '<?php echo $cedula; ?>'; // Obtener la cédula del PHP
            $.ajax({
                url: 'fichatecnica/actualizarfichatorre.php', // Archivo PHP que realizará la consulta
                method: 'GET',
                data: {
                    cedula: cedula
                }, // Pasar la cédula como parámetro
                success: function(response) {
                    $('#fila3torre').html(response); // Actualizar el contenido de #fila3 con la respuesta del servidor
                }
            });
        }
    </script>


    <!-- AJAX CONSULTAR Y LLEVAR INFORMACIÓN -->
    <script>
        $(document).ready(function() {
            $('#fila2 button').on('click', function() {
                var tipocomputador = $('#tipocomputador').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                // Obtén el contenido de la etiqueta <strong> con el id "nombreStrong"
                var nombre1 = $('#Usua_asigna').text();
                var nombre2 = $('#Usua_retira').text();

                $.ajax({
                    url: 'consulta_de_maquinas/consultacomputador.php',
                    type: 'POST',
                    data: {
                        tipocomputador: tipocomputador,
                        empresaOption: empresaOption,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalcomputador .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });
            });
        });

        // AJAX PARA DESCARTAR ASIGNACION
        $(document).ready(function() {
            $('#fila4 button').on('click', function() {
                var tipocomputador = $('#tipocomputador').val();
                var empresaOption = $('#empresaOption').val();

                // Obtén el contenido de la etiqueta <strong> con el id "nombreStrong"
                var nombre2 = $('#Usua_retira').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultacomputadorinformacion.php',
                    type: 'POST',
                    data: {
                        tipocomputador: tipocomputador,
                        empresaOption: empresaOption,
                        Usua_retira: nombre2, // Incluye el contenido de la etiqueta <strong> como parámetro

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalcomputadorinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });
            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE CELULARES -->
    <script>
        $(document).ready(function() {

            var nombre1 = $('#Usua_asigna').text();
            // Función para cargar información en el modal
            function cargarInformacionEnModal() {
                $.ajax({
                    url: 'consulta_de_maquinas/consultacelular.php',
                    type: 'POST',
                    data: {
                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",
                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>",
                        Usua_asigna: nombre1 // Incluye el contenido de la etiqueta <strong> como parámetro
                    },
                    success: function(response) {
                        $('#modalcelular .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });
            }

            // Asignar la función de carga al botón "Ver listado" de forma real
            $('#modalcelularVerListadoButton').on('click', function() {
                cargarInformacionEnModal();
            });
        });

        // AJAX PARA DESCARTAR ASIGNACION
        $(document).ready(function() {

            var nombre1 = $('#Usua_asigna').text();


            $('#fila4celular button').on('click', function() {
                $.ajax({
                    url: 'consultar_informacion_maquinas/consultacelularinformacion.php',
                    type: 'POST',
                    data: {


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",
                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>",
                        Usua_asigna: nombre1 // Incluye el contenido de la etiqueta <strong> como parámetro


                    },
                    success: function(response) {
                        $('#modalcelularinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });
            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE ACCESORIOS -->
    <script>
        // ASIGNAR
        $(document).ready(function() {

            var empresaOption = $('#empresaOption').val();
            var nombre1 = $('#Usua_asigna').text();

            $('#fila2acc button').on('click', function() {
                $.ajax({
                    url: 'consulta_de_maquinas/consultaaccesorios.php',
                    type: 'POST',
                    data: {

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>",

                        empresaOption: empresaOption,
                        Usua_asigna: nombre1
                    },
                    success: function(response) {
                        $('#modalacc .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });

        // REMOVER ASIGNACION
        $(document).ready(function() {
            $('#fila4acc button').on('click', function() {

                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultaaccesoriosinformacion.php',
                    type: 'POST',
                    data: {
                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>",

                        empresaOption: empresaOption,
                        Usua_asigna: nombre1
                    },
                    success: function(response) {
                        $('#modalaccinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE EDCOMUNICACION -->
    <script>
        // ASIGNAR
        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2edcomunicacion button').on('click', function() {
                var tipo_edcomunicacion = $('#tipo_edcomunicacion').val();
                var empresaOption = $('#empresaOption').val();

                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consulta_de_maquinas/consultaedcomunicacion.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_edcomunicacion: tipo_edcomunicacion,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modaledcomunicacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });

        // AJAX PARA REMOVER ASIGNACION
        $(document).ready(function() {
            $('#fila4edcomunicacion button').on('click', function() {

                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultaedcomunicacioninformacion.php',
                    type: 'POST',
                    data: {


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>",
                        Usua_asigna: nombre1 // Incluye el contenido de la etiqueta <strong> como parámetro
                    },
                    success: function(response) {
                        $('#modaledcomunicacioninformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE PERIFERICOS -->
    <script>
        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2perifericos button').on('click', function() {
                var tipo_perifericos = $('#tipo_perifericos').val();
                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consulta_de_maquinas/consultaperifericos.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_perifericos: tipo_perifericos,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalperifericos .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });

        // AJAX REMOVER ASIGNACION
        $(document).ready(function() {
            $('#fila4perifericos button').on('click', function() {
                var tipo_edcomunicacion = $('#tipo_edcomunicacion').val();
                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultaperifericosinformacion.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_edcomunicacion: tipo_edcomunicacion,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalperifericosinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE ALMACENAMIENTO -->
    <script>
        // ASIGNACION
         var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2almacenamiento button').on('click', function() {
                var tipo_almacenamiento = $('#tipo_almacenamiento').val();
                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consulta_de_maquinas/consultaalmacenamiento.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_almacenamiento: tipo_almacenamiento,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalalmacenamiento .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
        // REMOVER ASIGNACION
        $(document).ready(function() {
            $('#fila4almacenamiento button').on('click', function() {
                var tipo_almacenamiento = $('#tipo_almacenamiento').val();
                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultaalmacenamientoinformacion.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_almacenamiento: tipo_almacenamiento,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro


                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalalmacenamientoinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE SIMCARD -->
    <script>
        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2simcard button').on('click', function() {
                var tipo_simcard = $('#tipo_simcard').val();
                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consulta_de_maquinas/consultasimcard.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_simcard: tipo_simcard,
                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalsimcard .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });

        $(document).ready(function() {
            $('#fila4simcard button').on('click', function() {
                var tipo_simcard = $('#tipo_simcard').val();
                var empresaOption = $('#empresaOption').val();
                var nombre1 = $('#Usua_asigna').text();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultasimcardinformacion.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_simcard: tipo_simcard,
                        Usua_asigna: nombre1, // Incluye el contenido de la etiqueta <strong> como parámetro

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalsimcardinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE DVR -->
    <script>
        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2dvr button').on('click', function() {
                var tipo_dvr = $('#tipo_dvr').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consulta_de_maquinas/consultadvr.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_dvr: tipo_dvr,

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modaldvr .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });

        $(document).ready(function() {
            $('#fila4dvr button').on('click', function() {
                var tipo_dvr = $('#tipo_dvr').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultar_informacion_maquinas/consultasimcardinformacion.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_dvr: tipo_dvr,

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modaldvrinformacion .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE CCTV -->
    <script>
        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2cctv button').on('click', function() {
                var tipo_cctv = $('#tipo_cctv').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultas/consultacctv.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_cctv: tipo_cctv,

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modalcctv .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>
    <!-- AJAX PARA CONSULTA DE CCTV -->
    <script>
        var empresaOptionValue = "<?php echo $empresaOption; ?>";
        $(document).ready(function() {
            $('#fila2torre button').on('click', function() {
                var tipo_torre = $('#tipo_torre').val();
                var empresaOption = $('#empresaOption').val();

                var nombreCompleto = $('input[name="nombreCompleto"]').val(); // Obtén el valor del campo oculto
                var cedula = $('input[name="cedula"]').val(); // Obtén el valor del campo oculto
                var cargo = $('input[name="cargo"]').val(); // Obtén el valor del campo oculto

                $.ajax({
                    url: 'consultas/consultatorre.php',
                    type: 'POST',
                    data: {
                        empresa: empresaOptionValue,
                        tipo_torre: tipo_torre,

                        primernombre: "<?php echo htmlspecialchars($primernombre); ?>",
                        segundonombre: "<?php echo htmlspecialchars($segundonombre); ?>",
                        primerapellido: "<?php echo htmlspecialchars($primerapellido); ?>",
                        segundoapellido: "<?php echo htmlspecialchars($segundoapellido); ?>",

                        cedula: "<?php echo htmlspecialchars($cedula); ?>",
                        cargo: "<?php echo htmlspecialchars($cargo); ?>"
                    },
                    success: function(response) {
                        $('#modaltorre .modal-body').html(response); // Agrega los resultados al cuerpo del modal
                    }
                });

            });
        });
    </script>



    <script>
        document.getElementById('asisteInput').addEventListener('input', function() {
            var selectedValue = this.value;
            var cedulaIndex = selectedValue.lastIndexOf('-'); // Índice del último guión
            if (cedulaIndex !== -1) {
                this.value = selectedValue.substring(cedulaIndex + 1).trim(); // Eliminar espacio adicional antes de la cédula
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const asisteInput = document.getElementById('nombreInput');
            const identificacionInput = document.getElementById('identificacionInput');
            const asisteDatalist = document.getElementById('asiste');

            asisteInput.addEventListener('change', function() {
                const selectedOption = asisteDatalist.querySelector(`option[value="${asisteInput.value}"]`);
                if (selectedOption) {
                    const cedula = selectedOption.textContent.split(' - ')[1];
                    identificacionInput.value = cedula;
                } else {
                    identificacionInput.value = '';
                }
            });


            empresaSelect.addEventListener('change', function() {
                const selectedOptionValue = empresaSelect.value;
                asisteDatalist.innerHTML = ''; // Limpiar las opciones actuales

                if (selectedOptionValue === '1') {
                    // Consulta para Duquesa S.A. BIC
                    <?php
                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                    $result = odbc_exec($conexion, $query);

                    while ($admon = odbc_fetch_array($result)) {
                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                        echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                    }
                    ?>
                } else if (selectedOptionValue === '2') {
                    // Consulta para Palmeras del Llano S.A. BIC
                    <?php
                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM PALMERAS2013..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                    $result = odbc_exec($conexion2, $query);

                    while ($admon = odbc_fetch_array($result)) {
                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                        echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                    }
                    ?>
                } else if (selectedOptionValue === '3') {
                    // Consulta para Palmeras del Llano S.A. BIC
                    <?php
                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM J25..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                    $result = odbc_exec($conexion2, $query);

                    while ($admon = odbc_fetch_array($result)) {
                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                        echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                    }
                    ?>
                }

            });
        });
    </script>


    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>