<?php
// actualizarcomputador.php

if (isset($_POST['idToUpdate'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';
    
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    $linkInput = $_POST['linkInput'];
    
    // Consulta SQL para actualizar el estado del registro en la tabla maquina_computador
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_simcard] SET [estado] = 1 WHERE [id] = '$idToUpdate'";

    $updateQuery2 = "UPDATE [ControlTIC].[dbo].[maquina_simcard] SET [gestion] = 3 WHERE [id] = '$idToUpdate'";

    $updateQuery3 = "UPDATE [ControlTIC].[dbo].[asignacion_simcard] SET [estado_asignacion] = 'NO VIGENTE' WHERE [id] = '$idToUpdate'";

    $updateQuery4 = "UPDATE [ControlTIC].[dbo].[asignacion_simcard] SET [observaciones_desasigna] = '$linkInput' WHERE [id] = '$idToUpdate'";
    

    // Ejecutar la consulta de eliminación
    if (odbc_exec($conexion, $updateQuery)) {
        // Si la eliminación se realizó correctamente, devolver un mensaje
        echo "Eliminación realizada correctamente";
    } else {
        // Si hubo un error en la eliminación, devolver un mensaje de error
        echo "Error al realizar la eliminación";
    }
    
    // Ejecutar la consulta de actualización
    if (odbc_exec($conexion, $updateQuery2)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }

    // Ejecutar la consulta de actualización
    if (odbc_exec($conexion, $updateQuery3)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }
     // Ejecutar la consulta de actualización
     if (odbc_exec($conexion, $updateQuery4)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }
}
?>