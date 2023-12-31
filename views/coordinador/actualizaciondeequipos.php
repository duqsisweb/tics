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


    <style>
        .hidden-cell {
            display: none;
        }

        .form-select-sm {
            width: 200px;
            /* Ajusta el ancho según tus necesidades. */
        }
    </style>

    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
        ?>

        <section style="margin-top: 100px;">

            <!-- NAVINGRESOS -->
            <?php require '../../views/navasignaciones.php'; ?>

            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container" style="text-align: center;">
                    <div>
                        <h3>Mantenimiento Correctivo</h3>
                    </div>
                </div>
            </div>

            <br>

            <div class="container-fluid" style="text-align:center;">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                            <thead>
                                <tr class="encabezado table-dark ">
                                    <th>ID</th>
                                    <th>TIPO MAQUINA</th>
                                    <th>SERVICE TAG</th>
                                    <th>SERIAL EQUIPO</th>
                                    <th>NOMBRE DEL EQUIPO</th>
                                    <th>SEDE</th>
                                    <th>EMPRESA</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>TIPO COMPUTADOR</th>
                                    <th>TIPO RAM</th>
                                    <th>MEMORIA RAM</th>
                                    <th>TIPO DISCO</th>
                                    <th>CAPACIDAD DE DISCO</th>
                                    <th>PROCESADOR</th>
                                    <th>PROPIETARIO</th>
                                    <th>PROVEEDOR</th>
                                    <th>SISTEMA OPERATIVO</th>
                                    <th>SERIAL CARGADOR</th>
                                    <th>DOMINIO</th>
                                    <th>TIPO USUARIO</th>
                                    <th>SERIAL ACTIVO</th>
                                    <th>FECHA INGRESO</th>
                                    <th>TARGETA DE VIDEO</th>
                                    <th>ESTADO</th>
                                    <th>GESTION</th>
                                    <th>FECHA DE GARANTIA</th>
                                    <th>AJUSTES</th>



                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $datosEquipos = obtenerDatosEquiposcomputadormantenimiento($conexion);

                                foreach ($datosEquipos as $row) {
                                    echo "<tr>";
                                    foreach ($row as $key => $value) {
                                        if ($key == '') {
                                            echo "<td>$value</td>";
                                        } else {
                                            echo "<td>" . $value . "</td>";
                                        }
                                    }

                                    // Agregar el botón "Editar" con el atributo data-id
                                    echo '<td><button type="button" class="btn btn-warning btn-editar" data-id="' . $row['id'] . '">Editar</button></td>';

                                    echo "</tr>";

                                    // Agregar un formulario de edición oculto para cada fila aqui comienza las ocultas
                                    echo "<tr style='display: none;' class='editar-form' id='editar-form-" . $row['id'] . "'>";
                                    foreach ($row as $key => $value) {

                                        if ($key === 'Sede') {
                                            // Agregar un campo de selección para la sede
                                            echo "<td class='campo-editable' data-sede='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Sede'>";
                                            // Obtén el valor original de la sede desde el atributo data-sede
                                            $sedeOriginal = $value;

                                            // Realiza la consulta a la base de datos para obtener las sedes
                                            $consultaSedes = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                            $resultadoSedes = odbc_exec($conexion, $consultaSedes);

                                            // Itera sobre los resultados y genera las opciones del select
                                            while ($filaSede = odbc_fetch_array($resultadoSedes)) {
                                                $idSede = $filaSede['id'];
                                                $nombreSede = $filaSede['nombre_sede'];
                                                // Verifica si esta opción es la original y márcala como seleccionada
                                                $selected = ($nombreSede == $sedeOriginal) ? "selected" : "";
                                                echo "<option value='$idSede' $selected>$nombreSede</option>";
                                            }

                                            // Libera recursos
                                            odbc_free_result($resultadoSedes);

                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Empresa') {
                                            // Agregar un campo de selección para la empresa
                                            echo "<td class='campo-editable' data-Empresa='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Empresa'>";

                                            // Obtén el valor original de la empresa desde el atributo data-empresa
                                            $empresaOriginal = $value;

                                            // Realiza la consulta a la base de datos para obtener las empresas
                                            $consultaEmpresas = "SELECT id, nombre_empresa FROM [ControlTIC].[dbo].[empresa]";
                                            $resultadoEmpresas = odbc_exec($conexion, $consultaEmpresas);

                                            // Itera sobre los resultados y genera las opciones del select
                                            while ($filaEmpresa = odbc_fetch_array($resultadoEmpresas)) {
                                                $idEmpresa = $filaEmpresa['id'];
                                                $nombreEmpresa = $filaEmpresa['nombre_empresa'];
                                                // Verifica si esta opción es la original y márcala como seleccionada
                                                $selected = ($nombreEmpresa == $empresaOriginal) ? "selected" : "";
                                                echo "<option value='$idEmpresa' $selected>$nombreEmpresa</option>";
                                            }

                                            // Libera recursos
                                            odbc_free_result($resultadoEmpresas);

                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Memoria_ram') {
                                            echo "<td class='campo-editable' data-memoria-ram='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Memoria_ram'>";

                                            $MemoriaramOriginal = $value;
                                            $consultaMemoriaram = "SELECT [id] ,[capacidad_ram] FROM [ControlTIC].[dbo].[capacidad_ram]";
                                            $resultadoMemoriaram = odbc_exec($conexion, $consultaMemoriaram);

                                            while ($filaMemoriaram = odbc_fetch_array($resultadoMemoriaram)) {
                                                $idMemoriaram = $filaMemoriaram['id'];
                                                $nombreMemoriaram = $filaMemoriaram['capacidad_ram'];
                                                // Verifica si esta opción es la original y márcala como seleccionada
                                                $selected = ($nombreMemoriaram == $MemoriaramOriginal) ? "selected" : "";
                                                echo "<option value='$idMemoriaram' $selected>$nombreMemoriaram</option>";
                                            }

                                            // Libera recursos
                                            odbc_free_result($resultadoMemoriaram);

                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Tipo_discoduro') {
                                            // Agregar un campo de selección para el tipo de disco
                                            echo "<td class='campo-editable' data-tipo-disco='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Tipo_discoduro'>";

                                            // Obtén el valor original del tipo de disco desde el atributo data-tipo-disco
                                            $tipoDiscoOriginal = $value;

                                            // Realiza la consulta a la base de datos para obtener los tipos de disco
                                            $consultaTiposDisco = "SELECT id, nombre_tipo_discoduro FROM [ControlTIC].[dbo].[tipo_discoduro]";
                                            $resultadoTiposDisco = odbc_exec($conexion, $consultaTiposDisco);

                                            // Itera sobre los resultados y genera las opciones del select
                                            while ($filaTipoDisco = odbc_fetch_array($resultadoTiposDisco)) {
                                                $idTipoDisco = $filaTipoDisco['id'];
                                                $nombreTipoDisco = $filaTipoDisco['nombre_tipo_discoduro'];
                                                // Verifica si esta opción es la original y márcala como seleccionada
                                                $selected = ($nombreTipoDisco == $tipoDiscoOriginal) ? "selected" : "";
                                                echo "<option value='$idTipoDisco' $selected>$nombreTipoDisco</option>";
                                            }

                                            // Libera recursos
                                            odbc_free_result($resultadoTiposDisco);

                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Capacidad_discoduro') {
                                            // Agregar un campo de selección para la capacidad del disco
                                            echo "<td class='campo-editable' data-capacidad-disco='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Capacidad_discoduro'>";

                                            // Obtén el valor original de la capacidad desde el atributo data-capacidad-disco
                                            $capacidadOriginal = $value;

                                            // Realiza la consulta a la base de datos para obtener las capacidades del disco
                                            $consultaCapacidades = "SELECT id, capacidad_discoduro FROM [ControlTIC].[dbo].[capacidad_discoduro]";
                                            $resultadoCapacidades = odbc_exec($conexion, $consultaCapacidades);

                                            // Itera sobre los resultados y genera las opciones del select
                                            while ($filaCapacidad = odbc_fetch_array($resultadoCapacidades)) {
                                                $idCapacidad = $filaCapacidad['id'];
                                                $capacidad = $filaCapacidad['capacidad_discoduro'];
                                                // Verifica si esta opción es la original y márcala como seleccionada
                                                $selected = ($capacidad == $capacidadOriginal) ? "selected" : "";
                                                echo "<option value='$idCapacidad' $selected>$capacidad</option>";
                                            }

                                            // Libera recursos
                                            odbc_free_result($resultadoCapacidades);

                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Sistema_Operativo') {
                                            // Agregar un campo de selección para el sistema operativo
                                            echo "<td class='campo-editable' data-sistema-operativo='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Sistema_Operativo'>";

                                            // Obtén el valor original del sistema operativo desde el atributo data-sistema-operativo
                                            $sistemaOperativoOriginal = $value;

                                            // Realiza la consulta a la base de datos para obtener los sistemas operativos
                                            $consultaSistemasOperativos = "SELECT id, nombre_sistema_operativo FROM [ControlTIC].[dbo].[sistema_operativo]";
                                            $resultadoSistemasOperativos = odbc_exec($conexion, $consultaSistemasOperativos);

                                            // Itera sobre los resultados y genera las opciones del select
                                            while ($filaSistemaOperativo = odbc_fetch_array($resultadoSistemasOperativos)) {
                                                $idSistemaOperativo = $filaSistemaOperativo['id'];
                                                $nombreSistemaOperativo = $filaSistemaOperativo['nombre_sistema_operativo'];
                                                // Verifica si esta opción es la original y márcala como seleccionada
                                                $selected = ($nombreSistemaOperativo == $sistemaOperativoOriginal) ? "selected" : "";
                                                echo "<option value='$idSistemaOperativo' $selected>$nombreSistemaOperativo</option>";
                                            }

                                            // Libera recursos
                                            odbc_free_result($resultadoSistemasOperativos);

                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Serial_cargador') {
                                            // Agregar un campo de texto para la RAM
                                            echo "<td class='campo-editable'><input type='text' name='Serial_cargador' value='$value'></td>";
                                        } else if ($key === 'Dominio') {
                                            // Agregar un campo de selección para el dominio
                                            echo "<td class='campo-editable' data-dominio='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Dominio'>";
                                            echo "<option value='SI' " . ($value === 'SI' ? 'selected' : '') . ">SI</option>";
                                            echo "<option value='NO' " . ($value === 'NO' ? 'selected' : '') . ">NO</option>";
                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Tipo_usuario') {
                                            // Agregar un campo de selección para el tipo de usuario
                                            echo "<td class='campo-editable' data-tipo-usuario='$value'>";
                                            echo "<select class='form-select form-select-sm' name='Tipo_usuario'>";
                                            echo "<option value='Administrador' " . ($value === 'Administrador' ? 'selected' : '') . ">Administrador</option>";
                                            echo "<option value='Estandar' " . ($value === 'Estandar' ? 'selected' : '') . ">Estandar</option>";
                                            echo "</select>";
                                            echo "</td>";
                                        } else if ($key === 'Service_tag') {
                                            echo "<td class=''><input type='text' name='Service_tag' value='$value' disabled ></td>";
                                        } else if ($key === 'Service_tag') {
                                            echo "<td class=''><input type='text' name='Service_tag' value='$value' disabled ></td>";
                                        } else if ($key === 'tipo_maquina') {
                                            echo "<td class=''><input type='text' name='tipo_maquina' value='$value' disabled ></td>";
                                        } else if ($key === 'Serial_equipo') {
                                            echo "<td class=''><input type='text' name='Serial_equipo' value='$value' disabled ></td>";
                                        } else if ($key === 'Nombre_equipo') {
                                            echo "<td class=''><input type='text' name='Nombre_equipo' value='$value' disabled ></td>";
                                        } else if ($key === 'Marca_computador') {
                                            echo "<td class=''><input type='text' name='Marca_computador' value='$value' disabled ></td>";
                                        } else if ($key === 'Modelo_computador') {
                                            echo "<td class=''><input type='text' name='Modelo_computador' value='$value' disabled ></td>";
                                        } else if ($key === 'Tipo_comp') {
                                            echo "<td class=''><input type='text' name='Tipo_comp' value='$value' disabled ></td>";
                                        } else if ($key === 'Tipo_ram') {
                                            echo "<td class=''><input type='text' name='tipo_memoria_ram' value='$value' disabled ></td>";
                                        } else if ($key === 'Procesador') {
                                            echo "<td class=''><input type='text' name='Procesador' value='$value' disabled ></td>";
                                        } else if ($key === 'Propietario') {
                                            echo "<td class=''><input type='text' name='Propietario' value='$value' disabled ></td>";
                                        } else if ($key === 'Proveedor') {
                                            echo "<td class=''><input type='text' name='Proveedor' value='$value' disabled ></td>";
                                        } else if ($key === 'Serial_activo_fijo') {
                                            echo "<td class=''><input type='text' name='Serial_activo_fijo' value='$value' disabled ></td>";
                                        } else if ($key === 'Fecha_ingreso_c') {
                                            echo "<td class=''><input type='text' name='Fecha_ingreso_c' value='$value' disabled ></td>";
                                        } else if ($key === 'Targeta_Video') {
                                            echo "<td class=''><input type='text' name='Targeta_Video' value='$value' disabled ></td>";
                                        } else if ($key === 'Estado') {
                                            echo "<td class=''><input type='text' name='Estado' value='$value' disabled ></td>";
                                        } else if ($key === 'Gestion') {
                                            echo "<td class=''><input type='text' name='Gestion' value='$value' disabled ></td>";
                                        } else {
                                            echo "<td class='campo-editable'>$value</td>";
                                        }
                                    }

                                    echo '<td class="campo-editable"><button type="button" class="btn btn-success btn-guardar" data-id="' . $row['id'] . '">Guardar</button></td>';
                                    echo '<td class="campo-editable"><button type="button" class="btn btn-danger btn-cancelar" data-id="' . $row['id'] . '">Cancelar</button></td>';
                                    echo "</tr>";
                                    // fin de campos

                                }


                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <!-- enviar el nombre como parametro -->
            <strong id="Usua_modifica" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>

        </section>

    </body>

    </html>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Inicio DataTable  elimina los duplicados en el excel y recarga la web-->
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
                buttons: [{
                    extend: 'excel',
                    text: 'Exportar Excel',
                    action: function(e, dt, button, config) {
                        // Filtrar los duplicados en la columna "ID"
                        var data = dt.rows().data().toArray();
                        var uniqueData = [];
                        var seen = {};

                        data.forEach(function(row) {
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
                        setTimeout(function() {
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


    <script>
        $(document).ready(function() {
            // Agregar un controlador de clic para los botones "Editar"
            $('.btn-editar').click(function() {
                // Obtener el ID de la fila a editar
                var id = $(this).data('id');

                // Ocultar todos los campos editables en el formulario de edición
                $('#mtable td.campo-editable').hide();

                // Mostrar el formulario de edición para la fila correspondiente
                $('#editar-form-' + id).show();

                // Mostrar los campos editables en el formulario de edición
                $('#editar-form-' + id + ' .campo-editable').show();
            });



            // Agregar un controlador de clic para los botones "Guardar"
            $('.btn-guardar').click(function() {
                // Obtener el ID de la fila a guardar los cambios
                var id = $(this).data('id');

                // Aquí puedes agregar el código para guardar los cambios en el servidor
                // Por ejemplo, puedes usar AJAX para enviar los datos al servidor y actualizar la base de datos

                // Después de guardar los cambios, puedes ocultar el formulario de edición y mostrar los campos originales
                $('#editar-form-' + id).hide();
                $('#mtable td.campo-editable').show();
            });

            // Agregar un controlador de clic para los botones "Cancelar"
            $('.btn-cancelar').click(function() {
                // Obtener el ID de la fila a cancelar la edición
                var id = $(this).data('id');

                // Ocultar el formulario de edición
                $('#editar-form-' + id).hide();

                // Mostrar la fila original sin cambios
                $('#mtable th.campo-editable').show();
                $('#mtable tbody td.campo-editable').show();
            });
        });
    </script>

    <!-- AJAX PARA ENVIAR LA INFO -->
    <script>
        $(document).ready(function() {
            $('.btn-guardar').click(function() {
                var id = $(this).data('id');
                var camposActualizados = {};

                // Obtener el contenido del elemento <strong> con el id "Usua_modifica"
                var nombreUsuario = $('#Usua_modifica').text().trim();
                camposActualizados['Usua_modifica'] = nombreUsuario;

                // Recopilar los valores de los campos editables
                $('#editar-form-' + id + ' input[type="text"], #editar-form-' + id + ' select').each(function() {
                    var nombreCampo = $(this).attr('name');
                    var valorCampo = $(this).val();
                    camposActualizados[nombreCampo] = valorCampo;
                });

                // Agregar el ID a los campos actualizados
                camposActualizados['id'] = id;

                // Mostrar SweetAlert2 para confirmación
                Swal.fire({
                    title: '¿Desea guardar los cambios?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `No guardar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la solicitud AJAX si se confirmó
                        $.ajax({
                            type: "POST",
                            url: "ajax_mantenimiento_correctivo/actualizar_equipo.php",
                            data: camposActualizados,
                            success: function(response) {
                                console.log("Respuesta del servidor:", response);
                                Swal.fire('¡Guardado!', '', 'success');
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            },
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Los cambios no se guardan', '', 'info');
                    }
                });
            });
        });
    </script>



<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>