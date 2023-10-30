<style>
    .accesorios-section {
        position: relative;
        /* Resto de los estilos para la sección */
    }

    .accesorios-section:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Cambia el fondo a un color más oscuro */
        filter: brightness(0.9);
        /* Aplica un filtro de brillo para oscurecer el contenido */
    }

    /* Estilos para el botón del modal */
    .accesorios-section .btn-success {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        /* Asegura que esté por encima del contenido */
        opacity: 0;
        /* Botón oculto por defecto */
        transition: opacity 0.6s;
        /* Agrega una transición suave */
    }

    .accesorios-section:hover .btn-success {
        opacity: 6;
        /* Botón visible al pasar el mouse sobre la sección */
    }

    .accesorios-section .content-wrapper {
        transition: background-color 0.3s, filter 0.3s;
        /* Agrega una transición suave para el cambio de fondo y filtro */
    }
</style>

<section class="accesorios-section">
    <?php
    include '../../../conexionbd.php';
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Obtener la cédula pasada por AJAX

    $consulta = "SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[marca] ,[modelo] ,[descripcion] ,[tipo_acc] ,[cantidad] ,[fecha_de_ingreso_acc] ,[fecha_crea] ,[usua_crea] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[observaciones_asigna_acc] ,[link_acc_asigna] ,[observaciones_desasigna_acc] ,[link_acc_desasigna] ,[fechamov] ,[descripcionmov] ,[usuamov] FROM [ControlTIC].[dbo].[asignacion_accesorios] WHERE cedula = '$cedula'";
    $resultado = odbc_exec($conexion, $consulta);

    $output = "<pre>"; // Mantener el formato monoespaciado

    if (odbc_num_rows($resultado) > 0) {
        while ($fila = odbc_fetch_array($resultado)) {

           
        $output .= "-------------------------------------\n";
        $output .= "Elemento:: " . $fila['tipo_maquina'] . "\n";
        $output .= "Memoria RAM: " . $fila['tipo_acc'] . "\n";
        $output .= "Marca : " . $fila['marca'] . "\n";
        $output .= "Modelo:" . $fila['modelo'] . "\n";
        $output .= "Descripcion" . $fila['descripcion'] . "\n";

        $output .= "-------------------------------------\n";
        }
    } else {
        $output .= '<div id="" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sin asignacion de CELULAR</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    $output .= "</pre>";

    odbc_close($conexion);

    echo $output; // Enviar la respuesta al cliente (JavaScript)

    ?>


    <!-- Botón del modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalaccesoriosasigna">
        Ver Detalles
    </button>
</section>

<!-- MODAL DE COMPUTADORES-->
<div class="modal fade" id="modalaccesoriosasigna" tabindex="-1" aria-labelledby="modalaccesoriosasignaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalaccesoriosasignaLabel">
                   <h6> <?php echo $cedula ?></h6>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Dentro del modal-body -->
            <div class="modal-body">

                <table class="table table-bordered dt-responsive table-hover display nowrap" id="mtable" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr class="encabezado table-dark">

                            <th scope="col">ID</th>
                            <th scope="col">ELEMENTO</th>
                            <th scope="col">MARCA</th>
                            <th scope="col">MODELO</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">TIPO DE ACCESORIO</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../conexionbd.php';

                        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';

                        $consulta = "SELECT  [id_asignacion] ,[id] ,[tipo_maquina] ,[marca] ,[modelo] ,[descripcion] ,[tipo_acc] ,[cantidad] ,[fecha_de_ingreso_acc] ,[fecha_crea] ,[usua_crea] ,[cedula] ,[cargo] ,[primernombre] ,[segundonombre] ,[primerapellido] ,[segundoapellido] ,[empresa] ,[observaciones_asigna_acc] ,[link_acc_asigna] ,[observaciones_desasigna_acc] ,[link_acc_desasigna] ,[fechamov] ,[descripcionmov] ,[usuamov] FROM [ControlTIC].[dbo].[asignacion_accesorios] where cedula= '$cedula'";
                        $resultadoConsulta = odbc_exec($conexion, $consulta);

                        if (odbc_num_rows($resultadoConsulta) > 0) {
                            while ($fila = odbc_fetch_array($resultadoConsulta)) {
                                echo '<tr>';

                                echo '<td>' . $fila['id'] . '</td>';
                                echo '<td>' . $fila['tipo_maquina'] . '</td>';
                                echo '<td>' . $fila['marca'] . '</td>';
                                echo '<td>' . $fila['modelo'] . '</td>';
                                echo '<td>' . $fila['descripcion'] . '</td>';
                                echo '<td>' . $fila['tipo_acc'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="38">Sin asignaciones de Celulares</td></tr>';
                        }

                        odbc_close($conexion);
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="saveChangesModalButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>




