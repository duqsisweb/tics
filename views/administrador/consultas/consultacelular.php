<?php


include '../../../conexionbd.php';

// Obtener los valores pasados desde el formulario principal
$primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
$segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
$primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
$segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';

$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
$cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';

$data = odbc_exec($conexion, "SELECT [id] ,[tipo_maquina] ,[Imei] ,[serial_equipo_celular] ,[Marca] ,[Modelo] ,[Fecha_ingreso] ,[Capacidad] ,[Ram_celular] ,[Estado] ,[Gestion] ,[Fecha_garantia] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] FROM [ControlTIC].[dbo].[maquina_celular]");

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

                        <td><?= $fila['id'] ?></td>
                        <td><?= $fila['tipo_maquina'] ?></td>
                        <td><?= $fila['Imei'] ?></td>
                        <td><?= $fila['serial_equipo_celular'] ?></td>
                        <td><?= $fila['Marca'] ?></td>
                        <td><?= $fila['Modelo'] ?></td>
                        <td><?= $fila['Fecha_ingreso'] ?></td>
                        <td><?= $fila['Capacidad'] ?></td>
                        <td><?= $fila['Ram_celular'] ?></td>
                        <td><?= $fila['Estado'] ?></td>
                        <td><?= $fila['Gestion'] ?></td>
                        <td><?= $fila['Fecha_garantia'] ?></td>
                        <td><?= $fila['Fecha_crea'] ?></td>
                        <td><?= $fila['Usua_crea'] ?></td>
                        <td><?= $fila['Fecha_modifica'] ?></td>
                        <td><?= $fila['Usua_modifica'] ?></td>
                        <td>
                            <button style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn enviar" data-id="<?= $fila['id'] ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-primernombre="<?= $primernombre ?>" data-segundonombre="<?= $segundonombre ?>" data-primerapellido="<?= $primerapellido ?>" data-segundoapellido="<?= $segundoapellido ?>" data-cedula="<?= $cedula ?>" data-cargo="<?= $cargo ?>"></button>
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

            var id = $(this).data('id');
            var tipo_maquina = $(this).data('tipo-maquina');



            console.log("Primer Nombre:", primernombre);
            console.log("Segundo Nombre:", segundonombre);
            console.log("Primer Apellido:", primerapellido);
            console.log("Segundo Apellido:", segundoapellido);

            console.log("Cédula:", cedula);
            console.log("Cargo:", cargo);

            console.log("Datos a enviar:");
            console.log("ID:", id);
            console.log("Tipo de máquina:", tipo_maquina);


            $.ajax({
                url: 'create/insertarcelularr.php',
                type: 'POST',
                data: {
                    primernombre: primernombre,
                    segundonombre: segundonombre,
                    primerapellido: primerapellido,
                    segundoapellido: segundoapellido,

                    cedula: cedula,
                    cargo: cargo,

                    id: id,
                    tipo_maquina: tipo_maquina,

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
                        }
                    });

                    // Ejecutar el trigger después de 2 segundos
                    setTimeout(function() {
                        $('.enviar').trigger('click');
                    }, 2000);

                } else if (result.isDenied) {
                    Swal.fire('Los cambios no se guardaron', '', 'info');
                }
            });
        });
    });
</script>