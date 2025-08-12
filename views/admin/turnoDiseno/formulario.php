  <!-- NOMBRE DEL CLIENTE -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="detalle">Detalle</label>
      <textarea id="detalle" class="form-control form-control-sm"
        placeholder="Escribe el detalle aquí..." name="detalle" rows="1"><?php echo isset($turno) ? s($turno->detalle) : ''; ?></textarea>

    </div>
  </div>

  <!-- NOMBRE DEL VENDEDOR -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="vendedor">Nombre del Vendedor</label>
      <input type="text" id="vendedor" class="form-control"
        placeholder="Nombre del Vendedor" name="vendedor"
        value="<?php echo isset($turno) ? s($turno->vendedor) : ''; ?>">
    </div>
  </div>

  <!--  Observaciones -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="observaciones">Observaciones</label>
      <input type="text" id="observaciones" class="form-control"
        placeholder="Observaciones" name="observaciones"
        value="<?php echo isset($turno) ? s($turno->observaciones) : ''; ?>">
    </div>
  </div>
  <!-- fecha de entrega -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="fecha_entrega">Fecha de Entrega</label>
      <input type="date" id="fecha_entrega" class="form-control"
        placeholder="Fecha de Entrega" name="fecha_entrega"
        value="<?php echo isset($turno) ? s($turno->fecha_entrega) : ''; ?>">
    </div>
  </div>

  <!-- estado -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="estado">Estado</label>
      <select id="estado" class="form-control" name="estado">
        <option value="PENDIENTE" <?php echo isset($turno) && $turno->estado === 'PENDIENTE' ? 'selected' : ''; ?>>Pendiente</option>
        <option value="EN_PROCESO" <?php echo isset($turno) && $turno->estado === 'EN_PROCESO' ? 'selected' : ''; ?>>En Proceso</option>
        <option value="FINALIZADO" <?php echo isset($turno) && $turno->estado === 'FINALIZADO' ? 'selected' : ''; ?>>Finalizado</option>
      </select>
    </div>
  </div>