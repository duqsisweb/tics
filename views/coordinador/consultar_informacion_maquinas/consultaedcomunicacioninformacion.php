<?php
include '../../../conexionbd.php';;





    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

    $Usua_asigna = $_POST['Usua_asigna'];

    $data = odbc_exec($conexion, "SELECT [id_asignacion]
                    ,[id]
                    ,[tipo_maquina]
                    ,[marca_edcomunicacion]
                    ,[modelo_edcomunicacion]
                    ,[descripcion_edcomunicacion]
                    ,[serial_edcomunicacion]
                    ,[fecha_de_ingreso_edc]
                    ,[estado]
                    ,[placa_activo_edcomunicacion]
                    ,[sede_edcomunicacion]
                    ,[ubicacion_edcomunicacion]
                    ,[observaciones_edcomunicacion]
                    ,[gestion_edcomunicacion]
                    ,[fecha_garantia_edc]
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
                    ,[observaciones_desasigna]
                FROM [ControlTIC].[dbo].[asignacion_edcomunicacion] where cedula = '$cedula'");

    $arr = array();
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }


?>
    <!-- Hoja de estilos de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <!-- Biblioteca de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>

    <style>
        .hidden-cell {
            display: none;
        }
    </style>


    <div class="text-right mt-3">
        <div class="col-md-12">
            <!-- tbl info de celulares -->
            <table class="table table-bordered dt-responsive table-hover display nowrap" id="infodetallefactura" cellspacing="0" style="text-align: center;">
                <thead>
                    <tr class="encabezado table-dark">
                        <th scope="col" class="hidden-cell">Usua_asigna</th>
                        <th scope="col" class="hidden-cell">Primer Nombre</th>
                        <th scope="col" class="hidden-cell">Segundo Nombre</th>
                        <th scope="col" class="hidden-cell">Primer Apellido</th>
                        <th scope="col" class="hidden-cell">Segundo Apellido</th>
                        <th scope="col" class="hidden-cell">Cedula</th>
                        <th scope="col" class="hidden-cell">Cargo</th>
                        <th scope="col" class="hidden-cell">Empresa</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo de Máquina</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Serial</th>
                        <th scope="col">Fecha I.</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Placa Activo</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">observaciones_edcomunicacion</th>
                        <th scope="col">Gestion</th>
                        <th scope="col">Fecha Garantia</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Link Drive</th>
                        <th scope="col">Ejecución</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arr as $fila) { ?>
                        <tr>
                            <td class="hidden-cell"><?php echo $Usua_asigna; ?></td>
                            <td class="hidden-cell"><?php echo $primernombre; ?></td>
                            <td class="hidden-cell"><?php echo $segundonombre; ?></td>
                            <td class="hidden-cell"><?php echo $primerapellido; ?></td>
                            <td class="hidden-cell"><?php echo $segundoapellido; ?></td>
                            <td class="hidden-cell"><?php echo $cedula; ?></td>
                            <td class="hidden-cell"><?php echo $cargo; ?></td>
                            <td class="hidden-cell"><?php echo $empresa; ?></td>
                            <td><?= $fila['id'] ?></td>
                            <td><?= $fila['tipo_maquina'] ?></td>
                            <td><?= $fila['marca_edcomunicacion'] ?></td>
                            <td><?= $fila['modelo_edcomunicacion'] ?></td>
                            <td><?= $fila['descripcion_edcomunicacion'] ?></td>
                            <td><?= $fila['serial_edcomunicacion'] ?></td>
                            <td><?= $fila['fecha_de_ingreso_edc'] ?></td>
                            <td><?= $fila['estado'] ?></td>
                            <td><?= $fila['placa_activo_edcomunicacion'] ?></td>
                            <td><?= $fila['sede_edcomunicacion'] ?></td>
                            <td><?= $fila['ubicacion_edcomunicacion'] ?></td>
                            <td><?= $fila['observaciones_edcomunicacion'] ?></td>
                            <td><?= $fila['gestion_edcomunicacion'] ?></td>
                            <td><?= $fila['fecha_garantia_edc'] ?></td>
                            <td>
                            <textarea placeholder="AGREGE UNA OBSERVACIÓN" name="observaciones_desasigna" id="observaciones_desasigna<?= $fila['id'] ?>" style="width: 300px; height: 160px;"></textarea>
                            </td>

                            <td>
                                <input id="link_edc_desasigna<?= $fila['id'] ?>" name="link_edc_desasigna"></input>
                            </td>
                            <td>
                                <button id="enviaredcomunicacion" style="display: none;" type="submit" class="btn btn-outline-danger asignar-btn" 
                                data-id="<?= $fila['id'] ?>" 
                                data-primernombre="<?= $primernombre ?>" 
                                data-segundonombre="<?= $segundonombre ?>" 
                                data-primerapellido="<?= $primerapellido ?>" 
                                data-segundoapellido="<?= $segundoapellido ?>" 
                                data-cedula="<?= $cedula ?>" 
                                data-cargo="<?= $cargo ?>" 
                                data-empresa="<?= $empresa ?>" 
                                data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                                data-marca-edcomunicacion="<?= $fila['marca_edcomunicacion'] ?>" 
                                data-modelo-edcomunicacion="<?= $fila['modelo_edcomunicacion'] ?>" 
                                data-descripcion-edcomunicacion="<?= $fila['descripcion_edcomunicacion'] ?>" 
                                data-serial-edcomunicacion="<?= $fila['serial_edcomunicacion'] ?>" 
                                data-fecha-de-ingreso-edc="<?= $fila['fecha_de_ingreso_edc'] ?>" 
                                data-estado="<?= $fila['estado'] ?>"
                                data-placa-activo-edcomunicacion="<?= $fila['placa_activo_edcomunicacion'] ?>" 
                                data-sede-edcomunicacion="<?= $fila['sede_edcomunicacion'] ?>" 
                                data-ubicacion-edcomunicacion="<?= $fila['ubicacion_edcomunicacion'] ?>" 
                                data-observaciones-edcomunicacion="<?= $fila['observaciones_edcomunicacion'] ?>" 
                                data-gestion-edcomunicacion="<?= $fila['gestion_edcomunicacion'] ?>" 
                                data-fecha-garantia-edc="<?= $fila['fecha_garantia_edc'] ?>"
                                data-usua-asigna="<?php echo $Usua_asigna; ?>"></button>
                                <!-- btn escondido para la alerta -->
                                <button id="" type="button" class="btn btn-outline-danger showAlertButton">REMOVER</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.asignar-btn').on('click', function() {
                console.log("Botón 'ASIGNAR' presionado");

                var Usua_asigna = $(this).data('usua-asigna');
                var primernombre = $(this).data('primernombre');
                var segundonombre = $(this).data('segundonombre');
                var primerapellido = $(this).data('primerapellido');
                var segundoapellido = $(this).data('segundoapellido');
                var cedula = $(this).data('cedula');
                var cargo = $(this).data('cargo');
                var empresa = $(this).data('empresa');
                var id = $(this).data('id');
                var tipo_maquina = $(this).data('tipo-maquina');
                var marca_edcomunicacion = $(this).data('marca-edcomunicacion');
                var modelo_edcomunicacion = $(this).data('modelo-edcomunicacion');
                var descripcion_edcomunicacion = $(this).data('descripcion-edcomunicacion');
                var serial_edcomunicacion = $(this).data('serial-edcomunicacion');
                var fecha_de_ingreso_edc = $(this).data('fecha-de-ingreso-edc');
                var estado = $(this).data('estado');
                var placa_activo_edcomunicacion = $(this).data('placa-activo-edcomunicacion');
                var sede_edcomunicacion = $(this).data('sede-edcomunicacion');
                var ubicacion_edcomunicacion = $(this).data('ubicacion-edcomunicacion');
                var observaciones_edcomunicacion = $(this).data('observaciones-edcomunicacion');
                var gestion_edcomunicacion = $(this).data('gestion-edcomunicacion');
                var fecha_garantia_edc = $(this).data('fecha-garantia-edc');
                var observaciones_desasigna = $('#observaciones_desasigna' + id).val();
                var link_edc_desasigna = $('#link_edc_desasigna' + id).val();

                console.log("Usuario Asigna:", Usua_asigna);
                console.log("Primer Nombre:", primernombre);
                console.log("Segundo Nombre:", segundonombre);
                console.log("Primer Apellido:", primerapellido);
                console.log("Segundo Apellido:", segundoapellido);
                console.log("Cédula:", cedula);
                console.log("Cargo:", cargo);
                console.log("Empresa:", empresa);
                console.log("Datos a enviar:");
                console.log("ID:", id);
                console.log("Tipo de máquina:", tipo_maquina);
                console.log("Marca:", marca_edcomunicacion);
                console.log("Modelo:", modelo_edcomunicacion);
                console.log("Descripcion:", descripcion_edcomunicacion);
                console.log("Serial:", serial_edcomunicacion);
                console.log("Fecha de Ingreso:", fecha_de_ingreso_edc);
                console.log("Estado:", estado);
                console.log("Placa Activo:", placa_activo_edcomunicacion);
                console.log("Sede:", sede_edcomunicacion);
                console.log("Ubicación:", ubicacion_edcomunicacion);
                console.log("observaciones_edcomunicacion:", observaciones_edcomunicacion);
                console.log("Gestión:", gestion_edcomunicacion);
                console.log("Fecha Garantía:", fecha_garantia_edc);
                console.log("observaciones de Asignacion", observaciones_desasigna);
                console.log("link Drive", link_edc_desasigna);

                $.ajax({
                    url: 'historial_remover_asignacion/deleteedcomunicacionhistorial.php',
                    type: 'POST',
                    data: {

                        Usua_asigna: Usua_asigna,
                        primernombre: primernombre,
                        segundonombre: segundonombre,
                        primerapellido: primerapellido,
                        segundoapellido: segundoapellido,
                        cedula: cedula,
                        cargo: cargo,
                        empresa: empresa,
                        id: id,
                        tipo_maquina: tipo_maquina,
                        marca_edcomunicacion: marca_edcomunicacion,
                        modelo_edcomunicacion: modelo_edcomunicacion,
                        descripcion_edcomunicacion: descripcion_edcomunicacion,
                        serial_edcomunicacion: serial_edcomunicacion,
                        fecha_de_ingreso_edc: fecha_de_ingreso_edc,
                        estado: estado,
                        placa_activo_edcomunicacion: placa_activo_edcomunicacion,
                        sede_edcomunicacion: sede_edcomunicacion,
                        ubicacion_edcomunicacion: ubicacion_edcomunicacion,
                        observaciones_edcomunicacion: observaciones_edcomunicacion,
                        gestion_edcomunicacion: gestion_edcomunicacion,
                        fecha_garantia_edc: fecha_garantia_edc,
                        observaciones_desasigna: observaciones_desasigna,
                        link_edc_desasigna: link_edc_desasigna
                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);
                    }
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.showAlertButton').click(function() {

                var $asignarBtn = $(this).prev('.asignar-btn'); // Obtener el botón oculto previo
                var idToUpdate = $asignarBtn.data('id'); // Obtener el ID del botón oculto

                Swal.fire({
                    title: '¿Quieres guardar los cambios?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `No guardar`,
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Cerrar el modal
                        $('#modaledcomunicacioninformacion').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: 'delete/deleteedcomunicacion.php',
                            type: 'POST',
                            data: {
                                idToUpdate: idToUpdate
                            },
                            success: function(response) {
                                console.log("Actualización exitosa:", response);
                                // Activar el botón oculto correspondiente a la fila seleccionada
                                $asignarBtn.trigger('click');
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Los cambios no se guardaron', '', 'info');
                    }
                });
            });
        });
    </script>
