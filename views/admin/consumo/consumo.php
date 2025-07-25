
<div id="app">

    <div id="main">


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
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>



            <!-- // Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Registro de Papel</h4>
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

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2025 &copy; EDWIN DIAZ</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="http://.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>