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
                    <a class="nav-link active" href="/admin/pruebas/tablaPruebas">Tabla pruebas</a>
                </li>
            </ul>
        </div>
    </section>


    <section class="section">
        <div class="card">
            <div class="card-header">
                Tabla de Pruebas
            </div>

            <div class="card-body">

                <form action="/admin/pruebas/registrarVenta" method="POST">
                    <!-- Fila 1 -->
                    <div class="row g-3">
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" class="form-control"
                                    name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="consumo_papel">Consumo papel (Kg)</label>
                                <input type="number" step="0.01" id="consumo_papel"
                                    class="form-control" placeholder="Consumo papel (Kg)" name="consumo_papel" required>
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="n_laminas">N° de Laminas</label>
                                <input type="number" id="n_laminas" class="form-control"
                                    placeholder="N° de Laminas" name="n_laminas">
                            </div>
                        </div>


                        <div class="col-md-2 col-12 ">

                            <div class="form-group">
                                <label for="metros_lineales">Metros Lineales</label>
                                <input type="number" id="metros_lineales" class="form-control"
                                    placeholder="Metros Lineales" name="metros_lineales">
                            </div>

                        </div>



                        <div class="col-md-2 col-12 ">

                            <div class="form-group">
                                <label for="turno">Turno</label>
                                <input type="time" id="turno" class="form-control"
                                    placeholder="Turno" name="turno">
                            </div>

                        </div>


                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="n_cambios">N° de Cambios</label>
                                <input type="number" id="n_cambios" class="form-control"
                                    placeholder="N° de Cambios" name="n_cambios">
                            </div>
                        </div>


                        <!-- fecha inicio -->
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="hora_inicio">Hora Inicio</label>
                                <input type="time" id="hora_inicio" class="form-control"
                                    name="hora_inicio" required>

                            </div>
                        </div>

                        <!-- fecha fin -->
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="hora_fin">Hora Fin</label>
                                <input type="time" id="hora_fin" class="form-control"
                                    name="hora_fin" required>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="operador">OPERADOR</label>
                                <select id="operador" class="choices form-control" name="operador">
                                    <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un operador</option>

                                    <!-- CONTROLABLES -->
                                    <option value="RAFAEL ORTEGA">RAFAEL ORTEGA</option>
                                    <option value="GEOVANNY MANTILLA">GEOVANNY MANTILLA</option>
                                    <option value="WILLIAM NAULA">WILLIAM NAULA</option>
                                    <option value="MARCO TAPIA">MARCO TAPIA</option>
                                    <option value="KEVIN DELGADO">KEVIN DELGADO</option>
                                    <option value="MENTOR">MENTOR</option>

                                </select>

                            </div>
                        </div>

                        <!-- horas de inactividad -->
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="motivo_inactividad">Motivo de la Inactividad</label>
                                <textarea id="motivo_inactividad" class="form-control" name="motivo_inactividad" placeholder="Describe el motivo de la inactividad" rows="3"></textarea>
                            </div>
                        </div>




                    </div>


                    <!-- Botón -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Registrar </button>
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




    <script>
        function bloquearBoton(form) {
            const btn = form.querySelector('#btnRegistrar');
            btn.disabled = true; // Deshabilita el botón
            btn.innerText = "Registrando..."; // Cambia el texto (opcional)
            return true; // Permite que el formulario se envíe
        }
    </script>



</div>