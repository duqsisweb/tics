<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) &&
    isset($_POST['tipo_maquina']) &&
    isset($_POST['numero_linea']) &&
    isset($_POST['nombre_plan']) &&
    isset($_POST['fecha_apertura']) &&
    isset($_POST['valor_plan']) &&
    isset($_POST['operador']) &&
    isset($_POST['cod_cliente']) &&
    isset($_POST['observaciones_sim']) &&
    isset($_POST['fecha_fin_plan']) &&
    isset($_POST['estado']) &&
    isset($_POST['gestion']) &&
    isset($_POST['fecha_crea']) &&
    isset($_POST['usua_crea']) &&
    isset($_POST['fecha_modifica']) &&
    isset($_POST['usua_modifica']) &&
    isset($_POST['primernombre']) &&
    isset($_POST['segundonombre']) &&
    isset($_POST['primerapellido']) &&
    isset($_POST['segundoapellido']) &&
    isset($_POST['cedula']) &&
    isset($_POST['cargo']) 
    && isset($_POST['empresa']) && isset($_POST['observaciones_asigna_sim']) && isset($_POST['link_sim_asigna']) && isset($_POST['Usua_asigna'])
    
) {

    $Usua_asigna = $_POST['Usua_asigna'];

    // Recoge los datos de POST
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $numero_linea = $_POST['numero_linea'];
    $nombre_plan = $_POST['nombre_plan'];
    $fecha_apertura = $_POST['fecha_apertura'];
    $valor_plan = $_POST['valor_plan'];
    $operador = $_POST['operador'];
    $cod_cliente = $_POST['cod_cliente'];
    $observaciones_sim = $_POST['observaciones_sim'];
    $fecha_fin_plan = $_POST['fecha_fin_plan'];
    $estado = $_POST['estado'];
    $gestion = $_POST['gestion'];
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

    $link_sim_asigna = $_POST['link_sim_asigna'];
    $observaciones_asigna_sim = $_POST['observaciones_asigna_sim'];

    // INSERTAR DATOS A LA TABLA 'asignacion_simcard'
    $queryAsignacion = "INSERT INTO ControlTIC..asignacion_simcard (
        id, 
        tipo_maquina,
        numero_linea,
        nombre_plan,
        fecha_apertura,
        valor_plan,
        operador,
        cod_cliente,
        observaciones_sim,
        fecha_fin_plan,
        estado,
        gestion,
        fecha_crea,
        usua_crea,
        fecha_modifica,
        usua_modifica,
        primernombre,
        segundonombre,
        primerapellido,
        segundoapellido,
        cedula,
        cargo,
        empresa,
        estado_asignacion
        )
         VALUES (
            '$id',
            '$tipo_maquina',
            '$numero_linea',
            '$nombre_plan',
            '$fecha_apertura',
            '$valor_plan',
            '$operador',
            '$cod_cliente',
            '$observaciones_sim',
            '$fecha_fin_plan',
            'ASIGNADO',
            'ASIGNACION',
            '$fecha_crea',
            '$usua_crea',
            '$fecha_modifica',
            '$usua_modifica',
            '$primernombre',
            '$segundonombre',
            '$primerapellido',
            '$segundoapellido',
            '$cedula',
            '$cargo',
            '$empresa',
            'VIGENTE'
            )";

    // INSERTAR DATOS A LA TABLA 'historial_simcard'
    $queryHistorial = "INSERT INTO ControlTIC..historial_simcard (
        id, 
        tipo_maquina,
        numero_linea,
        nombre_plan,
        fecha_apertura,
        valor_plan,
        operador,
        cod_cliente,
        observaciones_sim,
        fecha_fin_plan,
        estado,
        gestion,
        fecha_crea,
        usua_crea,
        fecha_modifica,
        usua_modifica,
        primernombre,
        segundonombre,
        primerapellido,
        segundoapellido,
        cedula,
        cargo,
        empresa,
        observaciones_asigna_sim,
        link_sim_asigna,
        fechamov,
        descripcionmov,
        usuamov,
        estado_asignacion
        )
         VALUES (
            '$id',
            '$tipo_maquina',
            '$numero_linea',
            '$nombre_plan',
            '$fecha_apertura',
            '$valor_plan',
            '$operador',
            '$cod_cliente',
            '$observaciones_sim',
            '$fecha_fin_plan',
            'ASIGNADO',
            'ASIGNACION',
            '$fecha_crea',
            '$usua_crea',
            '$fecha_modifica',
            '$usua_modifica',
            '$primernombre',
            '$segundonombre',
            '$primerapellido',
            '$segundoapellido',
            '$cedula',
            '$cargo',
            '$empresa',
            '$observaciones_asigna_sim',
            '$link_sim_asigna'
            ,CONVERT(datetime, Getdate(), 120),
            'SE REALIZO ASIGNAMIENTO DE LINEA SIMCARD',
            '$Usua_asigna',
            'VIGENTE'
            )";

    // Ejecuta la consulta en la tabla 'asignacion_simcard'
    $resultAsignacion = odbc_exec($conexion, $queryAsignacion);

    if ($resultAsignacion) {
        echo "Inserción exitosa en la tabla asignacion_simcard<br>";

        // Ahora se procede a insertar en la tabla 'historial_simcard'
        $resultHistorial = odbc_exec($conexion, $queryHistorial);

        if ($resultHistorial) {
            echo "Inserción exitosa en la tabla historial_simcard";
        } else {
            echo "Error en la inserción en la tabla historial_simcard: " . odbc_errormsg();
        }
    } else {
        echo "Error en la inserción en la tabla asignacion_simcard: " . odbc_errormsg();
    }
}
