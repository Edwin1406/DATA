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
                <li class="nav-item">
                    <a class="nav-link " href="#inlineForm" style="border: 1px solid;" data-bs-toggle="modal">Des-Corrugador</a>
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
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/pruebas/crearFlexo" enctype="multipart/form-data" onsubmit="return bloquearBoton(this)">
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
                                                <option value="CUADRE">CUADRE</option>
                                                <option value="AJUSTE TINTA MAQUINA">AJUSTE TINTA MAQUINA</option>
                                                <option value="MALTRATO MONTACARGAS">MALTRATO MONTACARGAS</option>
                                                <option value="COMBADO">COMBADO</option>
                                                <option value="DESPEGADO">DESPEGADO</option>
                                                <option value="EXCESO DE RECUBRIMIENTO">EXCESO DE RECUBRIMIENTO</option>
                                                <option value="OTRO">OTRO</option>

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
                                <th class="fs-6" style="min-width: 90px;">casos</th>
                                <th class="fs-6" style="min-width: 80px;">Cantidad</th>
                                <th class="fs-6" style="min-width: 100px;">Observaciones</th>
                                <th class="fs-6" style="min-width: 100px;">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $tipo_maqina = $nombre;
                            foreach ($carritoTemporal as $contro):
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









                <form action="/admin/pruebas/registrarVenFlexo" method="POST">
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
                                <label for="n_unidades">N° de Unidades</label>
                                <input type="number" id="n_unidades" class="form-control"
                                    placeholder="N° de Unidades" name="n_unidades" required>
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
                                    <option value="WILLIAM">WILLIAM</option>
                                    <option value="RAFAEL">RAFAEL</option>
                                    
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



                           <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="tiempo_cambio_medida">tiempo_cambio_medida</label>
                                <input type="number" id="tiempo_cambio_medida" class="form-control"
                                    name="tiempo_cambio_medida" required>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap CSS y JS -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<!-- Modal con formulario y opción -->
<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Formulario con Opción</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="detalleCorrugadorForm" action="/admin/pruebas/registroDetalleCorrugador" method="POST">
                <div class="modal-body">
                  

                    <!-- fecha -->
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>

                    <!-- tipo_maquina -->
                    <div class="form-group">
                        <label for="tipo_maquina">Selecciona una opción:</label>
                        <select class="form-control" id="tipo_maquina" name="tipo_maquina">
                            <option value="CORRUGADOR">Corrugador</option>
                        </select>
                    </div>

                    <!-- cantidad -->
                    <div class="form-group">
                        <label for="cantidad">CANTIDAD:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Escribe algo aquí">
                    </div>

                    <!-- casos -->
                    <div class="form-group">
                        <label for="casos">CASOS</label>
                        <select id="casos" class="form-control" name="casos">
                            <option value="APROBACION DE COLOR">APROBACION DE COLOR</option>
                            <option value="CAMBIO DE MEDIDA">CAMBIO DE MEDIDA</option>
                            <!-- Agrega aquí otros casos según sea necesario -->
                        </select>
                    </div>

                    <!-- observaciones -->
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Escribe algo aquí">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cerrar</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Enviar</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Cuando se envíe el formulario
        $('#detalleCorrugadorForm').on('submit', function(e) {
            e.preventDefault(); // Evitar el envío normal del formulario

            var formData = $(this).serialize(); // Serializar los datos del formulario

            // Enviar la solicitud AJAX
            $.ajax({
                url: '/admin/pruebas/registroDetalleCorrugador', // URL de tu archivo PHP
                type: 'POST',
                data: formData,
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    // Manejo de la respuesta usando SweetAlert2
                    if (response.success) {
                        // Si la respuesta es exitosa
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro guardado',
                            text: response.message,
                            showConfirmButton: true
                        }).then(function() {
                            $('#inlineForm').modal('hide'); // Cerrar el modal
                            $('#detalleCorrugadorForm')[0].reset(); // Limpiar el formulario
                        });
                    } else {
                        // Si hay algún error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            showConfirmButton: true
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // En caso de que haya un error en la solicitud AJAX
                    console.log('Error AJAX:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocurrió un error',
                        text: 'No se pudo procesar la solicitud. Por favor, inténtalo más tarde.',
                        showConfirmButton: true
                    });
                }
            });
        });
    });
</script>