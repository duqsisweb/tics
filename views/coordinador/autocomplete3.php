<?php
include '../../conexionbd.php'; // Asegúrate de incluir la conexión a tu base de datos

$searchText = $_POST['searchText']; // Cambia a $_POST en lugar de $_GET
$response = array();

if (!empty($searchText)) {
    // Ajusta la consulta según tus necesidades
    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM $empresa..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 AND (NOMBRE LIKE '%$searchText%' OR NOMBRE2 LIKE '%$searchText%' OR APELLIDO LIKE '%$searchText%' OR APELLIDO2 LIKE '%$searchText%')";

    $result = odbc_exec($conexion, $query);

    while ($row = odbc_fetch_array($result)) {
        $response[] = $row;
    }
}

if (!empty($response)) {
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array('error' => 'No se encontraron resultados'));
}
?>