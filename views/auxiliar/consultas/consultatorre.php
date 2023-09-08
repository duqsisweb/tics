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

$data = odbc_exec($conexion, "SELECT  [id] ,[tipo_maquina] ,[placa_activo_torre] ,[descripcion_torre] ,[sede_torre] ,[tipo_torre] ,[altura_metros] ,[fecha_ingreso] ,[fecha_ult_mantenimiento] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica],[estado] FROM [ControlTIC].[dbo].[maquina_torre] where estado = '6' ");

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
                    <th scope="col">Placa Activo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Sede</th>
                    <th scope="col">Tipo Torre</th>
                    <th scope="col">Altura Metros</th>
                    <th scope="col">Fecha Ingreso</th>
                    <th scope="col">Ultimo Mantenimiento</th>
                    <th scope="col">Fecha Crea</th>
                    <th scope="col">Usua Crea</th>
                    <th scope="col">Fecha Modifica</th>
                    <th scope="col">Usuario Modifica</th>
                    <th scope="col">Estado</th>


                    <th scope="col">Seleccione</th>

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
                        <td><?= $fila['placa_activo_torre'] ?></td>
                        <td><?= $fila['descripcion_torre'] ?></td>
                        <td><?= $fila['sede_torre'] ?></td>
                        <td><?= $fila['tipo_torre'] ?></td>
                        <td><?= $fila['altura_metros'] ?></td>
                        <td><?= $fila['fecha_ingreso'] ?></td>
                        <td><?= $fila['fecha_ult_mantenimiento'] ?></td>
                        <td><?= $fila['fecha_crea'] ?></td>
                        <td><?= $fila['usua_crea'] ?></td>
                        <td><?= $fila['fecha_modifica'] ?></td>
                        <td><?= $fila['usua_modifica'] ?></td>
                        <td><?= $fila['estado'] ?></td>


                        <td>
                            <button id="enviartorre" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" 
                            data-id="<?= $fila['id'] ?>" 
                            data-primernombre="<?= $primernombre ?>" 
                            data-segundonombre="<?= $segundonombre ?>" 
                            data-primerapellido="<?= $primerapellido ?>" 
                            data-segundoapellido="<?= $segundoapellido ?>" 
                            data-cedula="<?= $cedula ?>" 
                            data-cargo="<?= $cargo ?>" 
                            data-empresa="<?= $empresa ?>" 
                            data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                            data-placa-activo-torre="<?= $fila['placa_activo_torre'] ?>" 
                            data-descripcion-torre="<?= $fila['tipo_maquina'] ?>" 
                            data-sede-torre="<?= $fila['sede_torre'] ?>" 
                            data-tipo-torre="<?= $fila['tipo_torre'] ?>" 
                            data-altura-metros="<?= $fila['altura_metros'] ?>" 
                            data-fecha-ingreso="<?= $fila['fecha_ingreso'] ?>" 
                            data-fecha-ult-mantenimiento="<?= $fila['fecha_ult_mantenimiento'] ?>" 
                            data-fecha-crea="<?= $fila['fecha_crea'] ?>" 
                            data-usua-crea="<?= $fila['usua_crea'] ?>"
                             data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" 
                             data-usua-modifica="<?= $fila['usua_modifica'] ?>"
                             data-estado="<?= $fila['estado'] ?>" ></button>
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

            var id = $(this).data('id');
            var primernombre = $(this).data('primernombre');
            var segundonombre = $(this).data('segundonombre');
            var primerapellido = $(this).data('primerapellido');
            var segundoapellido = $(this).data('segundoapellido');
            var cedula = $(this).data('cedula');
            var cargo = $(this).data('cargo');
            var empresa = $(this).data('empresa');
            var tipo_maquina = $(this).data('tipo-maquina');
            var placa_activo_torre = $(this).data('placa-activo-torre');
            var descripcion_torre = $(this).data('descripcion-torre');
            var sede_torre = $(this).data('sede-torre');
            var tipo_torre = $(this).data('tipo-torre');
            var altura_metros = $(this).data('altura-metros');
            var fecha_ingreso = $(this).data('fecha-ingreso');
            var fecha_ult_mantenimiento = $(this).data('fecha-ult-mantenimiento');
            var fecha_crea = $(this).data('fecha-crea');
            var usua_crea = $(this).data('usua-crea');
            var fecha_modifica = $(this).data('fecha-modifica');
            var usua_modifica = $(this).data('usua-modifica');
            var estado = $(this).data('estado');
            



            console.log("ID:", id);
            console.log("Primer Nombre:", primernombre);
            console.log("Segundo Nombre:", segundonombre);
            console.log("Primer Apellido:", primerapellido);
            console.log("Segundo Apellido:", segundoapellido);
            console.log("Cédula:", cedula);
            console.log("Cargo:", cargo);
            console.log("Empresa:", empresa);
            console.log("Tipo de máquina:", tipo_maquina);
            console.log("Placa Activo Torre:", placa_activo_torre);
            console.log("Descripcion Torre:", descripcion_torre);
            console.log("Sede Torre:", sede_torre);
            console.log("Tipo Torre:", tipo_torre);
            console.log("Altura Metros:", altura_metros);
            console.log("Fecha Ingreso:", fecha_ingreso);
            console.log("Fecha Último Mantenimiento:", fecha_ult_mantenimiento);
            console.log("Fecha Crea:", fecha_crea);
            console.log("Usuario Crea:", usua_crea);
            console.log("Fecha Modifica:", fecha_modifica);
            console.log("Usuario Modifica:", usua_modifica);
            console.log("Estado:", estado);

            $.ajax({
                url: 'create/insertartorre.php',
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
                    placa_activo_torre: placa_activo_torre,
                    descripcion_torre: descripcion_torre,
                    sede_torre: sede_torre,
                    tipo_torre: tipo_torre,
                    altura_metros: altura_metros,
                    fecha_ingreso: fecha_ingreso,
                    fecha_ult_mantenimiento: fecha_ult_mantenimiento,
                    fecha_crea: fecha_crea,
                    usua_crea: usua_crea,
                    fecha_modifica: fecha_modifica,
                    usua_modifica: usua_modifica,
                    estado: estado
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
                    $('#modaldvr').modal('hide');
                    //mensaje de exito
                    Swal.fire('¡Guardado!', '', 'success');

                    // Hacer el update mediante AJAX con el ID obtenido para actualizar
                    $.ajax({
                        url: 'update/actualizartorre.php',
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