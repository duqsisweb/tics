<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) &&
    isset($_POST['marca_dvr']) && isset($_POST['modelo_dvr']) &&
    isset($_POST['descripcion_dvr']) && isset($_POST['capacidad_dvr']) &&
    isset($_POST['tipo_dvr']) && isset($_POST['sede_dvr']) &&
    isset($_POST['ubicacion_dvr']) && isset($_POST['software']) &&
    isset($_POST['fecha_ingreso']) && isset($_POST['num_canales']) &&
    isset($_POST['num_discos']) && isset($_POST['dias_grabacion']) &&
    isset($_POST['ip_dvr']) && isset($_POST['estado']) &&
    isset($_POST['fecha_garantia']) && isset($_POST['fecha_crea']) &&
    isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) &&
    isset($_POST['usua_modifica']) && isset($_POST['primernombre']) &&
    isset($_POST['segundonombre']) && isset($_POST['primerapellido']) &&
    isset($_POST['segundoapellido']) && isset($_POST['cedula']) &&
    isset($_POST['cargo']) && isset($_POST['empresa'])
) {

    // Recoge los datos de POST
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $marca_dvr = $_POST['marca_dvr'];
    $modelo_dvr = $_POST['modelo_dvr'];
    $descripcion_dvr = $_POST['descripcion_dvr'];
    $capacidad_dvr = $_POST['capacidad_dvr'];
    $tipo_dvr = $_POST['tipo_dvr'];
    $sede_dvr = $_POST['sede_dvr'];
    $ubicacion_dvr = $_POST['ubicacion_dvr'];
    $software = $_POST['software'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $num_canales = $_POST['num_canales'];
    $num_discos = $_POST['num_discos'];
    $dias_grabacion = $_POST['dias_grabacion'];
    $ip_dvr = $_POST['ip_dvr'];
    $estado = $_POST['estado'];
    $fecha_garantia = $_POST['fecha_garantia'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];

    // INSERTAR DATOS A LA TABLA asignacion_dvr
    $queryAsignacion = "INSERT INTO ControlTIC..asignacion_dvr ( 
        id, tipo_maquina, marca_dvr, modelo_dvr, descripcion_dvr, capacidad_dvr, tipo_dvr, sede_dvr, ubicacion_dvr, software, fecha_ingreso, num_canales, num_discos, dias_grabacion, ip_dvr, estado, fecha_garantia, fecha_crea, usua_crea, fecha_modifica, usua_modifica, primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, empresa
    ) 
    VALUES 
    ( 
        '$id', '$tipo_maquina', '$marca_dvr', '$modelo_dvr', '$descripcion_dvr', '$capacidad_dvr', '$tipo_dvr', '$sede_dvr', '$ubicacion_dvr', '$software', '$fecha_ingreso', '$num_canales', '$num_discos', '$dias_grabacion', '$ip_dvr', '$estado', '$fecha_garantia', '$fecha_crea', '$usua_crea', '$fecha_modifica', '$usua_modifica', '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido', '$cedula', '$cargo', '$empresa'
    )";

    // INSERTAR DATOS A LA TABLA historial_dvr
    $queryHistorial = "INSERT INTO ControlTIC..historial_dvr ( 
        id, tipo_maquina, marca_dvr, modelo_dvr, descripcion_dvr, capacidad_dvr, tipo_dvr, sede_dvr, ubicacion_dvr, software, fecha_ingreso, num_canales, num_discos, dias_grabacion, ip_dvr, estado, fecha_garantia, fecha_crea, usua_crea, fecha_modifica, usua_modifica, primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, empresa
    ) 
    VALUES 
    ( 
        '$id', '$tipo_maquina', '$marca_dvr', '$modelo_dvr', '$descripcion_dvr', '$capacidad_dvr', '$tipo_dvr', '$sede_dvr', '$ubicacion_dvr', '$software', '$fecha_ingreso', '$num_canales', '$num_discos', '$dias_grabacion', '$ip_dvr', '$estado', '$fecha_garantia', '$fecha_crea', '$usua_crea', '$fecha_modifica', '$usua_modifica', '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido', '$cedula', '$cargo', '$empresa'
    )";

    // Ejecuta la consulta en la tabla 'asignacion_dvr'
    $resultAsignacion = odbc_exec($conexion, $queryAsignacion);

    if ($resultAsignacion) {
        echo "Inserción exitosa en la tabla asignacion_dvr<br>";

        // Ahora se procede a insertar en la tabla 'historial_dvr'
        $resultHistorial = odbc_exec($conexion, $queryHistorial);

        if ($resultHistorial) {
            echo "Inserción exitosa en la tabla historial_dvr";
        } else {
            echo "Error en la inserción en la tabla historial_dvr: " . odbc_errormsg();
        }
    } else {
        echo "Error en la inserción en la tabla asignacion_dvr: " . odbc_errormsg();
    }
}
?>
