<?php
include '../../../conexionbd.php';

if (isset($_POST['tipocomputador']) && isset($_POST['empresaOption'])) {
    $tipocomputador = $_POST['tipocomputador'];
    $empresaOption = $_POST['empresaOption'];

    $data = odbc_exec($conexion, "SELECT [id] ,[tipo_maquina] ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,[Sede] ,[Empresa] ,[Marca_computador] ,[Modelo_computador] ,[Tipo_comp] ,[Tipo_ram] ,[Memoria_ram] ,[Tipo_discoduro] ,[Capacidad_discoduro] ,[Procesador] ,[Propietario] ,[Proveedor] ,[Sistema_Operativo] ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso] ,[Targeta_Video] ,[Estado] ,[Gestion] ,[Fecha_garantia] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] FROM [ControlTIC].[dbo].[maquina_computador] where Tipo_comp = '$tipocomputador' and empresa = '$empresaOption'");
    $arr = array();
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }

    echo $data;
?>




    <div class="">
        <div class="text-right mt-3">
            <div class="col-md-12">
                <!-- tbl info de productos -->
                <table class="table table-bordered dt-responsive table-hover display nowrap" id="infodetallefactura" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">
                            <th scope="col">ID</th>
                            <th scope="col">Tipo de Máquina</th>
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
                            <th scope="col">Fecha de Ingreso</th>
                            <th scope="col">Tarjeta de Video</th>
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
                                <td><?= $fila['id'] ?></td>
                                <td><?= $fila['tipo_maquina'] ?></td>
                                <td><?= $fila['Service_tag'] ?></td>
                                <td><?= $fila['Serial_equipo'] ?></td>
                                <td><?= $fila['Nombre_equipo'] ?></td>
                                <td><?= $fila['Sede'] ?></td>
                                <td><?= $fila['Empresa'] ?></td>
                                <td><?= $fila['Marca_computador'] ?></td>
                                <td><?= $fila['Modelo_computador'] ?></td>
                                <td><?= $fila['Tipo_comp'] ?></td>
                                <td><?= $fila['Tipo_ram'] ?></td>
                                <td><?= $fila['Memoria_ram'] ?></td>
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
                                <td><?= $fila['Fecha_ingreso'] ?></td>
                                <td><?= $fila['Targeta_Video'] ?></td>
                                <td><?= $fila['Estado'] ?></td>
                                <td><?= $fila['Gestion'] ?></td>
                                <td><?= $fila['Fecha_garantia'] ?></td>
                                <td><?= $fila['Fecha_crea'] ?></td>
                                <td><?= $fila['Usua_crea'] ?></td>
                                <td><?= $fila['Fecha_modifica'] ?></td>
                                <td><?= $fila['Usua_modifica'] ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-nombre-equipo="<?= $fila['Nombre_equipo'] ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>



                    <!-- ahorro de lineas por un foreach -->

                    <!-- <thead>
    <tr class="encabezado table-dark">
        <?php foreach ($arr[0] as $campo => $valor) { ?>
            <th scope="col"><?= $campo ?></th>
        <?php } ?>
        <th scope="col">Seleccionar</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($arr as $fila) { ?>
        <tr>
            <?php foreach ($fila as $valor) { ?>
                <td><?= $valor ?></td>
            <?php } ?>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-nombre-equipo="<?= $fila['Nombre_equipo'] ?>">
                </div>
            </td>
        </tr>
    <?php } ?>
</tbody> -->




                </table>
            </div>
        </div>
    </div>




<?php } else { ?>

<?php
} ?>