<?php

// ESTADOS
function obtenerDatosEquiposcomputadorasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  
        mc.[id],
        e2.[nombre_estado] AS [Estado],
        mc.[Service_tag],
        mc.[Nombre_equipo],
        s.[nombre_sede] AS [Nombre_sede],
        mc.[Marca_computador],
        tc.[nombre_tipo_comp] AS [Nombre_tipo_comp],
        mc.[Memoria_ram],
        cd.[capacidad_discoduro] AS [Capacidad_discoduro],
        p.[descripcion] AS [Propietario],
        mc.[Proveedor],
        so.[nombre_sistema_operativo] AS [Sistema_Operativo]

    FROM [ControlTIC].[dbo].[maquina_computador] AS mc
    JOIN [ControlTIC].[dbo].[sede] AS s ON mc.[Sede] = s.[id]
    JOIN [ControlTIC].[dbo].[empresa] AS e ON mc.[Empresa] = e.[id]
    JOIN [ControlTIC].[dbo].[tipo_comp] AS tc ON mc.[Tipo_comp] = tc.[id]
    JOIN [ControlTIC].[dbo].[tipo_discoduro] AS td ON mc.[Tipo_discoduro] = td.[id]
    JOIN [ControlTIC].[dbo].[capacidad_discoduro] AS cd ON mc.[Capacidad_discoduro] = cd.[id]
    JOIN [ControlTIC].[dbo].[propietario] AS p ON mc.[Propietario] = p.[id]
    JOIN [ControlTIC].[dbo].[sistema_operativo] AS so ON mc.[Sistema_Operativo] = so.[id]
    JOIN [ControlTIC].[dbo].[estado] AS e2 ON mc.[Estado] = e2.[id]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

function obtenerDatosEquiposcelularesasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT mc.[id],
    estad.[nombre_estado] AS [Estado],
    [imei],
    [serial_equipo_celular],
    [marca],
    [modelo],
    [fecha_ingreso],
    [capacidad],
    [ram_celular]
     FROM [ControlTIC].[dbo].[maquina_celular] AS mc 
     JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
     JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.[Estado] = estad.[id] 
     JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion = gestio.[id]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

function obtenerDatosEquiposedcomunicacionasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT mc.[id], 
    estad.[nombre_estado] AS [Estado] ,
    [marca_edcomunicacion] ,
    [modelo_edcomunicacion] ,
    descripedcomunica.[nombre_descripcion] as [descripcion_elementosC]
    ,[serial_edcomunicacion] ,
    sed.[nombre_sede] as [Sede] ,
    [ubicacion_edcomunicacion] ,
    [observaciones_edcomunicacion]
    FROM [ControlTIC].[dbo].[maquina_edcomunicacion] AS mc 
	JOIN [ControlTIC].[dbo].[descripcion_edcomunicacion] as descripedcomunica ON mc.descripcion_edcomunicacion = descripedcomunica.id 
    JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id 
    JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_edcomunicacion = sed.id 
    JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion_edcomunicacion = gestio.id";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

function obtenerDatosEquiposperifericosasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT 
    mc.[id]
    ,estad.[nombre_estado] as estado
    ,[serial_perifericos]
    ,desperifericos.[nombre_descripcion] as descripcion
    ,[marca_perifericos]
    ,[modelo_perifericos]
    ,sed.[nombre_sede] as sede
    ,[ubicacion_perifericos]
    ,[tipo]
    ,empres.[nombre_empresa] as empresa

        FROM [ControlTIC].[dbo].[maquina_perifericos] as mc
        JOIN [ControlTIC].[dbo].[descripcion_perifericos] as desperifericos ON mc.descripcion_perifericos = desperifericos.id
        JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_perifericos =sed.id
        JOIN [ControlTIC].[dbo].[gestion] as gestio ON mc.gestion = gestio.id
        JOIN [ControlTIC].[dbo].[empresa] as empres ON mc.empresa = empres.id
        JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

function obtenerDatosEquiposalmacenamientoasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  
    mc.[id]
    ,estad.[nombre_estado] as Estado
    ,[marca_almacenamiento]
    ,[modelo_almacenamiento]
    ,desalmacenamiento.[nombre_descripcion] as almacenamiento
    ,[capacidad_almacenamiento]
    ,[tipo_almacenamiento]
    ,[caracteristica_almacenamiento]
    ,sed.[nombre_sede] as sede
    ,[ubicacion_almacenamiento]
    FROM [ControlTIC].[dbo].[maquina_almacenamiento] as mc
    JOIN [ControlTIC].[dbo].[descripcion_almacenamiento] as desalmacenamiento ON mc.descripcion_almacenamiento = desalmacenamiento.id
    JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_almacenamiento = sed.id
    JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

function obtenerDatosEquipossimcardasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT 
    mc.[id]
    ,estad.[nombre_estado] as Estado
    ,[numero_linea]
    ,[nombre_plan]
    ,[fecha_apertura]
    ,[valor_plan]
    ,[operador]
    ,[cod_cliente]
    ,[observaciones_sim]
    ,[fecha_fin_plan]

    FROM [ControlTIC].[dbo].[maquina_simcard] as mc
    JOIN [ControlTIC].[dbo].[estado] estad ON mc.estado = estad.id 
    JOIN [ControlTIC].[dbo].[gestion] gestio ON mc.gestion = gestio.id ";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

function obtenerDatosEquiposdvrdasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  mc.[id]
    ,estad.[nombre_estado] as Estado
    ,[marca_dvr]
    ,[descripcion_dvr]
    ,[capacidad_dvr]
    ,sed.[nombre_sede] as Sede
    ,[ubicacion_dvr]
    ,[num_canales]
    ,[num_discos]
    ,[dias_grabacion]
    ,[ip_dvr]
    FROM [ControlTIC].[dbo].[maquina_dvr] as mc
    JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_dvr = sed.id 
    JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}



// MANTENIMIENTO
function obtenerDatosEquiposcomputadormantenimiento($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  
    mc.[id]
    ,[Service_tag]
    ,[Serial_equipo]
    ,[Nombre_equipo]
    ,sed.[nombre_sede] as Sede
    ,empres.[nombre_empresa] as Empresa_computador
    ,[Marca_computador]
    ,[Modelo_computador]
    ,tipocomp.[nombre_tipo_comp] as Tipo_comp
    ,[Tipo_ram]
    ,[Memoria_ram]
    ,tipodisco.[nombre_tipo_discoduro] as Tipo_disco
    ,capacidaddisco.[capacidad_discoduro] as Capacidad_dico
    ,[Procesador]
    ,propietari.[descripcion] as Propietario
    ,[Proveedor]
    ,sistemao.[nombre_sistema_operativo] as Sistema_O
    ,[Serial_cargador]
    ,[Dominio]
    ,[Tipo_usuario]
    ,[Serial_activo_fijo]
    ,[Targeta_Video]
    ,estad.[nombre_estado] Estado
    

            FROM [ControlTIC].[dbo].[maquina_computador] as mc
            JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
            JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
            JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
            JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
            JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
            JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
            JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id
            JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id ";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}
