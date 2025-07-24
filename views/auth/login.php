<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?? '' ?></h2>
    <p class="auth__texto">Inicia Sesion en Sitio Web </p>
    <?php require_once __DIR__. '/../templates/alertas.php'; ?>


    <form  class="formulario" method="POST" action="/">
        <div class="formulario__campo">
            <label for="email"  class="formulario__label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="formulario__input" 
                placeholder="Tu Email" 
                id="email"
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
        <input type="submit" value="Iniciar Sesion" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
        <a href="/registro" class="acciones__enlace">Crear Cuenta</a>
    </div>
</main>




<div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="email">Email:</label>
                            <input 
                                type="text" 
                                id="email" 
                                name="email"
                                class="form-control form-control-xl"
                                placeholder="email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="password">Password:</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                class="form-control form-control-xl" 
                                placeholder="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="auth-register.html"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
