<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->

<div class="page-heading" id="contenido-dinamico">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos del consumo</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a><?php echo $nombre; ?></a></li>
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
                var toastEl = document.getElementById('toastExito');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
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
                    <a class="nav-link active" href="/admin/tablaConsumo">Tabla Consumo Empaque</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">REGISTRO DE CONTROL EMPAQUE</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/consumo" id="formConsumo">
                                <div class="row">

                                    <!-- Horas de trabajo (tu módulo con contraseña) -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="horas_trabajo">Horas de Trabajo</label>
                                            <div class="d-flex" style="gap:.5rem">
                                                <input type="time" id="horas_trabajo" class="form-control" name="horas_trabajo" placeholder="Horas de Trabajo">
                                                <button type="button" id="btnEditarHoras" class="btn btn-secondary">Editar</button>
                                                <button type="button" id="btnGuardarBloquear" class="btn btn-primary">Guardar</button>
                                                <button type="button" id="btnCancelar" class="btn btn-outline-secondary">Cancelar</button>
                                            </div>
                                            <small id="estadoHoras" class="form-text text-muted"></small>
                                        </div>
                                    </div>

                                    <script>
                                        // ====== CONFIG CONTRASEÑA HORAS DE TRABAJO ======
                                        const PASSWORD = "1234";
                                        const KEY_VAL = "horas_trabajo_val";
                                        const KEY_LOCKED = "horas_trabajo_lock";
                                        const input = document.getElementById("horas_trabajo");
                                        const btnEditar = document.getElementById("btnEditarHoras");
                                        const btnSave = document.getElementById("btnGuardarBloquear");
                                        const btnCancel = document.getElementById("btnCancelar");
                                        const estado = document.getElementById("estadoHoras");
                                        let editando = false;
                                        let valorAntes = null;

                                        function normalizar(t) { return (t ?? "").toString().normalize("NFKC").trim(); }
                                        function setBloqueado(msg = "Bloqueado") {
                                            input.readOnly = true;
                                            btnEditar.disabled = false;
                                            btnSave.disabled = true;
                                            btnCancel.disabled = true;
                                            btnEditar.className = "btn btn-secondary";
                                            btnEditar.textContent = "Editar";
                                            estado.textContent = msg;
                                            editando = false;
                                        }
                                        function setEditando(msg = "Editando…") {
                                            input.readOnly = false;
                                            btnEditar.disabled = true;
                                            btnSave.disabled = false;
                                            btnCancel.disabled = false;
                                            btnEditar.className = "btn btn-success";
                                            btnEditar.textContent = "Editar";
                                            estado.textContent = msg;
                                            editando = true;
                                            input.focus();
                                        }
                                        (function init() {
                                            const guardado = localStorage.getItem(KEY_VAL);
                                            const locked = localStorage.getItem(KEY_LOCKED) === "1";
                                            if (guardado) input.value = guardado;
                                            if (!locked) {
                                                valorAntes = input.value || "";
                                                setEditando("Primera configuración: elige la hora y guarda para bloquear");
                                            } else {
                                                setBloqueado("Bloqueado (pulse Editar para ingresar contraseña)");
                                            }
                                        })();
                                        btnEditar.addEventListener("click", () => {
                                            if (editando) return;
                                            const ingreso = prompt("Ingrese la contraseña para editar este campo:");
                                            if (ingreso === null) return;
                                            if (normalizar(ingreso) === normalizar(PASSWORD)) {
                                                valorAntes = input.value;
                                                setEditando();
                                            } else {
                                                alert("Contraseña incorrecta.");
                                            }
                                        });
                                        btnSave.addEventListener("click", () => {
                                            const val = input.value;
                                            if (!/^\d{2}:\d{2}$/.test(val)) {
                                                alert("Ingrese una hora válida (HH:MM).");
                                                return;
                                            }
                                            localStorage.setItem(KEY_VAL, val);
                                            localStorage.setItem(KEY_LOCKED, "1");
                                            setBloqueado("Bloqueado (cambios guardados)");
                                        });
                                        btnCancel.addEventListener("click", () => {
                                            input.value = valorAntes ?? localStorage.getItem(KEY_VAL) ?? "";
                                            const locked = localStorage.getItem(KEY_LOCKED) === "1";
                                            if (locked) {
                                                setBloqueado("Bloqueado (sin cambios)");
                                            } else {
                                                setEditando("Primera configuración (sin cambios)");
                                            }
                                        });
                                    </script>

                                    <!-- Turno -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="turno">Turno</label>
                                            <input type="number" id="turno" class="form-control" placeholder="Turno" name="turno">
                                        </div>
                                    </div>

                                    <!-- Personal -->
                                    <div class="col-md-6 col-12">
                                        <label for="personal">Escoja el Personal</label>
                                        <div class="form-group">
                                            <select class="choices form-select select-light-danger" multiple="multiple" name="personal[]">
                                                <option value="ISRAEL CEDEÑO">ISRAEL CEDEÑO</option>
                                                <option value="FABRICIO TANDAYAMO">FABRICIO TANDAYAMO</option>
                                                <option value="ALEXANDER MOPOSA">ALEXANDER MOPOSA</option>
                                                <option value="MARCO QUIHUIRI">MARCO QUIHUIRI</option>
                                                <option value="GUSTAVO SANCHEZ">GUSTAVO SANCHEZ</option>
                                                <option value="VICTOR MENDEZ">VICTOR MENDEZ</option>
                                                <option value="MILTON COYAGO">MILTON COYAGO</option>
                                                <option value="CRISTIAN ORTIZ">CRISTIAN ORTIZ</option>
                                                <option value="LOURDES FARINANGO">LOURDES FARINANGO</option>
                                                <option value="MERY CHAUCA">MERY CHAUCA</option>
                                                <option value="GINA TUQUERRES">GINA TUQUERRES</option>
                                                <option value="GUADALUPE TOLAGASI">GUADALUPE TOLAGASI</option>
                                                <option value="JESSY BERMEO">JESSY BERMEO</option>
                                                <option value="VIVIANA RUIZ">VIVIANA RUIZ</option>
                                                <option value="PRISCILIA ACHIÑA">PRISCILIA ACHIÑA</option>
                                                <option value="TANYA FERNANDEZ">TANYA FERNANDEZ</option>
                                                <option value="SHIRLEY CETRE">SHIRLEY CETRE</option>
                                                <option value="KATHERIN CARVAJAL">KATHERIN CARVAJAL</option>
                                                <option value="DE LA CRUZ BLANCA">DE LA CRUZ BLANCA</option>
                                                <option value="GLORIA GUALAN">GLORIA GUALAN</option>
                                                <option value="JEFFERSON PINANGO">JEFFERSON PINANGO</option>
                                                <option value="YORVI VILLEGAS">YORVI VILLEGAS</option>
                                                <option value="VERÓNICA LANDETA">VERÓNICA LANDETA</option>
                                                <option value="ALVARO POGO">ALVARO POGO</option>
                                                <option value="EVELYN OVIEDO">EVELYN OVIEDO</option>
                                                <option value="LUIS GOVEA">LUIS GOVEA</option>
                                                <option value="GUILLERMO BONILLA">GUILLERMO BONILLA</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Producto -->
                                    <div class="col-md-6 col-12">
                                        <label for="producto">Escoja el Producto</label>
                                        <div class="form-group">
                                            <select class="form-select" name="producto">
                                                <option value="LAMINA">LAMINA</option>
                                                <option value="LAMINA DOBLADA">LAMINA DOBLADA</option>
                                                <option value="LAMINA T - R">LAMINA T - R</option>
                                                <option value="CORREAS">CORREAS</option>
                                                <option value="SEPARADORES">SEPARADORES</option>
                                                <option value="PAPEL PERIODICO">PAPEL PERIODICO</option>
                                                <option value="PEGADO CAJAS">PEGADO CAJAS</option>
                                                <option value="PEGADO CAPUCHONES">PEGADO CAPUCHONES</option>
                                                <option value="LINER">LINER</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Medida -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="medidas">Medida</label>
                                            <input type="text" id="medidas" class="form-control" placeholder="Medida" name="medidas">
                                        </div>
                                    </div>

                                    <!-- Hora de Inicio (auto + botones individuales) -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label for="hora_inicio" class="mb-0">Hora de Inicio</label>
                                                <div class="d-flex" style="gap:.5rem">
                                                    <button type="button" class="btn btn-success btn-sm" id="btnIniciarTurno">Iniciar turno</button>
                                                    <button type="button" class="btn btn-danger btn-sm" id="btnFinalizarTurno" disabled>Finalizar turno</button>
                                                </div>
                                            </div>
                                            <input type="time" id="hora_inicio" class="form-control mt-2" name="hora_inicio" readonly>
                                            <small id="estadoTurno" class="form-text text-muted"></small>
                                        </div>
                                    </div>

                                    <!-- Hora de fin (auto) -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="hora_fin">Hora de Fin</label>
                                            <input type="time" id="hora_fin" class="form-control" name="hora_fin" readonly>
                                        </div>
                                    </div>

                                    <!-- Cantidad -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" id="cantidad" class="form-control" placeholder="Cantidad" name="cantidad">
                                        </div>
                                    </div>

                                    <!-- Botones para MÚLTIPLES personas -->
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap" style="gap:.5rem">
                                            <button type="button" class="btn btn-success btn-sm" id="btnIniciarSeleccion">Iniciar turnos (seleccionados)</button>
                                            <button type="button" class="btn btn-primary btn-sm" id="btnVerDetalle">Ver detalle</button>
                                            <button type="button" class="btn btn-danger btn-sm" id="btnFinalizarMiTurno">Finalizar mi turno</button>
                                        </div>
                                    </div>

                                    <!-- Modal Ver Detalle -->
                                    <div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Turnos del día <span id="fechaHoyLbl"></span></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="table-responsive">
                                              <table class="table table-sm align-middle">
                                                <thead>
                                                  <tr>
                                                    <th>Persona</th>
                                                    <th>Inicio</th>
                                                    <th>Fin</th>
                                                    <th>Estado</th>
                                                    <th style="width:230px">Acciones</th>
                                                  </tr>
                                                </thead>
                                                <tbody id="tbodyDetalle"></tbody>
                                              </table>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Input oculto para enviar los intervalos generados -->
                                    <input type="hidden" name="intervalos" id="intervalos_json" value="[]">

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Registrar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1" id="btnLimpiar">Limpiar</button>
                                    </div>
                                </div>
                            </form>

                            <!-- ====== Lógica individual de turno (igual que antes) ====== -->
                            <script>
                                const SLOT_MINUTES = 60; // 60 = 1h

                                const LS_TURNO = "consumo_turno"; // {inicio, fin, activo}

                                const pad2 = n => String(n).padStart(2, "0");
                                const nowHHMM = () => {
                                    const d = new Date();
                                    return `${pad2(d.getHours())}:${pad2(d.getMinutes())}`;
                                };
                                function parseHHMM(hhmm) {
                                    const [h, m] = hhmm.split(":").map(Number);
                                    const d = new Date();
                                    d.setHours(h, m, 0, 0);
                                    return d;
                                }
                                function addMinutes(date, minutes) {
                                    const d = new Date(date);
                                    d.setMinutes(d.getMinutes() + minutes);
                                    return d;
                                }
                                function generarIntervalos(hhmmInicio, hhmmFin, slotMin) {
                                    const desde = parseHHMM(hhmmInicio);
                                    const hasta = parseHHMM(hhmmFin);
                                    const out = [];
                                    let cur = new Date(desde);
                                    while (cur < hasta) {
                                        const nxt = addMinutes(cur, slotMin);
                                        out.push({
                                            desde: `${pad2(cur.getHours())}:${pad2(cur.getMinutes())}`,
                                            hasta: `${pad2(nxt.getHours())}:${pad2(nxt.getMinutes())}`
                                        });
                                        cur = nxt;
                                    }
                                    return out;
                                }

                                const elInicio = document.getElementById("hora_inicio");
                                const elFin = document.getElementById("hora_fin");
                                const elEstado = document.getElementById("estadoTurno");
                                const btnIniciar = document.getElementById("btnIniciarTurno");
                                const btnFinalizar = document.getElementById("btnFinalizarTurno");
                                const form = document.getElementById("formConsumo");
                                const intervalosInput = document.getElementById("intervalos_json");
                                const btnLimpiar = document.getElementById("btnLimpiar");

                                function loadTurno() {
                                    const raw = localStorage.getItem(LS_TURNO);
                                    return raw ? JSON.parse(raw) : null;
                                }
                                function saveTurno(obj) { localStorage.setItem(LS_TURNO, JSON.stringify(obj)); }
                                function clearTurno() { localStorage.removeItem(LS_TURNO); }

                                function setUIInicio(inicio) {
                                    elInicio.value = inicio;
                                    elInicio.readOnly = true;
                                    btnIniciar.disabled = true;
                                    btnFinalizar.disabled = false;
                                    elEstado.textContent = "Turno iniciado";
                                }
                                function setUIEsperando() {
                                    elInicio.value = "";
                                    elFin.value = "";
                                    elInicio.readOnly = true;
                                    elFin.readOnly = true;
                                    btnIniciar.disabled = false;
                                    btnFinalizar.disabled = true;
                                    elEstado.textContent = "Sin turno activo";
                                }
                                function setUIFinalizado(fin) {
                                    elFin.value = fin;
                                    btnFinalizar.disabled = true;
                                    elEstado.textContent = "Turno finalizado";
                                }

                                (function initTurno() {
                                    const t = loadTurno();
                                    if (t && t.activo && t.inicio) setUIInicio(t.inicio);
                                    else setUIEsperando();
                                })();

                                btnIniciar.addEventListener("click", () => {
                                    const t = loadTurno();
                                    if (t && t.activo) { alert("Ya hay un turno activo iniciado a las " + t.inicio); return; }
                                    const inicio = nowHHMM();
                                    saveTurno({ inicio, fin: null, activo: true });
                                    setUIInicio(inicio);
                                });

                                btnFinalizar.addEventListener("click", () => {
                                    const t = loadTurno();
                                    if (!t || !t.activo) { alert("No hay un turno activo."); return; }
                                    const fin = nowHHMM();
                                    t.fin = fin; t.activo = false; saveTurno(t);
                                    setUIFinalizado(fin);
                                    const intervalos = generarIntervalos(t.inicio, t.fin, SLOT_MINUTES);
                                    intervalosInput.value = JSON.stringify(intervalos);
                                });

                                form.addEventListener("submit", () => {
                                    let t = loadTurno();
                                    if (!t || !t.inicio) {
                                        const inicio = nowHHMM();
                                        t = { inicio, fin: null, activo: true };
                                        saveTurno(t); setUIInicio(inicio);
                                    }
                                    if (!t.fin) {
                                        const fin = nowHHMM();
                                        t.fin = fin; t.activo = false; saveTurno(t); setUIFinalizado(fin);
                                    }
                                    elInicio.value = t.inicio; elFin.value = t.fin;
                                    const intervalos = generarIntervalos(t.inicio, t.fin, SLOT_MINUTES);
                                    intervalosInput.value = JSON.stringify(intervalos);
                                    clearTurno();
                                });

                                btnLimpiar.addEventListener("click", () => {
                                    clearTurno(); setUIEsperando(); intervalosInput.value = "[]";
                                });
                            </script>

                            <!-- ====== Gestión de MÚLTIPLES personas (localStorage por día) ====== -->
                            <script>
                            (function(){
                              const LS_MULTI = 'empaque_turnos_v1';
                              const fechaHoy = () => (new Date()).toISOString().slice(0,10);
                              const pad2b = n => String(n).padStart(2,'0');
                              const nowHHMMb = () => { const d=new Date(); return `${pad2b(d.getHours())}:${pad2b(d.getMinutes())}`; };

                              function loadAllDays(){ try { return JSON.parse(localStorage.getItem(LS_MULTI) || '{}'); } catch { return {}; } }
                              function saveAllDays(map){ localStorage.setItem(LS_MULTI, JSON.stringify(map)); }
                              function loadDay(day){ const all = loadAllDays(); return Array.isArray(all[day]) ? all[day] : []; }
                              function saveDay(day, arr){ const all = loadAllDays(); all[day] = arr; saveAllDays(all); }
                              function uid(){ return 't_'+Math.random().toString(36).slice(2,9); }

                              const selPersonal = document.querySelector('select[name="personal[]"]');
                              const btnIniciarSeleccion = document.getElementById('btnIniciarSeleccion');
                              const btnVerDetalle = document.getElementById('btnVerDetalle');
                              const btnFinalizarMiTurno = document.getElementById('btnFinalizarMiTurno');
                              const tbodyDetalle = document.getElementById('tbodyDetalle');
                              const fechaHoyLbl = document.getElementById('fechaHoyLbl');

                              const inpInicio = document.getElementById('hora_inicio');
                              const inpFin    = document.getElementById('hora_fin');
                              const form      = document.getElementById('formConsumo');

                              let modalDetalle;
                              document.addEventListener('DOMContentLoaded', () => {
                                const el = document.getElementById('modalDetalle');
                                if (window.bootstrap && el) modalDetalle = new bootstrap.Modal(el);
                              });

                              btnIniciarSeleccion.addEventListener('click', () => {
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const seleccionados = Array.from(selPersonal.selectedOptions).map(o => o.value);
                                if (seleccionados.length === 0) { alert('Selecciona al menos una persona.'); return; }
                                const ahora = nowHHMMb();
                                let iniciados = 0, omitidos = [];
                                seleccionados.forEach(persona => {
                                  const yaActivo = lista.find(r => r.persona === persona && r.estado === 'activo');
                                  if (yaActivo) omitidos.push(persona);
                                  else { lista.push({ id: uid(), persona, inicio: ahora, fin: null, estado: 'activo' }); iniciados++; }
                                });
                                saveDay(day, lista);
                                if (iniciados) alert(`Iniciados ${iniciados} turno(s) a las ${ahora}.`);
                                if (omitidos.length) alert(`Omitidos (ya activos): ${omitidos.join(', ')}`);
                              });

                              btnVerDetalle.addEventListener('click', () => {
                                renderTablaDetalle();
                                fechaHoyLbl.textContent = fechaHoy();
                                modalDetalle?.show();
                              });

                              btnFinalizarMiTurno.addEventListener('click', () => {
                                const personas = Array.from(selPersonal.selectedOptions).map(o => o.value);
                                if (personas.length !== 1) { alert('Selecciona exactamente 1 persona para finalizar su turno.'); return; }
                                const persona = personas[0];
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const reg = lista.find(r => r.persona === persona && r.estado === 'activo');
                                if (!reg) { alert('No hay turno activo para esa persona.'); return; }
                                reg.fin = nowHHMMb(); reg.estado = 'finalizado'; saveDay(day, lista);
                                inpInicio.value = reg.inicio; inpFin.value = reg.fin;
                                alert(`Turno de ${persona} finalizado a las ${reg.fin}.`);
                              });

                              function renderTablaDetalle(){
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                tbodyDetalle.innerHTML = '';
                                if (!lista.length) { tbodyDetalle.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Sin registros hoy.</td></tr>'; return; }
                                lista.forEach(reg => {
                                  const tr = document.createElement('tr');
                                  tr.innerHTML = `
                                    <td>${reg.persona}</td>
                                    <td>${reg.inicio ?? '-'}</td>
                                    <td>${reg.fin ?? '--:--'}</td>
                                    <td>${reg.estado}</td>
                                    <td>
                                      <div class="btn-group btn-group-sm" role="group">
                                        <button class="btn btn-outline-primary btnCargar">Cargar</button>
                                        <button class="btn btn-outline-success btnFinalizar"${reg.estado==='finalizado'?' disabled':''}>Finalizar ahora</button>
                                        <button class="btn btn-outline-danger btnEliminar">Eliminar</button>
                                      </div>
                                    </td>`;
                                  tr.querySelector('.btnCargar').addEventListener('click', () => cargarEnFormulario(reg.id));
                                  tr.querySelector('.btnFinalizar').addEventListener('click', () => finalizarAhora(reg.id));
                                  tr.querySelector('.btnEliminar').addEventListener('click', () => eliminarRegistro(reg.id));
                                  tbodyDetalle.appendChild(tr);
                                });
                              }

                              function cargarEnFormulario(id){
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const reg = lista.find(r => r.id === id);
                                if (!reg) return;
                                Array.from(selPersonal.options).forEach(o => o.selected = false);
                                const opt = Array.from(selPersonal.options).find(o => o.value === reg.persona);
                                if (opt) opt.selected = true;
                                inpInicio.value = reg.inicio || '';
                                inpFin.value = reg.fin || '';
                                modalDetalle?.hide();
                              }

                              function finalizarAhora(id){
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const reg = lista.find(r => r.id === id);
                                if (!reg) return;
                                if (reg.estado === 'finalizado') { alert('Ese registro ya está finalizado.'); return; }
                                reg.fin = nowHHMMb(); reg.estado = 'finalizado'; saveDay(day, lista);
                                renderTablaDetalle();
                              }

                              function eliminarRegistro(id){
                                const day = fechaHoy();
                                let lista = loadDay(day);
                                if (!confirm('¿Eliminar este registro local?')) return;
                                lista = lista.filter(r => r.id !== id);
                                saveDay(day, lista);
                                renderTablaDetalle();
                              }

                              // Al enviar: si hay exactamente 1 persona seleccionada, usa su registro del día
                              form.addEventListener('submit', () => {
                                const personas = Array.from(selPersonal.selectedOptions).map(o => o.value);
                                if (personas.length === 1) {
                                  const day = fechaHoy();
                                  const lista = loadDay(day);
                                  const reg = lista.find(r => r.persona === personas[0]);
                                  if (reg) {
                                    if (!inpInicio.value) inpInicio.value = reg.inicio || '';
                                    if (!inpFin.value)    inpFin.value    = reg.fin || nowHHMMb();
                                  }
                                }
                              });

                            })();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
