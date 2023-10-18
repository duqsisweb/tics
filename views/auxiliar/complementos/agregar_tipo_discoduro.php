<?php
include '../../../conexionbd.php';

if (
    isset($_POST['nombre_tipo_discoduro']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $nombre_tipo_discoduro = $_POST['nombre_tipo_discoduro'];
    $id = $_POST['id'];

    // Verificar si el valor ya existe en la tabla
    $queryVerificar = "SELECT COUNT(*) AS existe FROM [ControlTIC].[dbo].[tipo_discoduro] WHERE nombre_tipo_discoduro = '$nombre_tipo_discoduro'";
    $resultVerificar = odbc_exec($conexion, $queryVerificar);

    if ($resultVerificar) {
        $row = odbc_fetch_array($resultVerificar);
        $existe = $row['existe'];

        if ($existe > 0) {
            echo "El valor '$nombre_tipo_discoduro' ya existe en la base de datos.";
        } else {
            // INSERTAR DATOS A LA TABLA tipo_discoduro
            $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[tipo_discoduro] (nombre_tipo_discoduro) VALUES ('$nombre_tipo_discoduro')";

            // Ahora se procede a insertar en la tabla 'tipo_discoduro'
            $resultHistorial = odbc_exec($conexion, $queryHistorial);

            if ($resultHistorial) {
                echo "Inserción exitosa en la tabla tipo_discoduro";
            } else {
                echo "Error en la inserción en la tabla tipo_discoduro: " . odbc_errormsg();
            }
        }
    } else {
        echo "Error al verificar la existencia del valor: " . odbc_errormsg();
    }
}

?>
