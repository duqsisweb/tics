<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) &&  isset($_POST['usua_mantenimiento'])

) {
    $equipoId = $_POST['id'];
    $usua_mantenimiento = $_POST['usua_mantenimiento'];

    // Realiza la consulta SQL utilizando el $equipoId
    $data = odbc_exec($conexion, "SELECT 
    mc.[id]
    ,[tipo_maquina]
    ,[Service_tag]
    ,[Serial_equipo]
    ,[Nombre_equipo]
    ,sed.[nombre_sede] as Sede
    ,empres.[nombre_empresa] as Empresa
    ,[Marca_computador]
    ,[Modelo_computador]
    ,tipocomp.[nombre_tipo_comp] as Tipo_comp
    ,[Tipo_ram]
    ,[Memoria_ram]
    ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro
    ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro
    ,[Procesador]
    ,propietari.[descripcion] as Propietario
    ,[Proveedor]
    ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo
    ,[Serial_cargador]
    ,[Dominio]
    ,[Tipo_usuario]
    ,[Serial_activo_fijo]
    ,[Fecha_ingreso]
    ,[Targeta_Video]
    ,estad.[nombre_estado] Estado
    ,gestio.[estado_gestion] as Gestion
    ,[Fecha_garantia]
    ,[Fecha_crea]
    ,[Usua_crea]
    ,[Fecha_modifica]
    ,[Usua_modifica]
	,[Usua_mantenimiento]
    ,[Fecha_mantenimiento_inicio]
    ,[Fecha_mantenimiento_fin]
    ,[obervaciones_mantenimiento]
    FROM [ControlTIC].[dbo].[maquina_computador] as mc
    LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
    LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
    LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
    LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
    LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
    LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
    LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id
    LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id
    LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id  WHERE mc.id = $equipoId");
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
                            <th scope="col" class="hidden-cell ">USUARIO MANTENIMIENTO</th>
                            <th scope="col">FECHA INICIO MANTENIMIENTO</th>
                            <th scope="col">FECHA FINAL</th>
                            <th scope="col">SERVICE TAG</th>
                            <th scope="col">SERIAL EQUIPO</th>
                            <th scope="col">NOMBRE EQUIPO</th>
                            <th scope="col">MARCA COMPUTADOR</th>
                            <th scope="col">PROCESADOR</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">TIPO DE CPMPUTADOR</th>
                            <th scope="col">OBSERBACIONES</th>
                            <th scope="col">ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arr as $fila) { ?>
                            <tr>

                                <td class="hidden-cell "><?php echo $usua_mantenimiento; ?></td>
                               <!-- ... Otras columnas de la tabla ... -->
                                <td id="fechaInicioMantenimiento_<?= $fila['id'] ?>"><?= date('Y-m-d H:i:s') ?></td>
                                <td id="fechaFinal_<?= $fila['id'] ?>"><?= strftime('%d de %B de %Y', strtotime('+6 months')) ?></td>
                                <!-- ... Otras columnas de la tabla ... -->

                                <td><?= $fila['Service_tag'] ?></td>
                                <td><?= $fila['Serial_equipo'] ?></td>
                                <td><?= $fila['Nombre_equipo'] ?></td>
                                <td><?= $fila['Marca_computador'] ?></td>
                                <td><?= $fila['Procesador'] ?></td>
                                <td><?= $fila['Estado'] ?></td>
                                <td><?= $fila['Tipo_comp'] ?></td>
                                <td>
                                    <textarea placeholder="DESCRIPCIÓN DETALLADA DEL MANTENIMIENTO PREVENTIVO" id="observaciones_mantenimiento<?= $fila['id'] ?>" name="observaciones_mantenimiento" style="width: 300px; height: 360px;"></textarea>
                                </td>

                                <td>
                                    <button id="enviarcomputador" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" 
                                    data-id="<?= $fila['id'] ?>" 
                                    data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                                    data-service-tag="<?= $fila['Service_tag'] ?>" 
                                    data-serial-equipo="<?= $fila['Serial_equipo'] ?>" 
                                    data-nombre-equipo="<?= $fila['Nombre_equipo'] ?>" 
                                    data-sede="<?= $fila['Sede'] ?>" 
                                    data-empresa="<?= $fila['Empresa'] ?>" 
                                    data-marca-computador="<?= $fila['Marca_computador'] ?>"
                                    data-modelo-computador="<?= $fila['Modelo_computador'] ?>" 
                                    data-tipo-comp="<?= $fila['Tipo_comp'] ?>" 
                                    data-tipo-ram="<?= $fila['Tipo_ram'] ?>" 
                                    data-memoria-ram="<?= $fila['Memoria_ram'] ?>" 
                                    data-tipo-discoduro="<?= $fila['Tipo_discoduro'] ?>" 
                                    data-capacidad-discoduro="<?= $fila['Capacidad_discoduro'] ?>" 
                                    data-procesador="<?= $fila['Procesador'] ?>" 
                                    data-propietario="<?= $fila['Propietario'] ?>" 
                                    data-proveedor="<?= $fila['Proveedor'] ?>" 
                                    data-sistema-operativo="<?= $fila['Sistema_Operativo'] ?>" 
                                    data-serial-cargador="<?= $fila['Serial_cargador'] ?>" 
                                    data-dominio="<?= $fila['Dominio'] ?>" 
                                    data-tipo-usuario="<?= $fila['Tipo_usuario'] ?>" 
                                    data-serial-activo-fijo="<?= $fila['Serial_activo_fijo'] ?>" 
                                    data-fecha-ingreso="<?= $fila['Fecha_ingreso'] ?>" 
                                    data-tarjeta-video="<?= $fila['Targeta_Video'] ?>" 
                                    data-estado="<?= $fila['Estado'] ?>" 
                                    data-gestion="<?= $fila['Gestion'] ?>" 
                                    data-fecha-garantia="<?= $fila['Fecha_garantia'] ?>" 
                                    data-fecha-crea="<?= $fila['Fecha_crea'] ?>" 
                                    data-usua-crea="<?= $fila['Usua_crea'] ?>" 
                                    data-fecha-modifica="<?= $fila['Fecha_modifica'] ?>" 
                                    data-usua-modifica="<?= $fila['Usua_modifica'] ?>" 
                                
                                    data-segundonombre="<?php echo $segundonombre; ?>" 
                                    data-primerapellido="<?php echo $primerapellido; ?>" 
                                    data-segundoapellido="<?php echo $segundoapellido; ?>" 
                                    data-cedula="<?php echo $cedula; ?>" 
                                    data-cargo="<?php echo $cargo; ?>" 
                                    data-usua-mantenimiento="<?php echo $usua_mantenimiento; ?>"
                                    data-observaciones-mantenimiento="<?= $fila['observaciones_mantenimiento'] ?>" 

                                    ></button>
                                    
                                    <!-- btn escondido para la alerta -->
                                    <button id="" type="button" class="btn btn-info showAlertButton">REGISTRAR MANTENIMIENTO</button>
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

                   // Obtener el ID del equipo desde el botón
                var equipoId = $(this).data('id');

                var usua_mantenimiento = $(this).data('usua-mantenimiento');
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
                var fecha_ingreso = $(this).data('fecha-ingreso');
                var tarjeta_video = $(this).data('tarjeta-video');
                var estado = $(this).data('estado');
                var gestion = $(this).data('gestion');
                var fecha_garantia = $(this).data('fecha-garantia');
                var fecha_crea = $(this).data('fecha-crea');
                var usua_crea = $(this).data('usua-crea');
                var fecha_modifica = $(this).data('fecha-modifica');
                var usua_modifica = $(this).data('usua-modifica');
                var observaciones_mantenimiento = $('#observaciones_mantenimiento' + id).val();
                var fechaInicioMantenimiento = $('#fechaInicioMantenimiento_' + equipoId).text();
                var fechaFinal = $('#fechaFinal_' + equipoId).text();

                




                console.log("Usuario mantenimiento:", usua_mantenimiento);
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
                console.log("Fecha de Ingreso:", fecha_ingreso);
                console.log("Tarjeta de Video:", tarjeta_video);
                console.log("Estado:", estado);
                console.log("Gestión:", gestion);
                console.log("Fecha de Garantía:", fecha_garantia);
                console.log("Fecha de Creación:", fecha_crea);
                console.log("Usuario de Creación:", usua_crea);
                console.log("Fecha de Modificación:", fecha_modifica);
                console.log("Usuario de Modificación:", usua_modifica);
                console.log("observaciones de Mantenimiento", observaciones_mantenimiento);
                console.log("Fecha de inicio de mantenimiento:", fechaInicioMantenimiento);
                console.log("Fecha final:", fechaFinal);



                $.ajax({
                    url: '../create_mantenimiento/insertarcomputador.php',
                    type: 'POST',
                    data: {

                        usua_mantenimiento: usua_mantenimiento,
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
                        fecha_ingreso: fecha_ingreso,
                        tarjeta_video: tarjeta_video,
                        estado: estado,
                        gestion: gestion,
                        fecha_garantia: fecha_garantia,
                        fecha_crea: fecha_crea,
                        usua_crea: usua_crea,
                        fecha_modifica: fecha_modifica,
                        usua_modifica: usua_modifica,
                        observaciones_mantenimiento: observaciones_mantenimiento,
                        fechaInicioMantenimiento: fechaInicioMantenimiento,
                        fechaFinal: fechaFinal 

                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);
                    }
                });
            });
        });
    </script>

    <!-- <script>
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
                        $('#modalcomputador').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: '',
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
    </script> -->




     <script>
        $(document).ready(function() {
            $('.showAlertButton').click(function() {
                
                var fechaInicioMantenimiento = $('#fechaInicioMantenimiento_' + equipoId).text();
                var fechaFinal = $('#fechaFinal_' + equipoId).text();
                
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
                        $('#modalcomputador').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: '../update_mantenimiento/actualizar_computador_mantenimiento.php',
                            type: 'POST',
                            data: {
                                idToUpdate: idToUpdate,
                                fechaInicioMantenimiento: fechaInicioMantenimiento,
                                fechaFinal: fechaFinal 
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