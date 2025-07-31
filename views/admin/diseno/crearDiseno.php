<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos del diseño</p>
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
                    <a class="nav-link active" href="/admin/tablaConsumoTroquel">Tabla Diseño</a>
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
                        <h4 class="card-title">REGISTRO DE DISEÑO</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/diseno/crearDiseno" enctype="multipart/form-data">
                                <div class="row">






                                    <!-- NOMBRE DEL CLIENTE -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre del Cliente</label>
                                            <input type="text" id="nombre_cliente" class="form-control"
                                                placeholder="Nombre del Cliente" name="nombre_cliente">
                                        </div>
                                    </div>


                                    <!-- NOMBRE DEL PROVEEDOR -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="proveedor">Nombre del Proveedor</label>
                                            <input type="text" id="proveedor" class="form-control"
                                                placeholder="Nombre del Proveedor" name="proveedor">
                                        </div>
                                    </div>

                                    <!-- NOMBRE DEL PRODUCTO -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre del Producto</label>
                                            <input type="text" id="nombre_producto" class="form-control"
                                                placeholder="Nombre del Producto" name="nombre_producto">
                                        </div>
                                    </div>

                                    <!-- COD. PRODUCTO -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="codigo_producto">Código del Producto</label>
                                            <input type="text" id="codigo_producto" class="form-control"
                                                placeholder="Código del Producto" name="codigo_producto">
                                        </div>
                                    </div>

                                    <!-- estado enviado,pausado,terminado-->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-select" name="estado" id="estado">
                                                <option value="Enviado">Enviado</option>
                                                <option value="Pausado">Pausado</option>
                                                <option value="Terminado">Terminado</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pdf">Subir PDF del diseño</label>
                                            <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
                                            <small class="form-text text-muted">Solo se permiten archivos PDF.</small>
                                        </div>
                                    </div>

                                    <?php if (isset($diseno->pdf)) : ?>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Archivo actual:</label><br>
                                                <a href="<?php echo $_ENV['HOST'] . '/src/visor/' . $diseno->pdf; ?>"
                                                    target="_blank"
                                                    class="btn btn-outline-primary btn-sm">
                                                    Ver / Descargar PDF
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>



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