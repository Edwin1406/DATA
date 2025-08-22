<!-- OPCIONES CAJAS, LAMINAS , OTROS -->
<div class="col-md-6 col-12">
  <div class="form-group">
    <label for="tipo_producto">Tipo producto</label>
    <select id="tipo_producto" class="form-control" name="tipo_producto">
      <option value="" disabled selected>Seleccione una opción</option>
      <option value="CAJAS" <?php echo (isset($turno) && $turno->tipo_producto === 'CAJAS') ? 'selected' : ''; ?>>Cajas</option>
      <option value="LAMINAS" <?php echo (isset($turno) && $turno->tipo_producto === 'LAMINAS') ? 'selected' : ''; ?>>Láminas</option>
      <option value="OTROS" <?php echo (isset($turno) && $turno->tipo_producto === 'OTROS') ? 'selected' : ''; ?>>Otros</option>
    </select>
  </div>
</div>

<!-- OPCIONES TIPOS SEGÚN PRODUCTO -->
<div class="col-md-6 col-12">
  <div class="form-group">
    <label for="tipo_componente">Tipo componente</label>
    <select id="tipo_componente" class="form-control" name="tipo_componente">
      <option value=" " disabled selected>Seleccione un tipo</option>
    </select>
  </div>
</div>


<!-- CAMPOS DINÁMICOS 3 columnas-->
<div id="campos-dinamicos" class="row">

  <!-- LARGO -->
  <div class="col-md-4 col-12 campo" id="campo-largo" style="display:none;">
    <div class="form-group">
      <label for="largo">Largo</label>
      <input type="number" id="largo" class="form-control" placeholder="Largo" name="largo"
        value="<?php echo isset($turno) ? s($turno->largo) : ''; ?>">
    </div>
  </div>

  <!-- ANCHO -->
  <div class="col-md-4 col-12 campo" id="campo-ancho" style="display:none;">
    <div class="form-group">
      <label for="ancho">Ancho</label>
      <input type="number" id="ancho" class="form-control" placeholder="Ancho" name="ancho"
        value="<?php echo isset($turno) ? s($turno->ancho) : ''; ?>">
    </div>
  </div>

  <!-- ALTO -->
  <div class="col-md-4 col-12 campo" id="campo-alto" style="display:none;">
    <div class="form-group">
      <label for="alto">Alto</label>
      <input type="number" id="alto" class="form-control" placeholder="Alto" name="alto"
        value="<?php echo isset($turno) ? s($turno->alto) : ''; ?>">
    </div>
  </div>



  <!-- DOBLES (solo lámina) -->
  <div class="col-md-4 col-12 campo lamina" style="display:none;">
    <div class="form-group">
      <label for="dobles">¿Con doblez?</label>
      <select id="dobles" class="form-control" name="dobles">
        <option value="" disabled selected>Seleccione una opción</option>
        <option value="SI">Sí</option>
        <option value="NO">No</option>
      </select>
    </div>
  </div>

  <div class="col-md-4 col-12 campo otros" style="display: none;">
    <div class="form-group">
      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" class="form-control form-control-sm"
        placeholder="......." name="descripcion" rows="3"><?php echo isset($turno) ? s($turno->descripcion) : ''; ?></textarea>
    </div>
  </div>


  <!-- FLAUTA -->
  <div class="col-md-4 col-12 campo cajas" style="display:none;">
    <div class="form-group">
      <label for="flauta">Flauta</label>
      <input type="text" id="flauta" class="form-control" placeholder="Flauta" name="flauta"
        value="<?php echo isset($turno) ? s($turno->flauta) : ''; ?>">
    </div>
  </div>

  <!-- MATERIAL -->
  <div class="col-md-4 col-12 campo cajas" style="display:none;">
    <div class="form-group">
      <label for="material">Material</label>
      <input type="text" id="material" class="form-control" placeholder="Material" name="material"
        value="<?php echo isset($turno) ? s($turno->material) : ''; ?>">
    </div>
  </div>

  <!-- ECT -->
  <div class="col-md-4 col-12 campo cajas" style="display:none;">
    <div class="form-group">
      <label for="ect">ECT</label>
      <input type="number" id="ect" class="form-control" placeholder="ECT" name="ect"
        value="<?php echo isset($turno) ? s($turno->ect) : ''; ?>">
    </div>
  </div>

</div>

<script>
  // Opciones agrupadas por producto
  const opcionesPorProducto = {
    CAJAS: [{
        value: "CAJA-TROQUELADA",
        text: "Caja Troquelada"
      },
      {
        value: "CAJA-REGULAR",
        text: "Caja Regular"
      },
      {
        value: "TAPA-FLORICULTORA",
        text: "Tapa Floricultora"
      },
      {
        value: "BASE-FLORICULTORA",
        text: "Base Floricultora"
      },
      {
        value: "TAPA-TELESCOPICA",
        text: "Tapa Telescópica"
      },
      {
        value: "BASE-TELESCOPICA",
        text: "Base Telescópica"
      }
    ],
    LAMINAS: [{
      value: "LAMINA-MICROCORRGADO",
      text: "Lámina Microcorrugado"
    }],
    OTROS: [{
        value: "CAPUCHON-FLOR",
        text: "Capuchón Flor"
      },
      {
        value: "SEPARADOR-FLOR",
        text: "Separador Flor"
      },
      {
        value: "LARGUERO",
        text: "Larguero"
      },
      {
        value: "TRANSVERSAL",
        text: "Transversal"
      },
      {
        value: "BARRIDOS-COLOR",
        text: "Barridos Color"
      }
    ]
  };

  const selectProducto = document.getElementById("tipo_producto");
  const selectTipo = document.getElementById("tipo_componente");

  selectProducto.addEventListener("change", function() {
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





  function mostrarCampos() {
    const tipo = selectTipo.value;

    // Ocultar todo
    document.querySelectorAll(".campo").forEach(el => el.style.display = "none");

    // Lógica según el tipo seleccionado
    if (tipo === "LAMINA-MICROCORRGADO") {
      document.getElementById("campo-largo").style.display = "block";
      document.getElementById("campo-alto").style.display = "block";
      document.querySelectorAll(".lamina").forEach(el => el.style.display = "block");
    } else if (["CAPUCHON-FLOR", "SEPARADOR-FLOR", "LARGUERO", "TRANSVERSAL"].includes(tipo)) {
      document.querySelectorAll(".otros").forEach(el => el.style.display = "block");
    } else {
      // Cajas y similares
      document.getElementById("campo-largo").style.display = "block";
      document.getElementById("campo-alto").style.display = "block";
      document.getElementById("campo-ancho").style.display = "block";
      document.querySelectorAll(".cajas").forEach(el => el.style.display = "block");
    }
  }

  selectTipo.addEventListener("change", mostrarCampos);

  // Si vienes con un valor cargado desde PHP ($turno->tipo), mostrarlo automáticamente
  window.addEventListener("DOMContentLoaded", mostrarCampos);
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


  <!-- COLORES ARRAY  -->
  <div class="col-md-6 col-12">
    <div class="form-group">
      <label for="color">Color</label>
      <select id="color" class="choices form-control" name="color">
        <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un color</option>
        <option value="ROJO" <?php echo isset($turno) && $turno->color === 'ROJO' ? 'selected' : ''; ?>>Rojo</option>
        <option value="VERDE" <?php echo isset($turno) && $turno->color === 'VERDE' ? 'selected' : ''; ?>>Verde</option>
        <option value="AZUL" <?php echo isset($turno) && $turno->color === 'AZUL' ? 'selected' : ''; ?>>Azul</option>
        <option value="AMARILLO" <?php echo isset($turno) && $turno->color === 'AMARILLO' ? 'selected' : ''; ?>>Amarillo</option>
        <option value="NEGRO" <?php echo isset($turno) && $turno->color === 'NEGRO' ? 'selected' : ''; ?>>Negro</option>
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