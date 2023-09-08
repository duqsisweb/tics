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
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        COMPUTADORES
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                                            <thead>
                                                <tr class="encabezado table-dark">
                                                    <th scope="col">ID</th>
                                                    <th>Estado</th>
                                                    <th>Service Tag</th>
                                                    <th>Nombre Equipo</th>
                                                    <th>Nombre Sede</th>
                                                    <th>Marca</th>
                                                    <th>Tipo Comp.</th>
                                                    <th>Ram</th>
                                                    <th>Capacidad Disco</th>
                                                    <th>Propietario</th>
                                                    <th>Proveedor</th>
                                                    <th>Sistema O.</th>
                                                    <th>Ajustar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT  
                                                        mc.[id],
                                                        e2.[nombre_estado] AS [Estado],
                                                        mc.[Service_tag],
                                                        mc.[Nombre_equipo],
                                                        s.[nombre_sede] AS [Nombre_sede],
                                                        mc.[Marca_computador],
                                                        tc.[nombre_tipo_comp] AS [Nombre_tipo_comp],
                                                        mc.[Memoria_ram],
                                                        cd.[capacidad_discoduro] AS [Capacidad_discoduro],
                                                        p.[descripcion] AS [Propietario],
                                                        mc.[Proveedor],
                                                        so.[nombre_sistema_operativo] AS [Sistema_Operativo]
                                                
                                                    FROM [ControlTIC].[dbo].[maquina_computador] AS mc
                                                    JOIN [ControlTIC].[dbo].[sede] AS s ON mc.[Sede] = s.[id]
                                                    JOIN [ControlTIC].[dbo].[empresa] AS e ON mc.[Empresa] = e.[id]
                                                    JOIN [ControlTIC].[dbo].[tipo_comp] AS tc ON mc.[Tipo_comp] = tc.[id]
                                                    JOIN [ControlTIC].[dbo].[tipo_discoduro] AS td ON mc.[Tipo_discoduro] = td.[id]
                                                    JOIN [ControlTIC].[dbo].[capacidad_discoduro] AS cd ON mc.[Capacidad_discoduro] = cd.[id]
                                                    JOIN [ControlTIC].[dbo].[propietario] AS p ON mc.[Propietario] = p.[id]
                                                    JOIN [ControlTIC].[dbo].[sistema_operativo] AS so ON mc.[Sistema_Operativo] = so.[id]
                                                    JOIN [ControlTIC].[dbo].[estado] AS e2 ON mc.[Estado] = e2.[id]";

                                                $result = odbc_exec($conexion, $sql);

                                                if ($result !== false) {
                                                    while ($row = odbc_fetch_array($result)) {
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
                                                            echo '<button type="button" class="btn btn-warning btn-ajustar asignar-btn" data-id="' . $row['id'] . '">AJUSTAR</button>';
                                                            echo '</td>';
                                                        } else {
                                                            echo '<td></td>'; // Espacio en blanco si el estado es "Asignado"
                                                        }

                                                        echo "</tr>";
                                                    }
                                                    odbc_free_result($result);
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        CELULARES
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        ACCESORIOS
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </section>




    </html>

    <script>
        $(document).ready(function() {
            // Cuando se hace clic en un botón con la clase "btn-ajustar"
            $('.btn-ajustar').click(function() {
                // Obtener el valor seleccionado en el select
                var selectedValue = $(this).closest('tr').find('.estado-select').val();

                // Obtener el idToUpdate del botón
                var idToUpdate = $(this).data('id'); // Obtener el valor de data-id

                console.log("Valor seleccionado en el select:", selectedValue);
                console.log("ID a actualizar:", idToUpdate);

                // Realizar la solicitud AJAX para actualizar el estado en la base de datos
                $.ajax({
                    type: "POST",
                    url: "estados/actualizar_estado.php",
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


<?php } else { ?>
    <script languaje "JavaScript">
        alert("Acceso Incorrecto");
        window.location.href = "../login.php";
    </script><?php
            } ?>