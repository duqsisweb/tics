<?php


// INSERTAR DATOS DE HISTORIAL CUANDO SE CREA UN EQUIPO COMPUTADOR



// ESTADOS
function obtenerDatosEquiposcomputadorasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT mc.[id] ,tipo_maquina.[nombre_maquina] as tipo_maquina ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,sed.[nombre_sede] as Sede ,empres.[nombre_empresa] as Empresa ,[Marca_computador] ,[Modelo_computador] ,tipocomp.[nombre_tipo_comp] as Tipo_comp ,tipo_memoria_ram.[nombre_tipo_ram] as tipo_memoria_ram ,capacidad_ram.[capacidad_ram] as capacidad_ram ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro ,[Procesador] ,propietari.[descripcion] as Propietario ,[Proveedor] ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso_c] ,[Targeta_Video] ,estad.[nombre_estado] Estado ,gestio.[estado_gestion] as Gestion ,Fecha_garantia_c,[Fecha_mantenimiento_inicio] ,[Fecha_mantenimiento_fin] ,dias_restantes_mantenimiento ,[observaciones_mantenimiento] ,usuamov, fechamov FROM [ControlTIC].[dbo].[maquina_computador] as mc LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id ";

    $result = odbc_exec($conexion, $sql);

    if ($result !== false) {
        while ($row = odbc_fetch_array($result)) {
            $datosEquipos[] = $row;
        }
        odbc_free_result($result);
    }

    return $datosEquipos;
}

// ESTADO CELULAR
function obtenerDatosEquiposcelularesasignados($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT mc.[id] 
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[imei] 
    ,[serial_equipo_celular] 
    ,[marca] 
    ,[modelo] 
    ,[fecha_ingreso_cel] 
    ,[capacidad] 
    ,[ram_celular] 
    ,estad.[nombre_estado] AS estado
    ,estad.[id] AS estadoid  
    ,gestio.[estado_gestion] as gestion 
    ,[fecha_garantia_cel] 
    FROM [ControlTIC].[dbo].[maquina_celular] AS mc 
    JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.[Estado] = estad.[id] 
    JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion = gestio.[id] ";

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

    $sql = " SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[marca_edcomunicacion]
    ,[modelo_edcomunicacion]
    ,descripcion_edcomunicacion.[nombre_descripcion] as descripcion_edcomunicacion
    ,[serial_edcomunicacion]
    ,[fecha_de_ingreso_edc]
    ,estad.[nombre_estado] AS estado
    ,estad.[id] AS estadoid
    ,[placa_activo_edcomunicacion]
    ,sed.[nombre_sede] as sede_edcomunicacion 
    ,[ubicacion_edcomunicacion]
    ,[observaciones_edcomunicacion]
    ,gestio.[estado_gestion] as gestion_edcomunicacion 
    ,[fecha_garantia_edc]
    FROM [ControlTIC].[dbo].[maquina_edcomunicacion] AS mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id 
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_edcomunicacion = sed.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_edcomunicacion = gestio.id
    LEFT JOIN [ControlTIC].[dbo].descripcion_edcomunicacion AS descripcion_edcomunicacion ON mc.descripcion_edcomunicacion = descripcion_edcomunicacion.id
     ";

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

    $sql = "SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[serial_perifericos]
    ,desperifericos.[nombre_descripcion] as descripcion
    ,[marca_perifericos]
    ,[modelo_perifericos]
    ,[placa_activo_perifericos]
    ,sed.[nombre_sede] as sede_perifericos
    ,[ubicacion_perifericos]
    ,[tipo] ,[tipo_toner]
    ,estad.[nombre_estado] AS estado
    ,estad.[id] AS estadoid
    ,gestio.estado_gestion as gestion_peri
    ,empres.[nombre_empresa] as empresa
    ,[fecha_de_garantia_peri]
    FROM [ControlTIC].[dbo].[maquina_perifericos] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[descripcion_perifericos] as desperifericos ON mc.descripcion_perifericos = desperifericos.id 
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_perifericos =sed.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_peri = gestio.id
    LEFT JOIN [ControlTIC].[dbo].[empresa] as empres ON mc.empresa = empres.id 
    LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id ";

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

    $sql = "SELECT mc.[id]
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
    ,[marca_almacenamiento]
    ,[modelo_almacenamiento]
    ,desalmacenamiento.[nombre_descripcion] as almacenamiento
    ,[capacidad_almacenamiento]
    ,[tipo_almacenamiento]
    ,[caracteristica_almacenamiento]
    ,sed.[nombre_sede] as sede 
    ,[ubicacion_almacenamiento]
    ,[fecha_de_ingreso_alma]
    ,estad.[nombre_estado] as estado
    ,estad.[id] as estadoid
    ,[fecha_de_garantia_alma]
    ,[fecha_crea]
    ,[usua_crea]
    ,[fecha_modifica]
    ,[usua_modifica] FROM [ControlTIC].[dbo].[maquina_almacenamiento] as mc 
    JOIN [ControlTIC].[dbo].[descripcion_almacenamiento] as desalmacenamiento ON mc.descripcion_almacenamiento = desalmacenamiento.id 
    JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_almacenamiento = sed.id 
    JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id
    LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id
    ";

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

    $sql = "SELECT mc.[id]
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
   ,[numero_linea]
   ,[nombre_plan]
   ,[fecha_apertura]
   ,[valor_plan]
   ,[operador]
   ,[cod_cliente]
   ,[observaciones_sim]
   ,[fecha_fin_plan]
   ,estad.[nombre_estado] as estado
   ,estad.[id] as estadoid  
   ,gestio.[estado_gestion] as gestion 
   ,[fecha_crea]
   ,[usua_crea]
   ,[fecha_modifica]
   ,[usua_modifica] 
   FROM [ControlTIC].[dbo].[maquina_simcard] as mc 
   JOIN [ControlTIC].[dbo].[estado] estad ON mc.estado = estad.id 
   JOIN [ControlTIC].[dbo].[gestion] gestio ON mc.gestion = gestio.id
   LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id";

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



// MANTENIMIENTO CORRECTIVO DEL COMPUTADOR
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
                                ,empres.[nombre_empresa] as Empresa
                                ,[Marca_computador]
                                ,[Modelo_computador]
                                ,tipocomp.[nombre_tipo_comp] as Tipo_comp
                                ,Tipo_ram.[nombre_tipo_ram] as Tipo_ram
                                ,memoria_ram.[capacidad_ram] as Memoria_ram
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
                                ,[Fecha_ingreso_c]
                                ,[Targeta_Video]
                                ,estad.[nombre_estado] Estado
                                ,gestio.[estado_gestion] as Gestion
                                ,[Fecha_garantia_c]
                                ,observaciones_mantenimiento_c
                                FROM [ControlTIC].[dbo].[maquina_computador] as mc
                                LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id
                                LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id
                                LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id
                                LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id
                                LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id
                                LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id
                                LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id
                                LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id
                                LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id
                                LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as Tipo_ram ON mc.Tipo_ram = Tipo_ram.id
                                LEFT JOIN [ControlTIC].[dbo].capacidad_ram as memoria_ram ON mc.Memoria_ram = memoria_ram.id
                                LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id ";

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

// MANTENIMIENTO PREVENTIVO COMPUTADOR
function mantenimientopreventivocomputador($conexion)
{
    $datosEquipos = array();

    $sql = "SELECT mc.[id] ,tipo_maquina.[nombre_maquina] as tipo_maquina ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,sed.[nombre_sede] as Sede ,empres.[nombre_empresa] as Empresa ,[Marca_computador] ,[Modelo_computador] ,tipocomp.[nombre_tipo_comp] as Tipo_comp ,tipo_memoria_ram.[nombre_tipo_ram] as tipo_memoria_ram ,capacidad_ram.[capacidad_ram] as Memoria_ram ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro ,[Procesador] ,propietari.[descripcion] as Propietario ,[Proveedor] ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso_c] ,[Targeta_Video] ,estad.[nombre_estado] Estado ,gestio.[estado_gestion] as Gestion ,Fecha_garantia_c,[Fecha_mantenimiento_inicio] ,[Fecha_mantenimiento_fin] ,dias_restantes_mantenimiento ,[observaciones_mantenimiento] ,usuamov, fechamov FROM [ControlTIC].[dbo].[maquina_computador] as mc LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id
    ";

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
function hvcomputadorcab($conexion, $nombreEquipo)
{
    $datosEquipos = array();

    $sql = "SELECT mc.[id] ,tipo_maquina.[nombre_maquina] as tipo_maquina ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,sed.[nombre_sede] as Sede ,empres.[nombre_empresa] as Empresa ,[Marca_computador] ,[Modelo_computador] ,tipocomp.[nombre_tipo_comp] as Tipo_comp ,tipo_memoria_ram.[nombre_tipo_ram] as tipo_memoria_ram ,capacidad_ram.[capacidad_ram] as capacidad_ram ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro ,[Procesador] ,propietari.[descripcion] as Propietario ,[Proveedor] ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso_c] ,[Targeta_Video] ,estad.[nombre_estado] Estado,gestio.[estado_gestion] as Gestion ,Fecha_garantia_c,[Fecha_mantenimiento_inicio] ,[Fecha_mantenimiento_fin],[observaciones_mantenimiento],observaciones_mantenimiento_c,descripcionmov, usuamov, fechamov FROM [ControlTIC].[dbo].[maquina_computador] as mc LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id WHERE Nombre_equipo = ?";
    $params = array($nombreEquipo);
    $result = odbc_prepare($conexion, $sql);
    if ($result !== false) {
        odbc_execute($result, $params);
        while ($row = odbc_fetch_array($result)) {
            $fechaMantenimientoFin = strtotime($row['Fecha_mantenimiento_fin']);
            $fechaActual = time();
            $diasRestantes = floor(($fechaMantenimientoFin - $fechaActual) / (60 * 60 * 24)); // Calcula los días restantes

            // Agrega 'dias_restantes_mantenimiento' al resultado
            $row['dias_restantes_mantenimiento'] = $diasRestantes;
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

function hvcomputador($conexion, $nombreEquipo)
{
    $datosEquipos = array();

    $sql = "SELECT [id_historial]
            ,[id]
            ,[tipo_maquina]
            ,[Service_tag]
            ,[Serial_equipo]
            ,[Nombre_equipo]
            ,[Sede]
            ,[Empresa]
            ,[Marca_computador]
            ,[Modelo_computador]
            ,[Tipo_comp]
            ,[Tipo_ram]
            ,[Memoria_ram]
            ,[Tipo_discoduro]
            ,[Capacidad_discoduro]
            ,[Procesador]
            ,[Propietario]
            ,[Proveedor]
            ,[Sistema_Operativo]
            ,[Serial_cargador]
            ,[Dominio]
            ,[Tipo_usuario]
            ,[Serial_activo_fijo]
            ,[Fecha_ingreso_c]
            ,[Targeta_Video]
            ,[Estado]
            ,[Gestion]
            ,[Fecha_garantia_c]
            ,[cedula]
            ,[cargo]
            ,[primernombre]
            ,[segundonombre]
            ,[primerapellido]
            ,[segundoapellido]
            ,[observaciones_desasigna]
            ,[link_computador_asigna]
            ,[observaciones_asigna]
            ,[link_computador_desasigna]
            ,[Fecha_mantenimiento_inicio]
            ,[Fecha_mantenimiento_fin]
            ,[dias_restantes_mantenimiento]
            ,[observaciones_mantenimiento]
            ,[observaciones_mantenimiento_c]
            ,[fechamov]
            ,[descripcionmov]
            ,[usuamov]
        FROM [ControlTIC].[dbo].[historial_computador] WHERE Nombre_equipo = ?";
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
//FIN HOJA COMPUTADOR


//HOJA DE VIDA DEL EQUIPO CELULAR
function hvcelularcab($conexion, $imei)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id] 
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[imei] 
    ,[serial_equipo_celular] 
    ,[marca] 
    ,[modelo] 
    ,[fecha_ingreso_cel] 
    ,[capacidad] 
    ,[ram_celular] 
    ,estad.[nombre_estado] AS [Estado] 
    ,gestio.[estado_gestion] as gestion 
    ,[fecha_garantia_cel] 
    ,descripcionmov
    ,fechamov
    ,usuamov
    FROM [ControlTIC].[dbo].[maquina_celular] AS mc 
    JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.[Estado] = estad.[id] 
    JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion = gestio.[id] WHERE imei = ? ";
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

function hvcelular($conexion, $imei)
{
    $datosEquipos = array();

    $sql = " SELECT [id_historial]
            ,[id]
            ,[tipo_maquina]
            ,[imei]
            ,[serial_equipo_celular]
            ,[marca]
            ,[modelo]
            ,[fecha_ingreso_cel]
            ,[capacidad]
            ,[ram_celular]
            ,[estado]
            ,[gestion]
            ,[fecha_garantia_cel]
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
            ,[observaciones_asigna]
            ,[link_celular_asigna]
            ,[observaciones_desasigna]
            ,[link_celular_desasigna]
            ,[fechamov]
            ,[descripcionmov]
            ,[usuamov]
        FROM [ControlTIC].[dbo].[historial_celular] where imei = ?";
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

//HOJA DE VIDA DEL ACCESORIOS
function hvacc($conexion, $imei)
{
    $datosEquipos = array();

    $sql = " SELECT [id_historial]
                ,[id]
                ,[tipo_maquina]
                ,[marca]
                ,[modelo]
                ,[descripcion]
                ,[tipo_acc]
                ,[cantidad]
                ,[fecha_de_ingreso_acc]
                ,[fecha_crea]
                ,[usua_crea]
                ,[cedula]
                ,[cargo]
                ,[primernombre]
                ,[segundonombre]
                ,[primerapellido]
                ,[segundoapellido]
                ,[empresa]
                ,[observaciones_asigna_acc]
                ,[link_acc_asigna]
                ,[observaciones_desasigna_acc]
                ,[link_acc_desasigna]
                ,[fechamov]
                ,[descripcionmov]
                ,[usuamov]
            FROM [ControlTIC].[dbo].[historial_accesorios] where id = ? ";
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
function hvedcomunicacioncab($conexion, $serial_edcomunicacion)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id]
    ,tipomaquin.[nombre_maquina] as tipo_maquina 
    ,[marca_edcomunicacion]
    ,[modelo_edcomunicacion]
    ,descripcion_edcomunicacion.[nombre_descripcion] as descripcion_edcomunicacion
    ,[serial_edcomunicacion]
    ,[fecha_de_ingreso_edc]
    ,estad.[nombre_estado] AS estado
    ,[placa_activo_edcomunicacion]
    ,sed.[nombre_sede] as sede_edcomunicacion 
    ,[ubicacion_edcomunicacion]
    ,[observaciones_edcomunicacion]
    ,gestio.[estado_gestion] as gestion_edcomunicacion 
    ,[fecha_garantia_edc]
    ,descripcionmov
    ,fechamov
    ,usuamov
    FROM [ControlTIC].[dbo].[maquina_edcomunicacion] AS mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id 
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_edcomunicacion = sed.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_edcomunicacion = gestio.id
    LEFT JOIN [ControlTIC].[dbo].descripcion_edcomunicacion AS descripcion_edcomunicacion ON mc.descripcion_edcomunicacion = descripcion_edcomunicacion.id
    WHERE serial_edcomunicacion = ?";
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

function hvedcomunicacion($conexion, $serial_edcomunicacion)
{
    $datosEquipos = array();

    $sql = "SELECT [id_historial]
            ,[id]
            ,[tipo_maquina]
            ,[marca_edcomunicacion]
            ,[modelo_edcomunicacion]
            ,[descripcion_edcomunicacion]
            ,[serial_edcomunicacion]
            ,[fecha_de_ingreso_edc]
            ,[estado]
            ,[placa_activo_edcomunicacion]
            ,[sede_edcomunicacion]
            ,[ubicacion_edcomunicacion]
            ,[observaciones_edcomunicacion]
            ,[gestion_edcomunicacion]
            ,[fecha_garantia_edc]
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
        ,[link_edc_desasigna]
        ,[observaciones_asigna_edc]
        ,[link_edc_asigna]
        ,[fechamov]
        ,[descripcionmov]
        ,[usuamov]
    FROM [ControlTIC].[dbo].[historial_edcomunicacion] WHERE serial_edcomunicacion = ?";
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
function  hvperifericoscab($conexion, $serial_perifericos)
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
    ,[tipo] 
    ,[tipo_toner]
    ,estad.[nombre_estado] AS estado
    ,gestio.estado_gestion as gestion_peri
    ,empres.[nombre_empresa] as empresa
    ,[fecha_de_garantia_peri]
    ,descripcionmov
    ,fechamov
    ,usuamov
    FROM [ControlTIC].[dbo].[maquina_perifericos] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].[descripcion_perifericos] as desperifericos ON mc.descripcion_perifericos = desperifericos.id 
    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_perifericos =sed.id 
    LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_peri = gestio.id
    LEFT JOIN [ControlTIC].[dbo].[empresa] as empres ON mc.empresa = empres.id 
    LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.estado = estad.id
    
     WHERE serial_perifericos = ?";
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

function  hvperifericos($conexion, $serial_perifericos)
{
    $datosEquipos = array();

    $sql = "SELECT [id_historial]
            ,[id]
            ,[tipo_maquina]
            ,[serial_perifericos]
            ,[descripcion_perifericos]
            ,[marca_perifericos]
            ,[modelo_perifericos]
            ,[placa_activo_perifericos]
            ,[sede_perifericos]
            ,[ubicacion_perifericos]
            ,[tipo]
            ,[tipo_toner]
            ,[estado]
            ,[gestion_peri]
            ,[empresa]
            ,[fecha_de_garantia_peri]
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
            ,[estado_asignacion]
            ,[observaciones_desasigna]
            ,[observaciones_asigna_peri]
            ,[link_peri_asigna]
            ,[observaciones_desasigna_peri]
            ,[link_peri_desasigna]
            ,[fechamov]
            ,[descripcionmov]
            ,[usuamov]
        FROM [ControlTIC].[dbo].[historial_perifericos] WHERE serial_perifericos = ?";
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
function hvalmacenamientocab($conexion, $id)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id] as id
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
    ,[marca_almacenamiento]
    ,[modelo_almacenamiento]
    ,desalmacenamiento.[nombre_descripcion] as descripcion_almacenamiento
    ,[capacidad_almacenamiento]
    ,[tipo_almacenamiento]
    ,[caracteristica_almacenamiento]
    ,sed.[nombre_sede] as sede_almacenamiento 
    ,[ubicacion_almacenamiento]
    ,[fecha_de_ingreso_alma]
    ,estad.[nombre_estado] as estado
    ,gestio.[estado_gestion] as gestion_alma 
    ,[fecha_de_garantia_alma]
    ,[fecha_crea]
    ,[usua_crea]
    ,[fecha_modifica]
    ,[usua_modifica] 
	,descripcionmov
	,fechamov
	,usuamov
	FROM [ControlTIC].[dbo].[maquina_almacenamiento] as mc 
    JOIN [ControlTIC].[dbo].[descripcion_almacenamiento] as desalmacenamiento ON mc.descripcion_almacenamiento = desalmacenamiento.id 
    JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_almacenamiento = sed.id 
    JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id
    LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id
    LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON gestion_alma = gestio.id 
    WHERE mc.id = ? ";
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

function hvalmacenamiento($conexion, $id)
{
    $datosEquipos = array();

    $sql = " SELECT [id_historial]
                    ,[id] 
                    ,[tipo_maquina]
                    ,[marca_almacenamiento]
                    ,[modelo_almacenamiento]
                    ,[descripcion_almacenamiento]
                    ,[capacidad_almacenamiento]
                    ,[tipo_almacenamiento]
                    ,[caracteristica_almacenamiento]
                    ,[sede_almacenamiento]
                    ,[ubicacion_almacenamiento]
                    ,[fecha_de_ingreso_alma]
                    ,[estado]
                    ,[fecha_de_garantia_alma]
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
                    ,[estado_asigna]
                    ,[observaciones_asigna_alma]
                    ,[link_alma_asigna]
                    ,[observaciones_desasigna_alma]
                    ,[link_alma_desasigna]
                    ,[fechamov]
                    ,[descripcionmov]
                    ,[usuamov]
                FROM [ControlTIC].[dbo].[historial_almacenamiento]
            WHERE id = ? ";
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
function hvsimcardcab($conexion, $numero_linea)
{
    $datosEquipos = array();

    $sql = " SELECT mc.[id]
    ,tipo_maquina.[nombre_maquina] as tipo_maquina
   ,[numero_linea]
   ,[nombre_plan]
   ,[fecha_apertura]
   ,[valor_plan]
   ,[operador]
   ,[cod_cliente]
   ,[observaciones_sim]
   ,[fecha_fin_plan]
   ,estad.[nombre_estado] as estado 
   ,gestio.[estado_gestion] as gestion 
   ,[fecha_crea]
   ,[usua_crea]
   ,[fecha_modifica]
   ,[usua_modifica] 
   ,descripcionmov
   ,fechamov
   ,usuamov
   FROM [ControlTIC].[dbo].[maquina_simcard] as mc 
   JOIN [ControlTIC].[dbo].[estado] estad ON mc.estado = estad.id 
   JOIN [ControlTIC].[dbo].[gestion] gestio ON mc.gestion = gestio.id
   LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id
    WHERE numero_linea = ?";
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

function hvsimcard($conexion, $numero_linea)
{
    $datosEquipos = array();

    $sql = " SELECT  [id_historial]
            ,[id]
            ,[tipo_maquina]
            ,[numero_linea]
            ,[nombre_plan]
            ,[fecha_apertura]
            ,[valor_plan]
            ,[operador]
            ,[cod_cliente]
            ,[observaciones_sim]
            ,[fecha_fin_plan]
            ,[estado]
            ,[gestion]
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
            ,[empresa]
            ,[estado_asignacion]
            ,[observaciones_asigna_sim]
            ,[link_sim_asigna]
            ,[observaciones_desasigna_sim]
            ,[link_sim_desasigna]
            ,[fechamov]
            ,[descripcionmov]
            ,[usuamov]
        FROM [ControlTIC].[dbo].[historial_simcard]
            WHERE numero_linea = ?";
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

    $sql = " SELECT [id_historial]
                ,[id]
                ,[tipo_maquina]
                ,[marca_dvr]
                ,[modelo_dvr]
                ,[descripcion_dvr]
                ,[capacidad_dvr]
                ,[tipo_dvr]
                ,[sede_dvr]
                ,[ubicacion_dvr]
                ,[software]
                ,[fecha_ingreso]
                ,[num_canales]
                ,[num_discos]
                ,[dias_grabacion]
                ,[ip_dvr]
                ,[estado]
                ,[estado_asignacion]
                ,[fecha_garantia]
                ,[cedula]
                ,[cargo]
                ,[primernombre]
                ,[segundonombre]
                ,[primerapellido]
                ,[segundoapellido]
                ,[empresa]
                ,[observaciones_dvr_asiga]
                ,[link_dvr_asigna]
                ,[observaciones_dvr_desasigna]
                ,[link_dvr_desasigna]
                ,[fecha_mantenimiento_inicio]
                ,[fecha_mantenimiento_fin]
                ,[dias_restantes_mantenimiento]
                ,[observaciones_mantenimiento]
                ,[descripcionmov]
                ,[usuamov]
                ,[fechamov]
            FROM [ControlTIC].[dbo].[historial_dvr]  WHERE id = ?";
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




class funciones
{
// usuarios 
function usuarios()
{
    include '../../../conexionbd.php';

    $data = odbc_exec($conexion, "SELECT [id] ,[name] ,[email] ,[email_verified_at] ,[password] ,[remember_token] ,[created_at] ,[updated_at] ,[cod_vendedor] ,[TipoUsuario] ,[Estado] ,[sistemaClasificador] ,[estadopassword] FROM [ControlTIC].[dbo].[users] where TipoUsuario = '6'");
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }
    return $arr;
}

function usuariosperfil($usuario)
{
    include '../../../conexionbd.php';

    $data = odbc_exec($conexion, "SELECT [id], [name], [email], [email_verified_at], [password], [remember_token], [created_at], [updated_at], [cod_vendedor], [TipoUsuario], [Estado], [sistemaClasificador], [estadopassword] FROM [ControlTIC].[dbo].[users] WHERE email = '$usuario'");
    
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }
    
    return $arr;
}

}
