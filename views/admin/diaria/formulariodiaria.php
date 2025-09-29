  <!-- FECHA -->
  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" class="form-control"
        placeholder="Fecha" name="fecha"
        value="<?php echo isset($diseno) ? s($diseno->fecha) : ''; ?>">
    </div>
  </div>


  <!-- NOMBRE X DIA -->

  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="unidad_x_dia">Unidad x dia</label>
      <input type="text" id="unidad_x_dia" class="form-control"
        placeholder="Unidad x dia" name="unidad_x_dia"
        value="<?php echo isset($diseno) ? s($diseno->unidad_x_dia) : ''; ?>">
    </div>
  </div>

  <!-- METROS LINEALES -->
  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="metros_lineales">Metros Lineales</label>
      <input type="text" id="metros_lineales" class="form-control"
        placeholder="Metros Lineales" name="metros_lineales"
        value="<?php echo isset($diseno) ? s($diseno->metros_lineales) : ''; ?>">
    </div>
  </div>

  <!-- KILOS X DIA -->
  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="kilos_x_dia">Kilos x dia</label>
      <input type="text" id="kilos_x_dia" class="form-control"
        placeholder="Kilos x dia" name="kilos_x_dia"
        value="<?php echo isset($diseno) ? s($diseno->kilos_x_dia) : ''; ?>">
    </div>
  </div>


  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="refile_std">Refile STD</label>
      <input type="text" id="refile_std" class="form-control"
        placeholder="Refile STD" name="refile_std"
        value="<?php echo isset($diseno) ? s($diseno->refile_std) : ''; ?>">
    </div>
  </div>


  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="extra_trim">Extra Trim</label>
      <input type="text" id="extra_trim" class="form-control"
        placeholder="Extra Trim" name="extra_trim"
        value="<?php echo isset($diseno) ? s($diseno->extra_trim) : ''; ?>">
    </div>
  </div>



  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="desperdicio_lamina">Desperdicio Lamina</label>
      <input type="text" id="desperdicio_lamina" class="form-control"
        placeholder="Desperdicio Lamina" name="desperdicio_lamina"
        value="<?php echo isset($diseno) ? s($diseno->desperdicio_lamina) : ''; ?>">
    </div>
  </div>


  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="turno">Turno</label>
      <input type="text" id="turno" class="form-control"
        placeholder="Turno" name="turno"
        value="<?php echo isset($diseno) ? s($diseno->turno) : ''; ?>">
    </div>
  </div>

  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="horas_maquina">Horas de Maquina</label>
      <input type="text" id="horas_maquina" class="form-control"
        placeholder="Horas de Maquina" name="horas_maquina"
        value="<?php echo isset($diseno) ? s($diseno->horas_maquina) : ''; ?>">
    </div>
  </div>

  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="cambios">Cambios</label>
      <input type="text" id="cambios" class="form-control"
        placeholder="Cambios" name="cambios"
        value="<?php echo isset($diseno) ? s($diseno->cambios) : ''; ?>">
    </div>
  </div>

  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="tiempo_x_cambio">Tiempo x cambio de medida</label>
      <input type="text" id="tiempo_x_cambio" class="form-control"
        placeholder="Tiempo x cambio de medida" name="tiempo_x_cambio"
        value="<?php echo isset($diseno) ? s($diseno->tiempo_x_cambio) : ''; ?>">
    </div>
  </div>


  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="unidades_x_procesar">Unidades x procesar</label>
      <input type="text" id="unidades_x_procesar" class="form-control"
        placeholder="Unidades x procesar" name="unidades_x_procesar"
        value="<?php echo isset($diseno) ? s($diseno->unidades_x_procesar) : ''; ?>">
    </div>
  </div>

  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="kilos_x_procesar">Kilos x procesar</label>
      <input type="text" id="kilos_x_procesar" class="form-control"
        placeholder="Kilos x procesar" name="kilos_x_procesar"
        value="<?php echo isset($diseno) ? s($diseno->kilos_x_procesar) : ''; ?>">
    </div>
  </div>


  <!-- informacion -->
  <div class="col-md-2 col-12">
    <div class="form-group">
      <label for="linea">Linea de Producción</label>
      <select class="form-select" name="linea" id="linea">
        <option value="MICRO" <?php echo isset($diseno) && s($diseno->linea) === 'MICRO' ? 'selected' : ''; ?>>Micro</option>
        <option value="SEPARADORES" <?php echo isset($diseno) && s($diseno->linea) === 'SEPARADORES' ? 'selected' : ''; ?>>Separadores</option>
        <option value="PERIODICO" <?php echo isset($diseno) && s($diseno->linea) === 'PERIODICO' ? 'selected' : ''; ?>>Periódico</option>
        <option value="CORRUGADOR PLANCHAS" <?php echo isset($diseno) && s($diseno->linea) === 'CORRUGADOR PLANCHAS' ? 'selected' : ''; ?>>Corrugado de Planchas</option>
        <option value="CORRUGADOR CAJAS" <?php echo isset($diseno) && s($diseno->linea) === 'CORRUGADOR CAJAS' ? 'selected' : ''; ?>>Corrugado de Cajas</option>
        <option value="CORRUGADOR PLANCHAS/CAJAS" <?php echo isset($diseno) && s($diseno->linea) === 'CORRUGADOR PLANCHAS/CAJAS' ? 'selected' : ''; ?>>Corrugado Planchas/Cajas</option>
      </select>
    </div>
  </div>



  