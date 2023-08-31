<?php
include '../../../conexion_duquesa.php';
// ... otras inclusiones

if (isset($_POST['empresa'])) {
    $empresa = $_POST['empresa'];
    
    if ($empresa === '1') {
        // Consulta para Duquesa S.A. BIC
        $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
        $result = odbc_exec($conexion, $query);
    } elseif ($empresa === '2') {
        // Consulta para Palmeras del Llano S.A. BIC
        $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM PALMERAS2013..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
        $result = odbc_exec($conexion2, $query);
    } elseif ($empresa === '3') {
        // Consulta para J25
        $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM J25..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
        $result = odbc_exec($conexion2, $query);
    }

    // Resto del código para generar las opciones
}
?>