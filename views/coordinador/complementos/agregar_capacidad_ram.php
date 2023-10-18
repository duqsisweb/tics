<?php
include '../../../conexionbd.php';

if (
    isset($_POST['capacidad_ram']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $capacidadRam = $_POST['capacidad_ram'];
    $id = $_POST['id'];

    // Verificar si el valor ya existe en la tabla
    $queryVerificar = "SELECT COUNT(*) AS existe FROM [ControlTIC].[dbo].[capacidad_ram] WHERE capacidad_ram = '$capacidadRam'";
    $resultVerificar = odbc_exec($conexion, $queryVerificar);

    if ($resultVerificar) {
        $row = odbc_fetch_array($resultVerificar);
        $existe = $row['existe'];

        if ($existe > 0) {
            echo "El valor '$capacidadRam' ya existe en la base de datos.";
        } else {
            // INSERTAR DATOS A LA TABLA capacidad_ram
            $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[capacidad_ram] (capacidad_ram) VALUES ('$capacidadRam')";

            // Ahora se procede a insertar en la tabla 'capacidad_ram'
            $resultHistorial = odbc_exec($conexion, $queryHistorial);

            if ($resultHistorial) {
                echo "Inserción exitosa en la tabla capacidad_memoria_ram";
            } else {
                echo "Error en la inserción en la tabla capacidad_memoria_ram: " . odbc_errormsg();
            }
        }
    } else {
        echo "Error al verificar la existencia del valor: " . odbc_errormsg();
    }
}

?>