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

                                    <!-- Horas de trabajo (con contraseña) -->
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
                                        /* ====== BLOQUEO HORAS TRABAJO ====== */
                                        const PASSWORD = "1234";
                                        const KEY_VAL = "horas_trabajo_val";
                                        const KEY_LOCKED = "horas_trabajo_lock";
                                        const input = document.getElementById("horas_trabajo");
                                        const btnEditar = document.getElementById("btnEditarHoras");
                                        const btnSave = document.getElementById("btnGuardarBloquear");
                                        const btnCancel = document.getElementById("btnCancelar");
                                        const estado = document.getElementById("estadoHoras");
                                        let editando = false, valorAntes = null;

                                        const normalizar = t => (t ?? "").toString().normalize("NFKC").trim();
                                        function setBloqueado(msg="Bloqueado") {
                                            input.readOnly = true; btnEditar.disabled=false; btnSave.disabled=true; btnCancel.disabled=true;
                                            btnEditar.className="btn btn-secondary"; btnEditar.textContent="Editar"; estado.textContent=msg; editando=false;
                                        }
                                        function setEditando(msg="Editando…") {
                                            input.readOnly = false; btnEditar.disabled=true; btnSave.disabled=false; btnCancel.disabled=false;
                                            btnEditar.className="btn btn-success"; btnEditar.textContent="Editar"; estado.textContent=msg; editando=true; input.focus();
                                        }
                                        (function init(){
                                            const guardado = localStorage.getItem(KEY_VAL);
                                            const locked = localStorage.getItem(KEY_LOCKED) === "1";
                                            if (guardado) input.value = guardado;
                                            if (!locked) { valorAntes = input.value || ""; setEditando("Primera configuración: elige la hora y guarda para bloquear"); }
                                            else setBloqueado("Bloqueado (pulse Editar para ingresar contraseña)");
                                        })();
                                        btnEditar.addEventListener("click", ()=>{
                                            if (editando) return;
                                            const ingreso = prompt("Ingrese la contraseña para editar este campo:");
                                            if (ingreso===null) return;
                                            if (normalizar(ingreso)===normalizar(PASSWORD)) { valorAntes=input.value; setEditando(); }
                                            else alert("Contraseña incorrecta.");
                                        });
                                        btnSave.addEventListener("click", ()=>{
                                            const val = input.value;
                                            if (!/^\d{2}:\d{2}$/.test(val)) { alert("Ingrese una hora válida (HH:MM)."); return; }
                                            localStorage.setItem(KEY_VAL, val); localStorage.setItem(KEY_LOCKED, "1"); setBloqueado("Bloqueado (cambios guardados)");
                                        });
                                        btnCancel.addEventListener("click", ()=>{
                                            input.value = valorAntes ?? localStorage.getItem(KEY_VAL) ?? "";
                                            const locked = localStorage.getItem(KEY_LOCKED) === "1";
                                            if (locked) setBloqueado("Bloqueado (sin cambios)"); else setEditando("Primera configuración (sin cambios)");
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

                                    <!-- Hora de Inicio (solo input, SIN botones al lado) -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="hora_inicio" class="mb-0">Hora de Inicio</label>
                                            <input type="time" id="hora_inicio" class="form-control mt-2" name="hora_inicio" readonly>
                                        </div>
                                    </div>

                                    <!-- Hora de fin -->
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

                                    <!-- Botones de grupos -->
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap" style="gap:.5rem">
                                            <button type="button" class="btn btn-success btn-sm" id="btnIniciarSeleccion">Iniciar turnos (seleccionados)</button>
                                            <button type="button" class="btn btn-primary btn-sm" id="btnVerDetalle">Ver detalle</button>
                                        </div>
                                    </div>

                                    <!-- Modal Ver Detalle (1 fila por GRUPO) -->
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
                                                    <th>Personas</th>
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

                                    <!-- (opcional) input oculto si quieres enviar algo adicional -->
                                    <input type="hidden" name="grupo_id" id="grupo_id" value="">

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Registrar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1" id="btnLimpiar">Limpiar</button>
                                    </div>
                                </div>
                            </form>

                            <!-- ====== Gestión de GRUPOS (múltiples personas) ====== -->
                            <script>
                            (function(){
                              /* Estructura por día (localStorage):
                                 LS_GRUPOS = {
                                   "YYYY-MM-DD": [
                                     { id, personas:[...], inicio:"HH:MM", fin:null|"HH:MM", estado:"activo"|"finalizado" }
                                   ]
                                 }
                              */
                              const LS_GRUPOS = 'empaque_grupos_v1';
                              const fechaHoy = () => (new Date()).toISOString().slice(0,10);
                              const pad2 = n => String(n).padStart(2,'0');
                              const nowHHMM = () => { const d=new Date(); return `${pad2(d.getHours())}:${pad2(d.getMinutes())}`; };
                              const uid = () => 'g_'+Math.random().toString(36).slice(2,9);

                              // Storage helpers
                              const loadAll = () => { try { return JSON.parse(localStorage.getItem(LS_GRUPOS) || '{}'); } catch { return {}; } };
                              const saveAll = (obj) => localStorage.setItem(LS_GRUPOS, JSON.stringify(obj));
                              const loadDay = (day) => (loadAll()[day] || []);
                              function saveDay(day, arr){ const all = loadAll(); all[day] = arr; saveAll(all); }

                              // UI refs
                              const selPersonal = document.querySelector('select[name="personal[]"]');
                              const btnIniciarSeleccion = document.getElementById('btnIniciarSeleccion');
                              const btnVerDetalle = document.getElementById('btnVerDetalle');
                              const tbodyDetalle = document.getElementById('tbodyDetalle');
                              const fechaHoyLbl = document.getElementById('fechaHoyLbl');
                              const inpInicio = document.getElementById('hora_inicio');
                              const inpFin = document.getElementById('hora_fin');
                              const inpGrupoId = document.getElementById('grupo_id');
                              const form = document.getElementById('formConsumo');
                              const btnLimpiar = document.getElementById('btnLimpiar');

                              // Modal bootstrap
                              let modalDetalle;
                              document.addEventListener('DOMContentLoaded', () => {
                                const el = document.getElementById('modalDetalle');
                                if (window.bootstrap && el) modalDetalle = new bootstrap.Modal(el);
                              });

                              // Crear grupo con selección actual
                              btnIniciarSeleccion.addEventListener('click', () => {
                                const personas = Array.from(selPersonal.selectedOptions).map(o => o.value);
                                if (personas.length === 0) { alert('Selecciona al menos una persona.'); return; }

                                const day = fechaHoy();
                                const lista = loadDay(day);

                                // Validar que ninguna de las personas esté ya en un grupo ACTIVO
                                const enActivo = new Set();
                                lista.filter(g => g.estado==='activo').forEach(g => g.personas.forEach(p => enActivo.add(p)));
                                const conflicto = personas.filter(p => enActivo.has(p));
                                if (conflicto.length) {
                                  alert('No se pudo iniciar: ya están activos -> ' + conflicto.join(', '));
                                  return;
                                }

                                const grupo = { id: uid(), personas: personas.slice(), inicio: nowHHMM(), fin: null, estado: 'activo' };
                                lista.push(grupo); saveDay(day, lista);
                                alert('Grupo iniciado a las ' + grupo.inicio);
                              });

                              // Ver detalle
                              btnVerDetalle.addEventListener('click', () => {
                                fechaHoyLbl.textContent = fechaHoy();
                                renderTabla();
                                modalDetalle?.show();
                              });

                              // Render tabla 1 fila por grupo
                              function renderTabla(){
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                tbodyDetalle.innerHTML = '';
                                if (!lista.length) {
                                  tbodyDetalle.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Sin grupos hoy.</td></tr>';
                                  return;
                                }
                                lista.forEach(g => {
                                  const tr = document.createElement('tr');
                                  const personasHTML = g.personas.map(n => `<span class="badge bg-light text-dark me-1">${n}</span>`).join(' ');
                                  tr.innerHTML = `
                                    <td>${personasHTML}</td>
                                    <td>${g.inicio ?? '--:--'}</td>
                                    <td>${g.fin ?? '--:--'}</td>
                                    <td>${g.estado}</td>
                                    <td>
                                      <div class="btn-group btn-group-sm" role="group">
                                        <button class="btn btn-outline-primary btnCargar">Cargar</button>
                                        <button class="btn btn-outline-success btnFinalizar"${g.estado==='finalizado'?' disabled':''}>Finalizar ahora</button>
                                        <button class="btn btn-outline-danger btnEliminar">Eliminar</button>
                                      </div>
                                    </td>`;
                                  tr.querySelector('.btnCargar').addEventListener('click', ()=> cargarGrupoEnFormulario(g.id));
                                  tr.querySelector('.btnFinalizar').addEventListener('click', ()=> finalizarGrupoAhora(g.id));
                                  tr.querySelector('.btnEliminar').addEventListener('click', ()=> eliminarGrupo(g.id));
                                  tbodyDetalle.appendChild(tr);
                                });
                              }

                              // Acciones
                              function cargarGrupoEnFormulario(id){
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const g = lista.find(x => x.id===id);
                                if (!g) return;

                                // Seleccionar EXACTAMENTE las personas del grupo
                                Array.from(selPersonal.options).forEach(o => o.selected = false);
                                Array.from(selPersonal.options).forEach(o => { if (g.personas.includes(o.value)) o.selected = true; });

                                // Colocar horas
                                inpInicio.value = g.inicio || '';
                                inpFin.value = g.fin || '';

                                // Guardar id del grupo (opcional para backend)
                                inpGrupoId.value = g.id;

                                // Cerrar modal
                                modalDetalle?.hide();
                              }

                              function finalizarGrupoAhora(id){
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const g = lista.find(x => x.id===id);
                                if (!g) return;
                                if (g.estado === 'finalizado') { alert('El grupo ya está finalizado.'); return; }
                                g.fin = nowHHMM(); g.estado = 'finalizado'; saveDay(day, lista);
                                renderTabla();
                              }

                              function eliminarGrupo(id){
                                const day = fechaHoy();
                                let lista = loadDay(day);
                                if (!confirm('¿Eliminar este grupo local?')) return;
                                lista = lista.filter(x => x.id !== id);
                                saveDay(day, lista);
                                renderTabla();
                              }

                              // Envío: NO se publica automáticamente nada extra.
                              // Solo se envía lo que el usuario dejó en el formulario.
                              form.addEventListener('reset', ()=>{
                                inpGrupoId.value = '';
                                inpInicio.value = '';
                                inpFin.value = '';
                              });

                              // (Opcional) al enviar, si falta hora y existe un grupo con EXACTA selección, completar
                              form.addEventListener('submit', ()=>{
                                const seleccion = Array.from(selPersonal.selectedOptions).map(o=>o.value).sort().join('|');
                                const day = fechaHoy();
                                const lista = loadDay(day);
                                const match = lista.find(g => g.personas.slice().sort().join('|') === seleccion);
                                if (match) {
                                  if (!inpInicio.value) inpInicio.value = match.inicio || '';
                                  if (!inpFin.value)    inpFin.value    = match.fin || '';
                                  if (!inpGrupoId.value) inpGrupoId.value = match.id;
                                }
                              });

                              // Limpiar
                              btnLimpiar.addEventListener('click', ()=>{
                                inpGrupoId.value = '';
                                inpInicio.value = '';
                                inpFin.value = '';
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
