 <div class="page-heading">
     <div class="page-title">
         <div class="row">
             <div class="col-12 col-md-6 order-md-1 order-last">
                 <h3><?php echo $titulo; ?></h3>
                 <p class="text-subtitle text-muted">Resumen de <?php echo $titulo; ?></p>
             </div>
             <div class="col-12 col-md-6 order-md-2 order-first">
                 <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="index.html"> <?php echo $nombre; ?></a></li>
                         <li class="breadcrumb-item"><a href="/cerrarSesion">Cerrar Sesión</a></li>
                     </ol>
                 </nav>
             </div>
         </div>
     </div>
     <section class="section">
         <div class="card">
             <div class="card-header">
                 Simple Datatable
             </div>
             <div class="card-body">
                 <table class="table table-striped" id="table1">
                     <thead>
                         <tr>
                             <th>Fecha</th>
                             <th>Turno</th>
                             <th>Personal</th>
                             <th>Producto</th>
                             <th>Medidas</th>
                             <th>Cantidad</th>
                             <th>Hora Inicio</th>
                             <th>Hora Fin</th>
                             <th>Total Horas</th>
                             <th>Pago por Hora</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <?php foreach ($consumos as $consumo): ?>
                         <tr>
                             <td><?= $consumo->fecha ?></td>
                             <td><?= $consumo->turno ?></td>
                             <td><?= $consumo->personal ?></td>
                             <td><?= $consumo->producto ?></td>
                             <td><?= $consumo->medidas ?></td>
                             <td><?= $consumo->cantidad ?></td>
                             <td><?= $consumo->hora_inicio ?></td>
                             <td><?= $consumo->hora_fin ?></td>
                             <td><?= $consumo->total_horas ?></td>
                             <td><?= $consumo->x_hora ?></td>
                         </tr>
                     <?php endforeach; ?>
                     </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </section>
 </div>


 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const dataTable = new simpleDatatables.DataTable("#table1");
     });
 </script>