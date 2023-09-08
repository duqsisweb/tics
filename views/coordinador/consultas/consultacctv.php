<?php
include '../../../conexionbd.php';;


// Obtener los valores pasados desde el formulario principal
$primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : '';
$segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : '';
$primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : '';
$segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : '';
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
$cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

$data = odbc_exec($conexion, "SELECT  [id] ,[tipo_maquina] ,[marca_cctv] ,[modelo_cctv] ,[descripcion_cctv] ,[sede_cctv] ,[ubicacion_cctv] ,[fecha_ingreso] ,[ip_cctv] ,[vision_enfoque] ,[serial_dvr] ,[canal] ,[estado] ,[fecha_garantia] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] FROM [ControlTIC].[dbo].[maquina_cctv] where estado = '6' ");

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
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Sede</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Fecha Ingreso</th>
                    <th scope="col">IP</th>
                    <th scope="col">Vision Enfoque</th>
                    <th scope="col">Serial</th>
                    <th scope="col">Canal</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha Garantia</th>
                    <th scope="col">Fecha Crea</th>
                    <th scope="col">Usua Crea</th>
                    <th scope="col">Fecha Modifica</th>
                    <th scope="col">Usua Modifica</th>
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
                        <td><?= $fila['marca_cctv'] ?></td>
                        <td><?= $fila['modelo_cctv'] ?></td>
                        <td><?= $fila['descripcion_cctv'] ?></td>
                        <td><?= $fila['sede_cctv'] ?></td>
                        <td><?= $fila['ubicacion_cctv'] ?></td>
                        <td><?= $fila['fecha_ingreso'] ?></td>
                        <td><?= $fila['ip_cctv'] ?></td>
                        <td><?= $fila['vision_enfoque'] ?></td>
                        <td><?= $fila['serial_dvr'] ?></td>
                        <td><?= $fila['canal'] ?></td>
                        <td><?= $fila['estado'] ?></td>
                        <td><?= $fila['fecha_garantia'] ?></td>
                        <td><?= $fila['fecha_crea'] ?></td>
                        <td><?= $fila['usua_crea'] ?></td>
                        <td><?= $fila['fecha_modifica'] ?></td>
                        <td><?= $fila['usua_modifica'] ?></td>

                        <td>
                            <button id="enviaralmacenamiento" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" 
                            data-id="<?= $fila['id'] ?>" 
                            data-primernombre="<?= $primernombre ?>" 
                            data-segundonombre="<?= $segundonombre ?>" 
                            data-primerapellido="<?= $primerapellido ?>" 
                            data-segundoapellido="<?= $segundoapellido ?>" 
                            data-cedula="<?= $cedula ?>" 
                            data-cargo="<?= $cargo ?>" 
                            data-empresa="<?= $empresa ?>" 
                            data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                            data-marca-cctv="<?= $fila['marca_cctv'] ?>" 
                            data-modelo-cctv="<?= $fila['modelo_cctv'] ?>" 
                            data-descripcion-cctv="<?= $fila['descripcion_cctv'] ?>" 
                            data-sede-cctv="<?= $fila['sede_cctv'] ?>" 
                            data-ubicacion-cctv="<?= $fila['ubicacion_cctv'] ?>" data-fecha-ingreso="<?= $fila['fecha_ingreso'] ?>" data-ip-cctv="<?= $fila['ip_cctv'] ?>" data-vision-enfoque="<?= $fila['vision_enfoque'] ?>" data-serial-dvr="<?= $fila['serial_dvr'] ?>" data-canal="<?= $fila['canal'] ?>" data-estado="<?= $fila['estado'] ?>" data-fecha-garantia="<?= $fila['fecha_garantia'] ?>" data-fecha-crea="<?= $fila['fecha_crea'] ?>" data-usua-crea="<?= $fila['usua_crea'] ?>" data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" data-usua-modifica="<?= $fila['usua_modifica'] ?>"></button>
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
            var tipo_maquina = $(this).data('tipo-maquina');
            var primernombre = $(this).data('primernombre');
            var segundonombre = $(this).data('segundonombre');
            var primerapellido = $(this).data('primerapellido');
            var segundoapellido = $(this).data('segundoapellido');
            var cedula = $(this).data('cedula');
            var cargo = $(this).data('cargo');
            var empresa = $(this).data('empresa');
            var marca_cctv = $(this).data('marca-cctv');
            var modelo_cctv = $(this).data('modelo-cctv');
            var descripcion_cctv = $(this).data('descripcion-cctv');
            var sede_cctv = $(this).data('sede-cctv');
            var ubicacion_cctv = $(this).data('ubicacion-cctv');
            var fecha_ingreso = $(this).data('fecha-ingreso');
            var ip_cctv = $(this).data('ip-cctv');
            var vision_enfoque = $(this).data('vision-enfoque');
            var serial_dvr = $(this).data('serial-dvr');
            var canal = $(this).data('canal');
            var estado = $(this).data('estado');
            var fecha_garantia = $(this).data('fecha-garantia');
            var fecha_crea = $(this).data('fecha-crea');
            var usua_crea = $(this).data('usua-crea');
            var fecha_modifica = $(this).data('fecha-modifica');
            var usua_modifica = $(this).data('usua-modifica');

            console.log("Datos a enviar:");
            console.log("ID:", id);
            console.log("Tipo de máquina:", tipo_maquina);
            console.log("Primer Nombre:", primernombre);
            console.log("Segundo Nombre:", segundonombre);
            console.log("Primer Apellido:", primerapellido);
            console.log("Segundo Apellido:", segundoapellido);
            console.log("Cédula:", cedula);
            console.log("Cargo:", cargo);
            console.log("Empresa:", empresa);
            console.log("Marca CCTV:", marca_cctv);
            console.log("Modelo CCTV:", modelo_cctv);
            console.log("Descripción CCTV:", descripcion_cctv);
            console.log("Sede CCTV:", sede_cctv);
            console.log("Ubicación CCTV:", ubicacion_cctv);
            console.log("Fecha Ingreso:", fecha_ingreso);
            console.log("IP CCTV:", ip_cctv);
            console.log("Visión Enfoque:", vision_enfoque);
            console.log("Serial DVR:", serial_dvr);
            console.log("Canal:", canal);
            console.log("Estado:", estado);
            console.log("Fecha Garantía:", fecha_garantia);
            console.log("Fecha Crea:", fecha_crea);
            console.log("Usua Crea:", usua_crea);
            console.log("Fecha Modifica:", fecha_modifica);
            console.log("Usua Modifica:", usua_modifica);

            $.ajax({
                url: 'create/insertarcctv.php',
                type: 'POST',
                data: {
                    id: id,
                    tipo_maquina: tipo_maquina,
                    primernombre: primernombre,
                    segundonombre: segundonombre,
                    primerapellido: primerapellido,
                    segundoapellido: segundoapellido,
                    cedula: cedula,
                    cargo: cargo,
                    empresa: empresa,
                    marca_cctv: marca_cctv,
                    modelo_cctv: modelo_cctv,
                    descripcion_cctv: descripcion_cctv,
                    sede_cctv: sede_cctv,
                    ubicacion_cctv: ubicacion_cctv,
                    fecha_ingreso: fecha_ingreso,
                    ip_cctv: ip_cctv,
                    vision_enfoque: vision_enfoque,
                    serial_dvr: serial_dvr,
                    canal: canal,
                    estado: estado,
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
                    $('#modalalmacenamiento').modal('hide');
                    //mensaje de exito
                    Swal.fire('¡Guardado!', '', 'success');

                    // Hacer el update mediante AJAX con el ID obtenido para actualizar
                    $.ajax({
                        url: 'update/actualizarcctv.php',
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