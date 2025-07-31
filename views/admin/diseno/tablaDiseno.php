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

             <div class="toast-container position-fixed top-0 end-0 p-3">
                 <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                     <div class="d-flex">
                         <div class="toast-body">
                             ¡Registro eliminado!
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
         </div>
     </div>

     <section class="section">
         <div class="card">
             <ul class="nav nav-tabs">
                 <li class="nav-item">
                     <a class="nav-link active" href="/admin/consumo">Registro Empaque</a>
                 </li>
             </ul>
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
                             <th class="fs-6" style="min-width: 90px;">Id</th>
                             <th class="fs-6" style="min-width: 80px;">Nombre Cliente</th>
                             <th class="fs-6" style="min-width: 160px;">Proveedor</th>
                             <th class="fs-6" style="min-width: 100px;">Nombre Producto</th>
                             <th class="fs-6" style="min-width: 93px;">Codigo producto</th>
                             <th class="fs-6" style="min-width: 98px;">Estado</th>
                             <th class="fs-6" style="min-width: 110px;">Pdf</th>

                             <th class="fs-6" style="min-width: 100px;">Acciones</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php foreach ($disenos as $diseno): ?>
                             <tr>
                                 <td><?= $diseno->id ?></td>
                                 <td><?= $diseno->nombre_cliente ?></td>
                                 <td><?= $diseno->proveedor ?></td>
                                 <td><?= $diseno->nombre_producto ?></td>
                                 <td><?= $diseno->codigo_producto ?></td>
                                 <td><?= $diseno->estado ?></td>
                                 <td>
                                     <?php
                                        $rutaArchivo = "/src/visor/" . htmlspecialchars($visores->pdf);
                                        $extension = pathinfo($visores->pdf, PATHINFO_EXTENSION);

                                        if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                         <!-- Mostrar miniatura para imágenes -->
                                         <img
                                             src="<?php echo $rutaArchivo ?>"
                                             alt="pdf"
                                             class="imagen-miniatura"
                                             style="width: 100px; height: auto; cursor: pointer;"
                                             onclick="mostrarImagen(this.src)">
                                     <?php elseif (strtolower($extension) === 'pdf'): ?>
                                         <!-- Mostrar enlace para visualizar PDF -->
                                         <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>
                                     <?php else: ?>
                                         <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>

                                     <?php endif; ?>
                                 </td>

                                 <td>
                                     <div class="d-flex gap-1">
                                         <a href="/admin/editarDiseno?id=<?= $diseno->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                         <form action="/admin/eliminarDiseno" method="POST">
                                             <input type="hidden" name="id" value="<?= $diseno->id ?>">
                                             <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                         </form>
                                     </div>
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