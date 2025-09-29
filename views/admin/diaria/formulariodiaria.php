  <!-- FECHA -->
  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" class="form-control"
        placeholder="Fecha" name="fecha"
        value="<?php echo isset($diseno) ? s($diseno->fecha) : ''; ?>">
    </div>
  </div>


  <!-- NOMBRE X DIA -->

  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="unidad_x_dia">Unidad x dia</label>
      <input type="text" id="unidad_x_dia" class="form-control"
        placeholder="Unidad x dia" name="unidad_x_dia"
        value="<?php echo isset($diseno) ? s($diseno->unidad_x_dia) : ''; ?>">
    </div>
  </div>

  <!-- METROS LINEALES -->
  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="metros_lineales">Metros Lineales</label>
      <input type="text" id="metros_lineales" class="form-control"
        placeholder="Metros Lineales" name="metros_lineales"
        value="<?php echo isset($diseno) ? s($diseno->metros_lineales) : ''; ?>">
    </div>
  </div>

  <!-- KILOS X DIA -->
  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="kilos_x_dia">Kilos x dia</label>
      <input type="text" id="kilos_x_dia" class="form-control"
        placeholder="Kilos x dia" name="kilos_x_dia"
        value="<?php echo isset($diseno) ? s($diseno->kilos_x_dia) : ''; ?>">
    </div>
  </div>


  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="refile_std">Refile STD</label>
      <input type="text" id="refile_std" class="form-control"
        placeholder="Refile STD" name="refile_std"
        value="<?php echo isset($diseno) ? s($diseno->refile_std) : ''; ?>">
    </div>
  </div>


  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="extra_trim">Extra Trim</label>
      <input type="text" id="extra_trim" class="form-control"
        placeholder="Extra Trim" name="extra_trim"
        value="<?php echo isset($diseno) ? s($diseno->extra_trim) : ''; ?>">
    </div>
  </div>



  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="desperdicio_lamina">Desperdicio Lamina</label>
      <input type="text" id="desperdicio_lamina" class="form-control"
        placeholder="Desperdicio Lamina" name="desperdicio_lamina"
        value="<?php echo isset($diseno) ? s($diseno->desperdicio_lamina) : ''; ?>">
    </div>
  </div>


  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="turno">Turno</label>
      <input type="text" id="turno" class="form-control"
        placeholder="Turno" name="turno"
        value="<?php echo isset($diseno) ? s($diseno->turno) : ''; ?>">
    </div>
  </div>

  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="horas_maquina">Horas de Maquina</label>
      <input type="text" id="horas_maquina" class="form-control"
        placeholder="Horas de Maquina" name="horas_maquina"
        value="<?php echo isset($diseno) ? s($diseno->horas_maquina) : ''; ?>">
    </div>
  </div>

  <div class="col-md-3 col-12">
    <div class="form-group">
      <label for="cambios">Cambios</label>
      <input type="text" id="cambios" class="form-control"
        placeholder="Cambios" name="cambios"
        value="<?php echo isset($diseno) ? s($diseno->cambios) : ''; ?>">
    </div>
  </div>



  

  





































  <!-- informacion -->
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