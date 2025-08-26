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
                             <th class="fs-6" style="min-width: 90px;">Largo</th>
                             <th class="fs-6" style="min-width: 90px;">Ancho</th>
                             <th class="fs-6" style="min-width: 90px;">Alto</th>
                             <th class="fs-6" style="min-width: 90px;">Dobles</th>
                             <th class="fs-6" style="min-width: 90px;">Flauta</th>
                             <th class="fs-6" style="min-width: 90px;">Material</th>
                             <th class="fs-6" style="min-width: 90px;">ECT</th>
                             <th class="fs-6" style="min-width: 93px;">Descripción</th>
                             <th class="fs-6" style="min-width: 80px;">Vendedor</th>
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
                                 <td><?= $turno->largo ?></td>
                                 <td><?= $turno->ancho ?></td>
                                 <td><?= $turno->alto ?></td>
                                 <td><?= $turno->dobles ?></td>
                                 <td><?= $turno->flauta ?></td>
                                 <td><?= $turno->material ?></td>
                                 <td><?= $turno->ect ?></td>
                                 <td><?= $turno->descripcion ?></td>
                                 <td><?= $turno->vendedor ?></td>
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

                                   <button class="btn btn-info btn-sm btn-detalle"
        data-id="<?= $turno->id ?>">Ver Detalle</button>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-detalle').forEach(boton => {
      boton.addEventListener('click', () => {
        const id = boton.getAttribute('data-id');
        console.log("ID desde Ver Detalle:", id);
      });
    });
  });
</script>




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




<!-- 


 <script>
     document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
         button.addEventListener('click', function() {
             const id = this.getAttribute('data-id');
             ApiDetalle(id);
         });
     });

     // obtener datos detalle
     async function ApiDetalle(id) {

         console.log(id);

         try {
             const url = `${location.origin}/admin/api/apiDetalle?id=${id}`;
             const resultado = await fetch(url);
             const apipedidos = await resultado.json();
             console.log(apipedidos);
             return apipedidos
         } catch (e) {
             console.log(e);

         }
     }
 </script> -->