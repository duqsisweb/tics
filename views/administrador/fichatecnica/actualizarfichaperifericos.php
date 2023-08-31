<?php
include '../../../conexionbd.php';
$consulta = "SELECT marca_perifericos, descripcion_perifericos, ubicacion_perifericos, tipo, tipo_toner  FROM ControlTIC..asignacion_perifericos";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "Actualmente el usuario tiene asignado\n";
        $output .= "-------------------------------------\n";
        $output .= "Marca del Equipo: " . $fila['marca_perifericos'] . "\n";
        $output .= "Descripción:" . $fila['descripcion_perifericos'] . "\n";
        $output .= "Ubicación:" . $fila['ubicacion_perifericos'] . "\n";
        $output .= "Tipo:" . $fila['tipo'] . "\n";
        $output .= "Tipo Toner: " . $fila['tipo_toner'] . "\n";
    }
} else {
    $output .= "-------------------------------------\n";
}

$output .= "-------------------------------------\n";
$output .= "</pre>";

odbc_close($conexion);

echo $output; // Enviar la respuesta al cliente (JavaScript)
