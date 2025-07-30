<!-- layout.php -->

<?php include_once __DIR__ . '/templates/admin-header.php'; ?>
<div id="app">

    <div id="main">
        
            <?php include_once __DIR__ . '/templates/sidebar-only.php'; ?>

            <?php echo $contenido; ?>
            <?php include_once __DIR__ . '/templates/admin-sidebar.php'; ?>
   
    </div>

    <script>
        if (window.location.pathname === "/admin/dashboard") {
            var s = document.createElement('script');
            s.src = "/assets/js/pages/dashboard.js";
            document.body.appendChild(s);
        }
    </script>








    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contentContainer = document.querySelector('#contenido-dinamico');

            // Función para cargar contenido dinámicamente
            function cargarContenido(url, agregarAlHistorial = true) {
                fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error(`Error al cargar: ${response.status}`);
                        return response.text();
                    })
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.querySelector('#contenido-dinamico');

                        if (newContent) {
                            contentContainer.innerHTML = newContent.innerHTML;

                            // Agregar a historial si es navegación por click
                            if (agregarAlHistorial) {
                                window.history.pushState(null, '', url);
                            }

                            // Vuelve a marcar los menús activos
                            activarSidebar(url);
                        } else {
                            console.warn('No se encontró #contenido-dinamico en la respuesta.');
                        }
                    })
                    .catch(err => {
                        console.error('Error al cargar contenido:', err);
                    });
            }

            // Función para interceptar clicks en enlaces del sidebar
            function interceptarEnlaces() {
                const links = document.querySelectorAll('.sidebar-item a[href^="/admin/"]');

                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        cargarContenido(url);
                    });
                });
            }

            // Mantiene activo el submenú correspondiente
            function activarSidebar(urlActual) {
                // Limpiar estados anteriores
                document.querySelectorAll('.sidebar-item').forEach(item => item.classList.remove('active'));
                document.querySelectorAll('.dashboard__enlace--actual').forEach(link => link.classList.remove('dashboard__enlace--actual'));

                // Marcar enlace actual
                const enlaceActivo = document.querySelector(`.submenu-item a[href="${urlActual}"]`);
                if (enlaceActivo) {
                    enlaceActivo.classList.add('dashboard__enlace--actual');

                    // Abrir submenús padres
                    let parent = enlaceActivo.closest('.sidebar-item');
                    while (parent) {
                        parent.classList.add('active');
                        parent = parent.parentElement.closest('.sidebar-item');
                    }
                }
            }

            // Soporte para botones del navegador (atrás/adelante)
            window.addEventListener('popstate', function() {
                cargarContenido(location.pathname, false);
            });

            // Inicializar
            interceptarEnlaces();
            activarSidebar(location.pathname);
        });
    </script>