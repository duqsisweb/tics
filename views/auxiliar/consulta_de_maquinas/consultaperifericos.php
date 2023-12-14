<?php
include '../../../conexionbd.php';

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

    $Usua_asigna = $_POST['Usua_asigna'];

    $data = odbc_exec($conexion, "SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[serial_perifericos]
    ,desperifericos.[nombre_descripcion] as descripcion_perifericos
    ,[marca_perifericos]
    ,[modelo_perifericos]
    ,[placa_activo_perifericos]
    ,sed.[nombre_sede] as sede_perifericos
    ,[ubicacion_perifericos]
    ,[tipo] 
    ,[tipo_toner]
    ,estad.[nombre_estado] AS estado
    ,gestio.estado_gestion as gestion_peri
    ,empres.[nombre_empresa] as empresa
    ,[fecha_de_garantia_peri]
    FROM [ControlTIC].[dbo].[maquina_perifericos] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[descripcion_perifericos] as desperifericos ON mc.descripcion_perifericos = desperifericos.id 
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_perifericos =sed.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_peri = gestio.id
    LEFT JOIN [ControlTIC].[dbo].[empresa] as empres ON mc.empresa = empres.id 
    LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id
            where estado = '6' and gestion_peri = '3' and descripcion_perifericos = '$tipo_perifericos' ");

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
                        <th scope="col">Estado</th>
                        <th scope="col">Gestion</th>
                        <th scope="col">Empresa</th>
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
                            <td><?= $fila['estado'] ?></td>
                            <td><?= $fila['gestion_peri'] ?></td>
                            <td><?= $fila['empresa'] ?></td>
                            <td><?= $fila['fecha_de_garantia_peri'] ?></td>
                            <td>
                                <textarea placeholder="AGREGE UNA OBSERVACIÓN" id="observaciones_asigna_peri<?= $fila['id'] ?>" name="observaciones_asigna_peri" style="width: 300px; height: 160px;"></textarea>
                            </td>

                            <td>
                                <input id="link_peri_asigna<?= $fila['id'] ?>" name="link_peri_asigna"></input>
                            </td>

                            <td>
                                <button id="enviarperifericos" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" 
                                data-id="<?= $fila['id'] ?>" 
                                data-primernombre="<?= $primernombre ?>" 
                                data-segundonombre="<?= $segundonombre ?>" 
                                data-primerapellido="<?= $primerapellido ?>" 
                                data-segundoapellido="<?= $segundoapellido ?>" 
                                data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>" 
                                data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                                data-serial-perifericos="<?= $fila['serial_perifericos'] ?>" 
                                data-descripcion-perifericos="<?= $fila['descripcion_perifericos'] ?>" 
                                data-marca-perifericos="<?= $fila['marca_perifericos'] ?>" 
                                data-modelo-perifericos="<?= $fila['modelo_perifericos'] ?>" 
                                data-placa-activo-perifericos="<?= $fila['placa_activo_perifericos'] ?>" 
                                data-sede-perifericos="<?= $fila['sede_perifericos'] ?>" 
                                data-ubicacion-perifericos="<?= $fila['ubicacion_perifericos'] ?>" 
                                data-tipo="<?= $fila['tipo'] ?>" 
                                data-tipo-toner="<?= $fila['tipo_toner'] ?>" 
                                data-gestion-peri="<?= $fila['gestion_peri'] ?>" 
                                data-empresa="<?= $fila['empresa'] ?>" 
                                data-fecha-garantia-peri="<?= $fila['fecha_de_garantia_peri'] ?>" 
                                data-usua-asigna="<?php echo $Usua_asigna; ?>">
                            </button>

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
                var gestion_peri = $(this).data('gestion-peri');
                var empresa_perifericos = $(this).data('empresa-perifericos');
                var fecha_de_garantia_peri = $(this).data('fecha-garantia-peri');
                var estado = $(this).data('estado');
                var observaciones_asigna_peri = $('#observaciones_asigna_peri' + id).val();
                var link_peri_asigna = $('#link_peri_asigna' + id).val();
                var Usua_asigna = $(this).data('usua-asigna');

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
                console.log("Serial de periféricos:", serial_perifericos);
                console.log("Descripción de periféricos:", descripcion_perifericos);
                console.log("Marca de periféricos:", marca_perifericos);
                console.log("Modelo de periféricos:", modelo_perifericos);
                console.log("Placa activo de periféricos:", placa_activo_perifericos);
                console.log("Sede de periféricos:", sede_perifericos);
                console.log("Ubicación de periféricos:", ubicacion_perifericos);
                console.log("Tipo", tipo);
                console.log("Tipo de toner:", tipo_toner);
                console.log("Gestión:", gestion_peri);
                console.log("Fecha de garantía:", fecha_de_garantia_peri);
                console.log("Estado:", estado);
                console.log("observaciones de Asignacion", observaciones_asigna_peri);
                console.log("link Drive", link_peri_asigna);

                $.ajax({
                    url: 'asignar_maquinas/insertarperifericos.php',
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
                        serial_perifericos: serial_perifericos,
                        descripcion_perifericos: descripcion_perifericos,
                        marca_perifericos: marca_perifericos,
                        modelo_perifericos: modelo_perifericos,
                        placa_activo_perifericos: placa_activo_perifericos,
                        sede_perifericos: sede_perifericos,
                        ubicacion_perifericos: ubicacion_perifericos,
                        tipo: tipo,
                        tipo_toner: tipo_toner,
                        gestion_peri: gestion_peri,
                        empresa_perifericos: empresa_perifericos,
                        fecha_de_garantia_peri: fecha_de_garantia_peri,
                        estado: estado,
                        observaciones_asigna_peri: observaciones_asigna_peri,
                        link_peri_asigna: link_peri_asigna
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