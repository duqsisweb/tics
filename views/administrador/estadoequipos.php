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

    <!-- HEAD -->
    <?php
    require '../../views/head.php';
    ?>

    <body>

        <!-- NAV -->
        <?php
        require '../../views/nav.php';
        ?>

        <section style="margin-top: 100px;">


            <?php require '../../views/navestado.php'; ?>

            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container">
                    <div>
                        <h3>Ajustar Estado de Equipos</h3>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Accordion Item #1 COMPUTADORES
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>ID</th>
                                                    <th>Estado</th>
                                                    <th>Service</th>
                                                    <th>Equipo</th>
                                                    <th>Sede</th>
                                                    <th>Marca</th>
                                                    <th>Tipo</th>
                                                    <th>Ram</th>
                                                    <th>Disco</th>
                                                    <th>Propietario</th>
                                                    <th>Proveedor</th>
                                                    <th>Sistema O.</th>
                                                    <th>Ajustar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $datosEquipos = obtenerDatosEquiposcomputadorasignados($conexion); // Llama a la función para obtener los datos
                                                foreach ($datosEquipos as $row) {
                                                    echo "<tr>";
                                                    foreach ($row as $key => $value) {
                                                        if ($key === 'Estado' && $value === 'Asignado') {
                                                            echo "<td>$value</td>";
                                                        } else {
                                                            echo "<td>" . $value . "</td>";
                                                        }
                                                    }

                                                    // Verificar si el estado no es "Asignado" para mostrar el select y el botón
                                                    if ($row['Estado'] !== 'Asignado') {
                                                        echo '<td>';
                                                        echo '<select class="form-select estado-select" aria-label="Default select example">';
                                                        echo '<option selected disabled>Seleccionar</option>';
                                                        echo '<option value="1">CONFIGURACION</option>';
                                                        echo '<option value="2">BAJA</option>';
                                                        echo '<option value="3">VENDIDO</option>';
                                                        echo '<option value="5">PROVEEDOR</option>';
                                                        echo '<option value="6">STOCK</option>';
                                                        echo '</select>';
                                                        echo '<br>';
                                                        echo '<button type="button" class="btn btn-warning btn-ajustarcomp asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
                                                        echo '</td>';
                                                    } else {
                                                        echo '<td></td>'; // Espacio en blanco si el estado es "Asignado"
                                                    }
                                                    echo "</tr>";
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Accordion Item #2 CELULARES
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablecel" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>ID</th>
                                                    <th>IMEI</th>
                                                    <th>SERIAL</th>
                                                    <th>MARCA</th>
                                                    <th>MODELO</th>
                                                    <th></th>
                                                    <th>CAPACIDAD EN GB</th>
                                                    <th>RAM EN GB</th>
                                                    <th>ESTADO</th>
                                                    <th>GESTION</th>
                                                    <th>Ajustar</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $datosEquipos = obtenerDatosEquiposcelularesasignados($conexion); // Llama a la función para obtener los datos
                                                foreach ($datosEquipos as $row) {
                                                    echo "<tr>";
                                                    foreach ($row as $key => $value) {
                                                        if ($key === 'Estado' && $value === 'Asignado') {
                                                            echo "<td>$value</td>";
                                                        } else {
                                                            echo "<td>" . $value . "</td>";
                                                        }
                                                    }

                                                    // Verificar si el estado no es "Asignado" para mostrar el select y el botón
                                                    if ($row['Estado'] !== 'Asignado') {
                                                        echo '<td>';
                                                        echo '<select class="form-select estado-select" aria-label="Default select example">';
                                                        echo '<option selected disabled>Seleccionar</option>';
                                                        echo '<option value="1">CONFIGURACION</option>';
                                                        echo '<option value="2">BAJA</option>';
                                                        echo '<option value="3">VENDIDO</option>';
                                                        echo '<option value="5">PROVEEDOR</option>';
                                                        echo '<option value="6">STOCK</option>';
                                                        echo '</select>';
                                                        echo '<br>';
                                                        echo '<button type="button" class="btn btn-warning btn-ajustarcel asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
                                                        echo '</td>';
                                                    } else {
                                                        echo '<td></td>'; // Espacio en blanco si el estado es "Asignado"
                                                    }
                                                    echo "</tr>";
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Accordion Item #4
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Accordion Item #5
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Accordion Item #6
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        Accordion Item #7
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </section>


    </html>


    <!-- AJAX COMPUTADOR -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustarcomp').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_computador.php",
                    data: {
                        idToUpdate: idToUpdate, // Asegúrate de que el nombre sea 'idToUpdate'
                        estado: selectedValue
                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response); // Registrar la respuesta del servidor
                        alert("Estado actualizado correctamente");
                    },
                    error: function(error) {
                        console.error("Error al actualizar el estado:", error); // Registrar errores
                        alert("Error al actualizar el estado");
                    }
                });
            });
        });
    </script>


    <!-- AJAX CELULAR -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustarcel').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_celular.php",
                    data: {
                        idToUpdate: idToUpdate, // Asegúrate de que el nombre sea 'idToUpdate'
                        estado: selectedValue
                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response); // Registrar la respuesta del servidor
                        alert("Estado actualizado correctamente");
                    },
                    error: function(error) {
                        console.error("Error al actualizar el estado:", error); // Registrar errores
                        alert("Error al actualizar el estado");
                    }
                });
            });
        });
    </script>







    <!-- Inicio DataTable -->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtable').DataTable({
                info: false,
                select: true,
                destroy: true,
                jQueryUI: true,
                paginate: true,
                iDisplayLength: 30,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                    // 'copy', 'csv', 'excel'
                ],
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros por página.',
                    zeroRecords: 'Lo sentimos. No se encontraron registros.',
                    info: 'Mostrando: _START_ de _END_ - Total registros: _TOTAL_',
                    infoEmpty: 'No hay registros aún.',
                    infoFiltered: '(filtrados de un total de _MAX_ registros)',
                    search: 'Búsqueda',
                    LoadingRecords: 'Cargando ...',
                    Processing: 'Procesando...',
                    SearchPlaceholder: 'Comience a teclear...',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente',
                    }
                }
            });
        });
    </script>
    <!-- Fin DataTable -->





<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>