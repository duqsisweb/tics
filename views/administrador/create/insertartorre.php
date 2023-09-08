<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido']) && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['empresa']) &&
    isset($_POST['tipo_maquina']) && isset($_POST['placa_activo_torre']) && isset($_POST['descripcion_torre']) && isset($_POST['sede_torre']) && isset($_POST['tipo_torre']) && isset($_POST['altura_metros']) && isset($_POST['fecha_ingreso']) && isset($_POST['fecha_ult_mantenimiento']) && isset($_POST['fecha_crea']) && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) && isset($_POST['usua_modifica']) && isset($_POST['estado'])
) {

    // Recoge los datos de POST
    $id = $_POST['id'];
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $placa_activo_torre = $_POST['placa_activo_torre'];
    $descripcion_torre = $_POST['descripcion_torre'];
    $sede_torre = $_POST['sede_torre'];
    $tipo_torre = $_POST['tipo_torre'];
    $altura_metros = $_POST['altura_metros'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_ult_mantenimiento = $_POST['fecha_ult_mantenimiento'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];
    $estado = $_POST['estado'];

    // INSERTAR DATOS A LA TABLA asignacion_torre
    $queryAsignacion = "INSERT INTO ControlTIC..asignacion_torre (
        id, primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, empresa, tipo_maquina, placa_activo_torre, descripcion_torre, sede_torre, tipo_torre, altura_metros, fecha_ingreso, fecha_ult_mantenimiento, fecha_crea, usua_crea, fecha_modifica, usua_modifica, estado
    ) VALUES (
        '$id', '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido', '$cedula', '$cargo', '$empresa', '$tipo_maquina', '$placa_activo_torre', '$descripcion_torre', '$sede_torre', '$tipo_torre', '$altura_metros', '$fecha_ingreso', '$fecha_ult_mantenimiento', '$fecha_crea', '$usua_crea', '$fecha_modifica', '$usua_modifica', '$estado'
    )";

    // INSERTAR DATOS A LA TABLA historial_torre
    $queryHistorial = "INSERT INTO ControlTIC..historial_torre (
       id, primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, empresa, tipo_maquina, placa_activo_torre, descripcion_torre, sede_torre, tipo_torre, altura_metros, fecha_ingreso, fecha_ult_mantenimiento, fecha_crea, usua_crea, fecha_modifica, usua_modifica, estado
    ) VALUES (
        '$id', '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido', '$cedula', '$cargo', '$empresa', '$tipo_maquina', '$placa_activo_torre', '$descripcion_torre', '$sede_torre', '$tipo_torre', '$altura_metros', '$fecha_ingreso', '$fecha_ult_mantenimiento', '$fecha_crea', '$usua_crea', '$fecha_modifica', '$usua_modifica', '$estado'
    )";

    // Ejecuta la consulta en la tabla 'asignacion_torre'
    $resultAsignacion = odbc_exec($conexion, $queryAsignacion);

    if ($resultAsignacion) {
        echo "Inserción exitosa en la tabla asignacion_torre<br>";

        // Ahora se procede a insertar en la tabla 'historial_torre'
        $resultHistorial = odbc_exec($conexion, $queryHistorial);

        if ($resultHistorial) {
            echo "Inserción exitosa en la tabla historial_torre";
        } else {
            echo "Error en la inserción en la tabla historial_torre: " . odbc_errormsg();
        }
    } else {
        echo "Error en la inserción en la tabla asignacion_torre: " . odbc_errormsg();
    }
}
?>
