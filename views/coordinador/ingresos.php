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
         <?php require '../../views/navingresos.php'; ?>






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
                $fecha_ingreso = $_POST['Fecha_ingreso'];
                $targeta_video = $_POST['Targeta_Video'];
                $estado = $_POST['Estado'];
                $gestion = $_POST['Gestion'];
                $Fecha_garantia = $_POST['Fecha_garantia'];

                $usuario = $_SESSION['usuario'];



                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_computador] (tipo_maquina,Service_tag,Serial_equipo,Nombre_equipo,Sede,Empresa,Marca_computador,
                // Modelo_computador,Tipo_comp,Tipo_ram,Memoria_ram,Tipo_discoduro,Capacidad_discoduro,
                // Procesador,Propietario,Proveedor,Sistema_Operativo,Serial_cargador,Dominio,Tipo_usuario,
                // Serial_activo_fijo,Fecha_ingreso,Targeta_Video,Estado,Gestion,Fecha_garantia,Fecha_crea,usua_crea) 
                //      VALUES ('$tipomaquina','$service_tag','$serial','$nombre_equipo','$sede','$Empresa','$marca_computador',
                //         '$modelo_computador','$tipo_comp','$tipo_ram','$cant_memoria_ram','$tipo_discoduro','$capacidad_discoduro',
                //         '$procesador','$propietario','$proveedor','$sistema_operativo','$serial_cargador','$dominio','$tipo_usuario',
                //         '$serial_activo_fijo','$fecha_ingreso','$targeta_video','$estado','$gestion','$Fecha_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_computador]
                                                  (tipo_maquina,Service_tag,Serial_equipo,Nombre_equipo,Sede,Empresa,Marca_computador,
                Modelo_computador,Tipo_comp,Tipo_ram,Memoria_ram,Tipo_discoduro,Capacidad_discoduro,
                Procesador,Propietario,Proveedor,Sistema_Operativo,Serial_cargador,Dominio,Tipo_usuario,
                Serial_activo_fijo,Fecha_ingreso,Targeta_Video,Estado,Gestion,Fecha_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$service_tag','$serial','$nombre_equipo','$sede','$Empresa','$marca_computador',
                        '$modelo_computador','$tipo_comp','$tipo_ram','$cant_memoria_ram','$tipo_discoduro','$capacidad_discoduro',
                        '$procesador','$propietario','$proveedor','$sistema_operativo','$serial_cargador','$dominio','$tipo_usuario',
                        '$serial_activo_fijo','$fecha_ingreso','$targeta_video','$estado','$gestion','$Fecha_garantia',Getdate(),'$usuario')");
            }

            ?>


            <!-- inicio de POST enviarCelular -->
            <?php
            if (isset($_POST['enviarCelular'])) {
                $tipomaquina = $_POST['tipo_maquina'];
                $imei = $_POST['Imei'];
                $serial_equipo_celular = $_POST['Serial_equipo_celular'];
                $marca = $_POST['Marca'];
                $modelo = $_POST['Modelo'];
                $fecha_ingreso = $_POST['Fecha_ingreso'];
                $capacidad = $_POST['Capacidad'];
                $ram_celular = $_POST['Ram_celular'];
                $estado = $_POST['Estado'];
                $gestion = $_POST['Gestion'];
                $Fecha_garantia = $_POST['Fecha_garantia'];
                $usuario = $_SESSION['usuario'];



                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_celular]
                //  (tipo_maquina,Imei,Serial_equipo_celular,Marca,Modelo,Fecha_ingreso,Capacidad,Ram_celular,Estado,Gestion,Fecha_garantia,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipomaquina','$imei','$serial_equipo_celular','$marca','$modelo','$fecha_ingreso','$capacidad',
                //                                     '$ram_celular','$estado','$gestion','$Fecha_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_celular]
                                                  (tipo_maquina,Imei,Serial_equipo_celular,Marca,Modelo,Fecha_ingreso,Capacidad,Ram_celular,Estado,Gestion,Fecha_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$imei','$serial_equipo_celular','$marca','$modelo','$fecha_ingreso','$capacidad',
                                                    '$ram_celular','$estado','$gestion','$Fecha_garantia',Getdate(),'$usuario')");
            }

            ?>


            <!-- inicio de POST enviarAccesorios -->
            <?php
            if (isset($_POST['enviarAccesorios'])) {
                $tipomaquina = $_POST['tipo_maquina'];
                $marca = $_POST['marca'];
                $modelo = $_POST['modelo'];
                $descripcion = $_POST['descripcion'];
                $tipo = $_POST['tipo'];
                $cantidad = $_POST['cantidad'];
                $fecha_de_ingreso = $_POST['fecha_de_ingreso'];
                $usuario = $_SESSION['usuario'];



                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_accesorios]
                //  (tipo_maquina,marca,modelo,descripcion,tipo,cantidad,fecha_ingreso,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipomaquina','$marca','$modelo','$descripcion','$tipo',
                //                                     '$cantidad','$fecha_de_ingreso',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_accesorios]
                                                  (tipo_maquina,marca,modelo,descripcion,tipo,cantidad,fecha_de_ingreso,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$marca','$modelo','$descripcion','$tipo',
                                                    '$cantidad','$fecha_de_ingreso',Getdate(),'$usuario')");
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
                $fecha_de_ingreso = $_POST['fecha_de_ingreso'];
                $estado = $_POST['estado'];
                $placa_activo = $_POST['placa_activo'];
                $sede = $_POST['sede'];
                $ubicacion = $_POST['ubicacion'];
                $observaciones = $_POST['observaciones'];
                $fecha_garantia = $_POST['fecha_garantia'];
                $usuario = $_SESSION['usuario'];



                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_edcomunicacion]
                //  (tipo_maquina,marca_edcomunicacion,modelo_edcomunicacion,descripcion_edcomunicacion,serial_edcomunicacion,fecha_de_ingreso,estado,placa_activo,sede,ubicacion,observaciones,fecha_garantia,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipomaquina','$marca_edcomunicacion','$modelo_edcomunicacion','$descripcion_edcomunicacion','$serial_edcomunicacion',
                //                                     '$fecha_de_ingreso','$estado','$placa_activo','$sede','$ubicacion','$observaciones','$fecha_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_edcomunicacion]
                                                  (tipo_maquina,marca_edcomunicacion,modelo_edcomunicacion,descripcion_edcomunicacion,serial_edcomunicacion,fecha_de_ingreso,estado,placa_activo,sede,ubicacion,observaciones,fecha_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$marca_edcomunicacion','$modelo_edcomunicacion','$descripcion_edcomunicacion','$serial_edcomunicacion',
                                                    '$fecha_de_ingreso','$estado','$placa_activo','$sede','$ubicacion','$observaciones','$fecha_garantia',Getdate(),'$usuario')");
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
                $sede = $_POST['sede'];
                $ubicacion = $_POST['ubicacion'];
                $tipo = $_POST['tipo'];
                $tipo_toner = $_POST['tipo_toner'];
                $empresa = $_POST['Empresa'];
                $fecha_garantia = $_POST['fecha_de_garantia'];
                $usuario = $_SESSION['usuario'];



                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_perifericos]
                //  (tipo_maquina,serial_perifericos,descripcion_perifericos,marca_perifericos,modelo_perifericos,placa_activo_perifericos,sede,ubicacion,tipo,tipo_toner,Empresa,fecha_de_garantia,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipomaquina','$serial_perifericos','$descripcion_perifericos','$marca_perifericos','$modelo_perifericos','$placa_activo_perifericos','$sede','$ubicacion','$tipo',
                //                                 '$tipo_toner','$empresa','$fecha_de_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_perifericos]
                 (tipo_maquina,serial_perifericos,descripcion_perifericos,marca_perifericos,modelo_perifericos,placa_activo_perifericos,sede,ubicacion,tipo,tipo_toner,Empresa,fecha_de_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$serial_perifericos','$descripcion_perifericos','$marca_perifericos','$modelo_perifericos','$placa_activo_perifericos','$sede','$ubicacion','$tipo',
                                                '$tipo_toner','$empresa','$fecha_de_garantia',Getdate(),'$usuario')");
            }

            ?>


            <!-- inicio de POST Almacenamiento -->
            <?php
            if (isset($_POST['enviarAlmacenamiento'])) {

                $tipomaquina = $_POST['tipo_maquina'];
                $marca_almacenamiento = $_POST['marca_almacenamiento'];
                $modelo_almacenamiento = $_POST['modelo_almacenamiento'];
                $descripcion_almacenamiento = $_POST['descripcion_almacenamiento'];
                $capacidad = $_POST['capacidad'];
                $tipo_almacenamiento = $_POST['tipo_almacenamiento'];
                $caracteristica = $_POST['caracteristica'];
                $sede = $_POST['sede'];
                $ubicacion = $_POST['ubicacion'];
                $fecha_de_ingreso = $_POST['fecha_de_ingreso'];
                $estado = $_POST['estado'];
                $fecha_de_garantia = $_POST['fecha_de_garantia'];

                $usuario = $_SESSION['usuario'];



                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_almacenamiento]
                //  (tipo_maquina,marca_almacenamiento,modelo_almacenamiento,descripcion_almacenamiento,capacidad,
                //  tipo_almacenamiento,caracteristica,sede,ubicacion,fecha_de_ingreso,estado,fecha_de_garantia,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipomaquina','$marca_almacenamiento','$modelo_almacenamiento','$descripcion_almacenamiento',
                //                                 '$capacidad','$tipo_almacenamiento','$caracteristica','$sede','$ubicacion',
                //                                 '$fecha_de_ingreso','$estado','$fecha_de_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_almacenamiento]
                 (tipo_maquina,marca_almacenamiento,modelo_almacenamiento,descripcion_almacenamiento,capacidad,
                 tipo_almacenamiento,caracteristica,sede,ubicacion,fecha_de_ingreso,estado,fecha_de_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipomaquina','$marca_almacenamiento','$modelo_almacenamiento','$descripcion_almacenamiento',
                                                '$capacidad','$tipo_almacenamiento','$caracteristica','$sede','$ubicacion',
                                                '$fecha_de_ingreso','$estado','$fecha_de_garantia',Getdate(),'$usuario')");
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


                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_simcard]
                //  (tipo_maquina,numero_linea,nombre_plan,fecha_apertura,valor_plan,operador,cod_cliente,observaciones_sim,fecha_fin_plan,estado,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipo_maquina','$numero_linea','$nombre_plan','$fecha_apertura','$valor_plan','$operador',
                //                                 '$cod_cliente','$observaciones_sim','$fecha_fin_plan','$estado',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_simcard]
                 (tipo_maquina,numero_linea,nombre_plan,fecha_apertura,valor_plan,operador,cod_cliente,observaciones_sim,fecha_fin_plan,estado,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipo_maquina','$numero_linea','$nombre_plan','$fecha_apertura','$valor_plan','$operador',
                                                '$cod_cliente','$observaciones_sim','$fecha_fin_plan','$estado',Getdate(),'$usuario')");
            }

            ?>


            <!-- inicio de POST enviarsimcard -->
            <?php
            if (isset($_POST['enviarDvr'])) {

                $tipo_maquina = $_POST['tipo_maquina'];
                $marca_dvr = $_POST['marca_dvr'];
                $modelo_dvr = $_POST['modelo_dvr'];
                $descripcion_dvr = $_POST['descripcion_dvr'];
                $capacidad_dvr = $_POST['capacidad_dvr'];
                $tipo_dvr = $_POST['tipo_dvr'];
                $sede = $_POST['sede'];
                $ubicacion = $_POST['ubicacion'];
                $software = $_POST['software'];
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $num_canales = $_POST['num_canales'];
                $num_discos = $_POST['num_discos'];
                $dias_grabacion = $_POST['dias_grabacion'];
                $ip_dvr = $_POST['ip'];
                $estado = $_POST['estado'];
                $fecha_garantia = $_POST['fecha_garantia'];
                $usuario = $_SESSION['usuario'];


                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_dvr]
                //  (tipo_maquina,marca_dvr,modelo_dvr,descripcion_dvr,capacidad_dvr,tipo_dvr,sede,ubicacion,software,fecha_ingreso,num_canales,num_discos,
                //  dias_grabacion,ip_dvr,estado,fecha_garantia,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipo_maquina','$marca_dvr','$modelo_dvr','$descripcion_dvr','$capacidad_dvr',
                //                                 '$tipo_dvr','$sede','$ubicacion','$software','$fecha_ingreso',
                //                                 '$num_canales','$num_discos','$dias_grabacion','$ip_dvr','$estado','$fecha_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_dvr]
                 (tipo_maquina,marca_dvr,modelo_dvr,descripcion_dvr,capacidad_dvr,tipo_dvr,sede,ubicacion,software,fecha_ingreso,num_canales,num_discos,
                 dias_grabacion,ip_dvr,estado,fecha_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipo_maquina','$marca_dvr','$modelo_dvr','$descripcion_dvr','$capacidad_dvr',
                                                '$tipo_dvr','$sede','$ubicacion','$software','$fecha_ingreso',
                                                '$num_canales','$num_discos','$dias_grabacion','$ip_dvr','$estado','$fecha_garantia',Getdate(),'$usuario')");
            }

            ?>


            <!-- inicio de POST enviarsimcard -->
            <?php
            if (isset($_POST['enviarCctv'])) {

                $tipo_maquina = $_POST['tipo_maquina'];
                $marca_cctv = $_POST['marca_cctv'];
                $modelo_cctv = $_POST['modelo_cctv'];
                $descripcion_cctv = $_POST['descripcion_cctv'];
                $sede = $_POST['sede'];
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
                //  (tipo_maquina,marca_cctv,modelo_cctv,descripcion_cctv,sede,ubicacion_cctv,fecha_ingreso,ip_cctv,
                //  vision_enfoque,serial_dvr,canal,estado,fecha_garantia,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipo_maquina','$marca_cctv','$modelo_cctv','$descripcion_cctv','$sede',
                //                                 '$ubicacion_cctv','$fecha_ingreso','$ip_cctv','$vision_enfoque','$serial_drv',
                //                                 '$canal','$estado','$fecha_garantia',Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_cctv]
                 (tipo_maquina,marca_cctv,modelo_cctv,descripcion_cctv,sede,ubicacion_cctv,fecha_ingreso,ip_cctv,
                 vision_enfoque,serial_dvr,canal,estado,fecha_garantia,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipo_maquina','$marca_cctv','$modelo_cctv','$descripcion_cctv','$sede',
                                                '$ubicacion_cctv','$fecha_ingreso','$ip_cctv','$vision_enfoque','$serial_drv',
                                                '$canal','$estado','$fecha_garantia',Getdate(),'$usuario')");
            }

            ?>


            <!-- inicio de POST enviarTorre-->
            <?php
            if (isset($_POST['enviarTorre'])) {

                $tipo_maquina = $_POST['tipo_maquina'];
                $placa_activo = $_POST['placa_activo'];
                $descripcion_torre = $_POST['descripcion_torre'];
                $sede = $_POST['sede'];
                $tipo_torre = $_POST['tipo_torre'];
                $altura_metros = $_POST['altura_metros'];
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $fecha_ult_mantenimiento = $_POST['fecha_ult_mantenimiento'];
                $usuario = $_SESSION['usuario'];


                // echo "INSERT INTO [ControlTIC].[dbo].[maquina_torre]
                //  (tipo_maquina,placa_activo,descripcion_torre,sede,tipo_torre,altura_metros,fecha_ingreso,fecha_ult_mantenimiento,Fecha_crea,usua_crea) 
                //                                 VALUES ('$tipo_maquina','$placa_activo','$descripcion_torre','$sede','$tipo_torre','$altura_metros',
                //                                 '$fecha_ingreso','$fecha_ult_mantenimiento',
                //                                 Getdate(),'$usuario')";


                $Consulta = odbc_exec($conexion, "INSERT INTO [ControlTIC].[dbo].[maquina_torre]
                 (tipo_maquina,placa_activo,descripcion_torre,sede,tipo_torre,altura_metros,fecha_ingreso,fecha_ult_mantenimiento,Fecha_crea,usua_crea) 
                                                  VALUES
                                                  ('$tipo_maquina','$placa_activo','$descripcion_torre','$sede','$tipo_torre','$altura_metros',
                                                '$fecha_ingreso','$fecha_ult_mantenimiento',
                                                Getdate(),'$usuario')");
            }

            ?>



            <style>
                .campo-incompleto {
                    border: 1px solid red;
                }
            </style>




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


                <div class="container-fluid" style="margin-top: 30px;">
                    <div class="row">
                        <div class="col-md-12">

                            <div action="" id="formulario1" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Sede</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Sede" required>
                                            <option selected>SELECCIONE</option>

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
                                                <option selected>SELECCIONE</option>

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
                                            <input type="text" class="form-control" id="" placeholder="" name="Marca_computador" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Service Tag</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Service_tag" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_equipo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nombre Equipo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Nombre_equipo" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Modelo_computador" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo Comp.</label>
                                            <select class="form-select" aria-label="Default select example" id="Tipo_comp" onchange="mostrarFormulario()" name="Tipo_comp" required>
                                                <option selected>SELECCIONE</option>

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
                                            <select class="form-select" aria-label="Default select example" name="Tipo_ram" required>
                                                <option selected>SELECCIONE</option>
                                                <option value="DDR">DDR</option>
                                                <option value="DDR2">DDR2</option>
                                                <option value="DDR3">DDR3</option>
                                                <option value="DDR4">DDR4</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cant Memoria RAM</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Memoria_ram" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo Disco duro</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Tipo_discoduro" required>
                                                <option selected>SELECCIONE</option>

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
                                                <option selected>SELECCIONE</option>

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
                                            <input type="text" class="form-control" id="" placeholder="" name="Procesador" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Propietario</label>
                                            <select class="form-select" aria-label="Default select example" id="Propietario" onchange="mostrarFormulario()" name="Propietario" required>
                                                <option selected>SELECCIONE</option>

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
                                            <input type="text" class="form-control" id="" placeholder="" name="Proveedor" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEXTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sistema Operativo</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="Sistema_Operativo" required>
                                                <option selected>SELECCIONE</option>

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
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_cargador" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Dominio</label>
                                            <select class="form-select" aria-label="Default select example" name="Dominio" required>
                                                <option selected>SELECCIONE</option>
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
                                                <option selected>SELECCIONE</option>
                                                <option value="Administrador">Administrador</option>
                                                <option value="Estandar">Estandar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial de Activo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_activo_fijo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="Fecha_ingreso" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- OCTAVO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo T. Video</label>
                                            <input type="text" class="form-control" id="" placeholder="N/A" name="Targeta_Video" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="Fecha_garantia" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <!-- SE CREA ESTE INPUT PARA CAMBIAR EL PARAMETRO DE USUARIO/USUA_CREA Y TOME EL VALOR
                                    SE DEJA OCULTO -->
                                <div>
                                    <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                    <input type="hidden" class="form-control" id="" placeholder="" value="6" name="Estado">
                                </div>




                                <div style="text-align: center;margin-top:15px;">
                                    <!-- <button type="submit" class="btn btn-warning" name="enviarComputador" id="enviarComputador">GUARDAR</button> -->
                                    <button id="enviarComputador" type="submit" class="btn btn-warning enviarComputador" name="enviarComputador" value="" style="display:none"></button>
                                    <button type="button" id="guardarButton" class="btn btn-success showAlertButton" name="enviarComputador">GUARDAR</button>
                                </div>

                            </div>







                            <!-- FORMULARIO CELULAR -->
                            <div action="" id="formulario2" style="display: none;">


                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">IMEI</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Imei">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Serial_equipo_celular">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Marca">
                                        </div>
                                    </div>
                                </div>


                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Modelo">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="Fecha_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Capacidad</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Capacidad">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Ram</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="Ram_celular">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Garantia</label>
                                            <input type="Date" class="form-control" id="" placeholder="" name="Fecha_garantia" min="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <button type="submit" class="btn btn-warning" name="enviarCelular" id="enviarCelular">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                <input type="hidden" class="form-control" id="" placeholder="" value="6" name="Estado">

                            </div>


                            <!-- FORMULARIO ACCESORIOS -->
                            <div id="formulario3" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="marca">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="modelo">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion">
                                                <option selected>SELECCIONE</option>

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
                                </div>

                                <!-- SEGUNDO  BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tipo</label>
                                            <select class="form-select" aria-label="" name="tipo">
                                                <option selected>SELECCIONE</option>
                                                <option value="INALAMBRICA">INALAMBRICA</option>
                                                <option value="ALAMBRICA">ALAMBRICA</option>
                                                <option value="NINGUNA">NINGUNA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" id="" placeholder="" name="cantidad">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <button type="submit" class="btn btn-warning" name="enviarAccesorios" id="enviarComputador">GUARDAR</button>
                                </div>

                            </div>


                            <!-- FORMULARIO EDCOMUNICACION -->
                            <div id="formulario4" style="display: none;">

                                <!-- PRIMER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Descripción</label>
                                            <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion_edcomunicacion">
                                                <option selected>SELECCIONE</option>

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
                                            <input type="text" class="form-control" id="" placeholder="" name="marca_edcomunicacion">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Modelo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="modelo_edcomunicacion">
                                        </div>
                                    </div>
                                </div>

                                <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Serial</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="serial_edcomunicacion">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_de_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Placa Activo fijo</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="placa_activo">
                                        </div>
                                    </div>
                                </div>

                                <!-- TERCER BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede">
                                                    <option selected>SELECCIONE</option>

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
                                            <input type="text" class="form-control" id="" placeholder="" name="ubicacion">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Observaciones</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="observaciones">
                                        </div>
                                    </div>
                                </div>

                                <!-- CUARTO BLOQUE DE FORMULARIO -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha de Garantia</label>
                                            <input type="date" class="form-control" id="" placeholder="" name="fecha_garantia" min="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <div style="text-align: center;margin-top:15px;">
                                    <button type="submit" class="btn btn-warning" name="enviarEdcomunicacion" id="enviarComputador">GUARDAR</button>
                                </div>

                                <!-- CAMPOS OCULTOS -->
                                <input type="hidden" name="usua_crea" value="<?php echo ($a['usuario']) ?>"></input>
                                <input type="hidden" class="form-control" id="" placeholder="" value="6" name="Estado">

                            </div>
                        </div>



                        <!-- FORMULARIO PERIFERICOS -->
                        <div id="formulario5" style="display: none;">

                            <!-- PRIMER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Serial</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="serial_perifericos">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Descripción</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion_perifericos">
                                            <option selected>SELECCIONE</option>

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
                                        <label for="" class="form-label">Marca</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="marca_perifericos">
                                    </div>
                                </div>
                            </div>

                            <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Modelo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="modelo_perifericos">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Placa Activo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="placa_activo_perifericos">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sede</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede">
                                            <option selected>SELECCIONE</option>

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
                                        <input type="text" class="form-control" id="" placeholder="" name="ubicacion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tipo</label>
                                        <select class="form-select" aria-label="" name="tipo">
                                            <option selected>SELECCIONE</option>
                                            <option value="LASER">LASER</option>
                                            <option value="INYECCION">INYECCION</option>
                                            <option value="ESCANER">ESCANER</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tipo Toner</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="tipo_toner">
                                    </div>
                                </div>
                            </div>

                            <!-- TERCER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Empresa</label>
                                        <select class="form-select" aria-label="Default select example" id="" onchange="mostrarFormulario()" name="Empresa">
                                            <option selected>SELECCIONE</option>

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
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_de_garantia" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">

                                    </div>
                                </div>
                            </div>

                            <div style="text-align: center;margin-top:15px;">
                                <button type="submit" class="btn btn-warning" name="enviarPerifericos" id="enviarPerifericos">GUARDAR</button>
                            </div>

                        </div>

                        <!-- FORMULARIO ALMACENAMIENTO -->
                        <div id="formulario6" style="display: none;">

                            <!-- PRIMER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Marca</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="marca_almacenamiento">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Modelo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="modelo_almacenamiento">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Descripción</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="descripcion_almacenamiento">
                                            <option selected>SELECCIONE</option>

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

                            </div>

                            <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Capacidad</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="capacidad">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tipo</label>
                                        <select class="form-select" aria-label="" name="tipo_almacenamiento">
                                            <option selected>SELECCIONE</option>
                                            <option value="MECANICO">MECANICO</option>
                                            <option value="SOLIDO">SOLIDO</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Caracterisica</label>
                                        <select class="form-select" aria-label="" name="caracteristica">
                                            <option selected>SELECCIONE</option>
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
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede">
                                            <option selected>SELECCIONE</option>

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
                                        <input type="text" class="form-control" id="" placeholder="" name="ubicacion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha de ingreso</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_de_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>


                            </div>


                            <!-- CUARTO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha de garantia</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_de_garantia" min="<?php echo date('Y-m-d'); ?>">
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
                                <button type="submit" class="btn btn-warning" name="enviarAlmacenamiento" id="enviarAlmacenamiento">GUARDAR</button>
                            </div>

                            <!-- CAMPOS OCULTOS -->
                            <input type="hidden" class="form-control" id="" placeholder="" value="6" name="estado">

                        </div>

                        <!-- FORMULARIO SIMCARD -->
                        <div id="formulario7" style="display: none;">

                            <!-- PRIMER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Número de Linea</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="numero_linea">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nombre Plan</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="nombre_plan">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha de Apertura</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_apertura" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                            </div>

                            <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Valor Plan</label>
                                        <input type="number" class="form-control" id="" placeholder="" name="valor_plan">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Operador</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="operador">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Cod cliente</label>
                                        <input type="number" class="form-control" id="" placeholder="" name="cod_cliente">
                                    </div>
                                </div>

                            </div>

                            <!-- TERCER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Observaciones</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="observaciones_sim">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha Final Plan</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_fin_plan" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">

                                    </div>
                                </div>

                            </div>

                            <div style="text-align: center;margin-top:15px;">
                                <button type="submit" class="btn btn-warning" name="enviarSimcard" id="enviarSimcard">GUARDAR</button>
                            </div>

                            <!-- CAMPOS OCULTOS -->
                            <input type="hidden" class="form-control" id="" placeholder="" value="6" name="estado">

                        </div>

                        <!-- FORMULARIO DVR -->
                        <div id="formulario8" style="display: none;">

                            <!-- PRIMER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Marca</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="marca_dvr">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Modelo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="modelo_dvr">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="descripcion_dvr">
                                    </div>
                                </div>
                            </div>

                            <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Capacidad</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="capacidad_dvr">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tipo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="tipo_dvr">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sede</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede">
                                            <option selected>SELECCIONE</option>

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
                                        <input type="text" class="form-control" id="" placeholder="" name="ubicacion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Software</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="software">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha Ingreso</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- CUARTO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Num de Canales</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="num_canales">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Num de Discos</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="num_discos">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">dias de Grabacion</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="dias_grabacion">
                                    </div>
                                </div>
                            </div>

                            <!-- QUINTO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ip</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="ip_dvr">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha de Garantia</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_garantia" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">

                                    </div>
                                </div>
                            </div>

                            <div style="text-align: center;margin-top:15px;">
                                <button type="submit" class="btn btn-warning" name="enviarDvr" id="enviarDvr">GUARDAR</button>
                            </div>

                            <!-- CAMPOS OCULTOS -->
                            <input type="hidden" class="form-control" id="" placeholder="" value="6" name="estado">


                        </div>

                        <!-- FORMULARIO CCTV -->
                        <div id="formulario9" style="display: none;">

                            <!-- PRIMER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Marca</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="marca_cctv">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Modelo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="modelo_cctv">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="descripcion_cctv">
                                    </div>
                                </div>
                            </div>

                            <!-- SEGUNDO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sede</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede">
                                            <option selected>SELECCIONE</option>

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
                                        <input type="text" class="form-control" id="" placeholder="" name="ubicacion_cctv">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha Ingreso</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- TERCER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">IP CCTV</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="pi_cctv">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Vision</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="vision_enfoque">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Serial</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="serial_dvr">
                                    </div>
                                </div>
                            </div>

                            <!-- CUARTO BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Canal</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="canal">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha de Garantia</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_garantia" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">

                                    </div>
                                </div>
                            </div>

                            <div style="text-align: center;margin-top:15px;">
                                <button type="submit" class="btn btn-warning" name="enviarCctv" id="enviarCctv">GUARDAR</button>
                            </div>

                            <!-- CAMPOS OCULTOS -->
                            <input type="hidden" class="form-control" id="" placeholder="" value="6" name="estado">
                        </div>

                        <!-- FORMULARIO TORRE -->
                        <div id="formulario10" style="display: none;">

                            <!-- PRIMER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Placa Activo</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="placa_activo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Descripción</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="descripcion_torre">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sede</label>
                                        <select class="form-select" aria-label="Default select example" id="sede" onchange="mostrarFormulario()" name="sede">
                                            <option selected>SELECCIONE</option>

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
                                        <input type="text" class="form-control" id="" placeholder="" name="tipo_torre">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Altura en Metros</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="altura_metros">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha Ingreso</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_ingreso" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- TERCER BLOQUE DE FORMULARIO -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Ultimo Mantenimiento</label>
                                        <input type="date" class="form-control" id="" placeholder="" name="fecha_ult_mantenimiento" max="<?php echo date('Y-m-d'); ?>">
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
                                <button type="submit" class="btn btn-warning" name="enviarTorre" id="enviarTorre">GUARDAR</button>
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



    <!-- SCRIPT ALERTA COMPUTADOR -->
    <script>
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
    </script>

    <script>
        $(document).ready(function() {
            $('#guardarButton').click(function() {
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
                    $('#').click();
                } else {
                    // Mostrar una alerta indicando que algunos campos deben estar completos
                    Swal.fire('Alerta', 'Todos los campos deben estar completos.', 'warning');
                }
            });
        });
    </script>


    </html>

<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>