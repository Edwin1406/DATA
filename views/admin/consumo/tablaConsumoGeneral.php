 <!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->



                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Javascript Behavior</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                                    href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                                    aria-selected="true">Home</a>
                                                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                                    href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                                    aria-selected="false">Profile</a>
                                                <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                                    href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                                    aria-selected="false">Messages</a>
                                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                                    href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                                    aria-selected="false">Settings</a>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                                    aria-labelledby="v-pills-home-tab">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut
                                                    nulla neque.
                                                    Ut hendrerit nulla a euismod pretium.
                                                    Fusce venenatis sagittis ex efficitur suscipit. In tempor mattis
                                                    fringilla. Sed
                                                    id tincidunt orci, et volutpat ligula.
                                                    Aliquam sollicitudin sagittis ex, a rhoncus nisl feugiat quis. Lorem
                                                    ipsum dolor
                                                    sit amet, consectetur adipiscing elit.
                                                    Nunc ultricies ligula a tempor vulputate. Suspendisse pretium mollis
                                                    ultrices
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                    aria-labelledby="v-pills-profile-tab">
                                                    Integer interdum diam eleifend metus lacinia, quis gravida eros
                                                    mollis. Fusce
                                                    non sapien sit amet magna dapibus
                                                    ultrices. Morbi tincidunt magna ex, eget faucibus sapien bibendum
                                                    non. Duis a
                                                    mauris ex. Ut finibus risus sed massa
                                                    mattis porta. Aliquam sagittis massa et purus efficitur ultricies.
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                    aria-labelledby="v-pills-messages-tab">
                                                    Integer pretium dolor at sapien laoreet ultricies. Fusce congue et
                                                    lorem id
                                                    convallis. Nulla volutpat tellus nec
                                                    molestie finibus. In nec odio tincidunt eros finibus ullamcorper. Ut
                                                    sodales,
                                                    dui nec posuere finibus, nisl sem aliquam
                                                    metus, eu accumsan lacus felis at odio.
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                                    aria-labelledby="v-pills-settings-tab">
                                                    Sed lacus quam, convallis quis condimentum ut, accumsan congue
                                                    massa.
                                                    Pellentesque et quam vel massa pretium ullamcorper
                                                    vitae eu tortor.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

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
             <div class="card-header">
                 Tabla de consumo general
             </div>
             <div class="card-body">
                 <table class="table table-striped" id="table1">
                     <thead>
                         <tr>
                             <th class="fs-6" style="min-width: 60px;">Id</th>
                             <th class="fs-6" style="min-width: 90px;">Tipo Maqina</th>
                             <th class="fs-6" style="min-width: 80px;">Total General</th>
                             <th class="fs-6" style="min-width: 160px;">Fecha</th>
                             <th class="fs-6" style="min-width: 100px;">Acciones</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php foreach ($consumosGenerales as $consumosGeneral): ?>
                             <tr>
                                 <td><?= $consumosGeneral->id ?></td>
                                 <td><?= $consumosGeneral->tipo_maquina ?></td>
                                 <td><?= $consumosGeneral->total_general ?></td>
                                 <td><?= $consumosGeneral->created_at ?></td>
                                 <td>
                                     <div class="d-flex gap-1">
                                         <a href="/admin/editarConsumo?id=<?= $consumosGeneral->id ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                                         <form action="/admin/eliminarConsumoGeneral" method="POST">
                                             <input type="hidden" name="id" value="<?= $consumosGeneral->id ?>">
                                             <button
                                                 type="submit"
                                                 class="btn btn-danger btn-sm"
                                                 <?= ($consumosGeneral->accion == 1) ? '' : 'disabled' ?>>
                                                 Eliminar
                                             </button>
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