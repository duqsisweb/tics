<?php
function obtenerDatosEquipos($conexion) {
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
