  <!-- NOMBRE DEL CLIENTE -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="detalle">Detalle</label>
      <textarea id="detalle" class="form-control form-control-sm"
        placeholder="......." name="detalle" rows="3"><?php echo isset($turno) ? s($turno->detalle) : ''; ?></textarea>
    </div>
  </div>

  <!-- OPCIONES CAJAS, LAMINAS , OTROS -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="opciones">Tipo producto</label>
      <select id="opciones" class="form-control" name="opciones">
        <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione una opción</option>
        <option value="CAJAS" <?php echo isset($turno) && $turno->opciones === 'CAJAS' ? 'selected' : ''; ?>>Cajas</option>
        <option value="LAMINAS" <?php echo isset($turno) && $turno->opciones === 'LAMINAS' ? 'selected' : ''; ?>>Láminas</option>
        <option value="OTROS" <?php echo isset($turno) && $turno->opciones === 'OTROS' ? 'selected' : ''; ?>>Otros</option>
      </select>
    </div>
  </div>


  <!-- OPCIONES TAPA-FLORICLTORA,BASE-FLORICULTORA, CAJA-TROQUELADA,TAPA-TELESCOPICA,BASE-TELESCOPICA,CAJA-REGULAR ,LAMINA-MICROCORRGADO,CAPUCHON-FLOR,SEPARADOR-FLOR,LARGUERO,TRANSVERSAL -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="tipo">Tipo componente</label>
      <select id="tipo" class="form-control" name="tipo">
        <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un tipo</option>
        <option value="TAPA-FLORICULTORA" <?php echo isset($turno) && $turno->tipo === 'TAPA-FLORICULTORA' ? 'selected' : ''; ?>>Tapa Floricultora</option>
        <option value="BASE-FLORICULTORA" <?php echo isset($turno) && $turno->tipo === 'BASE-FLORICULTORA' ? 'selected' : ''; ?>>Base Floricultora</option>
        <option value="CAJA-TROQUELADA" <?php echo isset($turno) && $turno->tipo === 'CAJA-TROQUELADA' ? 'selected' : ''; ?>>Caja Troquelada</option>
        <option value="TAPA-TELESCOPICA" <?php echo isset($turno) && $turno->tipo === 'TAPA-TELESCOPICA' ? 'selected' : ''; ?>>Tapa Telescópica</option>
        <option value="BASE-TELESCOPICA" <?php echo isset($turno) && $turno->tipo === 'BASE-TELESCOPICA' ? 'selected' : ''; ?>>Base Telescópica</option>
        <option value="CAJA-REGULAR" <?php echo isset($turno) && $turno->tipo === 'CAJA-REGULAR' ? 'selected' : ''; ?>>Caja Regular</option>
        <option value="LAMINA-MICROCORRGADO" <?php echo isset($turno) && $turno->tipo === 'LAMINA-MICROCORRGADO' ? 'selected' : ''; ?>>Lámina Microcorrugado</option>
        <option value="CAPUCHON-FLOR" <?php echo isset($turno) && $turno->tipo === 'CAPUCHON-FLOR' ? 'selected' : ''; ?>>Capuchón Flor</option>
        <option value="SEPARADOR-FLOR" <?php echo isset($turno) && $turno->tipo === 'SEPARADOR-FLOR' ? 'selected' : ''; ?>>Separador Flor</option>
        <option value="LARGUERO" <?php echo isset($turno) && $turno->tipo === 'LARGUERO' ? 'selected' : ''; ?>>Larguero</option>
        <option value="TRANSVERSAL" <?php echo isset($turno) && $turno->tipo === 'TRANSVERSAL' ? 'selected' : ''; ?>>Transversal</option>
      </select>
    </div>
  </div>



  <!-- OPCIONES CAJAS, LAMINAS , OTROS -->
<div class="col-md-6 col-12">
  <div class="form-group">
    <label for="opciones">Tipo producto</label>
    <select id="opciones" class="form-control" name="opciones">
      <option value="" disabled selected>Seleccione una opción</option>
      <option value="CAJAS">Cajas</option>
      <option value="LAMINAS">Láminas</option>
      <option value="OTROS">Otros</option>
    </select>
  </div>
</div>

<!-- OPCIONES TIPOS SEGÚN PRODUCTO -->
<div class="col-md-6 col-12">
  <div class="form-group">
    <label for="tipo">Tipo componente</label>
    <select id="tipo" class="form-control" name="tipo">
      <option value="" disabled selected>Seleccione un tipo</option>
    </select>
  </div>
</div>

<script>
  // Opciones agrupadas por producto
  const opcionesPorProducto = {
    CAJAS: [
      { value: "CAJA-TROQUELADA", text: "Caja Troquelada" },
      { value: "CAJA-REGULAR", text: "Caja Regular" },
      { value: "TAPA-FLORICULTORA", text: "Tapa Floricultora" },
      { value: "BASE-FLORICULTORA", text: "Base Floricultora" },
      { value: "TAPA-TELESCOPICA", text: "Tapa Telescópica" },
      { value: "BASE-TELESCOPICA", text: "Base Telescópica" }
    ],
    LAMINAS: [
      { value: "LAMINA-MICROCORRGADO", text: "Lámina Microcorrugado" }
    ],
    OTROS: [
      { value: "CAPUCHON-FLOR", text: "Capuchón Flor" },
      { value: "SEPARADOR-FLOR", text: "Separador Flor" },
      { value: "LARGUERO", text: "Larguero" },
      { value: "TRANSVERSAL", text: "Transversal" }
    ]
  };

  const selectProducto = document.getElementById("opciones");
  const selectTipo = document.getElementById("tipo");

  selectProducto.addEventListener("change", function () {
    const categoria = this.value;
    const opciones = opcionesPorProducto[categoria] || [];

    // Limpia opciones previas
    selectTipo.innerHTML = '<option value="" disabled selected>Seleccione un tipo</option>';

    // Agrega nuevas opciones según la categoría seleccionada
    opciones.forEach(op => {
      const option = document.createElement("option");
      option.value = op.value;
      option.textContent = op.text;
      selectTipo.appendChild(option);
    });
  });
</script>






  <!-- select de vendedores poner nombres en html -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="vendedor">Nombre del Vendedor</label>
      <select id="vendedor" class="choices form-control" name="vendedor">
        <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un vendedor</option>
        <option value="JHON VACA" <?php echo isset($turno) && $turno->vendedor === 'JHON VACA' ? 'selected' : ''; ?>>JHON VACA</option>
        <option value="ANTONELLA DESCALZI" <?php echo isset($turno) && $turno->vendedor === 'ANTONELLA DESCALZI' ? 'selected' : ''; ?>>ANTONELLA DESCALZI</option>
        <option value="CARLOS DELGADO" <?php echo isset($turno) && $turno->vendedor === 'CARLOS DELGADO' ? 'selected' : ''; ?>>CARLOS DELGADO</option>
        <option value="CAROLINA MUÑOZ" <?php echo isset($turno) && $turno->vendedor === 'CAROLINA MUÑOZ' ? 'selected' : ''; ?>>CAROLINA MUÑOZ</option>
        <option value="SHULYANA HERNANDEZ" <?php echo isset($turno) && $turno->vendedor === 'SHULYANA HERNANDEZ' ? 'selected' : ''; ?>>SHULYANA HERNANDEZ</option>
        <option value="GABRIEL MALDONADO" <?php echo isset($turno) && $turno->vendedor === 'GABRIEL MALDONADO' ? 'selected' : ''; ?>>GABRIEL MALDONADO</option>
      </select>
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


  <?php if ($email !== 'ventas@megaecuador.com') { ?>
    <div class="col-md-6 col-12">
      <div class="form-group">
        <label for="fecha_entrega">Fecha y Hora de Entrega</label>
        <input type="datetime-local" id="fecha_entrega" class="form-control"
          placeholder="Fecha y Hora de Entrega" name="fecha_entrega"
          value="<?php echo isset($turno) ? date('Y-m-d\TH:i', strtotime($turno->fecha_entrega)) : ''; ?>">
      </div>
    </div>


    <!-- estado -->
    <div class="col-md-6 col-12">
      <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" class="form-control" name="estado">
          <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un estado</option>
          <option value="PENDIENTE" <?php echo isset($turno) && $turno->estado === 'PENDIENTE' ? 'selected' : ''; ?>>Pendiente</option>
          <option value="EN PROCESO" <?php echo isset($turno) && $turno->estado === 'EN_PROCESO' ? 'selected' : ''; ?>>En Proceso</option>
          <option value="ENTREGADO" <?php echo isset($turno) && $turno->estado === 'ENTREGADO' ? 'selected' : ''; ?>>Entregado</option>
        </select>
      </div>
    </div>
  <?php } ?>