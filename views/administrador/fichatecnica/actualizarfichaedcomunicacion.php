<?php
include '../../../conexionbd.php';
$consulta = "SELECT marca_edcomunicacion, modelo_edcomunicacion, observaciones_edcomunicacion, ubicacion_edcomunicacion FROM ControlTIC..asignacion_edcomunicacion";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "Actualmente el usuario tiene asignado\n";
        $output .= "-------------------------------------\n";
        $output .= "Marca del Equipo: " . $fila['marca_edcomunicacion'] . "\n";
        $output .= "Modelo del Equipo:" . $fila['modelo_edcomunicacion'] . "\n";
        $output .= "Observaciones:" . $fila['observaciones_edcomunicacion'] . "\n";
        $output .= "Ubicación: " . $fila['ubicacion_edcomunicacion'] . "\n";
    }
} else {
    $output .= "-------------------------------------\n";
}

$output .= "-------------------------------------\n";
$output .= "</pre>";

odbc_close($conexion);

echo $output; // Enviar la respuesta al cliente (JavaScript)
