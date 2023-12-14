<?php
// actualizarcomputador.php

if (
    isset($_POST['idToUpdate'])  
    &&  isset($_POST['usuario'])
    && isset($_POST['observaciones_mantenimiento']) 
    && isset($_POST['Fecha_mantenimiento_inicio']) 
    &&  isset($_POST['Fecha_mantenimiento_fin']) 

) {
    // Incluir el archivo de conexión a la base de datos
    include '../../../conexionbd.php';

    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST['idToUpdate'];
    $usuario = $_POST['usuario'];
    $observaciones_mantenimiento = $_POST['observaciones_mantenimiento'];
    $Fecha_mantenimiento_inicio = $_POST['Fecha_mantenimiento_inicio'];
    $Fecha_mantenimiento_fin = $_POST['Fecha_mantenimiento_fin'];

    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET [Fecha_mantenimiento_inicio] = '$Fecha_mantenimiento_inicio' WHERE [id] = '$idToUpdate'";
    $updateQuery2 = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET [Fecha_mantenimiento_fin] = '$Fecha_mantenimiento_fin' WHERE [id] = '$idToUpdate'";
    $updateQuery3 = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET [usuamov] = '$usuario' WHERE [id] = '$idToUpdate'";
    $updateQuery4 = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET [observaciones_mantenimiento] = '$observaciones_mantenimiento' WHERE [id] = '$idToUpdate'";


    


    // Ejecutar la consulta de actualización 1
    if (odbc_exec($conexion, $updateQuery)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización del estado realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización del estado";
    }


    // Ejecutar la consulta de actualización 1
    if (odbc_exec($conexion, $updateQuery2)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización del estado realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización del estado";
    }

       // Ejecutar la consulta de actualización 1
       if (odbc_exec($conexion, $updateQuery3)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización del estado realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización del estado";
    }


       // Ejecutar la consulta de actualización 1
       if (odbc_exec($conexion, $updateQuery4)) {
        // Si la actualización se realizó correctamente, devolver un mensaje
        echo "Actualización del estado realizada correctamente";
    } else {
        // Si hubo un error en la actualización, devolver un mensaje de error
        echo "Error al realizar la actualización del estado";
    }

    var_dump($_POST);

}
?>
