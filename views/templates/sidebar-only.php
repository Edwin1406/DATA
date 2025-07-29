 <header class="mb-3">
     <a href="#" class="burger-btn d-block d-xl-none">
         <i class="bi bi-justify fs-3"></i>
     </a>
 </header>
 <!-- SIDEBAR -->
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/admin/index">MEGASTOCK</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menú</li>

                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a href="/admin/index" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- PRODUCCIÓN -->
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>PRODUCCIÓN</span>
                    </a>
                    <ul class="submenu">

                        <!-- Submenú: Consumo Papel -->
                        <li class="submenu-item has-sub">
                            <a href="#" class="submenu-link">Consumo Papel</a>
                            <ul class="submenu sub-submenu">
                                <li class="submenu-item">
                                    <a href="/admin/consumo/registro">Registro</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/admin/consumo/reporte">Reporte</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/admin/consumo/historial">Historial</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Otros ítems de PRODUCCIÓN -->
                        <li class="submenu-item">
                            <a href="component-badge.html">Badge</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-button.html">Button</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Sidebar toggle button -->
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>