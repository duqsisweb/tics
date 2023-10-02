<?php
include '../../../conexionbd.php';

if (
    isset($_POST['nombre_tipo_ram']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $nombreTipoRam = $_POST['nombre_tipo_ram'];
    $id = $_POST['id'];

    // INSERTAR DATOS A LA TABLA tipo_memoria_ram
    $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[tipo_memoria_ram] (nombre_tipo_ram) VALUES ('$nombreTipoRam')";

    // Ahora se procede a insertar en la tabla 'tipo_memoria_ram'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla tipo_memoria_ram";
    } else {
        echo "Error en la inserción en la tabla tipo_memoria_ram: " . odbc_errormsg();
    }
}
?>
