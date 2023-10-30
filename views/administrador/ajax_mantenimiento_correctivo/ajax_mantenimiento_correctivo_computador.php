<?php
include '../../../conexionbd.php';

// Recibir los datos enviados por AJAX
$id = $_POST['id'];
$Sede = $_POST['Sede'];
$Empresa = $_POST['Empresa'];
$Memoria_ram = $_POST['Memoria_ram'];
$Tipo_discoduro = $_POST['Tipo_discoduro'];
$Capacidad_discoduro = $_POST['Capacidad_discoduro'];
$Sistema_Operativo = $_POST['Sistema_Operativo'];
$Serial_cargador = $_POST['Serial_cargador'];
$Dominio = $_POST['Dominio'];
$Tipo_usuario = $_POST['Tipo_usuario'];
$usuario = $_POST['usuario'];
$observaciones_mantenimiento_c = $_POST['observaciones_mantenimiento_c'];


// Recibir más campos según sea necesario

// Construir la consulta SQL de actualización
$consultaSQLUpdate = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET 
Sede = '$Sede', 
Empresa = '$Empresa',
Memoria_ram = '$Memoria_ram',
Tipo_discoduro = '$Tipo_discoduro',
Capacidad_discoduro = '$Capacidad_discoduro',
Sistema_Operativo = '$Sistema_Operativo',
Serial_cargador = '$Serial_cargador',
Dominio = '$Dominio',
Tipo_usuario = '$Tipo_usuario',
observaciones_mantenimiento_c = '$observaciones_mantenimiento_c'
WHERE id = $id";

$tipo_maquina = $_POST['tipo_maquina'];
$Service_tag = $_POST['Service_tag'];
$Serial_equipo = $_POST['Serial_equipo'];
$Nombre_equipo = $_POST['Nombre_equipo'];
$Marca_computador = $_POST['Marca_computador'];
$Modelo_computador = $_POST['Modelo_computador'];
$Tipo_comp = $_POST['Tipo_comp'];
$Tipo_ram = $_POST['Tipo_ram'];
$Procesador = $_POST['Procesador'];
$Propietario = $_POST['Propietario'];
$Proveedor = $_POST['Proveedor'];
$Serial_activo_fijo = $_POST['Serial_activo_fijo'];
$Fecha_ingreso_c = $_POST['Fecha_ingreso_c'];
$Targeta_Video = $_POST['Targeta_Video'];
$Estado = $_POST['Estado'];
$Gestion = $_POST['Gestion'];


// Ejecutar la consulta SQL para obtener los datos de la base de datos
$consultaSQLSelect = "SELECT mc.[id], tipo_maquina.[nombre_maquina] as tipo_maquina, [Service_tag], [Serial_equipo], [Nombre_equipo], sed.[nombre_sede] as Sede, empres.[nombre_empresa] as Empresa, [Marca_computador], [Modelo_computador], tipocomp.[nombre_tipo_comp] as Tipo_comp, tipo_memoria_ram.[nombre_tipo_ram] as Tipo_ram, capacidad_ram.[capacidad_ram] as capacidad_ram, tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro, capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro, [Procesador], propietari.[descripcion] as Propietario, [Proveedor], sistemao.[nombre_sistema_operativo] as Sistema_Operativo, [Serial_cargador], [Dominio], [Tipo_usuario], [Serial_activo_fijo], [Fecha_ingreso_c], [Targeta_Video], estad.[nombre_estado] Estado, gestio.[estado_gestion] as Gestion, [Fecha_garantia_c] FROM [ControlTIC].[dbo].[maquina_computador] as mc LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id WHERE mc.id = $id";

$resultadoSelect = odbc_exec($conexion, $consultaSQLSelect);

if ($resultadoSelect) {
    // Obtener los datos de la consulta y asignarlos a las variables
    $row = odbc_fetch_array($resultadoSelect);
    $Sede = $row['Sede'];
    $Empresa = $row['Empresa'];
    $Memoria_ram = $row['capacidad_ram'];
    $Tipo_discoduro = $row['Tipo_discoduro'];
    $Capacidad_discoduro = $row['Capacidad_discoduro'];
    $Sistema_Operativo = $row['Sistema_Operativo'];
    $Serial_cargador = $row['Serial_cargador'];
    $Dominio = $row['Dominio'];
    $Tipo_usuario = $row['Tipo_usuario'];

   
// Consulta SQL para inserción (ejemplo)
$consultaSQLInsert = "INSERT INTO [ControlTIC].[dbo].[historial_computador] (Sede, Empresa, Memoria_ram, Tipo_discoduro, Capacidad_discoduro, Sistema_Operativo, Serial_cargador, Dominio, Tipo_usuario, id,tipo_maquina, Service_tag, Serial_equipo, Nombre_equipo, Marca_computador, Modelo_computador, Tipo_comp, Tipo_ram, Procesador, Propietario, Proveedor, Serial_activo_fijo, Fecha_ingreso_c, Targeta_Video, Estado, Gestion,observaciones_mantenimiento_c,fechamov,descripcionmov,usuamov) 
VALUES ('$Sede', '$Empresa', '$Memoria_ram', '$Tipo_discoduro', '$Capacidad_discoduro', '$Sistema_Operativo', '$Serial_cargador', '$Dominio', '$Tipo_usuario', '$id','$tipo_maquina' ,'$Service_tag', '$Serial_equipo', '$Nombre_equipo', '$Marca_computador', '$Modelo_computador', '$Tipo_comp', '$Tipo_ram', '$Procesador', '$Propietario', '$Proveedor', '$Serial_activo_fijo', '$Fecha_ingreso_c', '$Targeta_Video', '$Estado', '$Gestion','$observaciones_mantenimiento_c', CONVERT(datetime, Getdate(), 120),'SE REALIZO MANTENIMIENTO CORRECTIVO','$usuario')";


    // ...
} else {
    // Manejo de error si la consulta SELECT falla
    $errorInfoSelect = odbc_errormsg($conexion);
    $response = array('success' => false, 'message' => 'Error en la consulta SELECT: ' . $errorInfoSelect);
    echo json_encode($response);
    // Puedes elegir cómo manejar el error en tu aplicación
}


// Ejecutar ambas consultas SQL
$resultadoUpdate = odbc_exec($conexion, $consultaSQLUpdate);
$resultadoInsert = odbc_exec($conexion, $consultaSQLInsert);

// Verificar si ambas consultas se ejecutaron correctamente
if ($resultadoUpdate && $resultadoInsert) {
    $response = array('success' => true, 'message' => 'Operaciones exitosas');
} else {
    $errorInfoUpdate = odbc_errormsg($conexion);
    $errorInfoInsert = odbc_errormsg($conexion);
    $response = array('success' => false, 'message' => 'Error en una o más operaciones: Actualización - ' . $errorInfoUpdate . ' Inserción - ' . $errorInfoInsert);
}

// Devolver una respuesta al cliente (en formato JSON)
echo json_encode($response);
