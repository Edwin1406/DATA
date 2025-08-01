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


	// Llamar a la funcion ApiConsumo

async function grafica() {
	const apiConsumo = await ApiConsumo(); // Llama a tu API

	// Extraer fechas con formato corto de día (ej: 01 Ago)
	const dias = apiConsumo.map(item => {
		const fecha = new Date(item.created_at);
		return fecha.toLocaleDateString('default', { day: '2-digit', month: 'short' });
	});

	// Convertir totales a número (por si vienen como texto)
	const consumos = apiConsumo.map(item => parseFloat(item.total_general));

	const maquinaNombre = apiConsumo[0]?.tipo_maquina || "Máquina";

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
			height: 300
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
		series: [{
			name: maquinaNombre,
			data: consumos
		}],
		colors: ['#435ebe'],
		xaxis: {
			categories: dias,
			title: {
				text: 'Día'
			}
		}
	};

	var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
	chartProfileVisit.render();
}

// Ejecutar
grafica();



// GRAFICO DE BARRAS



	var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);




let optionsVisitorsProfile  = {
	series: [70, 30],
	labels: ['Male', 'Female'],
	colors: ['#435ebe','#55c6e8'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
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
}

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



var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

chartIndonesia.render();
chartAmerica.render();
chartEurope.render();
chartProfileVisit.render();
chartVisitorsProfile.render()