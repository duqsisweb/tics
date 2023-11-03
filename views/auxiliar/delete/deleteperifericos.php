<?php
// actualizarcomputador.php

if (isset($_POST['idToUpdate'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';
    
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    $linkInput = $_POST['linkInput'];
    
    // Consulta SQL para actualizar el estado del registro en la tabla maquina_computador
    $updateQuery1 = "UPDATE [ControlTIC].[dbo].[maquina_perifericos] SET [estado] = 1 WHERE [id] = '$idToUpdate'";
    
    // Consulta SQL para actualizar el estado del registro en la tabla asignacion_computador
    $updateQuery2 = "UPDATE [ControlTIC].[dbo].[maquina_perifericos] SET [gestion_peri] = 3 WHERE [id] = '$idToUpdate'";

    $updateQuery3 = "UPDATE [ControlTIC].[dbo].[asignacion_perifericos] SET [estado_asignacion] = 'NO VIGENTE' WHERE [id] = '$idToUpdate'";

    $updateQuery4 = "UPDATE [ControlTIC].[dbo].[asignacion_perifericos] SET [observaciones_desasigna] = '$linkInput' WHERE [id] = '$idToUpdate'";
    
    
     
    // Ejecutar la consulta de eliminación
    if (odbc_exec($conexion, $updateQuery1)) {
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