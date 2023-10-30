<?php
include '../../../conexionbd.php';

if (isset($_POST['tipocomputador']) && isset($_POST['empresaOption'])) {
    $tipocomputador = $_POST['tipocomputador'];
    $empresaOption = $_POST['empresaOption'];
    $Usua_asigna = $_POST['Usua_asigna'];

    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';

    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';

    $data = odbc_exec($conexion, "SELECT 
    mc.[id]
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
    ,[Service_tag]
    ,[Serial_equipo]
    ,[Nombre_equipo]
    ,sed.[nombre_sede] as Sede
    ,empres.[nombre_empresa] as Empresa
    ,[Marca_computador]
    ,[Modelo_computador]
    ,tipocomp.[nombre_tipo_comp] as Tipo_comp
    ,tipo_memoria_ram.[nombre_tipo_ram] as tipo_memoria_ram
    ,capacidad_ram.[capacidad_ram] as capacidad_ram
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
    ,[Fecha_ingreso_c]
    ,[Targeta_Video]
    ,estad.[nombre_estado] Estado
    ,gestio.[estado_gestion] as Gestion
    ,[Fecha_garantia_c]
    FROM [ControlTIC].[dbo].[maquina_computador] as mc
    LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
    LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
    LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
    LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
    LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
    LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
    LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id
    LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id
    LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id
    LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id
    LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id
    LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id 
    where  [Estado] = '6' AND Tipo_comp = '$tipocomputador' and empresa = '$empresaOption'");
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
                <table class="table table-bordered dt-responsive table-hover display nowrap mtable" id="infodetallefactura" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">
                            <th scope="col" class="hidden-cell">Primer Nombre</th>
                            <th scope="col" class="hidden-cell">Segundo Nombre</th>
                            <th scope="col" class="hidden-cell">Primer Apellido</th>
                            <th scope="col" class="hidden-cell">Segundo Apellido</th>
                            <th scope="col" class="hidden-cell">Usua_asigna</th>

                            <th scope="col" class="hidden-cell">Cedula</th>
                            <th scope="col" class="hidden-cell">Cargo</th>

                            <th scope="col">ID</th>
                            <th scope="col" class="hidden-cell">Tipo de Máquina</th>
                            <th scope="col">Service Tag</th>
                            <th scope="col">Serial de Equipo</th>
                            <th scope="col">Nombre de Equipo</th>
                            <th scope="col">Sede</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Tipo de RAM</th>
                            <th scope="col">Memoria RAM</th>
                            <th scope="col">Tipo de Disco Duro</th>
                            <th scope="col">Capacidad de Disco Duro</th>
                            <th scope="col">Procesador</th>
                            <th scope="col">Propietario</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Sistema Operativo</th>
                            <th scope="col">Serial de Cargador</th>
                            <th scope="col">Dominio</th>
                            <th scope="col">Tipo de Usuario</th>
                            <th scope="col">Serial de Activo Fijo</th>
                            <th scope="col" class="">Fecha de Ingreso</th>
                            <th scope="col">Tarjeta de Video</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Gestión</th>
                            <th scope="col" class="">Fecha de Garantía</th>
                            <th scope="col" class="hidden-cell">Fecha de Creación</th>
                            <th scope="col" class="hidden-cell">Usuario de Creación</th>
                            <th scope="col" class="hidden-cell">Fecha de Modificación</th>
                            <th scope="col" class="hidden-cell">Usuario de Modificación</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col">Link Drive</th>
                            <th scope="col">Ejecución</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arr as $fila) { ?>
                            <tr>
                                <td class="hidden-cell"><?php echo $primernombre; ?></td>
                                <td class="hidden-cell"><?php echo $segundonombre; ?></td>
                                <td class="hidden-cell"><?php echo $primerapellido; ?></td>
                                <td class="hidden-cell"><?php echo $segundoapellido; ?></td>
                                <td class="hidden-cell"><?php echo $Usua_asigna; ?></td>

                                <td class="hidden-cell"><?php echo $cedula; ?></td>
                                <td class="hidden-cell"><?php echo $cargo; ?></td>

                                <td><?= $fila['id'] ?></td>
                                <td class="hidden-cell"><?= $fila['tipo_maquina'] ?></td>
                                <td><?= $fila['Service_tag'] ?></td>
                                <td><?= $fila['Serial_equipo'] ?></td>
                                <td><?= $fila['Nombre_equipo'] ?></td>
                                <td><?= $fila['Sede'] ?></td>
                                <td><?= $fila['Empresa'] ?></td>
                                <td><?= $fila['Marca_computador'] ?></td>
                                <td><?= $fila['Modelo_computador'] ?></td>
                                <td><?= $fila['Tipo_comp'] ?></td>
                                <td><?= $fila['tipo_memoria_ram'] ?></td>
                                <td><?= $fila['capacidad_ram'] ?></td>
                                <td><?= $fila['Tipo_discoduro'] ?></td>
                                <td><?= $fila['Capacidad_discoduro'] ?></td>
                                <td><?= $fila['Procesador'] ?></td>
                                <td><?= $fila['Propietario'] ?></td>
                                <td><?= $fila['Proveedor'] ?></td>
                                <td><?= $fila['Sistema_Operativo'] ?></td>
                                <td><?= $fila['Serial_cargador'] ?></td>
                                <td><?= $fila['Dominio'] ?></td>
                                <td><?= $fila['Tipo_usuario'] ?></td>
                                <td><?= $fila['Serial_activo_fijo'] ?></td>
                                <td class=""><?= $fila['Fecha_ingreso_c'] ?></td>
                                <td><?= $fila['Targeta_Video'] ?></td>
                                <td><?= $fila['Estado'] ?></td>
                                <td><?= $fila['Gestion'] ?></td>
                                <td class=""><?= $fila['Fecha_garantia_c'] ?></td>

                                <td>
                                    <textarea placeholder="AGREGE UNA OBSERVACIÓN" id="observaciones_asigna<?= $fila['id'] ?>" name="observaciones_asigna" style="width: 300px; height: 160px;"></textarea>
                                </td>

                                <td>
                                    <input id="link_computador_asigna<?= $fila['id'] ?>" name="link_computador_asigna"></input>
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
                                    data-tipo-memoria-ram="<?= $fila['tipo_memoria_ram'] ?>" 
                                    data-capacidad-ram="<?= $fila['capacidad_ram'] ?>" 
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
                                    data-fecha-ingreso-c="<?= $fila['Fecha_ingreso_c'] ?>" 
                                    data-tarjeta-video="<?= $fila['Targeta_Video'] ?>" 
                                    data-estado="<?= $fila['Estado'] ?>" 
                                    data-gestion="<?= $fila['Gestion'] ?>" 
                                    data-fecha-garantia-c="<?= $fila['Fecha_garantia_c'] ?>" 

                                    data-primernombre="<?php echo $primernombre; ?>" 
                                    data-segundonombre="<?php echo $segundonombre; ?>" 
                                    data-primerapellido="<?php echo $primerapellido; ?>" 
                                    data-segundoapellido="<?php echo $segundoapellido; ?>" 
                                    data-cedula="<?php echo $cedula; ?>" 
                                    data-cargo="<?php echo $cargo; ?>" 
                                    data-usua-asigna="<?php echo $Usua_asigna; ?>"></button>
                                    <!-- btn escondido para la alerta -->
                                    <button id="" type="button" class="btn btn-warning showAlertButton">Asignar</button>
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
                var Usua_asigna = $(this).data('usua-asigna');

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
                var tipo_memoria_ram = $(this).data('tipo-memoria-ram');
                var capacidad_ram = $(this).data('capacidad-ram');
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

                var observaciones_asigna = $('#observaciones_asigna' + id).val();
                var link_computador_asigna = $('#link_computador_asigna' + id).val();


                console.log("Primer Nombre:", primernombre);
                console.log("Segundo Nombre:", segundonombre);
                console.log("Primer Apellido:", primerapellido);
                console.log("Segundo Apellido:", segundoapellido);
                console.log("Usuario Asigna:", Usua_asigna);

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
                console.log("Tipo de RAM:", tipo_memoria_ram);
                console.log("Memoria RAM:", capacidad_ram);
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


                console.log("observaciones de Asignacion", observaciones_asigna);
                console.log("link Drive", link_computador_asigna);

                $.ajax({
                    url: 'asignar_maquinas/insertarcomputador.php',
                    type: 'POST',
                    data: {
                        primernombre: primernombre,
                        segundonombre: segundonombre,
                        primerapellido: primerapellido,
                        segundoapellido: segundoapellido,
                        Usua_asigna: Usua_asigna,

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
                        tipo_memoria_ram: tipo_memoria_ram,
                        capacidad_ram: capacidad_ram,
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

                        observaciones_asigna: observaciones_asigna,
                        link_computador_asigna: link_computador_asigna

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
                        $('#modalcomputador').modal('hide');
                        //mensaje de exito
                        Swal.fire('¡ASIGNADO!', '', 'success');

                        // Hacer el update mediante AJAX con el ID obtenido para actualizar
                        $.ajax({
                            url: 'update/actualizarcomputador.php',
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





<!-- SCRIPT DATATABLE -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <!-- Inicio DataTable -->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('.mtable').DataTable({
                info: false,
                select: true,
                destroy: true,
                jQueryUI: true,
                paginate: true,
                iDisplayLength: 30,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    ''
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






<?php } else { ?>

<?php
} ?>