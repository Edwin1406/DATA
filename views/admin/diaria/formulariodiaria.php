<!-- FECHA -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" class="form-control" placeholder="Fecha" name="fecha"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->fecha) : date('Y-m-d'); ?>">
  </div>
</div>

<!-- Linea de Producción -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="linea">Linea de Producción</label>
    <select class="form-select" name="linea" id="linea">
      <option value="MICRO" <?php echo isset($produccion_diaria) && s($produccion_diaria->linea) === 'MICRO' ? 'selected' : ''; ?>>Micro</option>
      <option value="SEPARADORES" <?php echo isset($produccion_diaria) && s($produccion_diaria->linea) === 'SEPARADORES' ? 'selected' : ''; ?>>Separadores</option>
      <option value="PERIODICO" <?php echo isset($produccion_diaria) && s($produccion_diaria->linea) === 'PERIODICO' ? 'selected' : ''; ?>>Periódico</option>
      <option value="CORRUGADOR PLANCHAS" <?php echo isset($produccion_diaria) && s($produccion_diaria->linea) === 'CORRUGADOR PLANCHAS' ? 'selected' : ''; ?>>Corrugado de Planchas</option>
      <option value="CORRUGADOR CAJAS" <?php echo isset($produccion_diaria) && s($produccion_diaria->linea) === 'CORRUGADOR CAJAS' ? 'selected' : ''; ?>>Corrugado de Cajas</option>
      <option value="CORRUGADOR PLANCHAS/CAJAS" <?php echo isset($produccion_diaria) && s($produccion_diaria->linea) === 'CORRUGADOR PLANCHAS/CAJAS' ? 'selected' : ''; ?>>Corrugado Planchas/Cajas</option>
    </select>
  </div>
</div>

<!-- UNIDADES X DIA -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="unidad_x_dia">Unidad x dia</label>
    <input type="text" id="unidad_x_dia" class="form-control" placeholder="Unidad x dia" name="unidad_x_dia"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->unidad_x_dia) : ''; ?>">
  </div>
</div>

<!-- METROS LINEALES -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="metros_lineales">Metros Lineales</label>
    <input type="text" id="metros_lineales" class="form-control" placeholder="Metros Lineales" name="metros_lineales"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->metros_lineales) : ''; ?>">
  </div>
</div>

<!-- KILOS X DIA -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="kilos_x_dia">Kilos x dia</label>
    <input type="text" id="kilos_x_dia" class="form-control" placeholder="Kilos x dia" name="kilos_x_dia"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->kilos_x_dia) : ''; ?>">
  </div>
</div>

<!-- Refile STD -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="refile_std">Refile STD</label>
    <input type="text" id="refile_std" class="form-control" placeholder="Refile STD" name="refile_std"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->refile_std) : ''; ?>">
  </div>
</div>

<!-- Extra Trim -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="extra_trim">Extra Trim</label>
    <input type="text" id="extra_trim" class="form-control" placeholder="Extra Trim" name="extra_trim"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->extra_trim) : ''; ?>">
  </div>
</div>

<!-- Desperdicio Lamina -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="desperdicio_lamina">Desperdicio Lamina</label>
    <input type="text" id="desperdicio_lamina" class="form-control" placeholder="Desperdicio Lamina" name="desperdicio_lamina"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->desperdicio_lamina) : ''; ?>">
  </div>
</div>

<!-- Turno -->
<div class="col-md-1 col-12">
  <div class="form-group">
    <label for="turno">Turno</label>
    <input type="text" id="turno" class="form-control" placeholder="Turno" name="turno"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->turno) : ''; ?>">
  </div>
</div>

<!-- Horas de Maquina -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="horas_maquina">Horas de Maquina</label>
    <input type="time" id="horas_maquina" class="form-control" placeholder="Horas de Maquina" name="horas_maquina"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->horas_maquina) : ''; ?>">
  </div>
</div>

<!-- Cambios -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="cambios">Cambios</label>
    <input type="text" id="cambios" class="form-control" placeholder="Cambios" name="cambios"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->cambios) : ''; ?>">
  </div>
</div>

<!-- Tiempo X Cambio -->
<div class="col-md-3 col-12">
  <div class="form-group">
    <label for="tiempo_x_cambio">Tiempo x cambio medida</label>
    <input type="text" id="tiempo_x_cambio" class="form-control" placeholder="Tiempo x cambio de medida" name="tiempo_x_cambio"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->tiempo_x_cambio) : ''; ?>">
  </div>
</div>

<!-- Unidades X Procesar -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="unidades_x_procesar">Unidades x procesar</label>
    <input type="text" id="unidades_x_procesar" class="form-control" placeholder="Unidades x procesar" name="unidades_x_procesar"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->unidades_x_procesar) : ''; ?>">
  </div>
</div>

<!-- Kilos X Procesar -->
<div class="col-md-2 col-12">
  <div class="form-group">
    <label for="kilos_x_procesar">Kilos x procesar</label>
    <input type="text" id="kilos_x_procesar" class="form-control" placeholder="Kilos x procesar" name="kilos_x_procesar"
      value="<?php echo isset($produccion_diaria) ? s($produccion_diaria->kilos_x_procesar) : ''; ?>">
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    // Función que se ejecuta cada vez que se cambia la selección de "Linea de Producción"
    $('#linea').change(function() {
      var selectedLinea = $(this).val(); // Obtiene el valor seleccionado

      // Reseteamos la visibilidad de todos los campos
      $('.form-group').show();
      
      // Ocultamos todos los elementos inicialmente
      $('.form-group').css('display', 'none');

      // Lógica para ocultar los campos según la opción seleccionada
      switch (selectedLinea) {
        case 'SEPARADORES':
          $('#kilos_x_procesar').closest('.form-group').css('display', 'none');
          $('#kilos_x_dia').closest('.form-group').css('display', 'none');
          $('#metros_lineales').closest('.form-group').css('display', 'none');
          $('#refile_std').closest('.form-group').css('display', 'none');
          $('#extra_trim').closest('.form-group').css('display', 'none');
          $('#desperdicio_lamina').closest('.form-group').css('display', 'none');
          $('#turno').closest('.form-group').css('display', 'none');
          $('#horas_maquina').closest('.form-group').css('display', 'none');
          $('#cambios').closest('.form-group').css('display', 'none');
          $('#tiempo_x_cambio').closest('.form-group').css('display', 'none');
          break;

        case 'MICRO':
          $('#metros_lineales').closest('.form-group').css('display', 'none');
          $('#refile_std').closest('.form-group').css('display', 'none');
          $('#extra_trim').closest('.form-group').css('display', 'none');
          $('#desperdicio_lamina').closest('.form-group').css('display', 'none');
          $('#turno').closest('.form-group').css('display', 'none');
          $('#horas_maquina').closest('.form-group').css('display', 'none');
          $('#cambios').closest('.form-group').css('display', 'none');
          $('#tiempo_x_cambio').closest('.form-group').css('display', 'none');
          break;

        case 'PERIODICO':
          $('#metros_lineales').closest('.form-group').css('display', 'none');
          $('#refile_std').closest('.form-group').css('display', 'none');
          $('#extra_trim').closest('.form-group').css('display', 'none');
          $('#desperdicio_lamina').closest('.form-group').css('display', 'none');
          $('#turno').closest('.form-group').css('display', 'none');
          $('#horas_maquina').closest('.form-group').css('display', 'none');
          $('#cambios').closest('.form-group').css('display', 'none');
          $('#tiempo_x_cambio').closest('.form-group').css('display', 'none');
          break;

        case 'CORRUGADOR PLANCHAS/CAJAS':
          // Mostrar todos los campos (por defecto ya se están mostrando)
          break;

        case 'CORRUGADOR CAJAS':
          $('#unidades_x_dia').closest('.form-group').css('display', 'none');
          $('#metros_lineales').closest('.form-group').css('display', 'none');
          $('#kilos_x_dia').closest('.form-group').css('display', 'none');
          $('#refile_std').closest('.form-group').css('display', 'none');
          $('#extra_trim').closest('.form-group').css('display', 'none');
          $('#desperdicio_lamina').closest('.form-group').css('display', 'none');
          $('#turno').closest('.form-group').css('display', 'none');
          $('#horas_maquina').closest('.form-group').css('display', 'none');
          $('#cambios').closest('.form-group').css('display', 'none');
          $('#tiempo_x_cambio').closest('.form-group').css('display', 'none');
          break;

        case 'CORRUGADOR PLANCHAS':
          $('#unidades_x_dia').closest('.form-group').css('display', 'none');
          $('#metros_lineales').closest('.form-group').css('display', 'none');
          $('#kilos_x_dia').closest('.form-group').css('display', 'none');
          $('#refile_std').closest('.form-group').css('display', 'none');
          $('#extra_trim').closest('.form-group').css('display', 'none');
          $('#desperdicio_lamina').closest('.form-group').css('display', 'none');
          $('#turno').closest('.form-group').css('display', 'none');
          $('#horas_maquina').closest('.form-group').css('display', 'none');
          $('#cambios').closest('.form-group').css('display', 'none');
          $('#tiempo_x_cambio').closest('.form-group').css('display', 'none');
          break;

        default:
          // Si no se selecciona ninguna de las opciones relevantes, mostramos todo
          $('.form-group').css('display', 'block');
      }
    });

    // Llamar a la función al cargar la página en caso de que ya haya un valor seleccionado
    $('#linea').change();
  });
</script>
