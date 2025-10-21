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
                    <a class="nav-link active" href="/admin/pruebas/tablaFlexo">Tabla producción - FLEXOGRAFICA</a>
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
                        <h4 class="card-title">REGISTRO FLEXOGRAFICA</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>



                    <!-- Contenedor responsive -->

                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table1">
                            <thead>
                                <tr>
                                    <th class="fs-6" style="min-width: 90px;">ID</th>
                                    <th class="fs-6" style="min-width: 90px;">id_usuario</th>
                                    <th class="fs-6" style="min-width: 90px;">tipo_maquina</th>
                                    <th class="fs-6" style="min-width: 90px;">casos</th>
                                    <th class="fs-6" style="min-width: 80px;">Cantidad</th>
                                    <th class="fs-6" style="min-width: 100px;">Observaciones</th>
                                    <th class="fs-6" style="min-width: 100px;">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $tipo_maqina = $nombre;
                                foreach ($desperdicios as $contro):
                                    if ($tipo_maqina !== $contro->tipo_maquina) continue;
                                ?>
                                    <tr id="row_<?= $contro->id ?>">
                                        <td><?= $contro->id ?></td>
                                        <td><?= $contro->id_usuario ?></td>
                                        <td><?= $contro->tipo_maquina ?></td>
                                        <td><?= $contro->casos ?></td>
                                        <td><?= $contro->cantidad ?></td>
                                        <td><?= $contro->observaciones ?></td>

                                        <td>
                                            <div class="d-flex gap-1">
                                                <!-- Botón de eliminación -->
                                                <button class="btn btn-danger btn-sm eliminar-btn" data-id="<?= $contro->id ?>">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total:</th>
                                    <th>
                                        <?php
                                        $totalCantidad = 0;
                                        foreach ($carritoTemporal as $contro) {
                                            if ($tipo_maqina === $contro->tipo_maquina) {
                                                $totalCantidad += $contro->cantidad;
                                            }
                                        }
                                        echo number_format($totalCantidad, 2);
                                        ?>
                                    </th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <script>
                        // Event listener para los botones de eliminación
                        document.querySelectorAll('.eliminar-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                const id = this.getAttribute('data-id'); // Obtener el ID del carrito

                                // Usamos SweetAlert2 para confirmar la eliminación
                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: "¡Esta acción no se puede deshacer!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Realizamos la petición AJAX para eliminar
                                        const formData = new FormData();
                                        formData.append('id', id); // Añadir el ID al formulario

                                        fetch('/admin/eliminarCarrito', {
                                                method: 'POST',
                                                body: formData
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    // Si la eliminación fue exitosa, eliminamos la fila del carrito
                                                    document.getElementById('row_' + id).remove();
                                                    Swal.fire(
                                                        'Eliminado',
                                                        'El artículo ha sido eliminado del carrito.',
                                                        'success'
                                                    );
                                                } else {
                                                    Swal.fire(
                                                        'Error',
                                                        'Hubo un problema al eliminar el artículo.',
                                                        'error'
                                                    );
                                                }
                                            })
                                            .catch(error => {
                                                Swal.fire(
                                                    'Error',
                                                    'Hubo un error al procesar la solicitud',
                                                    'error'
                                                );
                                            });
                                    }
                                });
                            });
                        });
                    </script>





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