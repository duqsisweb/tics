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
// Recibir más campos según sea necesario

$Nombre_equipo = $_POST['Nombre_equipo'];
$Usua_modifica = $_POST['Usua_modifica'];
$Service_tag = $_POST['Service_tag'];
$Serial_equipo = $_POST['Serial_equipo'];
$tipo_maquina = $_POST['tipo_maquina'];
$Marca_computador = $_POST['Marca_computador'];
$Modelo_computador = $_POST['Modelo_computador'];
$Tipo_comp = $_POST['Tipo_comp'];
$Tipo_ram = $_POST['Tipo_ram'];
$Procesador = $_POST['Procesador'];
$Propietario = $_POST['Propietario'];
$Proveedor = $_POST['Proveedor'];
$Serial_activo_fijo = $_POST['Serial_activo_fijo'];
$Fecha_ingreso = $_POST['Fecha_ingreso'];
$Targeta_Video = $_POST['Targeta_Video'];
$Estado = $_POST['Estado'];
$Gestion = $_POST['Gestion'];

// Construir la consulta SQL de inserción para la tabla historial_computador
$consultaSQLInsert = "INSERT INTO [ControlTIC].[dbo].[historial_computador] 
(id, Service_tag, Serial_equipo, tipo_maquina, Marca_computador, Modelo_computador, Tipo_comp, Tipo_ram, Procesador, Propietario, Proveedor, Serial_activo_fijo, Fecha_ingreso, Targeta_Video, Estado, Gestion,
Sede, Empresa, Memoria_ram, Tipo_discoduro, Capacidad_discoduro, Sistema_Operativo, Serial_cargador, Dominio, Tipo_usuario, Nombre_equipo, Fecha_modifica, Usua_modifica, observaciones_mantenimiento)
VALUES ('$id','$Service_tag', '$Serial_equipo', '$tipo_maquina', '$Marca_computador', '$Modelo_computador', '$Tipo_comp', '$Tipo_ram', '$Procesador', '$Propietario', '$Proveedor', '$Serial_activo_fijo', '$Fecha_ingreso', '$Targeta_Video',
'$Estado', '$Gestion',
'$Sede', '$Empresa', '$Memoria_ram', '$Tipo_discoduro', '$Capacidad_discoduro', '$Sistema_Operativo', '$Serial_cargador', '$Dominio', '$Tipo_usuario', '$Nombre_equipo', getdate(), '$Usua_modifica', 'SE REALIZO UN MANTENIMIENTO CORRECTIVO' )";

// Construir la consulta SQL de actualización
$consultaSQL = "UPDATE [ControlTIC].[dbo].[maquina_computador] SET 
Sede = '$Sede', 
Empresa = '$Empresa',
Memoria_ram = '$Memoria_ram',
Tipo_discoduro = '$Tipo_discoduro',
Capacidad_discoduro = '$Capacidad_discoduro',
Sistema_Operativo = '$Sistema_Operativo',
Serial_cargador = '$Serial_cargador',
Dominio = '$Dominio',
Tipo_usuario = '$Tipo_usuario'
WHERE id = $id";

// Construir la consulta SQL de actualización
$consultaSQL1 = "UPDATE [ControlTIC].[dbo].[asignacion_computador] SET 
Sede = '$Sede', 
Empresa = '$Empresa',
Memoria_ram = '$Memoria_ram',
Tipo_discoduro = '$Tipo_discoduro',
Capacidad_discoduro = '$Capacidad_discoduro',
Sistema_Operativo = '$Sistema_Operativo',
Serial_cargador = '$Serial_cargador',
Dominio = '$Dominio',
Tipo_usuario = '$Tipo_usuario'
WHERE id = $id";

// Ejecutar la consulta SQL de inserción
$resultadoInsert = odbc_exec($conexion, $consultaSQLInsert);

// Ejecutar la primera consulta SQL de actualización
$resultado1 = odbc_exec($conexion, $consultaSQL);

// Ejecutar la segunda consulta SQL de actualización
$resultado2 = odbc_exec($conexion, $consultaSQL1);

// Verificar si todas las consultas se ejecutaron correctamente
if ($resultadoInsert && $resultado1 && $resultado2) {
    $response = array('success' => true, 'message' => 'Operaciones exitosas');
} else {
    $errorInfoInsert = odbc_errormsg($conexion);
    $errorInfo1 = odbc_errormsg($conexion);
    $errorInfo2 = odbc_errormsg($conexion);
    $response = array('success' => false, 'message' => 'Error en una o más operaciones: ' . $errorInfoInsert . ' ' . $errorInfo1 . ' ' . $errorInfo2);
}

// Devolver una respuesta al cliente (en formato JSON)
echo json_encode($response);

 ?>
   