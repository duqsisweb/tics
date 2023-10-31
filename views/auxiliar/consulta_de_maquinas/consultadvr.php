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

$data = odbc_exec($conexion, "SELECT  mc.[id] ,tipomaquin.[nombre_maquina] as tipo_maquina ,[marca_dvr] ,[modelo_dvr] ,[descripcion_dvr] ,[capacidad_dvr] ,[tipo_dvr] ,sed.[nombre_sede] as Sede ,[ubicacion_dvr] ,[software] ,[num_canales] ,[num_discos] ,[dias_grabacion] ,[ip_dvr] ,estad.[nombre_estado] as Estado ,estadoa.[nombre_estado] as estado_asignacion ,[fecha_garantia],[usuamov] ,[fechamov] FROM [ControlTIC].[dbo].[maquina_dvr] as mc LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_dvr = sed.id LEFT JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id LEFT JOIN [ControlTIC].[dbo].estado_asignacion AS estadoa ON mc.estado_asignacion = estadoa.id where estado like '%CONFIGURACION%' ");

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
                    <th scope="col">Capacidad</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Sede</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Software</th>
                    <th scope="col">Fecha Ingreso</th>
                    <th scope="col">Num Canales</th>
                    <th scope="col">Num Discos</th>
                    <th scope="col">Dias Grabación</th>
                    <th scope="col">Ip DVR</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha Garantia</th>
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
                        <td><?= $fila['marca_dvr'] ?></td>
                        <td><?= $fila['modelo_dvr'] ?></td>
                        <td><?= $fila['descripcion_dvr'] ?></td>
                        <td><?= $fila['capacidad_dvr'] ?></td>
                        <td><?= $fila['tipo_dvr'] ?></td>
                        <td><?= $fila['sede_dvr'] ?></td>
                        <td><?= $fila['ubicacion_dvr'] ?></td>
                        <td><?= $fila['software'] ?></td>
                        <td><?= $fila['fecha_ingreso'] ?></td>
                        <td><?= $fila['num_canales'] ?></td>
                        <td><?= $fila['num_discos'] ?></td>
                        <td><?= $fila['dias_grabacion'] ?></td>
                        <td><?= $fila['ip_dvr'] ?></td>
                        <td><?= $fila['estado'] ?></td>
                        <td><?= $fila['fecha_garantia'] ?></td>


                        <td>
                            <button id="enviardvr" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" 
                            data-id="<?= $fila['id'] ?>" 
                            data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                            data-marca-dvr="<?= $fila['marca_dvr'] ?>" 
                            data-modelo-dvr="<?= $fila['modelo_dvr'] ?>" 
                            data-descripcion-dvr="<?= $fila['descripcion_dvr'] ?>" 
                            data-capacidad-dvr="<?= $fila['capacidad_dvr'] ?>" 
                            data-tipo-dvr="<?= $fila['tipo_dvr'] ?>" 
                            data-sede-dvr="<?= $fila['sede_dvr'] ?>" 
                            data-ubicacion-dvr="<?= $fila['ubicacion_dvr'] ?>" 
                            data-software-dvr="<?= $fila['software'] ?>" 
                            data-fecha-ingreso="<?= $fila['fecha_ingreso'] ?>" 
                            data-num-canales="<?= $fila['num_canales'] ?>" 
                            data-num-discos="<?= $fila['num_discos'] ?>" 
                            data-dias-grabacion="<?= $fila['dias_grabacion'] ?>" 
                            data-ip-dvr="<?= $fila['ip_dvr'] ?>" 
                            data-estado="<?= $fila['estado'] ?>" 
                            data-fecha-garantia="<?= $fila['fecha_garantia'] ?>" 
                            data-primernombre="<?= $primernombre ?>" 
                            data-segundonombre="<?= $segundonombre ?>" 
                            data-primerapellido="<?= $primerapellido ?>" 
                            data-segundoapellido="<?= $segundoapellido ?>" 
                            data-cedula="<?= $cedula ?>" 
                            data-cargo="<?= $cargo ?>" 
                            data-empresa="<?= $empresa ?>"
                            ></button>
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
            var marca_dvr = $(this).data('marca-dvr');
            var modelo_dvr = $(this).data('modelo-dvr');
            var descripcion_dvr = $(this).data('descripcion-dvr');
            var capacidad_dvr = $(this).data('capacidad-dvr');
            var tipo_dvr = $(this).data('tipo-dvr');
            var sede_dvr = $(this).data('sede-dvr');
            var ubicacion_dvr = $(this).data('ubicacion-dvr');
            var software = $(this).data('software-dvr');
            var fecha_ingreso = $(this).data('fecha-ingreso');
            var num_canales = $(this).data('num-canales');
            var num_discos = $(this).data('num-discos');
            var dias_grabacion = $(this).data('dias-grabacion');
            var ip_dvr = $(this).data('ip-dvr');
            var estado = $(this).data('estado');
            var fecha_garantia = $(this).data('fecha-garantia');
            var fecha_crea = $(this).data('fecha-crea');
            var usua_crea = $(this).data('usua-crea');
            var fecha_modifica = $(this).data('fecha-modifica');
            var usua_modifica = $(this).data('usua-modifica');
            var primernombre = $(this).data('primernombre');
            var segundonombre = $(this).data('segundonombre');
            var primerapellido = $(this).data('primerapellido');
            var segundoapellido = $(this).data('segundoapellido');
            var cedula = $(this).data('cedula');
            var cargo = $(this).data('cargo');
            var empresa = $(this).data('empresa');

            console.log("ID:", id);
            console.log("Tipo de máquina:", tipo_maquina);
            console.log("Marca del DVR:", marca_dvr);
            console.log("Modelo del DVR:", modelo_dvr);
            console.log("Descripción del DVR:", descripcion_dvr);
            console.log("Capacidad del DVR:", capacidad_dvr);
            console.log("Tipo del DVR:", tipo_dvr);
            console.log("Sede del DVR:", sede_dvr);
            console.log("Ubicación del DVR:", ubicacion_dvr);
            console.log("Software del DVR:", software);
            console.log("Fecha de Ingreso:", fecha_ingreso);
            console.log("Número de Canales:", num_canales);
            console.log("Número de Discos:", num_discos);
            console.log("Días de Grabación:", dias_grabacion);
            console.log("IP del DVR:", ip_dvr);
            console.log("Estado:", estado);
            console.log("Fecha de Garantía:", fecha_garantia);
            console.log("Fecha de Creación:", fecha_crea);
            console.log("Usuario que Creó:", usua_crea);
            console.log("Fecha de Modificación:", fecha_modifica);
            console.log("Usuario que Modificó:", usua_modifica);
            console.log("Primer Nombre:", primernombre);
            console.log("Segundo Nombre:", segundonombre);
            console.log("Primer Apellido:", primerapellido);
            console.log("Segundo Apellido:", segundoapellido);
            console.log("Cédula:", cedula);
            console.log("Cargo:", cargo);
            console.log("Empresa:", empresa);

            $.ajax({
                url: 'create/insertardvr.php',
                type: 'POST',
                data: {
                    id: id,
                    tipo_maquina: tipo_maquina,
                    marca_dvr: marca_dvr,
                    modelo_dvr: modelo_dvr,
                    descripcion_dvr: descripcion_dvr,
                    capacidad_dvr: capacidad_dvr,
                    tipo_dvr: tipo_dvr,
                    sede_dvr: sede_dvr,
                    ubicacion_dvr: ubicacion_dvr,
                    software: software,
                    fecha_ingreso: fecha_ingreso,
                    num_canales: num_canales,
                    num_discos: num_discos,
                    dias_grabacion: dias_grabacion,
                    ip_dvr: ip_dvr,
                    estado: estado,
                    fecha_garantia: fecha_garantia,
                    fecha_crea: fecha_crea,
                    usua_crea: usua_crea,
                    fecha_modifica: fecha_modifica,
                    usua_modifica: usua_modifica,
                    primernombre: primernombre,
                    segundonombre: segundonombre,
                    primerapellido: primerapellido,
                    segundoapellido: segundoapellido,
                    cedula: cedula,
                    cargo: cargo,
                    empresa: empresa
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
                        url: 'update/actualizardvr.php',
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