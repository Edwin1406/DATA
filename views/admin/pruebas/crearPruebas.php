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


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">REGISTRO DE CONTROL TROQUEL</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/pruebas/crearPruebas" enctype="multipart/form-data">
                                <div class="row">



                                    <div class="col-md-6 col-12">
                                        <label for="id_producto">Escoja el Producto</label>
                                        <div class="form-group">
                                            <select class="form-select" name="id_producto" id="id_producto">
                                                <option value="1">Producto 1</option>
                                                <option value="2">Producto 2</option>
                                            </select>
                                        </div>
                                    </div>


                                    <!-- cantidad cajas  -->
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

    <section class="section">
        <div class="card">
            <div class="card-header">
                Tabla de consumo
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="fs-6" style="min-width: 90px;">ID</th>
                            <th class="fs-6" style="min-width: 90px;">id_usuario</th>
                            <th class="fs-6" style="min-width: 90px;">id_producto</th>
                            <th class="fs-6" style="min-width: 80px;">Cantidad</th>
                            <th class="fs-6" style="min-width: 155px;">Precio unitario</th>
                        
                            <th class="fs-6" style="min-width: 100px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($carritoTemporal as $contro): ?>
                            <tr>
                                <td><?= $contro->id ?></td>
                                <td><?= $contro->id_usuario ?></td>
                                <td><?= $contro->id_producto ?></td>
                                <td><?= $contro->cantidad ?></td>
                                <td><?= $contro->precio_unitario ?></td>
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
                            <td colspan="3">Total</td>
                            <!-- <td><?= array_sum(array_column($carritoTemporal, 'cantidad')) ?></td> -->
                            <td><?= array_sum(array_column($carritoTemporal, 'precio_unitario')) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>









</div>