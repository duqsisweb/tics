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
        $id, $tipo_maquina, $service_tag, $serial_equipo, $nombre_equipo, $sede, $empresa, $marca_computador, $modelo_computador, $tipo_comp, $tipo_memoria_ram, $capacidad_ram,
        $tipo_discoduro, $capacidad_discoduro, $procesador, $propietario, $proveedor, $sistema_operativo, $serial_cargador, $dominio, $tipo_usuario, $serial_activo_fijo, $fecha_ingreso_c,
        $targeta_video, $rowData,, $gestion, $Fecha_garantia_c,$cedula,$cargo,$primernombre,$segundonombre,$primerapellido,$segundoapellido,$observaciones_desasigna,$link_computador_asigna,
        $observaciones_asigna,$link_computador_desasigna,$Fecha_mantenimiento_inicio,$Fecha_mantenimiento_fin,$dias_restantes_mantenimiento,$observaciones_mantenimiento
    ) = $rowData;

    // Consulta SQL para actualizar el estado del registro
    $updateQuery = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET estado = '$estado' WHERE id = '$idToUpdate'";
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
        $cambiodeestadoa = "SE MODIFICO ESTADO " ." DE ".$rowData." A ". $estadoTexto;

        // Si la actualización se realizó correctamente, puedes realizar una inserción en otra tabla aquí
        $insertQuery = "INSERT INTO [ControlTIC].[dbo].[historial_computador]
                    (id,tipo_maquina,Service_tag,Serial_equipo,Nombre_equipo,Sede,Empresa,Marca_computador,
                    Modelo_computador,Tipo_comp,Tipo_ram,Memoria_ram,Tipo_discoduro,Capacidad_discoduro,
                    Procesador,Propietario,Proveedor,Sistema_Operativo,Serial_cargador,Dominio,Tipo_usuario,
                    Serial_activo_fijo,Fecha_ingreso_c,Targeta_Video,estado,gestion,Fecha_garantia_c,cedula,cargo,primernombre,segundonombre,primerapellido,
                    segundoapellido,observaciones_desasigna,link_computador_asigna,observaciones_asigna,link_computador_desasigna,Fecha_mantenimiento_inicio,
                    Fecha_mantenimiento_fin,dias_restantes_mantenimiento,observaciones_mantenimiento,fechamov,descripcionmov,usuamov ) 
                    VALUES
                    ('$id','$tipo_maquina','$service_tag','$serial_equipo','$nombre_equipo','$sede','$empresa','$marca_computador',
                    '$modelo_computador','$tipo_comp','$tipo_memoria_ram','$capacidad_ram','$tipo_discoduro','$capacidad_discoduro',
                    '$procesador','$propietario','$proveedor','$sistema_operativo','$serial_cargador','$dominio','$tipo_usuario',
                    '$serial_activo_fijo','$fecha_ingreso_c','$targeta_video','$rowData','$gestion','$Fecha_garantia_c','$cedula','$cargo','$primernombre','$segundonombre',
                    '$primerapellido','$segundoapellido','$observaciones_desasigna','$link_computador_asigna','$observaciones_asigna','$link_computador_desasigna','$Fecha_mantenimiento_inicio',
                    '$Fecha_mantenimiento_fin','$dias_restantes_mantenimiento','$observaciones_mantenimiento',CONVERT(datetime, Getdate(), 120),'$cambiodeestadoa','$usuario' )";
        $insertResult = odbc_exec($conexion, $insertQuery);

        if ($insertResult) {
            echo "Actualización e inserción realizadas correctamente";
        } else {
            echo "Error al realizar la inserción";
        }
    } else {
        echo "Error en el UPDATE: " . odbc_errormsg($conexion);
    }
} else {
    echo "Parámetro idToUpdate no recibido";
}
