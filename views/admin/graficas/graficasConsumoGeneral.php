<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Consumo por Máquina</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #eef4ff;
      padding: 30px;
      font-family: Arial, sans-serif;
    }
    h2 {
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 25px;
    }
  </style>
</head>
<body>

  <!-- TÍTULO -->
  <div class="container mb-4">
    <h2>Consumo General por Máquina</h2>
  </div>

  <!-- FORMULARIO DE FILTRO -->
  <div class="container mb-5">
    <form id="formFiltroMaquinas" class="row g-3 align-items-end">
      <div class="col-md-4">
        <label for="inputFechaInicio" class="form-label">Fecha Inicio</label>
        <input type="date" class="form-control" id="inputFechaInicio" required>
      </div>
      <div class="col-md-4">
        <label for="inputFechaFin" class="form-label">Fecha Fin</label>
        <input type="date" class="form-control" id="inputFechaFin" required>
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
      </div>
    </form>
  </div>

  <!-- GRÁFICA DE MÁQUINAS -->
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-body">
        <div id="graficoConsumoMaquinas"></div>
      </div>
    </div>
  </div>

  <!-- SCRIPT JS -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const contenedorGrafico = document.querySelector("#graficoConsumoMaquinas");
      let graficoMaquinas = null;

      function filtrarPorFechas(datos, inicio, fin) {
        const desde = new Date(inicio);
        const hasta = new Date(fin);
        return datos.filter(item => {
          const fecha = new Date(item.created_at);
          return fecha >= desde && fecha <= hasta;
        });
      }

      function agruparPorTipo(datos) {
        const agrupado = {};
        datos.forEach(item => {
          const tipo = item.tipo_maquina.trim();
          const total = parseFloat(item.total_general);
          agrupado[tipo] = (agrupado[tipo] || 0) + total;
        });

        return {
          etiquetas: Object.keys(agrupado),
          valores: Object.values(agrupado)
        };
      }

      async function cargarDatos(fechaInicio = null, fechaFin = null) {
        try {
          const res = await fetch("https://pruebas.megawebsistem.com/admin/api/apiGraficasConsumoGeneral");
          const datos = await res.json();

          let datosFiltrados = datos;
          if (fechaInicio && fechaFin) {
            datosFiltrados = filtrarPorFechas(datos, fechaInicio, fechaFin);
          }

          const { etiquetas, valores } = agruparPorTipo(datosFiltrados);

          const opciones = {
            chart: {
              type: "bar",
              height: 400
            },
            series: [{
              name: "Consumo (Total General)",
              data: valores
            }],
            xaxis: {
              categories: etiquetas,
              labels: { rotate: -45 }
            },
            dataLabels: {
              enabled: true
            },
            colors: ['#00BFFF']
          };

          // Destruir gráfico anterior
          if (graficoMaquinas) graficoMaquinas.destroy();

          graficoMaquinas = new ApexCharts(contenedorGrafico, opciones);
          graficoMaquinas.render();

        } catch (error) {
          console.error("Error al cargar los datos:", error);
        }
      }

      // Evento formulario
      document.getElementById("formFiltroMaquinas").addEventListener("submit", e => {
        e.preventDefault();
        const fechaInicio = document.getElementById("inputFechaInicio").value;
        const fechaFin = document.getElementById("inputFechaFin").value;
        cargarDatos(fechaInicio, fechaFin);
      });

      // Carga inicial sin filtro
      cargarDatos();
    });
  </script>
</body>
</html>
