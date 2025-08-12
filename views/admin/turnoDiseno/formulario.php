  <!-- NOMBRE DEL CLIENTE -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="detalle">Detalle</label>
      <textarea id="detalle" class="form-control form-control-sm"
        placeholder="Escribe el detalle aquí..." name="detalle" rows="4"><?php
                                                                          echo isset($diseno) ? s($diseno->detalle) : '';
                                                                          ?></textarea>
    </div>
  </div>

  <!-- NOMBRE DEL VENDEDOR -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="vendedor">Nombre del Vendedor</label>
      <input type="text" id="vendedor" class="form-control"
        placeholder="Nombre del Vendedor" name="vendedor"
        value="<?php echo isset($diseno) ? s($diseno->vendedor) : ''; ?>">
    </div>
  </div>

  <!--  Observaciones -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="observaciones">Observaciones</label>
      <input type="text" id="observaciones" class="form-control"
        placeholder="Observaciones" name="observaciones"
        value="<?php echo isset($diseno) ? s($diseno->observaciones) : ''; ?>">
    </div>
  </div>