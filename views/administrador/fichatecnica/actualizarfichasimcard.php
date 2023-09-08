<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX
$consulta = "SELECT numero_linea, nombre_plan FROM ControlTIC..asignacion_simcard  WHERE cedula = '$cedula'";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "-------------------------------------\n";
        $output .= "Número de la linea: " . $fila['numero_linea'] . "\n";
        $output .= "Nombre Plan: " . $fila['nombre_plan'] . "\n";
        $output .= "-------------------------------------\n";

    }
} else {
    $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de SIM CARD</strong> 
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
        document.getElementById('alertsimcard').style.display = 'none';
    }, 9000); // 3000 milisegundos = 3 segundos
</script>
