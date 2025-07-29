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
                 Tabla de consumo
             </div>
             <div class="card-body">
                 <table class="table table-striped" id="table1">
                     <!-- <thead>
                         <tr >
                             <th class="fs-6">Fecha</th>
                             <th class="fs-6">Turno</th>
                             <th class="fs-6">Personal</th>
                             <th class="fs-6">Producto</th>
                             <th class="fs-6">Medidas</th>
                             <th class="fs-6">Cantidad</th>
                             <th class="fs-6">Hora Inicio</th>
                             <th class="fs-6">Hora Fin</th>
                             <th class="fs-6">Total Horas</th>
                             <th class="fs-6">x Hora</th>
                             <th class="fs-6">Acciones</th>
                         </tr>
                     </thead> -->
                     <thead>
    <tr>
        <th class="fs-6" style="min-width: 90px;">Fecha</th>
        <th class="fs-6" style="min-width: 60px;">Turno</th>
        <th class="fs-6" style="min-width: 160px;">Personal</th>
        <th class="fs-6" style="min-width: 100px;">Producto</th>
        <th class="fs-6" style="min-width: 80px;">Medidas</th>
        <th class="fs-6" style="min-width: 90px;">Cantidad</th>
        <th class="fs-6" style="min-width: 100px;">Hora Inicio</th>
        <th class="fs-6" style="min-width: 90px;">Hora Fin</th>
        <th class="fs-6" style="min-width: 110px;">Total Horas</th>
        <th class="fs-6" style="min-width: 80px;">x Hora</th>
        <th class="fs-6" style="min-width: 100px;">Acciones</th>
    </tr>
</thead>

                     <tbody>
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
                                 <!-- los botones en horizontal -->

                                 <td>
                                     <div class="d-flex gap-1">
                                         <a href="/admin/editarConsumo?id=<?= $consumo->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                         <form action="/admin/eliminarConsumo" method="POST">
                                             <input type="hidden" name="id" value="<?= $consumo->id ?>">
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
         const dataTable = new simpleDatatables.DataTable("#table1");

     });
 </script>