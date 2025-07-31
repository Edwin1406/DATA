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
                                            <label for="nombre_proveedor">Nombre del Proveedor</label>
                                            <input type="text" id="nombre_proveedor" class="form-control"
                                                placeholder="Nombre del Proveedor" name="nombre_proveedor">
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



                             <!-- FilePond CSS -->
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />

<!-- File input -->
<input type="file" id="pdf" name="pdf" accept=".pdf" />





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










<!-- filepond validation -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<!-- image editor -->
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

<!-- toastify -->
<script src="assets/vendors/toastify/toastify.js"></script>

<!-- filepond -->
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<!-- FilePond JS -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script>
    // Crear una instancia FilePond
    const inputElement = document.querySelector('#pdf');

    FilePond.create(inputElement, {
        acceptedFileTypes: ['application/pdf'],
        allowMultiple: false,
        labelIdle: 'Arrastra tu archivo PDF o haz clic para seleccionar',
        server: {
            process: {
                url: '/upload_pdf.php', // Tu endpoint PHP
                method: 'POST',
                withCredentials: false,
                headers: {},
                timeout: 7000,
                onload: response => {
                    console.log('Subido:', response);
                },
                onerror: response => {
                    console.error('Error al subir:', response);
                }
            }
        }
    });
</script>
