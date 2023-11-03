<?php
include '../../../conexionbd.php';

if (
    isset($_POST['tipocomputador']) && isset($_POST['empresaOption']) && isset($_POST['cedula'])
) {
    $tipocomputador = $_POST['tipocomputador'];
    $empresaOption = $_POST['empresaOption'];
    $Usua_retira = $_POST['Usua_retira'];

    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';

    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';

    $data = odbc_exec($conexion, "SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,[Sede] ,[Empresa] ,[Marca_computador] ,[Modelo_computador] ,[Tipo_comp] ,[Tipo_ram] ,[Memoria_ram] ,[Tipo_discoduro] ,[Capacidad_discoduro] ,[Procesador] ,[Propietario] ,[Proveedor] ,[Sistema_Operativo] ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso_c] ,[Targeta_Video] ,[Estado] ,[Gestion] ,[Fecha_garantia_c] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] ,[Usua_asigna] ,[Fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[estado_asignacion] ,[observaciones] FROM [ControlTIC].[dbo].[asignacion_computador] where cedula = '$cedula' AND estado_asignacion = 'VIGENTE' ");
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



    <div class="">
        <div class="text-right mt-3">
            <div class="col-md-12">
                <!-- tbl info de productos -->
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="infodetallefactura" cellspacing="0" style="text-align: center;">
                    <thead>

                        <tr class="encabezado table-dark">
                            <th scope="col" class="hidden-cell">Primer Nombre</th>
                            <th scope="col" class="hidden-cell">Segundo Nombre</th>
                            <th scope="col" class="hidden-cell">Primer Apellido</th>
                            <th scope="col" class="hidden-cell">Segundo Apellido</th>
                            <th scope="col" class="hidden-cell">Cedula</th>
                            <th scope="col" class="hidden-cell">Cargo</th>
                            <th scope="col" class="hidden-cell"></th>
                            <th scope="col">Service Tag</th>
                            <th scope="col">Serial de Equipo</th>
                            <th scope="col">Nombre de Equipo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Memoria RAM</th>
                            <th scope="col">Capacidad de Disco Duro</th>
                            <th scope="col">Procesador</th>
                            <th scope="col">Sistema Operativo</th>
                            <th scope="col">Dominio</th>
                            <th scope="col">Tipo de Usuario</th>
                            <th scope="col">Serial de Activo Fijo</th>
                            <th scope="col">Tarjeta de Video</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col">Link Divre</th>
                            <th scope="col">Acciones</th>
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
                                <td class="hidden-cell"><?php echo $Usua_retira; ?></td>
                                <td><?= $fila['Service_tag'] ?></td>
                                <td><?= $fila['Serial_equipo'] ?></td>
                                <td><?= $fila['Nombre_equipo'] ?></td>
                                <td><?= $fila['Marca_computador'] ?></td>
                                <td><?= $fila['Modelo_computador'] ?></td>
                                <td><?= $fila['Memoria_ram'] ?></td>
                                <td><?= $fila['Capacidad_discoduro'] ?></td>
                                <td><?= $fila['Procesador'] ?></td>
                                <td><?= $fila['Sistema_Operativo'] ?></td>
                                <td><?= $fila['Dominio'] ?></td>
                                <td><?= $fila['Tipo_usuario'] ?></td>
                                <td><?= $fila['Serial_activo_fijo'] ?></td>
                                <td><?= $fila['Targeta_Video'] ?></td>
                                <td>
                                    <textarea placeholder="AGREGE UNA OBSERVACIÓN" id="observaciones_desasigna<?= $fila['id'] ?>" name="observaciones_desasigna" style="width: 300px; height: 160px;"></textarea>
                                </td>
                                <td>
                                    <input id="link_computador_desasigna<?= $fila['id'] ?>" name="link_computador_desasigna"></input>
                                </td>

                                <td>
                                    <button id="enviarcomputador" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" data-id="<?= $fila['id'] ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-service-tag="<?= $fila['Service_tag'] ?>" data-serial-equipo="<?= $fila['Serial_equipo'] ?>" data-nombre-equipo="<?= $fila['Nombre_equipo'] ?>" data-sede="<?= $fila['Sede'] ?>" data-empresa="<?= $fila['Empresa'] ?>" data-marca-computador="<?= $fila['Marca_computador'] ?>" data-modelo-computador="<?= $fila['Modelo_computador'] ?>" data-tipo-comp="<?= $fila['Tipo_comp'] ?>" data-tipo-ram="<?= $fila['Tipo_ram'] ?>" data-memoria-ram="<?= $fila['Memoria_ram'] ?>" data-tipo-discoduro="<?= $fila['Tipo_discoduro'] ?>" data-capacidad-discoduro="<?= $fila['Capacidad_discoduro'] ?>" data-procesador="<?= $fila['Procesador'] ?>" data-propietario="<?= $fila['Propietario'] ?>" data-proveedor="<?= $fila['Proveedor'] ?>" data-sistema-operativo="<?= $fila['Sistema_Operativo'] ?>" data-serial-cargador="<?= $fila['Serial_cargador'] ?>" data-dominio="<?= $fila['Dominio'] ?>" data-tipo-usuario="<?= $fila['Tipo_usuario'] ?>" data-serial-activo-fijo="<?= $fila['Serial_activo_fijo'] ?>" data-fecha-ingreso-c="<?= $fila['Fecha_ingreso_c'] ?>" data-tarjeta-video="<?= $fila['Targeta_Video'] ?>" data-estado="<?= $fila['Estado'] ?>" data-gestion="<?= $fila['Gestion'] ?>" data-fecha-garantia-c="<?= $fila['Fecha_garantia_c'] ?>" data-fecha-crea="<?= $fila['Fecha_crea'] ?>" data-usua-crea="<?= $fila['Usua_crea'] ?>" data-fecha-modifica="<?= $fila['Fecha_modifica'] ?>" data-usua-modifica="<?= $fila['Usua_modifica'] ?>" data-primernombre="<?php echo $primernombre; ?>" data-segundonombre="<?php echo $segundonombre; ?>" data-primerapellido="<?php echo $primerapellido; ?>" data-segundoapellido="<?php echo $segundoapellido; ?>" data-cedula="<?php echo $cedula; ?>" data-cargo="<?php echo $cargo; ?>" data-usua-retira="<?php echo $Usua_retira ?>"></button>
                                    <!-- btn escondido para la alerta -->
                                    <button id="" type="button" class="btn btn-danger showAlertButton">Descartar</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
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
                var Usua_retira = $(this).data('usua-retira');

                var cedula = $(this).data('cedula');
                var cargo = $(this).data('cargo');

                var id = $(this).data('id');
                var tipo_maquina = $(this).data('tipo-maquina');
                var service_tag = $(this).data('service-tag');
                var serial_equipo = $(this).data('serial-equipo');
                var nombre_equipo = $(this).data('nombre-equipo');
                var sede = $(this).data('sede');
                var empresa = $(this).data('empresa');
                var marca_computador = $(this).data('marca-computador');
                var modelo_computador = $(this).data('modelo-computador');
                var tipo_comp = $(this).data('tipo-comp');
                var tipo_ram = $(this).data('tipo-ram');
                var memoria_ram = $(this).data('memoria-ram');
                var tipo_discoduro = $(this).data('tipo-discoduro');
                var capacidad_discoduro = $(this).data('capacidad-discoduro');
                var procesador = $(this).data('procesador');
                var propietario = $(this).data('propietario');
                var proveedor = $(this).data('proveedor');
                var sistema_operativo = $(this).data('sistema-operativo');
                var serial_cargador = $(this).data('serial-cargador');
                var dominio = $(this).data('dominio');
                var tipo_usuario = $(this).data('tipo-usuario');
                var serial_activo_fijo = $(this).data('serial-activo-fijo');
                var Fecha_ingreso_c = $(this).data('fecha-ingreso-c');
                var tarjeta_video = $(this).data('tarjeta-video');
                var estado = $(this).data('estado');
                var gestion = $(this).data('gestion');
                var Fecha_garantia_c = $(this).data('fecha-garantia-c');
                var fecha_crea = $(this).data('fecha-crea');
                var usua_crea = $(this).data('usua-crea');
                var fecha_modifica = $(this).data('fecha-modifica');
                var usua_modifica = $(this).data('usua-modifica');
                var observaciones_desasigna = $('#observaciones_desasigna' + id).val();
                var link_computador_desasigna = $('#link_computador_desasigna' + id).val();


                console.log("Primer Nombre:", primernombre);
                console.log("Segundo Nombre:", segundonombre);
                console.log("Primer Apellido:", primerapellido);
                console.log("Segundo Apellido:", segundoapellido);
                console.log("Usuario Retira:", Usua_retira);

                console.log("Cédula:", cedula);
                console.log("Cargo:", cargo);

                console.log("Datos a enviar:");
                console.log("ID:", id);
                console.log("Tipo de máquina:", tipo_maquina);
                console.log("Service Tag:", service_tag);
                console.log("Serial de Equipo:", serial_equipo);
                console.log("Nombre de Equipo:", nombre_equipo);
                console.log("Sede:", sede);
                console.log("Empresa:", empresa);
                console.log("Marca de Computador:", marca_computador);
                console.log("Modelo de Computador:", modelo_computador);
                console.log("Tipo de Componente:", tipo_comp);
                console.log("Tipo de RAM:", tipo_ram);
                console.log("Memoria RAM:", memoria_ram);
                console.log("Tipo de Disco Duro:", tipo_discoduro);
                console.log("Capacidad de Disco Duro:", capacidad_discoduro);
                console.log("Procesador:", procesador);
                console.log("Propietario:", propietario);
                console.log("Proveedor:", proveedor);
                console.log("Sistema Operativo:", sistema_operativo);
                console.log("Serial de Cargador:", serial_cargador);
                console.log("Dominio:", dominio);
                console.log("Tipo de Usuario:", tipo_usuario);
                console.log("Serial de Activo Fijo:", serial_activo_fijo);
                console.log("Fecha de Ingreso:", Fecha_ingreso_c);
                console.log("Tarjeta de Video:", tarjeta_video);
                console.log("Estado:", estado);
                console.log("Gestión:", gestion);
                console.log("Fecha de Garantía:", Fecha_garantia_c);
                console.log("Fecha de Creación:", fecha_crea);
                console.log("Usuario de Creación:", usua_crea);
                console.log("Fecha de Modificación:", fecha_modifica);
                console.log("Usuario de Modificación:", usua_modifica);
                console.log("Observaciones de desasignacion", observaciones_desasigna);
                console.log("link Drive", link_computador_desasigna);

                $.ajax({
                    url: 'historial_remover_asignacion/deletecomputadorhistorial.php',
                    type: 'POST',
                    data: {
                        primernombre: primernombre,
                        segundonombre: segundonombre,
                        primerapellido: primerapellido,
                        segundoapellido: segundoapellido,
                        Usua_retira: Usua_retira,

                        cedula: cedula,
                        cargo: cargo,

                        id: id,
                        tipo_maquina: tipo_maquina,
                        service_tag: service_tag,
                        serial_equipo: serial_equipo,
                        nombre_equipo: nombre_equipo,
                        sede: sede,
                        empresa: empresa,
                        marca_computador: marca_computador,
                        modelo_computador: modelo_computador,
                        tipo_comp: tipo_comp,
                        tipo_ram: tipo_ram,
                        memoria_ram: memoria_ram,
                        tipo_discoduro: tipo_discoduro,
                        capacidad_discoduro: capacidad_discoduro,
                        procesador: procesador,
                        propietario: propietario,
                        proveedor: proveedor,
                        sistema_operativo: sistema_operativo,
                        serial_cargador: serial_cargador,
                        dominio: dominio,
                        tipo_usuario: tipo_usuario,
                        serial_activo_fijo: serial_activo_fijo,
                        Fecha_ingreso_c: Fecha_ingreso_c,
                        tarjeta_video: tarjeta_video,
                        estado: estado,
                        gestion: gestion,
                        Fecha_garantia_c: Fecha_garantia_c,
                        fecha_crea: fecha_crea,
                        usua_crea: usua_crea,
                        fecha_modifica: fecha_modifica,
                        usua_modifica: usua_modifica,
                        observaciones_desasigna: observaciones_desasigna,
                        link_computador_desasigna: link_computador_desasigna

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
                var linkInput = $('#observaciones_desasigna' + idToUpdate).val(); // Obtener el valor del campo de entrada

                Swal.fire({
                    title: '¿Quieres guardar los cambios?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `No guardar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Cerrar el modal
                        $('#modalcomputadorinformacion').modal('hide');
                        //mensaje de éxito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: 'delete/deletecomputador.php',
                            type: 'POST',
                            data: {
                                idToUpdate: idToUpdate,
                                linkInput: linkInput
                            },
                            success: function(response) {
                                console.log("Desasignación exitosa:", response);
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