<?php
include '../../../conexionbd.php';

if (isset($_POST['id']) && isset($_POST['tipo_maquina']) && isset($_POST['service_tag']) && isset($_POST['serial_equipo'])
    && isset($_POST['nombre_equipo']) && isset($_POST['sede']) && isset($_POST['empresa']) && isset($_POST['marca_computador'])
    && isset($_POST['modelo_computador']) && isset($_POST['tipo_comp']) && isset($_POST['tipo_memoria_ram']) && isset($_POST['capacidad_ram'])
    && isset($_POST['tipo_discoduro']) && isset($_POST['capacidad_discoduro']) && isset($_POST['procesador']) && isset($_POST['propietario'])
    && isset($_POST['proveedor']) && isset($_POST['sistema_operativo']) && isset($_POST['serial_cargador']) && isset($_POST['dominio'])
    && isset($_POST['tipo_usuario']) && isset($_POST['serial_activo_fijo']) && isset($_POST['Fecha_ingreso_c']) && isset($_POST['tarjeta_video'])
    && isset($_POST['estado']) && isset($_POST['gestion']) && isset($_POST['Fecha_garantia_c']) && isset($_POST['primernombre'])  
    && isset($_POST['segundonombre']) && isset($_POST['primerapellido']) && isset($_POST['segundoapellido']) 
    && isset($_POST['cedula']) && isset($_POST['cargo']) && isset($_POST['Usua_asigna']) && isset($_POST['observaciones_asigna'])
    && isset($_POST['link_computador_asigna'])
    
    )   
    
    // se Agrega esto para mostrar los datos en la consola del navegador
    echo "<script>";
    echo "console.log(" . json_encode($_POST) . ");";
    echo "</script>";
    {
    
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
    $tipo_memoria_ram = $_POST['tipo_memoria_ram'];
    $capacidad_ram = $_POST['capacidad_ram'];
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
    $Fecha_ingreso_c = $_POST['Fecha_ingreso_c'];
    $tarjeta_video = $_POST['tarjeta_video'];
    $estado = $_POST['estado'];
    $gestion = $_POST['gestion'];
    $Fecha_garantia_c = $_POST['Fecha_garantia_c'];

    $Usua_asigna = $_POST['Usua_asigna'];
    $observaciones_asigna = $_POST['observaciones_asigna'];
    $link_computador_asigna = $_POST['link_computador_asigna'];
    
      // INSERTAR DATOS A LA TABLA ASIGNACION
      $queryAsignacion = "INSERT INTO ControlTIC..asignacion_computador (
        id, tipo_maquina, Service_tag, Serial_equipo, Nombre_equipo, Sede, Empresa,
        Marca_computador, Modelo_computador, Tipo_comp, Tipo_ram, Memoria_ram,
        Tipo_discoduro, Capacidad_discoduro, Procesador, Propietario, Proveedor,
        Sistema_Operativo, Serial_cargador, Dominio, Tipo_usuario, Serial_activo_fijo,
        Fecha_ingreso_c, Targeta_Video, Estado, Gestion, Fecha_garantia_c, 
        primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, Usua_asigna, Fecha_asigna, observaciones_asigna, link_computador_asigna
    ) VALUES (
        '$id', '$tipo_maquina', '$service_tag', '$serial_equipo', '$nombre_equipo', '$sede', '$empresa',
        '$marca_computador', '$modelo_computador', '$tipo_comp', '$tipo_memoria_ram', '$capacidad_ram',
        '$tipo_discoduro', '$capacidad_discoduro', '$procesador', '$propietario', '$proveedor',
        '$sistema_operativo', '$serial_cargador', '$dominio', '$tipo_usuario', '$serial_activo_fijo',
        '$Fecha_ingreso_c', '$tarjeta_video', 'ASIGNADO', 'ASIGNACION', '$Fecha_garantia_c', 
        '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido','$cedula', '$cargo', '$Usua_asigna',  getdate(), '$observaciones_asigna', '$link_computador_asigna'
    )";

    // INSERTAR DATOS A LA TABLA HISTORIAL COMPUTADOR
    $queryHistorial = "INSERT INTO ControlTIC..historial_computador (
                id, tipo_maquina, Service_tag, Serial_equipo, Nombre_equipo, Sede, Empresa,
                Marca_computador, Modelo_computador, Tipo_comp, Tipo_ram, Memoria_ram,
                Tipo_discoduro, Capacidad_discoduro, Procesador, Propietario, Proveedor,
                Sistema_Operativo, Serial_cargador, Dominio, Tipo_usuario, Serial_activo_fijo,
                Fecha_ingreso_c, Targeta_Video, Estado, Gestion, Fecha_garantia_c,
                primernombre, segundonombre, primerapellido, segundoapellido, cedula, cargo, observaciones_asigna, link_computador_asigna,fechamov,descripcionmov,usuamov
            ) VALUES (
                '$id', '$tipo_maquina', '$service_tag', '$serial_equipo', '$nombre_equipo', '$sede', '$empresa',
                '$marca_computador', '$modelo_computador', '$tipo_comp', '$tipo_memoria_ram', '$capacidad_ram',
                '$tipo_discoduro', '$capacidad_discoduro', '$procesador', '$propietario', '$proveedor',
                '$sistema_operativo', '$serial_cargador', '$dominio', '$tipo_usuario', '$serial_activo_fijo',
                '$Fecha_ingreso_c', '$tarjeta_video', 'ASIGNADO', 'ASIGNACION', '$Fecha_garantia_c', 
                '$primernombre', '$segundonombre', '$primerapellido', '$segundoapellido','$cedula', '$cargo', '$observaciones_asigna', '$link_computador_asigna',CONVERT(datetime, Getdate(), 120),'SE REALIZO ASIGNAMIENTO DE COMPUTADOR','$Usua_asigna')";



var_dump($_POST);

        // Ejecuta la consulta en la tabla 'asignacion_computador'
        $resultAsignacion = odbc_exec($conexion, $queryAsignacion);


        if ($resultAsignacion) {
            echo "Inserción exitosa en la tabla asignacion_computador<br>";
            
            // Ahora se procede a insertar en la tabla 'historial_computador'
            $resultHistorial = odbc_exec($conexion, $queryHistorial);
            
            if ($resultHistorial) {
                echo "Inserción exitosa en la tabla historial_computador";
            } else {
                echo "Error en la inserción en la tabla historial_computador: " . odbc_errormsg();
            }
        } else {
            echo "Error en la inserción en la tabla asignacion_computador: " . odbc_errormsg();
        }
    }
