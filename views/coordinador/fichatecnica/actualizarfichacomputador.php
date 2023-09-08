<?php
include '../../../conexionbd.php';

$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

$consulta = "SELECT [id] ,[tipo_maquina] ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,[Sede] ,[Empresa] ,[Marca_computador] ,[Modelo_computador] ,[Tipo_comp] ,[Tipo_ram] ,[Memoria_ram] ,[Tipo_discoduro] ,[Capacidad_discoduro] ,[Procesador] ,[Propietario] ,[Proveedor] ,[Sistema_Operativo] ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso] ,[Targeta_Video] ,[Estado] ,[Gestion] ,[Fecha_garantia] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] ,[Usua_asigna] ,[Fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] FROM [ControlTIC].[dbo].[asignacion_computador] WHERE cedula = '$cedula'";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>";

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "-------------------------------------\n";
        $output .= "Nombre del equipo: " . $fila['Nombre_equipo'] . "\n";
        $output .= "Marca del computador: " . $fila['Marca_computador'] . "\n";
        $output .= "Memoria RAM: " . $fila['Memoria_ram'] . "\n";
        $output .= "Capacidad del disco duro: " . $fila['Capacidad_discoduro'] . "\n";
        $output .= "Procesador: " . $fila['Procesador'] . "\n";
        $output .= "-------------------------------------\n";
    }
} else {
    $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de COMPUTADOR</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

$output .= "</pre>";

odbc_close($conexion);

echo $output;
?>
