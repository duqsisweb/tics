<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

$consulta = "SELECT marca_edcomunicacion, modelo_edcomunicacion, observaciones_edcomunicacion, ubicacion_edcomunicacion, serial_edcomunicacion FROM ControlTIC..asignacion_edcomunicacion WHERE cedula = '$cedula'";
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
