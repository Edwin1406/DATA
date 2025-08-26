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


                 <li class="nav-item">
                     <a class="nav-link active" href="/admin/turnoDiseno/generarTurno">Registro Turno</a>
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
                             <th class="fs-6" style="min-width: 90px;">Codigo</th>
                             <th class="fs-6" style="min-width: 90px;">Tipo producto</th>
                             <th class="fs-6" style="min-width: 90px;">Tipo componente</th>
                          
                             <th class="fs-6" style="min-width: 100px;">Observaciones</th>
                             <th class="fs-6" style="min-width: 98px;">Estado</th>
                             <th class="fs-6" style="min-width: 80px;">Fecha Creación</th>
                             <th class="fs-6" style="min-width: 80px;">Fecha Entrega</th>
                             <th class="fs-6" style="min-width: 100px;">Acciones</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php foreach ($turnos as $turno): ?>
                             <tr>

                                 <td><?= $turno->codigo ?></td>
                                 <td><?= $turno->tipo_producto ?></td>
                                 <td><?= $turno->tipo_componente ?></td>

                                 <td><?= $turno->observaciones ?></td>

                                 <?php
                                    $estado = trim($turno->estado);
                                    switch ($estado) {
                                        case 'EN PROCESO':
                                            $badgeClass = 'bg-info'; // AZUL
                                            break;
                                        case 'ENTREGADO':
                                            $badgeClass = 'bg-success'; // verde
                                            break;
                                        case 'PENDIENTE':
                                            $badgeClass = 'bg-danger'; // rojo
                                            break;
                                        default:
                                            $badgeClass = 'bg-secondary'; // gris por defecto
                                    }
                                    ?>
                                 <td data-id="<?php echo $diseno->id; ?>">
                                     <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($estado); ?></span>
                                 </td>

                                 <td><?= $turno->fecha_creacion ?></td>
                                 <td><?= $turno->fecha_entrega ?></td>



                                 <td>
                                     <!-- usuario -->


                                     <div class="d-flex gap-1">
                                         <a href="/admin/turnoDiseno/editarTurno?id=<?= $turno->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                         <!-- ver detalle un boton -->

                                         <!-- BOTÓN -->
                                         <button class="btn btn-info btn-sm btn-detalle" data-id="<?= $turno->id ?>">Ver Detalle</button>










                                         <?php if ($email !== 'ventas@megaecuador.com') { ?>
                                             <form action="/admin/eliminarTurnoDiseno" method="POST">
                                                 <input type="hidden" name="id" value="<?= $turno->id ?>">
                                                 <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                             </form>

                                         <?php } ?>
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


 <!-- Modal reutilizable -->
 <div class="modal fade text-left" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header bg-info">
                 <h5 class="modal-title white" id="detalleLabel">Detalle del Turno</h5>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>
             <div class="modal-body" id="detalleContenido">
                 Cargando información...
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cerrar</button>
             </div>
         </div>
     </div>
 </div>





 <script>
     document.addEventListener('click', async function(e) {
         if (e.target.matches('.btn-detalle')) {
             const id = e.target.getAttribute('data-id');
             const contenido = document.getElementById('detalleContenido');
             contenido.innerHTML = "Cargando información...";

             const datos = await ApiDetalle(id);

             if (datos) {
                 let tabla = `<table class="table table-sm table-bordered"><tbody>`;

                 for (const [campo, valor] of Object.entries(datos)) {
                     // Condición: si el valor está vacío, es null o es "0", no se muestra
                     if (valor !== null && valor !== "" && valor !== 0 && valor !== "0") {

                         // si el campo es "pdf", lo mostramos como enlace
                         if (campo === "pdf") {
                             tabla += `
                <tr>
                  <th style="width:30%">${campo}</th>
                  <td><a href="/src/turnos/${valor}" target="_blank">Ver archivo</a></td>
                </tr>
              `;
                         } else {
                             tabla += `
                <tr>
                  <th style="width:30%">${campo}</th>
                  <td>${valor}</td>
                </tr>
              `;
                         }
                     }
                 }

                 tabla += `</tbody></table>`;
                 contenido.innerHTML = tabla;
             } else {
                 contenido.innerHTML = `<p class="text-danger">No se pudo cargar el detalle.</p>`;
             }

             const modal = new bootstrap.Modal(document.getElementById('detalleModal'));
             modal.show();
         }
     });

     async function ApiDetalle(id) {
         try {
             const url = `${location.origin}/admin/api/apiDetalle?id=${id}`;
             const resultado = await fetch(url);
             return await resultado.json();
         } catch (e) {
             console.log(e);
             return null;
         }
     }
 </script>