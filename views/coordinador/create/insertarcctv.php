<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) &&
    isset($_POST['primernombre']) && isset($_POST['segundonombre']) &&
    isset($_POST['primerapellido']) && isset($_POST['segundoapellido']) &&
    isset($_POST['cedula']) && isset($_POST['cargo']) &&
    isset($_POST['empresa']) && isset($_POST['marca_cctv']) &&
    isset($_POST['modelo_cctv']) && isset($_POST['descripcion_cctv']) &&
    isset($_POST['sede_cctv']) && isset($_POST['ubicacion_cctv']) &&
    isset($_POST['fecha_ingreso']) && isset($_POST['ip_cctv']) &&
    isset($_POST['vision_enfoque']) && isset($_POST['serial_dvr']) &&
    isset($_POST['canal']) && isset($_POST['estado']) &&
    isset($_POST['fecha_garantia']) && isset($_POST['fecha_crea']) &&
    isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) &&
    isset($_POST['usua_modifica'])
) {

    // Recoge los datos de POST
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];
    $marca_cctv = $_POST['marca_cctv'];
    $modelo_cctv = $_POST['modelo_cctv'];
    $descripcion_cctv = $_POST['descripcion_cctv'];
    $sede_cctv = $_POST['sede_cctv'];
    $ubicacion_cctv = $_POST['ubicacion_cctv'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $ip_cctv = $_POST['ip_cctv'];
    $vision_enfoque = $_POST['vision_enfoque'];
    $serial_dvr = $_POST['serial_dvr'];
    $canal = $_POST['canal'];
    $estado = $_POST['estado'];
    $fecha_garantia = $_POST['fecha_garantia'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];

    // INSERTAR DATOS A LA TABLA asignacion_cctv
    $queryAsignacion = "INSERT INTO ControlTIC..asignacion_cctv (
        id, tipo_maquina, primernombre, segundonombre, primerapellido, segundoapellido,
        cedula, cargo, empresa, marca_cctv, modelo_cctv, descripcion_cctv,
        sede_cctv, ubicacion_cctv, fecha_ingreso, ip_cctv, vision_enfoque,
        serial_dvr, canal, estado, fecha_garantia, fecha_crea, usua_crea,
        fecha_modifica, usua_modifica
    ) VALUES (
        '$id', '$tipo_maquina', '$primernombre', '$segundonombre', '$primerapellido',
        '$segundoapellido', '$cedula', '$cargo', '$empresa', '$marca_cctv',
        '$modelo_cctv', '$descripcion_cctv', '$sede_cctv', '$ubicacion_cctv',
        '$fecha_ingreso', '$ip_cctv', '$vision_enfoque', '$serial_dvr', '$canal',
        '$estado', '$fecha_garantia', '$fecha_crea', '$usua_crea', '$fecha_modifica',
        '$usua_modifica'
    )";

    // INSERTAR DATOS A LA TABLA historial_cctv
    $queryHistorial = "INSERT INTO ControlTIC..historial_cctv (
        id, tipo_maquina, primernombre, segundonombre, primerapellido, segundoapellido,
        cedula, cargo, empresa, marca_cctv, modelo_cctv, descripcion_cctv,
        sede_cctv, ubicacion_cctv, fecha_ingreso, ip_cctv, vision_enfoque,
        serial_dvr, canal, estado, fecha_garantia, fecha_crea, usua_crea,
        fecha_modifica, usua_modifica
    ) VALUES (
        '$id', '$tipo_maquina', '$primernombre', '$segundonombre', '$primerapellido',
        '$segundoapellido', '$cedula', '$cargo', '$empresa', '$marca_cctv',
        '$modelo_cctv', '$descripcion_cctv', '$sede_cctv', '$ubicacion_cctv',
        '$fecha_ingreso', '$ip_cctv', '$vision_enfoque', '$serial_dvr', '$canal',
        '$estado', '$fecha_garantia', '$fecha_crea', '$usua_crea', '$fecha_modifica',
        '$usua_modifica'
    )";

    // Ejecuta la consulta en la tabla 'asignacion_cctv'
    $resultAsignacion = odbc_exec($conexion, $queryAsignacion);

    if ($resultAsignacion) {
        echo "Inserción exitosa en la tabla asignacion_cctv<br>";

        // Ahora se procede a insertar en la tabla 'historial_cctv'
        $resultHistorial = odbc_exec($conexion, $queryHistorial);

        if ($resultHistorial) {
            echo "Inserción exitosa en la tabla historial_cctv";
        } else {
            echo "Error en la inserción en la tabla historial_cctv: " . odbc_errormsg();
        }
    } else {
        echo "Error en la inserción en la tabla asignacion_cctv: " . odbc_errormsg();
    }
}
?>
