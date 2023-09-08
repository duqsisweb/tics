<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

$consulta = "SELECT marca_almacenamiento, modelo_almacenamiento FROM ControlTIC..asignacion_almacenamiento WHERE cedula = '$cedula'";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "-------------------------------------\n";
        $output .= "Marca: " . $fila['marca_almacenamiento'] . "\n";
        $output .= "Modelo: " . $fila['modelo_almacenamiento'] . "\n";
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

