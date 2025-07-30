<!-- layout.php -->

<?php include_once __DIR__ . '/templates/admin-header.php'; ?>
<div id="app">
    
    <div id="main" id="contenido-dinamico">
        <?php include_once __DIR__ . '/templates/sidebar-only.php'; ?>

        <?php echo $contenido; ?>
        <?php include_once __DIR__ . '/templates/admin-sidebar.php'; ?>
    </div>
</div>

<script>
if (window.location.pathname === "/admin/dashboard") {
    var s = document.createElement('script');
    s.src = "/assets/js/pages/dashboard.js";
    document.body.appendChild(s);
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.sidebar-item a[href^="/admin/"]');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Evita la recarga

            const url = this.href;

            // Cargar el contenido de forma dinámica
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error("Error al cargar la página.");
                    return response.text();
                })
                .then(html => {
                    // Extraer solo el contenido que necesitas (por ejemplo, el <main>)
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#contenido-dinamico');

                    if (newContent) {
                        document.querySelector('#contenido-dinamico').innerHTML = newContent.innerHTML;
                        window.history.pushState(null, '', url); // Cambia la URL sin recargar
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                });
        });
    });

    // Soporte para navegación con botones del navegador (atrás/adelante)
    window.addEventListener('popstate', function () {
        fetch(location.pathname)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('#contenido-dinamico');
                if (newContent) {
                    document.querySelector('#contenido-dinamico').innerHTML = newContent.innerHTML;
                }
            });
    });
});
</script>
