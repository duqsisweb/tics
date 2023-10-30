<?php
// estado_computador.php
include '../../../conexionbd.php';

if (isset($_POST['idToUpdate'])) {
    // Obtener el ID para actualizar desde la solicitud POST
    $idToUpdate = $_POST["idToUpdate"];
    $estado = $_POST["estado"];
    $usuario = $_POST["usuario"];
    $rowData = $_POST["rowData"];


    echo "ID a actualizar: " . $idToUpdate;
    echo "Nuevo estado: " . $estado;

    // Obtener todos los valores de la fila
    list(
        $id
        ,$tipo_maquina
        ,$marca_almacenamiento
        ,$modelo_almacenamiento
        ,$almacenamiento
        ,$capacidad_almacenamiento
        ,$tipo_almacenamiento
        ,$caracteristica_almacenamiento
        ,$sede
        ,$ubicacion_almacenamiento
        ,$fecha_de_ingreso_alma
        ,$rowData,
        ,$fecha_de_garantia_alma
    ) = $rowData;

    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_almacenamiento] SET [estado] = '$estado' WHERE [id] = '$idToUpdate'";
    // Ejecutar la consulta de actualización
    $updateResult = odbc_exec($conexion, $updateQuery);

    // Verificar si la consulta de actualización se ejecutó correctamente
    if ($updateResult) {

        // Definir el mapeo de estados
        $estadoText = [
            1 => 'CONFIGURACION',
            2 => 'BAJA',
            3 => 'VENDIDO',
            4 => 'ASIGNADO',
            5 => 'PROVEEDOR',
            6 => 'STOCK'
        ];

        // Obtener el estado en formato de texto
        $estadoTexto = $estadoText[$estado];

        // Construir la cadena para la descripción
        $cambiodeestadoa = "SE MODIFICO ESTADO " . " DE " . $rowData . " A " . $estadoTexto;


        // Si la actualización se realizó correctamente, puedes realizar una inserción en otra tabla aquí
        $insertQuery = "INSERT INTO [ControlTIC].[dbo].[historial_almacenamiento]
                    (
                         id
                        ,tipo_maquina
                        ,marca_almacenamiento
                        ,modelo_almacenamiento
                        ,descripcion_almacenamiento
                        ,capacidad_almacenamiento
                        ,tipo_almacenamiento
                        ,caracteristica_almacenamiento
                        ,sede_almacenamiento
                        ,ubicacion_almacenamiento
                        ,fecha_de_ingreso_alma
                        ,estado
                        ,fecha_de_garantia_alma
                        ,fechamov
                        ,descripcionmov
                        ,usuamov ) 
                    VALUES
                    (
                        '$id'
                        ,'$tipo_maquina'
                        ,'$marca_almacenamiento'
                        ,'$modelo_almacenamiento'
                        ,'$almacenamiento'
                        ,'$capacidad_almacenamiento'
                        ,'$tipo_almacenamiento'
                        ,'$caracteristica_almacenamiento'
                        ,'$sede'
                        ,'$ubicacion_almacenamiento'
                        ,'$fecha_de_ingreso_alma'
                        ,'$rowData'
                        ,'$fecha_de_garantia_alma'
                        ,CONVERT(datetime, Getdate(), 120)
                        ,'$cambiodeestadoa'
                        ,'$usuario' )";

        $insertResult = odbc_exec($conexion, $insertQuery);

        if ($insertResult) {
            echo "Actualización e inserción realizadas correctamente";
        } else {
            echo "Error al realizar la inserción: " . odbc_errormsg($conexion);
        }
    } else {
        echo "Error en el UPDATE: " . odbc_errormsg($conexion);
    }
}
