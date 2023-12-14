<style>
    .simcard-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .simcard-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .simcard-section .btn-success {
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

    .simcard-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .simcard-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>




<section class="simcard-section">

    <?php
    include '../../../conexionbd.php';
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX
    $consulta = " SELECT count(id) as TOTAL
            FROM [ControlTIC].[dbo].historial_simcard
            WHERE cedula = '$cedula' and descripcionmov LIKE '%SE ELIMINO ASIGNACION DE LA LINEA SIMCARD%' ";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>"; // Mantener el formato monoespaciado
    
    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {
            $output .= "-------------------------------------\n";
            $output .= "TOTAL DE SIMCARDS O LINEAS DEVUELTOS: " . $fila['TOTAL'] . "\n";
            $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin retiro de SIM CARD</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output; // Enviar la respuesta al cliente (JavaScript)
    
    ?>


    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalsimcardasigna">
        Ver Detalles
    </button>
</section>

<!-- MODAL DE COMPUTADORES-->
<div class="modal fade" id="modalsimcardasigna" tabindex="-1" aria-labelledby="modalsimcardasignaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalsimcardasignaLabel">
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
                            <th scope="col">Número de linea</th>
                            <th scope="col">Nombre Plan</th>
                            <th scope="col">Fecha Apertura</th>
                            <th scope="col">Valor Plan</th>
                            <th scope="col">Operador</th>
                            <th scope="col">Cod Cliente</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col">Fecha Fin Plan</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = "SELECT TOP (1000) [id_historial]
                        ,[id]
                        ,[tipo_maquina]
                        ,[numero_linea]
                        ,[nombre_plan]
                        ,[fecha_apertura]
                        ,[valor_plan]
                        ,[operador]
                        ,[cod_cliente]
                        ,[observaciones_sim]
                        ,[fecha_fin_plan]
                        ,[estado]
                        ,[gestion]
                        ,[fecha_crea]
                        ,[usua_crea]
                        ,[fecha_modifica]
                        ,[usua_modifica]
                        ,[fecha_asigna]
                        ,[usua_asigna]
                        ,[cedula]
                        ,[cargo]
                        ,[primernombre]
                        ,[segundonombre]
                        ,[primerapellido]
                        ,[segundoapellido]
                        ,[empresa]
                        ,[estado_asignacion]
                        ,[observaciones_asigna_sim]
                        ,[link_sim_asigna]
                        ,[observaciones_desasigna_sim]
                        ,[link_sim_desasigna]
                        ,[fechamov]
                        ,[descripcionmov]
                        ,[usuamov]
                    FROM [ControlTIC].[dbo].[historial_simcard]
                    WHERE cedula = '$cedula' and descripcionmov LIKE 'SE ELIMINO ASIGNACION DE LA LINEA SIMCARD'";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';
                                echo '<td>' . $fila['id'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['numero_linea'] . '</td>';
                                echo '<td>' . $fila['nombre_plan'] . '</td>';
                                echo '<td>' . $fila['fecha_apertura'] . '</td>';
                                echo '<td>' . $fila['valor_plan'] . '</td>';
                                echo '<td>' . $fila['operador'] . '</td>';
                                echo '<td>' . $fila['cod_cliente'] . '</td>';
                                echo '<td>' . $fila['observaciones_sim'] . '</td>';
                                echo '<td>' . $fila['fecha_fin_plan'] . '</td>';
                                echo '<td>' . $fila['fechamov'] . '</td>';
                                echo '<td>' . $fila['descripcionmov'] . '</td>';
                                echo '<td>' . $fila['usuamov'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de Sim Card</td></tr>';
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