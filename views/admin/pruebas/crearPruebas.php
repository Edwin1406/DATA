<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos de prueba</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a><?php echo $nombre; ?></a></li>
                        <!--  cerrar sesión -->
                        <li class="breadcrumb-item"><a href="/cerrarSesion">Cerrar Sesión</a></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ¡Registro guardado exitosamente!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['exito']) && $_GET['exito'] == '1') : ?>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                // Mostrar el toast
                var toastEl = document.getElementById('toastExito');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                // Quitar el parámetro ?exito=1 de la URL sin recargar
                const url = new URL(window.location);
                url.searchParams.delete('exito');
                window.history.replaceState({}, document.title, url.toString());
            });
        </script>
    <?php endif; ?>

    <section class="section">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="">Tabla pruebas</a>
                </li>
            </ul>
        </div>
    </section>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">REGISTRO DE PRUEBAS</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/pruebas/crearPruebas" enctype="multipart/form-data">
                                <div class="row">



                                    <!-- 
                                    <div class="col-md-6 col-12">
                                        <label for="tipo_clasificacion">Escoja la clasificación</label>
                                        <div class="form-group">
                                            <select class="form-select" name="tipo_clasificacion" id="tipo_clasificacion">
                                                <option value="CONTROLABLE">CONTROLABLE</option>
                                                <option value="NO_CONTROLABLE">NO CONTROLABLE</option>
                                            </select>
                                        </div>
                                    </div> -->


                                    <!-- quiero tomar el nombre del usuario y si es corruugador solo me parezcan del corrgador-->


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="casos">CASOS</label>
                                            <select id="casos" class="choices form-control" name="casos">
                                                <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un caso</option>

                                                <!-- CONTROLABLES -->
                                                <option value="GALLETEADO">GALLETEADO</option>
                                                <option value="COMBADO">COMBADO</option>
                                                <option value="HUMEDO">HUMEDO</option>
                                                <option value="DESPEGADO">DESPEGADO</option>
                                                <option value="ERROR MEDIDA">ERROR MEDIDA</option>
                                                <option value="SF">SF</option>
                                                <option value="EMPALME">EMPALME</option>
                                                <option value="RECUBRIMIENTO">RECUBRIMIENTO</option>
                                                <option value="PRE PRINTER">PRE PRINTER</option>
                                                <option value="FALTA DE TINTA">FALTA DE TINTA</option>
                                                <option value="MALTRATO TRANSPOTACION">MALTRATO TRANSPOTACION</option>
                                                <option value="MALTRATO MONTACARGUISTA">MALTRATO MONTACARGUISTA</option>
                                                <option value="TONALIDAD TINTAS">TONALIDAD TINTAS</option>
                                                <option value="DERRAME DE TINTA">DERRAME DE TINTA</option>
                                                <option value="VISCOSIDAD">VISCOSIDAD</option>
                                                <option value="PH">PH</option>
                                                <option value="CUADRE">CUADRE</option>
                                                <option value="APROBACION DE COLOR">APROBACION DE COLOR</option>
                                                <option value="FRENO">FRENO</option>
                                                <option value="PRESION">PRESION</option>
                                                <option value="MAL DOBLADO CEJA">MAL DOBLADO CEJA</option>
                                                <option value="EXCESO DE GOMA">EXCESO DE GOMA</option>
                                                <option value="CUADRE SIERRA">CUADRE SIERRA</option>
                                                <option value="CAMBIO DE MEDIDA">CAMBIO DE MEDIDA</option>

                                                <!-- NO CONTROLABLES -->
                                                <option value="DESHOJE">DESHOJE</option>
                                                <option value="TROQUEL">TROQUEL</option>
                                                <option value="FILOS ROTOS">FILOS ROTOS</option>
                                                <option value="DESCUADRE DE DOBLADO">DESCUADRE DE DOBLADO</option>
                                                <option value="COMBADA">COMBADA</option>
                                                <option value="DIFERENCIA DE PESO">DIFERENCIA DE PESO</option>
                                                <option value="REFILES">REFILES</option>
                                                <option value="INICIO DE CORRIDA">INICIO DE CORRIDA</option>
                                                <option value="MONTAJE CLICHE PROVEEDOR">MONTAJE CLICHE PROVEEDOR</option>
                                                <option value="CIREL CORTADO">CIREL CORTADO</option>
                                                <option value="LAMINA HUMEDA">LAMINA HUMEDA</option>
                                                <option value="MERMA">MERMA</option>
                                                <option value="EXCEDENTES DE PLANCHA">EXCEDENTES DE PLANCHA</option>
                                                <option value="MECANICO">MECANICO</option>
                                                <option value="ELECTRICO">ELECTRICO</option>
                                                <option value="PEDIDOS CORTOS">PEDIDOS CORTOS</option>
                                                <option value="SUSTRATO">SUSTRATO</option>
                                                <option value="DIFERENTES ANCHOS">DIFERENTES ANCHOS</option>
                                                <option value="REFILE PEQUEÑO">REFILE PEQUEÑO</option>
                                                <option value="CAMBIO DE GRAMAJE">CAMBIO DE GRAMAJE</option>
                                                <option value="EXTRA TRIM">EXTRA TRIM</option>
                                                <option value="CAMBIO PEDIDO">CAMBIO PEDIDO</option>
                                                <option value="ERROR MEDIDA CORRUGADOR">ERROR MEDIDA CORRUGADOR</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- cantidad cajas  -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad (Kg)</label>
                                            <input type="number" id="cantidad" class="form-control"
                                                placeholder="Cantidad" name="cantidad">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Agregar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Tabla de Pruebas
            </div>

            <div class="card-body">

                <!-- Contenedor responsive -->
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="table1">
                        <thead>
                            <tr>
                                <th class="fs-6" style="min-width: 90px;">ID</th>
                                <th class="fs-6" style="min-width: 90px;">id_usuario</th>
                                <th class="fs-6" style="min-width: 90px;">tipo_maquina</th>
                                <!-- <th class="fs-6" style="min-width: 90px;">tipo_clasificacion</th> -->
                                <th class="fs-6" style="min-width: 90px;">casos</th>
                                <th class="fs-6" style="min-width: 80px;">Cantidad</th>

                                <th class="fs-6" style="min-width: 100px;">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($carritoTemporal as $contro): ?>
                                <tr>
                                    <td><?= $contro->id ?></td>
                                    <td><?= $contro->id_usuario ?></td>
                                    <td><?= $contro->tipo_maquina ?></td>
                                    <td><?= $contro->casos ?></td>
                                    <td><?= $contro->cantidad ?></td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            <!-- <a href="/admin/editarConsumo?id=<?= $contro->id ?>" class="btn btn-primary btn-sm">Editar</a> -->
                                            <form action="/admin/eliminarCarrito" method="POST">
                                                <input type="hidden" name="id" value="<?= $contro->id ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td><b>Total</b></td>
                                <td>$<?= array_sum(array_column($carritoTemporal, 'cantidad'))  ?></td>

                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <form action="/admin/pruebas/registrarVenta" method="POST">
                    <div class="row">
                        <!-- columna 1 -->
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" class="form-control"
                                    name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="consumo_papel">Consumo papel (Kg)</label>
                                <input type="number" step="0.01" id="consumo_papel"
                                    class="form-control" name="consumo_papel" required>
                            </div>
                        </div>

                        <!-- columna 2 -->
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="metros_lineales">Metros Lineales</label>
                                <input type="number" id="metros_lineales" class="form-control"
                                    placeholder="Metros Lineales" name="metros_lineales">
                            </div>

                            <div class="form-group">
                                <label for="n_laminas">N° de Laminas</label>
                                <input type="number" id="n_laminas" class="form-control"
                                    placeholder="N° de Laminas" name="n_laminas">
                            </div>
                        </div>

                        <!-- columna 3 -->
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="n_cambios">N° de Cambios</label>
                                <input type="number" id="n_cambios" class="form-control"
                                    placeholder="N° de Cambios" name="n_cambios">
                            </div>

                            <div class="form-group">
                                <label for="consumo_almidon">Consumo Almidón (Kg)</label>
                                <input type="number" step="0.01" id="consumo_almidon" class="form-control"
                                    placeholder="Consumo Almidón (Kg)" name="consumo_almidon">
                            </div>
                        </div>

                        <!-- columna 4 -->
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="consumo_resina">Consumo Resina (Kg)</label>
                                <input type="number" step="0.01" id="consumo_resina" class="form-control"
                                    placeholder="Consumo Resina (Kg)" name="consumo_resina">
                            </div>

                            <div class="form-group">
                                <label for="consumo_recubrimiento">Consumo Recubrimiento (Kg)</label>
                                <input type="number" step="0.01" id="consumo_recubrimiento" class="form-control"
                                    placeholder="Consumo Recubrimiento (Kg)" name="consumo_recubrimiento">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <!-- SELECT DE FLAUTA -->
                            <div class="form-group">
                                <label for="tipo_flauta">Tipo de Flauta</label>
                                <select class="form-select" name="tipo_flauta" id="tipo_flauta">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="E">E</option>
                                    <option value="BC">BC</option>
                                    <option value="AC">AC</option>
                                </select>


                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Registrar Sucesos</button>
                    </div>
                </form>








            </div>
            <!-- boton de registrar -->
        </div>
    </section>

    <!-- CSS opcional para evitar que se rompa texto en celdas -->
    <style>
        #table1 th,
        #table1 td {
            white-space: nowrap;
        }
    </style>









</div>