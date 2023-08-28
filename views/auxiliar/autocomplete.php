<?php
include '../../conexionbd.php'; // Asegúrate de incluir la conexión a tu base de datos

$q = $_GET['inputValue']; // Debe coincidir con el nombre del parámetro en la llamada AJAX
$response = array();

if (!empty($q)) {
    $sql = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 AND (NOMBRE LIKE '%$q%' OR APELLIDO LIKE '%$q%')";

    $result = odbc_exec($conexion, $sql);

    while ($row = odbc_fetch_array($result)) {
        $response[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>