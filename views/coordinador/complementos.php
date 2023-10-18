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
    <?php require '../../views/head.php'; ?>

    <body>



        <!-- NAV -->
        <?php require '../../views/nav.php'; ?>



        <section style="margin-top: 100px;">


            <?php require '../../views/navinventario.php'; ?>


            <div class="container-fluid" style="text-align: center;margin-bottom: 30px;">
                <div class="container">
                    <div>
                        <h3>AGREGAR COMPLEMENTOS</h3>
                    </div>
                </div>
            </div>

            <!-- MEMORIA RAM -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/image/tipo_ram.png" class="card-img-top mx-auto" alt="..." style="margin-top: 10px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Tipo de Memoria Ram</h5>
                                        <p class="card-text">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtableTipoRam" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>TIPO RAM</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llama a la función y almacena los resultados en $equipos
                                                $equipos = agregartipomemoriaram($conexion);

                                                // Itera sobre los resultados y muestra cada fila de la tabla
                                                foreach ($equipos as $equipo) {
                                                    echo "<tr>";
                                                    echo "<td>" . $equipo['nombre_tipo_ram'] . "</td>";

                                                    echo "<td><button type=\"button\" class=\"btn btn-success \" onclick=\"agregarCampoTipoRam('" . $equipo['id'] . "', '" . $equipo['nombre_tipo_ram'] . "')\">+</button></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/image/ram.png" class="card-img-top mx-auto" alt="..." style="margin-top: 10px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Capacidad Memoria Ram</h5>
                                        <p class="card-text">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablecapacidadram" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>CAPACIDAD RAM</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llama a la función y almacena los resultados en $equipos
                                                $equipos = agregarcantidadmemoriaram($conexion);

                                                // Itera sobrequipose los resultados y muestra cada fila de la tabla
                                                foreach ($equipos as $equipo) {
                                                    echo "<tr>";
                                                    echo "<td>" . $equipo['capacidad_ram'] . "</td>";

                                                    echo "<td><button type=\"button\" class=\"btn btn-success \" onclick=\"agregarcapacidadram('" . $equipo['id'] . "', '" . $equipo['capacidad_ram'] . "')\">+</button></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- DISCO DURO -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">


                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/image/tipo_disco_duro.png" class="card-img-top mx-auto" alt="..." style="margin-top: 10px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Tipo Disco Duro</h5>
                                        <p class="card-text">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtableTipodiscoduro" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>TIPO DISO DURO</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llama a la función y almacena los resultados en $equipos
                                                $equipos = agregartipodiscoduro($conexion);

                                                // Itera sobre los resultados y muestra cada fila de la tabla
                                                foreach ($equipos as $equipo) {
                                                    echo "<tr>";
                                                    echo "<td>" . $equipo['nombre_tipo_discoduro'] . "</td>";

                                                    echo "<td><button type=\"button\" class=\"btn btn-success \" onclick=\"agregarCampoTipodiscoduro('" . $equipo['id'] . "', '" . $equipo['nombre_tipo_discoduro'] . "')\">+</button></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/image/discoduro.png" class="card-img-top mx-auto" alt="..." style="margin-top: 10px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Capacidad Disco Duro</h5>
                                        <p class="card-text">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablecapacidaddiscoduro" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>CAPACIDAD DISCO DURO</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llama a la función y almacena los resultados en $equipos
                                                $equipos = agregarcapacidaddiscoduro($conexion);

                                                // Itera sobre los resultados y muestra cada fila de la tabla
                                                foreach ($equipos as $equipo) {
                                                    echo "<tr>";
                                                    echo "<td>" . $equipo['capacidad_discoduro'] . "</td>";

                                                    echo "<td><button type=\"button\" class=\"btn btn-success \" onclick=\"agregarCampocapacidaddiscoduro('" . $equipo['id'] . "', '" . $equipo['capacidad_discoduro'] . "')\">+</button></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- SISTEMA OPERATIVO -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">


                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/image/so.png" class="card-img-top mx-auto" alt="..." style="margin-top: 10px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Sistemas Operativos</h5>
                                        <p class="card-text">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablesistemaoperativo" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>NOMBRE</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llama a la función y almacena los resultados en $equipos
                                                $equipos = agregarsistemaoperativo($conexion);

                                                // Itera sobre los resultados y muestra cada fila de la tabla
                                                foreach ($equipos as $equipo) {
                                                    echo "<tr>";
                                                    echo "<td>" . $equipo['nombre_sistema_operativo'] . "</td>";

                                                    echo "<td><button type=\"button\" class=\"btn btn-success \" onclick=\"agregarCamposistemaoperativo('" . $equipo['id'] . "', '" . $equipo['nombre_sistema_operativo'] . "')\">+</button></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <!-- <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../../assets/image/discoduro.png" class="card-img-top mx-auto" alt="..." style="margin-top: 10px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Capacidad Disco Duro</h5>
                                        <p class="card-text">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtablecapacidaddiscoduro" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th>CAPACIDAD DISCO DURO</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llama a la función y almacena los resultados en $equipos
                                                $equipos = agregarcapacidaddiscoduro($conexion);

                                                // Itera sobre los resultados y muestra cada fila de la tabla
                                                foreach ($equipos as $equipo) {
                                                    echo "<tr>";
                                                    echo "<td>" . $equipo['capacidad_discoduro'] . "</td>";

                                                    echo "<td><button type=\"button\" class=\"btn btn-success \" onclick=\"agregarCampocapacidaddiscoduro('" . $equipo['id'] . "', '" . $equipo['capacidad_discoduro'] . "')\">+</button></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>

                </div>
            </div>


        </section>
    </body>

    </html>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- SCRIPT TIPO MEMORIA RAM -->
    <script>
        function agregarCampoTipoRam(id, nombreTipoRam) {
            var newRow = $("<tr>");
            newRow.append("<td><input type='text' name='nombre_tipo_ram[]' value='" + nombreTipoRam + "'></td>");
            newRow.append("<td><button type='button' class='btn btn-primary' onclick='guardarTipoRam(" + id + ")'>Guardar</button> <button type='button' class='btn btn-danger' onclick='cancelarTipoRam(this)'>Cancelar</button></td>");
            $("#mtableTipoRam tbody").append(newRow);

            // Oculta solo el botón "+" en la fila actual
            $(newRow).find(".btn-success").hide();
        }

        function cancelarTipoRam(button) {
            // Puedes usar $(button) para acceder al botón que se hizo clic y luego subir al elemento tr padre para eliminar la fila
            $(button).closest("tr").remove();
        }



        function guardarTipoRam(id) {
            var nombreTipoRam = $("input[name='nombre_tipo_ram[]']").last().val();

            // Mostrar SweetAlert2 para confirmar la acción
            Swal.fire({
                title: '¿QUIERE GUARDAR LOS CAMBIOS?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'GUARDAR',
                denyButtonText: `CANCELAR`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario ha confirmado la acción, ejecutar el AJAX
                    $.ajax({
                        type: "POST",
                        url: "complementos/agregar_tipo_ram.php",
                        data: {
                            id: id,
                            nombre_tipo_ram: nombreTipoRam
                        },
                        success: function(response) {
                            // Maneja la respuesta de tu script de inserción aquí
                            console.log(response);

                            // Oculta el botón de guardar en la fila actual
                            $("tr:last").find(".btn-primary").hide();

                            // Muestra SweetAlert2 de éxito
                            Swal.fire('¡GUARDADO!', '', 'success').then(() => {
                                // Recarga la página después de la confirmación
                                location.reload();
                            });
                        }
                    });
                } else if (result.isDenied) {
                    // El usuario ha denegado la acción
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        }
    </script>

    <!-- SCRIPT CAPACIDAD MEMORIA RAM -->
    <script>
        function agregarcapacidadram(id, capacidad_ram) {
            var newRow = $("<tr>");
            newRow.append("<td><input type='text' name='capacidad_ram[]' value='" + capacidad_ram + "'></td>");
            newRow.append("<td><button type='button' class='btn btn-primary' onclick='guardarcapacidadram(" + id + ")'>Guardar</button> <button type='button' class='btn btn-danger' onclick='cancelarcapacidadram(this)'>Cancelar</button></td>");
            $("#mtablecapacidadram tbody").append(newRow);

            // Oculta solo el botón "+" en la fila actual
            $(newRow).find(".btn-success").hide();
        }

        function cancelarcapacidadram(button) {
            // Puedes usar $(button) para acceder al botón que se hizo clic y luego subir al elemento tr padre para eliminar la fila
            $(button).closest("tr").remove();
        }



        function guardarcapacidadram(id) {
            var capacidad_ram = $("input[name='capacidad_ram[]']").last().val();

            // Mostrar SweetAlert2 para confirmar la acción
            Swal.fire({
                title: '¿QUIERE GUARDAR LOS CAMBIOS?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'GUARDAR',
                denyButtonText: `CANCELAR`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario ha confirmado la acción, ejecutar el AJAX
                    $.ajax({
                        type: "POST",
                        url: "complementos/agregar_capacidad_ram.php",
                        data: {
                            id: id,
                            capacidad_ram: capacidad_ram
                        },
                        success: function(response) {
                            // Maneja la respuesta de tu script de inserción aquí
                            console.log(response);

                            // Oculta el botón de guardar en la fila actual
                            $("tr:last").find(".btn-primary").hide();

                            // Muestra SweetAlert2 de éxito
                            Swal.fire('¡GUARDADO!', '', 'success').then(() => {
                                // Recarga la página después de la confirmación
                                location.reload();
                            });
                        }
                    });
                } else if (result.isDenied) {
                    // El usuario ha denegado la acción
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        }
    </script>

    <!-- SCRIPT TIPO DISCO DURO -->
    <script>
        function agregarCampoTipodiscoduro(id, nombreTipodiscoduro) {
            var newRow = $("<tr>");
            newRow.append("<td><input type='text' name='nombre_tipo_discoduro[]' value='" + nombreTipodiscoduro + "'></td>");
            newRow.append("<td><button type='button' class='btn btn-primary' onclick='guardarTipodiscoduro(" + id + ")'>Guardar</button> <button type='button' class='btn btn-danger' onclick='cancelarTipodiscoduro(this)'>Cancelar</button></td>");
            $("#mtableTipodiscoduro tbody").append(newRow);

            // Oculta solo el botón "+" en la fila actual
            $(newRow).find(".btn-success").hide();
        }

        function cancelarTipodiscoduro(button) {
            // Puedes usar $(button) para acceder al botón que se hizo clic y luego subir al elemento tr padre para eliminar la fila
            $(button).closest("tr").remove();
        }



        function guardarTipodiscoduro(id) {
            var nombreTipodiscoduro = $("input[name='nombre_tipo_discoduro[]']").last().val();

            // Mostrar SweetAlert2 para confirmar la acción
            Swal.fire({
                title: '¿QUIERE GUARDAR LOS CAMBIOS?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'GUARDAR',
                denyButtonText: `CANCELAR`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario ha confirmado la acción, ejecutar el AJAX
                    $.ajax({
                        type: "POST",
                        url: "complementos/agregar_tipo_discoduro.php",
                        data: {
                            id: id,
                            nombre_tipo_discoduro: nombreTipodiscoduro
                        },
                        success: function(response) {
                            // Maneja la respuesta de tu script de inserción aquí
                            console.log(response);

                            // Oculta el botón de guardar en la fila actual
                            $("tr:last").find(".btn-primary").hide();

                            // Muestra SweetAlert2 de éxito
                            Swal.fire('¡GUARDADO!', '', 'success').then(() => {
                                // Recarga la página después de la confirmación
                                location.reload();
                            });
                        }
                    });
                } else if (result.isDenied) {
                    // El usuario ha denegado la acción
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        }
    </script>

    <!-- SCRIPT CAPACIDAD DISCO DURO-->
    <script>
        function agregarCampocapacidaddiscoduro(id, capacidaddiscoduro) {
            var newRow = $("<tr>");
            newRow.append("<td><input type='text' name='capacidad_discoduro[]' value='" + capacidaddiscoduro + "'></td>");
            newRow.append("<td><button type='button' class='btn btn-primary' onclick='guardarcapacidaddiscoduro(" + id + ")'>Guardar</button> <button type='button' class='btn btn-danger' onclick='cancelarcapacidaddiscoduro(this)'>Cancelar</button></td>");
            $("#mtablecapacidaddiscoduro tbody").append(newRow);

            // Oculta solo el botón "+" en la fila actual
            $(newRow).find(".btn-success").hide();
        }

        function cancelarcapacidaddiscoduro(button) {
            // Puedes usar $(button) para acceder al botón que se hizo clic y luego subir al elemento tr padre para eliminar la fila
            $(button).closest("tr").remove();
        }



        function guardarcapacidaddiscoduro(id) {
            var capacidaddiscoduro = $("input[name='capacidad_discoduro[]']").last().val();

            // Mostrar SweetAlert2 para confirmar la acción
            Swal.fire({
                title: '¿QUIERE GUARDAR LOS CAMBIOS?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'GUARDAR',
                denyButtonText: `CANCELAR`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario ha confirmado la acción, ejecutar el AJAX
                    $.ajax({
                        type: "POST",
                        url: "complementos/agregar_capacidad_discoduro.php",
                        data: {
                            id: id,
                            capacidad_discoduro: capacidaddiscoduro
                        },
                        success: function(response) {
                            // Maneja la respuesta de tu script de inserción aquí
                            console.log(response);

                            // Oculta el botón de guardar en la fila actual
                            $("tr:last").find(".btn-primary").hide();

                            // Muestra SweetAlert2 de éxito
                            Swal.fire('¡GUARDADO!', '', 'success').then(() => {
                                // Recarga la página después de la confirmación
                                location.reload();
                            });
                        }
                    });
                } else if (result.isDenied) {
                    // El usuario ha denegado la acción
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        }
    </script>


    <!-- SCRIPT SISTEMA OPERATIVO-->
    <script>
        function agregarCamposistemaoperativo(id, nombre_sistema_operativo) {
            var newRow = $("<tr>");
            newRow.append("<td><input type='text' name='nombre_sistema_operativo[]' value='" + nombre_sistema_operativo + "'></td>");
            newRow.append("<td><button type='button' class='btn btn-primary' onclick='guardarsistemaoperativo(" + id + ")'>Guardar</button> <button type='button' class='btn btn-danger' onclick='cancelarsistemaoperativo(this)'>Cancelar</button></td>");
            $("#mtablesistemaoperativo tbody").append(newRow);

            // Oculta solo el botón "+" en la fila actual
            $(newRow).find(".btn-success").hide();
        }

        function cancelarsistemaoperativo(button) {
            // Puedes usar $(button) para acceder al botón que se hizo clic y luego subir al elemento tr padre para eliminar la fila
            $(button).closest("tr").remove();
        }



        function guardarsistemaoperativo(id) {
            var nombre_sistema_operativo = $("input[name='nombre_sistema_operativo[]']").last().val();

            // Mostrar SweetAlert2 para confirmar la acción
            Swal.fire({
                title: '¿QUIERE GUARDAR LOS CAMBIOS?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'GUARDAR',
                denyButtonText: `CANCELAR`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario ha confirmado la acción, ejecutar el AJAX
                    $.ajax({
                        type: "POST",
                        url: "complementos/agregar_sistema_operativo.php",
                        data: {
                            id: id,
                            nombre_sistema_operativo: nombre_sistema_operativo
                        },
                        success: function(response) {
                            // Maneja la respuesta de tu script de inserción aquí
                            console.log(response);

                            // Oculta el botón de guardar en la fila actual
                            $("tr:last").find(".btn-primary").hide();

                            // Muestra SweetAlert2 de éxito
                            Swal.fire('¡GUARDADO!', '', 'success').then(() => {
                                // Recarga la página después de la confirmación
                                location.reload();
                            });
                        }
                    });
                } else if (result.isDenied) {
                    // El usuario ha denegado la acción
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        }
    </script>

<?php } else { ?>
    <script language="JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script>
<?php } ?>