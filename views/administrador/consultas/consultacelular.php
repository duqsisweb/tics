<?php


include '../../../conexionbd.php';


$data = odbc_exec($conexion, "SELECT [id] ,[tipo_maquina] ,[Imei] ,[serial_equipo_celular] ,[Marca] ,[Modelo] ,[Fecha_ingreso] ,[Capacidad] ,[Ram_celular] ,[Estado] ,[Gestion] ,[Fecha_garantia] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] FROM [ControlTIC].[dbo].[maquina_celular]");

$arr = array();
while ($Element = odbc_fetch_array($data)) {
    $arr[] = $Element;
}


?>

<div class="text-right mt-3">
    <div class="col-md-12">
        <!-- tbl info de celulares -->
        <table class="table table-bordered dt-responsive table-hover display nowrap" id="infodetallefactura" cellspacing="0" style="text-align: center;">
            <thead>
                <tr class="encabezado table-dark">
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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefaulttt" id="flexRadioDefaulttt">
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>