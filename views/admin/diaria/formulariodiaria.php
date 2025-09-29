  <!-- FECHA -->
  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" class="form-control"
        placeholder="Fecha" name="fecha"
        value="<?php echo isset($diseno) ? s($diseno->fecha) : ''; ?>">
    </div>
  </div>


  <!-- NOMBRE DEL PROVEEDOR -->

  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="proveedor">Nombre del Proveedor</label>
      <input type="text" id="proveedor" class="form-control"
        placeholder="Nombre del Proveedor" name="proveedor"
        value="<?php echo isset($diseno) ? s($diseno->proveedor) : ''; ?>">
    </div>
  </div>

  <!-- NOMBRE DEL PRODUCTO -->
  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="nombre_producto">Nombre del Producto</label>
      <input type="text" id="nombre_producto" class="form-control"
        placeholder="Nombre del Producto" name="nombre_producto"
        value="<?php echo isset($diseno) ? s($diseno->nombre_producto) : ''; ?>">
    </div>
  </div>

  <!-- COD. PRODUCTO -->

  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="codigo_producto">Código del Producto</label>
      <input type="text" id="codigo_producto" class="form-control"
        placeholder="Código del Producto" name="codigo_producto"
        value="<?php echo isset($diseno) ? s($diseno->codigo_producto) : ''; ?>">
    </div>
  </div>

  <!-- estado enviado,pausado,terminado-->
  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="estado">Estado</label>
      <select class="form-select" name="estado" id="estado">
        <option value="ARTE" <?php echo isset($diseno) && s($diseno->estado) === 'ARTE' ? 'selected' : ''; ?>>Arte</option>
        <option value="APROBADO" <?php echo isset($diseno) && s($diseno->estado) === 'APROBADO' ? 'selected' : ''; ?>>Aprobado</option>
        <option value="CLICHE" <?php echo isset($diseno) && s($diseno->estado) === 'CLICHE' ? 'selected' : ''; ?>>Cliché</option>
      </select>
    </div>
  </div>




