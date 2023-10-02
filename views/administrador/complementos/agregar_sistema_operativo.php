<?php
include '../../../conexionbd.php';

if (
    isset($_POST['nombre_sistema_operativo']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $nombre_sistema_operativo = $_POST['nombre_sistema_operativo'];
    $id = $_POST['id'];

    // INSERTAR DATOS A LA TABLA tipo_memoria_ram
    $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[sistema_operativo] (nombre_sistema_operativo) VALUES ('$nombre_sistema_operativo')";

    // Ahora se procede a insertar en la tabla 'tipo_memoria_ram'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);

    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla sistema_operativo";
    } else {
        echo "Error en la inserción en la tabla sistema_operativo: " . odbc_errormsg();
    }
}
?>
