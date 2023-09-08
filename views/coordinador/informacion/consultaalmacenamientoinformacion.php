<?php
include '../../../conexionbd.php';;

if (isset($_POST['cedula'])
) {


    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

    $data = odbc_exec($conexion, "SELECT [id_asignacion] ,[id] ,[tipo_maquina] ,[marca_almacenamiento] ,[modelo_almacenamiento] ,[descripcion_almacenamiento] ,[capacidad_almacenamiento] ,[tipo_almacenamiento] ,[caracteristica_almacenamiento] ,[sede_almacenamiento] ,[ubicacion_almacenamiento] ,[fecha_de_ingreso] ,[estado] ,[fecha_de_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[usua_asigna] ,[fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[estado_asignacion] ,[observaciones_desasigna] FROM [ControlTIC].[dbo].[asignacion_almacenamiento] where cedula = '$cedula' ");

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
                        <th scope="col" class="hidden-cell">Primer Nombre</th>
                        <th scope="col" class="hidden-cell">Segundo Nombre</th>
                        <th scope="col" class="hidden-cell">Primer Apellido</th>
                        <th scope="col" class="hidden-cell">Segundo Apellido</th>
                        <th scope="col" class="hidden-cell">Cedula</th>
                        <th scope="col" class="hidden-cell">Cargo</th>
                        <th scope="col" class="hidden-cell">Empresa</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Caracteristica</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Seleccionar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arr as $fila) { ?>
                        <tr>
                            <td class="hidden-cell"><?php echo $primernombre; ?></td>
                            <td class="hidden-cell"><?php echo $segundonombre; ?></td>
                            <td class="hidden-cell"><?php echo $primerapellido; ?></td>
                            <td class="hidden-cell"><?php echo $segundoapellido; ?></td>
                            <td class="hidden-cell"><?php echo $cedula; ?></td>
                            <td class="hidden-cell"><?php echo $cargo; ?></td>
                            <td class="hidden-cell"><?php echo $empresa; ?></td>

                            <td><?= $fila['marca_almacenamiento'] ?></td>
                            <td><?= $fila['modelo_almacenamiento'] ?></td>
                            <td><?= $fila['descripcion_almacenamiento'] ?></td>
                            <td><?= $fila['capacidad_almacenamiento'] ?></td>
                            <td><?= $fila['tipo_almacenamiento'] ?></td>
                            <td><?= $fila['caracteristica_almacenamiento'] ?></td>
                            <td><?= $fila['sede_almacenamiento'] ?></td>
                            <td><?= $fila['ubicacion_almacenamiento'] ?></td>
                            <td><input type="text" id="observaciones_desasigna_<?= $fila['id'] ?>" value="<?= $fila['observaciones_desasigna'] ?>"></td>
                            <td>
                                <button id="enviaralmacenamiento" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" data-id="<?= $fila['id'] ?>" data-primernombre="<?= $primernombre ?>" data-segundonombre="<?= $segundonombre ?>" data-primerapellido="<?= $primerapellido ?>" data-segundoapellido="<?= $segundoapellido ?>" data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>" data-empresa="<?= $empresa ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-marca-almacenamiento="<?= $fila['marca_almacenamiento'] ?>" data-modelo-almacenamiento="<?= $fila['modelo_almacenamiento'] ?>" data-descripcion-almacenamiento="<?= $fila['descripcion_almacenamiento'] ?>" data-capacidad-almacenamiento="<?= $fila['capacidad_almacenamiento'] ?>" data-tipo-almacenamiento="<?= $fila['tipo_almacenamiento'] ?>" data-caracteristica-almacenamiento="<?= $fila['caracteristica_almacenamiento'] ?>" data-sede-almacenamiento="<?= $fila['sede_almacenamiento'] ?>" data-ubicacion-almacenamiento="<?= $fila['ubicacion_almacenamiento'] ?>" data-fecha-de-ingreso="<?= $fila['fecha_de_ingreso'] ?>" data-estado="<?= $fila['estado'] ?>" data-fecha-de-garantia="<?= $fila['fecha_de_garantia'] ?>" data-fecha-crea="<?= $fila['fecha_crea'] ?>" data-usua-crea="<?= $fila['usua_crea'] ?>" data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" data-usua-modifica="<?= $fila['usua_modifica'] ?>"></button>
                                <!-- btn escondido para la alerta -->
                                <button id="" type="button" class="btn btn-outline-danger showAlertButton">Desasignar</button>
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

                // Obtener los atributos de los elementos de datos
                var id = $(this).data('id');
                var primernombre = $(this).data('primernombre');
                var segundonombre = $(this).data('segundonombre');
                var primerapellido = $(this).data('primerapellido');
                var segundoapellido = $(this).data('segundoapellido');
                var cedula = $(this).data('cedula');
                var cargo = $(this).data('cargo');
                var empresa = $(this).data('empresa');
                var tipo_maquina = $(this).data('tipo-maquina');
                var marca_almacenamiento = $(this).data('marca-almacenamiento');
                var modelo_almacenamiento = $(this).data('modelo-almacenamiento');
                var descripcion_almacenamiento = $(this).data('descripcion-almacenamiento');
                var capacidad_almacenamiento = $(this).data('capacidad-almacenamiento');
                var tipo_almacenamiento = $(this).data('tipo-almacenamiento');
                var caracteristica_almacenamiento = $(this).data('caracteristica-almacenamiento');
                var sede_almacenamiento = $(this).data('sede-almacenamiento');
                var ubicacion_almacenamiento = $(this).data('ubicacion-almacenamiento');
                var fecha_de_ingreso = $(this).data('fecha-de-ingreso');
                var estado = $(this).data('estado');
                var fecha_de_garantia = $(this).data('fecha-de-garantia');
                var fecha_crea = $(this).data('fecha-crea');
                var usua_crea = $(this).data('usua-crea');
                var fecha_modifica = $(this).data('fecha-modifica');
                var usua_modifica = $(this).data('usua-modifica');
                var observaciones_desasigna = $('#observaciones_desasigna_' + id).val();

                console.log("Datos a enviar:");
                console.log("ID:", id);
                console.log("Primer Nombre:", primernombre);
                console.log("Segundo Nombre:", segundonombre);
                console.log("Primer Apellido:", primerapellido);
                console.log("Segundo Apellido:", segundoapellido);
                console.log("Cedula:", cedula);
                console.log("Cargo:", cargo);
                console.log("Empresa:", empresa);
                console.log("Tipo de Máquina:", tipo_maquina);
                console.log("Marca Almacenamiento:", marca_almacenamiento);
                console.log("Modelo Almacenamiento:", modelo_almacenamiento);
                console.log("Descripción Almacenamiento:", descripcion_almacenamiento);
                console.log("Capacidad Almacenamiento:", capacidad_almacenamiento);
                console.log("Tipo Almacenamiento:", tipo_almacenamiento);
                console.log("Característica Almacenamiento:", caracteristica_almacenamiento);
                console.log("Sede Almacenamiento:", sede_almacenamiento);
                console.log("Ubicación Almacenamiento:", ubicacion_almacenamiento);
                console.log("Fecha de Ingreso:", fecha_de_ingreso);
                console.log("Estado:", estado);
                console.log("Fecha de Garantía:", fecha_de_garantia);
                console.log("Fecha Crea:", fecha_crea);
                console.log("Usua Crea:", usua_crea);
                console.log("Fecha Modifica:", fecha_modifica);
                console.log("Usua Modifica:", usua_modifica);
                console.log("Observaciones de Desasignacion", observaciones_desasigna);

                $.ajax({
                    url: 'delete/deletealmacenamientoinformacion.php',
                    type: 'POST',
                    data: {
                        id: id,
                        primernombre: primernombre,
                        segundonombre: segundonombre,
                        primerapellido: primerapellido,
                        segundoapellido: segundoapellido,
                        cedula: cedula,
                        cargo: cargo,
                        empresa: empresa,
                        tipo_maquina: tipo_maquina,
                        marca_almacenamiento: marca_almacenamiento,
                        modelo_almacenamiento: modelo_almacenamiento,
                        descripcion_almacenamiento: descripcion_almacenamiento,
                        capacidad_almacenamiento: capacidad_almacenamiento,
                        tipo_almacenamiento: tipo_almacenamiento,
                        caracteristica_almacenamiento: caracteristica_almacenamiento,
                        sede_almacenamiento: sede_almacenamiento,
                        ubicacion_almacenamiento: ubicacion_almacenamiento,
                        fecha_de_ingreso: fecha_de_ingreso,
                        estado: estado,
                        fecha_de_garantia: fecha_de_garantia,
                        fecha_crea: fecha_crea,
                        usua_crea: usua_crea,
                        fecha_modifica: fecha_modifica,
                        usua_modifica: usua_modifica,
                        observaciones_desasigna: observaciones_desasigna
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
                        $('#modalalmacenamientoinformacion').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡Guardado!', '', 'success');
                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: 'delete/deletealmacenamiento.php',
                            type: 'POST',
                            data: {
                                idToUpdate: idToUpdate
                            },
                            success: function(response) {
                                console.log("Actualización exitosa:", response);

                                // Activar el botón oculto correspondiente a la fila seleccionada
                                $asignarBtn.trigger('click');
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Los cambios no se guardaron', '', 'info');
                    }
                });
            });
        });
    </script>

<?php } else { ?>

<?php
} ?>