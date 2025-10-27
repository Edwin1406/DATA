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
                         <a class="nav-link active" href="/admin/pruebas/crearMicro">Registro Micro</a>
                     </li>
                 <?php } ?>
             </ul>
         </div>
     </section>




     <section class="section">
         <div class="card">
             <div class="card-header">
                 Tabla de Producción - MICRO
             </div>
             <div class="card-body">
                 <table class="table table-striped" id="table1">
                     <thead>
                         <tr>
                             <th class="fs-6" style="min-width: 90px;">Id</th>
                             <th class="fs-6" style="min-width: 93px;">Fecha</th>
                             <th class="fs-6" style="min-width: 80px;">Consumo Papel</th>
                             <th class="fs-6" style="min-width: 80px;">N° Láminas</th>
                             <th class="fs-6" style="min-width: 80px;">Turno</th>
                             <th class="fs-6" style="min-width: 60px;">Motivo de Inactividad</th>

                             <th class="fs-6" style="min-width: 100px;">Acciones</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php foreach ($micro as $microS): ?>
                             <tr>
                                 <td><?= $microS->id ?></td>
                                 <td><?= $microS->fecha ?></td>
                                 <td><?= $microS->consumo_papel ?></td>
                                 <td><?= $microS->n_laminas ?></td>
                                 <td><?= $microS->turno ?></td>
                                 <td><?= $microS->motivo_inactividad ?></td>


                                 <td>

                                     <div class="d-flex gap-1">
                                         <a href="/admin/pruebas/editarMicro?id=<?= $microS->id ?>" class="btn btn-primary btn-sm">Editar</a>

                                         <?php
                                            // Buscar si el corrugador actual ($microS->id) ya existe en producción diaria
                                            $registroExistente = null;



                                            if (isset($produccioduccionMicro) && is_iterable($produccioduccionMicro)) {
                                                foreach ($produccioduccionMicro as $registro) {
                                                    // Permitir tanto objeto como array
                                                    $idCorrugador = is_array($registro) ? $registro['id_corrugador'] ?? null : ($registro->id_corrugador ?? null);

                                                    if ($idCorrugador == $microS->id) {
                                                        $registroExistente = $registro;
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>

                                         <?php if ($registroExistente): ?>
                                             <?php
                                                // debuguear($registroExistente);
                                                $idRegistro = is_array($registroExistente)
                                                    ? ($registroExistente['id'] ?? null)
                                                    : ($registroExistente->id ?? null);
                                                ?>

                                             <!--  -->


                                             <a href="/admin/diaria/editarproduccion_diariaMicro?id=<?= htmlspecialchars($idRegistro) ?>"
                                                 class="btn btn-secondary btn-sm">
                                                 -
                                             </a>
                                         <?php else: ?>
                                             <a href="/admin/diaria/produccion_diariaMicro?id_micro=<?= $microS->id ?>" class="btn btn-primary btn-sm">+</a>
                                         <?php endif; ?>




                                         <form action="/admin/eliminarMicro" method="POST">
                                             <input type="hidden" name="id" value="<?= $microS->id ?>">
                                             <button class="btn btn-danger btn-sm eliminar-btn"
                                                 data-id="<?= $microS->id ?>">Eliminar</button>
                                         </form>
                                     </div>




                                 </td>

                             </tr>
                         <?php endforeach; ?>
                     </tbody>
                 </table>

                 <!-- Asegúrate de tener cargado SweetAlert2 y que esta etiqueta esté FUERA del foreach -->
                 <script>
                     // Delegación de eventos para evitar añadir listeners por fila
                     document.getElementById('table1').addEventListener('click', function(e) {
                         const btn = e.target.closest('.eliminar-btn');
                         if (!btn) return;

                         const id = btn.getAttribute('data-id');
                         if (!id) {
                             Swal.fire('Error', 'No se encontró el ID del registro.', 'error');
                             return;
                         }

                         Swal.fire({
                             // CARGAR EL ID

                             title: '¿Estás seguro ID : ' + id + ' de eliminar este registro?',
                             text: '¡Esta acción no se puede deshacer!',
                             icon: 'warning',
                             showCancelButton: true,
                             confirmButtonText: 'Sí, eliminar',
                             cancelButtonText: 'Cancelar',
                             reverseButtons: true
                         }).then((result) => {
                             if (!result.isConfirmed) return;

                             const formData = new FormData();
                             formData.append('id', id);

                             fetch('/admin/eliminarMicro', {
                                     method: 'POST',
                                     body: formData
                                 })
                                 .then(async (response) => {
                                     // Intenta parsear JSON; si no es JSON, forzamos error para que caiga al catch
                                     try {
                                         return await response.json();
                                     } catch (err) {
                                         throw new Error('Respuesta no JSON');
                                     }
                                 })
                                 .then((data) => {
                                     if (data && data.success) {
                                         const row = document.getElementById('row_' + id);
                                         if (row) row.remove();
                                         Swal.fire('Eliminado', 'El registro fue eliminado.', 'success');
                                     } else {
                                         Swal.fire('Error', (data && data.message) || 'No se pudo eliminar.', 'error');
                                     }
                                 })
                                 .catch((err) => {
                                     Swal.fire('Error', 'Hubo un error al procesar la solicitud.', 'error');
                                     console.error(err);
                                 });
                         });
                     });
                 </script>






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