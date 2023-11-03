<style>
    .edcomunicacion-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .edcomunicacion-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .edcomunicacion-section .btn-success {
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

    .edcomunicacion-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .edcomunicacion-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>

<section class="edcomunicacion-section">

    <?php
    include '../../../conexionbd.php';
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

    $consulta = "SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[marca_edcomunicacion] ,[modelo_edcomunicacion] ,[descripcion_edcomunicacion] ,[serial_edcomunicacion] ,[fecha_de_ingreso_edc] ,[estado] ,[placa_activo_edcomunicacion] ,[sede_edcomunicacion] ,[ubicacion_edcomunicacion] ,[observaciones_edcomunicacion] ,[gestion_edcomunicacion] ,[fecha_garantia_edc] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[usua_asigna] ,[fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[estado_asignacion] ,[observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_edcomunicacion] WHERE cedula = '$cedula' and estado_asignacion = 'VIGENTE' ";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>"; // Mantener el formato monoespaciado

    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {
            $output .= "-------------------------------------\n";
            $output .= "Elemento: " . $fila['tipo_maquina'] . "\n";
            $output .= "Marca del Equipo: " . $fila['marca_edcomunicacion'] . "\n";
            $output .= "Modelo del Equipo:" . $fila['modelo_edcomunicacion'] . "\n";
            $output .= "Observaciones:" . $fila['observaciones_edcomunicacion'] . "\n";
            $output .= "Ubicación: " . $fila['ubicacion_edcomunicacion'] . "\n";
            $output .= "Serial: " . $fila['serial_edcomunicacion'] . "\n";
            $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de ED COMUNICACIÓN</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output; // Enviar la respuesta al cliente (JavaScript)

    ?>



    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaledcomunicacionasigna">
        Ver Detalles
    </button>
</section>

<!-- MODAL DE COMPUTADORES-->
<div class="modal fade" id="modaledcomunicacionasigna" tabindex="-1" aria-labelledby="modaledcomunicacionasignaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modaledcomunicacionasignaLabel">
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
                            <th scope="col">Serial</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Placa Activo</th>
                            <th scope="col">Sede</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">observaciones_edcomunicacion</th>
                            <th scope="col">Gestion</th>
                      
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = " SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[marca_edcomunicacion] ,[modelo_edcomunicacion] ,[descripcion_edcomunicacion] ,[serial_edcomunicacion] ,[fecha_de_ingreso_edc] ,[estado] ,[placa_activo_edcomunicacion] ,[sede_edcomunicacion] ,[ubicacion_edcomunicacion] ,[observaciones_edcomunicacion] ,[gestion_edcomunicacion] ,[fecha_garantia_edc] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[usua_asigna] ,[fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[estado_asignacion] ,[observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_edcomunicacion] WHERE cedula = '$cedula' and estado_asignacion = 'VIGENTE' ";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';

                                echo '<td>' . $fila['id'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['marca_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['modelo_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['descripcion_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['serial_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['estado'] . '</td>';
                                echo '<td>' . $fila['placa_activo_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['sede_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['ubicacion_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['observaciones_edcomunicacion'] . '</td>';
                                echo '<td>' . $fila['gestion_edcomunicacion'] . '</td>';

                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de elementos de Comunicación</td></tr>';
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





