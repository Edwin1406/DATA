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

                 <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>
                     <li class="sidebar-item active ">
                         <a href="/admin/index" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Dashboard</span>
                         </a>
                     </li>
                 <?php } ?>

                 <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-stack"></i>
                         <span>Producción</span>
                     </a>
                     <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com' || $userEmail === 'planta@megaecuador.com') { ?>
                         <ul class="submenu ">
                             <li class="sidebar-title"><b><i class="bi bi-archive"></i> Registros</b></li>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/consumo"><i class="bi bi-arrow-right"> </i>Registro Empaque</a>
                                 </li>
                             <?php }  ?>

                             <!-- icono de flecha -->


                             <li class="submenu-item ">
                                 <a href="/admin/consumo_general"><i class="bi bi-arrow-right"> </i>Registro Consumo General</a>
                             </li>
                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control_troquel"><i class="bi bi-arrow-right"> </i>Registro Troquel</a>
                                 </li>
                             <?php }  ?>
                             <li class="sidebar-title"><b><i class="bi bi-table"></i> Tablas</b></li>
                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/tablaConsumo"><i class="bi bi-arrow-right"> </i>Tabla Consumo Empaque</a>
                                 </li>
                             <?php }  ?>
                             <li class="submenu-item ">
                                 <a href="/admin/tablaConsumoGeneral"><i class="bi bi-arrow-right"> </i>Tabla Consumo General</a>
                             </li>
                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/tablaConsumoTroquel"><i class="bi bi-arrow-right"> </i>Tabla Consumo Troquel</a>
                                 </li>
                             <?php }  ?>
                         </ul>
                     <?php }  ?>

                 </li>
                 <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-collection-fill"></i>
                             <span>Administrativo</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/tablaAdminConsumoGeneral"><i class="bi bi-arrow-right"> </i>Habilitar Consumo General</a>
                             </li>

                         </ul>
                     </li>
                 <?php } ?>

                 <?php if ($userEmail === 'artes@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-collection-fill"></i>
                             <span>Diseño</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/diseno/crearDiseno"><i class="bi bi-arrow-right"> </i>Crear Diseño</a>
                             </li>
                             <li class="submenu-item ">
                                 <a href="/admin/diseno/tablaDiseno"><i class="bi bi-arrow-right"> </i>Tabla Diseño</a>
                             </li>


                         </ul>
                     </li>
                 <?php } ?>

                 <?php if ($userEmail === 'ventas@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-collection-fill"></i>
                             <span>Ventas</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/diseno/tablaDiseno"><i class="bi bi-arrow-right"> </i>Tabla Diseño</a>
                             </li>


                         </ul>
                     </li>
                 <?php } ?>


                 <!-- </ul> -->
         </div>
         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>