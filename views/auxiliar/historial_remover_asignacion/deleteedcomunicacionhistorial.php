<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['marca_edcomunicacion']) && isset($_POST['modelo_edcomunicacion']) && isset($_POST['marca'])
    && isset($_POST['modelo']) && isset($_POST['fecha_ingreso_cel']) && isset($_POST['capacidad']) && isset($_POST['descripcion_edcomunicacion']) && isset($_POST['serial_edcomunicacion'])
    && isset($_POST['fecha_de_ingreso_edc']) && isset($_POST['estado']) && isset($_POST['placa_activo_edcomunicacion']) && isset($_POST['sede_edcomunicacion']) && isset($_POST['ubicacion_edcomunicacion'])
    && isset($_POST['observaciones_edcomunicacion']) && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido'])
    && isset($_POST['gestion_edcomunicacion']) && isset($_POST['fecha_garantia_edc'])  && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido'])
    && isset($_POST['segundoapellido']) && isset($_POST['cedula']) && isset($_POST['cargo']) 
    && isset($_POST['empresa']) && isset($_POST['observaciones_desasigna']) && isset($_POST['link_edc_desasigna'])
    && isset($_POST['Usua_asigna'])

)

    // se Agrega esto para mostrar los datos en la consola del navegador
    echo "<script>";
echo "console.log(" . json_encode($_POST) . ");";
echo "</script>"; {


    $Usua_asigna = $_POST['Usua_asigna'];

    // Recoge los datos de POST
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $marca_edcomunicacion = $_POST['marca_edcomunicacion'];
    $modelo_edcomunicacion = $_POST['modelo_edcomunicacion'];
    $descripcion_edcomunicacion = $_POST['descripcion_edcomunicacion'];
    $serial_edcomunicacion = $_POST['serial_edcomunicacion'];
    $fecha_de_ingreso_edc = $_POST['fecha_de_ingreso_edc'];
    $estado = $_POST['estado'];
    $placa_activo_edcomunicacion = $_POST['placa_activo_edcomunicacion'];
    $sede_edcomunicacion = $_POST['sede_edcomunicacion'];
    $ubicacion_edcomunicacion = $_POST['ubicacion_edcomunicacion'];
    $observaciones_edcomunicacion = $_POST['observaciones_edcomunicacion'];
    $gestion_edcomunicacion = $_POST['gestion_edcomunicacion'];
    $fecha_garantia_edc = $_POST['fecha_garantia_edc'];

    // Recoge los datos adicionales
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];

    $observaciones_desasigna = $_POST['observaciones_desasigna'];
    $link_edc_desasigna = $_POST['link_edc_desasigna'];

    // INSERTAR DATOS A LA TABLA
    $queryHistorial = "INSERT INTO ControlTIC..historial_edcomunicacion 
    ( 
        id,
        tipo_maquina
        ,marca_edcomunicacion
        ,modelo_edcomunicacion
        ,descripcion_edcomunicacion
        ,serial_edcomunicacion
        ,fecha_de_ingreso_edc
        ,estado
        ,placa_activo_edcomunicacion
        ,sede_edcomunicacion
        ,ubicacion_edcomunicacion
        ,observaciones_edcomunicacion
        ,gestion_edcomunicacion
        ,fecha_garantia_edc
        ,cedula
        ,cargo
        ,primernombre
        ,segundonombre
        ,primerapellido
        ,segundoapellido
        ,observaciones_desasigna
        ,link_edc_desasigna
        ,fechamov
        ,descripcionmov
        ,usuamov ) 
        VALUES ( 
            '$id'
            ,'$tipo_maquina'
            ,'$marca_edcomunicacion'
            ,'$modelo_edcomunicacion'
            ,'$descripcion_edcomunicacion'
            ,'$serial_edcomunicacion'
            ,'$fecha_de_ingreso_edc'
            ,'CONFIGURACION'
            ,'$placa_activo_edcomunicacion'
            ,'$sede_edcomunicacion' 
            ,'$ubicacion_edcomunicacion'
            ,'$observaciones_edcomunicacion'
            ,'SIN ASIGNACION'
            ,'$fecha_garantia_edc'
            ,'$cedula'
            ,'$cargo'
            ,'$primernombre'
            ,'$segundonombre'
            ,'$primerapellido'
            ,'$segundoapellido'
            ,'$observaciones_desasigna'
            ,'$link_edc_desasigna'
            , CONVERT(datetime, Getdate(), 120)
            ,'SE REALIZO ELIMINACION DE UN ELEMENTO DE COMUNICACION'
            ,'$Usua_asigna' )";

    var_dump($_POST);

    // Ahora se procede a insertar en la tabla 'historial_computador'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_edcomunicacion";
    } else {
        echo "Error en la inserción en la tabla historial_edcomunicacion: " . odbc_errormsg();
    }
}
