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
                <li class="sidebar-item active">
                    <a href="/admin/index" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Producción -->
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>PRODUCCIÓN</span>
                    </a>
                    <ul class="submenu">
                        <!-- Consumo Papel y sus opciones -->
                        <li class="submenu-item">
                            <a href="/admin/consumo">Consumo Papel</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/consumo/registro">➤ Registro</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/consumo/reporte">➤ Reporte</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/consumo/historial">➤ Historial</a>
                        </li>

                        <!-- Otros ítems de ejemplo -->
                        <li class="submenu-item">
                            <a href="component-badge.html">Badge</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-breadcrumb.html">Breadcrumb</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-button.html">Button</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-card.html">Card</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-carousel.html">Carousel</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-dropdown.html">Dropdown</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-list-group.html">List Group</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-modal.html">Modal</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-navs.html">Navs</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-pagination.html">Pagination</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-progress.html">Progress</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-spinner.html">Spinner</a>
                        </li>
                        <li class="submenu-item">
                            <a href="component-tooltip.html">Tooltip</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Botón para cerrar menú en mobile -->
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
