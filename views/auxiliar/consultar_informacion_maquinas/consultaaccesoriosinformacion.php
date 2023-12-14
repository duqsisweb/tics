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

$data = odbc_exec($conexion, " SELECT [id_asignacion] ,[id] ,[tipo_maquina] ,[marca] ,[modelo] ,[descripcion] ,[tipo_acc] ,[cantidad] ,[fecha_de_ingreso_acc] ,[fecha_crea] ,[usua_crea] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[observaciones_asigna_acc] ,[link_acc_asigna] ,[observaciones_desasigna_acc] ,[link_acc_desasigna] ,[fechamov] ,[descripcionmov] ,[usuamov] 
FROM [ControlTIC].[dbo].[asignacion_accesorios] where cedula = '$cedula' and estado_asignacion = 'VIGENTE' ");
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
        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
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
                    <th scope="col">ELEMENTO</th>
                    <th scope="col">MARCA</th>
                    <th scope="col">MODELO</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">TIPO DE ACCESORIO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">FECHA DE INGRESO</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">LINK DRIVE</th>
                    <th scope="col">ACCIONES</th>

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
                        <td><?= $fila['marca'] ?></td>
                        <td><?= $fila['modelo'] ?></td>
                        <td><?= $fila['descripcion'] ?></td>
                        <td><?= $fila['tipo_acc'] ?></td>
                        <td><?= $fila['cantidad'] ?></td>
                        <td><?= $fila['fecha_de_ingreso_acc'] ?></td>

                        <td>
                            <textarea placeholder="AGREGE UNA OBSERVACIÓN" id="observaciones_desasigna_acc<?= $fila['id'] ?>" name="observaciones_desasigna_acc" style="width: 300px; height: 160px;"></textarea>
                        </td>

                        <td>
                            <input id="link_acc_desasigna<?= $fila['id'] ?>" name="link_acc_desasigna"></input>
                        </td>

                        <!-- guardar la informacion en el boton -->
                        <td>
                            <button id="enviaraccesorios" style="display: none;" type="submit" class="btn btn-outline-danger asignar-btn" 
                            data-id="<?= $fila['id'] ?>" 
                            data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                            data-marca="<?= $fila['marca'] ?>" 
                            data-modelo="<?= $fila['modelo'] ?>" 
                            data-descripcion="<?= $fila['descripcion'] ?>" 
                            data-tipo-acc="<?= $fila['tipo_acc'] ?>" 
                            data-cantidad="<?= $fila['cantidad'] ?>" 
                            data-fecha-de-ingreso-acc="<?= $fila['fecha_de_ingreso_acc'] ?>"
                            data-primernombre="<?= $primernombre ?>" 
                            data-segundonombre="<?= $segundonombre ?>" 
                            data-primerapellido="<?= $primerapellido ?>" 
                            data-segundoapellido="<?= $segundoapellido ?>" 
                            data-cedula="<?= $cedula ?>" 
                            data-cargo="<?= $cargo ?>" 
                            data-usua-asigna="<?php echo $Usua_asigna; ?>"></button>
                            <!-- btn escondido para la alerta -->
                            <button id="" type="button" class="btn btn-outline-danger showAlertButton">REMOVER</button>
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
            var id = $(this).data('id');
            var tipo_maquina = $(this).data('tipo-maquina');
            var marca = $(this).data('marca');
            var modelo = $(this).data('modelo');
            var descripcion = $(this).data('descripcion');
            var tipo_acc = $(this).data('tipo-acc');
            var cantidad = $(this).data('cantidad');
            var fecha_de_ingreso_acc = $(this).data('fecha-de-ingreso-acc');

            var primernombre = $(this).data('primernombre');
            var segundonombre = $(this).data('segundonombre');
            var primerapellido = $(this).data('primerapellido');
            var segundoapellido = $(this).data('segundoapellido');
            var cedula = $(this).data('cedula');
            var cargo = $(this).data('cargo');

            var observaciones_desasigna_acc = $('#observaciones_desasigna_acc' + id).val();
            var link_acc_desasigna = $('#link_acc_desasigna' + id).val();



            console.log("Usuario Asigna:", Usua_asigna);
            console.log("id:", id);
            console.log("tipo_maquina:", tipo_maquina);
            console.log("marca:", marca);
            console.log("modelo:", modelo);
            console.log("descripcion:", descripcion);
            console.log("tipo_acc:", tipo_acc);
            console.log("cantidad:", cantidad);
            console.log("fecha_de_ingreso_acc:", fecha_de_ingreso_acc);

            console.log("Primer Nombre:", primernombre);
            console.log("Segundo Nombre:", segundonombre);
            console.log("Primer Apellido:", primerapellido);
            console.log("Segundo Apellido:", segundoapellido);
            console.log("Cédula:", cedula);
            console.log("Cargo:", cargo);

            console.log("observaciones_desasigna_acc de Asignacion", observaciones_desasigna_acc);
            console.log("link Drive", link_acc_desasigna);

            
    

            $.ajax({
                url: 'historial_remover_asignacion/deleteacchistorial.php',
                type: 'POST',
                data: {

                    Usua_asigna: Usua_asigna,
                    id: id,
                    tipo_maquina: tipo_maquina,
                    marca: marca,
                    modelo: modelo,
                    descripcion: descripcion,
                    tipo_acc: tipo_acc,
                    cantidad: cantidad,
                    fecha_de_ingreso_acc: fecha_de_ingreso_acc,

                    primernombre: primernombre,
                    segundonombre: segundonombre,
                    primerapellido: primerapellido,
                    segundoapellido: segundoapellido,
                    cedula: cedula,
                    cargo: cargo,

                    observaciones_desasigna_acc: observaciones_desasigna_acc,
                    link_acc_desasigna: link_acc_desasigna

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
            var linkInput = $('#observaciones_desasigna_acc' + idToUpdate).val(); // Obtener el valor del campo de entrada

            Swal.fire({
                title: '¿Quieres guardar los cambios?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                denyButtonText: `No guardar`,
            }).then((result) => {
                if (result.isConfirmed) {

                    // Cerrar el modal
                    $('#modalaccinformacion').modal('hide');
                    //mensaje de exito
                    Swal.fire('¡Guardado!', '', 'success');

                    // Hacer el update mediante AJAX con el ID obtenido para actualizar
                    $.ajax({
                        url: 'delete/deleteacc.php',
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