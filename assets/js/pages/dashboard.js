document.addEventListener("DOMContentLoaded", function() {
    ApiConsumo();
	ApiConsumo2();
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


document.addEventListener("DOMContentLoaded", () => {
    const card = document.getElementById("abrirModalTarjetas");

    if (card) {
        card.addEventListener("click", async () => {
            // Llamada a tu API y renderizado
            await ApiConsumo2();

            // Mostrar el modal (requiere Bootstrap 5)
            const modal = new bootstrap.Modal(document.getElementById('modalTarjetas'));
            modal.show();
        });
    }
});

	async function ApiConsumo2() {
    try {
        const url = `${location.origin}/admin/api/apiGraficasConsumoGeneral`;
        const resultado = await fetch(url);
        const data = await resultado.json();
        renderTarjetas(data);
    } catch (e) {
        console.log(e);
    }
}


const iconosMaquinas = {
    "TROQUEL": { icono: "fa-solid fa-scissors", color: "danger" },
    "PRE-PRINTER": { icono: "fa-solid fa-print", color: "info" },
    "GUILLOTINA LAMINA": { icono: "fa-solid fa-cut", color: "primary" },
    "GUILLOTINA PAPEL": { icono: "fa-solid fa-", color: "primary" },
    "CORRUGADOR": { icono: "fa-solid fa-layer-group", color: "warning" },
    "FLEXOGRAFICA": { icono: "fa-solid fa-pen-nib", color: "info" },
    "MICRO": { icono: "fa-solid fa-microchip", color: "secondary" },
    "EMPAQUE": { icono: "fa-solid fa-box", color: "success" },
    "DOBLADO": { icono: "fa-solid fa-object-ungroup", color: "primary" },
    "BODEGA": { icono: "fa-solid fa-warehouse", color: "dark" },
    "CONVERTIDOR": { icono: "fa-solid fa-recycle", color: "secondary" },
    "DESHOJE-CONVERTIDOR": { icono: "fa-solid fa-file-arrow-down", color: "warning" },
    "DESHOJE-PRE-PRINTER": { icono: "fa-solid fa-file-pen", color: "info" }
};


function renderTarjetas(data) {




        const contenedor = document.getElementById("contenedor-tarjetas");
        contenedor.innerHTML = '';

        const maquinasAgrupadas = {};

        // Agrupar por tipo_maquina y sumar total_general
        data.forEach(item => {
            const nombre = item.tipo_maquina.trim();
            const total = parseFloat(item.total_general);

            if (maquinasAgrupadas[nombre]) {
                maquinasAgrupadas[nombre] += total;
            } else {
                maquinasAgrupadas[nombre] = total;
            }
        });

        // Generar tarjetas con íconos y colores personalizados
        for (const [maquina, total] of Object.entries(maquinasAgrupadas)) {
            const config = iconosMaquinas[maquina] || { icono: "iconly-boldInfoCircle", color: "secondary" };


            const tarjetaHTML = `
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon ${config.color}">
                                        <i class="${config.icono}"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">${maquina}</h6>
                                    <h6 class="font-extrabold mb-0">${total.toFixed(2)}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            contenedor.innerHTML += tarjetaHTML;
        }
    }



apiConsumo3(); // Llamar a la función para cargar las tarjetas al inicio
async function ApiConsumo3() {
    try {
        const url = `${location.origin}/admin/api/apiGraficasConsumoGeneral`;
        const resultado = await fetch(url);
        const datos = await resultado.json();
        renderTarjetas(datos);
    } catch (e) {
        console.log(e);
    }
}




function barchat(datos){

	console.log(datos);
	var barOptions = {
		series: [
			{ name: "Net Profit", data: [44, 55, 57, 56, 61, 58, 63, 60, 66] },
			{ name: "Revenue", data: [76, 85, 101, 98, 87, 105, 91, 114, 94] },
			{ name: "Free Cash Flow", data: [35, 41, 36, 26, 45, 48, 52, 53, 41] }
		],
    chart: { type: "bar", height: 350 },
    plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: "55%",
			endingShape: "rounded",
		},
    },
    dataLabels: { enabled: false },
    stroke: {
		show: true,
		width: 2,
		colors: ["transparent"],
    },
    xaxis: {
		categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
    },
    yaxis: {
		title: { text: "$ (thousands)" },
    },
    fill: { opacity: 1 },
    tooltip: {
		y: {
			formatter: function (val) {
				return "$ " + val + " thousands";
			},
		},
    },
};

var bar = new ApexCharts(document.querySelector("#bar"), barOptions);
bar.render();

}




















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