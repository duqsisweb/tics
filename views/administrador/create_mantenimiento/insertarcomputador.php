<?php
include '../../../conexionbd.php';

if (  

    isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['service_tag']) && isset($_POST['serial_equipo']) && isset($_POST['nombre_equipo']) &&
    isset($_POST['sede']) && isset($_POST['empresa']) && isset($_POST['marca_computador']) && isset($_POST['modelo_computador']) &&
    isset($_POST['tipo_comp']) && isset($_POST['tipo_ram']) && isset($_POST['memoria_ram']) && isset($_POST['tipo_discoduro']) && isset($_POST['capacidad_discoduro']) &&
    isset($_POST['procesador']) && isset($_POST['propietario']) && isset($_POST['proveedor']) && isset($_POST['sistema_operativo']) && isset($_POST['serial_cargador']) &&
    isset($_POST['dominio']) && isset($_POST['tipo_usuario']) && isset($_POST['serial_activo_fijo']) && isset($_POST['fecha_ingreso']) && isset($_POST['targeta_video']) && 
    isset($_POST['estado']) && isset($_POST['gestion']) && isset($_POST['fecha_garantia']) &&

    isset($_POST['Usua_mantenimiento']) && isset($_POST['observaciones_mantenimiento']) && isset($_POST['Fecha_mantenimiento_inicio']) &&  isset($_POST['Fecha_mantenimiento_fin']) 
    
    )   {


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
    $targeta_video = $_POST['targeta_video'];
    $estado = $_POST['estado'];
    $gestion = $_POST['gestion'];
    $fecha_garantia = $_POST['fecha_garantia'];
    



    // campos de mantenimiento
    $Usua_mantenimiento = $_POST['Usua_mantenimiento'];
    $observaciones_mantenimiento = $_POST['observaciones_mantenimiento'];
    $Fecha_mantenimiento_inicio = $_POST['Fecha_mantenimiento_inicio'];
    $Fecha_mantenimiento_fin = $_POST['Fecha_mantenimiento_fin'];
    

    // INSERTAR DATOS A LA TABLA HISTORIAL COMPUTADOR
    $queryHistorial = "INSERT INTO ControlTIC..historial_computador (
                id,tipo_maquina,service_tag,serial_equipo,nombre_equipo,sede,empresa,marca_computador,modelo_computador,
                tipo_comp,tipo_ram,memoria_ram,tipo_discoduro,capacidad_discoduro,procesador,propietario,proveedor,sistema_operativo,
                serial_cargador,dominio,tipo_usuario,serial_activo_fijo,fecha_ingreso,targeta_video,estado,gestion,fecha_garantia,
                Usua_mantenimiento,observaciones_mantenimiento,Fecha_mantenimiento_inicio,Fecha_mantenimiento_fin
            ) VALUES (
                '$id','$tipo_maquina', '$service_tag', '$serial_equipo', '$nombre_equipo', '$sede', '$empresa', '$marca_computador', '$modelo_computador',
                '$tipo_comp', '$tipo_ram','$memoria_ram','$tipo_discoduro', '$capacidad_discoduro','$procesador','$propietario','$proveedor','$sistema_operativo',
                '$serial_cargador','$dominio','$tipo_usuario','$serial_activo_fijo','$fecha_ingreso','$targeta_video','$estado','$gestion','$fecha_garantia',
                '$Usua_mantenimiento','$observaciones_mantenimiento','$Fecha_mantenimiento_inicio','$Fecha_mantenimiento_fin'
            )";

            
            // Ahora se procede a insertar en la tabla 'historial_computador'
            $resultHistorial = odbc_exec($conexion, $queryHistorial);
            
            if ($resultHistorial) {
                echo "Inserción exitosa en la tabla historial_computador";
            } else {
                echo "Error en la inserción en la tabla historial_computador: " . odbc_errormsg();
            }
       
    }