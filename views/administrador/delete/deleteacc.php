<?php
// actualizarcomputador.php

if (isset($_POST['idToUpdate'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';
    
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    
    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_accesorios] SET [cantidad] = [cantidad] + 1 WHERE [id] = '$idToUpdate'";

    $updateQuery2 = "DELETE FROM [ControlTIC].[dbo].[asignacion_accesorios] WHERE [id] = '$idToUpdate'";
    
    // Ejecutar la primera consulta de actualización
    $result1 = odbc_exec($conexion, $updateQuery);
    
    // Ejecutar la segunda consulta de eliminación
    $result2 = odbc_exec($conexion, $updateQuery2);

    if ($result1 && $result2) {
        // Si ambas consultas se ejecutaron correctamente, devolver un mensaje
        echo "Actualización y eliminación realizadas correctamente";
    } else {
        // Si hubo un error en alguna de las consultas, devolver un mensaje de error
        echo "Error al realizar la actualización y/o eliminación";
    }
}
?>
