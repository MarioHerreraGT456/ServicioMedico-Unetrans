/*******************************************************
 * SIMULACIÓN PERFIL PACIENTE – MÉDICO
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    const btnBuscarPaciente = qs("#btnBuscarPaciente");
    const inputCedula = qs("#searchCedula");
    const perfilPacienteView = qs("#view-perfil-paciente");

    if (!btnBuscarPaciente || !inputCedula || !perfilPacienteView) return;

    let cont = qs("#perfilPacienteContainer");
    if (!cont) {
        cont = document.createElement("div");
        cont.id = "perfilPacienteContainer";
        perfilPacienteView.appendChild(cont);
    }

    inputCedula.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            btnBuscarPaciente.click();
        }
    });

    btnBuscarPaciente.addEventListener("click", () => {
        const cedula = (inputCedula.value || "").trim();
        if (!cedula) {
            alert("Ingrese una cédula");
            return;
        }

        qsa(".view").forEach((v) => v.classList.add("hidden"));
        perfilPacienteView.classList.remove("hidden");
        cont.innerHTML = buildPacienteHTML(cedula);

        wirePacienteArrowToggle(cont);
        wirePacienteHistoriasModulo(cont);
    });
});

// Funciones auxiliares (hoisting)
function buildPacienteHTML(cedula) {
    return `
    <div class="patient-profile-shell">
      <div class="profile-header-card">
        <button type="button" class="patient-toggle-view" id="btnTogglePacienteView" title="Ver historias clínicas">
          <span class="material-symbols-outlined">arrow_forward</span>
        </button>
        <div class="profile-avatar">
          <img src="img/perfil.jpg" alt="Foto de perfil" onerror="this.style.display='none'">
        </div>
        <div class="profile-main-info">
          <h2 class="profile-name">María González</h2>
          <span class="profile-role">Paciente</span>
          <span class="profile-status active">Activo</span>
        </div>
      </div>

      <!-- PANEL DATOS -->
      <div data-panel="datos">
        <div class="profile-card">
          <h3 class="profile-card-title">Datos personales</h3>
          <div class="profile-grid">
            <div class="profile-item">
              <span class="label">Cédula</span>
              <span class="value">${escapeHTML(cedula)}</span>
            </div>
            <div class="profile-item">
              <span class="label">Fecha nacimiento</span>
              <span class="value">14/08/1996</span>
            </div>
            <div class="profile-item">
              <span class="label">Edad</span>
              <span class="value">28 años</span>
            </div>
            <div class="profile-item">
              <span class="label">Sexo</span>
              <span class="value">Femenino</span>
            </div>
            <div class="profile-item">
              <span class="label">Estado civil</span>
              <span class="value">Soltera</span>
            </div>
          </div>
        </div>

        <div class="profile-card">
          <h3 class="profile-card-title">Contacto</h3>
          <div class="profile-contact-list">
            <div class="profile-contact-item">
              <span class="contact-label">Correo</span>
              <div class="contact-value"><span>paciente@email.com</span></div>
            </div>
            <div class="profile-contact-item">
              <span class="contact-label">Teléfono</span>
              <div class="contact-value"><span>0412-1234567</span></div>
            </div>
            <div class="profile-contact-item">
              <span class="contact-label">Dirección</span>
              <div class="contact-value"><span>Caracas, Venezuela</span></div>
            </div>
          </div>
        </div>

        <div class="profile-card">
          <h3 class="profile-card-title">Información del sistema</h3>
          <div class="profile-grid">
            <div class="profile-item">
              <span class="label">Rol</span>
              <span class="value">Paciente</span>
            </div>
            <div class="profile-item">
              <span class="label">Fecha de registro</span>
              <span class="value">10/01/2024</span>
            </div>
            <div class="profile-item">
              <span class="label">Estado de cuenta</span>
              <span class="value status-active">Activa</span>
            </div>
          </div>
        </div>
      </div>

      <!-- PANEL HISTORIAS -->
      <div class="profile-card histories-container-card">
        <div data-panel="historias" class="hidden">
          <div class="histories-wrapper">
            <!-- Vista módulos -->
            <div class="histories-grid" data-hm="modules">
              <div class="history-card" data-module="medicina">
                <div class="history-icon"><span class="material-symbols-outlined">stethoscope</span></div>
                <div class="history-info"><h3>Medicina General</h3><p>Historias clínicas generales</p></div>
              </div>
              <div class="history-card" data-module="odontologia">
                <div class="history-icon"><span class="material-symbols-outlined">dentistry</span></div>
                <div class="history-info"><h3>Odontología</h3><p>Historias odontológicas</p></div>
              </div>
              <div class="history-card" data-module="psiquiatria">
                <div class="history-icon"><span class="material-symbols-outlined">psychology</span></div>
                <div class="history-info"><h3>Psiquiatría</h3><p>Historias de salud mental</p></div>
              </div>
            </div>
          </div>

          <!-- Vista módulo (vacío / crear / lista) -->
          <div class="hidden" data-hm="empty">
            <div class="profile-card">
              <h3 class="profile-card-title" data-hm-title>Módulo</h3>
              <div data-hm-create-card style="display:flex;align-items:center;gap:12px;cursor:pointer;border:1px dashed rgba(0,0,0,.18);border-radius:14px;padding:14px;margin-top:10px;">
                <span class="material-symbols-outlined" style="font-size:34px;line-height:1">add_box</span>
                <div><div style="font-weight:700;">Crear nueva historia</div><div style="color:#6c757d;font-size:14px;">Abrir formulario y guardar</div></div>
              </div>
              <div data-hm-list style="margin-top:14px;"></div>
              <form data-hm-form class="hidden" style="margin-top:14px;">
                <div style="display:grid;gap:10px;">
                  <div><label style="display:block;font-weight:600;margin-bottom:6px;">Fecha</label><input data-hm-fecha type="date" style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);"/></div>
                  <div><label style="display:block;font-weight:600;margin-bottom:6px;">Motivo / Consulta</label><input data-hm-motivo type="text" placeholder="Ej: Dolor de cabeza, revisión, ansiedad..." style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);"/></div>
                  <div data-hm-odon-extra class="hidden"><label style="display:block;font-weight:600;margin-bottom:6px;">Pieza dental</label><input data-hm-pieza type="text" placeholder="Ej: 11, 24, 36..." style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);"/></div>
                  <div><label style="display:block;font-weight:600;margin-bottom:6px;">Observaciones</label><textarea data-hm-obs rows="4" placeholder="Escriba observaciones clínicas..." style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);resize:vertical;"></textarea></div>
                  <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" data-hm-cancel style="padding:10px 14px;border-radius:10px;border:1px solid rgba(0,0,0,.18);background:#fff;cursor:pointer;">Cancelar</button>
                    <button type="submit" data-hm-save class="container-search__btn" style="padding:10px 14px;border-radius:10px;cursor:pointer;">Guardar</button>
                  </div>
                </div>
              </form>
              <div style="display:flex;justify-content:center;margin-top:14px">
                <button type="button" class="container-search__btn" data-hm-back>Volver</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
}

function wirePacienteArrowToggle(root) {
    const btn = qs("#btnTogglePacienteView", root);
    const panelDatos = qs('[data-panel="datos"]', root);
    const panelHistorias = qs('[data-panel="historias"]', root);
    if (!btn || !panelDatos || !panelHistorias) return;

    let enHistorias = false;
    btn.addEventListener("click", () => {
        enHistorias = !enHistorias;
        panelDatos.classList.toggle("hidden", enHistorias);
        panelHistorias.classList.toggle("hidden", !enHistorias);
        const icon = qs("span", btn);
        if (icon)
            icon.textContent = enHistorias ? "arrow_back" : "arrow_forward";
        btn.title = enHistorias
            ? "Ver datos personales"
            : "Ver historias clínicas";
        if (enHistorias) resetInjectedHistorias(root);
    });
}

function wirePacienteHistoriasModulo(root) {
    const modules = qs('[data-hm="modules"]', root);
    const empty = qs('[data-hm="empty"]', root);
    const title = qs("[data-hm-title]", root);
    const backBtn = qs("[data-hm-back]", root);
    if (!modules || !empty || !title) return;

    const createCard = qs("[data-hm-create-card]", empty);
    const store = (window.__HIST_SIM__ = window.__HIST_SIM__ || {
        medicina: [],
        psiquiatria: [],
    });
    let moduloActual = null;

    const cards = qsa(".history-card", modules);
    cards.forEach((card) => {
        card.addEventListener("click", () => {
            moduloActual = card.dataset.module;
            title.textContent = nombreModulo(moduloActual);
            modules.classList.add("hidden");
            empty.classList.remove("hidden");
            createCard?.classList.remove("hidden");
            // listWrap?.classList.remove("hidden"); // si existiera
            // form?.classList.add("hidden");
            renderLista(); // función interna, pendiente definir
        });
    });

    backBtn?.addEventListener("click", () => {
        empty.classList.add("hidden");
        modules.classList.remove("hidden");
    });

    createCard?.addEventListener("click", () => {
        abrirHistoriaModal(moduloActual);
    });

    function nombreModulo(m) {
        return (
            { medicina: "Medicina General", psiquiatria: "Psiquiatría" }[m] ||
            "Módulo"
        );
    }

    function renderLista() {
        // Simulación de lista vacía por ahora
        const list = qs("[data-hm-list]", empty);
        if (list) list.innerHTML = "<p>No hay historias guardadas</p>";
    }
}

function resetInjectedHistorias(root) {
    const modules = qs('[data-hm="modules"]', root);
    const empty = qs('[data-hm="empty"]', root);
    if (!modules || !empty) return;
    empty.classList.add("hidden");
    modules.classList.remove("hidden");
}

function buildHistoriaGeneralHTML(tipo) {
    const titulo = tipo === "psiquiatria" ? "Psiquiatría" : "Medicina General";
    return `
    <div class="historia-hoja">
      <button id="btnCerrarHistoria" class="historia-cerrar">✕</button>
      <div class="historia-cintillo"><img src="img/cintillo.jpeg" alt="Cintillo institucional"></div>
      <h2 class="historia-titulo">${titulo}</h2>
      <div class="historia-pagina">
        <section class="historia-seccion">
          <h3>Datos del paciente</h3>
          <div class="historia-linea">Paciente: ________________</div>
          <div class="historia-linea">C.I: _____________________</div>
          <div class="historia-linea">Edad: _____ Sexo: ____</div>
          <div class="historia-linea">Dirección: ________________________________________________</div>
          <div class="historia-linea">Teléfono: ________________</div>
        </section>
        <section class="historia-seccion">
          <h3>Motivo de la consulta</h3>
          <div class="historia-bloque grande"></div>
        </section>
        <section class="historia-seccion">
          <h3>Enfermedad actual</h3>
          <div class="historia-bloque grande"></div>
        </section>
        <section class="historia-seccion">
          <h3>Antecedentes personales</h3>
          <div class="historia-bloque grande"></div>
        </section>
        <section class="historia-seccion">
          <h3>Antecedentes familiares</h3>
          <div class="historia-bloque grande"></div>
        </section>
      </div>
      <div class="historia-footer">
        <button class="btn-secundario" id="btnGuardarHistoria">Guardar historia</button>
      </div>
    </div>
  `;
}

function abrirHistoriaModal(tipo) {
    let modal = document.getElementById("historiaModal");
    if (!modal) {
        modal = document.createElement("div");
        modal.id = "historiaModal";
        modal.className = "historia-modal";
        document.body.appendChild(modal);
    }

    modal.innerHTML =
        tipo === "odontologia"
            ? buildHistoriaOdontologiaHTML()
            : buildHistoriaGeneralHTML(tipo);
    modal.classList.remove("hidden");

    if (tipo === "odontologia") wireHistoriaOdontologia(modal);

    modal.querySelector("#btnCerrarHistoria").onclick = () =>
        modal.classList.add("hidden");
    modal.querySelector("#btnGuardarHistoria").onclick = () => {
        alert("Historia guardada (simulación)");
        modal.classList.add("hidden");
    };

    const pages = modal.querySelectorAll(".historia-pagina");
    modal.querySelectorAll("[data-next]").forEach((btn) => {
        btn.onclick = () => {
            pages[0].classList.remove("active");
            pages[1].classList.add("active");
        };
    });
    modal.querySelectorAll("[data-prev]").forEach((btn) => {
        btn.onclick = () => {
            pages[1].classList.remove("active");
            pages[0].classList.add("active");
        };
    });
}

function buildHistoriaOdontologiaHTML() {
    return `
    <div class="historia-hoja odontologia">
      <button class="btn-pagina" data-next>→</button>
      <button id="btnCerrarHistoria" class="btn-cerrar">✕</button>
      <div class="historia-cintillo"><img src="img/cintillo.jpeg" alt="Cintillo institucional"></div>
      <div class="historia-pagina-contenedor">
        <div class="historia-pagina active" data-page="1">
          <h2 class="historia-titulo">Odontología General</h2>
          <section class="historia-seccion">
            <h3>Datos del paciente</h3>
            <div class="historia-linea">Paciente: ____________________________</div>
            <div class="historia-linea">C.I: ____________________________</div>
            <div class="historia-linea">Edad: _______  Sexo: _______</div>
            <div class="historia-linea">Dirección: __________________________________________</div>
            <div class="historia-linea">Teléfono: ____________________________</div>
          </section>
          <section class="historia-seccion">
            <h3>Antecedentes personales</h3>
            <div class="historia-grid">
              <div>Diabetes: ________</div><div>Cardiovascular: ________</div>
              <div>Respiratorio: ________</div><div>Alergias: ________</div>
              <div>Hemorragia: ________</div><div>Epilepsia: ________</div>
              <div>Trat. Médico: ________</div><div>Medicación: ________</div>
            </div>
          </section>
          <section class="historia-seccion">
            <h3>Examen clínico bucal</h3>
            <div class="historia-grid">
              <div>Labios: ________</div><div>Lengua: ________</div>
              <div>Piso de boca: ________</div><div>Encías: ________</div>
              <div>ATM: ________</div><div>Oclusión: ________</div>
            </div>
          </section>
        </div>
        <div class="historia-pagina" data-page="2">
          <h2 class="historia-titulo">Odontograma y Tratamiento</h2>
          <section class="historia-seccion">
            <h3>Odontograma clínico</h3>
            <div class="odontograma-placeholder"><img src="img/odontograma.jpg" alt="Odontograma"></div>
          </section>
          <section class="historia-seccion">
            <h3>Tratamiento</h3>
            <div class="historia-bloque extra-grande"></div>
          </section>
          <section class="historia-seccion">
            <h3>Radiodiagnóstico</h3>
            <div class="historia-bloque mediano"></div>
          </section>
          <div class="historia-footer">
            <button class="btn-secundario" id="btnGuardarHistoria">Guardar Historia</button>
          </div>
        </div>
      </div>
    </div>
  `;
}

function wireHistoriaOdontologia(modal) {
    const page1 = modal.querySelector('[data-page="1"]');
    const page2 = modal.querySelector('[data-page="2"]');
    if (!page1 || !page2) return;

    modal.querySelectorAll("[data-next]").forEach((btn) => {
        btn.addEventListener("click", () => {
            page1.classList.remove("active");
            page2.classList.add("active");
        });
    });
    modal.querySelectorAll("[data-prev]").forEach((btn) => {
        btn.addEventListener("click", () => {
            page2.classList.remove("active");
            page1.classList.add("active");
        });
    });
    modal.querySelectorAll(".btn-cerrar").forEach((btn) => {
        btn.addEventListener("click", () => modal.classList.add("hidden"));
    });
}
