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

            </ul>
        </div>
    </section>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">EDITAR DOBLADO</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/pruebas/editarDoblado?id=<?php echo $id; ?>" enctype="multipart/form-data" onsubmit="return bloquearBoton(this)">
                                <div class="row">





                                    <!-- cantidad cajas deciamles soporte  -->
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="consumo_papel">Consumo papel</label>
                                            <input type="number" id="consumo_papel" class="form-control"
                                                placeholder="Consumo papel" name="consumo_papel" step="0.01"
                                                value="<?php echo $doblado->consumo_papel ?>"

                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="n_laminas">N laminas</label>
                                            <input type="number" id="n_laminas" class="form-control"
                                                placeholder="N laminas" name="n_laminas" step="0.01"
                                                value="<?php echo $doblado->n_laminas ?>"
                                                readonly>
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="operador">OPERADOR</label>
                                            <select id="operador" class="choices form-control" name="operador">
                                                <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un operador</option>
                                                <!-- CONTROLABLES -->
                                                <option value="MILTON COYAGO" <?php echo (isset($doblado->operador) && $doblado->operador === 'MILTON COYAGO') ? 'selected' : ''; ?>>MILTON COYAGO</option>
                                                <option value="RAFAEL LOPEZ" <?php echo (isset($doblado->operador) && $doblado->operador === 'RAFAEL LOPEZ') ? 'selected' : ''; ?>>RAFAEL LOPEZ</option>
                                                <option value="GUSTAVO SANCHEZ" <?php echo (isset($doblado->operador) && $doblado->operador === 'GUSTAVO SANCHEZ') ? 'selected' : ''; ?>>GUSTAVO SANCHEZ</option>
                                                <option value="MARCO QUIHUIRI" <?php echo (isset($doblado->operador) && $doblado->operador === 'MARCO QUIHUIRI') ? 'selected' : ''; ?>>MARCO QUIHUIRI</option>
                                                <option value="ALEXANDER MOPOSA" <?php echo (isset($doblado->operador) && $doblado->operador === 'ALEXANDER MOPOSA') ? 'selected' : ''; ?>>ALEXANDER MOPOSA</option>
                                            </select>
                                        </div>
                                    </div>


                                <!-- hora_inicio -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="hora_inicio">Hora Inicio</label>
                                            <input type="time" id="hora_inicio" class="form-control"
                                                placeholder="Hora Inicio" name="hora_inicio"
                                                value="<?php echo $doblado->hora_inicio ?>"

                                                >
                                        </div>
                                    </div>

                                    <!-- hora_fin -->
                                    <!-- hora_fin -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="hora_fin">Hora Fin</label>
                                            <input type="time" id="hora_fin" class="form-control"
                                            placeholder="Hora Fin" name="hora_fin"
                                            value="<?php echo $doblado->hora_fin ?>"
                                            
                                            >
                                        </div>
                                    </div>
                                    
                                    <!-- tiempo_inactivo -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tiempo_inactivo">Tiempo Inactivo</label>
                                            <input type="text" id="tiempo_inactivo" class="form-control"
                                            placeholder="Tiempo Inactivo" name="tiempo_inactivo"
                                            value="<?php echo $doblado->tiempo_inactivo ?>"
                                            >
                                        </div>
                                    </div>
                                    
                                    <!-- motivo_inactividad -->
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="motivo_inactividad">Motivo de Inactividad</label>
                                            <input type="text" id="motivo_inactividad" class="form-control"
                                                placeholder="Motivo de Inactividad" name="motivo_inactividad"
                                                value="<?php echo $doblado->motivo_inactividad ?>"

                                                >
                                        </div>
                                    </div>

                                    
















                                    <!-- observaciones -->

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <input type="text" id="observaciones" class="form-control"
                                                placeholder="Observaciones" name="observaciones">
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