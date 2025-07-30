 <?php

    $userEmail = $_SESSION['email'] ?? 'No disponible'; // Asignar
    ?>


 <header class="py-3">
     <a href="#" class="burger-btn d-block d-xl-none">
         <i class="bi bi-justify fs-3"></i>
     </a>
 </header>
 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active">
         <div class="sidebar-header">
             <div class="d-flex justify-content-between">
                 <div class="logo">
                     <a href="/admin/index">MEGASTOCK</a>
                 </div>
                 <div class="toggler">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <!-- Sidebar Menu -->
         <div class="sidebar-menu">
             <ul class="menu">
                 <li class="sidebar-title">Menu</li>
                 <li class="sidebar-item active ">
                     <a href="/admin/index" class='sidebar-link'>
                         <i class="bi bi-grid-fill"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>

                 <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-stack"></i>
                         <span>Producción</span>
                     </a>
                     <ul class="submenu ">

                         <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>
                             <li class="sidebar-item  has-sub">
                                 <a href="#" class='sidebar-link'>
                                     <i class="bi bi-stack"></i>
                                     <span>Control</span>
                                 </a>
                                 <ul class="submenu ">

                                        <li class="submenu-item ">
                                            <a class="dashboard__enlace <?php echo pagina_actual_admin('/admin/consumo') ? 'dashboard__enlace--actual' : '' ?>" href="/admin/consumo">Registro Empaque</a>
                                        </li>


                                     <li class="submenu-item ">
                                         <a href="/admin/consumo_general">Registro Consumo General</a>
                                     </li>

                                     <li class="submenu-item ">
                                         <a href="/admin/control_troquel">Registro Troquel</a>
                                     </li>
                                     <li class="submenu-item ">
                                         <a href="/admin/tablaConsumo">Tabla Consumo Empaque</a>
                                     </li>

                                     <li class="submenu-item ">
                                         <a href="/admin/tablaConsumoGeneral">Tabla Consumo General</a>
                                     </li>
                                     <li class="submenu-item ">
                                         <a href="/admin/tablaConsumoTroquel">Tabla Consumo Troquel</a>
                                     </li>

                                 </ul>
                             </li>
                         <?php } ?>

                         <li class="submenu-item ">
                             <a href="">/</a>
                         </li>
                     </ul>
                 </li>

                 <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-collection-fill"></i>
                         <span>Administrativo</span>
                     </a>
                     <ul class="submenu ">
                         <li class="submenu-item ">
                             <a href="/admin/tablaAdminConsumoGeneral">Habilitar Consumo General</a>
                         </li>

                     </ul>
                 </li>
             </ul>
         </div>

         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
     <!-- End of Sidebar -->



 </div>
