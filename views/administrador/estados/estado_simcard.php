<?php
// actualizar_estado.php
include '../../../conexionbd.php';

if (isset($_POST['idToUpdate'])) {
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST["idToUpdate"];
    $estado = $_POST["estado"];

    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_simcard] SET [estado] = '$estado' WHERE [id] = '$idToUpdate'";

    // Ejecutar la consulta de actualización
    if (odbc_exec($conexion, $updateQuery)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }
} else {
    // Si no se proporcionó el parámetro idToUpdate en la solicitud POST, mostrar un mensaje de error
    echo "Parámetro idToUpdate no recibido";
}
?>
