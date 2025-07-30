<!-- layout.php -->

<div id="app">
    <?php include_once __DIR__ . '/templates/admin-header.php'; ?>
    
    <div id="main">
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
