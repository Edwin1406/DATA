<!-- 
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> -->
<?php if ($email === 'control@megaecuador.com' || $email === 'produccion@megaecuador.com' || $email === 'pruebas@megaecuador.com') { ?>
    <div class="page-heading">
        <h3>GRAFICAS CONSUMO GENERAL DESPERDICIO</h3>

        <!-- CERRAR SESSION  -->

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" onclick="location.href='/cerrarSesion'">Cerrar Sesión</button>
            <br>
            <!-- <p class="text-subtitle text-muted"><?php echo $email; ?></p> -->
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
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
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTarjetasLabel">Detalle de Consumo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" id="contenedor-tarjetas"></div>
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
            </div>






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


                        <div id="graficoUnico" class="mt-4"></div>


                    </div>
                </div>
            </div>





            <div class="col-md-12">
                <div class="card">
                    <div id="grafico-mensual" class="mt-4"></div>

                </div>
            </div>




            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Máquinas</h4>
                    </div> <!-- Aquí cerramos bien el card-header -->

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

                        <div id="grafico-top-maquinas"></div>
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


<div id="chart"></div>


<script>

    document.addEventListener('DOMContentLoaded', function () {
       

async function ApiConsumoGeneralxmesymaquina() {
  try {
    const url = `${location.origin}/admin/api/apiGraficasConsumoGeneral`;
    const resultado = await fetch(url);
    const ApiConsumo = await resultado.json();
    // console.log(ApiConsumo);

    return ApiConsumo;
  } catch (e) {
    console.log(e);
  }
}






   var options = {
          series: [{
          name: 'PRODUCT A',
          data: [44, 55, 41, 67, 22, 43, 21, 49]
        }, {
          name: 'PRODUCT B',
          data: [13, 23, 20, 8, 13, 27, 33, 12]
        }, {
          name: 'PRODUCT C',
          data: [11, 17, 15, 15, 21, 14, 15, 13]
        }, {
          name: 'PRODUCT D',
          data: [21, 7, 25, 13, 22, 8, 24, 10]
        }, {
          name: 'PRODUCT E',
          data: [12, 9, 15, 11, 20, 15, 17, 10]
        }
    
    
    
    ],



          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
          stackType: '100%'
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        xaxis: {
          categories: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2',
            '2012 Q3', '2012 Q4'
          ],
        },
        fill: {
          opacity: 1
        },
        legend: {
          position: 'right',
          offsetX: 0,
          offsetY: 50
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    });
</script>