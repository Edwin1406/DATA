<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3><?php echo $titulo ?> </h3>
                        <p class="text-subtitle text-muted">Ingrese los datos del consumo</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><?php echo $nombre; ?></a></li>
                                <!--  cerrar sesión -->
                                <li class="breadcrumb-item"><a href="/cerrarSesion">Cerrar Sesión</a></li>
                             
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            ¡Registro guardado exitosamente!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <?php if (isset($_GET['exito']) && $_GET['exito'] == '1') : ?>
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        // Mostrar el toast
                        var toastEl = document.getElementById('toastExito');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();

                        // Quitar el parámetro ?exito=1 de la URL sin recargar
                        const url = new URL(window.location);
                        url.searchParams.delete('exito');
                        window.history.replaceState({}, document.title, url.toString());
                    });
                </script>
            <?php endif; ?>



            <!-- // Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Registro de Papel</h4>
                                   <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>
                          

                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" action="/admin/consumo">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">First Name</label>
                                                    <input type="text" id="name" class="form-control"
                                                        placeholder="First Name" name="name">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last">Last Name</label>
                                                    <input type="text" id="last" class="form-control"
                                                        placeholder="Last Name" name="last">
                                                </div>
                                            </div>

                                            
  <section class="multiple-choices">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Multiple choices</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <h6>Basic Multiple choices</h6>
                                                <p>Use <code>.choices</code> class for basic choices control. Use
                                                    <code>multiple="multiple"</code>
                                                    attribute for multiple select box.
                                                </p>
                                                <div class="form-group">
                                                    <select class="choices form-select" multiple="multiple">
                                                        <option value="square">Square</option>
                                                        <option value="rectangle" selected>Rectangle</option>
                                                        <option value="rombo">Rombo</option>
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="traible" selected>Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <h6>Multiple Select with Label</h6>
                                                <p>Use <code>optgroup</code> attribute for multiple select box with
                                                    Label control.
                                                </p>
                                                <div class="form-group">
                                                    <select class="choices form-select" multiple="multiple">
                                                        <optgroup label="Figures">
                                                            <option value="romboid">Romboid</option>
                                                            <option value="trapeze" selected>Trapeze</option>
                                                            <option value="triangle">Triangle</option>
                                                            <option value="polygon">Polygon</option>
                                                        </optgroup>
                                                        <optgroup label="Colors">
                                                            <option value="red">Red</option>
                                                            <option value="green">Green</option>
                                                            <option value="blue" selected>Blue</option>
                                                            <option value="purple">Purple</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <h6>Multiple Select with Remove Button</h6>
                                                <p>Use <code>.multiple-remove</code> attribute for multiple select box
                                                    with remove
                                                    button.</p>
                                                <div class="form-group">
                                                    <select class="choices form-select multiple-remove"
                                                        multiple="multiple">
                                                        <optgroup label="Figures">
                                                            <option value="romboid">Romboid</option>
                                                            <option value="trapeze" selected>Trapeze</option>
                                                            <option value="triangle">Triangle</option>
                                                            <option value="polygon">Polygon</option>
                                                        </optgroup>
                                                        <optgroup label="Colors">
                                                            <option value="red">Red</option>
                                                            <option value="green">Green</option>
                                                            <option value="blue" selected>Blue</option>
                                                            <option value="purple">Purple</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <h6>choices with Light Background Options</h6>
                                                <p>Use <code>.select-light-{colorName}</code> class for light background
                                                    to selected
                                                    Options.</p>
                                                <div class="form-group">
                                                    <select class="choices form-select select-light-danger"
                                                        multiple="multiple">
                                                        <option value="square">Square</option>
                                                        <option value="rectangle" selected>Rectangle</option>
                                                        <option value="rombo">Rombo</option>
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="traible" selected>Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>





                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">City</label>
                                                    <input type="text" id="city-column" class="form-control"
                                                        placeholder="City" name="city">
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Country</label>
                                                    <input type="text" id="country-floating" class="form-control"
                                                        name="country" placeholder="Country">
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Company</label>
                                                    <input type="text" id="company-column" class="form-control"
                                                        name="company" placeholder="Company">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Email</label>
                                                    <input type="email" id="email-id-column" class="form-control"
                                                        name="email" placeholder="Email">
                                                </div>
                                            </div> -->

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- // Basic multiple Column Form section end -->
        </div>
