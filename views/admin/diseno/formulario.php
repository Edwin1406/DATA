  <!-- NOMBRE DEL CLIENTE -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre del Cliente</label>
                                            <input type="text" id="nombre_cliente" class="form-control"
                                                placeholder="Nombre del Cliente" name="nombre_cliente">
                                        </div>
                                    </div>


                                    <!-- NOMBRE DEL PROVEEDOR -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="proveedor">Nombre del Proveedor</label>
                                            <input type="text" id="proveedor" class="form-control"
                                                placeholder="Nombre del Proveedor" name="proveedor">
                                        </div>
                                    </div>

                                    <!-- NOMBRE DEL PRODUCTO -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre del Producto</label>
                                            <input type="text" id="nombre_producto" class="form-control"
                                                placeholder="Nombre del Producto" name="nombre_producto">
                                        </div>
                                    </div>

                                    <!-- COD. PRODUCTO -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="codigo_producto">Código del Producto</label>
                                            <input type="text" id="codigo_producto" class="form-control"
                                                placeholder="Código del Producto" name="codigo_producto">
                                        </div>
                                    </div>

                                    <!-- estado enviado,pausado,terminado-->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-select" name="estado" id="estado">
                                                <option value="ENVIADO">Enviado</option>
                                                <option value="PAUSADO">Pausado</option>
                                                <option value="TERMINADO">Terminado</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pdf">Subir PDF del diseño</label>
                                            <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
                                            <small class="form-text text-muted">Solo se permiten archivos PDF.</small>
                                        </div>
                                    </div>

                                    <?php if (isset($diseno->pdf)) : ?>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Archivo actual:</label><br>
                                                <a href="<?php echo $_ENV['HOST'] . '/src/visor/' . $diseno->pdf; ?>"
                                                    target="_blank"
                                                    class="btn btn-outline-primary btn-sm">
                                                    Ver / Descargar PDF
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
