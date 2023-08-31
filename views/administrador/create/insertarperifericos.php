<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina'])
    && isset($_POST['fecha_garantia'])
    && isset($_POST['fecha_crea']) && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) && isset($_POST['usua_modifica'])
    && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido'])
    && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['empresa'])
) {
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $serial_perifericos = $_POST['serial_perifericos'];
    $descripcion_perifericos = $_POST['descripcion_perifericos'];
    $marca_perifericos = $_POST['marca_perifericos'];
    $modelo_perifericos = $_POST['modelo_perifericos'];
    $placa_activo_perifericos = $_POST['placa_activo_perifericos'];
    $sede_perifericos = $_POST['sede_perifericos'];
    $ubicacion_perifericos = $_POST['ubicacion_perifericos'];
    $tipo= $_POST['tipo'];
    $tipo_toner = $_POST['tipo_toner'];
    $gestion = $_POST['gestion'];
    $empresa_perifericos = $_POST['empresa_perifericos'];
    $fecha_asigna = $_POST['fecha_asigna'];
    $usua_asigna = $_POST['usua_asigna'];
    $estado = $_POST['estado'];
    $fecha_garantia = $_POST['fecha_garantia'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];

    // Recoge los datos adicionales
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];

    // INSERTAR DATOS A LA TABLA asignacion_perifericos
    $queryAsignacion = "INSERT INTO ControlTIC..asignacion_perifericos (
        [id],
        [tipo_maquina],
        [serial_perifericos],
        [descripcion_perifericos],
        [marca_perifericos],
        [modelo_perifericos],
        [placa_activo_perifericos],
        [sede_perifericos],
        [ubicacion_perifericos],
        [tipo],
        [tipo_toner],
        [gestion],
        [empresa],
        [fecha_de_garantia],
        [fecha_crea],
        [usua_crea],
        [fecha_modifica],
        [usua_modifica],
        [usua_asigna],
        [fecha_asigna],
        [cedula],
        [cargo],
        [primernombre],
        [segundonombre],
        [primerapellido],
        [segundoapellido],
        [estado]
    ) VALUES (
        '$id',
        '$tipo_maquina',
        '$serial_perifericos',
        '$descripcion_perifericos',
        '$marca_perifericos',
        '$modelo_perifericos',
        '$placa_activo_perifericos',
        '$sede_perifericos',
        '$ubicacion_perifericos',
        '$tipo',
        '$tipo_toner',
        '$gestion',
        '$empresa_perifericos',
        '$fecha_garantia',
        '$fecha_crea',
        '$usua_crea',
        '$fecha_modifica',
        '$usua_modifica',
        '$usua_asigna',
        '$fecha_asigna',
        '$cedula',
        '$cargo',
        '$primernombre',
        '$segundonombre',
        '$primerapellido',
        '$segundoapellido',
        '$estado'
    )";

    // INSERTAR DATOS A LA TABLA historial_perifericos
    $queryHistorial = "INSERT INTO ControlTIC..historial_perifericos (
        [id],
        [tipo_maquina],
        [serial_perifericos],
        [descripcion_perifericos],
        [marca_perifericos],
        [modelo_perifericos],
        [placa_activo_perifericos],
        [sede_perifericos],
        [ubicacion_perifericos],
        [tipo],
        [tipo_toner],
        [gestion],
        [empresa],
        [fecha_de_garantia],
        [fecha_crea],
        [usua_crea],
        [fecha_modifica],
        [usua_modifica],
        [usua_asigna],
        [fecha_asigna],
        [cedula],
        [cargo],
        [primernombre],
        [segundonombre],
        [primerapellido],
        [segundoapellido],
        [estado]
    ) VALUES (
        '$id',
        '$tipo_maquina',
        '$serial_perifericos',
        '$descripcion_perifericos',
        '$marca_perifericos',
        '$modelo_perifericos',
        '$placa_activo_perifericos',
        '$sede_perifericos',
        '$ubicacion_perifericos',
        '$tipo',
        '$tipo_toner',
        '$gestion',
        '$empresa_perifericos',
        '$fecha_garantia',
        '$fecha_crea',
        '$usua_crea',
        '$fecha_modifica',
        '$usua_modifica',
        '$usua_asigna',
        '$fecha_asigna',
        '$cedula',
        '$cargo',
        '$primernombre',
        '$segundonombre',
        '$primerapellido',
        '$segundoapellido',
        '$estado'
    )";

    // Ejecuta la consulta en la tabla 'asignacion_perifericos'
    $resultAsignacion = odbc_exec($conexion, $queryAsignacion);

    if ($resultAsignacion) {
        echo "Inserción exitosa en la tabla asignacion_perifericos<br>";

        // Ahora se procede a insertar en la tabla 'historial_perifericos'
        $resultHistorial = odbc_exec($conexion, $queryHistorial);

        if ($resultHistorial) {
            echo "Inserción exitosa en la tabla historial_perifericos";
        } else {
            echo "Error en la inserción en la tabla historial_perifericos: " . odbc_errormsg();
        }
    } else {
        echo "Error en la inserción en la tabla asignacion_perifericos: " . odbc_errormsg();
    }
}
?>
