<style>
    .celular-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .celular-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .celular-section .btn-success {
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

    .celular-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .celular-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>

<section class="celular-section">
    <?php
    include '../../../conexionbd.php';
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX
    
    $consulta = " SELECT count(id) as TOTAL
    FROM [ControlTIC].[dbo].[historial_celular] 
    WHERE cedula = '$cedula' and descripcionmov LIKE '%SE ELIMINO ASIGNACION DE UN CELULAR%' ";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>"; // Mantener el formato monoespaciado
    
    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {
            $output .= "-------------------------------------\n";
            $output .= "TOTAL CELULARES DEVUELTOS: " . $fila['TOTAL'] . "\n";
            $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin retiro de CELULAR</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output; // Enviar la respuesta al cliente (JavaScript)
    
    ?>


    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalcelularasigna">
        Ver Detalles
    </button>

</section>

<!-- MODAL DE CELULARES-->
<div class="modal fade" id="modalcelularasigna" tabindex="-1" aria-labelledby="modalcelularasignaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalcelularasignaLabel">
                    <h6>
                        <?php echo $cedula ?>
                    </h6>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Dentro del modal-body -->
            <div class="modal-body">

                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0"
                    style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">

                            <th scope="col">ID</th>
                            <th scope="col">Tipo de Máquina</th>
                            <th scope="col">IMEI</th>
                            <th scope="col">Serial de Equipo Celular</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">RAM Celular</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Gestión</th>
                            <th scope="col">Fecha de Garantia</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = " SELECT [id_historial]
                        ,[id]
                        ,[tipo_maquina]
                        ,[imei]
                        ,[serial_equipo_celular]
                        ,[marca]
                        ,[modelo]
                        ,[fecha_ingreso_cel]
                        ,[capacidad]
                        ,[ram_celular]
                        ,[estado]
                        ,[gestion]
                        ,[fecha_garantia_cel]
                        ,[fecha_crea]
                        ,[usua_crea]
                        ,[fecha_modifica]
                        ,[usua_modifica]
                        ,[usua_asigna]
                        ,[fecha_asigna]
                        ,[cedula]
                        ,[cargo]
                        ,[primernombre]
                        ,[segundonombre]
                        ,[primerapellido]
                        ,[segundoapellido]
                        ,[empresa]
                        ,[estado_asignacion]
                        ,[observaciones_asigna]
                        ,[link_celular_asigna]
                        ,[observaciones_desasigna]
                        ,[link_celular_desasigna]
                        ,[fechamov]
                        ,[descripcionmov]
                        ,[usuamov]
                    FROM [ControlTIC].[dbo].[historial_celular] 
                    WHERE cedula = '$cedula' and descripcionmov LIKE '%SE ELIMINO ASIGNACION DE UN CELULAR%' ";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';

                                echo '<td>' . $fila['id'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['imei'] . '</td>';
                                echo '<td>' . $fila['serial_equipo_celular'] . '</td>';
                                echo '<td>' . $fila['marca'] . '</td>';
                                echo '<td>' . $fila['modelo'] . '</td>';
                                echo '<td>' . $fila['capacidad'] . '</td>';
                                echo '<td>' . $fila['ram_celular'] . '</td>';
                                echo '<td>' . $fila['estado'] . '</td>';
                                echo '<td>' . $fila['gestion'] . '</td>';
                                echo '<td>' . $fila['fecha_garantia_cel'] . '</td>';
                                echo '<td>' . $fila['fechamov'] . '</td>';
                                echo '<td>' . $fila['descripcionmov'] . '</td>';
                                echo '<td>' . $fila['usuamov'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de Celulares</td></tr>';
                        }

                        odbc_close($conexion);
                        ?>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        id="saveChangesModalButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inicio DataTable  elimina los duplicados en el excel y recarga la web-->
<script type="text/javascript">
    $(document).ready(function () {
        var lenguaje = $('#mtable').DataTable({
            info: false,
            select: true,
            destroy: true,
            jQueryUI: true,
            paginate: true,
            iDisplayLength: 30,
            searching: true,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Exportar Excel',
                action: function (e, dt, button, config) {
                    // Filtrar los duplicados en la columna "ID"
                    var data = dt.rows().data().toArray();
                    var uniqueData = [];
                    var seen = {};

                    data.forEach(function (row) {
                        var id = row[0]; // Cambia el índice 0 al que corresponde a la columna "ID"
                        if (!seen[id]) {
                            uniqueData.push(row);
                            seen[id] = true;
                        }
                    });

                    dt.clear();
                    dt.rows.add(uniqueData);
                    dt.draw();

                    // Ocultar las filas de edición antes de exportar
                    $('.editar-form').hide();
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
                    // Restaurar los datos originales
                    dt.clear();
                    dt.rows.add(data);
                    dt.draw();

                    // Mostrar las filas de edición nuevamente después de exportar
                    $('.editar-form').show();

                    // Recargar la página después de la exportación
                    setTimeout(function () {
                        location.reload();
                    }, 1000); // La recarga se produce después de 1 segundo (1000 ms)
                }
            }],
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