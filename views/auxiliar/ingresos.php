<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
error_reporting(0);

include '../../conexionbd.php';
if (isset($_SESSION['usuario'])) {

    require '../../function/funciones.php';
    ?>

        <!DOCTYPE html>
        <html lang="en">



        <!-- PARTE DEL HEAD -->
        <?php
        require '../../views/head.php';
        ?>


        <body>


            <!-- PARTE DEL NAV -->
            <?php
            require '../../views/nav.php';
            ?>

            <section style="margin-top: 100px;">

                <!-- NAVINGRESOS -->
                <?php require '../../views/navinventario.php'; ?>


                <!-- inicio de POST enviarComputador -->
                <?php
                if (isset($_POST['enviarComputador'])) {
                    $tipomaquina = $_POST['tipo_maquina'];
                    $service_tag = $_POST['Service_tag'];
                    $serial = $_POST['Serial_equipo'];
                    $nombre_equipo = $_POST['Nombre_equipo'];
                    $sede = $_POST['Sede'];
                    $Empresa = $_POST['Empresa_computador'];
                    $marca_computador = $_POST['Marca_computador'];
                    $modelo_computador = $_POST['Modelo_computador'];
                    $tipo_comp = $_POST['Tipo_comp'];
                    $tipo_ram = $_POST['Tipo_ram'];
                    $cant_memoria_ram = $_POST['Memoria_ram'];
                    $tipo_discoduro = $_POST['Tipo_discoduro'];
                    $capacidad_discoduro = $_POST['Capacidad_discoduro'];
                    $procesador = $_POST['Procesador'];
                    $propietario = $_POST['Propietario'];
                    $proveedor = $_POST['Proveedor'];
                    $sistema_operativo = $_POST['Sistema_Operativo'];
                    $serial_cargador = $_POST['Serial_cargador'];
                    $dominio = $_POST['Dominio'];
                    $tipo_usuario = $_POST['Tipo_usuario'];
                    $serial_activo_fijo = $_POST['Serial_activo_fijo'];
                    $fecha_ingreso_c = $_POST['Fecha_ingreso_c'];
                    $fecha_ingreso_c = date('Y-m-d', strtotime($fecha_ingreso_c));
                    $targeta_video = $_POST['Targeta_Video'];
                    $estado = $_POST['Estado'];
                    $Fecha_garantia_c = $_POST['Fecha_garantia_c'];
                    $Fecha_garantia_c = date('Y-m-d', strtotime($Fecha_garantia_c));

                    $usuario = $_SESSION['usuario'];
                    $Gestion = $_POST['Gestion'];

                    // Obtener la fecha actual
                    $fechaActual = new DateTime();
                    // Sumar 6 meses a la fecha actual
                    $fechaMantenimientoInicio = $fechaActual->modify('+6 months');
                    // Formatear la fecha como una cadena
                    $fechaMantenimientoInicioStr = $fechaMantenimientoInicio->format('Y-m-d');
                    // Imprimir la fecha de mantenimiento
                    "Fecha de Mantenimiento: " . $fechaMantenimientoInicioStr;


                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_computador] (tipo_maquina ,Service_tag ,Serial_equipo ,Nombre_equipo ,Sede ,Empresa ,Marca_computador ,Modelo_computador ,Tipo_comp ,Tipo_ram ,Memoria_ram ,Tipo_discoduro ,Capacidad_discoduro ,Procesador ,Propietario ,Proveedor ,Sistema_Operativo ,Serial_cargador ,Dominio ,Tipo_usuario ,Serial_activo_fijo ,Fecha_ingreso_c ,Targeta_Video ,Estado ,Gestion ,Fecha_garantia_c ,Fecha_mantenimiento_inicio ,Fecha_mantenimiento_fin,descripcionmov,usuamov ,fechamov) VALUES 
                ('$tipomaquina' ,'$service_tag' ,'$serial' ,'$nombre_equipo' ,'$sede' ,'$Empresa' ,'$marca_computador' ,'$modelo_computador' ,'$tipo_comp' ,'$tipo_ram' ,'$cant_memoria_ram' ,'$tipo_discoduro' ,'$capacidad_discoduro' ,'$procesador' ,'$propietario' ,'$proveedor' ,'$sistema_operativo' ,'$serial_cargador' ,'$dominio' ,'$tipo_usuario' ,'$serial_activo_fijo' ,'$fecha_ingreso_c' ,'$targeta_video' ,'$estado' ,'3' ,'$Fecha_garantia_c' ,Getdate(),'$fechaMantenimientoInicioStr','SE INGRESO AL STOCK O INVENTARIO UN COMPUTADOR','$usuario' ,Getdate() )");


                }

                ?>

                <!-- inicio de POST enviarCelular -->
                <?php
                if (isset($_POST['enviarCelular'])) {
                    // $tipomaquina = $_POST['tipo_maquina'];
                    $imei = $_POST['Imei'];
                    $serial_equipo_celular = $_POST['Serial_equipo_celular'];
                    $marca = $_POST['Marca'];
                    $modelo = $_POST['Modelo'];
                    $fecha_ingreso_cel = $_POST['Fecha_ingreso_cel'];
                    $capacidad = $_POST['Capacidad'];
                    $ram_celular = $_POST['Ram_celular'];
                    $estado = $_POST['Estado'];
                    $gestion = $_POST['Gestion'];
                    $Fecha_garantia_cel = $_POST['Fecha_garantia_cel'];
                    $usuario = $_SESSION['usuario'];


                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_celular]
                                                  (tipo_maquina,Imei,Serial_equipo_celular,Marca,Modelo,Fecha_ingreso_cel,Capacidad,Ram_celular,Estado,Gestion,Fecha_garantia_cel,usuamov,fechamov,descripcionmov) 
                                                  VALUES
                                                  ('2','$imei','$serial_equipo_celular','$marca','$modelo','$fecha_ingreso_cel','$capacidad'+'GB',
                                                    '$ram_celular'+'GB','$estado','$gestion','$Fecha_garantia_cel','$usuario',getdate(),'SE INGRESO UN CELULAR AL STOCK O INVENTARIO' )");
                }
                ?>
                <!-- inicio de POST enviarAccesorios -->
                <?php
                if (isset($_POST['enviarAccesorios'])) {
                    $tipomaquina = $_POST['tipo_maquina'];
                    $marca = $_POST['marca'];
                    $modelo = $_POST['modelo'];
                    $descripcion = $_POST['descripcion'];
                    $tipo_acc = $_POST['tipo_acc'];
                    $cantidad = $_POST['cantidad'];
                    $fecha_de_ingreso_acc = $_POST['fecha_de_ingreso_acc'];
                    // Asegúrate de que $fecha_ingreso sea una fecha válida en el formato "AAAA-MM-DD"
                    $fecha_de_ingreso_acc = date('Y-m-d', strtotime($fecha_de_ingreso_acc));
                    $usuario = $_SESSION['usuario'];

                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_accesorios]
                                                  (tipo_maquina,marca,modelo,descripcion,tipo_acc,cantidad,fecha_de_ingreso_acc,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$marca','$modelo','$descripcion','$tipo_acc',
                                                    '$cantidad','$fecha_de_ingreso_acc',Getdate(),'$usuario')");


                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[historial_accesorios]
                (tipo_maquina,marca,modelo,descripcion,tipo_acc,cantidad,fecha_de_ingreso_acc,Fecha_crea,usua_crea,fechamov,descripcionmov,usuamov) 
                VALUES
                ('$tipomaquina','$marca','$modelo','$descripcion','$tipo_acc',
                '$cantidad','$fecha_de_ingreso_acc',Getdate(),'$usuario',CONVERT(datetime, Getdate(), 120),'SE CREO UN ACCESORIO','$usuario')");
                }
                ?>

                <!-- inicio de POST EdComunicacion -->
                <?php
                if (isset($_POST['enviarEdcomunicacion'])) {

                    $tipomaquina = $_POST['tipo_maquina'];
                    $marca_edcomunicacion = $_POST['marca_edcomunicacion'];
                    $modelo_edcomunicacion = $_POST['modelo_edcomunicacion'];
                    $descripcion_edcomunicacion = $_POST['descripcion_edcomunicacion'];
                    $serial_edcomunicacion = $_POST['serial_edcomunicacion'];

                    $fecha_de_ingreso_edc = $_POST['fecha_de_ingreso_edc'];
                    $fecha_de_ingreso_edc = date('Y-m-d', strtotime($fecha_de_ingreso_edc));

                    $estado = $_POST['estado'];
                    $placa_activo_edcomunicacion = $_POST['placa_activo_edcomunicacion'];
                    $sede_edcomunicacion = $_POST['sede_edcomunicacion'];
                    $ubicacion_edcomunicacion = $_POST['ubicacion_edcomunicacion'];
                    $observaciones_edcomunicacion = $_POST['observaciones_edcomunicacion'];

                    $fecha_garantia_edc = $_POST['fecha_garantia_edc'];
                    $fecha_garantia_edc = date('Y-m-d', strtotime($fecha_garantia_edc));

                    $usuario = $_SESSION['usuario'];

                    $gestion_edcomunicacion = $_POST['gestion_edcomunicacion'];



                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_edcomunicacion]
                                                  (tipo_maquina,marca_edcomunicacion,modelo_edcomunicacion,descripcion_edcomunicacion,serial_edcomunicacion,fecha_de_ingreso_edc,estado,placa_activo_edcomunicacion,sede_edcomunicacion,ubicacion_edcomunicacion,observaciones_edcomunicacion,gestion_edcomunicacion,fecha_garantia_edc,Fecha_crea,usua_crea,descripcionmov,fechamov,usuamov) 
                                                  VALUES
                                                  ('$tipomaquina','$marca_edcomunicacion','$modelo_edcomunicacion','$descripcion_edcomunicacion','$serial_edcomunicacion',
                                                    '$fecha_de_ingreso_edc','$estado','$placa_activo_edcomunicacion','$sede_edcomunicacion','$ubicacion_edcomunicacion','$observaciones_edcomunicacion','$gestion_edcomunicacion','$fecha_garantia_edc',Getdate(),'$usuario','SE CREO UN ELEMENTO PERIFERICO',getdate(),'$usuario')");
                }
                ?>

                <!-- inicio de POST perifericos -->
                <?php
                if (isset($_POST['enviarPerifericos'])) {
                    $tipomaquina = $_POST['tipo_maquina'];
                    $serial_perifericos = $_POST['serial_perifericos'];
                    $descripcion_perifericos = $_POST['descripcion_perifericos'];
                    $marca_perifericos = $_POST['marca_perifericos'];
                    $modelo_perifericos = $_POST['modelo_perifericos'];
                    $placa_activo_perifericos = $_POST['placa_activo_perifericos'];
                    $sede_perifericos = $_POST['sede_perifericos'];
                    $ubicacion_perifericos = $_POST['ubicacion_perifericos'];
                    $tipo = $_POST['tipo'];
                    $tipo_toner = $_POST['tipo_toner'];
                    $empresa = $_POST['Empresa'];
                    $fecha_de_garantia_peri = $_POST['fecha_de_garantia_peri'];
                    $fecha_de_garantia_peri = date('Y-m-d', strtotime($fecha_de_garantia_peri));

                    $usuario = $_SESSION['usuario'];
                    $estado = $_POST['estado'];
                    $gestion_peri = $_POST['gestion_peri'];

                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_perifericos]
                 (tipo_maquina,serial_perifericos,descripcion_perifericos,marca_perifericos,modelo_perifericos,placa_activo_perifericos,sede_perifericos,ubicacion_perifericos,tipo,tipo_toner,Empresa,fecha_de_garantia_peri,Fecha_crea,usua_crea,estado,gestion_peri,descripcionmov,fechamov,usuamov) 
                                                  VALUES
                                                  ('$tipomaquina','$serial_perifericos','$descripcion_perifericos','$marca_perifericos','$modelo_perifericos','$placa_activo_perifericos','$sede_perifericos','$ubicacion_perifericos','$tipo',
                                                '$tipo_toner','$empresa','$fecha_de_garantia_peri',Getdate(),'$usuario','$estado','$gestion_peri','SE CREO UN ELEMENTO PERIFERICO',getdate(),'$usuario'  )");
                }
                ?>

                <!-- inicio de POST Almacenamiento -->
                <?php
                if (isset($_POST['enviarAlmacenamiento'])) {

                    $tipomaquina = $_POST['tipo_maquina'];
                    $marca_almacenamiento = $_POST['marca_almacenamiento'];
                    $modelo_almacenamiento = $_POST['modelo_almacenamiento'];
                    $descripcion_almacenamiento = $_POST['descripcion_almacenamiento'];
                    $capacidad_almacenamiento = $_POST['capacidad_almacenamiento'];
                    $tipo_almacenamiento = $_POST['tipo_almacenamiento'];
                    $caracteristica_almacenamiento = $_POST['caracteristica_almacenamiento'];
                    $sede_almacenamiento = $_POST['sede_almacenamiento'];
                    $ubicacion_almacenamiento = $_POST['ubicacion_almacenamiento'];

                    $fecha_de_ingreso_alma = $_POST['fecha_de_ingreso_alma'];
                    $fecha_de_ingreso_alma = date('Y-m-d', strtotime($fecha_de_ingreso_alma));

                    $estado = $_POST['estado'];


                    $fecha_de_garantia_alma = $_POST['fecha_de_garantia_alma'];
                    $fecha_de_garantia_alma = date('Y-m-d', strtotime($fecha_de_garantia_alma));

                    $usuario = $_SESSION['usuario'];
                    $gestion_alma = $_POST['gestion_alma'];


                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_almacenamiento]
                (tipo_maquina,marca_almacenamiento,modelo_almacenamiento,descripcion_almacenamiento,capacidad_almacenamiento,
                tipo_almacenamiento, caracteristica_almacenamiento, sede_almacenamiento ,ubicacion_almacenamiento ,fecha_de_ingreso_alma,estado,gestion_alma,fecha_de_garantia_alma,descripcionmov,fechamov,usuamov) 
                            VALUES ('$tipomaquina','$marca_almacenamiento','$modelo_almacenamiento','$descripcion_almacenamiento',
                            '$capacidad_almacenamiento'+'GB','$tipo_almacenamiento','$caracteristica_almacenamiento','$sede_almacenamiento','$ubicacion_almacenamiento',
                            '$fecha_de_ingreso_alma','$estado','$gestion_alma','$fecha_de_garantia_alma','SE CREO UN ELEMENTO DE ALMACENAMIENTO',Getdate(),'$usuario' )");
                }
                ?>

                <!-- inicio de POST enviarsimcard -->
                <?php
                if (isset($_POST['enviarSimcard'])) {

                    $tipo_maquina = $_POST['tipo_maquina'];
                    $numero_linea = $_POST['numero_linea'];
                    $nombre_plan = $_POST['nombre_plan'];
                    $fecha_apertura = $_POST['fecha_apertura'];
                    $valor_plan = $_POST['valor_plan'];
                    $operador = $_POST['operador'];
                    $cod_cliente = $_POST['cod_cliente'];
                    $observaciones_sim = $_POST['observaciones_sim'];
                    $fecha_fin_plan = $_POST['fecha_fin_plan'];
                    $estado = $_POST['estado'];
                    $usuario = $_SESSION['usuario'];
                    $gestion = $_POST['gestion'];



                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_simcard]
                (
                tipo_maquina
                ,numero_linea
                ,nombre_plan
                ,fecha_apertura
                ,valor_plan
                ,operador
                ,cod_cliente
                ,observaciones_sim
                ,fecha_fin_plan
                ,estado
                ,gestion
                ,descripcionmov
                ,fechamov
                ,usuamov
                ) 
                    VALUES
                           (
                               '$tipo_maquina'
                           ,'$numero_linea'
                           ,'$nombre_plan'
                           ,'$fecha_apertura'
                           ,'$valor_plan'
                           ,'$operador'
                           ,'$cod_cliente'
                           ,'$observaciones_sim'
                           ,'$fecha_fin_plan'
                           ,'$estado'
                           ,'3'
                           ,'SE CREA ELEMENTO SIMCARD O LINEA'
                           ,getdate()
                           ,'$usuario'
                           )");
                }
                ?>

                <!-- inicio de POST DVR -->
                <?php
                if (isset($_POST['enviarDvr'])) {

                    $tipo_maquina = $_POST['tipo_maquina'];
                    $marca_dvr = $_POST['marca_dvr'];
                    $modelo_dvr = $_POST['modelo_dvr'];
                    $descripcion_dvr = $_POST['descripcion_dvr'];
                    $capacidad_dvr = $_POST['capacidad_dvr'];
                    $tipo_dvr = $_POST['tipo_dvr'];
                    $sede_dvr = $_POST['sede_dvr'];
                    $ubicacion_dvr = $_POST['ubicacion_dvr'];
                    $software = $_POST['software'];
                    $fecha_ingreso = $_POST['fecha_ingreso'];
                    $num_canales = $_POST['num_canales'];
                    $num_discos = $_POST['num_discos'];
                    $dias_grabacion = $_POST['dias_grabacion'];
                    $ip_dvr = $_POST['ip_dvr'];
                    $estado = $_POST['estado'];
                    $fecha_garantia = $_POST['fecha_garantia'];
                    $usuario = $_SESSION['usuario'];


                    $fechaActual = new DateTime();
                    // Sumar 6 meses a la fecha actual
                    $fechaMantenimientoInicio = $fechaActual->modify('+6 months');
                    // Formatear la fecha como una cadena
                    $fechaMantenimientoInicioStrdvr = $fechaMantenimientoInicio->format('Y-m-d');
                    // Imprimir la fecha de mantenimiento
                    "Fecha de Mantenimiento: " . $fechaMantenimientoInicioStrdvr;


                    $Consulta = odbc_exec($conexion, " INSERT INTO [ControlTIC].[dbo].[maquina_dvr]
                 (tipo_maquina,marca_dvr,modelo_dvr,descripcion_dvr,capacidad_dvr,tipo_dvr,sede_dvr,ubicacion_dvr,software,fecha_ingreso,num_canales,num_discos,
                 dias_grabacion,ip_dvr,estado,estado_asignacion,fecha_garantia,fecha_mantenimiento_inicio,fecha_mantenimiento_fin) 
                                                VALUES ('$tipo_maquina','$marca_dvr','$modelo_dvr','$descripcion_dvr','$capacidad_dvr',
                                                '$tipo_dvr','$sede_dvr','$ubicacion_dvr','$software','$fecha_ingreso',
                                                '$num_canales','$num_discos','$dias_grabacion','$ip_dvr','$estado','1','$fecha_garantia',getdate(),'$fechaMantenimientoInicioStrdvr')");


                    $Consulta = odbc_exec($conexion, " INSERT INTO [ControlTIC].[dbo].[historial_dvr]
                (tipo_maquina,marca_dvr,modelo_dvr,descripcion_dvr,capacidad_dvr,tipo_dvr,sede_dvr,ubicacion_dvr,software,fecha_ingreso,num_canales,num_discos,
                dias_grabacion,ip_dvr,estado,estado_asignacion,fecha_garantia,fecha_mantenimiento_inicio,fecha_mantenimiento_fin,descripcionmov,fechamov,usuamov) 
                               VALUES ('$tipo_maquina','$marca_dvr','$modelo_dvr','$descripcion_dvr','$capacidad_dvr',
                               '$tipo_dvr','$sede_dvr','$ubicacion_dvr','$software','$fecha_ingreso',
                               '$num_canales','$num_discos','$dias_grabacion','$ip_dvr','$estado','1','$fecha_garantia',getdate(),'$fechaMantenimientoInicioStrdvr','SE CREO UN QUIPO DVR', getdate() ,'$usuario' )");
                }
                ?>

                <!-- inicio de POST CCTV -->
                <?php
                if (isset($_POST['enviarCctv'])) {

                    $tipo_maquina = $_POST['tipo_maquina'];
                    $marca_cctv = $_POST['marca_cctv'];
                    $modelo_cctv = $_POST['modelo_cctv'];
                    $descripcion_cctv = $_POST['descripcion_cctv'];
                    $sede_cctv = $_POST['sede_cctv'];
                    $ubicacion_cctv = $_POST['ubicacion_cctv'];
                    $fecha_ingreso = $_POST['fecha_ingreso'];
                    $ip_cctv = $_POST['ip_cctv'];
                    $vision_enfoque = $_POST['vision_enfoque'];
                    $serial_dvr = $_POST['serial_dvr'];
                    $canal = $_POST['canal'];
                    $estado = $_POST['estado'];
                    $fecha_garantia = $_POST['fecha_garantia'];
                    $usuario = $_SESSION['usuario'];


                    // echo "INSERT INTO [ControlTIC].[dbo].[maquina_cctv]
                    //  (tipo_maquina,marca_cctv,modelo_cctv,descripcion_cctv,sede_cctv,ubicacion_cctv,fecha_ingreso,ip_cctv,
                    //  vision_enfoque,serial_dvr,canal,estado,fecha_garantia,Fecha_crea,usua_crea) 
                    //                                 VALUES ('$tipo_maquina','$marca_cctv','$modelo_cctv','$descripcion_cctv','$sede_cctv',
                    //                                 '$ubicacion_cctv','$fecha_ingreso','$ip_cctv','$vision_enfoque','$serial_drv',
                    //                                 '$canal','$estado','$fecha_garantia',Getdate(),'$usuario')";
            

                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_cctv]
                 (tipo_maquina,marca_cctv,modelo_cctv,descripcion_cctv,sede_cctv,ubicacion_cctv,fecha_ingreso,ip_cctv,
                 vision_enfoque,serial_dvr,canal,estado,fecha_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipo_maquina','$marca_cctv','$modelo_cctv','$descripcion_cctv','$sede_cctv',
                                                '$ubicacion_cctv','$fecha_ingreso','$ip_cctv','$vision_enfoque','$serial_drv',
                                                '$canal','$estado','$fecha_garantia',Getdate(),'$usuario')");
                }
                ?>

                <!-- inicio de POST TORRE-->
                <?php
                if (isset($_POST['enviarTorre'])) {

                    $tipo_maquina = $_POST['tipo_maquina'];
                    $placa_activo_torre = $_POST['placa_activo_torre'];
                    $descripcion_torre = $_POST['descripcion_torre'];
                    $sede_torre = $_POST['sede'];
                    $tipo_torre = $_POST['tipo_torre'];
                    $altura_metros = $_POST['altura_metros'];
                    $fecha_ingreso = $_POST['fecha_ingreso'];
                    $fecha_ult_mantenimiento = $_POST['fecha_ult_mantenimiento'];
                    $usuario = $_SESSION['usuario'];
                    $estado = $_POST['estado'];


                    // echo "INSERT INTO [ControlTIC].[dbo].[maquina_torre]
                    //  (tipo_maquina,placa_activo_torre,descripcion_torre,sede_torre,tipo_torre,altura_metros,fecha_ingreso,fecha_ult_mantenimiento,Fecha_crea,usua_crea,estado) 
                    //                                 VALUES ('$tipo_maquina','$placa_activo_torre','$descripcion_torre','$sede_torre','$tipo_torre','$altura_metros',
                    //                                 '$fecha_ingreso','$fecha_ult_mantenimiento',
                    //                                 Getdate(),'$usuario','$estado')";
            

                    $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_torre]
                 (tipo_maquina,placa_activo_torre,descripcion_torre,sede_torre,tipo_torre,altura_metros,fecha_ingreso,fecha_ult_mantenimiento,Fecha_crea,usua_crea,estado) 
                                                  VALUES
                                                  ('$tipo_maquina','$placa_activo_torre','$descripcion_torre','$sede_torre','$tipo_torre','$altura_metros',
                                                '$fecha_ingreso','$fecha_ult_mantenimiento',
                                                Getdate(),'$usuario','$estado')");
                }
                ?>


                <style>
                    .campo-incompleto {
                        border: 1px solid red;
                    }
                </style>


                <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                    <div class="container">
                        <div>
                            <h3>SUBIR EQUIPOS TECNOLOGICOS AL STOCK O INVENTARIO</h3>
                        </div>
                    </div>
                </div>

                <form method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-4"></div>

                            <!-- MODULO PARA SELECCIONAR MAQUINA O DISPOSITIVO -->
                            <div class="col-md-4">
                                <div class="alert alert-primary" role="alert">
                                    SELECCIONE el tipo de maquina o dispositivo a ingresar al inventario.
                                </div>

                                <select class="form-select" aria-label="Default select example" id="tipo_maquina" onchange="mostrarFormulario()" name="tipo_maquina">
                                    <option selected>SELECCIONE</option>

                                    <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de maquina -->
                                    <?php
                                    include '../../conexionbd.php';

                                    // Realizar la consulta a la base de datos para obtener los tipos de maquinas/dispositivos
                                    $consulta = "SELECT id, nombre_maquina FROM [ControlTIC].[dbo].[tipo_maquina]";
                                    $resultado = odbc_exec($conexion, $consulta);

                                    // Iterar sobre los resultados y generar las opciones del select
                                    while ($fila = odbc_fetch_array($resultado)) {
                                        $id = $fila['id'];
                                        $nombre = $fila['nombre_maquina'];
                                        echo "<option value='$id'>$nombre</option>";
                                    }

                                    // Liberar recursos
                                    odbc_free_result($resultado);
                                    ?>
                                </select>

                            </div>

                            <div class="col-md-4"></div>

                        </div>
                    </div>

                    <div class="container-fluid" style="margin-top: 30px;padding-left: 150px;padding-right: 150px;">
                        <div class="row">


                            <!-- FORMULARIO COMPUTADOR -->
                            <div action="" id="formulario1" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Sede</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Sede" required>
                                            <option value="" selected>SELECCIONE</option>

                                            <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                            <?php
                                            include '../../conexionbd.php';

                                            // Realizar la consulta a la base de datos para obtener las sedes
                                            $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                            $resultado = odbc_exec($conexion, $consulta);

                                            // Iterar sobre los resultados y generar las opciones del select
                                            while ($fila = odbc_fetch_array($resultado)) {
                                                $id = $fila['id'];
                                                $nombre = $fila['nombre_sede'];
                                                echo "<option value='$id'>$nombre</option>";
                                            }

                                            // Liberar recursos
                                            odbc_free_result($resultado);
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Empresa</label>
                                            <select class="form-select" aria-label="Default select example" id="" onchange="mostrarFormulario()" name="Empresa_computador" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de empresa -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las empresas
                                                $consulta = "SELECT id, nombre_empresa FROM [ControlTIC].[dbo].[empresa]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_empresa'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Marca_computador" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Service Tag</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Service_tag" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_equipo" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nombre Equipo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Nombre_equipo" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Modelo_computador" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo Computador</label>
                                            <select class="form-select" aria-label="Default select example" id="Tipo_comp" onchange="mostrarFormulario()" name="Tipo_comp" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de computadores -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener los computadores
                                                $consulta = "SELECT id, nombre_tipo_comp FROM [ControlTIC].[dbo].[tipo_comp]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_tipo_comp'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo de Ram</label>
                                            <select class="form-select" aria-label="Default select example" id="Tipo_ram" onchange="mostrarFormulario()" name="Tipo_ram" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de computadores -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener los computadores
                                                $consulta = "SELECT id, nombre_tipo_ram FROM [ControlTIC].[dbo].[tipo_memoria_ram]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_tipo_ram'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cant Memoria RAM</label>
                                            <select class="form-select" aria-label="Default select example" id="Memoria_ram" onchange="mostrarFormulario()" name="Memoria_ram" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de computadores -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener los computadores
                                                $consulta = "SELECT id, capacidad_ram FROM [ControlTIC].[dbo].[capacidad_ram]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['capacidad_ram'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo Disco duro</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Tipo_discoduro" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_tipo_discoduro FROM [ControlTIC].[dbo].[tipo_discoduro]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_tipo_discoduro'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Capacidad Disco Duro</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Capacidad_discoduro" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, capacidad_discoduro FROM [ControlTIC].[dbo].[capacidad_discoduro]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['capacidad_discoduro'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- QUINTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Procesador</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Procesador" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Propietario</label>
                                            <select class="form-select" aria-label="Default select example" id="Propietario" onchange="mostrarFormulario()" name="Propietario" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, descripcion FROM [ControlTIC].[dbo].[propietario]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['descripcion'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>
                                                <select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Proveedor</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Proveedor" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEXTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sistema Operativo</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Sistema_Operativo" required autocomplete="off">
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_sistema_operativo FROM [ControlTIC].[dbo].[sistema_operativo]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_sistema_operativo'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>
                                                <select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial del Cargador</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_cargador" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Dominio</label>
                                            <select class="form-select" aria-label="Default select example" name="Dominio" required>
                                                <option value="" selected>SELECCIONE</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEPTIMO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Usuario</label>
                                            <select class="form-select" aria-label="Default select example" name="Tipo_usuario" required>
                                                <option value="" selected>SELECCIONE</option>
                                                <option value="Administrador">ADMINISTRADOR</option>
                                                <option value="Estandar">ESTANDAR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial de Activo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_activo_fijo" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="Fecha_ingreso_c" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- OCTAVO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo T. Video</label>
                                            <input type="text" class="form-control" id="" placeholder="N/A" name="Targeta_Video" required oninput="convertirAMayusculas(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="Fecha_garantia_c" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <!-- SE CREA ESTE INPUT PARA CAMBIAR EL PARAMETRO DE USUARIO/USUA_CREA Y TOME EL VALOR
                                    SE DEJA OCULTO -->
                                <div>
                                    <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                    <input type="hidden" class="form-control" id="" placeholder="" value="1" name="Estado">
                                    <input type="hidden" class="form-control" id="" placeholder="" value="3" name="Gestion">
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarComputador" type="submit" class="btn btn-warning enviarComputador" name="enviarComputador" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtoncomputador" class="btn btn-success showAlertButton" name="enviarComputador">GUARDAR</button>
                                </div>

                            </div>

                            <!-- FORMULARIO CELULAR -->
                            <div action="" id="formulario2" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">IMEI</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="Imei" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_equipo_celular" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Marca" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Modelo" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="Fecha_ingreso_cel" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Capacidad</label>
                                            <input type="number" class="form-control" id="" placeholder="GB" name="Capacidad" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ram</label>
                                            <input type="number" class="form-control" id="" placeholder="GB" name="Ram_celular" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Garantia</label>
                                            <input type="Date" class="form-control" id="" placeholder="" name="Fecha_garantia_cel" min="<?php echo date('Y-m-d'); ?>" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarCelular" type="submit" class="btn btn-warning enviarCelular" name="enviarCelular" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtoncelular" class="btn btn-success showAlertButtoncelular" name="enviarCelular">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="Estado">

                            </div>

                            <!-- FORMULARIO ACCESORIOS -->
                            <div id="formulario3" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_accesorios]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_descripcion'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="marca" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="modelo" required autocomplete="off">
                                        </div>
                                    </div>
                               
                                </div>

                                <!-- SEGUNDO  BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo</label>
                                            <select class="form-select" aria-label="" name="tipo_acc" required>
                                                <option value="" selected>SELECCIONE</option>
                                                <option value="INALAMBRICA">INALAMBRICA</option>
                                                <option value="ALAMBRICA">ALAMBRICA</option>
                                                <option value="NINGUNA">NINGUNA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" id="" placeholder="" name="cantidad" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_ingreso_acc" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarAccesorios" type="submit" class="btn btn-warning enviarAccesorios" name="enviarAccesorios" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtonaccesorios" class="btn btn-success showAlertButtonaccesorios" name="enviarAccesorios">GUARDAR</button>
                                </div>

                            </div>

                            <!-- FORMULARIO EDCOMUNICACION -->
                            <div id="formulario4" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion_edcomunicacion" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_edcomunicacion]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_descripcion'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="marca_edcomunicacion" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="modelo_edcomunicacion" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="serial_edcomunicacion" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_ingreso_edc" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Placa Activo fijo</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="placa_activo_edcomunicacion" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example" id="sede_edcomunicacion" onchange="mostrarFormulario()" name="sede_edcomunicacion" required>
                                                    <option value="" selected>SELECCIONE</option>

                                                    <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                    <?php
                                                    include '../../conexionbd.php';

                                                    // Realizar la consulta a la base de datos para obtener las sedes
                                                    $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                                    $resultado = odbc_exec($conexion, $consulta);

                                                    // Iterar sobre los resultados y generar las opciones del select
                                                    while ($fila = odbc_fetch_array($resultado)) {
                                                        $id = $fila['id'];
                                                        $nombre = $fila['nombre_sede'];
                                                        echo "<option value='$id'>$nombre</option>";
                                                    }

                                                    // Liberar recursos
                                                    odbc_free_result($resultado);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="ubicacion_edcomunicacion" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Observaciones</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="observaciones_edcomunicacion" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_garantia_edc" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarEdcomunicacion" type="submit" class="btn btn-warning enviarEdcomunicacion" name="enviarEdcomunicacion" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtonedcomunicacion" class="btn btn-success showAlertButtonedcomunicacion" name="enviarAccesorios">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="Estado">
                                <input type="hidden" class="form-control" id="" placeholder="" value="3" name="gestion_edcomunicacion">

                            </div>

                            <!-- FORMULARIO PERIFERICOS -->
                            <div id="formulario5" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion_perifericos" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_perifericos]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_descripcion'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="serial_perifericos" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="marca_perifericos" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="modelo_perifericos" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Placa Activo</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="placa_activo_perifericos" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede_perifericos" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_sede'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="ubicacion_perifericos" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo</label>
                                            <select class="form-select" aria-label="" name="tipo" required>
                                                <option value="" selected>SELECCIONE</option>
                                                <option value="LASER">LASER</option>
                                                <option value="INYECCION">INYECCION</option>
                                                <option value="ESCANER">ESCANER</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo Toner</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="tipo_toner" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Empresa</label>
                                            <select class="form-select" aria-label="Default select example" id="" onchange="mostrarFormulario()" name="Empresa" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_empresa FROM [ControlTIC].[dbo].[empresa]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_empresa'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_garantia_peri" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarPerifericos" type="submit" class="btn btn-warning enviarPerifericos" name="enviarPerifericos" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtonperifericos" class="btn btn-success showAlertButtonperifericos" name="enviarPerifericos">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="Estado">
                                <input type="hidden" class="form-control" id="" placeholder="" value="3" name="gestion_peri">

                            </div>

                            <!-- FORMULARIO ALMACENAMIENTO -->
                            <div id="formulario6" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" oninput="convertirAMayusculas(this)" name="descripcion_almacenamiento" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_descripcion FROM [ControlTIC].[dbo].[descripcion_almacenamiento]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_descripcion'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="marca_almacenamiento" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="modelo_almacenamiento" required autocomplete="off">

                                        </div>
                                    </div>


                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Capacidad</label>
                                            <input type="number" class="form-control" id="" placeholder="GB" oninput="convertirAMayusculas(this)" name="capacidad_almacenamiento" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo</label>
                                            <select class="form-select" aria-label="" name="tipo_almacenamiento" required>
                                                <option value="" selected>SELECCIONE</option>
                                                <option value="MECANICO">MECANICO</option>
                                                <option value="SOLIDO">SOLIDO</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Caracterisica</label>
                                            <select class="form-select" aria-label="" name="caracteristica_almacenamiento" required>
                                                <option value="" selected>SELECCIONE</option>
                                                <option value="INTERNO">INTERNO</option>
                                                <option value="EXTERNO">EXTERNO</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" oninput="convertirAMayusculas(this)" name="sede_almacenamiento" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_sede'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="ubicacion_almacenamiento" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_ingreso_alma" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>


                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_garantia_alma" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>


                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarAlmacenamiento" type="submit" class="btn btn-warning enviarAlmacenamiento" name="enviarAlmacenamiento" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtonalmacenamiento" class="btn btn-success showAlertButtonalmacenamiento" name="enviarAlmacenamiento">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="estado">
                                <input type="hidden" class="form-control" id="" placeholder="" value="3" name="gestion_alma">

                            </div>

                            <!-- FORMULARIO SIMCARD -->
                            <div id="formulario7" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Número de Linea</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="numero_linea" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nombre Plan</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="nombre_plan" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Apertura</label>
                                            <input type="date" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="fecha_apertura" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>

                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Valor Plan</label>
                                            <input type="number" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="valor_plan" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Operador</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="operador" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cod cliente</label>
                                            <input type="number" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="cod_cliente" required autocomplete="off">
                                        </div>
                                    </div>

                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Observaciones</label>
                                            <input type="text" class="form-control" id="" placeholder="" oninput="convertirAMayusculas(this)" name="observaciones_sim" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Final Plan</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_fin_plan" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>

                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarSimcard" type="submit" class="btn btn-warning enviarSimcard" name="enviarSimcard" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtonsimcard" class="btn btn-success showAlertButtonsimcard" name="enviarSimcard">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="estado">
                                <input type="hidden" class="form-control" id="" placeholder="" value="3" name="gestion">

                            </div>

                            <!-- FORMULARIO DVR -->
                            <div id="formulario8" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="marca_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="modelo_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripcion</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="descripcion_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Capacidad</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="capacidad_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="tipo_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede_dvr" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_sede'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="ubicacion_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Software</label>
                                            <input type="number" class="form-control" id="" placeholder="" name="software" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_ingreso" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Num de Canales</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="num_canales" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Num de Discos</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="num_discos" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">dias de Grabacion</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="dias_grabacion" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- QUINTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">ip</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="ip_dvr" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_garantia" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarDvr" type="submit" class="btn btn-warning enviarDvr" name="enviarDvr" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtondvr" class="btn btn-success showAlertButtondvr" name="enviarSimcard">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="estado">
                            </div>

                            <!-- FORMULARIO CCTV -->
                            <div id="formulario9" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="marca_cctv" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="modelo_cctv"  oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripcion</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="descripcion_cctv" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede_cctv" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_sede'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="ubicacion_cctv" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_ingreso" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">IP CCTV</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="pi_cctv" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Vision</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="vision_enfoque" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="serial_dvr" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Canal</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="canal" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_garantia" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarCctv" type="submit" class="btn btn-warning enviarCctv" name="enviarCctv" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtoncctv" class="btn btn-success showAlertButtoncctv" name="enviarCctv">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="estado">
                            </div>

                            <!-- FORMULARIO TORRE -->
                            <div id="formulario10" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Placa Activo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="placa_activo_torre" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="descripcion_torre" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede_torre" required>
                                                <option value="" selected>SELECCIONE</option>

                                                <!-- mediante la sentencia PHP se hace el llamado de la tabla donde se encuentran Los tipos de sede -->
                                                <?php
                                                include '../../conexionbd.php';

                                                // Realizar la consulta a la base de datos para obtener las sedes
                                                $consulta = "SELECT id, nombre_sede FROM [ControlTIC].[dbo].[sede]";
                                                $resultado = odbc_exec($conexion, $consulta);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = odbc_fetch_array($resultado)) {
                                                    $id = $fila['id'];
                                                    $nombre = $fila['nombre_sede'];
                                                    echo "<option value='$id'>$nombre</option>";
                                                }

                                                // Liberar recursos
                                                odbc_free_result($resultado);
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo Torre</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="tipo_torre" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Altura en Metros</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="altura_metros" oninput="convertirAMayusculas(this)" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_ingreso" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ultimo Mantenimiento</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_ult_mantenimiento" max="<?php echo date('Y-m-d'); ?>" required autocomplete="off"> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarTorre" type="submit" class="btn btn-warning enviarTorre" name="enviarTorre" value="" style="display:none"></button>
                                    <button type="button" id="guardarButtontorre" class="btn btn-success showAlertButtontorre" name="enviarTorre">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" class="form-control" id="" placeholder="" value="1" name="estado">
                            </div>

                        </div>

                </form>

            </section>
        </body>




        <!-- CAMPOS DINAMICOS SEGUN SELECCIONE EL DISPOSITIVO O MAQUINA -->
        <script>
            function mostrarFormulario() {
                var select = document.getElementById("tipo_maquina");
                var formulario1 = document.getElementById("formulario1");
                var formulario2 = document.getElementById("formulario2");
                var formulario3 = document.getElementById("formulario3");
                var formulario4 = document.getElementById("formulario4");
                var formulario5 = document.getElementById("formulario5");
                var formulario6 = document.getElementById("formulario6");
                var formulario7 = document.getElementById("formulario7");
                var formulario8 = document.getElementById("formulario8");
                var formulario9 = document.getElementById("formulario9");
                var formulario10 = document.getElementById("formulario10");

                formulario1.style.display = "none";
                formulario2.style.display = "none";
                formulario3.style.display = "none";
                formulario4.style.display = "none";
                formulario5.style.display = "none";
                formulario6.style.display = "none";
                formulario7.style.display = "none";
                formulario8.style.display = "none";
                formulario9.style.display = "none";
                formulario10.style.display = "none";

                if (select.value === "1") {
                    formulario1.style.display = "block";
                } else if (select.value === "2") {
                    formulario2.style.display = "block";
                } else if (select.value === "3") {
                    formulario3.style.display = "block";
                } else if (select.value === "4") {
                    formulario4.style.display = "block";
                } else if (select.value === "5") {
                    formulario5.style.display = "block";
                } else if (select.value === "6") {
                    formulario6.style.display = "block";
                } else if (select.value === "7") {
                    formulario7.style.display = "block";
                } else if (select.value === "8") {
                    formulario8.style.display = "block";
                } else if (select.value === "9") {
                    formulario9.style.display = "block";
                } else if (select.value === "10") {
                    formulario10.style.display = "block";
                }

            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">


        <!-- ALERTAS -->
        <script>
            // ALERTA COMPUTADOR
            $(document).ready(function() {
                $('.showAlertButton').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarComputador').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA CECULAR
            $(document).ready(function() {
                $('.showAlertButtoncelular').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarCelular').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA ACCESORIOS
            $(document).ready(function() {
                $('.showAlertButtonaccesorios').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarAccesorios').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA EDCOMUNICACION
            $(document).ready(function() {
                $('.showAlertButtonedcomunicacion').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarEdcomunicacion').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA PERIFERICOS
            $(document).ready(function() {
                $('.showAlertButtonperifericos').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarPerifericos').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA DE ALMACENAMIENTO
            $(document).ready(function() {
                $('.showAlertButtonalmacenamiento').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarAlmacenamiento').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA DE SIMCARD
            $(document).ready(function() {
                $('.showAlertButtonsimcard').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarSimcard').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA DE DVR
            $(document).ready(function() {
                $('.showAlertButtondvr').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarDvr').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA DE CCTV
            $(document).ready(function() {
                $('.showAlertButtoncctv').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarCctv').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
            // ALERTA DE TORRE
            $(document).ready(function() {
                $('.showAlertButtontorre').click(function() {
                    Swal.fire({
                        title: '¿Quieres guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        denyButtonText: `No guardar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('¡Guardado!', '', 'success');
                            // Ejecutar el trigger después de 2 segundos
                            setTimeout(function() {
                                $('.enviarTorre').trigger('click');
                            }, 2000);
                        } else if (result.isDenied) {
                            Swal.fire('Los cambios no se guardaron', '', 'info');
                        }
                    });
                });
            });
        </script>

        <!-- VALDIACION DE CAMPOS -->
        <script>
            // VALIDACION DE CAMPOS COMPUTADOR
            $(document).ready(function() {
                $('#guardarButtoncomputador').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario1 input, #formulario1 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS CELULAR
            $(document).ready(function() {
                $('#guardarButtoncelular').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario2 input, #formulario2 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS ACCESORIOS
            $(document).ready(function() {
                $('#guardarButtonaccesorios').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario3 input, #formulario3 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS EDCOMUNICACION
            $(document).ready(function() {
                $('#guardarButtonedcomunicacion').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario4 input, #formulario4 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS PERIFERICOS
            $(document).ready(function() {
                $('#guardarButtonperifericos').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario5 input, #formulario5 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS ALMACENAMIENTO
            $(document).ready(function() {
                $('#guardarButtonalmacenamiento').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario6 input, #formulario6 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS SIMCARD
            $(document).ready(function() {
                $('#guardarButtonsimcard').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario7 input, #formulario7 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS SIMCARD
            $(document).ready(function() {
                $('#guardarButtondvr').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario8 input, #formulario8 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS CCTV
            $(document).ready(function() {
                $('#guardarButtoncctv').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario9 input, #formulario9 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
            // VALIDACION DE CAMPOS TORRE
            $(document).ready(function() {
                $('#guardarButtontorre').click(function() {
                    // Obtener todos los campos de entrada dentro del formulario
                    var campos = $('#formulario10 input, #formulario10 select');

                    // Bandera para rastrear si todos los campos obligatorios están completos
                    var todosCompletos = true;

                    // Verificar cada campo
                    campos.each(function() {
                        if ($(this).prop('required') && $(this).val() === '') {
                            todosCompletos = false;
                            $(this).addClass('campo-incompleto'); // Agregar clase de estilo
                        } else {
                            $(this).removeClass('campo-incompleto'); // Quitar clase de estilo si está completa
                        }
                    });

                    if (todosCompletos) {
                        // Si todos los campos están completos, enviar el formulario
                        $('').click();
                    } else {
                        // Mostrar una alerta indicando que algunos campos deben estar completos
                        Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                    }
                });
            });
        </script>

        <!-- MAYUSCULAS -->
        <script>
            function convertirAMayusculas(input) {
                input.value = input.value.toUpperCase();
            }
        </script>



        </html>

    <?php } else { ?><?php } ?>