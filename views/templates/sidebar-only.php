 
 <?php
   
    $userEmail = $_SESSION['email'] ?? 'No disponible'; // Asignar
    ?>
 
 
 <header class="mb-3">
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
                         <span>PRODUCCIÓN</span>
                     </a>
                     <ul class="submenu ">






                     <?php if($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>

                         <li class="sidebar-item  has-sub">
                             <a href="#" class='sidebar-link'>
                                 <i class="bi bi-stack"></i>
                                 <span>CONTROL</span>
                             </a >
                             <ul class="submenu ">
                                 <li class="submenu-item ">
                                     <a href="/admin/consumo">Registro Empaque</a>
                                 </li>
                                 <li class="submenu-item ">
                                     <a href="/admin/tablaConsumo">Tabla Consumo</a>
                                 </li>
                               
                             </ul>
                         </li>
                        <?php } ?>


                         <li class="submenu-item ">
                             <a href="/admin/consumo">Consumo Papel</a>
                         </li>
                        
                        
                     </ul>
                 </li>

                 <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-collection-fill"></i>
                         <span>Extra Components</span>
                     </a>
                     <ul class="submenu ">
                         <li class="submenu-item ">
                             <a href="extra-component-avatar.html">Avatar</a>
                         </li>
                         <li class="submenu-item ">
                             <a href="extra-component-sweetalert.html">Sweet Alert</a>
                         </li>
                         <li class="submenu-item ">
                             <a href="extra-component-toastify.html">Toastify</a>
                         </li>
                         <li class="submenu-item ">
                             <a href="extra-component-rating.html">Rating</a>
                         </li>
                         <li class="submenu-item ">
                             <a href="extra-component-divider.html">Divider</a>
                         </li>
                     </ul>
                 </li>



             </ul>
         </div>

         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
     <!-- End of Sidebar -->



 </div>

 