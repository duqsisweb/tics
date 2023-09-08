<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina'])
    && isset($_POST['fecha_garantia'])
    && isset($_POST['fecha_crea']) && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) && isset($_POST['usua_modifica'])
    && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido'])
    && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['empresa']) && isset($_POST['observaciones_desasigna'])
) {

    // Recoge los datos de POST
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $marca_edcomunicacion = $_POST['marca_edcomunicacion'];
    $modelo_edcomunicacion = $_POST['modelo_edcomunicacion'];
    $descripcion_edcomunicacion = $_POST['descripcion_edcomunicacion'];
    $serial_edcomunicacion = $_POST['serial_edcomunicacion'];
    $fecha_de_ingreso = $_POST['fecha_de_ingreso'];
    $estado = $_POST['estado'];
    $placa_activo_edcomunicacion = $_POST['placa_activo_edcomunicacion'];
    $sede_edcomunicacion = $_POST['sede_edcomunicacion'];
    $ubicacion_edcomunicacion = $_POST['ubicacion_edcomunicacion'];
    $observaciones_edcomunicacion = $_POST['observaciones_edcomunicacion'];
    $observaciones_desasigna = $_POST['observaciones_desasigna'];

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



    // INSERTAR DATOS A LA TABLA
    $queryHistorial = "INSERT INTO ControlTIC..historial_edcomunicacion (
        [id],
        [tipo_maquina],
        [marca_edcomunicacion],
        [modelo_edcomunicacion],
        [descripcion_edcomunicacion],
        [serial_edcomunicacion],
        [fecha_de_ingreso],
        [estado],
        [placa_activo_edcomunicacion],
        [sede_edcomunicacion],
        [ubicacion_edcomunicacion],
        [observaciones_edcomunicacion],
        [fecha_garantia],
        [fecha_crea],
        [usua_crea],
        [fecha_modifica],
        [usua_modifica],
        [cedula],
        [cargo],
        [primernombre],
        [segundonombre],
        [primerapellido],
        [segundoapellido],
        [empresa],
        [observaciones_desasigna]
    ) VALUES (
        '$id',
        '$tipo_maquina',
        '$marca_edcomunicacion',
        '$modelo_edcomunicacion',
        '$descripcion_edcomunicacion',
        '$serial_edcomunicacion',
        '$fecha_de_ingreso',
        '$estado',
        '$placa_activo_edcomunicacion',
        '$sede_edcomunicacion',
        '$ubicacion_edcomunicacion',
        '$observaciones_edcomunicacion',
        '$fecha_garantia',
        '$fecha_crea',
        '$usua_crea',
        '$fecha_modifica',
        '$usua_modifica',
        '$cedula',
        '$cargo',
        '$primernombre',
        '$segundonombre',
        '$primerapellido',
        '$segundoapellido',
        '$empresa',
        '$observaciones_desasigna'
    )";

    
    // Ejecuta la consulta en la tabla 'historial_computador'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_edcomunicacion";
    } else {
        echo "Error en la inserción en la tabla historial_edcomunicacion: " . odbc_errormsg();
    }
}

