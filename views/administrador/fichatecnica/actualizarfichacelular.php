<?php
include '../../../conexionbd.php';
$consulta = "SELECT marca, modelo, capacidad, ram_celular FROM ControlTIC..asignacion_celular";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "Actualmente el usuario tiene asignado\n";
        $output .= "-------------------------------------\n";
        $output .= "Marca del Equipo: " . $fila['marca'] . "\n";
        $output .= "Modelo del Equipo:" . $fila['modelo'] . "\n";
        $output .= "Capacidad" . $fila['capacidad'] . "\n";
        $output .= "Memoria RAM: " . $fila['ram_celular'] . "\n";
    }
} else {
    $output .= "-------------------------------------\n";
}

$output .= "-------------------------------------\n";
$output .= "</pre>";

odbc_close($conexion);

echo $output; // Enviar la respuesta al cliente (JavaScript)
