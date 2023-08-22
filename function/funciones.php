<?php
header('Content-Type: text/html; charset=UTF-8');

class funciones
{
    // ... tu código de funciones aquí ...

    public static function consultarequiposstock($tipocomputador)
    {
        include '../../conexionbd.php';
        $data = odbc_exec($conexion, "SELECT * FROM [ControlTIC].[dbo].[maquina_computador] where tipo = '$tipocomputador'");
        $arr = array(); 
        while ($Element = odbc_fetch_array($data)) {
            $arr[] = $Element;
        }
        return $arr;
    }
}



?>
