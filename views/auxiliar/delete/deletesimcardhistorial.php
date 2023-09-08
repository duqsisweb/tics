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
    isset($_POST['cargo']) &&
    isset($_POST['empresa']) &&
    isset($_POST['observaciones_desasigna'])
) {

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
    $observaciones_desasigna = $_POST['observaciones_desasigna'];


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
        observaciones_desasigna
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
            '$estado',
            '$gestion',
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
            '$observaciones_desasigna'
            )";

    // Ejecuta la consulta en la tabla 'historial_computador'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_perifericos";
    } else {
        echo "Error en la inserción en la tabla historial_perifericos: " . odbc_errormsg();
    }
}
