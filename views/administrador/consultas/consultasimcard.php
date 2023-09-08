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

$data = odbc_exec($conexion, "SELECT [id] ,[tipo_maquina] ,[numero_linea] ,[nombre_plan] ,[fecha_apertura] ,[valor_plan] ,[operador] ,[cod_cliente] ,[observaciones_sim] ,[fecha_fin_plan] ,[estado] ,[gestion] ,[fecha_crea] ,[usua_crea] ,[fecha_modifica] ,[usua_modifica] FROM [ControlTIC].[dbo].[maquina_simcard] where estado = '6'");

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
        <!-- tbl info de SIMCARD -->
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
                    <th scope="col">Número de linea</th>
                    <th scope="col">Nombre Plan</th>
                    <th scope="col">Fecha Apertura</th>
                    <th scope="col">Valor Plan</th>
                    <th scope="col">Operador</th>
                    <th scope="col">Cod Cliente</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Fecha Fin Plan</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Gestion</th>
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
                        <td><?= $fila['numero_linea'] ?></td>
                        <td><?= $fila['nombre_plan'] ?></td>
                        <td><?= $fila['fecha_apertura'] ?></td>
                        <td><?= $fila['valor_plan'] ?></td>
                        <td><?= $fila['operador'] ?></td>
                        <td><?= $fila['cod_cliente'] ?></td>
                        <td><?= $fila['observaciones_sim'] ?></td>
                        <td><?= $fila['fecha_fin_plan'] ?></td>
                        <td><?= $fila['estado'] ?></td>
                        <td><?= $fila['gestion'] ?></td>
                        <td><?= $fila['fecha_crea'] ?></td>
                        <td><?= $fila['usua_crea'] ?></td>
                        <td><?= $fila['fecha_modifica'] ?></td>
                        <td><?= $fila['usua_modifica'] ?></td>

                        <td>
                            <button id="enviarsimcard" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" 
                            data-id="<?= $fila['id'] ?>" 
                            data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" 
                            data-primernombre="<?= $primernombre ?>" 
                            data-segundonombre="<?= $segundonombre ?>" 
                            data-primerapellido="<?= $primerapellido ?>" 
                            data-segundoapellido="<?= $segundoapellido ?>" 
                            data-cedula="<?= $cedula ?>" 
                            data-cargo="<?= $cargo ?>" 
                            data-empresa="<?= $empresa ?>" 
                            data-numero-linea="<?= $fila['numero_linea'] ?>" 
                            data-nombre-plan="<?= $fila['nombre_plan'] ?>" 
                            data-fecha-apertura="<?= $fila['fecha_apertura'] ?>" 
                            data-valor-plan="<?= $fila['valor_plan'] ?>" 
                            data-operador="<?= $fila['operador'] ?>" 
                            data-cod-cliente="<?= $fila['cod_cliente'] ?>" 
                            data-observaciones-sim="<?= $fila['observaciones_sim'] ?>" 
                            data-fecha-fin-plan="<?= $fila['fecha_fin_plan'] ?>" 
                            data-estado="<?= $fila['estado'] ?>" 
                            data-gestion="<?= $fila['gestion'] ?>" 
                            data-fecha-crea="<?= $fila['fecha_crea'] ?>" 
                            data-usua-crea="<?= $fila['usua_crea'] ?>" 
                            data-fecha-modifica="<?= $fila['fecha_modifica'] ?>" 
                            data-usua-modifica="<?= $fila['usua_modifica'] ?>"></button>
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
            var numero_linea = $(this).data('numero-linea')
            var nombre_plan = $(this).data('nombre-plan');
            var fecha_apertura = $(this).data('fecha-apertura');
            var valor_plan = $(this).data('valor-plan');
            var operador = $(this).data('operador');
            var cod_cliente = $(this).data('cod-cliente');
            var observaciones_sim = $(this).data('observaciones-sim');
            var fecha_fin_plan = $(this).data('fecha-fin-plan');
            var estado = $(this).data('estado');
            var gestion = $(this).data('gestion');
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
            console.log("Numero Linea:", numero_linea);
            console.log("Nombre del Plan:", nombre_plan);
            console.log("Fecha de Apertura:", fecha_apertura);
            console.log("Valor del Plan:", valor_plan);
            console.log("Operador:", operador);
            console.log("Código de Cliente:", cod_cliente);
            console.log("Observaciones:", observaciones_sim);
            console.log("Fecha de Fin de Plan:", fecha_fin_plan);
            console.log("Estado:", estado);
            console.log("Gestión:", gestion);
            console.log("Fecha de Creación:", fecha_crea);
            console.log("Usuario de Creación:", usua_crea);
            console.log("Fecha de Modificación:", fecha_modifica);
            console.log("Usuario de Modificación:", usua_modifica);

            $.ajax({
                url: 'create/insertarsimcard.php',
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
                    numero_linea: numero_linea,
                    nombre_plan: nombre_plan,
                    fecha_apertura: fecha_apertura,
                    valor_plan: valor_plan,
                    operador: operador,
                    cod_cliente: cod_cliente,
                    observaciones_sim: observaciones_sim,
                    fecha_fin_plan: fecha_fin_plan,
                    estado: estado,
                    gestion: gestion,
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
                    $('#modalsimcard').modal('hide');
                    //mensaje de exito
                    Swal.fire('¡Guardado!', '', 'success');

                    // Hacer el update mediante AJAX con el ID obtenido para actualizar
                    $.ajax({
                        url: 'update/actualizarsimcard.php',
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