<?php
// actualizarcomputador.php

if (isset($_POST['idToUpdate'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';
    
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    
    // Consulta SQL para actualizar el estado del registro en la tabla maquina_computador
    $updateQueryy = "UPDATE [ControlTIC].[dbo].[maquina_almacenamiento] SET [Estado] = 1 WHERE [id] = '$idToUpdate'";
    
    // Consulta SQL para actualizar el estado del registro en la tabla asignacion_computador
    $updateQuery = "DELETE FROM [ControlTIC].[dbo].[asignacion_almacenamiento] WHERE [id] = '$idToUpdate'";
    
    // Ejecutar la consulta de eliminación
    if (odbc_exec($conexion, $updateQuery)) {
        // Si la eliminación se realizó correctamente, devolver un mensaje
        echo "Eliminación realizada correctamente";
    } else {
        // Si hubo un error en la eliminación, devolver un mensaje de error
        echo "Error al realizar la eliminación";
    }
    
    // Ejecutar la consulta de actualización
    if (odbc_exec($conexion, $updateQueryy)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }
}

?>