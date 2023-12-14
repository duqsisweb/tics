
<?php

$usuario1 = "m";
$clave1 = "Duquesa2008";

$usuario2 = "PalmaWeb";
$clave2 = "BogotaCalle100";

// Primera conexión a la base de datos
if (!$conexion = odbc_connect('DRIVER={SQL Server};SERVER=192.168.10.1;DATABASE=CONTROL_OFIMAEnterprise', $usuario1, $clave1)) {
    die('Error al conectarse a la primera base de datos');
}

// Segunda conexión a la base de datos
if (!$conexion2 = odbc_connect('DRIVER={SQL Server};SERVER=192.168.1.245;DATABASE=CONTROL_OFIMAEnterprise', $usuario2, $clave2)) {
    die('Error al conectarse a la segunda base de datos');
}

?>
