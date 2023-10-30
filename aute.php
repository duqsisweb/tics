<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(0);

if ($_POST['iniciar']) {
    header("Cache-control: private");
    include("./conexionbd.php");
    $usuario1 = utf8_decode($_POST['usuario']);
    $usuario = rtrim($usuario1);
    $password = rtrim($_POST['password']);
    $typeUser = $_POST['typeUser'];

    $resul = odbc_exec($conexion, " SELECT MV.NOMBRE, RTRIM(MV.CODUSUARIO) AS CODUSUARIO, RTRIM(MV.PASSWORD) AS CLAVE 
    FROM CONTROL_OFIMAEnterprise..MTUSUARIO AS MV 
    WHERE (MV.CODUSUARIO = '$usuario' AND MV.CODUSUARIO IN 
    ('YFGONZALEZ','COORDSISTEMAS','YALONSO','DORTEGA','ANALISTAV','AROBAYO')) AND MV.PASSWORD = '$password'") or die(exit("Error al ejecutar consulta"));

    $Nombre = odbc_result($resul, 'NOMBRE');
    $usua = rtrim(odbc_result($resul, 'CODUSUARIO'));
    $pass = rtrim(odbc_result($resul, 'CLAVE'));

    $usua = strtoupper($usua);
    $usuario = strtoupper($usuario);

    if ($usua == $usuario && $pass == $password) {
        session_start();
        $_SESSION['usuario'] = $usua;
        $_SESSION['NOMBRE'] = $Nombre;
        $_SESSION['CEDULA'] = $Nombre;
        $_SESSION['CARGO'] = $Nombre;

        // Redireccionar a diferentes vistas según el perfil del usuario
        switch ($usua) {
            case 'YFGONZALEZ':
            case 'AROBAYO':
            case 'ANALISTAV':
            case 'DORTEGA':
                header("Location: views/administrador/inicio_administrador.php");
                break;
            case 'COORDSISTEMAS':
                header("Location: views/coordinador/inicio_coordinador.php");
                break;
            case 'YALONSO':
                header("Location: views/auxiliar/inicio_auxiliar.php");
                break;
            default:
                // En caso de que el usuario no tenga un perfil definido, redireccionar a una página de error o login.
                header("Location: login.php");
                break;
        }
        exit();
    } else {
        ?>
        <script>
            alert("Credenciales incorrectas");
            window.location.href="login.php"; 
        </script>
        <?php
    }
} else { 
    ?>
    <script>
        alert("Ingreso Erroneo");
        window.location.href="login.php"; 
    </script>
    <?php
}
?>
