<?php
include '../../../conexionbd.php';
$consulta = "SELECT tipo_maquina, Nombre_equipo, Marca_computador, Memoria_ram, capacidad_discoduro, Procesador FROM [ControlTIC].[dbo].[asignacion_computador]";
$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        $output .= "Actualmente el usuario tiene asignado\n";
        $output .= "-------------------------------------\n";
        $output .= "Nombre del equipo: " . $fila['Nombre_equipo'] . "\n";
        $output .= "Marca del computador: " . $fila['Marca_computador'] . "\n";
        $output .= "Memoria RAM: " . $fila['Memoria_ram'] . "\n";
        $output .= "Capacidad del disco duro: " . $fila['capacidad_discoduro'] . "\n";
        $output .= "Procesador: " . $fila['Procesador'] . "\n";
    }
} else {
    $output .= "-------------------------------------\n";
}

$output .= "-------------------------------------\n";
$output .= "</pre>";

odbc_close($conexion);

echo $output; // Enviar la respuesta al cliente (JavaScript)
