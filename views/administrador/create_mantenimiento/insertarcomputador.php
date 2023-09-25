<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['service_tag']) && isset($_POST['serial_equipo'])
    && isset($_POST['nombre_equipo']) && isset($_POST['sede']) && isset($_POST['empresa']) && isset($_POST['marca_computador'])
    && isset($_POST['modelo_computador']) && isset($_POST['tipo_comp']) && isset($_POST['tipo_ram']) && isset($_POST['memoria_ram'])
    && isset($_POST['tipo_discoduro']) && isset($_POST['capacidad_discoduro']) && isset($_POST['procesador']) && isset($_POST['propietario'])
    && isset($_POST['proveedor']) && isset($_POST['sistema_operativo']) && isset($_POST['serial_cargador']) && isset($_POST['dominio'])
    && isset($_POST['tipo_usuario']) && isset($_POST['serial_activo_fijo']) && isset($_POST['fecha_ingreso']) && isset($_POST['tarjeta_video'])
    && isset($_POST['estado']) && isset($_POST['gestion']) && isset($_POST['fecha_garantia']) && isset($_POST['fecha_crea'])
    && isset($_POST['usua_crea']) && isset($_POST['fecha_modifica']) && isset($_POST['usua_modifica']) && isset($_POST['primernombre'])
    && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido'])
    && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['Usua_asigna']) && isset($_POST['observaciones_asigna']) && isset($_POST['link_computador_asigna'])

) {

    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];

    $cedula = $_POST['cedula'];
    $cargo = $_POST['cargo'];

    $id = $_POST['id'];
    $tipo_maquina = $_POST['tipo_maquina'];
    $service_tag = $_POST['service_tag'];
    $serial_equipo = $_POST['serial_equipo'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $sede = $_POST['sede'];
    $empresa = $_POST['empresa'];
    $marca_computador = $_POST['marca_computador'];
    $modelo_computador = $_POST['modelo_computador'];
    $tipo_comp = $_POST['tipo_comp'];
    $tipo_ram = $_POST['tipo_ram'];
    $memoria_ram = $_POST['memoria_ram'];
    $tipo_discoduro = $_POST['tipo_discoduro'];
    $capacidad_discoduro = $_POST['capacidad_discoduro'];
    $procesador = $_POST['procesador'];
    $propietario = $_POST['propietario'];
    $proveedor = $_POST['proveedor'];
    $sistema_operativo = $_POST['sistema_operativo'];
    $serial_cargador = $_POST['serial_cargador'];
    $dominio = $_POST['dominio'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $serial_activo_fijo = $_POST['serial_activo_fijo'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $tarjeta_video = $_POST['tarjeta_video'];
    $estado = $_POST['estado'];
    $gestion = $_POST['gestion'];
    $fecha_garantia = $_POST['fecha_garantia'];
    $fecha_crea = $_POST['fecha_crea'];
    $usua_crea = $_POST['usua_crea'];
    $fecha_modifica = $_POST['fecha_modifica'];
    $usua_modifica = $_POST['usua_modifica'];
    $Usua_asigna = $_POST['Usua_asigna'];
    $observaciones_asigna = $_POST['observaciones_asigna'];
    $link_computador_asigna = $_POST['link_computador_asigna'];


    // INSERTAR DATOS A LA TABLA HISTORIAL COMPUTADOR
    $queryHistorial = "INSERT INTO ControlTIC..historial_computador (
                id,  nombre_equipo
            ) VALUES (
                '$id', '$nombre_equipo'
            )";




    // Ejecuta la consulta en la tabla 'historial_computador'
    $resultHistorial = odbc_exec($conexion, $queryHistorial);


    if ($resultHistorial) {
        echo "Inserción exitosa en la tabla historial_computador";
    } else {
        echo "Error en la inserción en la tabla historial_computador: " . odbc_errormsg();
    }
}
