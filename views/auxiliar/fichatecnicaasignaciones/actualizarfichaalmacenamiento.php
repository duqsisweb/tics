<style>
    .almacenamiento-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .almacenamiento-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .almacenamiento-section .btn-success {
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

    .almacenamiento-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .almacenamiento-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>

<section class="almacenamiento-section">
    <?php
    include '../../../conexionbd.php';
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

    $consulta = "SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[marca_almacenamiento] ,[modelo_almacenamiento] ,[descripcion_almacenamiento] ,[capacidad_almacenamiento] ,[tipo_almacenamiento] ,[caracteristica_almacenamiento] ,[sede_almacenamiento] ,[ubicacion_almacenamiento] ,[fecha_de_ingreso] ,[estado] ,[fecha_de_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[usua_asigna] ,[fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[estado_asignacion] ,[observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_almacenamiento] WHERE cedula = '$cedula'";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>"; // Mantener el formato monoespaciado

    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {
            $output .= "-------------------------------------\n";
            $output .= "Elemento: " . $fila['tipo_maquina'] . "\n";
            $output .= "Marca: " . $fila['marca_almacenamiento'] . "\n";
            $output .= "Modelo: " . $fila['modelo_almacenamiento'] . "\n";
            $output .= "Descripcion: " . $fila['descripcion_almacenamiento'] . "\n";
            $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion Disp ALMACENAMIENTO</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output; // Enviar la respuesta al cliente (JavaScript)

    ?>




    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalalmacenamiento">
        Ver Detalles
    </button>
</section>

<!-- MODAL DE COMPUTADORES-->
<div class="modal fade" id="modalalmacenamiento" tabindex="-1" aria-labelledby="modalalmacenamientoLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalalmacenamientoLabel">
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
                            <th scope="col">Caracteristica</th>
                            <th scope="col">Sede</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha Garantia</th>
                            <th scope="col">Fecha Crea</th>
                            <th scope="col">Usua Crea</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = "SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[marca_almacenamiento] ,[modelo_almacenamiento] ,[descripcion_almacenamiento] ,[capacidad_almacenamiento] ,[tipo_almacenamiento] ,[caracteristica_almacenamiento] ,[sede_almacenamiento] ,[ubicacion_almacenamiento] ,[fecha_de_ingreso] ,[estado] ,[fecha_de_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[usua_asigna] ,[fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[estado_asignacion] ,[observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_almacenamiento] where cedula= '$cedula'";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';

                                echo '<td>' . $fila['id'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['marca_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['modelo_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['descripcion_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['capacidad_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['tipo_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['caracteristica_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['sede_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['ubicacion_almacenamiento'] . '</td>';
                                echo '<td>' . $fila['estado'] . '</td>';
                                echo '<td>' . $fila['fecha_de_garantia'] . '</td>';
                                echo '<td>' . $fila['fecha_crea'] . '</td>';
                                echo '<td>' . $fila['usua_crea'] . '</td>';


                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de Almacenamiento</td></tr>';
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





