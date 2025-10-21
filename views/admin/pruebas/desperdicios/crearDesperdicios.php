 <!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->
 <div class="page-heading">
     <div class="page-title">
         <div class="row">
             <div class="col-12 col-md-6 order-md-1 order-last">
                 <h3><?php echo $titulo; ?></h3>
                 <p class="text-subtitle text-muted">Resumen de <?php echo $subtitulo; ?></p>
             </div>
             <div class="col-12 col-md-6 order-md-2 order-first">
                 <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a> <?php echo $nombre; ?></a></li>
                         <li class="breadcrumb-item"><a href="/cerrarSesion">Cerrar Sesión</a></li>
                     </ol>
                 </nav>
             </div>

             <?php
                $toastId = null;
                $toastMessage = null;
                $toastClass = null;
                $paramToRemove = null;

                if (isset($_GET['exito']) && $_GET['exito'] == '1') {
                    $toastId = 'toastExito';
                    $toastMessage = '¡Registro creado!';
                    $toastClass = 'text-bg-success';
                    $paramToRemove = 'exito';
                } elseif (isset($_GET['editado']) && $_GET['editado'] == '2') {
                    $toastId = 'toastEditado';
                    $toastMessage = '¡Registro editado correctamente!';
                    $toastClass = 'text-bg-primary';
                    $paramToRemove = 'editado';
                } elseif (isset($_GET['eliminado']) && $_GET['eliminado'] == '3') {
                    $toastId = 'toastEliminado';
                    $toastMessage = '¡Registro eliminado correctamente!';
                    $toastClass = 'text-bg-danger';
                    $paramToRemove = 'eliminado';
                }
                ?>

             <?php if ($toastId) : ?>
                 <!-- Toast HTML -->
                 <div class="toast-container position-fixed top-0 end-0 p-3">
                     <div id="<?php echo $toastId; ?>" class="toast align-items-center <?php echo $toastClass; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                         <div class="d-flex">
                             <div class="toast-body">
                                 <?php echo $toastMessage; ?>
                             </div>
                             <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                         </div>
                     </div>
                 </div>

                 <!-- Toast JS -->
                 <script>
                     window.addEventListener('DOMContentLoaded', function() {
                         var toastEl = document.getElementById('<?php echo $toastId; ?>');
                         if (toastEl) {
                             var toast = new bootstrap.Toast(toastEl);
                             toast.show();
                         }

                         const url = new URL(window.location);
                         url.searchParams.delete('<?php echo $paramToRemove; ?>');
                         window.history.replaceState({}, document.title, url.toString());
                     });
                 </script>
             <?php endif; ?>









         </div>
     </div>

     <section class="section">
         <div class="card">
             <ul class="nav nav-tabs">

                 <?php if ($email !== 'ventas@megaecuador.com') { ?>
                     <li class="nav-item">
                         <a class="nav-link active" href="/admin/diseno/crearDiseno">Registro Diseño</a>
                     </li>
                 <?php } ?>
             </ul>
         </div>
     </section>




     <section class="section">
         <div class="card">
             <div class="card-header">
                 TABLA DESPERDICIOS FLEXOGRAFICA
             </div>
             <div class="card-body">
                 <table class="table table-striped" id="table1">
                     <thead>
                         <tr>
                             <th class="fs-6" style="min-width: 90px;">Id</th>
                             <th class="fs-6" style="min-width: 93px;">iD_caso</th>
                             <th class="fs-6" style="min-width: 80px;">tipo Maquina</th>
                             <th class="fs-6" style="min-width: 100px;">Casos</th>
                             <th class="fs-6" style="min-width: 100px;">Cantidad</th>
                             <th class="fs-6" style="min-width: 80px;">observaciones</th>
                             <th class="fs-6" style="min-width: 88px;">Fecha</th>


                             <th class="fs-6" style="min-width: 100px;">Acciones</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php foreach ($desperdicios as $desperdicio): ?>
                             <tr>
                                 <td><?= $desperdicio->id ?></td>
                                 <td><?= $desperdicio->id_venta ?></td>
                                 <td><?= $desperdicio->tipo_maquina ?></td>
                                 <td><?= $desperdicio->casos ?></td>
                                 <td><?= $desperdicio->cantidad ?></td>
                                 <td><?= $desperdicio->observaciones ?></td>
                                 <td><?= $desperdicio->fecha ?></td>





                                 <td>

                                     <div class="d-flex gap-1">
                                         <button class="btn btn-danger btn-sm eliminar-btn" data-id="<?= $contro->id ?>">Eliminar</button>

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






                                 </td>

                             </tr>
                         <?php endforeach; ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </section>






 </div>


 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const dataTable = new simpleDatatables.DataTable("#table1", {
             scrollX: true,
             columnDefs: [{
                     width: "110px",
                     targets: [6, 7, 8]
                 } // índices de columnas Hora Inicio, Hora Fin, Total Horas
             ]
         });
     });
 </script>