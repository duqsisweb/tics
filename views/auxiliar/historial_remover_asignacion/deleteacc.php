<?php
// actualizarcomputador.php

if (isset($_POST['idToUpdate'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';
    
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    $linkInput = $_POST['linkInput'];
    
    // Consulta SQL para actualizar el estado del registro
    $updateQuery1 = "UPDATE [ControlTIC].[dbo].[maquina_accesorios] SET [cantidad] = [cantidad] + 1 WHERE [id] = '$idToUpdate'";

    $updateQuery32= "UPDATE [ControlTIC].[dbo].[asignacion_accesorios] SET [estado_asignacion] = 'NO VIGENTE' WHERE [id] = '$idToUpdate'";

    $updateQuery3 = "UPDATE [ControlTIC].[dbo].[asignacion_accesorios] SET [observaciones_desasigna] = '$linkInput' WHERE [id] = '$idToUpdate'";
    
    
     // Ejecutar la consulta de actualización
     if (odbc_exec($conexion, $updateQuery1)) {
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
     // Ejecutar la consulta de actualización
     if (odbc_exec($conexion, $updateQuery3)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización";
    }
}
?>
