<?php
include '../../../conexionbd.php';

if (
    isset($_POST['capacidad_discoduro']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $capacidad_discoduro = $_POST['capacidad_discoduro'];
    $id = $_POST['id'];

    // Verificar si el valor ya existe en la tabla
    $queryVerificar = "SELECT COUNT(*) AS existe FROM [ControlTIC].[dbo].[capacidad_discoduro] WHERE capacidad_discoduro = '$capacidad_discoduro'";
    $resultVerificar = odbc_exec($conexion, $queryVerificar);

    if ($resultVerificar) {
        $row = odbc_fetch_array($resultVerificar);
        $existe = $row['existe'];

        if ($existe > 0) {
            echo "El valor '$capacidad_discoduro' ya existe en la base de datos.";
        } else {
            // INSERTAR DATOS A LA TABLA capacidad_discoduro
            $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[capacidad_discoduro] (capacidad_discoduro) VALUES ('$capacidad_discoduro')";

            // Ahora se procede a insertar en la tabla 'capacidad_discoduro'
            $resultHistorial = odbc_exec($conexion, $queryHistorial);

            if ($resultHistorial) {
                echo "Inserción exitosa en la tabla capacidad_discoduro";
            } else {
                echo "Error en la inserción en la tabla capacidad_discoduro: " . odbc_errormsg();
            }
        }
    } else {
        echo "Error al verificar la existencia del valor: " . odbc_errormsg();
    }
}
?>
