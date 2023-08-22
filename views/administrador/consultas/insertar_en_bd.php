<?php
session_start();
error_reporting(0);
include '../../../conexionbd.php';

if (isset($_POST['asignar'])) {
    // Obtén los datos enviados a través de la solicitud AJAX
    $dataToInsert = $_POST['dataToInsert']; // Asegúrate de que este nombre coincida con el nombre que usaste en la solicitud AJAX


    // Construye la consulta SQL con los datos obtenidos
    $Consulta = "INSERT INTO [ControlTIC].[dbo].[historial_computador] (
        tipo_maquina,
        Service_tag,
        Serial_equipo,
        Nombre_equipo,
        Sede,
        Empresa,
        Marca_computador,
        Modelo_computador,
        Tipo_comp,
        Tipo_ram,
        Memoria_ram,
        Tipo_discoduro,
        Capacidad_discoduro,
        Procesador,
        Propietario,
        Proveedor,
        Sistema_Operativo,
        Serial_cargador,
        Dominio,
        Tipo_usuario,
        Serial_activo_fijo,
        Fecha_ingreso,
        Targeta_Video,
        Estado,
        Gestion,
        Fecha_garantia,
        Fecha_crea,
        Usua_crea,
        Fecha_modifica,
        Usua_modifica
    ) VALUES (
        '{$dataToInsert['tipo_maquina']}',
        '{$dataToInsert['Service_tag']}',
        '{$dataToInsert['Serial_equipo']}',
        '{$dataToInsert['Nombre_equipo']}',
        '{$dataToInsert['Sede']}',
        '{$dataToInsert['Empresa']}',
        '{$dataToInsert['Marca_computador']}',
        '{$dataToInsert['Modelo_computador']}',
        '{$dataToInsert['Tipo_comp']}',
        '{$dataToInsert['Tipo_ram']}',
        '{$dataToInsert['Memoria_ram']}',
        '{$dataToInsert['Tipo_discoduro']}',
        '{$dataToInsert['Capacidad_discoduro']}',
        '{$dataToInsert['Procesador']}',
        '{$dataToInsert['Propietario']}',
        '{$dataToInsert['Proveedor']}',
        '{$dataToInsert['Sistema_Operativo']}',
        '{$dataToInsert['Serial_cargador']}',
        '{$dataToInsert['Dominio']}',
        '{$dataToInsert['Tipo_usuario']}',
        '{$dataToInsert['Serial_activo_fijo']}',
        '{$dataToInsert['Fecha_ingreso']}',
        '{$dataToInsert['Targeta_Video']}',
        '{$dataToInsert['Estado']}',
        '{$dataToInsert['Gestion']}',
        '{$dataToInsert['Fecha_garantia']}',
        '{$dataToInsert['Fecha_crea']}',
        '{$dataToInsert['Usua_crea']}',
        '{$dataToInsert['Fecha_modifica']}',
        '{$dataToInsert['Usua_modifica']}'
    )";

    // Ejecuta la consulta en la base de datos
    if (odbc_exec($conexion, $Consulta)) {
        echo "Inserción exitosa";
    } else {
        echo "Error en la inserción";
    }
}
?>