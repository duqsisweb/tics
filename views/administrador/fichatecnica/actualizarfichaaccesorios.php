<?php
include '../../../conexionbd.php';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

$consulta = "SELECT [id_asignacion]
            ,[id]
            ,[tipo_maquina]
            ,[marca]
            ,[modelo]
            ,[descripcion]
            ,[tipo_acc]
            ,[cantidad]
            ,[fecha_de_ingreso_acc]
            ,[fecha_crea]
            ,[usua_crea]
            ,[cedula]
            ,[cargo]
            ,[primernombre]
            ,[segundonombre]
            ,[primerapellido]
            ,[segundoapellido]
            ,[empresa]
            ,[observaciones_asigna_acc]
            ,[link_acc_asigna]
            ,[observaciones_desasigna_acc]
            ,[link_acc_desasigna]
            ,[fechamov]
            ,[descripcionmov]
            ,[usuamov]
            ,[estado_asignacion]
            ,[estado]
            ,[gestion]
    FROM [ControlTIC].[dbo].[asignacion_accesorios] WHERE cedula = '$cedula' and estado_asignacion = 'VIGENTE' ";

$resultado = odbc_exec($conexion, $consulta);

$output = "<pre>"; // Mantener el formato monoespaciado

if (odbc_num_rows($resultado) > 0) {
    while ($fila = odbc_fetch_array($resultado)) {
        
        $output .= "-------------------------------------\n";
        $output .= "Tipo : " . $fila['tipo_acc'] . "\n";
        $output .= "Marca : " . $fila['marca'] . "\n";
        $output .= "Modelo:" . $fila['modelo'] . "\n";
        $output .= "Descripcion: " . $fila['descripcion'] . "\n";

        $output .= "-------------------------------------\n";
    }
} else {
    $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de ACCESORIOS</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

$output .= "</pre>";

odbc_close($conexion);

echo $output; // Enviar la respuesta al cliente (JavaScript)


?>
<script>
    // Función para cerrar la alerta después de 3 segundos
    setTimeout(function() {
        document.getElementById('alertcelular').style.display = 'none';
    }, 4000); // 3000 milisegundos = 3 segundos
</script>

