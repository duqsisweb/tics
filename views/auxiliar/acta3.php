<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('america/bogota');
session_start();
error_reporting(0);

include '../../conexionbd.php';
if (isset($_SESSION['usuario'])) {

    require '../../function/funciones.php';
?>


    <?php
    include '../../conexionbd.php';

    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX
    $cargo = isset($_GET['cargo']) ? $_GET['cargo'] : ''; // Obtener la cédula pasada por AJAX
    $nombreCompleto = isset($_GET['nombreCompleto']) ? $_GET['nombreCompleto'] : '';
    $empresa = isset($_GET['empresa']) ? $_GET['empresa'] : ''; // Obtener la cédula pasada por AJAX



    // COMPUTADOR CONSULTA
    $data = odbc_exec($conexion, "SELECT  [id_asignacion]
                    ,[id]
                    ,[tipo_maquina]
                    ,[Service_tag]
                    ,[Serial_equipo]
                    ,[Nombre_equipo]
                    ,[Sede]
                    ,[Empresa]
                    ,[Marca_computador]
                    ,[Modelo_computador]
                    ,[Tipo_comp]
                    ,[Tipo_ram]
                    ,[Memoria_ram]
                    ,[Tipo_discoduro]
                    ,[Capacidad_discoduro]
                    ,[Procesador]
                    ,[Propietario]
                    ,[Proveedor]
                    ,[Sistema_Operativo]
                    ,[Serial_cargador]
                    ,[Dominio]
                    ,[Tipo_usuario]
                    ,[Serial_activo_fijo]
                    ,[Fecha_ingreso_c]
                    ,[Targeta_Video]
                    ,[Estado]
                    ,[Gestion]
                    ,[Fecha_garantia_c]
                    ,[Fecha_crea]
                    ,[Usua_crea]
                    ,[Fecha_modifica]
                    ,[Usua_modifica]
                    ,[Usua_asigna]
                    ,[Fecha_asigna]
                    ,[cedula]
                    ,[cargo]
                    ,[primernombre]
                    ,[segundonombre]
                    ,[primerapellido]
                    ,[segundoapellido]
                    ,[estado_asignacion]
                    ,[observaciones]
                    ,[observaciones_asigna]
                    ,[link_computador_asigna]
                    ,[observaciones_desasigna]
                FROM [ControlTIC].[dbo].[asignacion_computador]
        where cedula='$cedula'  and estado_asignacion like '%NO VIGENTE%' ");
    $arr = array();
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }


    // ACCESORIOS CONSULTA
    $data_celular = odbc_exec($conexion, "SELECT [id_asignacion]
                            ,[id]
                            ,[tipo_maquina]
                            ,[imei]
                            ,[serial_equipo_celular]
                            ,[marca]
                            ,[modelo]
                            ,[fecha_ingreso_cel]
                            ,[capacidad]
                            ,[ram_celular]
                            ,[estado]
                            ,[gestion]
                            ,[fecha_garantia_cel]
                            ,[fecha_crea]
                            ,[usua_crea]
                            ,[fecha_modifica]
                            ,[usua_modifica]
                            ,[usua_asigna]
                            ,[fecha_asigna]
                            ,[cedula]
                            ,[cargo]
                            ,[primernombre]
                            ,[segundonombre]
                            ,[primerapellido]
                            ,[segundoapellido]
                            ,[empresa]
                            ,[estado_asignacion]
                            ,[observaciones_desasigna]
                        FROM [ControlTIC].[dbo].[asignacion_celular]
                                                where cedula='$cedula'   and estado_asignacion like '%NO VIGENTE%'
                                                
    ");
    $arr_celular = array();
    while ($Element = odbc_fetch_array($data_celular)) {
        $arr_celular[] = $Element;
    }

    // ACCESORIOS CONSULTA
    $data_accesorios = odbc_exec($conexion, "SELECT  [id_asignacion]
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
            FROM [ControlTIC].[dbo].[asignacion_accesorios]
                                                where cedula='$cedula'   and estado_asignacion like '%NO VIGENTE%'
                                        
                    ");
    $arr_accesorios = array();
    while ($Element = odbc_fetch_array($data_accesorios)) {
        $arr_accesorios[] = $Element;
    }


    // EDCOMUNICACION CONSULTA
    $data_edcomunicacion = odbc_exec($conexion, "SELECT  [id_asignacion]
            ,[id]
            ,[tipo_maquina]
            ,[marca_edcomunicacion]
            ,[modelo_edcomunicacion]
            ,[descripcion_edcomunicacion]
            ,[serial_edcomunicacion]
            ,[fecha_de_ingreso_edc]
            ,[estado]
            ,[placa_activo_edcomunicacion]
            ,[sede_edcomunicacion]
            ,[ubicacion_edcomunicacion]
            ,[observaciones_edcomunicacion]
            ,[gestion_edcomunicacion]
            ,[fecha_garantia_edc]
            ,[fecha_crea]
            ,[usua_crea]
            ,[fecha_modifica]
            ,[usua_modifica]
            ,[usua_asigna]
            ,[fecha_asigna]
            ,[cedula]
            ,[cargo]
            ,[primernombre]
            ,[segundonombre]
            ,[primerapellido]
            ,[segundoapellido]
            ,[empresa]
            ,[estado_asignacion]
            ,[observaciones_desasigna]
        FROM [ControlTIC].[dbo].[asignacion_edcomunicacion] where cedula='$cedula' and estado_asignacion like '%NO VIGENTE%'
        
            ");
    $arr_edcomunicacion = array();
    while ($Element = odbc_fetch_array($data_edcomunicacion)) {
        $arr_edcomunicacion[] = $Element;
    }

    // PERIFERICOS CONSULTA
    $data_perifericos = odbc_exec($conexion, "SELECT  [id_asignacion]
            ,[id]
            ,[tipo_maquina]
            ,[serial_perifericos]
            ,[descripcion_perifericos]
            ,[marca_perifericos]
            ,[modelo_perifericos]
            ,[placa_activo_perifericos]
            ,[sede_perifericos]
            ,[ubicacion_perifericos]
            ,[tipo]
            ,[tipo_toner]
            ,[estado]
            ,[gestion]
            ,[empresa]
            ,[fecha_de_garantia]
            ,[fecha_crea]
            ,[usua_crea]
            ,[fecha_modifica]
            ,[usua_modifica]
            ,[usua_asigna]
            ,[fecha_asigna]
            ,[cedula]
            ,[cargo]
            ,[primernombre]
            ,[segundonombre]
            ,[primerapellido]
            ,[segundoapellido]
            ,[estado_asignacion]
            ,[observaciones_desasigna]
        FROM [ControlTIC].[dbo].[asignacion_perifericos] 
                        where cedula='$cedula'   and estado_asignacion like '%NO VIGENTE%'

          ");
    $arr_perifericos = array();
    while ($Element = odbc_fetch_array($data_perifericos)) {
        $arr_perifericos[] = $Element;
    }

    // ALMACENAMIENTO CONSULTA
    $data_almacenamiento = odbc_exec($conexion, "SELECT [id_asignacion]
                    ,[id]
                    ,[tipo_maquina]
                    ,[marca_almacenamiento]
                    ,[modelo_almacenamiento]
                    ,[descripcion_almacenamiento]
                    ,[capacidad_almacenamiento]
                    ,[tipo_almacenamiento]
                    ,[caracteristica_almacenamiento]
                    ,[sede_almacenamiento]
                    ,[ubicacion_almacenamiento]
                    ,[fecha_de_ingreso]
                    ,[estado]
                    ,[fecha_de_garantia]
                    ,[fecha_crea]
                    ,[usua_crea]
                    ,[fecha_modifica]
                    ,[usua_modifica]
                    ,[usua_asigna]
                    ,[fecha_asigna]
                    ,[cedula]
                    ,[cargo]
                    ,[primernombre]
                    ,[segundonombre]
                    ,[primerapellido]
                    ,[segundoapellido]
                    ,[empresa]
                    ,[estado_asignacion]
                    ,[observaciones_desasigna]
                FROM [ControlTIC].[dbo].[asignacion_almacenamiento] where cedula='$cedula'   and estado_asignacion like '%NO VIGENTE%'
                                                
            ");
    $arr_almacenamiento = array();
    while ($Element = odbc_fetch_array($data_almacenamiento)) {
        $arr_almacenamiento[] = $Element;
    }


    // SIMCARD CONSULTA
    $data_simcard = odbc_exec($conexion, " SELECT  [id_asignacion]
                ,[id]
                ,[tipo_maquina]
                ,[numero_linea]
                ,[nombre_plan]
                ,[fecha_apertura]
                ,[valor_plan]
                ,[operador]
                ,[cod_cliente]
                ,[observaciones_sim]
                ,[fecha_fin_plan]
                ,[estado]
                ,[gestion]
                ,[fecha_crea]
                ,[usua_crea]
                ,[fecha_modifica]
                ,[usua_modifica]
                ,[fecha_asigna]
                ,[usua_asigna]
                ,[cedula]
                ,[cargo]
                ,[primernombre]
                ,[segundonombre]
                ,[primerapellido]
                ,[segundoapellido]
                ,[empresa]
                ,[estado_asignacion]
                ,[observaciones_desasigna]
            FROM [ControlTIC].[dbo].[asignacion_simcard]
                                    where cedula='$cedula'   and estado_asignacion like '%NO VIGENTE%'
        
            ");
    $arr_simcard = array();
    while ($Element = odbc_fetch_array($data_simcard)) {
        $arr_simcard[] = $Element;
    }


    // CELULAR CONSULTA
    $data_dvr = odbc_exec($conexion, "SELECT  mc.[id]
                    ,tipomaquin.[nombre_maquina] as tipo_maquina  
                    ,[marca_dvr]
                    ,[modelo_dvr]
                    ,[descripcion_dvr]
                    ,[capacidad_dvr]
                    ,[tipo_dvr]
                    ,sed.[nombre_sede] as Sede ,[ubicacion_dvr]
                    ,[software]
                    ,[fecha_ingreso]
                    ,[num_canales]
                    ,[num_discos]
                    ,[dias_grabacion]
                    ,[ip_dvr]
                    ,estad.[nombre_estado] as Estado
                    ,[fecha_garantia]
                    ,[fecha_crea]
                    ,[usua_crea]
                    ,[fecha_modifica]
                    ,[usua_modifica]
                    ,[fecha_asigna]
                    ,[usua_asigna]
                    ,[cedula]
                    ,[cargo]
                    ,[primernombre]
                    ,[segundonombre]
                    ,[primerapellido]
                    ,[segundoapellido]
                    ,empresa.[nombre_empresa] as empresa
                    ,[estado_asignacion]
                    ,[observaciones_desasigna]
                    FROM [ControlTIC].[dbo].[asignacion_dvr] as mc
                    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
                    LEFT JOIN [ControlTIC].[dbo].[sede] as sed ON mc.sede_dvr = sed.id
                    LEFT JOIN [ControlTIC].[dbo].[estado] as estad ON mc.estado = estad.id
                    LEFT JOIN [ControlTIC].[dbo].empresa AS empresa ON mc.empresa = empresa.id 
                     where cedula='$cedula'   and estado_asignacion like '%NO VIGENTE%'
        
                ");
    $arr_dvr = array();
    while ($Element = odbc_fetch_array($data_dvr)) {
        $arr_dvr[] = $Element;
    }


    ?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Información de Máquinas</title>
    </head>

    <!-- HEAD -->
    <?php
    require '../../views/head.php';
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <body>

        <section id="descargaresto" style="font-size: 10px;">
            <div class="container">

                <div class="row">
                    <div class="col-md-3" style="border: 1px solid black;padding-top: 10px;padding-bottom: 10px;">
                        <?php
                        if ($empresa == 1) {
                            echo '<img src="../../assets/image/duquesaacta.png" alt="" style="width: 150px;" >';
                        } elseif ($empresa == 2) {
                            echo '<img src="../../assets/image/palmerasacta.png" alt="" style="width: 150px;">';
                        } elseif ($empresa == 3) {
                            echo '<img src="../../assets/image/j25acta.png" alt="" style="width: 150px;">';
                        }
                        ?>
                    </div>
                    <div class="col-md-5 col-xs-12 col-sm-6" style="border: 1px solid black;text-align: center;">
                        <h6>
                            <p style="margin-top: 10px;">ACTA DE DEVOLUCIÓN DE EQUIPOS</p>
                        </h6>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4" style="border: 1px solid black;">
                        <h6>
                            <?php
                            if ($empresa == 1) {
                                echo '<p>GESTICS-SD-20-F</p>';
                            } elseif ($empresa == 2) {
                                echo '<p></p>';
                            } elseif ($empresa == 3) {
                                echo '<p>GESTICS-SD-20-F</p>';
                            }
                            ?>
                        </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;text-align: center;">
                        <h6>
                            <h6>
                                <?php
                                if ($empresa == 1) {
                                    echo '<p>GESTICS-SD-20-F</p>';
                                } elseif ($empresa == 2) {
                                    echo '<p></p>';
                                } elseif ($empresa == 3) {
                                    echo '<p>GESTICS-SD-20-F</p>';
                                }
                                ?>
                            </h6>
                        </h6>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;text-align: right;">
                        <p>FECHA DE DEVOLUCIÓN: <strong>
                                <?php echo date("Y-m-d h:i:s"); ?>
                            </strong></p>
                    </div>
                </div>
                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;">
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>NOMBRE DEL TRABAJADOR QUE DEVUELVE:<br> <strong>
                                <?php echo $nombreCompleto; ?>
                            </strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CC/ IDENTIFICACIÓN DE TRABAJADOR:<br> <strong>
                                <?php echo $cedula; ?>
                            </strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CARGO QUE DESEMPEÑA:<br> <strong>
                                <?php echo $cargo; ?>
                            </strong></p>
                    </div>
                </div>


                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;text-align: center;">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p>NOMBRE DEL TRABAJADOR QUE DEVUELVE: <br> <strong>
                                <?php echo utf8_encode($_SESSION['NOMBRE']); ?>
                            </strong></p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row" style="text-align: center;">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;">
                        <p>CARACTERÍSTICAS DE LOS ELEMENTOS DEVUELTOS</p>
                    </div>
                </div>

                <!-- ETIQUETAS -->
                <div class="row" style="text-align: center;">

                    <?php

                    $columnasMostrarcomp = array(
                        'tipo_maquina' => 'ELEMENTO',
                        'Marca_computador' => 'MARCA',
                        'Modelo_computador' => 'MODELO',
                        'Serial_equipo' => 'SERIAL/PLAN/ACT',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostrarcel = array(
                        'tipo_maquina' => '',
                        'marca' => '',
                        'modelo' => '',
                        'serial_equipo_celular' => '',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostraraccesorios = array(
                        'descripcion' => '',
                        'marca' => '',
                        'modelo' => '',
                        'tipo_acc' => '',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostraredcomunicacion = array(
                        'tipo_maquina' => '',
                        'marca_edcomunicacion' => '',
                        'modelo_edcomunicacion' => '',
                        'serial_edcomunicacion' => '',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostrarperifericos = array(
                        'tipo_maquina' => '',
                        'marca_perifericos' => '',
                        'modelo_perifericos' => '',
                        'serial_perifericos' => '',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostraralmacenamiento = array(
                        'tipo_maquina' => '',
                        'marca_almacenamiento' => '',
                        'modelo_almacenamiento' => '',
                        'capacidad_almacenamiento' => '',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostrarsimcard = array(
                        'tipo_maquina' => '',
                        'numero_linea' => '',
                        'operador' => '',
                        'nombre_plan' => '',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );


                    // Crear la tabla HTML
                    echo '<table border="1">';
                    echo '<thead>';
                    echo '<tr>';
                    foreach ($columnasMostrarcomp as $columna => $etiqueta) {
                        echo '<th>' . $etiqueta . '</th>';
                    }
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';




                    foreach ($arr as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostrarcomp as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }


                    foreach ($arr_celular as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostrarcel as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }

                    foreach ($arr_accesorios as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostraraccesorios as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }


                    foreach ($arr_edcomunicacion as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostraredcomunicacion as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }


                    foreach ($arr_perifericos as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostrarperifericos as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }


                    foreach ($arr_almacenamiento as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostraralmacenamiento as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }

                    foreach ($arr_simcard as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostrarsimcard as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }


                    echo '</tbody>';
                    echo '</table>';
                    ?>
                </div>

                <!-- AQUI EMPIEZA TODO -->
                <div class="row" style="border: 1px solid black;">

                    <!-- empieza aqui  COMPUTADOR -->
                    <div class="col-md-12" style="padding: 0px;">
                        <?php
                        // Check if there are computer assignment records
                        if (!empty($arr)) {
                            // echo '<p>Computadoras</p>';
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">ELEMENTO </th>';
                            echo '<th style="padding-right: 20px;text-align: center">MARCA</th>';
                            echo '<th style="padding-right: 20px;text-align: center">MODELO</th>';
                            echo '<th style="padding-right: 20px;text-align: center">SERIAL</th>';
                            echo '<th style="padding-right: 20px;text-align: center">PROCESADOR</th>';
                            echo '<th style="padding-right: 20px;text-align: center">MEMORIA RAM</th>';
                            echo '<th style="padding-right: 20px;text-align: center">TIPO DISCO</th>';
                            echo '<th style="padding-right: 20px;text-align: center">CAPACIDAD DISCO</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of computer assignments
                            foreach ($arr as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . ' </td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Marca_computador'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Modelo_computador'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Serial_equipo'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Procesador'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Memoria_ram'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Tipo_discoduro'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['Capacidad_discoduro'] . '</td>';
                                echo '<td style="padding-right: 20px;font-size: 9px;">' . $fila['observaciones_desasigna'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>

                    <!-- TERMINA COMPUTADOR -->

                    <!-- empieza aqui  CELULAR -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_celular)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Marca</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Modelo</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Serial</th>';
                            echo '<th style="padding-right: 20px;text-align: center">IMEI</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Capacidad</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Ram</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_celular as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['marca'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['modelo'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['serial_equipo_celular'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['imei'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['capacidad'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['ram_celular'] . '</td>';
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_desasigna'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA CELULAR -->

                    <!-- empieza aqui  ACCESORIOS -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_accesorios)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Marca</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Modelo</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Descripcion</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Tipo</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_accesorios as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['marca'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['modelo'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['descripcion'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_acc'] . '</td>';
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_desasigna_acc'] . '</td>';


                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA ACCESORIOS -->

                    <!-- empieza aqui  EDCOMUNICACION -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_edcomunicacion)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Marca</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Modelo</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Descripcion</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Serial</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_edcomunicacion as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['marca_edcomunicacion'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['modelo_edcomunicacion'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['descripcion_edcomunicacion'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['serial_edcomunicacion'] . '</td>';
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_desasigna'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA EDCOMUNICACION -->

                    <!-- empieza aqui  PERIFERICOS -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_perifericos)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Marca</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Modelo</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Serial</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Placa</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_perifericos as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['marca_perifericos'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['modelo_perifericos'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['serial_perifericos'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['placa_activo_perifericos'] . '</td>';
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_desasigna'] . '</td>';

                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA PERIFERICOS -->

                    <!-- empieza aqui  ALMACENAMIENTO -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_almacenamiento)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Marca</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Modelo</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Capacidad</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Caracteristica</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';

                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_almacenamiento as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['marca_almacenamiento'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['modelo_almacenamiento'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['capacidad_almacenamiento'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['caracteristica_almacenamiento'] . '</td>';
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_desasigna'] . '</td>';

                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA ALMACENAMIENTO -->

                    <!-- empieza aqui  SIMCARD -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_simcard)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Numero</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Nombre Plan</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Valor Plan</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Operador</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Observaciones</th>';
                            echo '<th style="padding-right: 20px;">OBSERVACIONES</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_simcard as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['numero_linea'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['nombre_plan'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['valor_plan'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['operador'] . '</td>';
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_desasigna'] . '</td>';

                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA SIMCARD -->


                    <!-- empieza aqui  DVR -->
                    <div class="col-md-12" style="padding: 10px;">
                        <?php
                        // Check if there are mobile phone assignment records
                        if (!empty($arr_dvr)) {
                            echo '<table style="text-align: center;">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="padding-right: 20px;text-align: center">Elemento</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Marca</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Modelo</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Descripcion</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Capacidad</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Num Discos</th>';
                            echo '<th style="padding-right: 20px;text-align: center">Dias Grabacion</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Display the results of mobile phone assignments
                            foreach ($arr_dvr as $fila) {
                                echo '<tr>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['tipo_maquina'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['marca_dvr'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['modelo_dvr'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['descripcion_dvr'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['capacidad_dvr'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['num_discos'] . '</td>';
                                echo '<td style="padding-right: 20px;text-align: center">' . $fila['dias_grabacion'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <!-- TERMINA DVR -->



                </div>
                <!-- AQUI FINALIZA TODO -->

                <div class="row">
                    <div class="col-md-12" style="border: 1px solid black;text-align: justify;padding: 10px;">
                        <p>EL FUNCIONARIO QUE RECIBE, ABAJO FIRMANTE, SE HACE RESPONSABLE DEL USO DEL SOFTWARE INSTALADO
                            EN ESTE EQUIPO Y APROBADO POR DUQUESA S.A. Y ASUME LA RESPONSABILIDAD,
                            ADMINISTRATIVA Y LEGAL POR EL USO DEL SOFTWARE NO AUTORIZADO. </p>
                        <p> EL EQUIPO SE ENTREGA A SATISFACCIÓN DEL USUARIO. </p>
                    </div>
                </div>

                <div class="row" style="text-align: center;">
                    <div class="col-md-4" style="border: 1px solid black;"><strong>RECIBE:</strong><br>

                        <?php
                        $nombre = utf8_encode($_SESSION['NOMBRE']);
                        $cargo = utf8_encode($_SESSION['CARGO']);


                        if ($nombre == 'YADAH ZAMAR ALONSO REYES') {
                            echo '<img src="../../assets/image/firmaya.png" alt="" style="width: 230px;"><br><br>';
                        } elseif ($nombre == 'YON FREDI GONZALEZ TORRES') {
                            echo ' <img src="../../assets/image/firmas.jpeg" alt="" style="width: 100px;"><br><br><br>';
                        } elseif ($nombre == 'DAIRO JOSE ORTEGA FONSECA') {
                            echo ' <img src="../../assets/image/firmas.jpeg" alt="" style="width: 100px;"><br><br><br>';
                        } elseif ($nombre == 'HECTOR EFREN GUERRERO BARRETO') {
                            echo ' <img src="../../assets/image/firmas.jpeg" alt="" style="width: 100px;"><br><br><br>';
                        } elseif ($nombre == 'JULY ANDREA GUERRERO ZAMORA') {
                            echo ' <img src="../../assets/image/firmas.jpeg" alt="" style="width: 100px;"><br><br><br>';
                        } elseif ($nombre == 'JOSE LUIS CASILIMAS MARTINEZ') {
                            echo ' <img src="../../assets/image/firmas.jpeg" alt="" style="width: 100px;"><br><br><br>';
                        } else {
                            // Puedes agregar más casos según sea necesario
                            // Si ninguno de los nombres coincide, puedes proporcionar un valor predeterminado o hacer algo diferente.
                        }

                        echo '<p><strong>' . $nombre . '</strong><br>' . $cargo . '</p>';
                        ?>

                    </div>
                    <div class="col-md-4" style="border: 1px solid black;"><strong>ENTREGA:</strong><br><br>
                        <img src="../../assets/image/firmas.jpeg" alt="" style="width: 100px;"><br><br>
                        <p><strong>
                                <?php echo $nombreCompleto; ?>
                            </strong><br>
                            <?php echo $cargo = isset($_GET['cargo']) ? $_GET['cargo'] : ''; ?>
                        </p>
                    </div>

                    <div class="col-md-4" style="text-align: center; position: relative;border: 1px solid black">
                        <strong>AUTORIZACIÓN:</strong><br><br><br>
                        <img src="../../assets/image/firmaing.png" alt="" style="width: 170px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><br><br><br>
                        <p><strong>ANDRES FABIAN ROBAYO</strong><br> JEFE DE SISTEMAS</p>
                    </div>

                </div>

            </div>

        </section>

        <div class="container-fluid" style="margin-top: 90px;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="text-align: center;">
                    <div class="d-grid gap-2">
                        <button id="descargarPdf" type="button" class="btn btn-danger pdf-button">ACTA DE DEVOLUCIÓN DE
                            EQUIPOS</button>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </body>

    </html>


    <!-- script para descargar en pdf -->
    <script>
        // Función para convertir la sección en PDF y descargarlo
        function descargarPDF() {
            // Oculta los botones antes de generar el PDF
            var pdfButtons = document.querySelectorAll('.pdf-button');
            pdfButtons.forEach(function(button) {
                button.style.display = 'none';
            });

            const elemento = document.getElementById('descargaresto'); // ID de la sección que deseas convertir a PDF

            // Cambiar el estilo de la sección antes de generar el PDF
            elemento.style.fontSize = '9px';

            // Configuración de opciones para html2pdf
            const opciones = {
                margin: 9,
                filename: 'ACTA.pdf', // Nombre del archivo PDF
                image: {
                    type: 'jpeg',
                    quality: 3
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
            };

            // Comienza la conversión y descarga
            html2pdf()
                .from(elemento)
                .set(opciones)
                .save()
                .then(function() {
                    // Restaura la visibilidad de los botones después de generar el PDF
                    pdfButtons.forEach(function(button) {
                        button.style.display = 'block';
                    });
                });
        }

        // Asocia la función de descarga al botón
        document.getElementById('descargarPdf').addEventListener('click', descargarPDF);
    </script>


    <!-- script para descargar segunda hoja -->
    <script>
        // Función para convertir la sección "segundahoja" en PDF y descargarla
        function descargarPDFSegundaHoja() {
            // Oculta los botones antes de generar el PDF
            var pdfButtons = document.querySelectorAll('.pdf-button');
            pdfButtons.forEach(function(button) {
                button.style.display = 'none';
            });

            const elemento = document.getElementById('segundahoja'); // ID de la sección "segundahoja"

            // Cambiar el estilo de la sección antes de generar el PDF (si es necesario)
            elemento.style.fontSize = '14px';

            // Configuración de opciones para html2pdf (puedes ajustar según tus necesidades)
            const opciones = {
                margin: 9,
                filename: 'Acuerdo.pdf', // Nombre del archivo PDF para la segunda hoja
                image: {
                    type: 'jpeg',
                    quality: 3
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
            };

            // Comienza la conversión y descarga
            html2pdf()
                .from(elemento)
                .set(opciones)
                .save()
                .then(function() {
                    // Restaura la visibilidad de los botones después de generar el PDF
                    pdfButtons.forEach(function(button) {
                        button.style.display = 'block';
                    });
                });
        }

        // Asocia la función de descarga al botón de la segunda hoja
        document.getElementById('descargarPdfSegundaHoja').addEventListener('click', descargarPDFSegundaHoja);
    </script>


    <!-- OBTENER LA FECHA ACTUAL -->
    <script>
        // Obtenemos la fecha actual
        var fechaActual = new Date();

        // Días de la semana en español
        var diasSemana = ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];

        // Meses en español
        var meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

        // Obtenemos el día de la semana, el día del mes y el mes
        var diaSemana = diasSemana[fechaActual.getDay()];
        var diaMes = fechaActual.getDate();
        var mes = meses[fechaActual.getMonth()];
        var año = fechaActual.getFullYear();

        // Formateamos la fecha y hora
        var fechaHoraFormateada = `${diaSemana}, ${diaMes} de ${mes} de ${año}`;

        // Mostramos la fecha y hora en el elemento HTML
        document.getElementById("fecha-hora").textContent = fechaHoraFormateada;

        // Accedemos al elemento h6 dentro del div
        var h6Element = document.getElementById("fecha-hora").getElementsByTagName("h6")[0];

        // Mostramos la fecha y hora en el elemento h6
        h6Element.textContent = fechaHoraFormateada;
    </script>






<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php
} ?>