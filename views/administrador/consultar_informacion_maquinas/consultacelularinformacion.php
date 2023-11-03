<?php


include '../../../conexionbd.php';

    // Obtener los valores pasados desde el formulario principal
    $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
    $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
    $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
    $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

    $Usua_asigna = $_POST['Usua_asigna'];

    $data = odbc_exec($conexion, "SELECT  [id_asignacion]
    ,[id]
    ,[tipo_maquina]
    ,[imei]
    ,[serial_equipo_celular]
    ,[marca]
    ,[modelo]
    ,[fecha_ingreso_cel]
    ,[capacidad]
    ,[ram_celular]
    ,[estado]
    ,[gestion]
    ,[fecha_garantia_cel]
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
FROM [ControlTIC].[dbo].[asignacion_celular] where cedula= '$cedula' and estado_asignacion = 'VIGENTE'");

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
        <table class="table table-bordered dt-responsive table-hover display nowrap mtable" id="infodetallefactura" cellspacing="0" style="text-align: center;">
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
                    <th scope="col">IMEI</th>
                    <th scope="col">Serial de Equipo Celular</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col">RAM Celular</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Gestión</th>
                    <th scope="col">Fecha de Garantía</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">LINK DRIVE</th>
                    <th scope="col">EJECUCION</th>
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
                        <td><?= $fila['imei'] ?></td>
                        <td><?= $fila['serial_equipo_celular'] ?></td>
                        <td><?= $fila['marca'] ?></td>
                        <td><?= $fila['modelo'] ?></td>
                        <td><?= $fila['fecha_ingreso_cel'] ?></td>
                        <td><?= $fila['capacidad'] ?></td>
                        <td><?= $fila['ram_celular'] ?></td>
                        <td><?= $fila['estado'] ?></td>
                        <td><?= $fila['gestion'] ?></td>
                        <td><?= $fila['fecha_garantia_cel'] ?></td>

                        <td>
                            <textarea placeholder="AGREGE UNA OBSERVACIÓN" id="observaciones_desasigna<?= $fila['id'] ?>" name="observaciones_desasigna" style="width: 300px; height: 160px;"></textarea>
                        </td>

                        <td>
                            <input id="link_celular_desasigna<?= $fila['id'] ?>" name="link_celular_desasigna"></input>
                        </td>
                        <td> <button id="enviarcelular" style="display: none;" type="submit" class="btn btn-outline-danger asignar-btn" data-id="<?= $fila['id'] ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-primernombre="<?= $primernombre ?>" data-segundonombre="<?= $segundonombre ?>" data-primerapellido="<?= $primerapellido ?>" data-segundoapellido="<?= $segundoapellido ?>" data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>" data-empresa="<?= $empresa ?>" data-imei="<?= $fila['imei'] ?>" data-serial-equipo-celular="<?= $fila['serial_equipo_celular'] ?>" data-marca="<?= $fila['marca'] ?>" data-modelo="<?= $fila['modelo'] ?>" data-fecha-ingreso-cel="<?= $fila['fecha_ingreso_cel'] ?>" data-capacidad="<?= $fila['capacidad'] ?>" data-ram-celular="<?= $fila['ram_celular'] ?>" data-estado="<?= $fila['estado'] ?>" data-gestion="<?= $fila['gestion'] ?>" data-fecha-garantia-cel="<?= $fila['fecha_garantia_cel'] ?>" data-fecha-crea="<?= $fila['fecha_crea'] ?>" data-usua-crea="<?= $fila['usua_crea'] ?>" data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" data-usua-modifica="<?= $fila['usua_modifica'] ?>" 
                        data-usua-asigna="<?php echo $Usua_asigna; ?>" ></button> <!-- btn escondido para la alerta --> <button id="" type="button" class="btn btn-outline-danger showAlertButton">REMOVER</button>
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
            var imei = $(this).data('imei');
            var serial_equipo_celular = $(this).data('serial-equipo-celular');
            var marca = $(this).data('marca');
            var modelo = $(this).data('modelo');
            var fecha_ingreso_cel = $(this).data('fecha-ingreso-cel');
            var capacidad = $(this).data('capacidad');
            var ram_celular = $(this).data('ram-celular');
            var estado = $(this).data('estado');
            var gestion = $(this).data('gestion');
            var fecha_garantia_cel = $(this).data('fecha-garantia-cel');

            var observaciones_desasigna = $('#observaciones_desasigna' + id).val();
            var link_celular_desasigna = $('#link_celular_desasigna' + id).val();

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
            console.log("IMEI:", imei);
            console.log("Serial:", serial_equipo_celular);
            console.log("Marca:", marca);
            console.log("Modelo:", modelo);
            console.log("Fecha de Ingreso:", fecha_ingreso_cel);
            console.log("Capacidad:", capacidad);
            console.log("RAM:", ram_celular);
            console.log("Estado:", estado);
            console.log("Gestión:", gestion);
            console.log("Fecha de Garantía:", fecha_garantia_cel);

            console.log("observaciones de Asignacion", observaciones_desasigna);
            console.log("link Drive", link_celular_desasigna);

            $.ajax({
                url: 'historial_remover_asignacion/deletecelularhistorial.php',
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
                    imei: imei,
                    serial_equipo_celular: serial_equipo_celular,
                    marca: marca,
                    modelo: modelo,
                    fecha_ingreso_cel: fecha_ingreso_cel,
                    capacidad: capacidad,
                    ram_celular: ram_celular,
                    estado: estado,
                    gestion: gestion,
                    fecha_garantia_cel: fecha_garantia_cel,

                    observaciones_desasigna: observaciones_desasigna,
                    link_celular_desasigna: link_celular_desasigna
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
                    $('#modalcelularinformacion').modal('hide');
                    //mensaje de exito
                    Swal.fire('¡Guardado!', '', 'success');

                    // Hacer el update mediante AJAX con el ID obtenido para actualizar
                    $.ajax({
                        url: 'delete/deletecelular.php',
                        type: 'POST',
                        data: {
                            idToUpdate: idToUpdate,
                            linkInput: linkInput
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





