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

    $data = odbc_exec($conexion, "SELECT  
    [id_asignacion]
    ,mc.[id] ,tipomaquin.[nombre_maquina] as Tipo_maquina 
    ,[Service_tag] 
    ,[Serial_equipo]
    ,[Nombre_equipo] 
    ,sed.[nombre_sede] as Sede 
    ,empres.[nombre_empresa] as Empresa 
    ,[Marca_computador] 
    ,[Modelo_computador] 
    ,tipocomp.[nombre_tipo_comp] as Tipo_comp 
    ,[Tipo_ram] ,[Memoria_ram] 
    ,tipodisco.[nombre_tipo_discoduro] as Tipo_disco 
    ,capacidaddisco.[capacidad_discoduro] as Capacidad_dico 
    ,[Procesador] 
    ,propietari.[descripcion] as Propietario 
    ,[Proveedor] 
    ,sistemao.[nombre_sistema_operativo] as Sistema_O 
    ,[Serial_cargador] 
    ,[Dominio] 
    ,[Tipo_usuario] 
    ,[Serial_activo_fijo] 
    ,[Fecha_ingreso] 
    ,[Targeta_Video] 
    ,estad.[nombre_estado] Estado 
    ,gestio.[estado_gestion] as Estado_Gestion 
    ,[Fecha_garantia] 
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
    ,estadoasigna.[nombre_estado] as Estado_asignacion
    ,[observaciones_asigna]
    ,link_computador_asigna
    FROM [ControlTIC].[dbo].[asignacion_computador] as mc 
    JOIN [ControlTIC].[dbo].[tipo_maquina] AS tipomaquin ON mc.tipo_maquina = tipomaquin.[id] 
    JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id 
    JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id 
    JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id 
    JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id 
    JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id 
    JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id 
    JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id 
    JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id 
    JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id 
    JOIN [ControlTIC].[dbo].estado_asignacion as estadoasigna ON mc.estado_asignacion = estadoasigna.id
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
    </head>

    <!-- HEAD -->
    <?php
    require '../../views/head.php';
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <body>

        <section id="descargaresto" style="font-size: 14px;">
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
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>NOMBRE DEL TRABAJADOR QUE RECIBE <br> <strong><?php echo $nombreCompleto; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CC: <strong><?php echo $cedula; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CARGO QUE DESEMPEÑA:<br> <strong><?php echo $cargo; ?></strong></p>
                    </div>
                </div>


                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;">
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>NOMBRE DEL TRABAJADOR QUE ENTREGA: <br> <strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CC: <br> <strong><?php echo utf8_encode($_SESSION['']); ?></strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CARGO QUE DESEMPEÑA:<br> <strong><?php echo utf8_encode($_SESSION['']); ?></strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;">
                        <p>CARACTERISTICAS DE LOS ELEMENTOS ASIGNADOS</p>
                    </div>
                </div>

                <div class="row" style="text-align: center;">
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


<!-- empieza aqui -->


                <div class="row" style="border: 1px solid black;">
    <div class="col-md-12">
        <?php
        // Check if there are computer assignment records
        if (!empty($arr)) {
            echo '<p>Computadoras</p>';
            echo '<table border="1">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Tipo de Máquina</th>';
            echo '<th>Marca</th>';
            echo '<th>Modelo</th>';
            echo '<th>Serial</th>';
            echo '<th>Procesador</th>';
            echo '<th>Memoria Ram</th>';
            echo '<th>Tipo Disco</th>';
            echo '<th>Capacidad Disco</th>';
            echo '<th>OBSERVACIONES DE COMPUTADOR</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Display the results of computer assignments
            foreach ($arr as $fila) {
                echo '<tr>';
                echo '<td>' . $fila['Tipo_maquina'] . '</td>';
                echo '<td>' . $fila['Marca_computador'] . '</td>';
                echo '<td>' . $fila['Modelo_computador'] . '</td>';
                echo '<td>' . $fila['Serial_equipo'] . '</td>';
                echo '<td>' . $fila['Procesador'] . '</td>';
                echo '<td>' . $fila['Memoria_ram'] . '</td>';
                echo '<td>' . $fila['Tipo_disco'] . '</td>';
                echo '<td>' . $fila['Capacidad_dico'] . '</td>';
                echo '<td>' . $fila['observaciones_asigna'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </div>

<!-- termina -->

    <div class="col-md-6">
        <?php
        // Check if there are mobile phone assignment records
        if (!empty($arr_celular)) {
            echo '<p>Teléfonos Celulares</p>';
            echo '<table border="1">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Tipo de Máquina</th>';
            echo '<th>Marca</th>';
            echo '<th>Modelo</th>';
            echo '<th>Serial</th>';
            echo '<th>IMEI</th>';
            echo '<th>Capacidad</th>';
            echo '<th>Ram</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Display the results of mobile phone assignments
            foreach ($arr_celular as $fila) {
                echo '<tr>';
                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                echo '<td>' . $fila['marca'] . '</td>';
                echo '<td>' . $fila['modelo'] . '</td>';
                echo '<td>' . $fila['serial_equipo_celular'] . '</td>';
                echo '<td>' . $fila['imei'] . '</td>';
                echo '<td>' . $fila['capacidad'] . '</td>';
                echo '<td>' . $fila['ram_celular'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </div>
</div>



                <div class="row">
                    <div class="col-md-12" style="border: 1px solid black;text-align: justify;">
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



        <section id="" style="margin-top: 50px;">
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

        <div class="row columnas">
            <div class="col-md-12">
                <button id="descargarPdf" type="button" class="btn btn-outline-danger pdf-button">Descargar en PDF</button>
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

            // Configuración de opciones para html2pdf
            const opciones = {
                margin: 10,
                filename: 'documento.pdf', // Nombre del archivo PDF
                image: {
                    type: 'jpeg',
                    quality: 0.98
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