document.addEventListener("DOMContentLoaded", function() {
    ApiConsumo();
});

 async function ApiConsumo(){
        
        
        try {
            const url = `${location.origin}/admin/api/apiGraficasConsumoGeneral`;
            const resultado = await fetch(url);
            const ApiConsumo = await resultado.json();
            // console.log(ApiConsumo);
            return ApiConsumo
        } catch (e) {
            console.log(e);
                
        }
    } 





	function renderTarjetas(data) {
    const contenedor = document.getElementById("contenedor-tarjetas"); // Asegúrate de tener este contenedor en tu HTML
    contenedor.innerHTML = ''; // Limpia antes de renderizar

    data.forEach(item => {
        const tarjetaHTML = `
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
                                <h6 class="text-muted font-semibold">${item.tipo_maquina.trim()}</h6>
                                <h6 class="font-extrabold mb-0">${parseFloat(item.total_general).toFixed(2)}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        contenedor.innerHTML += tarjetaHTML;
    });
}

renderTarjetas(ApiConsumo()); // Llama a la función con los datos de la API


	// Llamar a la funcion ApiConsumo
async function grafica() {
	const apiConsumo = await ApiConsumo(); // Llama a tu API

	// Extraer todas las fechas únicas
	const fechasUnicas = [...new Set(apiConsumo.map(item => {
		const fecha = new Date(item.created_at);
		return fecha.toLocaleDateString('default', { day: '2-digit', month: 'short' });
	}))];

	// Agrupar los consumos por tipo_maquina
	const maquinas = {};
	apiConsumo.forEach(item => {
		const fecha = new Date(item.created_at).toLocaleDateString('default', { day: '2-digit', month: 'short' });
		const tipo = item.tipo_maquina;
		const total = parseFloat(item.total_general);

		if (!maquinas[tipo]) {
			maquinas[tipo] = {};
		}
		maquinas[tipo][fecha] = total;
	});

	// Crear las series para ApexCharts
	const series = Object.entries(maquinas).map(([nombre, datos]) => {
		// Asegurar que cada día tenga un valor (o 0 si no hay datos)
		const dataPorFecha = fechasUnicas.map(fecha => datos[fecha] || 0);
		return {
			name: nombre,
			data: dataPorFecha
		};
	});

	// Colores (se asignan por serie)
	const colores = ['#435ebe', '#55c6e8', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6', '#ec4899'];

	// Configuración del gráfico
	var optionsProfileVisit = {
		annotations: {
			position: 'back'
		},
		dataLabels: {
			enabled: false
		},
		chart: {
			type: 'bar',
			height: 300,
			stacked: false
		},
		fill: {
			opacity: 1
		},
		plotOptions: {
			bar: {
				borderRadius: 4,
				horizontal: false
			}
		},
		series: series,
		colors: colores,
		xaxis: {
			categories: fechasUnicas,
			title: {
				text: 'Día'
			}
		}
	};

	var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
	chartProfileVisit.render();
}

grafica();



// GRAFICO DE BARRAS



async function grafica2() {
	let apiConsumo = await ApiConsumo();

	// Agrupar totales por tipo de máquina
	let agrupado = {};

	apiConsumo.forEach(item => {
		let maquina = item.tipo_maquina.trim();
		let total = parseFloat(item.total_general);

		if (agrupado[maquina]) {
			agrupado[maquina] += total;
		} else {
			agrupado[maquina] = total;
		}
	});

	// Separar en arrays para usar en el gráfico
	let maquinas = Object.keys(agrupado);
	let totales = Object.values(agrupado);

	let optionsVisitorsProfile = {
		series: totales,
		labels: maquinas,
		colors: ['#435ebe', '#55c6e8', '#ff7979', '#3ab795', '#ffe066', '#7e57c2', '#ff6f91', '#36b9cc', '#a3e635', '#ef4444', '#14b8a6', '#8b5cf6'], // puedes ampliar la lista
		chart: {
			type: 'donut',
			width: '100%',
			height: '350px'
		},
		legend: {
			position: 'bottom'
		},
		plotOptions: {
			pie: {
				donut: {
					size: '30%'
				}
			}
		}
	};

	let chartVisitorsProfile = new ApexCharts(document.querySelector("#chart-visitors-profile"), optionsVisitorsProfile);
	chartVisitorsProfile.render();
}

grafica2(); // Ejecutar la función para mostrar el gráfico de barras

var optionsEurope = {
	series: [{
		name: 'series1',
		data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
	}],
	chart: {
		height: 80,
		type: 'area',
		toolbar: {
			show:false,
		},
	},
	colors: ['#cc631dff'],
	stroke: {
		width: 2,
	},
	grid: {
		show:false,
	},
	dataLabels: {
		enabled: false
	},
	xaxis: {
		type: 'datetime',
		categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
		axisBorder: {
			show:false
		},
		axisTicks: {
			show:false
		},
		labels: {
			show:false,
		}
	},
	show:false,
	yaxis: {
		labels: {
			show:false,
		},
	},
	tooltip: {
		x: {
			format: 'dd/MM/yy HH:mm'
		},
	},
};

let optionsAmerica = {
	...optionsEurope,
	colors: ['#008b75'],
}
let optionsIndonesia = {
	...optionsEurope,
	colors: ['#dc3545'],
}



// var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

chartIndonesia.render();
chartAmerica.render();
chartEurope.render();
// chartProfileVisit.render();
// chartVisitorsProfile.render()