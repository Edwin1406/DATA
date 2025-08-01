<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gráfica de Consumo</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f4ff;
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
    <h2>ESTADÍSTICAS DEL PERFIL</h2>
  </div>

  <!-- FORMULARIO DE FILTRO -->
  <div class="container mb-5">
    <form id="filtroFechas" class="row g-3 align-items-end">
      <div class="col-md-4">
        <label for="fechaInicio" class="form-label">Fecha Inicio</label>
        <input type="date" class="form-control" id="fechaInicio" required>
      </div>
      <div class="col-md-4">
        <label for="fechaFin" class="form-label">Fecha Fin</label>
        <input type="date" class="form-control" id="fechaFin" required>
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
      </div>
    </form>
  </div>

  <!-- GRÁFICA -->
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-body">
        <div id="chart-profile-visit"></div>
      </div>
    </div>
  </div>

  <!-- SCRIPT JS -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const chartContainer = document.querySelector("#chart-profile-visit");
      let chart = null;

      // Filtrar fechas
      function filtrarPorFechas(data, inicio, fin) {
        const start = new Date(inicio);
        const end = new Date(fin);
        return data.filter(item => {
          const fecha = new Date(item.created_at);
          return fecha >= start && fecha <= end;
        });
      }

      // Agrupar por tipo de máquina
      function procesarDatos(data) {
        const resumen = {};

        data.forEach(item => {
          const tipo = item.tipo_maquina.trim();
          const total = parseFloat(item.total_general);
          resumen[tipo] = (resumen[tipo] || 0) + total;
        });

        return {
          categorias: Object.keys(resumen),
          valores: Object.values(resumen)
        };
      }

      // Cargar desde la API
      async function cargarDatos(fechaInicio = null, fechaFin = null) {
        try {
          const res = await fetch("https://pruebas.megawebsistem.com/admin/api/apiGraficasConsumoGeneral");
          const data = await res.json();

          let datosFiltrados = data;
          if (fechaInicio && fechaFin) {
            datosFiltrados = filtrarPorFechas(data, fechaInicio, fechaFin);
          }

          const { categorias, valores } = procesarDatos(datosFiltrados);

          const options = {
            chart: {
              type: "bar",
              height: 400
            },
            series: [{
              name: "Total General",
              data: valores
            }],
            xaxis: {
              categories: categorias,
              labels: { rotate: -45 }
            },
            dataLabels: {
              enabled: true
            },
            colors: ['#1E90FF']
          };

          if (chart) chart.destroy();

          chart = new ApexCharts(chartContainer, options);
          chart.render();

        } catch (error) {
          console.error("Error cargando datos:", error);
        }
      }

      // Evento formulario
      document.getElementById("filtroFechas").addEventListener("submit", e => {
        e.preventDefault();
        const inicio = document.getElementById("fechaInicio").value;
        const fin = document.getElementById("fechaFin").value;
        cargarDatos(inicio, fin);
      });

      // Inicial sin filtros
      cargarDatos();
    });
  </script>
</body>
</html>
