<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['marca_almacenamiento']) &&
    isset($_POST['modelo_almacenamiento']) && isset($_POST['descripcion_almacenamiento']) &&
    isset($_POST['capacidad_almacenamiento']) && isset($_POST['caracteristica_almacenamiento']) &&
    isset($_POST['sede_almacenamiento']) && isset($_POST['ubicacion_almacenamiento']) &&
    isset($_POST['fecha_de_ingreso']) && isset($_POST['estado']) && isset($_POST['fecha_de_garantia']) &&
    isset($_POST['fecha_crea']) && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) &&
    isset($_POST['usua_modifica']) &&
    isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) &&
    isset($_POST['segundoapellido']) && isset($_POST['cedula']) && isset($_POST['cargo']) &&
    isset($_POST['empresa']) && isset($_POST['link_alma_desasigna']) && isset($_POST['observaciones_desasigna_alma'])
    && isset($_POST['Usua_asigna'])
)     // se Agrega esto para mostrar los datos en la consola del navegador
    echo "<script>";
echo "console.log(" . json_encode($_POST) . ");";
echo "</script>"; {


    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $marca_almacenamiento = $_POST['marca_almacenamiento'];
    $modelo_almacenamiento = $_POST['modelo_almacenamiento'];
    $descripcion_almacenamiento = $_POST['descripcion_almacenamiento'];
    $capacidad_almacenamiento = $_POST['capacidad_almacenamiento'];
    $caracteristica_almacenamiento = $_POST['caracteristica_almacenamiento'];
    $sede_almacenamiento = $_POST['sede_almacenamiento'];
    $ubicacion_almacenamiento = $_POST['ubicacion_almacenamiento'];
    $fecha_de_ingreso = $_POST['fecha_de_ingreso'];
    $estado = $_POST['estado'];
    $fecha_de_garantia = $_POST['fecha_de_garantia'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];

    // Campos adicionales
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];

    $link_alma_desasigna = $_POST['link_alma_desasigna'];
    $observaciones_desasigna_alma = $_POST['observaciones_desasigna_alma'];

    $Usua_asigna = $_POST['Usua_asigna'];



    // INSERTAR DATOS A LA TABLA historial_almacenamiento
    $queryHistorial = "INSERT INTO ControlTIC..historial_almacenamiento (
        id, tipo_maquina, marca_almacenamiento, modelo_almacenamiento,
        descripcion_almacenamiento, capacidad_almacenamiento, caracteristica_almacenamiento,
        sede_almacenamiento, ubicacion_almacenamiento, fecha_de_ingreso_alma, estado,
        fecha_de_garantia_alma, fecha_crea, usua_crea, fecha_modifica, usua_modifica,
        primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, empresa
        ,observaciones_desasigna_alma
        ,link_alma_desasigna
        ,fechamov
        ,descripcionmov
        ,usuamov
    ) VALUES (
        '$id', '$tipo_maquina', '$marca_almacenamiento', '$modelo_almacenamiento',
        '$descripcion_almacenamiento', '$capacidad_almacenamiento', '$caracteristica_almacenamiento',
        '$sede_almacenamiento', '$ubicacion_almacenamiento', '$fecha_de_ingreso', 'CONFIGURACION',
        '$fecha_de_garantia', '$fecha_crea', '$usua_crea', '$fecha_modifica', '$usua_modifica',
        '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido', '$cedula', '$cargo', '$empresa'
        ,'$observaciones_desasigna_alma'
        ,'$link_alma_desasigna'
        ,CONVERT(datetime, Getdate(), 120)
        ,'SE ELIMINA ASIGNACION DE UNA UNIDAD DE ALMACENAMIENTO'
        ,'$Usua_asigna'
    )";



    var_dump($_POST);

    // Ahora se procede a insertar en la tabla 'historial_perifericos'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_almacenamiento";
    } else {
        echo "Error en la inserción en la tabla historial_almacenamiento: " . odbc_errormsg();
    }
}
