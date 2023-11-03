<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

$consulta = " SELECT  [id_asignacion]
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
            ,[fecha_de_ingreso]
            ,[estado]
            ,[fecha_de_garantia]
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
            FROM [ControlTIC].[dbo].[asignacion_almacenamiento] where cedula = '$cedula' and estado_asignacion = 'VIGENTE' ";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "-------------------------------------\n";
        $output .= "Marca: " . $fila['marca_almacenamiento'] . "\n";
        $output .= "Modelo: " . $fila['modelo_almacenamiento'] . "\n";
        $output .= "Descripción: " . $fila['descripcion_almacenamiento'] . "\n";
        $output .= "Capacidad: " . $fila['caracteristica_almacenamiento'] . "\n";
        $output .= "-------------------------------------\n";

    }
} else {
    $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion Disp ALMACENAMIENTO</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

$output .= "</pre>";

odbc_close($conexion);

echo $output; // Enviar la respuesta al cliente (JavaScript)

?>
<script>
    // Función para cerrar la alerta después de 3 segundos
    setTimeout(function() {
        document.getElementById('alert').style.display = 'none';
    }, 8000); // 3000 milisegundos = 3 segundos
</script>

