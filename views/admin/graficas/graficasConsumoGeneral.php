<!-- 
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> -->
<?php if ($email === 'control@megaecuador.com' || $email === 'produccion@megaecuador.com') { ?>
    <div class="page-heading">
        <h3>ESTADISTICAS DEL PERFIL </h3>
    </div>

    <!-- Filtro por Fecha -->



    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <!-- Profile Statistics -->
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Usuarios Conectados</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $usuariosConectados; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Followers</h6>
                                        <h6 class="font-extrabold mb-0">183.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Followers</h6>
                                        <h6 class="font-extrabold mb-0">183.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Following</h6>
                                        <h6 class="font-extrabold mb-0">80.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Troquel</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                        <button class="btn btn-primary  color:white"><a href="/admin/graficas/graficasConsumoGeneral">Ver Gráficas</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Profile Statistics -->
                <!-- filtrador de fechas -->



<!-- Contenedor -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Consumo Diario por Máquina</h4>
            </div>
            <div class="card-body">
                <form id="formFiltroMaquinas" class="mb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inputFechaInicio">Fecha Inicio</label>
                            <input type="date" class="form-control" id="inputFechaInicio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputFechaFin">Fecha Fin</label>
                            <input type="date" class="form-control" id="inputFechaFin" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>

                <!-- Gráficas pequeñas -->
                <div id="contenedorMiniGraficos" class="row gy-4"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Consumo General por Máquina</h4>
            </div>
            <div class="card-body">
                <div id="graficoConsumoMaquinas"></div>
            </div>
        </div>
    </div>
</div>

<!-- ApexCharts -->

<script>
document.addEventListener("DOMContentLoaded", () => {
    const contenedor = document.querySelector("#contenedorMiniGraficos");

    function filtrarPorFechas(datos, inicio, fin) {
        const desde = new Date(inicio);
        const hasta = new Date(fin);
        return datos.filter(item => {
            const fecha = new Date(item.created_at);
            return fecha >= desde && fecha <= hasta;
        });
    }

    function agruparDatos(datos) {
        const agrupado = {};

        datos.forEach(item => {
            const maquina = item.tipo_maquina.trim();
            const fecha = new Date(item.created_at).toISOString().split('T')[0];
            const total = parseFloat(item.total_general);

            if (!agrupado[maquina]) agrupado[maquina] = { total: 0, fechas: {} };

            agrupado[maquina].total += total;
            agrupado[maquina].fechas[fecha] = (agrupado[maquina].fechas[fecha] || 0) + total;
        });

        return agrupado;
    }

    function generarColor(index) {
        const colores = ['#008FFB', '#00E396', '#FF4560', '#775DD0', '#FEB019'];
        return colores[index % colores.length];
    }

    async function cargarDatos(fechaInicio = null, fechaFin = null) {
        try {
            const res = await fetch("https://pruebas.megawebsistem.com/admin/api/apiGraficasConsumoGeneral");
            const datos = await res.json();

            let datosFiltrados = datos;
            if (fechaInicio && fechaFin) {
                datosFiltrados = filtrarPorFechas(datos, fechaInicio, fechaFin);
            }

            const agrupado = agruparDatos(datosFiltrados);
            contenedor.innerHTML = ""; // Limpiar gráficos anteriores

            let index = 0;
            for (const [maquina, { total, fechas }] of Object.entries(agrupado)) {
                const color = generarColor(index);
                const fechasOrdenadas = Object.entries(fechas)
                    .sort(([a], [b]) => new Date(a) - new Date(b))
                    .map(([x, y]) => ({ x, y }));

                // Crear contenedor individual
                const col = document.createElement("div");
                col.className = "col-md-4";
                col.innerHTML = `
                    <div class="d-flex align-items-center mb-2">
                        <span style="width:10px;height:10px;border-radius:50%;background:${color};display:inline-block;margin-right:8px;"></span>
                        <strong>${maquina}</strong>
                        <span class="ms-auto">${total.toFixed(0)}</span>
                    </div>
                    <div id="grafico_${index}"></div>
                `;
                contenedor.appendChild(col);

                // Crear gráfico individual
                const opciones = {
                    chart: {
                        type: "area",
                        height: 100,
                        sparkline: { enabled: true }
                    },
                    series: [{
                        name: maquina,
                        data: fechasOrdenadas
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    colors: [color],
                    tooltip: {
                        x: { format: 'dd/MM/yyyy' }
                    }
                };

                const chart = new ApexCharts(document.querySelector(`#grafico_${index}`), opciones);
                chart.render();
                index++;
            }

        } catch (error) {
            console.error("Error al cargar los datos:", error);
        }
    }

    // Manejar formulario
    document.getElementById("formFiltroMaquinas").addEventListener("submit", e => {
        e.preventDefault();
        const fechaInicio = document.getElementById("inputFechaInicio").value;
        const fechaFin = document.getElementById("inputFechaFin").value;
        cargarDatos(fechaInicio, fechaFin);
    });

    // Cargar inicialmente
    cargarDatos();
});
</script>



<!-- Script para cargar y mostrar la gráfica -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const contenedorDelGrafico = document.querySelector("#graficoConsumoMaquinas");
    let graficoDeConsumo = null;

    function filtrarDatosPorFechas(listaDatos, fechaInicio, fechaFin) {
      const desde = new Date(fechaInicio);
      const hasta = new Date(fechaFin);
      return listaDatos.filter(registro => {
        const fechaRegistro = new Date(registro.created_at);
        return fechaRegistro >= desde && fechaRegistro <= hasta;
      });
    }

    function agruparConsumoPorTipoMaquina(listaDatos) {
      const datosAgrupados = {};
      listaDatos.forEach(registro => {
        const tipoMaquina = registro.tipo_maquina.trim();
        const totalConsumo = parseFloat(registro.total_general);
        datosAgrupados[tipoMaquina] = (datosAgrupados[tipoMaquina] || 0) + totalConsumo;
      });

      return {
        etiquetas: Object.keys(datosAgrupados),
        valores: Object.values(datosAgrupados)
      };
    }

    async function obtenerYMostrarDatos(fechaInicio = null, fechaFin = null) {
      try {
        const respuesta = await fetch("https://pruebas.megawebsistem.com/admin/api/apiGraficasConsumoGeneral");
        const datos = await respuesta.json();

        let datosProcesados = datos;
        if (fechaInicio && fechaFin) {
          datosProcesados = filtrarDatosPorFechas(datos, fechaInicio, fechaFin);
        }

        const { etiquetas, valores } = agruparConsumoPorTipoMaquina(datosProcesados);

        const opcionesGrafico = {
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

        // Destruir gráfico anterior si existe
        if (graficoDeConsumo) graficoDeConsumo.destroy();

        graficoDeConsumo = new ApexCharts(contenedorDelGrafico, opcionesGrafico);
        graficoDeConsumo.render();

      } catch (error) {
        console.error("Error al cargar los datos:", error);
      }
    }

    // Evento del formulario de filtrado
    document.getElementById("formularioFiltroFechas").addEventListener("submit", evento => {
      evento.preventDefault();
      const fechaInicioSeleccionada = document.getElementById("campoFechaInicio").value;
      const fechaFinSeleccionada = document.getElementById("campoFechaFin").value;
      obtenerYMostrarDatos(fechaInicioSeleccionada, fechaFinSeleccionada);
    });

    // Carga inicial sin filtros
    obtenerYMostrarDatos();
  });
</script>

<!-- Sección de la gráfica -->
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Consumo General por Máquina</h4>
      </div>
      <div class="card-body">
        <div id="graficoConsumoMaquinas"></div>
      </div>
    </div>
  </div>
</div>

<!-- Sección del filtro por fechas -->
<div class="row">
  <div class="col-12 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Filtrar por Fecha</h4>
      </div>
      <div class="card-body">
        <form id="formularioFiltroFechas">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="campoFechaInicio" class="form-label">Fecha Inicio</label>
              <input type="date" class="form-control" id="campoFechaInicio" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="campoFechaFin" class="form-label">Fecha Fin</label>
              <input type="date" class="form-control" id="campoFechaFin" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
      </div>
    </div>
  </div>
</div>








                <!-- End of Profile Visit -->

                <!-- Latest Comments -->
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Europe</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">862</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">America</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">375</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Indonesia</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">1025</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-indonesia"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Comments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="/assets/images/faces/5.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Congratulations on your graduation!</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="/assets/images/faces/2.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Wow amazing design! Can you make another
                                                        tutorial for
                                                        this design?</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card text-truncate">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="/assets/images/faces/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-0 name ">
                                <h5 class="font-bold"><?php echo $nombre; ?></h5>
                                <h6 class="text-muted mb-0 .fs-6 small"><?php echo $email; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Messages</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="/assets/images/faces/4.jpg">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Hank Schrader</h5>
                                <h6 class="text-muted mb-0">@johnducky</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="/assets/images/faces/5.jpg">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Dean Winchester</h5>
                                <h6 class="text-muted mb-0">@imdean</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="/assets/images/faces/1.jpg">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">John Dodol</h5>
                                <h6 class="text-muted mb-0">@dodoljohn</h6>
                            </div>
                        </div>
                        <div class="px-4">
                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                                Conversation</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Visitors Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } else { ?>
    <div class="page-heading">
        <h3>Bienvenido <?php echo $nombre; ?></h3>
        <p class="text-subtitle text-muted"><?php echo $email; ?></p>
    </div>

<?php } ?>