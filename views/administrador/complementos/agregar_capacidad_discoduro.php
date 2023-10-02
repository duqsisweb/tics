<?php
include '../../../conexionbd.php';

if (
    isset($_POST['capacidad_discoduro']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $capacidad_discoduro = $_POST['capacidad_discoduro'];
    $id = $_POST['id'];

    // INSERTAR DATOS A LA TABLA tipo_memoria_ram
    $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[capacidad_discoduro] (capacidad_discoduro) VALUES ('$capacidad_discoduro')";

    // Ahora se procede a insertar en la tabla 'tipo_memoria_ram'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla capacidad_discoduro";
    } else {
        echo "Error en la inserción en la tabla capacidad_discoduro: " . odbc_errormsg();
    }
}
?>
