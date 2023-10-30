<?php
include '../../../conexionbd.php';;

if (isset($_POST['tipo_almacenamiento'])) {

    $tipo_almacenamiento = $_POST['tipo_almacenamiento'];

    $Usua_asigna = $_POST['Usua_asigna'];

    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';



    $data = odbc_exec($conexion, "SELECT mc.[id]
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
    ,[marca_almacenamiento]
    ,[modelo_almacenamiento]
    ,desalmacenamiento.[nombre_descripcion] as descripcion_almacenamiento
    ,[capacidad_almacenamiento]
    ,[tipo_almacenamiento]
    ,[caracteristica_almacenamiento]
    ,sed.[nombre_sede] as sede_almacenamiento 
    ,[ubicacion_almacenamiento]
    ,[fecha_de_ingreso_alma]
    ,estad.[nombre_estado] as estado
    ,[fecha_de_garantia_alma]
    ,[fecha_crea]
    ,[usua_crea]
    ,[fecha_modifica]
    ,[usua_modifica] FROM [ControlTIC].[dbo].[maquina_almacenamiento] as mc 
    JOIN [ControlTIC].[dbo].[descripcion_almacenamiento] as desalmacenamiento ON mc.descripcion_almacenamiento = desalmacenamiento.id 
    JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_almacenamiento = sed.id 
    JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id
    LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id where estado = '6' and descripcion_almacenamiento = '$tipo_almacenamiento' ");

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
                        <th scope="col">Capacidad</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Caracteristica</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha Garantia</th>
                        <th scope="col">Fecha Crea</th>
                        <th scope="col">Usua Crea</th>
                        <th scope="col">Fecha Modifica</th>
                        <th scope="col">Usua Modifica</th>

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
                            <td><?= $fila['marca_almacenamiento'] ?></td>
                            <td><?= $fila['modelo_almacenamiento'] ?></td>
                            <td><?= $fila['descripcion_almacenamiento'] ?></td>
                            <td><?= $fila['capacidad_almacenamiento'] ?></td>
                            <td><?= $fila['tipo_almacenamiento'] ?></td>
                            <td><?= $fila['caracteristica_almacenamiento'] ?></td>
                            <td><?= $fila['sede_almacenamiento'] ?></td>
                            <td><?= $fila['ubicacion_almacenamiento'] ?></td>
                            <td><?= $fila['fecha_de_ingreso_alma'] ?></td>
                            <td><?= $fila['estado'] ?></td>
                            <td><?= $fila['fecha_de_garantia_alma'] ?></td>
                            <td><?= $fila['fecha_crea'] ?></td>
                            <td><?= $fila['usua_crea'] ?></td>
                            <td><?= $fila['fecha_modifica'] ?></td>
                            <td><?= $fila['usua_modifica'] ?></td>
                            <td>
                                <textarea placeholder="AGREGE UNA OBSERVACIÓN" id="observaciones_asigna_alma<?= $fila['id'] ?>" name="observaciones_asigna_alma" style="width: 300px; height: 160px;"></textarea>
                            </td>

                            <td>
                                <input id="link_alma_asigna<?= $fila['id'] ?>" name="link_alma_asigna"></input>
                            </td>

                            <td>
                                <button id="enviaralmacenamiento" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" data-id="<?= $fila['id'] ?>" data-primernombre="<?= $primernombre ?>" data-segundonombre="<?= $segundonombre ?>" data-primerapellido="<?= $primerapellido ?>" data-segundoapellido="<?= $segundoapellido ?>" data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>" data-empresa="<?= $empresa ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-marca-almacenamiento="<?= $fila['marca_almacenamiento'] ?>" data-modelo-almacenamiento="<?= $fila['modelo_almacenamiento'] ?>" data-descripcion-almacenamiento="<?= $fila['descripcion_almacenamiento'] ?>" data-capacidad-almacenamiento="<?= $fila['capacidad_almacenamiento'] ?>" data-tipo-almacenamiento="<?= $fila['tipo_almacenamiento'] ?>" data-caracteristica-almacenamiento="<?= $fila['caracteristica_almacenamiento'] ?>" data-sede-almacenamiento="<?= $fila['sede_almacenamiento'] ?>" data-ubicacion-almacenamiento="<?= $fila['ubicacion_almacenamiento'] ?>" data-fecha-de-ingreso-alma="<?= $fila['fecha_de_ingreso_alma'] ?>" data-estado="<?= $fila['estado'] ?>" data-fecha-de-garantia-alma="<?= $fila['fecha_de_garantia_alma'] ?>" data-fecha-crea="<?= $fila['fecha_crea'] ?>" data-usua-crea="<?= $fila['usua_crea'] ?>" data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" data-usua-modifica="<?= $fila['usua_modifica'] ?>" data-usua-asigna="<?php echo $Usua_asigna; ?>" ></button>
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

                var Usua_asigna = $(this).data('usua-asigna');

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
                var fecha_de_ingreso_alma = $(this).data('fecha-de-ingreso-alma');
                var estado = $(this).data('estado');
                var fecha_de_garantia_alma = $(this).data('fecha-de-garantia-alma');
                var fecha_crea = $(this).data('fecha-crea');
                var usua_crea = $(this).data('usua-crea');
                var fecha_modifica = $(this).data('fecha-modifica');
                var usua_modifica = $(this).data('usua-modifica');
                var observaciones_asigna_alma = $('#observaciones_asigna_alma' + id).val();
                var link_alma_asigna = $('#link_alma_asigna' + id).val();

                console.log("Usuario Asigna:", Usua_asigna);
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
                console.log("Fecha de Ingreso:", fecha_de_ingreso_alma);
                console.log("Estado:", estado);
                console.log("Fecha de Garantía:", fecha_de_garantia_alma);
                console.log("Fecha Crea:", fecha_crea);
                console.log("Usua Crea:", usua_crea);
                console.log("Fecha Modifica:", fecha_modifica);
                console.log("Usua Modifica:", usua_modifica);
                console.log("observaciones de Asignacion", observaciones_asigna_alma);
                console.log("link Drive", link_alma_asigna);

                $.ajax({
                    url: 'asignar_maquinas/insertaralmacenamiento.php',
                    type: 'POST',
                    data: {

                        Usua_asigna: Usua_asigna,
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
                        fecha_de_ingreso_alma: fecha_de_ingreso_alma,
                        estado: estado,
                        fecha_de_garantia_alma: fecha_de_garantia_alma,
                        fecha_crea: fecha_crea,
                        usua_crea: usua_crea,
                        fecha_modifica: fecha_modifica,
                        usua_modifica: usua_modifica,
                        observaciones_asigna_alma: observaciones_asigna_alma,
                        link_alma_asigna: link_alma_asigna

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
                        $('#modalalmacenamiento').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: 'update/actualizaralmacenamiento.php',
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

<?php } else { ?>

<?php
} ?>