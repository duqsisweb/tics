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
                FROM [ControlTIC].[dbo].[asignacion_computador]
        where cedula='$cedula'");
    $arr = array();
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
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
                    <div class="col-md-2 col-xs-12 col-sm-2" style="border: 1px solid black;padding-top: 10px;padding-bottom: 10px;">
                        <?php
                        if ($empresa == 1) {
                            echo '<img src="../../assets/image/duquesaacta.png" alt="">';
                        } elseif ($empresa == 2) {
                            echo '<img src="../../assets/image/palmerasacta.png" alt="">';
                        } elseif ($empresa == 3) {
                            echo '<img src="../../assets/image/j25acta.png" alt="">';
                        }
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6" style="border: 1px solid black;text-align: center;">
                        <h6>
                            <p style="margin-top: 10px;">ACTA DE ASIGNACION DE EQUIPOS</p>
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
                        <p>NOMBRE DEL TRABAJADOR QUE RECIBE:<br> <strong><?php echo $nombreCompleto; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CC/ IDENTIFICACIÓN DE TRABAJADOR:<br> <strong><?php echo $cedula; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p>CARGO QUE DESEMPEÑA:<br> <strong><?php echo $cargo; ?></strong></p>
                    </div>
                </div>


                <div class="row" style="border-left: 1px solid black;border-right:1px solid black ;">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>NOMBRE DEL TRABAJADOR QUE ENTREGA: <br> <strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong></p>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                <div class="row" style="text-align: center;">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="border: 1px solid black;">
                        <p>CARACTERÍSTICAS DE LOS ELEMENTOS ASIGNADOS</p>
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


                    echo '</tbody>';
                    echo '</table>';
                    ?>
                </div>

                <!-- AQUI EMPIEZA TODO -->
                <div class="row" style="border: 1px solid black;">

                    <!-- empieza aqui  COMPUTADOR -->
                    <div class="col-md-12" style="padding: 10px;">
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
                                echo '<td style="padding-right: 20px;">' . $fila['observaciones_asigna'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>

                    <!-- TERMINA COMPUTADOR -->

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
                    <div class="col-md-4" style="border: 1px solid black;"><strong>ENTREGA:</strong><br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 100px;"><br><br>
                        <p><strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong><br> <?php echo utf8_encode($_SESSION['CARGO']); ?></p>
                    </div>
                    <div class="col-md-4" style="border: 1px solid black;"><strong>RECIBE:</strong><br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 100px;"><br><br>
                        <p><strong><?php echo $nombreCompleto; ?></strong><br> <?php echo $cargo; ?></p>
                    </div>
                    <div class="col-md-4" style="border: 1px solid black;"><strong>AUTORIZACION:</strong><br><br>
                        <img src="../../assets/image/firma.png" alt="" style="width: 100px;"><br><br>
                        <p><strong>ANDRES ROBAYO </strong><br> JEFE DE SISTEMAS</p>
                    </div>
                </div>
            </div>
        </section>



        <section id="segundahoja" style="margin-top: 30px;">
            <div class="container" style="border: 1px solid black;padding-left: 50px;padding-right: 50px;padding-top: 25px;padding-bottom: 20px;">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2">
                            <?php
                            if ($empresa == 1) {
                                echo '<img src="../../assets/image/duquesaacta.png" alt="">';
                            } elseif ($empresa == 2) {
                                echo '<img src="../../assets/image/palmerasacta.png" alt="">';
                            } elseif ($empresa == 3) {
                                echo '<img src="../../assets/image/j25acta.png" alt="">';
                            }
                            ?>
                        </div>
                        <div class="col-md-10">
                            <h5 style="margin-left: 80px;margin-top: 15px;">ACUERDO ACTA ENTREGA DE EQUIPOS</h5>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 30px;">
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

                <div class="container-fluid" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-4"><strong>ENTREGA:</strong><br><br>
                            <img src="../../assets/image/firma.png" alt="" style="width: 90px;"><br><br>
                            <p><strong><?php echo utf8_encode($_SESSION['NOMBRE']); ?></strong><br> <?php echo utf8_encode($_SESSION['CARGO']); ?></p>
                        </div>
                        <div class="col-md-4"><strong>RECIBE:</strong><br><br>
                            <img src="../../assets/image/firma.png" alt="" style="width: 90px;"><br><br>
                            <p><strong><?php echo $nombreCompleto; ?></strong><br> <?php echo $cargo; ?></p>
                        </div>
                        <div class="col-md-4"><strong>ENTREGA:</strong><br><br>
                            <img src="../../assets/image/firma.png" alt="" style="width: 90px;"><br><br>
                            <p><strong>ANDRES ROBAYO</strong><br> Jefe de Sistemas</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button id="descargarPdfSegundaHoja" type="button" class="btn btn-danger pdf-button">DESCARGAR SEGUNDA HOJA PDF</button>
            </div>

        </section>



        <div class="container-fluid" style="margin-top: 90px;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="text-align: center;">
                    <div class="d-grid gap-2">
                        <button id="descargarPdf" type="button" class="btn btn-danger pdf-button">DESCARGAR PDF</button>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>


        <div class="d-grid gap-2">


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
            elemento.style.fontSize = '10px';

            // Configuración de opciones para html2pdf
            const opciones = {
                margin: 9,
                filename: 'ACTA.pdf', // Nombre del archivo PDF
                image: {
                    type: 'jpeg',
                    quality: 1
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
                filename: 'SegundaHoja.pdf', // Nombre del archivo PDF para la segunda hoja
                image: {
                    type: 'jpeg',
                    quality: 2
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
    </script><?php
            } ?>