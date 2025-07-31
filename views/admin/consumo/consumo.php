<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->



<div class="page-heading" id="contenido-dinamico">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos del consumo</p>
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
                    <a class="nav-link active" href="/admin/tablaConsumo">Tabla Consumo Empaque</a>
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
                        <h4 class="card-title">REGISTRO DE CONTROL EMPAQUE</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/consumo">
                                <div class="row">

                                    <!-- fecha -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="date" id="fecha" class="form-control"
                                                placeholder="Fecha" name="fecha">
                                        </div>
                                    </div>
                                    <!-- turno -->


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="turno">Turno</label>
                                            <input type="number" id="turno" class="form-control"
                                                placeholder="Turno" name="turno">
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">

                                        <label for="personal">Escoja el Personal</label>
                                        <!-- nombre multiple -->
                                        <div class="form-group">
                                            <select class="choices form-select select-light-danger" multiple="multiple" name="personal[]">
                                                <option value="ISRAEL CEDEÑO">ISRAEL CEDEÑO</option>
                                                <option value="FABRICIO TANDAYAMO">FABRICIO TANDAYAMO</option>
                                                <option value="ALEXANDER MOPOSA">ALEXANDER MOPOSA</option>
                                                <option value="MARCO QUIHUIRI">MARCO QUIHUIRI</option>
                                                <option value="GUSTAVO SANCHEZ">GUSTAVO SANCHEZ</option>
                                                <option value="VICTOR MENDEZ">VICTOR MENDEZ</option>
                                                <option value="MILTON COYAGO">MILTON COYAGO</option>
                                                <option value="CRISTIAN ORTIZ">CRISTIAN ORTIZ</option>
                                                <option value="LOURDES FARINANGO">LOURDES FARINANGO</option>
                                                <option value="MERY CHAUCA">MERY CHAUCA</option>
                                                <option value="GINA TUQUERRES">GINA TUQUERRES</option>
                                                <option value="GUADALUPE TOLAGASI">GUADALUPE TOLAGASI</option>
                                                <option value="JESSY BERMEO">JESSY BERMEO</option>
                                                <option value="VIVIANA RUIZ">VIVIANA RUIZ</option>
                                                <option value="PRISCILIA ACHIÑA">PRISCILIA ACHIÑA</option>
                                                <option value="TANYA FERNANDEZ">TANYA FERNANDEZ</option>
                                                <option value="SHIRLEY CETRE">SHIRLEY CETRE</option>
                                                <option value="KATHERIN CARVAJAL">KATHERIN CARVAJAL</option>
                                                <option value="DE LA CRUZ BLANCA">DE LA CRUZ BLANCA</option>
                                                <option value="GLORIA GUALAN">GLORIA GUALAN</option>
                                                <option value="JEFFERSON PINANGO">JEFFERSON PINANGO</option>
                                                <option value="YORVI VILLEGAS">YORVI VILLEGAS</option>
                                                <option value="VERÓNICA LANDETA">VERÓNICA LANDETA</option>
                                                <option value="ALVARO POGO">ALVARO POGO</option>
                                                <option value="EVELYN OVIEDO">EVELYN OVIEDO</option>
                                                <option value="LUIS GOVEA">LUIS GOVEA</option>
                                                <option value="GUILLERMO BONILLA">GUILLERMO BONILLA</option>
                                            </select>
                                        </div>

                                    </div>

                                    <!-- PRODUCTO SELECCIONAR NO MULTIPLE -->
                                    <div class="col-md-6 col-12">
                                        <label for="producto">Escoja el Producto</label>
                                        <div class="form-group">
                                            <select class="form-select" name="producto">
                                                <option value="PRODUCTO 1">PRODUCTO 1</option>
                                                <option value="PRODUCTO 2">PRODUCTO 2</option>
                                                <option value="PRODUCTO 3">PRODUCTO 3</option>
                                                <option value="PRODUCTO 4">PRODUCTO 4</option>
                                                <option value="PRODUCTO 5">PRODUCTO 5</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="medidas">Medida</label>
                                            <input type="text" id="medidas" class="form-control"
                                                placeholder="Medida" name="medidas">
                                        </div>
                                    </div>
                                    <!-- hora de inicio  -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="hora_inicio">Hora de Inicio</label>
                                            <input type="time" id="hora_inicio" class="form-control"
                                                placeholder="Hora de Inicio" name="hora_inicio">
                                        </div>
                                    </div>

                                    <!-- hora de fin  -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="hora_fin">Hora de Fin</label>
                                            <input type="time" id="hora_fin" class="form-control"
                                                placeholder="Hora de Fin" name="hora_fin">
                                        </div>
                                    </div>

                                    <!-- cantidad  -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" id="cantidad" class="form-control"
                                                placeholder="Cantidad" name="cantidad">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Registrar</button>
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

</div>