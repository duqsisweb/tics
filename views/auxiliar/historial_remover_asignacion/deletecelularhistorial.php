<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['imei']) && isset($_POST['serial_equipo_celular'])
    && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['fecha_ingreso_cel']) && isset($_POST['capacidad'])
    && isset($_POST['ram_celular']) && isset($_POST['estado']) && isset($_POST['gestion']) && isset($_POST['fecha_garantia_cel'])
    && isset($_POST['fecha_crea']) && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) && isset($_POST['usua_modifica'])
    && isset($_POST['primernombre']) && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido'])
    && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['empresa']) 
    && isset($_POST['observaciones_desasigna']) && isset($_POST['link_celular_desasigna'])
    && isset($_POST['Usua_asigna'])
)

    // se Agrega esto para mostrar los datos en la consola del navegador
    echo "<script>";
echo "console.log(" . json_encode($_POST) . ");";
echo "</script>"; {



    // Recoge los datos de POST
    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $imei = $_POST['imei'];
    $serial_equipo_celular = $_POST['serial_equipo_celular'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $fecha_ingreso_cel = $_POST['fecha_ingreso_cel'];
    $capacidad = $_POST['capacidad'];
    $ram_celular = $_POST['ram_celular'];
    $estado = $_POST['estado'];
    $gestion = $_POST['gestion'];
    $fecha_garantia_cel = $_POST['fecha_garantia_cel'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    // $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];
    // Recoge los datos adicionales
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];
    // $empresa = $_POST['empresa'];


    $Usua_asigna = $_POST['Usua_asigna'];

    $observaciones_desasigna = $_POST['observaciones_desasigna'];
    $link_celular_desasigna = $_POST['link_celular_desasigna'];



    // INSERTAR DATOS A LA TABLA
    $queryHistorial = "INSERT INTO ControlTIC..historial_celular (
        id, tipo_maquina, imei, serial_equipo_celular, marca, modelo,
        fecha_ingreso_cel, capacidad, ram_celular, estado, gestion, fecha_garantia_cel,
        primernombre, segundonombre,
        primerapellido, segundoapellido, cedula, cargo,observaciones_desasigna, link_celular_desasigna,fechamov,descripcionmov,usuamov
    ) VALUES (
        '$id', '$tipo_maquina', '$imei', '$serial_equipo_celular', '$marca', '$modelo',
        '$fecha_ingreso_cel', '$capacidad', '$ram_celular', 'CONFIGURACION', 'SIN ASIGNACION', '$fecha_garantia_cel',
        '$primernombre', '$segundonombre',
        '$primerapellido', '$segundoapellido', '$cedula', '$cargo', '$observaciones_desasigna', '$link_celular_desasigna',CONVERT(datetime, Getdate(), 120),'SE ELIMINO ASIGNACION DE UN CELULAR','$Usua_asigna'
        )";

    var_dump($_POST);


    // Ahora se procede a insertar en la tabla 'historial_computador'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_celular";
    } else {
        echo "Error en la inserción en la tabla historial_celular: " . odbc_errormsg();
    }
}
