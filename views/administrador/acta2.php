<?php
header('Content-Type: text/html; charset=UTF-8');
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

    $data = odbc_exec($conexion, "SELECT  [id_asignacion] ,mc.[id] ,tipomaquin.[nombre_maquina] as Tipo_maquina ,[Service_tag] ,[Serial_equipo],[Nombre_equipo] ,sed.[nombre_sede] as Sede ,empres.[nombre_empresa] as Empresa ,[Marca_computador] ,[Modelo_computador] ,tipocomp.[nombre_tipo_comp] as Tipo_comp ,[Tipo_ram] ,[Memoria_ram] ,tipodisco.[nombre_tipo_discoduro] as Tipo_disco ,capacidaddisco.[capacidad_discoduro] as Capacidad_dico ,[Procesador] ,propietari.[descripcion] as Propietario ,[Proveedor] ,sistemao.[nombre_sistema_operativo] as Sistema_O ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso] ,[Targeta_Video] ,estad.[nombre_estado] Estado ,gestio.[estado_gestion] as Estado_Gestion ,[Fecha_garantia] ,[Fecha_crea] ,[Usua_crea] ,[Fecha_modifica] ,[Usua_modifica] ,[Usua_asigna] ,[Fecha_asigna] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,
    estadoasigna.[nombre_estado] as Estado_asignacion
    ,[observaciones]
    FROM [ControlTIC].[dbo].[asignacion_computador] as mc 
    LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id 
    LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id 
    LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id 
    LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id 
    LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id 
    LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id 
    LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id 
    LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id 
    LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id 
    LEFT JOIN [ControlTIC].[dbo].estado_asignacion as estadoasigna ON mc.estado_asignacion = estadoasigna.id
    where cedula='$cedula'");
    $arr = array();
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }



    $data_celular = odbc_exec($conexion, "SELECT
                                                [id_asignacion],
                                                mc.[id],
                                                tipomaquin.[nombre_maquina] as tipo_maquina,
                                                [imei],
                                                [serial_equipo_celular],
                                                [marca],
                                                [modelo],
                                                [fecha_ingreso],
                                                [capacidad],
                                                [ram_celular],
                                                estad.[nombre_estado] AS [Estado],
                                                gestio.[estado_gestion] as gestion,
                                                [fecha_garantia],
                                                [fecha_crea],
                                                [usua_crea],
                                                [fecha_modifica],
                                                [usua_modifica],
                                                [usua_asigna],
                                                [fecha_asigna],
                                                [cedula],
                                                [cargo],
                                                [primernombre],
                                                [segundonombre],
                                                [primerapellido],
                                                [segundoapellido],
                                                empres.[nombre_empresa] as empresa,
                                                estadoasigna.[nombre_estado] as Estado_asignacion,
                                                observaciones_desasigna
                                                FROM [ControlTIC].[dbo].[asignacion_celular] AS mc 
                                                LEFT JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
                                                LEFT JOIN [ControlTIC].[dbo].[estado] AS estad ON mc.[Estado] = estad.[id] 
                                                LEFT JOIN [ControlTIC].[dbo].[gestion] AS gestio ON mc.gestion = gestio.[id] 
                                                LEFT JOIN [ControlTIC].[dbo].[empresa] AS empres ON mc.empresa = empres.id 
                                                LEFT JOIN [ControlTIC].[dbo].[estado_asignacion] as estadoasigna ON mc.estado_asignacion = estadoasigna.id 
                                                where cedula='$cedula' 
                                                
    ");
    $arr_celular = array();
    while ($Element = odbc_fetch_array($data_celular)) {
        $arr_celular[] = $Element;
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Información de Máquinas</title>
        <!-- <link rel="stylesheet" href="../../js/jsPDF-master/docs/jspdf.js"> -->

        <script>
            // Agrega un controlador de eventos para el botón "Generar PDF"
            document.getElementById("generarPDF").addEventListener("click", function() {
                // Obtén el contenido de la página
                var contenidoHTML = document.documentElement.outerHTML;

                // Crea un nuevo documento PDF
                var doc = new jsPDF();

                // Agrega el contenido HTML al documento PDF
                doc.fromHTML(contenidoHTML, 15, 15);

                // Descarga el archivo PDF con el nombre "documento.pdf"
                doc.save('documento.pdf');
            });
        </script>

    </head>

    <!-- HEAD -->
    <?php
    require '../../views/head.php';
    ?>

    <body style="font-size: 12px;">


        <style>
            /* Estilos para pantallas grandes */
            @media screen and (min-width: 768px) {
                /* Agrega aquí tus estilos para pantallas grandes */
            }

            /* Estilos para pantallas medianas */
            @media screen and (max-width: 767px) {
                /* Agrega aquí tus estilos para pantallas medianas */
            }

            /* Estilos para pantallas pequeñas (móviles) */
            @media screen and (max-width: 576px) {
                /* Agrega aquí tus estilos para pantallas pequeñas */
            }

            /* Estilos para la factura */
            .factura {
                font-family: Arial, sans-serif;
                font-size: 10px;
                /* Tamaño de fuente más pequeño */
                /* Otros estilos de factura como color de fondo, bordes, márgenes, etc. */
            }
        </style>



        <section id="previewHtmlContent">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-xs-12 col-sm-2" style="border: 1px solid black;"><img src="../../assets/image/duquesa_logo - copia.png" alt=""></div>
                    <div class="col-md-6 col-xs-12 col-sm-6" style="border: 1px solid black;">
                        <h6>
                            <p>ACTA DE ASIGNACION DE EQUIPOS</p>
                        </h6>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4" style="border: 1px solid black;">
                        <h6>
                            <p>GESTICS-SD-20-F<br>VERSIÓN 1</p>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;text-align: right;">
                        <p>FECHA DE ENTREGA: <strong><?php echo date("Y-m-d H:i:s"); ?></strong></p>
                    </div>
                </div>
                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;">
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <p>NOMBRE DEL TRABAJADOR QUE RECIBE <br> <strong><?php echo $nombreCompleto; ?></strong></p>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <p>CC: <strong><?php echo $cedula; ?></strong></p>
                    </div>
                </div>
                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;">
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <p>CARGO QUE DESEMPEÑA:<br> <strong><?php echo $cargo; ?></strong></p>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <p>CORREO ASIGNADO:</p>
                    </div>
                </div>

                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;">
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <p>NOMBRE DEL TRABAJADOR QUE ENTREGA: <br> <strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong></p>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <p>CARGO QUE DESEMPEÑA: <br> <strong><?php echo utf8_encode($_SESSION['CARGO']); ?></strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;">
                        <p>CARACTERISTICAS DE LOS ELEMENTOS ASIGNADOS</p>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $columnasMostrarcomp = array(
                        'Tipo_maquina' => 'ELEMENTO',
                        'Marca_computador' => 'MARCA',
                        'Modelo_computador' => 'MODELO',
                        'Serial_equipo' => 'SERIAL',
                        // Agrega aquí las columnas que deseas mostrar y sus etiquetas
                    );

                    $columnasMostrarcel = array(
                        'tipo_maquina' => '',
                        'marca' => '',
                        'modelo' => '',
                        'serial_equipo_celular' => '',
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

                    // Mostrar los datos de la primera consulta
                    foreach ($arr as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostrarcomp as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }

                    // Mostrar los datos de la segunda consulta
                    foreach ($arr_celular as $fila) {
                        echo '<tr>';
                        foreach ($columnasMostrarcel as $columna => $etiqueta) {
                            echo '<td>' . $fila[$columna] . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    ?>
                </div>

                <div class="row" style="border: 1px solid black;text-align: left;">
                    <div class="col-md-12">
                        <!-- Aquí puedes mostrar el resultado de la consulta SQL en formato de texto simple -->
                        <?php
                        // Verificar si hay datos en el arreglo $arr
                        if (!empty($arr) || !empty($arr_celular)) {
                            echo '<strong></strong><br>';

                            // Mostrar los resultados en una tabla
                            echo '<table>';
                            echo '<tr>';

                            // Mostrar los resultados de las computadoras
                            foreach ($arr as $fila) {
                                echo '<td style="margin-right: 10px; padding: 30px; ">'; // Agrega espacio y bordes
                                echo '<p>';
                                echo 'Tipo de Máquina: <strong>' . $fila['Tipo_maquina'] . '</strong><br>';
                                echo 'Marca: <strong>' . $fila['Marca_computador'] . '</strong><br>';
                                echo 'Modelo: <strong>' . $fila['Modelo_computador'] . '</strong><br>';
                                echo 'Serial: <strong>' . $fila['Serial_equipo'] . '</strong><br>';
                                echo 'Procesador: <strong>' . $fila['Procesador'] . '</strong><br>';
                                echo 'Memoria Ram: <strong>' . $fila['Memoria_ram'] . '</strong><br>';
                                echo 'Tipo Disco: <strong>' . $fila['Tipo_disco'] . '</strong><br>';
                                echo 'Capacidad Disco: <strong>'  . $fila['Capacidad_dico'] . '</strong><br>';
                                // Agrega aquí más campos y sus valores si es necesario
                                echo '</p>';
                                echo '</td>';
                            }

                            // Mostrar los resultados de los teléfonos celulares
                            foreach ($arr_celular as $fila) {
                                echo '<td style="margin-right: 10px; padding: 30px;">'; // Agrega espacio y bordes
                                echo '<p>';
                                echo 'Tipo de Máquina: <strong>' . $fila['tipo_maquina'] . '</strong><br>';
                                echo 'Marca: <strong>' . $fila['marca'] . '</strong><br>';
                                echo 'Modelo: <strong>' . $fila['modelo'] . '</strong><br>';
                                echo 'Serial: <strong>' . $fila['serial_equipo_celular'] . '</strong><br>';
                                echo 'IMEI: <strong>' . $fila['imei'] . '</strong><br>';
                                echo 'Capacidad: <strong>' . $fila['capacidad'] . '</strong><br>';
                                echo 'Ram: <strong>' . $fila['ram_celular'] . '</strong><br>';
                                // Agrega aquí más campos y sus valores si es necesario
                                echo '</p>';
                                echo '</td>';
                            }

                            echo '</tr>';
                            echo '</table>';
                        } else {
                            echo 'No se encontraron datos para mostrar.';
                        }
                        ?>
                    </div>

                </div>

                <div class="row" style="border: 1px solid black;padding: 10px;">
                    <div class="col-md-2">
                        <p>OBSERVACIONES:</p>
                    </div>
                    <div class="col-md-10">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="border: 1px solid black;text-align: justify;padding: 30px;">
                        <p>EL FUNCIONARIO QUE RECIBE, ABAJO FIRMANTE, SE HACE RESPONSABLE DEL USO DEL SOFTWARE INSTALADO
                            EN ESTE EQUIPO Y APROBADO POR DUQUESA S.A. Y ASUME LA RESPONSABILIDAD,
                            ADMINISTRATIVA Y LEGAL POR EL USO DEL SOFTWARE NO AUTORIZADO. </p>
                        <div>
                            <p> EL EQUIPO SE ENTREGA A SATISFACCIÓN DEL USUARIO. </p><br>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4" style="border: 1px solid black;">ENTREGA: <br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 150px;"><br><br>
                        <p><strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong><br> <?php echo utf8_encode($_SESSION['CARGO']); ?></p>
                    </div>
                    <div class="col-md-4" style="border: 1px solid black;">RECIBE: <br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 150px;"><br><br>
                        <p><strong><?php echo $nombreCompleto; ?></strong><br> <?php echo $cargo; ?></p>
                    </div>
                    <div class="col-md-4" style="border: 1px solid black;">AUTORIZACION <br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 150px;"><br><br>
                        <p><strong>Andres Robayo</strong><br> Jefe de Sistemas</p>
                    </div>
                </div>
            </div>

        </section>



        <section id="acuerdo" style="margin-top: 50px;">
            <div class="container" style="border: 1px solid black;padding: 100px;">

                <div class="row" style="">
                    <div class="col-md-4">
                        <img src="../../assets/image/duquesa_logo - copia.png" alt="">
                    </div>
                    <div class="col-md-8">
                        <h5 style="text-align: left;padding: 10px;">ACUERDO ACTA ENTREGA DE EQUIPOS</h5>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-12" style="text-align: left;">
                        <h6 id="fecha-hora"></h6>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12" style="text-align: justify;">
                        <p>Comedidamente se hace entrega del equipo que se describe en el documento anexo.</p><br>
                        <p>Este equipo se entrega funcionando correctamente con los programas y recursos necesarios para el desarrollo de actividades propias de la empresa, por lo cual el usuario a quien se le hace entrega del mismo no puede realizar acciones de instalar nuevo software ni desinstalar los existentes sin previo aviso al área de Sistemas, esta última es quien se encarga de autorizar dichas acciones y efectuarlas si lo considera necesario.</p><br>
                        <p>El usuario se hace responsable por el equipo entregado y accesorios relacionados en el anexo, cualquier daño provocado con o sin intensión es el usuario responsable quien asume los arreglos o reposición a que haya lugar.</p><br>
                        <p>También cabe recordar que este equipo es de uso exclusivo de la compañía y con el fin de evitar inconvenientes legales con los entes de control, no es procedente almacenar archivos de audio y video ajenos a la empresa (música MP3, WAV) y otros formatos.</p><br>
                        <p>En caso de que se encuentre alguna irregularidad o incumplimiento de estos acuerdos después de esta notificación durante la visita de un ente de control, el usuario del equipo será el responsable de las acciones legales y penales que esto conlleva.</p><br>
                        <p>Como mutuo acuerdo firman los responsables:</p><br><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4" style="">ENTREGA: <br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 150px;"><br><br>
                        <p><strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong><br> <?php echo utf8_encode($_SESSION['CARGO']); ?></p>
                    </div>
                    <div class="col-md-4" style="">RECIBE: <br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 150px;"><br><br>
                        <p><strong><?php echo $nombreCompleto; ?></strong><br> <?php echo $cargo; ?></p>
                    </div>
                    <div class="col-md-4" style="">ENTREGA: <br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 150px;"><br><br>
                        <p><strong>Andres Robayo</strong><br> Jefe de Sistemas</p>
                    </div>
                </div>

            </div>
        </section>

        <button id="generarPDF">Generar PDF</button>

    </body>

    </html>



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
    </script><?php
            } ?>