<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

$consulta = " SELECT  [id_asignacion]
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
            FROM [ControlTIC].[dbo].[asignacion_edcomunicacion] where cedula = '$cedula' and estado_asignacion = 'VIGENTE'";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "-------------------------------------\n";
        $output .= "Marca del Equipo: " . $fila['marca_edcomunicacion'] . "\n";
        $output .= "Modelo del Equipo:" . $fila['modelo_edcomunicacion'] . "\n";
        $output .= "Observaciones:" . $fila['observaciones_edcomunicacion'] . "\n";
        $output .= "Ubicación: " . $fila['ubicacion_edcomunicacion'] . "\n";
        $output .= "Serial: " . $fila['serial_edcomunicacion'] . "\n";
        $output .= "-------------------------------------\n";
    }
} else {
    $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de ED COMUNICACIÓN</strong> 
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
        document.getElementById('alertedcomunicacion').style.display = 'none';
    }, 6000); // 3000 milisegundos = 3 segundos
</script>
