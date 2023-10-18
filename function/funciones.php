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
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
    ,[Service_tag]
    ,[Serial_equipo]
    ,[Nombre_equipo]
    ,sed.[nombre_sede] as Sede
    ,empres.[nombre_empresa] as Empresa_computador
    ,[Marca_computador]
    ,[Modelo_computador]
    ,[Tipo_comp]
    ,[Tipo_ram]
    ,[Memoria_ram]
    ,tipodisco.[nombre_tipo_discoduro] as Tipo_disco
    ,capacidaddisco.[capacidad_discoduro] as Capacidad_dico
    ,[Procesador]
    ,[Propietario]
    ,[Proveedor]
    ,sistemao.[nombre_sistema_operativo] as Sistema_O
    ,[Serial_cargador]
    ,[Dominio]
    ,[Tipo_usuario]
    ,[Serial_activo_fijo]
    ,[Fecha_ingreso]
    ,[Targeta_Video]
    ,[Estado]
    ,[Gestion] 
    
            FROM [ControlTIC].[dbo].[maquina_computador] as mc
            LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina On mc.tipo_maquina = tipo_maquina.id    
            LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
            LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
            LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
            LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
            LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
            LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
            LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}





// MANTENIMIENTOS PREVENTIVO

// MANTENIMIENTO COMPUTADOR
function mantenimientopreventivocomputador($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT 
    mc.[id]
    ,[Service_tag]
    ,[Serial_equipo]
    ,[Nombre_equipo]
    ,sed.[nombre_sede] as Sede
    ,empres.[nombre_empresa] as Empresa
    ,[Marca_computador]
    ,[Modelo_computador]
    ,tipocomp.[nombre_tipo_comp] as Tipo_comp
    ,[Tipo_ram]
    ,[Memoria_ram]
    ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro
    ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro
    ,[Procesador]
    ,propietari.[descripcion] as Propietario
    ,[Proveedor]
    ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo
    ,[Serial_cargador]
    ,[Dominio]
    ,[Tipo_usuario]
    ,[Serial_activo_fijo]
    ,[Targeta_Video]
    ,estad.[nombre_estado] Estado
    ,[Usua_mantenimiento]
    ,[Fecha_mantenimiento_inicio]
    ,[Fecha_mantenimiento_fin]
    ,[observaciones_mantenimiento]
    FROM [ControlTIC].[dbo].[maquina_computador] as mc
    LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
    LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
    LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
    LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
    LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
    LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
    LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id
    LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id
    LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}



// AGREGAR COMPLEMENTOS ESCALABLES

// TIPO DE MEMORIA RAM
function agregartipomemoriaram($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  [id] ,[nombre_tipo_ram] FROM [ControlTIC].[dbo].[tipo_memoria_ram]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

// CANTIDAD DE MEMORIA RAM
function agregarcantidadmemoriaram($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT [id] ,[capacidad_ram] FROM [ControlTIC].[dbo].[capacidad_ram]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

// TIPO DISCO DURO
function agregartipodiscoduro($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  [id] ,[nombre_tipo_discoduro] FROM [ControlTIC].[dbo].[tipo_discoduro]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

// CAPACIDAD DISCO DURO
function agregarcapacidaddiscoduro($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  [id] ,[capacidad_discoduro] FROM [ControlTIC].[dbo].[capacidad_discoduro]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

// SISTEMA OPERATIVO
function agregarsistemaoperativo($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT  [id] ,[nombre_sistema_operativo] FROM [ControlTIC].[dbo].[sistema_operativo]";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}







//HOJA DE VIDA DEL EQUIPO COMPUTADOR
function hvcomputador($conexion, $nombreEquipo)
{
    $datosEquipos = array();

    $sql = " SELECT  mc.[id] 
    ,[Service_tag] 
    ,[Serial_equipo] 
    ,[Nombre_equipo] 
    ,sed.[nombre_sede] as Sede 
    ,empres.[nombre_empresa] as Empresa 
    ,[Marca_computador] 
    ,[Modelo_computador] 
    ,tipocomp.[nombre_tipo_comp] as Tipo_comp 
    ,[Tipo_ram] ,[Memoria_ram] 
    ,tipodisco.[nombre_tipo_discoduro] as Tipo_disco 
    ,capacidaddisco.[capacidad_discoduro] as Capacidad_dico 
    ,[Procesador] 
    ,propietari.[descripcion] as Propietario 
    ,[Proveedor] 
    ,sistemao.[nombre_sistema_operativo] as Sistema_O 
    ,[Serial_cargador] ,[Dominio] 
    ,[Tipo_usuario] 
    ,[Serial_activo_fijo] 
    ,[Targeta_Video] ,estad.[nombre_estado] Estado 
    ,gestio.[estado_gestion] as Estado_Gestion  
    ,[Fecha_modifica] 
    ,[Usua_modifica] 
    ,[Usua_asigna] 
    ,[Fecha_asigna] 
    ,[cedula] 
    ,[cargo] 
    ,[primernombre] 
    ,[segundonombre] 
    ,[primerapellido] 
    ,[segundoapellido] 
    ,estadoasigna.[nombre_estado] as Estado_asignacion 
    ,[observaciones_asigna] 
    ,link_computador_asigna 
    ,[observaciones_desasigna] 
    ,link_computador_desasigna
    ,[Fecha_retira]
    ,[Usua_retira]
    ,[Usua_mantenimiento]
    ,[Fecha_mantenimiento_inicio]
    ,[Fecha_mantenimiento_fin]
    ,[observaciones_mantenimiento]
    FROM [ControlTIC].[dbo].[historial_computador] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id 
    LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id 
    LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id 
    LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id 
    LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id 
    LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id 
    LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id 
    LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id 
    LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id 
    LEFT JOIN [ControlTIC].[dbo].estado_asignacion as estadoasigna ON mc.estado_asignacion = estadoasigna.id  WHERE Nombre_equipo = ?";
    $params = array($nombreEquipo);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}

//HOJA DE VIDA DEL EQUIPO CELULAR
function hvcelular($conexion, $imei)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[imei] 
    ,[serial_equipo_celular] 
    ,[marca] 
    ,[modelo] 
    ,[fecha_ingreso] 
    ,[capacidad] 
    ,[ram_celular] 
    ,estad.[nombre_estado] AS [Estado] 
    ,gestio.[estado_gestion] as gestion 
    ,[fecha_garantia] 
    ,[fecha_crea] 
    ,[usua_crea] 
    ,[fecha_modifica] 
    ,[usua_modifica] 
    ,[usua_asigna]
    ,[fecha_asigna]
    ,[cedula]
    ,[cargo]
    ,[primernombre]
    ,[segundonombre]
    ,[primerapellido]
    ,[segundoapellido]
    ,empresa.[nombre_empresa] as empresa
    ,[estado_asignacion]
    ,[observaciones_desasigna]
    FROM [ControlTIC].[dbo].[historial_celular] AS mc 
    JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.[Estado] = estad.[id] 
    JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion = gestio.[id]
    JOIN [ControlTIC].[dbo].empresa AS empresa ON mc.empresa = empresa.id WHERE imei = ?";
    $params = array($imei);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}

//HOJA DE VIDA DEL EQUIPO EDCOMUNICACION
function hvedcomunicacion($conexion, $serial_edcomunicacion)
{
    $datosEquipos = array();

            $sql = " SELECT mc.[id]
        ,tipomaquin.[nombre_maquina] as tipo_maquina 
        ,[marca_edcomunicacion]
        ,[modelo_edcomunicacion]
        ,descripcion_edcomunicacion.[nombre_descripcion] as descripcion_edcomunicacion
        ,[serial_edcomunicacion]
        ,[fecha_de_ingreso]
        ,estad.[nombre_estado] AS [Estado]
        ,[placa_activo_edcomunicacion]
        ,sed.[nombre_sede] as [Sede] 
        ,[ubicacion_edcomunicacion]
        ,[observaciones_edcomunicacion]
        ,gestio.[estado_gestion] as [Gestion] 
        ,[fecha_garantia]
        ,[fecha_crea]
        ,[usua_crea]
        ,[fecha_modifica]
        ,[usua_modifica]
        ,[usua_asigna]
        ,[fecha_asigna]
        ,[cedula]
        ,[cargo]
        ,[primernombre]
        ,[segundonombre]
        ,[primerapellido]
        ,[segundoapellido]
        ,[empresa]
        ,[estado_asignacion]
        ,[observaciones_desasigna]
        FROM [ControlTIC].[dbo].[historial_edcomunicacion] AS mc 
        LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
        LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id 
        LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_edcomunicacion = sed.id 
        LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_edcomunicacion = gestio.id
        LEFT JOIN [ControlTIC].[dbo].descripcion_edcomunicacion AS descripcion_edcomunicacion ON mc.descripcion_edcomunicacion = descripcion_edcomunicacion.id WHERE serial_edcomunicacion = ?";
            $params = array($serial_edcomunicacion);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}

//HOJA DE VIDA DEL EQUIPO PERIFERICOS
function hvperifericos($conexion, $serial_perifericos)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[serial_perifericos]
    ,desperifericos.[nombre_descripcion] as descripcion
    ,[marca_perifericos]
    ,[modelo_perifericos]
    ,[placa_activo_perifericos]
    ,sed.[nombre_sede] as sede
    ,[ubicacion_perifericos]
    ,[tipo] ,[tipo_toner]
    ,gestio.[estado_gestion] as gestion
    ,empres.[nombre_empresa] as empresa
    ,[fecha_de_garantia] ,[fecha_crea]
    ,[usua_crea] ,[fecha_modifica]
    ,[usua_modifica]
    ,[usua_modifica]
    ,[usua_asigna]
    ,[fecha_asigna]
    ,[cedula]
    ,[cargo]
    ,[primernombre]
    ,[segundonombre]
    ,[primerapellido]
    ,[segundoapellido]
    ,estad.[nombre_estado] as estado 
    ,[estado_asignacion]
    ,[observaciones_desasigna]
    FROM [ControlTIC].[dbo].[historial_perifericos] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[descripcion_perifericos] as desperifericos ON mc.descripcion_perifericos = desperifericos.id 
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_perifericos =sed.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] as gestio ON mc.gestion = gestio.id 
    LEFT JOIN [ControlTIC].[dbo].[empresa] as empres ON mc.empresa = empres.id 
    LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id WHERE serial_perifericos = ?";
    $params = array($serial_perifericos);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}

//HOJA DE VIDA DEL EQUIPO ALMACENAMIENTO
function hvalmacenamiento($conexion, $id)
{
    $datosEquipos = array();

            $sql = " SELECT mc.[id]
            ,tipomaquin.[nombre_maquina] as tipo_maquina 
            ,[marca_almacenamiento]
            ,[modelo_almacenamiento]
            ,desalmacenamiento.[nombre_descripcion] as almacenamiento
            ,[capacidad_almacenamiento]
            ,[tipo_almacenamiento]
            ,[caracteristica_almacenamiento]
            ,sed.[nombre_sede] as sede
            ,[ubicacion_almacenamiento]
            ,[fecha_de_ingreso]
            ,estad.[nombre_estado] as estado
            ,[fecha_de_garantia]
            ,[fecha_crea]
            ,[usua_crea]
            ,[fecha_modifica]
            ,[usua_modifica] 
            ,[usua_modifica]
            ,[usua_asigna]
            ,[fecha_asigna]
            ,[cedula]
            ,[cargo]
            ,[primernombre]
            ,[segundonombre]
            ,[primerapellido]
            ,[segundoapellido]
            ,empresa.[nombre_empresa] as empresa
            ,[estado_asignacion]
            ,[observaciones_desasigna]
            FROM [ControlTIC].[dbo].[historial_almacenamiento] as mc 
            LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
            LEFT JOIN [ControlTIC].[dbo].[descripcion_almacenamiento] as desalmacenamiento ON mc.descripcion_almacenamiento = desalmacenamiento.id 
            LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_almacenamiento = sed.id 
            LEFT JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id
            LEFT JOIN [ControlTIC].[dbo].[empresa] as empresa ON mc.empresa = empresa.id WHERE mc.id = ?";
    $params = array($id);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}

//HOJA DE VIDA DEL EQUIPO SIMCARD
function hvsimcard($conexion, $numero_linea)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina  
    ,[numero_linea] 
    ,[nombre_plan] 
    ,[fecha_apertura] 
    ,[valor_plan] 
    ,[operador] 
    ,[cod_cliente] 
    ,[observaciones_sim] 
    ,[fecha_fin_plan] 
    ,estad.[nombre_estado] as Estado 
    ,gestio.[estado_gestion] as Gestion 
    ,[fecha_crea] 
    ,[usua_crea] 
    ,[fecha_modifica] 
    ,[usua_modifica]
    ,[fecha_asigna]
    ,[usua_asigna]
    ,[cedula]
    ,[cargo]
    ,[primernombre]
    ,[segundonombre]
    ,[primerapellido]
    ,[segundoapellido]
    ,empresa.[nombre_empresa] as empresa
    ,[estado_asignacion]
    ,[observaciones_desasigna]
    FROM [ControlTIC].[dbo].[historial_simcard] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[estado] estad ON mc.estado = estad.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] gestio ON mc.gestion = gestio.id
    LEFT JOIN [ControlTIC].[dbo].empresa AS empresa ON mc.empresa = empresa.id  WHERE numero_linea = ?";
    $params = array($numero_linea);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}

//HOJA DE VIDA DEL EQUIPO DVR
function hvdvr($conexion, $id)
{
    $datosEquipos = array();

    $sql = " SELECT  mc.[id]
    ,[tipo_maquina]
    ,[marca_dvr]
    ,[modelo_dvr]
    ,[descripcion_dvr]
    ,[capacidad_dvr]
    ,[tipo_dvr]
    ,sed.[nombre_sede] as Sede ,[ubicacion_dvr]
    ,[software]
    ,[fecha_ingreso]
    ,[num_canales]
    ,[num_discos]
    ,[dias_grabacion]
    ,[ip_dvr]
    ,estad.[nombre_estado] as Estado
    ,[fecha_garantia]
    ,[fecha_crea]
    ,[usua_crea]
    ,[fecha_modifica]
    ,[usua_modifica]
    ,[fecha_asigna]
    ,[usua_asigna]
    ,[cedula]
    ,[cargo]
    ,[primernombre]
    ,[segundonombre]
    ,[primerapellido]
    ,[segundoapellido]
    ,empresa.[nombre_empresa] as empresa
    ,[estado_asignacion]
    ,[observaciones_desasigna]
      FROM [ControlTIC].[dbo].[historial_dvr] as mc
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_dvr = sed.id
    LEFT JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id
     LEFT JOIN [ControlTIC].[dbo].empresa AS empresa ON mc.empresa = empresa.id  WHERE mc.id = ?";
    $params = array($id);

    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    // Si no se encontraron resultados, agregar un mensaje especial
    if (empty($datosEquipos)) {
        $datosEquipos[] = array('Mensaje' => 'SIN REGISTRO');
    }

    return $datosEquipos;
}