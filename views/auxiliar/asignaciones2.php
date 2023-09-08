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



            <section style="margin-top: 100px;">
            </section>





            <!-- SELECT CAPOS EMPRESA / CEDULA Y FICHA TECNICA -->
            <form method="POST">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3" style="margin: 50px 0px 0px 0px;">
                            <label class="form-label">Empresa</label>
                            <select id="empresaSelect" name="empresa" class="form-select" aria-label="Default select example" required>
                                <option selected disabled>SELECCIONE EMPRESA</option>
                                <option value="1">Duquesa S.A. BIC</option>
                                <option value="2">Palmeras del Llano S.A. BIC</option>
                                <option value="3">J25</option>
                            </select>
                        </div>



                        <div class="col-md-2" style="margin: 50px 0px 0px 0px;">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input list="asiste" class="form-control" type="text" id="nombreInput" name="asiste" required>
                                <datalist id="asiste">
                                    <?php
                                    include '../../../conexionbd.php';
                                    $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                                    $result = odbc_exec($conexion, $query);

                                    while ($admon = odbc_fetch_array($result)) {
                                        $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                                        echo '<option value="' . trim($admon['CEDULA']) . '">' . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . '</option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-2" style="margin: 50px 0px 0px 0px;">
                            <label for="" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identificacionInput" placeholder="" name="CEDULA" pattern="[0-9]+" required>
                        </div>

                    </div>
                </div>

            </form>

        </section>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const asisteInput = document.getElementById('nombreInput');
                const identificacionInput = document.getElementById('identificacionInput');
                const asisteDatalist = document.getElementById('asiste');

                asisteInput.addEventListener('change', function() {
                    const selectedOption = asisteDatalist.querySelector(`option[value="${asisteInput.value}"]`);
                    if (selectedOption) {
                        const cedula = selectedOption.textContent.split(' - ')[1];
                        identificacionInput.value = cedula;
                    } else {
                        identificacionInput.value = '';
                    }
                });


                empresaSelect.addEventListener('change', function() {
                    const selectedOptionValue = empresaSelect.value;
                    asisteDatalist.innerHTML = ''; // Limpiar las opciones actuales

                    if (selectedOptionValue === '1') {
                        // Consulta para Duquesa S.A. BIC
                        <?php
                        $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM DUQUESA..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                        $result = odbc_exec($conexion, $query);

                        while ($admon = odbc_fetch_array($result)) {
                            $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                            echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                        }
                        ?>
                    } else if (selectedOptionValue === '2') {
                        // Consulta para Palmeras del Llano S.A. BIC
                        <?php
                        $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM PALMERAS2013..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                        $result = odbc_exec($conexion2, $query);

                        while ($admon = odbc_fetch_array($result)) {
                            $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                            echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                        }
                        ?>
                    } else if (selectedOptionValue === '3') {
                        // Consulta para Palmeras del Llano S.A. BIC
                        <?php
                        $query = "SELECT CEDULA, CODIGO, NOMBRE, NOMBRE2, APELLIDO, APELLIDO2, CARGO FROM J25..MTEMPLEA WHERE YEAR(FECRETIRO) = 2100 ORDER BY NOMBRE ASC;";
                        $result = odbc_exec($conexion2, $query);

                        while ($admon = odbc_fetch_array($result)) {
                            $nombreCompleto = trim(utf8_decode($admon['NOMBRE'])) . ' ' . trim(utf8_decode($admon['NOMBRE2'])) . ' ' . trim(utf8_decode($admon['APELLIDO'])) . ' ' . trim(utf8_decode($admon['APELLIDO2']));
                            echo "asisteDatalist.innerHTML += '<option value=\"" . trim($admon['CEDULA']) . "\">" . $nombreCompleto . ' - ' . trim($admon['CEDULA']) . "</option>';\n";
                        }
                        ?>
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