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

$data = odbc_exec($conexion, "SELECT [id] ,[tipo_maquina] ,[imei] ,[serial_equipo_celular] ,[marca] ,[modelo] ,[fecha_ingreso] ,[capacidad] ,[ram_celular] ,[estado] ,[gestion] ,[fecha_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] FROM [ControlTIC].[dbo].[maquina_celular] where estado = '6' ");

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
                    <th scope="col">Fecha de Creación</th>
                    <th scope="col">Usuario de Creación</th>
                    <th scope="col">Fecha de Modificación</th>
                    <th scope="col">Usuario de Modificación</th>
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
                        <td><?= $fila['imei'] ?></td>
                        <td><?= $fila['serial_equipo_celular'] ?></td>
                        <td><?= $fila['marca'] ?></td>
                        <td><?= $fila['modelo'] ?></td>
                        <td><?= $fila['fecha_ingreso'] ?></td>
                        <td><?= $fila['capacidad'] ?></td>
                        <td><?= $fila['ram_celular'] ?></td>
                        <td><?= $fila['estado'] ?></td>
                        <td><?= $fila['gestion'] ?></td>
                        <td><?= $fila['fecha_garantia'] ?></td>
                        <td><?= $fila['fecha_crea'] ?></td>
                        <td><?= $fila['usua_crea'] ?></td>
                        <td><?= $fila['fecha_modifica'] ?></td>
                        <td><?= $fila['usua_modifica'] ?></td>
                        <td>
                            <button id="enviarcelular" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" data-id="<?= $fila['id'] ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-primernombre="<?= $primernombre ?>" data-segundonombre="<?= $segundonombre ?>" data-primerapellido="<?= $primerapellido ?>" data-segundoapellido="<?= $segundoapellido ?>" data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>" data-empresa="<?= $empresa ?>" data-imei="<?= $fila['imei'] ?>" data-serial-equipo-celular="<?= $fila['serial_equipo_celular'] ?>" data-marca="<?= $fila['marca'] ?>" data-modelo="<?= $fila['modelo'] ?>" data-fecha-ingreso="<?= $fila['fecha_ingreso'] ?>" data-capacidad="<?= $fila['capacidad'] ?>" data-ram-celular="<?= $fila['ram_celular'] ?>" data-estado="<?= $fila['estado'] ?>" data-gestion="<?= $fila['gestion'] ?>" data-fecha-garantia="<?= $fila['fecha_garantia'] ?>" data-fecha-crea="<?= $fila['fecha_crea'] ?>" data-usua-crea="<?= $fila['usua_crea'] ?>" data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" data-usua-modifica="<?= $fila['usua_modifica'] ?>"></button>
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
            var imei = $(this).data('imei');
            var serial_equipo_celular = $(this).data('serial-equipo-celular');
            var marca = $(this).data('marca');
            var modelo = $(this).data('modelo');
            var fecha_ingreso = $(this).data('fecha-ingreso');
            var capacidad = $(this).data('capacidad');
            var ram_celular = $(this).data('ram-celular');
            var estado = $(this).data('estado');
            var gestion = $(this).data('gestion');
            var fecha_garantia = $(this).data('fecha-garantia');
            var fecha_crea = $(this).data('fecha-crea');
            var usua_crea = $(this).data('usua-crea');
            var fecha_modifica = $(this).data('fecha-modifica');
            var usua_modifica = $(this).data('usua-modifica');

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
            console.log("Fecha de Ingreso:", fecha_ingreso);
            console.log("Capacidad:", capacidad);
            console.log("RAM:", ram_celular);
            console.log("Estado:", estado);
            console.log("Gestión:", gestion);
            console.log("Fecha de Garantía:", fecha_garantia);
            console.log("Fecha de Creación:", fecha_crea);
            console.log("Usuario de Creación:", usua_crea);
            console.log("Fecha de Modificación:", fecha_modifica);
            console.log("Usuario de Modificación:", usua_modifica);

            $.ajax({
                url: 'create/insertarcelular.php',
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
                    imei: imei,
                    serial_equipo_celular: serial_equipo_celular,
                    marca: marca,
                    modelo: modelo,
                    fecha_ingreso: fecha_ingreso,
                    capacidad: capacidad,
                    ram_celular: ram_celular,
                    estado: estado,
                    gestion: gestion,
                    fecha_garantia: fecha_garantia,
                    fecha_crea: fecha_crea,
                    usua_crea: usua_crea,
                    fecha_modifica: fecha_modifica,
                    usua_modifica: usua_modifica
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
                    $('#modalcelular').modal('hide');
                    //mensaje de exito
                    Swal.fire('¡Guardado!', '', 'success');

                    // Hacer el update mediante AJAX con el ID obtenido para actualizar
                    $.ajax({
                        url: 'update/actualizarcelular.php',
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