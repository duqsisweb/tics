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
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        COMPUTADORES
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                                        CELULARES
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablecelular" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>ID</th>
                                                    <th>ESTADO</th>
                                                    <th>IMEI</th>
                                                    <th>SERIAL</th>
                                                    <th>MARCA</th>
                                                    <th>MODELO</th>
                                                    <th></th>
                                                    <th>CAPACIDAD</th>
                                                    <th>RAM</th>
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
                                        ACCESORIOS
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
                                       ELEMENTOS DE COMUNICACIÓN
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtableedcomunicacion" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">

                                                    <th>ID</th>
                                                    <th>Estado</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Descip</th>
                                                    <th>Serial</th>
                                                    <th>Sede</th>
                                                    <th></th>
                                                    <th>Observaciones</th>
                                                    <th>Ajustar</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $datosEquipos = obtenerDatosEquiposedcomunicacionasignados($conexion); // Llama a la función para obtener los datos
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
                                                        echo '<button type="button" class="btn btn-warning btn-ajustaredcomunicacion asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        PERIFERICOS
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtableperifericos" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">

                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>AJUSTAR</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $datosEquipos = obtenerDatosEquiposperifericosasignados($conexion); // Llama a la función para obtener los datos
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
                                                        echo '<button type="button" class="btn btn-warning btn-ajustarperifericos asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        ALMACENAMIENTO
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablealmacenamiento" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">

                                                    <th>ID</th>
                                                    <th>ESTADO</th>
                                                    <th>MARCA</th>
                                                    <th>MODELO</th>
                                                    <th>TIPO</th>
                                                    <th>CAPACIDAD</th>
                                                    <th>TIPO</th>
                                                    <th>CARACTERISTICA</th>
                                                    <th>SEDE</th>
                                                    <th>UBICACIÓN</th>
                                                    <th>AJUSTAR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $datosEquipos = obtenerDatosEquiposalmacenamientoasignados($conexion); // Llama a la función para obtener los datos
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
                                                        echo '<button type="button" class="btn btn-warning btn-ajustaralmacenamiento asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        SIM CARD
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablesimcard" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>ID</th>
                                                    <th>ESTADO</th>
                                                    <th>LINEA</th>
                                                    <th>PLAN</th>
                                                    <th>APERTURA</th>
                                                    <th>VALOR</th>
                                                    <th>OPERADOR</th>
                                                    <th>COD CLIENTE</th>
                                                    <th>OBSERVACIONES</th>
                                                    <th>FIN PLAN</th>
                                                    <th>AJUSTAR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $datosEquipos = obtenerDatosEquipossimcardasignados($conexion); // Llama a la función para obtener los datos
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
                                                        echo '<button type="button" class="btn btn-warning btn-ajustarsimcard asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        DVR
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtabledvr" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>ID</th>
                                                    <th>ESTADO</th>
                                                    <th>MARCA</th>
                                                    <th>DESCRIPCIÓN</th>
                                                    <th>CAPACIDAD</th>
                                                    <th>SEDE</th>
                                                    <th>UBICACIÓN</th>
                                                    <th>CANALES</th>
                                                    <th>D</th>
                                                    <th>H</th>
                                                    <th>IP</th>
                                                    <th>AJUSTES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $datosEquipos = obtenerDatosEquiposdvrdasignados($conexion); // Llama a la función para obtener los datos
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
                                                        echo '<button type="button" class="btn btn-warning btn-ajustardvr asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
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
    <!-- AJAX EDCOMUNICACION -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustaredcomunicacion').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_edcomunicacion.php",
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
    <!-- AJAX PERIFERICOS -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustarperifericos').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_perifericos.php",
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
    <!-- AJAX ALMACENAMIENTO -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustaralmacenamiento').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_almacenamiento.php",
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
    <!-- AJAX ALMACENAMIENTO -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustarsimcard').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_simcard.php",
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
    <!-- AJAX DVR -->
    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustardvr').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/estado_dvr.php",
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

    <!-- Inicio DataTable CELULAR-->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtablecelular').DataTable({
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

    <!-- Inicio DataTable ACCESORIOS-->
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

    <!-- Inicio DataTable ED COMUNICACION-->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtableedcomunicacion').DataTable({
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

    <!-- Inicio DataTable ED PERIFERICOS-->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtableperifericos').DataTable({
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

    <!-- Inicio DataTable ED PERIFERICOS-->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtablealmacenamiento').DataTable({
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



    <!-- Inicio DataTable DVR -->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtablesimcard').DataTable({
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

    <!-- Inicio DataTable DVR -->
    <script type="text/javascript">
        $(document).ready(function() {
            var lenguaje = $('#mtabledvr').DataTable({
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