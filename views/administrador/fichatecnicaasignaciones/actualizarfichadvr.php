<style>
    .dvr-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .dvr-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .dvr-section .btn-success {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        /* Asegura que esté por encima del contenido */
        opacity: 0;
        /* Botón oculto por defecto */
        transition: opacity 0.6s;
        /* Agrega una transición suave */
    }

    .dvr-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .dvr-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>

<section class="dvr-section">

    <?php
    include '../../../conexionbd.php';
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX
    $consulta = "SELECT marca_dvr FROM ControlTIC..asignacion_dvr WHERE cedula = '$cedula'";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>"; // Mantener el formato monoespaciado

    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {
            $output .= "-------------------------------------\n";
            $output .= "Marca del Equipoo: " . $fila['marca_dvr'] . "\n";
            $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de DVR </strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output; // Enviar la respuesta al cliente (JavaScript)


    ?>



    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaldvrasigna">
        Ver Detalles
    </button>
</section>

<!-- MODAL DE COMPUTADORES-->
<div class="modal fade" id="modaldvrasigna" tabindex="-1" aria-labelledby="modaldvrasignaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modaldvrasignaLabel">
                    <?php echo $cedula ?></h6>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Dentro del modal-body -->
            <div class="modal-body">
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">

                            <th scope="col">ID</th>
                            <th scope="col">Tipo de Máquina</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Sede</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Software</th>
                            <th scope="col">Fecha Ingreso</th>
                            <th scope="col">Num Canales</th>
                            <th scope="col">Num Discos</th>
                            <th scope="col">Dias Grabación</th>
                            <th scope="col">Ip DVR</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha Garantia</th>
                            <th scope="col">Fecha Crea</th>
                            <th scope="col">Usua Crea</th>
                            <th scope="col">Fecha Modifica</th>
                            <th scope="col">Usuario Modifica</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = "SELECT [id_asignacion] ,[id] ,[tipo_maquina] ,[marca_dvr] ,[modelo_dvr] ,[descripcion_dvr] ,[capacidad_dvr] ,[tipo_dvr] ,[sede_dvr] ,[ubicacion_dvr] ,[software] ,[fecha_ingreso] ,[num_canales] ,[num_discos] ,[dias_grabacion] ,[ip_dvr] ,[estado] ,[fecha_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[fecha_asigna] ,[usua_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[estado_asignacion] ,[observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_dvr] where cedula= '$cedula'";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';

                                echo '<td>' . $fila['id'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['marca_dvr'] . '</td>';
                                echo '<td>' . $fila['modelo_dvr'] . '</td>';
                                echo '<td>' . $fila['descripcion_dvr'] . '</td>';
                                echo '<td>' . $fila['capacidad_dvr'] . '</td>';
                                echo '<td>' . $fila['tipo_dvr'] . '</td>';
                                echo '<td>' . $fila['sede_dvr'] . '</td>';
                                echo '<td>' . $fila['ubicacion_dvr'] . '</td>';
                                echo '<td>' . $fila['software'] . '</td>';
                                echo '<td>' . $fila['fecha_ingreso'] . '</td>';
                                echo '<td>' . $fila['num_canales'] . '</td>';
                                echo '<td>' . $fila['num_discos'] . '</td>';
                                echo '<td>' . $fila['dias_grabacion'] . '</td>';
                                echo '<td>' . $fila['ip_dvr'] . '</td>';
                                echo '<td>' . $fila['estado'] . '</td>';
                                echo '<td>' . $fila['fecha_garantia'] . '</td>';
                                echo '<td>' . $fila['fecha_crea'] . '</td>';
                                echo '<td>' . $fila['usua_crea'] . '</td>';
                                echo '<td>' . $fila['fecha_modifica'] . '</td>';
                                echo '<td>' . $fila['usua_modifica'] . '</td>';

                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de DVR</td></tr>';
                        }

                        odbc_close($conexion);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>



