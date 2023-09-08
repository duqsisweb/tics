<style>
    .computadora-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .computadora-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .computadora-section .btn-success {
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

    .computadora-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .computadora-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>


<? $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX 
?>


<section class="computadora-section">
    <?php
    include '../../../conexionbd.php';

    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

    $consulta = "SELECT [id] ,[tipo_maquina] ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,[Sede] ,[Empresa] ,[Marca_computador] ,[Modelo_computador] ,[Tipo_comp] ,[Tipo_ram] ,[Memoria_ram] ,[Tipo_discoduro] ,[Capacidad_discoduro] ,[Procesador] ,[Propietario] ,[Proveedor] ,[Sistema_Operativo] ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso] ,[Targeta_Video] ,[Estado] ,[Gestion] ,[Fecha_garantia] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] ,[Usua_asigna] ,[Fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] FROM [ControlTIC].[dbo].[asignacion_computador] WHERE cedula = '$cedula'";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>";

    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {
            $output .= "-------------------------------------\n";
            $output .= "Nombre del equipo: " . $fila['Nombre_equipo'] . "\n";
            $output .= "Marca del computador: " . $fila['Marca_computador'] . "\n";
            $output .= "Memoria RAM: " . $fila['Memoria_ram'] . "\n";
            $output .= "Capacidad del disco duro: " . $fila['Capacidad_discoduro'] . "\n";
            $output .= "Procesador: " . $fila['Procesador'] . "\n";
            $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de COMPUTADOR</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output;
    ?>

    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcomputadorasigna">
        Ver Detalles
    </button>

</section>

<!-- MODAL DE COMPUTADORES-->
<div class="modal fade" id="modalcomputadorasigna" tabindex="-1" aria-labelledby="modalcomputadorasignaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalcomputadorasignaLabel">
                    <?php echo $cedula ?></h6>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Dentro del modal-body -->
            <div class="modal-body">
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">
                          
                            <th>Nombre del equipo</th>
                            <th>Marca del computador</th>
                            <th>Memoria RAM</th>
                            <th>Capacidad del disco duro</th>
                            <th>Procesador</th>
                            <th>Tipo de máquina</th>
                            <th>Service Tag</th>
                            <th>Serial del equipo</th>
                            <th>Sede</th>
                            <th>Empresa</th>
                            <th>Modelo del computador</th>
                            <th>Tipo de computador</th>
                            <th>Tipo de RAM</th>
                            <th>Tipo de disco duro</th>
                            <th>Propietario</th>
                            <th>Proveedor</th>
                            <th>Sistema Operativo</th>
                            <th>Serial del cargador</th>
                            <th>Dominio</th>
                            <th>Tipo de usuario</th>
                            <th>Serial activo fijo</th>
                            <th>Fecha de ingreso</th>
                            <th>Tarjeta de video</th>
                            <th>Estado</th>
                            <th>Gestión</th>
                            <!-- <th>Fecha de garantía</th> -->
                            <th>Fecha de creación</th>
                            <th>Usuario que creó</th>
                            <!-- <th>Fecha de modificación</th> -->
                            <!-- <th>Usuario que modificó</th> -->
                            <th>Usuario que asignó</th>
                            <th>Fecha de asignación</th>
                            <!-- <th>Cédula</th>
                            <th>Cargo</th>
                            <th>Primer Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th> -->
                            <th>Estado de asignación</th>
                            <!-- <th>Observaciones de desasignación</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = "SELECT [id_asignacion], [id], [tipo_maquina], [Service_tag], [Serial_equipo], [Nombre_equipo], [Sede], [Empresa], [Marca_computador], [Modelo_computador], [Tipo_comp], [Tipo_ram], [Memoria_ram], [Tipo_discoduro], [Capacidad_discoduro], [Procesador], [Propietario], [Proveedor], [Sistema_Operativo], [Serial_cargador], [Dominio], [Tipo_usuario], [Serial_activo_fijo], [Fecha_ingreso], [Targeta_Video], [Estado], [Gestion], [Fecha_garantia], [Fecha_crea], [Usua_crea], [Fecha_modifica], [Usua_modifica], [Usua_asigna], [Fecha_asigna], [cedula], [cargo], [primernombre], [segundonombre], [primerapellido], [segundoapellido], [estado_asignacion], [observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_computador] WHERE cedula = '$cedula'";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';
                       
                                echo '<td>' . $fila['Nombre_equipo'] . '</td>';
                                echo '<td>' . $fila['Marca_computador'] . '</td>';
                                echo '<td>' . $fila['Memoria_ram'] . '</td>';
                                echo '<td>' . $fila['Capacidad_discoduro'] . '</td>';
                                echo '<td>' . $fila['Procesador'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['Service_tag'] . '</td>';
                                echo '<td>' . $fila['Serial_equipo'] . '</td>';
                                echo '<td>' . $fila['Sede'] . '</td>';
                                echo '<td>' . $fila['Empresa'] . '</td>';
                                echo '<td>' . $fila['Modelo_computador'] . '</td>';
                                echo '<td>' . $fila['Tipo_comp'] . '</td>';
                                echo '<td>' . $fila['Tipo_ram'] . '</td>';
                                echo '<td>' . $fila['Tipo_discoduro'] . '</td>';
                                echo '<td>' . $fila['Propietario'] . '</td>';
                                echo '<td>' . $fila['Proveedor'] . '</td>';
                                echo '<td>' . $fila['Sistema_Operativo'] . '</td>';
                                echo '<td>' . $fila['Serial_cargador'] . '</td>';
                                echo '<td>' . $fila['Dominio'] . '</td>';
                                echo '<td>' . $fila['Tipo_usuario'] . '</td>';
                                echo '<td>' . $fila['Serial_activo_fijo'] . '</td>';
                                echo '<td>' . $fila['Fecha_ingreso'] . '</td>';
                                echo '<td>' . $fila['Targeta_Video'] . '</td>';
                                echo '<td>' . $fila['Estado'] . '</td>';
                                echo '<td>' . $fila['Gestion'] . '</td>';
                                // echo '<td>' . $fila['Fecha_garantia'] . '</td>';
                                echo '<td>' . $fila['Fecha_crea'] . '</td>';
                                echo '<td>' . $fila['Usua_crea'] . '</td>';
                                // echo '<td>' . $fila['Fecha_modifica'] . '</td>';
                                // echo '<td>' . $fila['Usua_modifica'] . '</td>';
                                echo '<td>' . $fila['Usua_asigna'] . '</td>';
                                echo '<td>' . $fila['Fecha_asigna'] . '</td>';
                                // echo '<td>' . $fila['cedula'] . '</td>';
                                // echo '<td>' . $fila['cargo'] . '</td>';
                                // echo '<td>' . $fila['primernombre'] . '</td>';
                                // echo '<td>' . $fila['segundonombre'] . '</td>';
                                // echo '<td>' . $fila['primerapellido'] . '</td>';
                                // echo '<td>' . $fila['segundoapellido'] . '</td>';
                                echo '<td>' . $fila['estado_asignacion'] . '</td>';
                                // echo '<td>' . $fila['observaciones_desasigna'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de computadoras</td></tr>';
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


    <!-- Inicio DataTable -->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtable').DataTable({
                info: false,
                select: true,
                destroy: true,
                jQueryUI: true,
                paginate: true,
                iDisplayLength: 30,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                    // 'copy', 'csv', 'excel'
                ],
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros por página.',
                    zeroRecords: 'Lo sentimos. No se encontraron registros.',
                    info: 'Mostrando: _START_ de _END_ - Total registros: _TOTAL_',
                    infoEmpty: 'No hay registros aún.',
                    infoFiltered: '(filtrados de un total de _MAX_ registros)',
                    search: 'Búsqueda',
                    LoadingRecords: 'Cargando ...',
                    Processing: 'Procesando...',
                    SearchPlaceholder: 'Comience a teclear...',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente',
                    }
                }
            });
        });
    </script>
    <!-- Fin DataTable -->

