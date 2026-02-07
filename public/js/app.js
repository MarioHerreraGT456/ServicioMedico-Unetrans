/*******************************************************
 * UTILIDADES
 *******************************************************/
function qs(sel, root = document) {
  return root.querySelector(sel);
}
function qsa(sel, root = document) {
  return Array.from(root.querySelectorAll(sel));
}
function escapeHTML(str) {
  return String(str)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

/*******************************************************
 * AUTH (LOGIN / REGISTRO / RECUPERACIÓN)
 * NO DEPENDE DEL MENÚ
 *******************************************************/
(function () {
  const AUTH_IDS = [
    "loginOverlay",
    "registroOverlay",
    "recuperarOverlay",
    "codigoOverlay",
    "nuevaClaveOverlay",
  ];

  function hideAllAuth() {
    AUTH_IDS.forEach((id) => {
      qs(`#${id}`)?.classList.add("oai-hidden");
    });
  }

  function openAuth(id) {
    hideAllAuth();
    qs(`#${id}`)?.classList.remove("oai-hidden");
  }

  function inputsVacios(container) {
    if (!container) return true;
    return [...container.querySelectorAll("input")].some((i) => !i.value.trim());
  }

  /* ===== NAV INDEX ===== */
  qsa(".main-header__link").forEach((link) => {
    const txt = (link.textContent || "").toLowerCase();

    if (txt.includes("iniciar")) {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        openAuth("loginOverlay");
      });
    }

    if (txt.includes("registr")) {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        openAuth("registroOverlay");
      });
    }
  });

  /* ===== LOGIN ===== */
  qs("#goRegistro")?.addEventListener("click", (e) => {
    e.preventDefault();
    openAuth("registroOverlay");
  });

  qs("#goRecuperar")?.addEventListener("click", (e) => {
    e.preventDefault();
    openAuth("recuperarOverlay");
  });

  qs("#loginOverlay button")?.addEventListener("click", () => {
    const box = qs("#loginOverlay");
    if (inputsVacios(box)) {
      alert("Complete usuario y contraseña");
      return;
    }

    const usuario = box.querySelector('input[type="text"]')?.value.trim() || "";

    // SIMULACIÓN DE ROL
    /*if (usuario.toUpperCase().startsWith("M")) {
      location.href = "inicioMedico.html";
    } else {
      location.href = "inicioPaciente.html";
    }*/

    
  });

  /* ===== REGISTRO ===== */
qs("#btnRegistroContinuar")?.addEventListener("click", (e) => {
  // Si el botón está dentro de un <form>, evitamos submit real (por ahora es frontend)
  e.preventDefault();

  const overlay = qs("#registroOverlay");
    if (!overlay) return;

    // 1) Ideal: validar con HTML5
    const form = overlay.querySelector("form");

    if (form) {
      // Esto obliga al navegador a revisar required/pattern/type/etc
      if (!form.checkValidity()) {
        form.reportValidity(); // muestra los mensajes nativos
        return;
      }
    } else {
      // 2) Si NO hay <form>, validamos igual con checkValidity() por input
      const fields = [...overlay.querySelectorAll("input, select, textarea")];
      for (const el of fields) {
        if (typeof el.checkValidity === "function" && !el.checkValidity()) {
          el.reportValidity?.();
          return;
        }
      }
    }

    // Si todo OK, entonces sí cambia de pantalla
    openAuth("nuevaClaveOverlay");
  });

  /* ===== RECUPERAR ===== */
  qs("#btnEnviarCodigo")?.addEventListener("click", () => {
    if (!qs("#recUsuario")?.value.trim()) {
      alert("Ingrese su usuario");
      return;
    }

    const metodo = qs('input[name="metodoRecuperacion"]:checked');
    if (!metodo) {
      alert("Seleccione un método de recuperación");
      return;
    }

    openAuth("codigoOverlay");
  });

  qs("#btnCodigoContinuar")?.addEventListener("click", (e) => {
    e.preventDefault();

    const inputs = qsa("#codigoOverlay input");
    let codigo = "";

    for (let input of inputs) {
      const val = (input.value || "").trim();
      if (!val) {
        alert("Debe completar los 4 dígitos");
        return;
      }
      if (!/^\d$/.test(val)) {
        alert("Solo números");
        return;
      }
      codigo += val;
    }

    if (codigo !== "1234") {
      alert("Código incorrecto");
      return;
    }

    openAuth("nuevaClaveOverlay");
  });

  /* ===== NUEVA CLAVE ===== */
  qs("#btnEstablecerClave")?.addEventListener("click", () => {
    const p1 = qs("#newPass");
    const p2 = qs("#confirmPass");

    if (!p1?.value || !p2?.value) {
      alert("Complete ambos campos");
      return;
    }
    if (p1.value !== p2.value) {
      alert("Las contraseñas no coinciden");
      return;
    }

    openAuth("loginOverlay");
  });
})();

/*******************************************************
 * MENÚ LATERAL PUSH (PACIENTE Y MÉDICO)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const menuBtn = qs(".main-header__icon-menu");

  const sidebarPaciente = qs("#sidebarPaciente");
  const sidebarMedico = qs("#sidebarMedico");
  const sidebar = sidebarPaciente || sidebarMedico;

  if (!menuBtn || !sidebar) return;

  // Abrir / cerrar menú
  menuBtn.addEventListener("click", () => {
    body.classList.toggle("menu-open");
  });

  // Navegación entre vistas
  qsa(".sidebar__item").forEach((btn) => {
    btn.addEventListener("click", () => {
      const view = btn.dataset.view;
      if (!view) return;

      qsa(".sidebar__item").forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      qsa(".view").forEach((v) => v.classList.add("hidden"));
      qs(`#view-${view}`)?.classList.remove("hidden");

      body.classList.remove("menu-open");

      // Si vuelves a Historias (PACIENTE) y tu sistema usa los contenedores,
      // lo reseteamos SIN ROMPER nada (solo si existen)
      if (view === "historias") {
        const modulesView = qs("#histories-modules");
        const emptyView = qs("#histories-empty");
        const listView = qs("#histories-list");
        if (modulesView && emptyView && listView) {
          modulesView.classList.remove("hidden");
          emptyView.classList.add("hidden");
          listView.classList.add("hidden");
        }
      }
    });
  });

  // Logout (si existe en tu menú)
  qs(".sidebar__logout")?.addEventListener("click", () => {
    location.href = "index.html";
  });
});

/*******************************************************
 * HISTORIAS CLÍNICAS – PACIENTE (POR MÓDULO)
 * IMPORTANTE: Solo corre si detecta tus contenedores.
 * Así NO rompe el resto del sitio y mantiene lo que ya funciona.
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
  const historyCards = qsa(".history-card");

  const modulesView = qs("#histories-modules");
  const emptyView = qs("#histories-empty");
  const listView = qs("#histories-list");
  const title = qs("#histories-module-title");

  // Si tu HTML actual NO tiene estos contenedores, esta parte no corre.
  // (Esto evita romper páginas y evita que choque con la vista inyectada del médico)
  if (!historyCards.length || !modulesView || !emptyView || !listView || !title) return;

  const historiasPorModulo = {
    medicina: [],
    odontologia: [],
    psiquiatria: [],
  };

  historyCards.forEach((card) => {
    card.addEventListener("click", () => {
      const module = card.dataset.module;
      if (!module) return;

      modulesView.classList.add("hidden");

      if (!historiasPorModulo[module]?.length) {
        emptyView.classList.remove("hidden");
        listView.classList.add("hidden");
        title.textContent = nombreModulo(module);
      } else {
        emptyView.classList.add("hidden");
        listView.classList.remove("hidden");
        renderHistorias(module);
      }
    });
  });

  function nombreModulo(m) {
    return (
      {
        medicina: "Medicina General",
        odontologia: "Odontología",
        psiquiatria: "Psiquiatría",
      }[m] || ""
    );
  }

  function renderHistorias(module) {
    listView.innerHTML = `
      <h2>${nombreModulo(module)}</h2>
      <p style="text-align:center;color:#6c757d">
        Aquí se mostrarán las historias clínicas
      </p>
    `;
  }
});

/*******************************************************
 * SIMULACIÓN PERFIL PACIENTE – MÉDICO
 * - Botón Buscar: muestra perfil paciente simulado
 * - Perfil completo (datos + contacto + sistema)
 * - Solo flechita arriba derecha: alterna Datos <-> Historias y vuelve.
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
  const btnBuscarPaciente = qs("#btnBuscarPaciente");
  const inputCedula = qs("#searchCedula");
  const perfilPacienteView = qs("#view-perfil-paciente");

  // Si no estamos en inicioMedico, salir
  if (!btnBuscarPaciente || !inputCedula || !perfilPacienteView) return;

  // Contenedor (si no existe, lo creamos dentro de la sección)
  let cont = qs("#perfilPacienteContainer");
  if (!cont) {
    cont = document.createElement("div");
    cont.id = "perfilPacienteContainer";
    perfilPacienteView.appendChild(cont);
  }

  // Enter también busca
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

    // Ocultar todas las vistas
    qsa(".view").forEach((v) => v.classList.add("hidden"));

    // Mostrar perfil del paciente (simulado)
    perfilPacienteView.classList.remove("hidden");

    // Inyectar HTML completo
    cont.innerHTML = buildPacienteHTML(cedula);

    // Activar toggle flecha
    wirePacienteArrowToggle(cont);

    // Activar “módulos -> vacío -> volver” dentro de historias del paciente (médico)
    wirePacienteHistoriasModulo(cont);
  });

  function buildPacienteHTML(cedula) {
    return `
      <div class="patient-profile-shell">

        <div class="profile-header-card">

          <!-- Flechita (arriba derecha) -->
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
                <div class="contact-value">
                  <span>paciente@email.com</span>
                </div>
              </div>

              <div class="profile-contact-item">
                <span class="contact-label">Teléfono</span>
                <div class="contact-value">
                  <span>0412-1234567</span>
                </div>
              </div>

              <div class="profile-contact-item">
                <span class="contact-label">Dirección</span>
                <div class="contact-value">
                  <span>Caracas, Venezuela</span>
                </div>
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
                <div class="history-icon">
                  <span class="material-symbols-outlined">stethoscope</span>
                </div>
                <div class="history-info">
                  <h3>Medicina General</h3>
                  <p>Historias clínicas generales</p>
                </div>
              </div>

              <div class="history-card" data-module="odontologia">
                <div class="history-icon">
                  <span class="material-symbols-outlined">dentistry</span>
                </div>
                <div class="history-info">
                  <h3>Odontología</h3>
                  <p>Historias odontológicas</p>
                </div>
              </div>

              <div class="history-card" data-module="psiquiatria">
                <div class="history-icon">
                  <span class="material-symbols-outlined">psychology</span>
                </div>
                <div class="history-info">
                  <h3>Psiquiatría</h3>
                  <p>Historias de salud mental</p>
                </div>
              </div>

            </div>
        </div>

          <!-- Vista módulo (lista + crear + formulario) -->
          <div class="hidden" data-hm="empty">
            <div class="profile-card">

              <h3 class="profile-card-title" data-hm-title>Módulo</h3>

              <!-- Crear historia (tarjeta grande) -->
              <div data-hm-create-card
                  style="display:flex;align-items:center;gap:12px;cursor:pointer;
                          border:1px dashed rgba(0,0,0,.18);border-radius:14px;
                          padding:14px;margin-top:10px;">
                <span class="material-symbols-outlined"
                      style="font-size:34px;line-height:1">add_box</span>
                <div>
                  <div style="font-weight:700;">Crear nueva historia</div>
                  <div style="color:#6c757d;font-size:14px;">Abrir formulario y guardar</div>
                </div>
              </div>

              <!-- Lista de historias guardadas (simulado) -->
              <div data-hm-list style="margin-top:14px;"></div>

              <!-- Formulario (hidden por defecto) -->
              <form data-hm-form class="hidden" style="margin-top:14px;">
                <div style="display:grid;gap:10px;">
                  <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;">Fecha</label>
                    <input data-hm-fecha type="date"
                          style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);"/>
                  </div>

                  <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;">Motivo / Consulta</label>
                    <input data-hm-motivo type="text"
                          placeholder="Ej: Dolor de cabeza, revisión, ansiedad..."
                          style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);"/>
                  </div>

                  <!-- Campos extra solo para odontología (se activan por JS) -->
                  <div data-hm-odon-extra class="hidden">
                    <label style="display:block;font-weight:600;margin-bottom:6px;">Pieza dental</label>
                    <input data-hm-pieza type="text" placeholder="Ej: 11, 24, 36..."
                          style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);"/>
                  </div>

                  <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;">Observaciones</label>
                    <textarea data-hm-obs rows="4"
                              placeholder="Escriba observaciones clínicas..."
                              style="width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,.18);resize:vertical;"></textarea>
                  </div>

                  <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" data-hm-cancel
                            style="padding:10px 14px;border-radius:10px;border:1px solid rgba(0,0,0,.18);background:#fff;cursor:pointer;">
                      Cancelar
                    </button>

                    <button type="submit" data-hm-save
                            class="container-search__btn"
                            style="padding:10px 14px;border-radius:10px;cursor:pointer;">
                      Guardar
                    </button>
                  </div>
                </div>
              </form>

              <div style="display:flex;justify-content:center;margin-top:14px">
                <button type="button" class="container-search__btn" data-hm-back>
                  Volver
                </button>
              </div>

            </div>
          </div>

          </div>

        </div>

      </div>
    `;
  }
});

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
    if (icon) icon.textContent = enHistorias ? "arrow_back" : "arrow_forward";

    btn.title = enHistorias ? "Ver datos personales" : "Ver historias clínicas";

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

  // 🔹 DECLARACIÓN CORRECTA DE LAS CARTAS
  // Click en cada módulo (MEDICINA, PSIQUIATRÍA y ODONTOLOGÍA)
  const cards = qsa(".history-card", modules);

  cards.forEach((card) => {
    card.addEventListener("click", () => {
      moduloActual = card.dataset.module;

      // ✅ ya NO se bloquea odontología
      title.textContent = nombreModulo(moduloActual);

      modules.classList.add("hidden");
      empty.classList.remove("hidden");

      // Estado inicial: mostrar tarjeta "Crear historia"
      createCard?.classList.remove("hidden");
      listWrap?.classList.remove("hidden");
      form?.classList.add("hidden");

      // Render lista (por si ya hay historias guardadas)
      renderLista();
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
    return {
      medicina: "Medicina General",
      psiquiatria: "Psiquiatría",
    }[m] || "Módulo";
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
  const titulo =
    tipo === "psiquiatria"
      ? "Psiquiatría"
      : "Medicina General";

  return `
    <div class="historia-hoja">

      <!-- BOTÓN CERRAR (FLOTANTE) -->
      <button id="btnCerrarHistoria" class="historia-cerrar">✕</button>

      <!-- CINTILLO -->
      <div class="historia-cintillo">
        <img src="img/cintillo.jpeg" alt="Cintillo institucional">
      </div>

      <!-- TÍTULO -->
      <h2 class="historia-titulo">${titulo}</h2>

      <!-- CONTENIDO -->
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
        <button class="btn-secundario" id="btnGuardarHistoria">
          Guardar historia
        </button>
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

  if (tipo === "odontologia") {
  wireHistoriaOdontologia(modal);
  }

  modal.querySelector("#btnCerrarHistoria").onclick = () => {
    modal.classList.add("hidden");
  };

  modal.querySelector("#btnGuardarHistoria").onclick = () => {
    alert("Historia guardada (simulación)");
    modal.classList.add("hidden");
  };

  // Navegación páginas odontología
  const pages = modal.querySelectorAll(".historia-pagina");

  modal.querySelectorAll("[data-next]").forEach(btn => {
    btn.onclick = () => {
      pages[0].classList.remove("active");
      pages[1].classList.add("active");
    };
  });

  modal.querySelectorAll("[data-prev]").forEach(btn => {
    btn.onclick = () => {
      pages[1].classList.remove("active");
      pages[0].classList.add("active");
    };
  });
}

function buildHistoriaOdontologiaHTML() {
  return `
    <div class="historia-hoja odontologia">

      <!-- Flecha a página 2 -->
      <button class="btn-pagina" data-next>
          →
      </button>

      <button id="btnCerrarHistoria" class="btn-cerrar">
                ✕
      </button>

      <!-- CINTILLO -->
      <div class="historia-cintillo">
        <img src="img/cintillo.jpeg" alt="Cintillo institucional">
      </div>

      <!-- CONTENEDOR DE PÁGINAS -->
      <div class="historia-pagina-contenedor">

        <!-- =====================
             PÁGINA 1
        ====================== -->
        <div class="historia-pagina active" data-page="1">

          <div>
            <h2 class="historia-titulo">Odontología General</h2>
          </div>

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
              <div>Diabetes: ________</div>
              <div>Cardiovascular: ________</div>
              <div>Respiratorio: ________</div>
              <div>Alergias: ________</div>
              <div>Hemorragia: ________</div>
              <div>Epilepsia: ________</div>
              <div>Trat. Médico: ________</div>
              <div>Medicación: ________</div>
            </div>
          </section>

          <section class="historia-seccion">
            <h3>Examen clínico bucal</h3>
            <div class="historia-grid">
              <div>Labios: ________</div>
              <div>Lengua: ________</div>
              <div>Piso de boca: ________</div>
              <div>Encías: ________</div>
              <div>ATM: ________</div>
              <div>Oclusión: ________</div>
            </div>
          </section>

        </div>

        <!-- =====================
             PÁGINA 2 (REVERSO)
        ====================== -->
        <div class="historia-pagina" data-page="2">

          <div>
            <h2 class="historia-titulo">Odontograma y Tratamiento</h2>
          </div>

          <section class="historia-seccion">
            <h3>Odontograma clínico</h3>
            <div class="odontograma-placeholder">
              <img src="img/odontograma.jpg" alt="Odontograma">
            </div>
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
            <button class="btn-secundario" id="btnGuardarHistoria">
              Guardar Historia 
            </button>
          </div>

        </div>
          
      </div>

    </div>
  `;
}

/*=====MANEJO DE LAS PAGINAS INTERNAS DE LA HISTORIA DE ODONTOLOGIA=======*/
function wireHistoriaOdontologia(modal) {
  const page1 = modal.querySelector('[data-page="1"]');
  const page2 = modal.querySelector('[data-page="2"]');

  if (!page1 || !page2) return;

  // Ir al reverso
  modal.querySelectorAll('[data-next]').forEach(btn => {
    btn.addEventListener('click', () => {
      page1.classList.remove('active');
      page2.classList.add('active');
    });
  });

  // Volver al frente
  modal.querySelectorAll('[data-prev]').forEach(btn => {
    btn.addEventListener('click', () => {
      page2.classList.remove('active');
      page1.classList.add('active');
    });
  });

  // Cerrar historia
  modal.querySelectorAll('.btn-cerrar').forEach(btn => {
    btn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });
  });
}

/*ESTO CONTROLA EL SELECT DEL REGISTRO*/
const tipoPaciente = document.getElementById("tipoPaciente");
const selectCarrera = document.getElementById("selectCarrera");
const selectPersonal = document.getElementById("selectPersonal");

tipoPaciente.addEventListener("change", () => {
  // resetear todo
  selectCarrera.classList.add("hidden");
  selectPersonal.classList.add("hidden");
  selectCarrera.value = "";
  selectPersonal.value = "";

  tipoPaciente.classList.add("active");

  if (tipoPaciente.value === "estudiante") {
    selectCarrera.classList.remove("hidden");
  }

  if (tipoPaciente.value === "personal") {
    selectPersonal.classList.remove("hidden");
  }
});

// para que el texto pase de gris a negro
[selectCarrera, selectPersonal].forEach(select => {
  select.addEventListener("change", () => {
    select.classList.add("active");
  });
});

//PARA ERRORES DE LOGIN
document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);

  if (params.get("error") === "login") {
    const overlay = document.getElementById("loginOverlay");
    if (overlay) {
      overlay.classList.remove("oai-hidden");
    }
  }
});