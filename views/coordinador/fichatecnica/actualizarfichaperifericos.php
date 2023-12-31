<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX
$consulta = "SELECT marca_perifericos, descripcion_perifericos, ubicacion_perifericos, tipo, tipo_toner  FROM ControlTIC..asignacion_perifericos WHERE cedula = '$cedula' and estado_asignacion = 'VIGENTE' ";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "-------------------------------------\n";
        $output .= "Marca del Equipo: " . $fila['marca_perifericos'] . "\n";
        $output .= "Descripción:" . $fila['descripcion_perifericos'] . "\n";
        $output .= "Ubicación:" . $fila['ubicacion_perifericos'] . "\n";
        $output .= "Tipo:" . $fila['tipo'] . "\n";
        $output .= "Tipo Toner: " . $fila['tipo_toner'] . "\n";
        $output .= "-------------------------------------\n";
    }
} else {
    $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de PERIFERICOS</strong> 
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
        document.getElementById('alertperifericos').style.display = 'none';
    }, 7000); // 3000 milisegundos = 3 segundos
</script>
