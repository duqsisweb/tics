<?php
include '../../../conexionbd.php';

if (
    isset($_POST['id'])

) {
    $equipoId = $_POST['id'];
    $usuario = $_POST['usuario'];

    // Realiza la consulta SQL utilizando el $equipoId
    $data = odbc_exec($conexion, "SELECT mc.[id] ,tipo_maquina.[nombre_maquina] as tipo_maquina ,[Service_tag] ,[Serial_equipo] ,[Nombre_equipo] ,sed.[nombre_sede] as Sede ,empres.[nombre_empresa] as Empresa ,[Marca_computador] ,[Modelo_computador] ,tipocomp.[nombre_tipo_comp] as Tipo_comp ,tipo_memoria_ram.[nombre_tipo_ram] as tipo_memoria_ram ,capacidad_ram.[capacidad_ram] as Memoria_ram ,tipodisco.[nombre_tipo_discoduro] as Tipo_discoduro ,capacidaddisco.[capacidad_discoduro] as Capacidad_discoduro ,[Procesador] ,propietari.[descripcion] as Propietario ,[Proveedor] ,sistemao.[nombre_sistema_operativo] as Sistema_Operativo ,[Serial_cargador] ,[Dominio] ,[Tipo_usuario] ,[Serial_activo_fijo] ,[Fecha_ingreso_c] ,[Targeta_Video] ,estad.[nombre_estado] Estado ,gestio.[estado_gestion] as Gestion ,Fecha_garantia_c,[Fecha_mantenimiento_inicio] ,[Fecha_mantenimiento_fin] ,dias_restantes_mantenimiento ,[observaciones_mantenimiento] ,usuamov, fechamov FROM [ControlTIC].[dbo].[maquina_computador] as mc LEFT JOIN [ControlTIC].[dbo].sede as sed ON mc.Sede = sed.id LEFT JOIN [ControlTIC].[dbo].empresa as empres ON mc.Empresa = empres.id LEFT JOIN [ControlTIC].[dbo].tipo_comp as tipocomp ON mc.Tipo_comp = tipocomp.id LEFT JOIN [ControlTIC].[dbo].tipo_discoduro as tipodisco ON mc.Tipo_discoduro = tipodisco.id LEFT JOIN [ControlTIC].[dbo].capacidad_discoduro as capacidaddisco ON mc.Capacidad_discoduro = capacidaddisco.id LEFT JOIN [ControlTIC].[dbo].propietario as propietari ON mc.Propietario = propietari.id LEFT JOIN [ControlTIC].[dbo].sistema_operativo as sistemao ON mc.Sistema_Operativo = sistemao.id LEFT JOIN [ControlTIC].[dbo].estado as estad ON mc.Estado = estad.id LEFT JOIN [ControlTIC].[dbo].gestion as gestio ON mc.Gestion = gestio.id LEFT JOIN [ControlTIC].[dbo].tipo_memoria_ram as tipo_memoria_ram ON mc.Tipo_ram = tipo_memoria_ram.id LEFT JOIN [ControlTIC].[dbo].capacidad_ram as capacidad_ram ON mc.Memoria_ram = capacidad_ram.id LEFT JOIN [ControlTIC].[dbo].tipo_maquina as tipo_maquina ON mc.tipo_maquina = tipo_maquina.id
 WHERE mc.id = $equipoId");
    $arr = array();
    while ($Element = odbc_fetch_array($data)) {
        $arr[] = $Element;
    }
?>

    <!-- Hoja de estilos de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <!-- Biblioteca de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>

    <style>
        .hidden-cell {
            display: none;
        }

        .columnas {
            margin-top: 30px;
        }

        .textos {
            font-size: 12.9px;
            /* Ajusta el tamaño de fuente según tus preferencias */
        }

        /* Estilo para quitar el borde */
        .no-border {
            border: none;
            outline: none;
            /* Elimina el contorno de enfoque al hacer clic */
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <body>

        <section id="descargaresto">
            <div class="container">
                <?php foreach ($arr as $fila) { ?>
                    <div class="mantenimiento-item">

                        <div class="row columnas" style="text-align: center;">
                            <div class="col-md-12">
                                <h6>MANTENIMIENTO PREVENTIVO</h6>
                            </div>
                        </div>

                        <div class="row columnas textos">

                            <div class="col-md-2">
                                <div class="usuario-mantenimiento">
                                    <strong>USUARIO:</strong>
                                    <?php echo $usuario; ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="fecha-mantenimiento">
                                    <strong>INICIO MANTENIMIENTO:</strong>
                                    <span id="fechaInicioMantenimiento_<?= $fila['id'] ?>"><?= date('Y-m-d') ?></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="fecha-final">
                                    <strong>FINAL MANTENIMIENTO:</strong>
                                    <span id="fechaFinal_<?= $fila['id'] ?>"><?= date('Y-m-d', strtotime('+6 months')) ?></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="service-tag">
                                    <strong>SERVICE TAG:</strong>
                                    <?= $fila['Service_tag'] ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="serial-equipo">
                                    <strong>SERIAL EQUIPO:</strong>
                                    <?= $fila['Serial_equipo'] ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="nombre-equipo">
                                    <strong>NOMBRE EQUIPO:</strong>
                                    <?= $fila['Nombre_equipo'] ?>
                                </div>
                            </div>
                        </div>


                        <div class="row columnas textos">


                            <div class="col-md-2">
                                <div class="marca-computador">
                                    <strong>MARCA COMPUTADOR:</strong>
                                    <?= $fila['Marca_computador'] ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="procesador">
                                    <strong>PROCESADOR:</strong>
                                    <?= $fila['Procesador'] ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <!-- <div class="estado">
                                    <strong>ESTADO:</strong>
                                    <?= $fila['Estado'] ?>
                                </div> -->
                            </div>
                            <div class="col-md-2">
                                <!-- <div class="tipo-comp">
                                    <strong>TIPO DE COMPUTADOR:</strong>
                                    <?= $fila['Tipo_comp'] ?>
                                </div> -->
                            </div>
                        </div>


                        <div class="row columnas textos" style="text-align: justify">
                            <div class="col-md-12">
                                <div class="actividades">
                                    <strong>ACTIVIDADES:</strong>
                                    <br><br>
                                    <div class="actividades-list">
                                        <ul>
                                            <li data-text="Formateo de equipo"><input type="checkbox" value="" id="1"> Formateo de equipo</li>
                                            <li data-text="Instalación de Software autorizado después del formateo."><input type="checkbox" value="" id="2"> Instalación de Software autorizado después del formateo.</li>
                                            <li data-text="Soplado del equipo"><input type="checkbox" value="" id="3"> Soplado del equipo</li>
                                            <li data-text="Limpieza de Carcaza, teclado y monitor"><input type="checkbox" value="" id="4"> Limpieza de Carcaza, teclado y monitor</li>
                                            <li data-text="Revisión de Software (todo aquel no autorizado por la empresa se procederá a la inmediata desinstalación)"><input type="checkbox" value="" id="5"> Revisión de Software (todo aquel no autorizado por la empresa se procederá a la inmediata desinstalación)</li>
                                            <li data-text="Verificar Antivirus (Que se encuentre instalado y actualizado)"><input type="checkbox" value="" id="6"> Verificar Antivirus (Que se encuentre instalado y actualizado)</li>
                                            <li data-text="Revisión de acceso a la red"><input type="checkbox" value="" id="7"> Revisión de acceso a la red</li>
                                            <li data-text="Revisión acceso a VPN"><input type="checkbox" value="" id="8"> Revisión acceso a VPN</li>
                                            <li data-text="Vaciar archivos de la Papelera de reciclaje y borrar archivos temporales del equipo"><input type="checkbox" value="" id="9"> Vaciar archivos de la Papelera de reciclaje y borrar archivos temporales del equipo</li>
                                            <!-- Agrega los demás elementos de la lista aquí -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row textos">
                            <div class="col-md-3"><strong>OBSERVACIONES:</strong></div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="observaciones">
                                    <textarea placeholder="DESCRIPCIÓN DETALLADA DEL MANTENIMIENTO PREVENTIVO" id="observaciones_mantenimiento<?= $fila['id'] ?>" name="observaciones_mantenimiento" class="no-border textos" style="width: 100%; overflow-y: hidden;text-align: justify;"></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row columnas">
                            <div class="col-md-12">
                                <button id="descargarPdf" type="button" class="btn btn-outline-danger pdf-button">Descargar en PDF</button>
                            </div>
                        </div>

                        <div class="row columnas">
                            <div class="col-md-12">
                                <div class="accion">
                                    <button id="enviarcomputador" style="display: none;" type="submit" class="btn btn-outline-warning asignar-btn" data-id="<?= $fila['id'] ?>" data-tipo-maquina="<?= $fila['tipo_maquina'] ?>" data-service-tag="<?= $fila['Service_tag'] ?>" data-serial-equipo="<?= $fila['Serial_equipo'] ?>" data-nombre-equipo="<?= $fila['Nombre_equipo'] ?>" data-sede="<?= $fila['Sede'] ?>" data-empresa="<?= $fila['Empresa'] ?>" data-marca-computador="<?= $fila['Marca_computador'] ?>" data-modelo-computador="<?= $fila['Modelo_computador'] ?>" data-tipo-comp="<?= $fila['Tipo_comp'] ?>" data-tipo-memoria-ram="<?= $fila['tipo_memoria_ram'] ?>" data-memoria-ram="<?= $fila['Memoria_ram'] ?>" data-tipo-discoduro="<?= $fila['Tipo_discoduro'] ?>" data-capacidad-discoduro="<?= $fila['Capacidad_discoduro'] ?>" data-procesador="<?= $fila['Procesador'] ?>" data-propietario="<?= $fila['Propietario'] ?>" data-proveedor="<?= $fila['Proveedor'] ?>" data-sistema-operativo="<?= $fila['Sistema_Operativo'] ?>" data-serial-cargador="<?= $fila['Serial_cargador'] ?>" data-dominio="<?= $fila['Dominio'] ?>" data-tipo-usuario="<?= $fila['Tipo_usuario'] ?>" data-serial-activo-fijo="<?= $fila['Serial_activo_fijo'] ?>" data-fecha-ingreso-c="<?= $fila['Fecha_ingreso_c'] ?>" data-targeta-video="<?= $fila['Targeta_Video'] ?>" data-estado="<?= $fila['Estado'] ?>" data-gestion="<?= $fila['Gestion'] ?>" data-fecha-garantia-c="<?= $fila['Fecha_garantia_c'] ?>" data-segundonombre="<?php echo $segundonombre; ?>" data-primerapellido="<?php echo $primerapellido; ?>" data-segundoapellido="<?php echo $segundoapellido; ?>" data-cedula="<?php echo $cedula; ?>" data-cargo="<?php echo $cargo; ?>" data-usuario="<?php echo $usuario; ?>" data-fecha-inicio-mantenimiento="<?= $fila['fechaInicioMantenimiento'] ?>" data-observaciones-mantenimiento="<?= $fila['observaciones_mantenimiento'] ?>">
                                        <!-- Agrega los datos que necesitas aquí -->
                                    </button>
                                    <!-- btn escondido para la alerta -->
                                    <button id="registrarMantenimiento" type="button" class="btn btn-success showAlertButton pdf-button">REGISTRAR MANTENIMIENTO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>





        </section>

    </body>

    <script>
        // Obtener el elemento textarea
        var textarea = document.getElementById("observaciones_mantenimiento<?= $fila['id'] ?>");

        // Agregar un evento de entrada para ajustar la altura
        textarea.addEventListener("input", function() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });
    </script>

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
        $(document).ready(function() {
            $('.asignar-btn').on('click', function() {
                console.log("Botón 'ASIGNAR' presionado");

                // Obtener el ID del equipo desde el botón
                var equipoId = $(this).data('id');

                var usuario = $(this).data('usuario');
                var id = $(this).data('id');
                var tipo_maquina = $(this).data('tipo-maquina');
                var service_tag = $(this).data('service-tag');
                var serial_equipo = $(this).data('serial-equipo');
                var nombre_equipo = $(this).data('nombre-equipo');
                var sede = $(this).data('sede');
                var empresa = $(this).data('empresa');
                var marca_computador = $(this).data('marca-computador');
                var modelo_computador = $(this).data('modelo-computador');
                var tipo_comp = $(this).data('tipo-comp');
                var tipo_memoria_ram = $(this).data('tipo-memoria-ram');
                var Memoria_ram = $(this).data('memoria-ram');
                var tipo_discoduro = $(this).data('tipo-discoduro');
                var capacidad_discoduro = $(this).data('capacidad-discoduro');
                var procesador = $(this).data('procesador');
                var propietario = $(this).data('propietario');
                var proveedor = $(this).data('proveedor');
                var sistema_operativo = $(this).data('sistema-operativo');
                var serial_cargador = $(this).data('serial-cargador');
                var dominio = $(this).data('dominio');
                var tipo_usuario = $(this).data('tipo-usuario');
                var serial_activo_fijo = $(this).data('serial-activo-fijo');
                var fecha_ingreso_c = $(this).data('fecha-ingreso-c');
                var targeta_video = $(this).data('targeta-video');
                var estado = $(this).data('estado');
                var gestion = $(this).data('gestion');
                var fecha_garantia_c = $(this).data('fecha-garantia-c');


                var observaciones_mantenimiento = $('#observaciones_mantenimiento' + id).val();
                var Fecha_mantenimiento_inicio = $('#fechaInicioMantenimiento_' + equipoId).text();
                var Fecha_mantenimiento_fin = $('#fechaFinal_' + equipoId).text();


                console.log("Usuario :", usuario);
                console.log("Datos a enviar:");
                console.log("ID:", id);
                console.log("Tipo de máquina:", tipo_maquina);
                console.log("Service Tag:", service_tag);
                console.log("Serial de Equipo:", serial_equipo);
                console.log("Nombre de Equipo:", nombre_equipo);
                console.log("Sede:", sede);
                console.log("Empresa:", empresa);
                console.log("Marca de Computador:", marca_computador);
                console.log("Modelo de Computador:", modelo_computador);
                console.log("Tipo de Componente:", tipo_comp);
                console.log("Tipo de RAM:", tipo_memoria_ram);
                console.log("Memoria RAM:", Memoria_ram);
                console.log("Tipo de Disco Duro:", tipo_discoduro);
                console.log("Capacidad de Disco Duro:", capacidad_discoduro);
                console.log("Procesador:", procesador);
                console.log("Propietario:", propietario);
                console.log("Proveedor:", proveedor);
                console.log("Sistema Operativo:", sistema_operativo);
                console.log("Serial de Cargador:", serial_cargador);
                console.log("Dominio:", dominio);
                console.log("Tipo de Usuario:", tipo_usuario);
                console.log("Serial de Activo Fijo:", serial_activo_fijo);
                console.log("Fecha de Ingreso:", fecha_ingreso_c);
                console.log("Targeta de Video:", targeta_video);
                console.log("Estado:", estado);
                console.log("Gestión:", gestion);
                console.log("Fecha de Garantía:", fecha_garantia_c);

                console.log("observaciones de Mantenimiento", observaciones_mantenimiento);
                console.log("Fecha de inicio de mantenimiento:", Fecha_mantenimiento_inicio);
                console.log("Fecha final:", Fecha_mantenimiento_fin);



                $.ajax({
                    url: '../create_mantenimiento/insertarcomputador.php',
                    type: 'POST',
                    data: {


                        id: id,
                        tipo_maquina: tipo_maquina,
                        service_tag: service_tag,
                        serial_equipo: serial_equipo,
                        nombre_equipo: nombre_equipo,
                        sede: sede,
                        empresa: empresa,
                        marca_computador: marca_computador,
                        modelo_computador: modelo_computador,
                        tipo_comp: tipo_comp,
                        tipo_memoria_ram: tipo_memoria_ram,
                        Memoria_ram: Memoria_ram,
                        tipo_discoduro: tipo_discoduro,
                        capacidad_discoduro: capacidad_discoduro,
                        procesador: procesador,
                        propietario: propietario,
                        proveedor: proveedor,
                        sistema_operativo: sistema_operativo,
                        serial_cargador: serial_cargador,
                        dominio: dominio,
                        tipo_usuario: tipo_usuario,
                        serial_activo_fijo: serial_activo_fijo,
                        fecha_ingreso_c: fecha_ingreso_c,
                        targeta_video: targeta_video,
                        estado: estado,
                        gestion: gestion,
                        fecha_garantia_c: fecha_garantia_c,

                        observaciones_mantenimiento: observaciones_mantenimiento,
                        usuario: usuario,
                        Fecha_mantenimiento_inicio: Fecha_mantenimiento_inicio,
                        Fecha_mantenimiento_fin: Fecha_mantenimiento_fin

                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.showAlertButton').click(function() {
                var $asignarBtn = $(this).prev('.asignar-btn'); // Obtener el botón oculto previo
                var idToUpdate = $asignarBtn.data('id'); // Obtener el ID del botón oculto

                Swal.fire({
                    title: '¿Quieres guardar los cambios?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `No guardar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Cerrar el modal
                        $('#modalcomputador').modal('hide');
                        //mensaje de éxito
                        Swal.fire('¡Guardado!', '', 'success');

                        // Obtener las fechas de inicio y fin desde los elementos HTML
                        var Fecha_mantenimiento_inicio = $('#fechaInicioMantenimiento_' + idToUpdate).text();
                        var Fecha_mantenimiento_fin = $('#fechaFinal_' + idToUpdate).text();

                        // Obtener el usuario de mantenimiento y las observaciones
                        var usuario = '<?php echo $usuario; ?>';
                        var observaciones_mantenimiento = $('#observaciones_mantenimiento' + idToUpdate).val();


                        
                        console.log("observaciones de Mantenimientoooooooo maqwuina", observaciones_mantenimiento);



                        // Hacer el update mediante AJAX con el ID obtenido y las fechas para actualizar
                        $.ajax({
                            url: '../update_mantenimiento/actualizar_computador_mantenimiento.php',
                            type: 'POST',
                            data: {
                                idToUpdate: idToUpdate,
                                Fecha_mantenimiento_inicio: Fecha_mantenimiento_inicio,
                                Fecha_mantenimiento_fin: Fecha_mantenimiento_fin,
                                usuario: usuario,
                                observaciones_mantenimiento: observaciones_mantenimiento
                            },
                            success: function(response) {
                                console.log("Actualización exitosa para update de maquina:", response);
                                // Activar el botón oculto correspondiente a la fila seleccionada
                                $asignarBtn.trigger('click');
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Los cambios no se guardaron', '', 'info');
                    }
                });
            });
        });
    </script>



    <!-- script para agregar los chack al text area -->
    <script>
        $(document).ready(function() {
            // Función para actualizar el campo de observaciones
            function actualizarObservaciones() {
                // Inicializa el contenido de observaciones
                var observaciones = '';

                // Recorre todas las casillas de verificación
                $('ul li input[type="checkbox"]').each(function() {
                    // Verifica si la casilla está marcada
                    if ($(this).prop('checked')) {
                        // Obtiene el texto del elemento seleccionado
                        var texto = $(this).parent().data('text');
                        // Agrega el texto al contenido de observaciones con un salto de línea
                        observaciones += texto + '\n/';
                    }
                });

                // Actualiza el contenido del área de observaciones
                $('.mantenimiento-item .observaciones textarea').val(observaciones.trim());
            }

            // Captura el cambio en las casillas de verificación
            $('ul li input[type="checkbox"]').change(function() {
                // Llama a la función para actualizar el campo de observaciones
                actualizarObservaciones();
            });

            // Llama a la función para actualizar el campo de observaciones al cargar la página
            actualizarObservaciones();
        });
    </script>








<?php } else { ?>

<?php
} ?>