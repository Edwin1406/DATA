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
                            <form class="form" method="POST" action="/admin/control_troquel">
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
                                            <label for="turnos">Turno</label>
                                            <input type="number" id="turnos" class="form-control"
                                                placeholder="Turno" name="turnos">
                                        </div>
                                    </div>

                                    <!-- area -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="area">Area</label>
                                            <input type="text" id="area" class="form-control"
                                                placeholder="Area" name="area">
                                        </div>
                                    </div>

                                    <!-- OPERADOR SELECCIONAR NO MULTIPLE -->
                                    <div class="col-md-6 col-12">
                                        <label for="operador">Escoja el Operador</label>
                                        <div class="form-group">
                                            <select class="form-select" name="operador">
                                                <option value="Luis Govea">Luis Govea</option>
                                                <option value="Guillermo Bonilla">Guillermo Bonilla</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                   
                                    <!-- hora de inicio  -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="horas_programadas">Hora Programadas</label>
                                            <input type="time" id="horas_programadas" class="form-control"
                                                placeholder="Hora Programadas" name="horas_programadas">
                                        </div>
                                    </div>



                                    <!-- golpes maquina  -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="golpes_maquina">Golpes Maquina</label>
                                            <input type="number" id="golpes_maquina" class="form-control"
                                                placeholder="Golpes Maquina" name="golpes_maquina">
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