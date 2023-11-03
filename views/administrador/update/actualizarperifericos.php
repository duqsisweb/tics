<?php
// actualizarcomputador.php

if (isset($_POST['idToUpdate'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';
    
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    
    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_perifericos] SET [estado] = 4, gestion_peri = 1 WHERE [id] = '$idToUpdate'";

    $updateQuery2 = "DELETE FROM [ControlTIC].[dbo].[asignacion_perifericos] WHERE [id] = '$idToUpdate' and estado_asignacion = 'NO VIGENTE' ";

    
    // Ejecutar la consulta de actualización
    if (odbc_exec($conexion, $updateQuery)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }

        // Ejecutar la consulta de actualización
        if (odbc_exec($conexion, $updateQuery2)) {
            // Si la actualización se realizó correctamente, devolver un mensaje
            echo "Actualización realizada correctamente";
        } else {
            // Si hubo un error en la actualización, devolver un mensaje de error
            echo "Error al realizar la actualización";
        }
}
