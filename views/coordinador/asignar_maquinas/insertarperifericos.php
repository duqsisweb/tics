<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['imei']) && isset($_POST['serial_equipo_celular'])
    && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['fecha_ingreso_cel']) && isset($_POST['capacidad'])
    && isset($_POST['ram_celular']) && isset($_POST['estado']) && isset($_POST['gestion_peri']) && isset($_POST['fecha_garantia_cel'])
    && isset($_POST['fecha_crea']) && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) && isset($_POST['usua_modifica'])
    && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido'])
    && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['empresa']) && isset($_POST['observaciones_asigna_peri']) && isset($_POST['link_peri_asigna'])
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
    $serial_perifericos = $_POST['serial_perifericos'];
    $descripcion_perifericos = $_POST['descripcion_perifericos'];
    $marca_perifericos = $_POST['marca_perifericos'];
    $modelo_perifericos = $_POST['modelo_perifericos'];
    $placa_activo_perifericos = $_POST['placa_activo_perifericos'];
    $sede_perifericos = $_POST['sede_perifericos'];
    $ubicacion_perifericos = $_POST['ubicacion_perifericos'];
    $tipo = $_POST['tipo'];
    $tipo_toner = $_POST['tipo_toner'];
    $estado = $_POST['estado'];
    $gestion_peri = $_POST['gestion_peri'];
    $empresa = $_POST['empresa'];
    $fecha_de_garantia_peri = $_POST['fecha_de_garantia_peri'];
    // Recoge los datos adicionales
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];


    $Usua_asigna = $_POST['Usua_asigna'];

    $observaciones_asigna_peri = $_POST['observaciones_asigna_peri'];
    $link_peri_asigna = $_POST['link_peri_asigna'];

    // INSERTAR DATOS A LA TABLA
    $queryAsignacion = "INSERT INTO ControlTIC..asignacion_perifericos (
        id
        ,tipo_maquina
        ,serial_perifericos
        ,descripcion_perifericos
        ,marca_perifericos
        ,modelo_perifericos
        ,placa_activo_perifericos
        ,sede_perifericos
        ,ubicacion_perifericos
        ,tipo
        ,tipo_toner
        ,estado
        ,gestion
        ,empresa
        ,fecha_de_garantia
        ,cedula
        ,cargo
        ,primernombre
        ,segundonombre
        ,primerapellido
        ,segundoapellido
        ,estado_asignacion
    ) VALUES (
        '$id'
        ,'$tipo_maquina'
        ,'$serial_perifericos'
        ,'$descripcion_perifericos'
        ,'$marca_perifericos'
        ,'$modelo_perifericos'
        ,'$placa_activo_perifericos'
        ,'$sede_perifericos'
        ,'$ubicacion_perifericos'
        ,'$tipo'
        ,'$tipo_toner'
        ,'ASIGNADO'
        ,'ASIGNACION'
        ,'$empresa'
        ,'$fecha_de_garantia_peri'
        ,'$cedula'
        ,'$cargo'
        ,'$primernombre'
        ,'$segundonombre'
        ,'$primerapellido'
        ,'$segundoapellido'
        ,'VIGENTE'
    )";

    // INSERTAR DATOS A LA TABLA
    $queryHistorial = "INSERT INTO ControlTIC..historial_perifericos (
        id
        ,tipo_maquina
        ,serial_perifericos
        ,descripcion_perifericos
        ,marca_perifericos
        ,modelo_perifericos
        ,placa_activo_perifericos
        ,sede_perifericos
        ,ubicacion_perifericos
        ,tipo
        ,tipo_toner
        ,estado
        ,gestion_peri
        ,empresa
        ,fecha_de_garantia_peri
        ,cedula
        ,cargo
        ,primernombre
        ,segundonombre
        ,primerapellido
        ,segundoapellido
        ,observaciones_asigna_peri
        ,link_peri_asigna
        ,fechamov
        ,descripcionmov
        ,usuamov
    ) VALUES (
        '$id'
        ,'$tipo_maquina'
        ,'$serial_perifericos'
        ,'$descripcion_perifericos'
        ,'$marca_perifericos'
        ,'$modelo_perifericos'
        ,'$placa_activo_perifericos'
        ,'$sede_perifericos'
        ,'$ubicacion_perifericos'
        ,'$tipo'
        ,'$tipo_toner'
        ,'ASIGNADO'
        ,'ASIGNACION'
        ,'$empresa'
        ,'$fecha_de_garantia_peri'
        ,'$cedula'
        ,'$cargo'
        ,'$primernombre'
        ,'$segundonombre'
        ,'$primerapellido'
        ,'$segundoapellido'
        ,'$observaciones_asigna_peri'
        ,'$link_peri_asigna'
        ,CONVERT(datetime, Getdate(), 120)
        ,'SE REALIZO ASIGNAMIENTO DE UN PERIFERICO'
        ,'$Usua_asigna'
        )";

    var_dump($_POST);

    // Ejecuta la consulta en la tabla 'asignacion_computador'
    $resultAsignacion = odbc_exec($conexion, $queryAsignacion);

    if ($resultAsignacion) {
        echo "Inserción exitosa en la tabla asignacion_peri<br>";

        // Ahora se procede a insertar en la tabla 'historial_computador'
        $resultHistorial = odbc_exec($conexion, $queryHistorial);

        if ($resultHistorial) {
            echo "Inserción exitosa en la tabla historial_peri";
        } else {
            echo "Error en la inserción en la tabla historial_peri: " . odbc_errormsg();
        }
    } else {
        echo "Error en la inserción en la tabla asignacion_peri: " . odbc_errormsg();
    }
}
