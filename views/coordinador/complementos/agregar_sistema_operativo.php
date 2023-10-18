<?php
include '../../../conexionbd.php';

if (
    isset($_POST['nombre_sistema_operativo']) &&
    isset($_POST['id']) // Agrega una verificación para 'id' si es necesario
) {
    // Recoge los datos de POST
    $nombre_sistema_operativo = $_POST['nombre_sistema_operativo'];
    $id = $_POST['id'];

    // Verificar si el valor ya existe en la tabla
    $queryVerificar = "SELECT COUNT(*) AS existe FROM [ControlTIC].[dbo].[sistema_operativo] WHERE nombre_sistema_operativo = '$nombre_sistema_operativo'";
    $resultVerificar = odbc_exec($conexion, $queryVerificar);

    if ($resultVerificar) {
        $row = odbc_fetch_array($resultVerificar);
        $existe = $row['existe'];

        if ($existe > 0) {
            echo "El valor '$nombre_sistema_operativo' ya existe en la base de datos.";
        } else {
            // INSERTAR DATOS A LA TABLA sistema_operativo
            $queryHistorial = "INSERT INTO [ControlTIC].[dbo].[sistema_operativo] (nombre_sistema_operativo) VALUES ('$nombre_sistema_operativo')";

            // Ahora se procede a insertar en la tabla 'sistema_operativo'
            $resultHistorial = odbc_exec($conexion, $queryHistorial);

            if ($resultHistorial) {
                echo "Inserción exitosa en la tabla sistema_operativo";
            } else {
                echo "Error en la inserción en la tabla sistema_operativo: " . odbc_errormsg();
            }
        }
    } else {
        echo "Error al verificar la existencia del valor: " . odbc_errormsg();
    }
}

?>
