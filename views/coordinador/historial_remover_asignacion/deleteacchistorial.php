<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id'])

    && isset($_POST['id'])
    && isset($_POST['tipo_maquina'])
    && isset($_POST['marca'])
    && isset($_POST['modelo'])
    && isset($_POST['descripcion'])
    && isset($_POST['tipo_acc'])
    && isset($_POST['cantidad'])
    && isset($_POST['fecha_de_ingreso_acc'])

    && isset($_POST['primernombre'])
    && isset($_POST['segundonombre'])
    && isset($_POST['primerapellido'])
    && isset($_POST['segundoapellido'])
    && isset($_POST['cedula'])
    && isset($_POST['cargo'])

    && isset($_POST['Usua_asigna'])
    && isset($_POST['observaciones_desasigna_acc'])
    && isset($_POST['link_acc_desasigna'])

)

    // se Agrega esto para mostrar los datos en la consola del navegador
    echo "<script>";
echo "console.log(" . json_encode($_POST) . ");";
echo "</script>"; {

    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $descripcion = $_POST['descripcion'];
    $tipo_acc = $_POST['tipo_acc'];
    $cantidad = $_POST['cantidad'];
    $fecha_de_ingreso_acc = $_POST['fecha_de_ingreso_acc'];

    // Recoge los datos de POST
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];

    $Usua_asigna = $_POST['Usua_asigna'];
    $observaciones_desasigna_acc = $_POST['observaciones_desasigna_acc'];
    $link_acc_desasigna = $_POST['link_acc_desasigna'];


    // INSERTAR DATOS A LA TABLA
    $queryHistorial = "INSERT INTO ControlTIC..historial_accesorios (
         id,tipo_maquina,marca,modelo,descripcion,tipo_acc,cantidad,fecha_de_ingreso_acc,primernombre, segundonombre,primerapellido,segundoapellido,cedula,cargo,observaciones_desasigna_acc,link_acc_desasigna,fechamov,descripcionmov,usuamov
    ) VALUES (
        '$id','$tipo_maquina','$marca','$modelo','$descripcion','$tipo_acc','$cantidad','$fecha_de_ingreso_acc','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$cedula','$cargo','$observaciones_desasigna_acc','$link_acc_desasigna',CONVERT(datetime, Getdate(), 120),'SE ELIMINO ASIGNAMIENTO DE UN ACCESORIO','$Usua_asigna')";

    var_dump($_POST);




    // Ahora se procede a insertar en la tabla 'historial_computador'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_acc";
    } else {
        echo "Error en la inserción en la tabla historial_acc: " . odbc_errormsg();
    }
}
