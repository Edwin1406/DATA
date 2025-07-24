<!-- <main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?? '' ?></h2>
    <p class="auth__texto">Registrate en sitio web </p>

    <?php require_once __DIR__. '/../templates/alertas.php'; ?>

    <form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label for="nombre"  class="formulario__label">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                class="formulario__input" 
                placeholder="Tu nombre" 
                id="nombre"
                value="<?php echo $usuario->nombre ?? '' ?>"
                >
        </div>
        <div class="formulario__campo">
            <label for="apellido"  class="formulario__label">Apellido</label>
            <input 
                type="text" 
                name="apellido" 
                class="formulario__input" 
                placeholder="Tu apellido" 
                id="apellido"
                value="<?php echo $usuario->apellido ?? '' ?>"
                >

        <div class="formulario__campo">
            <label for="email"  class="formulario__label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="formulario__input" 
                placeholder="Tu Email" 
                id="email"
                value="<?php echo $usuario->email ?? '' ?>"
                >
        </div>
        <div class="formulario__campo">
            <label for="password"  class="formulario__label">Password</label>
            <input 
                type="password" 
                name="password" 
                class="formulario__input" 
                placeholder="Tu password" 
                id="password"
                >
        </div>
        <div class="formulario__campo">
            <label for="password2"  class="formulario__label">Repita su contraseña</label>
            <input 
                type="password" 
                name="password2" 
                class="formulario__input" 
                placeholder="Repite tu password" 
                id="password2"
                >
        </div>
        <input type="submit" value="Crear Cuenta" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/" class="acciones__enlace">Ya tienes cuenta ? Iniciar Sesión</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
    </div>
</main> -->

 <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="email">Email</label>
                            <input 
                                type="text"
                                name="email"
                                id="email"
                                class="form-control form-control-xl"
                                placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input 
                                type="text"
                                name="username"
                                id="username"
                                class="form-control form-control-xl"
                                placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="auth-login.html"
                                class="font-bold">Log
                                in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>