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
        $id, $tipo_maquina, $marca_edcomunicacion, $modelo_edcomunicacion, $descripcion_edcomunicacion, $serial_edcomunicacion, $fecha_de_ingreso_edc
        ,$rowData,, $placa_activo_edcomunicacion, $sede_edcomunicacion, $ubicacion_edcomunicacion, $observaciones_edcomunicacion, $gestion_edcomunicacion, $fecha_garantia_edc
    ) = $rowData;

    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_edcomunicacion] SET [estado] = '$estado' WHERE [id] = '$idToUpdate'";
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
        $insertQuery = "INSERT INTO [ControlTIC].[dbo].[historial_edcomunicacion]
                    (
                         id
                        ,tipo_maquina
                        ,marca_edcomunicacion
                        ,modelo_edcomunicacion
                        ,descripcion_edcomunicacion
                        ,serial_edcomunicacion
                        ,fecha_de_ingreso_edc
                        ,estado
                        ,placa_activo_edcomunicacion
                        ,sede_edcomunicacion
                        ,ubicacion_edcomunicacion
                        ,observaciones_edcomunicacion
                        ,gestion_edcomunicacion
                        ,fecha_garantia_edc
                        ,fechamov
                        ,descripcionmov
                        ,usuamov 
                        ) 
                    VALUES
                    (
                        '$id'
                        ,'$tipo_maquina'
                        ,'$marca_edcomunicacion'
                        ,'$modelo_edcomunicacion'
                        ,'$descripcion_edcomunicacion'
                        ,'$serial_edcomunicacion'
                        ,'$fecha_de_ingreso_edc'
                        ,'$rowData'
                        ,'$placa_activo_edcomunicacion'
                        ,'$sede_edcomunicacion'
                        ,'$ubicacion_edcomunicacion'
                        ,'$observaciones_edcomunicacion'
                        ,'$gestion_edcomunicacion'
                        ,'$fecha_garantia_edc'
                        ,CONVERT(datetime, Getdate(), 120)
                        ,'$cambiodeestadoa'
                        ,'$usuario'
                         )";

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
