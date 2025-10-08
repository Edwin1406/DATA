<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos de prueba</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a><?php echo $nombre; ?></a></li>
                        <!--  cerrar sesión -->
                        <li class="breadcrumb-item"><a href="/cerrarSesion">Cerrar Sesión</a></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ¡Registro guardado exitosamente!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['exito']) && $_GET['exito'] == '1') : ?>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                // Mostrar el toast
                var toastEl = document.getElementById('toastExito');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                // Quitar el parámetro ?exito=1 de la URL sin recargar
                const url = new URL(window.location);
                url.searchParams.delete('exito');
                window.history.replaceState({}, document.title, url.toString());
            });
        </script>
    <?php endif; ?>

    <section class="section">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/pruebas/tablaFlexo">Tabla Flexo</a>
                </li>
            </ul>
        </div>
    </section>


    <section class="section">
        <div class="card">
            <div class="card-header">
                Tabla de Flexo
            </div>

            <div class="card-body">

                <form action="/admin/pruebas/editarFlexo?<?php echo http_build_query(['id' => $venta->id ?? '']); ?>" method="POST">
                    <!-- Fila 1 -->
                    <div class="row g-3">
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" class="form-control"
                                    name="fecha" value="<?php echo $venta->fecha ?? ''; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="consumo_papel">Consumo papel (Kg)</label>
                                <input type="number" step="0.01" id="consumo_papel"
                                    class="form-control" placeholder="Consumo papel (Kg)" name="consumo_papel"
                                    value="<?php echo $venta->consumo_papel ?? ''; ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="n_unidades">N° de Unidades</label>
                                <input type="number" id="n_unidades" class="form-control"
                                    placeholder="N° de Unidades" name="n_unidades"
                                    value="<?php echo $venta->n_unidades ?? ''; ?>" readonly>
                            </div>
                        </div>





                        <div class="col-md-2 col-12 ">

                            <div class="form-group">
                                <label for="turno">Turno</label>
                                <input type="time" id="turno" class="form-control"
                                    placeholder="Turno" name="turno"
                                    value="<?php echo $venta->turno ?? ''; ?>" readonly>
                            </div>

                        </div>


                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="n_cambios">N° de Cambios</label>
                                <input type="number" id="n_cambios" class="form-control"
                                    placeholder="N° de Cambios"
                                    value="<?php echo $venta->n_cambios ?? ''; ?>"
                                    name="n_cambios" readonly>
                            </div>
                        </div>


                        <!-- fecha inicio -->
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="hora_inicio">Hora Inicio</label>
                                <input type="time" id="hora_inicio" class="form-control"
                                    name="hora_inicio"
                                    value="<?php echo $venta->hora_inicio ?? ''; ?>"
                                    readonly>

                            </div>
                        </div>

                        <!-- fecha fin -->
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="hora_fin">Hora Fin</label>
                                <input type="time" id="hora_fin" class="form-control"
                                    name="hora_fin"
                                    value="<?php echo $venta->hora_fin ?? ''; ?>"
                                    readonly>
                            </div>
                        </div>




                        <div class="col-md-3 col-12">
                            <label for="operador">Escoja OPERADOR</label>
                            <div class="form-group">
                                <select class="form-select" name="operador" id="operador">
                                    <option value="" disabled selected>Seleccione un operador</option>
                                    <option value="RAFAEL" <?= $venta->operador === 'RAFAEL' ? 'selected' : '' ?>>RAFAEL</option>
                                    <option value="WILLIAM" <?= $venta->operador === 'WILLIAM' ? 'selected' : '' ?>>WILLIAM</option>
                                </select>
                            </div>
                        </div>


                        <!-- horas de inactividad -->
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="motivo_inactividad">Motivo de la Inactividad</label>
                                <textarea id="motivo_inactividad" class="form-control" name="motivo_inactividad" placeholder="Describe el motivo de la inactividad" rows="3"><?php echo $venta->motivo_inactividad ?? ''; ?></textarea>
                            </div>


                        </div>


                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="tiempo_cambio_medida">tiempo_cambio_medida</label>
                                <input type="float" id="tiempo_cambio_medida" class="form-control"
                                    name="tiempo_cambio_medida"
                                    value="<?php echo $venta->tiempo_cambio_medida ?? ''; ?>"
                                    step="0.01"

                                    required>
                            </div>
                        </div>



                    </div>


                    <!-- Botón -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Actualizar </button>
                    </div>
                </form>








            </div>
            <!-- boton de registrar -->
        </div>
    </section>

    <!-- CSS opcional para evitar que se rompa texto en celdas -->
    <style>
        #table1 th,
        #table1 td {
            white-space: nowrap;
        }
    </style>



    <style>
        .note {
            font-size: 0.9em;
            color: #666;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        #tabla {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        #tabla th,
        #tabla td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        #tabla th {
            background-color: #f4f4f4;
        }

        #tabla td.left {
            text-align: left;
        }

        #tabla td.input-cell {
            padding: 0;
        }

        #tabla td.input-cell input {
            width: 100%;
            box-sizing: border-box;
            border: none;
            padding: 6px;
            text-align: center;
        }

        #tabla tfoot td {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .summary {
            max-width: 600px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: space-between;
        }

        .summary div {
            font-size: 1.1em;
        }

        .summary b {
            margin-left: 10px;
        }

        .muted {
            color: #999;
            font-size: 0.9em;
        }
    </style>



    <table id="tabla">
        <thead>
            <tr>
                <th class="left">Proceso</th>
                <th>Tiempo (Min) <span class="muted">[input]</span></th>
                <th>Cantidad <span class="muted">[input]</span></th>
                <th>Tiempo × Cantidad (Min)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="left">TAPAS</td>
                <td class="input-cell">
                    <input type="number" min="0" step="0.1" value="40" data-role="tiempo">
                </td>
                <td class="input-cell">
                    <input type="number" min="0" step="1" value="6" data-role="cantidad">
                </td>
                <td data-role="subtotal">0</td>
            </tr>
            <tr>
                <td class="left">BASES</td>
                <td class="input-cell">
                    <input type="number" min="0" step="0.1" value="20" data-role="tiempo">
                </td>
                <td class="input-cell">
                    <input type="number" min="0" step="1" value="6" data-role="cantidad">
                </td>
                <td data-role="subtotal">0</td>
            </tr>
            <tr>
                <td class="left">FONDOS</td>
                <td class="input-cell">
                    <input type="number" min="0" step="0.1" value="8" data-role="tiempo">
                </td>
                <td class="input-cell">
                    <input type="number" min="0" step="1" value="2" data-role="cantidad">
                </td>
                <td data-role="subtotal">0</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="left">Totales</td>
                <td class="muted">—</td>
                <td id="total-cantidad">0</td>
                <td id="total-minutos">0</td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <div>
            Promedio (Min por unidad)
            <b id="promedio">0</b>
        </div>
        <div>
            Observación
            <b id="observacion">—</b>
        </div>
    </div>



    <script>
        (function() {
            const tabla = document.getElementById('tabla');
            const filas = Array.from(tabla.tBodies[0].rows);

            const $totalCantidad = document.getElementById('total-cantidad');
            const $totalMinutos = document.getElementById('total-minutos');
            const $promedio = document.getElementById('promedio');
            const $obs = document.getElementById('observacion');

            function num(v) {
                const n = parseFloat(v);
                return Number.isFinite(n) ? n : 0;
            }

            function fmt(n, dec = 1) {
                return n.toLocaleString('es-ES', {
                    maximumFractionDigits: dec,
                    minimumFractionDigits: dec
                });
            }

            function recalcular() {
                let totalCant = 0;
                let totalMins = 0;

                filas.forEach(tr => {
                    const tiempo = num(tr.querySelector('input[data-role="tiempo"]').value);
                    const cantidad = num(tr.querySelector('input[data-role="cantidad"]').value);
                    const subtotal = tiempo * cantidad;

                    tr.querySelector('[data-role="subtotal"]').textContent = fmt(subtotal, 0);

                    totalCant += cantidad;
                    totalMins += subtotal;
                });

                $totalCantidad.textContent = fmt(totalCant, 0);
                $totalMinutos.textContent = fmt(totalMins, 0);

                const prom = totalCant > 0 ? (totalMins / totalCant) : 0;
                $promedio.textContent = fmt(prom, 1);

                // Mensajito útil para detectar rarezas
                if (totalCant === 0 && totalMins > 0) {
                    $obs.textContent = 'Revisa cantidades (están en 0)';
                } else if (totalCant > 0 && totalMins === 0) {
                    $obs.textContent = 'Faltan tiempos o están en 0';
                } else {
                    $obs.textContent = 'OK';
                }
            }

            // Listeners en todos los inputs
            filas.forEach(tr => {
                tr.querySelectorAll('input').forEach(inp => {
                    inp.addEventListener('input', recalcular);
                    inp.addEventListener('change', recalcular);
                });
            });

            // Primera pasada con los valores iniciales
            recalcular();
        })();
    </script>






    <script>
        function bloquearBoton(form) {
            const btn = form.querySelector('#btnRegistrar');
            btn.disabled = true; // Deshabilita el botón
            btn.innerText = "Registrando..."; // Cambia el texto (opcional)
            return true; // Permite que el formulario se envíe
        }
    </script>



</div>