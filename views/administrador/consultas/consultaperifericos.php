<?php
include '../../../conexionbd.php';;

if (isset($_POST['tipo_perifericos'])) {

    $tipo_perifericos = $_POST['tipo_perifericos'];

    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

    $data = odbc_exec($conexion, "SELECT [id] ,[tipo_maquina] ,[serial_perifericos] ,[descripcion_perifericos] ,[marca_perifericos] ,[modelo_perifericos] ,[placa_activo_perifericos] ,[sede_perifericos] ,[ubicacion_perifericos] ,[tipo] ,[tipo_toner] ,[gestion] ,[empresa] ,[fecha_de_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] ,[estado] FROM [ControlTIC].[dbo].[maquina_perifericos] where estado = '6' and gestion = '3' and descripcion_perifericos = '$tipo_perifericos' ");

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
                        <th scope="col">ID</th>
                        <th scope="col">Tipo de Máquina</th>
                        <th scope="col">Serial</th>
                        <th scope="col">Sescripción</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Placa Activo</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Tipo de Toner</th>
                        <th scope="col">Gestion</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Fecha Garantia</th>
                        <th scope="col">Fecha Crea</th>
                        <th scope="col">Usua Crea</th>
                        <th scope="col">Usua Modifica</th>
                        <th scope="col">Fecha Modifica</th>
                        <th scope="col">Estado</th>

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
                            <td><?= $fila['id'] ?></td>
                            <td><?= $fila['tipo_maquina'] ?></td>
                            <td><?= $fila['serial_perifericos'] ?></td>
                            <td><?= $fila['descripcion_perifericos'] ?></td>
                            <td><?= $fila['marca_perifericos'] ?></td>
                            <td><?= $fila['modelo_perifericos'] ?></td>
                            <td><?= $fila['placa_activo_perifericos'] ?></td>
                            <td><?= $fila['sede_perifericos'] ?></td>
                            <td><?= $fila['ubicacion_perifericos'] ?></td>
                            <td><?= $fila['tipo'] ?></td>
                            <td><?= $fila['tipo_toner'] ?></td>
                            <td><?= $fila['gestion'] ?></td>
                            <td><?= $fila['empresa'] ?></td>
                            <td><?= $fila['fecha_de_garantia'] ?></td>
                            <td><?= $fila['fecha_crea'] ?></td>
                            <td><?= $fila['usua_crea'] ?></td>
                            <td><?= $fila['fecha_modifica'] ?></td>
                            <td><?= $fila['usua_modifica'] ?></td>
                            <td><?= $fila['estado'] ?></td>

                            <td>
                                <button id="enviarperifericos" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" data-id="<?= $fila['id'] ?>" data-primernombre="<?= $primernombre ?>" data-segundonombre="<?= $segundonombre ?>" data-primerapellido="<?= $primerapellido ?>" data-segundoapellido="<?= $segundoapellido ?>" data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>" data-empresa="<?= $empresa ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-serial-perifericos="<?= $fila['serial_perifericos'] ?>" data-descripcion-perifericos="<?= $fila['descripcion_perifericos'] ?>" data-marca-perifericos="<?= $fila['marca_perifericos'] ?>" data-modelo-perifericos="<?= $fila['modelo_perifericos'] ?>" data-placa-activo-perifericos="<?= $fila['placa_activo_perifericos'] ?>" data-sede-perifericos="<?= $fila['sede_perifericos'] ?>" data-ubicacion-perifericos="<?= $fila['ubicacion_perifericos'] ?>" data-tipo="<?= $fila['tipo'] ?>" data-tipo-toner="<?= $fila['tipo_toner'] ?>" data-gestion="<?= $fila['gestion'] ?>" data-empresa-perifericos="<?= $fila['empresa'] ?>" data-fecha-garantia="<?= $fila['fecha_de_garantia'] ?>" data-fecha-crea="<?= $fila['fecha_crea'] ?>" data-usua-crea="<?= $fila['usua_crea'] ?>" data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" data-usua-modifica="<?= $fila['usua_modifica'] ?>" data-estado="<?= $fila['estado'] ?>"></button>
                                <!-- btn escondido para la alerta -->
                                <button id="" type="button" class="btn btn-outline-warning showAlertButton">ASIGNAR</button>
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

                var primernombre = $(this).data('primernombre');
                var segundonombre = $(this).data('segundonombre');
                var primerapellido = $(this).data('primerapellido');
                var segundoapellido = $(this).data('segundoapellido');
                var cedula = $(this).data('cedula');
                var cargo = $(this).data('cargo');
                var empresa = $(this).data('empresa');
                var id = $(this).data('id');
                var tipo_maquina = $(this).data('tipo-maquina');
                var serial_perifericos = $(this).data('serial-perifericos');
                var descripcion_perifericos = $(this).data('descripcion-perifericos');
                var marca_perifericos = $(this).data('marca-perifericos');
                var modelo_perifericos = $(this).data('modelo-perifericos');
                var placa_activo_perifericos = $(this).data('placa-activo-perifericos');
                var sede_perifericos = $(this).data('sede-perifericos');
                var ubicacion_perifericos = $(this).data('ubicacion-perifericos');
                var tipo = $(this).data('tipo');
                var tipo_toner = $(this).data('tipo-toner');
                var gestion = $(this).data('gestion');
                var empresa_perifericos = $(this).data('empresa-perifericos');
                var fecha_garantia = $(this).data('fecha-garantia');
                var fecha_crea = $(this).data('fecha-crea');
                var usua_crea = $(this).data('usua-crea');
                var fecha_modifica = $(this).data('fecha-modifica');
                var usua_modifica = $(this).data('usua-modifica');
                var estado = $(this).data('estado');

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
                console.log("Serial de periféricos:", serial_perifericos);
                console.log("Descripción de periféricos:", descripcion_perifericos);
                console.log("Marca de periféricos:", marca_perifericos);
                console.log("Modelo de periféricos:", modelo_perifericos);
                console.log("Placa activo de periféricos:", placa_activo_perifericos);
                console.log("Sede de periféricos:", sede_perifericos);
                console.log("Ubicación de periféricos:", ubicacion_perifericos);
                console.log("Tipo", tipo);
                console.log("Tipo de toner:", tipo_toner);
                console.log("Gestión:", gestion);
                console.log("Empresa de periféricos:", empresa_perifericos);
                console.log("Fecha de garantía:", fecha_garantia);
                console.log("Fecha de creación:", fecha_crea);
                console.log("Usuario que creó:", usua_crea);
                console.log("Fecha de modificación:", fecha_modifica);
                console.log("Usuario que modificó:", usua_modifica);
                console.log("Estado:", estado);

                $.ajax({
                    url: 'create/insertarperifericos.php',
                    type: 'POST',
                    data: {
                        primernombre: primernombre,
                        segundonombre: segundonombre,
                        primerapellido: primerapellido,
                        segundoapellido: segundoapellido,
                        cedula: cedula,
                        cargo: cargo,
                        empresa: empresa,
                        id: id,
                        tipo_maquina: tipo_maquina,
                        serial_perifericos: serial_perifericos,
                        descripcion_perifericos: descripcion_perifericos,
                        marca_perifericos: marca_perifericos,
                        modelo_perifericos: modelo_perifericos,
                        placa_activo_perifericos: placa_activo_perifericos,
                        sede_perifericos: sede_perifericos,
                        ubicacion_perifericos: ubicacion_perifericos,
                        tipo: tipo,
                        tipo_toner: tipo_toner,
                        gestion: gestion,
                        empresa_perifericos: empresa_perifericos,
                        fecha_garantia: fecha_garantia,
                        fecha_crea: fecha_crea,
                        usua_crea: usua_crea,
                        fecha_modifica: fecha_modifica,
                        usua_modifica: usua_modifica,
                        estado: estado,
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
                        $('#modalperifericos').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: 'update/actualizarperifericos.php',
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