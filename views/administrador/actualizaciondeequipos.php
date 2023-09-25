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

        <section style="margin-top: 100px;">

            <!-- NAVINGRESOS -->
            <?php require '../../views/navasignaciones.php'; ?>

            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container" style="text-align: center;">
                    <div>
                        <h3>Actualización de Equipos</h3>
                    </div>
                </div>
            </div>

            <div class="container-fluid" style="text-align:center;">
                <div class="row">
                    <div class="col-md-12">
                        <p class="d-inline-flex gap-1">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Computadores
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                                    <thead>
                                        <tr class="encabezado table-dark">
                                            <th>ID</th>
                                            <th>SERVICE-T</th>
                                            <th>SERIAL</th>
                                            <th>NOMBRE EQUIPO</th>
                                            <th>SEDE</th>
                                            <th>EMPRESA</th>
                                            <th>MARCA</th>
                                            <th>MODELO</th>
                                            <th>TIPO COMP</th>
                                            <th>TIPO RAM</th>
                                            <th>RAM</th>
                                            <th>TIPO DISCO</th>
                                            <th>CAPACIDAD</th>
                                            <th>PROCESADOR</th>
                                            <th>PROPIETARIO</th>
                                            <th>PROVEEDOR</th>
                                            <th>SISTEMA OP.</th>
                                            <th>SERIAL CARGADOR</th>
                                            <th>DOMINIO</th>
                                            <th>TIPO USUARIO</th>
                                            <th>SERIAL ACTIVO</th>
                                            <th>TARGETA VIDEO</th>
                                            <th>ESTADO</th>
                                            <th></th>
                                            <th></th>
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

                                            // Agregar un formulario de edición oculto para cada fila
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
                                                        $selected = ($idSede == $sedeOriginal) ? "selected" : "";
                                                        echo "<option value='$idSede' $selected>$nombreSede</option>";
                                                    }

                                                    // Libera recursos
                                                    odbc_free_result($resultadoSedes);

                                                    echo "</select>";
                                                    echo "</td>";
                                                } else if ($key === 'Empresa_computador') {
                                                    // Agregar un campo de selección para la empresa
                                                    echo "<td class='campo-editable' data-empresa='$value'>";
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
                                                        $selected = ($idEmpresa == $empresaOriginal) ? "selected" : "";
                                                        echo "<option value='$idEmpresa' $selected>$nombreEmpresa</option>";
                                                    }

                                                    // Libera recursos
                                                    odbc_free_result($resultadoEmpresas);

                                                    echo "</select>";
                                                    echo "</td>";
                                                } else if ($key === 'Memoria_ram') {
                                                    // Agregar un campo de texto para la RAM
                                                    echo "<td class='campo-editable'><input type='text' name='Memoria_ram' value='$value'></td>";
                                                } else if ($key === 'Tipo_disco') {
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
                                                        $selected = ($idTipoDisco == $tipoDiscoOriginal) ? "selected" : "";
                                                        echo "<option value='$idTipoDisco' $selected>$nombreTipoDisco</option>";
                                                    }

                                                    // Libera recursos
                                                    odbc_free_result($resultadoTiposDisco);

                                                    echo "</select>";
                                                    echo "</td>";
                                                } else if ($key === 'Capacidad_dico') {
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
                                                } else if ($key === 'Sistema_O') {
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
                                                        $selected = ($idSistemaOperativo == $sistemaOperativoOriginal) ? "selected" : "";
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
                                                } else if ($key === 'Nombre_equipo') {
                                                    // Agregar un campo de texto para la RAM
                                                    echo "<td class=''><input type='text' name='Nombre_equipo' value='$value' disabled ></td>";
                                                } else {
                                                    echo "<td class='campo-editable'>$value</td>";
                                                }
                                            }



                                            // Agregar campos ocultos para los valores editados
                                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                            echo '<input type="hidden" name="Sede" value="">';
                                            echo '<input type="hidden" name="Empresa_computador" value="">';
                                            echo '<input type="hidden" name="Memoria_ram" value="">';
                                            echo '<input type="hidden" name="Tipo_disco" value="">';
                                            echo '<input type="hidden" name="Capacidad_disco" value="">';
                                            echo '<input type="hidden" name="Sistema_Operativo" value="">';
                                            echo '<input type="hidden" name="Serial_cargador" value="">';
                                            echo '<input type="hidden" name="Dominio" value="">';
                                            echo '<input type="hidden" name="Tipo_usuario" value="">';

                                            //    PARAMETROS PARA LA TABLA HISTORIAL

                                            echo '<input type="hidden" name="Nombre_equipo" value="">';






                                            echo '<td class="campo-editable"><button type="button" class="btn btn-success btn-guardar" data-id="' . $row['id'] . '">Guardar</button></td>';
                                            echo '<td class="campo-editable"><button type="button" class="btn btn-danger btn-cancelar" data-id="' . $row['id'] . '">Cancelar</button></td>';
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- enviar el nombre como parametro -->
            <strong id="Usua_modifica" style="display: none;!important"><?php echo utf8_encode($_SESSION['usuario']); ?></strong>

        </section>

    </body>

    </html>


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
                var nombreUsuario = $('#Usua_modifica').text().trim(); // Trim para eliminar espacios en blanco
                camposActualizados['Usua_modifica'] = nombreUsuario; // Agregarlo como un campo en camposActualizados

                // Recopilar los valores de los campos editables
                $('#editar-form-' + id + ' input[type="text"], #editar-form-' + id + ' select').each(function() {
                    var nombreCampo = $(this).attr('name');
                    var valorCampo = $(this).val();
                    camposActualizados[nombreCampo] = valorCampo;
                });

                // Agregar el ID a los campos actualizados
                camposActualizados['id'] = id;

                // Enviar los datos al servidor utilizando AJAX
                $.ajax({
                    type: "POST",
                    url: "mantenimiento/actualizar_equipo.php",
                    data: camposActualizados,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            // Actualización exitosa, puedes realizar acciones adicionales si es necesario
                            alert("Actualización exitosa: " + response.message);
                            // Puedes ocultar el formulario de edición y mostrar los campos originales aquí
                        } else {
                            // Manejar errores si la actualización falló
                            alert("Error al actualizar: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de comunicación con el servidor
                        console.error("Error en la comunicación con el servidor");
                        console.error("Estado (status): " + status);
                        console.error("Error (error): " + error);
                        console.error("Respuesta completa (xhr):", xhr);
                        // También puedes agregar más detalles sobre el error aquí si es necesario
                        alert("Error en la comunicación con el servidor");
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