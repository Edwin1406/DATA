  <!-- NOMBRE DEL CLIENTE -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre del Cliente</label>
                                            <input type="text" id="nombre_cliente" class="form-control"
                                                placeholder="Nombre del Cliente" name="nombre_cliente"
                                                value="<?php echo s($diseno->nombre_cliente); ?>">
                                        </div>
                                    </div>


                                    <!-- NOMBRE DEL PROVEEDOR -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="proveedor">Nombre del Proveedor</label>
                                            <input type="text" id="proveedor" class="form-control"
                                                placeholder="Nombre del Proveedor" name="proveedor"
                                                value="<?php echo s($diseno->proveedor); ?>">
                                        </div>
                                    </div>

                                    <!-- NOMBRE DEL PRODUCTO -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre del Producto</label>
                                            <input type="text" id="nombre_producto" class="form-control"
                                                placeholder="Nombre del Producto" name="nombre_producto"
                                                value="<?php echo s($diseno->nombre_producto); ?>">
                                        </div>
                                    </div>

                                    <!-- COD. PRODUCTO -->

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="codigo_producto">Código del Producto</label>
                                            <input type="text" id="codigo_producto" class="form-control"
                                                placeholder="Código del Producto" name="codigo_producto"
                                                value="<?php echo s($diseno->codigo_producto); ?>">
                                        </div>
                                    </div>

                                    <!-- estado enviado,pausado,terminado-->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-select" name="estado" id="estado">
                                                <option value="ENVIADO" <?php echo s($diseno->estado) === 'ENVIADO' ? 'selected' : ''; ?>>Enviado</option>
                                                <option value="PAUSADO" <?php echo s($diseno->estado) === 'PAUSADO' ? 'selected' : ''; ?>>Pausado</option>
                                                <option value="TERMINADO" <?php echo s($diseno->estado) === 'TERMINADO' ? 'selected' : ''; ?>>Terminado</option>
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
            <a href="<?php echo $_ENV['HOST'] . '/src/visor/' . $diseno->pdf; ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                Ver / Descargar PDF
            </a>
            <br><br>

            <form method="POST" action="/admin/diseno/eliminarPDF" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este PDF?');">
                <input type="hidden" name="id" value="<?php echo $diseno->id; ?>">
                <button type="submit" class="btn btn-danger btn-sm">Eliminar PDF</button>
            </form>
        </div>
    </div>
<?php endif; ?>

