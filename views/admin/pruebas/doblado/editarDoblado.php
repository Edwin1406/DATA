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
                    <a class="nav-link active" href="/admin/pruebas/tablaDoblado">Tabla Doblado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#inlineForm" style="border: 1px solid;" data-bs-toggle="modal">DESPERDICIOS</a>
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
                        <h4 class="card-title">EDITAR DOBLADO</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/pruebas/crearDoblado" enctype="multipart/form-data" onsubmit="return bloquearBoton(this)">
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


                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="casos">CASOS</label>
                                            <select id="casos" class="choices form-control" name="casos">
                                                <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un caso</option>

                                                <!-- CONTROLABLES -->
                                                <option value="CUADRE MAQUINA">Cuadre Maquina</option>
                                                <option value="MECANICO">Mecanico</option>
                                                <option value="ELECTRICO">Electrico</option>

                                            </select>

                                        </div>
                                    </div>

                                    <!-- cantidad cajas deciamles soporte  -->
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad (Kg)</label>
                                            <input type="number" id="cantidad" class="form-control"
                                                placeholder="Cantidad" name="cantidad" step="0.01">
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


