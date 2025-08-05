<!-- 
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> -->
<?php if ($email === 'control@megaecuador.com' || $email === 'produccion@megaecuador.com' || $email === 'pruebas@megaecuador.com') { ?>
    <div class="page-heading">
        <h3>ESTADISTICAS DEL PERFIL </h3>
    </div>


    <div class="page-content">
        <section class="row">
            < class="col-12 col-lg-9">
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
                                        <div class="stats-icon yellow">
                                            <i class="iconly-boldGraph"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Usuarios Desconectados</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $usuariosDesconectados; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="modal fade" id="modalTarjetas" tabindex="-1" aria-labelledby="modalTarjetasLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl"> <!-- Puedes ajustar el tamaño -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTarjetasLabel">Detalle de Consumo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" id="contenedor-tarjetas"></div> <!-- Aquí se cargan las tarjetas -->
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card" id="abrirModalTarjetas" style="cursor: pointer;">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">CONSUMO </h6>
                                        <h6 class="font-extrabold mb-0">GENERAL</h6>
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






                <!-- Profile Visit -->

                <!-- End of Profile Visit -->

                <!-- Latest Comments -->

                <!-- Contenedor -->

                <div class="col-md-12">
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
                                    <!-- FILTRAR POR TOP NECESITO UNAS OPCIONES-->



                                </div>
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </form>

                            <!-- Gráficas pequeñas -->
                            <!-- Gráfica combinada -->
                            <div id="graficoUnico" class="mt-4"></div>


                        </div>
                    </div>
                </div>





                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Bar Chart</h4>
                        </div>
                        <div class="card-body">
                            <div id="bar"></div>
                        </div>
                    </div>
                </div>



                <!-- ApexCharts -->
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const contenedorGrafico = document.querySelector("#graficoUnico");

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

                                if (!agrupado[maquina]) agrupado[maquina] = {};
                                agrupado[maquina][fecha] = (agrupado[maquina][fecha] || 0) + total;
                            });
                            return agrupado;
                        }

                        function generarColor(index) {
                            const colores = ['#008FFB', '#00E396', '#FF4560', '#775DD0', '#FEB019', '#546E7A', '#26a69a', '#d4526e'];
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
                                const series = [];

                                let index = 0;
                                for (const [maquina, fechas] of Object.entries(agrupado)) {
                                    const data = Object.entries(fechas)
                                        .sort(([a], [b]) => new Date(a) - new Date(b))
                                        .map(([fecha, valor]) => ({
                                            x: fecha,
                                            y: parseFloat(valor.toFixed(2))
                                        }));

                                    series.push({
                                        name: maquina,
                                        data: data
                                    });

                                    index++;
                                }

                                contenedorGrafico.innerHTML = ""; // Limpiar gráfico anterior

                                const chart = new ApexCharts(contenedorGrafico, {
                                    chart: {
                                        type: "line",
                                        height: 400,
                                        zoom: {
                                            enabled: true
                                        },
                                        locales: [{
                                            name: 'es',
                                            options: {
                                                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                                shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                                                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                                                shortDays: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                                                toolbar: {
                                                    exportToSVG: "Descargar SVG",
                                                    exportToPNG: "Descargar PNG",
                                                    exportToCSV: "Descargar CSV",
                                                    menu: "Menú",
                                                    selection: "Selección",
                                                    selectionZoom: "Zoom de selección",
                                                    zoomIn: "Acercar",
                                                    zoomOut: "Alejar",
                                                    pan: "Mover",
                                                    reset: "Restablecer Zoom"
                                                }
                                            }
                                        }],
                                        defaultLocale: 'es'
                                    },
                                    series: series,
                                    xaxis: {
                                        type: 'datetime',
                                        title: {
                                            text: 'Fecha'
                                        }
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Consumo General'
                                        },
                                        labels: {
                                            formatter: val => val.toFixed(2)
                                        }
                                    },
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    colors: series.map((_, i) => generarColor(i)),
                                    tooltip: {
                                        x: {
                                            format: 'dd MMM yyyy'
                                        },
                                        y: {
                                            formatter: val => val.toFixed(2)
                                        }
                                    },
                                    legend: {
                                        position: 'top'
                                    },
                                    title: {
                                        text: "Consumo Diario por Máquina",
                                        align: 'center'
                                    }
                                });

                                chart.render();

                            } catch (error) {
                                console.error("Error al cargar los datos:", error);
                            }
                        }

                        // Manejar envío de formulario
                        document.getElementById("formFiltroMaquinas").addEventListener("submit", e => {
                            e.preventDefault();
                            const fechaInicio = document.getElementById("inputFechaInicio").value;
                            const fechaFin = document.getElementById("inputFechaFin").value;
                            cargarDatos(fechaInicio, fechaFin);
                        });

                        // Cargar gráfico al inicio
                        cargarDatos();
                    });
                </script>




    </div>

    </section>
    </div>
<?php } else { ?>
    <div class="page-heading">
        <h3>Bienvenido <?php echo $nombre; ?></h3>
        <p class="text-subtitle text-muted"><?php echo $email; ?></p>
    </div>

<?php } ?>







<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Bar Chart</h4>
        </div>
        <div class="card-body">
            <div id="bar"></div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Top Máquinas</h4>
            <div class="card-body">
                <form id="formFiltroTopMaquinas" class="mb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="filtroFechaInicio">Fecha Inicio</label>
                            <input type="date" class="form-control" id="filtroFechaInicio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="filtroFechaFin">Fecha Fin</label>
                            <input type="date" class="form-control" id="filtroFechaFin" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="filtroTopMaquinas">Top</label>
                            <select class="form-select" id="filtroTopMaquinas">
                                <option value="5">Top 5</option>
                                <option value="todos">Todos</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="filtroTipoMaquina">Máquina</label>
                            <select class="form-select" id="filtroTipoMaquina">

                                <option value="todos">Todas</option>
                                <option value="TROQUEL">Troquel</option>
                                <option value="GUILLOTINA PAPEL">Guillotina Papel</option>
                                <option value="GUILLOTINA LAMINA">Guillotina Lamina</option>
                                <option value="DOBLADO">Doblado</option>
                                <option value="CONVERTIDOR">Convertidor</option>
                                <option value="EMPAQUE">Empaque</option>
                                <option value="MICRO">Micro</option>
                                <option value="CORRUGADOR">Corrugador</option>
                                <option value="FLEXOGRAFICA">Flexografica</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <div id="grafico-top-maquinas"></div> <!-- contenedor único -->

                </div>
            </div>
        </div>
    </div>
</div>