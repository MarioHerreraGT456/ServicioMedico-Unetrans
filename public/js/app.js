/*******************************************************
 * ESTADO GLOBAL DEL REGISTRO DE PACIENTE
 *******************************************************/
// let cedulaRegistroPaciente = null;

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
 * AUTH DINÁMICO (WELCOME)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    // Auth overlay deshabilitado: login/registro son pantallas separadas
    const container = document.getElementById("authOverlayContainer");
    if (container) { container.innerHTML = ""; }
    // No hacemos fetch/overlay, dejamos navegación normal
    // return para evitar lógica vieja de modal
    // (Las demás secciones del app.js se cargan en otros DOMContentLoaded separados)
    return;
async function abrirAuth(url) {
        try {
            const res = await fetch(url);
            const html = await res.text();

            container.innerHTML = `
        <div class="oai-backdrop">
          <div class="oai-frame-drawer auth-box">
            ${html}
          </div>
        </div>
      `;

            document.body.style.overflow = "hidden";

            // Cerrar con X
            container.querySelectorAll(".btn-cerrar-overlay").forEach((btn) => {
                btn.addEventListener("click", cerrarAuth);
            });
        } catch (err) {
            console.error("Error cargando auth:", err);
        }
    }

    function cerrarAuth() {
        container.innerHTML = "";
        document.body.style.overflow = "";
    }

    // 🔥 INTERCEPTAR LINKS AUTH (LOGIN / REGISTER / RECUPERAR)
    //     document.querySelectorAll(`
    //       a[href*='login'],
    //       a[href*='register'],
    //       a[href*='passwordRequest'],
    //       a[href*='forgot']
    //     `).forEach(link => {

    //       link.addEventListener("click", function(e) {

    //         const url = this.getAttribute("href");

    //         // Solo interceptamos si es ruta de auth
    //         if (
    //           url.includes("login") ||
    //           url.includes("register") ||
    //           url.includes("passwordRequest") ||
    //           url.includes("forgot")
    //         ) {
    //           e.preventDefault();
    //           abrirAuth(url);
    //         }

    //       });

    //     });

    // });

    /*******************************************************
     * MENÚ LATERAL PUSH (PACIENTE Y MÉDICO)
     *******************************************************/
    // document.addEventListener("DOMContentLoaded", () => {
    //     // const body = document.body;
    //     const menuBtn = document.querySelector(".main-header__menu");

    //     // const sidebarPaciente = qs("#sidebarPaciente");
    //     // const sidebarMedico = qs("#sidebarMedico");
    //     // const sidebar = sidebarPaciente || sidebarMedico;
    //     const sidebar = document.querySelector(".sidebar");

    //     // if (!menuBtn || !sidebar) return;

    //     // menuBtn.addEventListener("click", () => {
    //     //     body.classList.toggle("menu-open");
    //     // });
    //     menuBtn.addEvenetListener("click", () => {
    //         sidebar.style.display = "flex";
    //     });

    //     //ESTO ES NUEVO (PARA CERRAR EL MENU)
    //     const btnCerrarMenu = document.getElementById("btnCerrarMenu");

    //     btnCerrarMenu?.addEventListener("click", () => {
    //         body.classList.remove("menu-open");
    //     });

    //     qsa(".sidebar__item", sidebar).forEach((btn) => {
    //         btn.addEventListener("click", () => {
    //             if (btn.classList.contains("sidebar__item-action")) return;

    //             const view = btn.dataset.view;
    //             if (!view) return;

    //             qsa(".sidebar__item", sidebar).forEach((b) =>
    //                 b.classList.remove("active"),
    //             );
    //             btn.classList.add("active");

    //             const main = btn.closest("main") || document;

    //             main.querySelectorAll(".view").forEach((v) =>
    //                 v.classList.add("hidden"),
    //             );

    //             main.querySelector(`#view-${view}`)?.classList.remove("hidden");

    //             if (view === "perfil") {
    //                 cargarMiPerfil();
    //             }

    //             body.classList.remove("menu-open");
    //         });
    //     });

    //     qs(".sidebar__logout")?.addEventListener("click", () => {
    //         location.href = "index.html";
    //     });
    // });

    // 👇 funciones del perfil (fuera)

    // HACERLO EN ARCHIVO APARTE
    // document.addEventListener("DOMContentLoaded", () => {
    //     const menuBtn = document.querySelector(".main-header__icon-menu");
    //     const sidebar = document.querySelector(".sidebar");
    //     console.log(menuBtn, sidebar);
    //     menuBtn.addEventListener("click", () => {
    //         sidebar.style.display = "flex";
    //     });
    // });

    async function cargarMiPerfil() {
        try {
            const res = await fetch("backend/controllers/obtenerMiPerfil.php");
            const data = await res.json();

            if (!data.success) {
                alert(data.message || "No se pudo cargar el perfil");
                return;
            }

            inyectarPerfil(data.data);
        } catch (err) {
            console.error(err);
            alert("Error al cargar perfil");
        }
    }

    function inyectarPerfil(p) {
        document.getElementById("perfilNombre").textContent =
            p.nombre + " " + p.apellido;

        document.getElementById("perfilCedula").textContent = p.cedula;
        document.getElementById("perfilCorreo").textContent = p.correo;
        document.getElementById("perfilTelefono").textContent = p.telefono;
        document.getElementById("perfilDireccion").textContent = p.direccion;
        document.getElementById("perfilFechaNacimiento").textContent =
            p.fecha_nacimiento;
        document.getElementById("perfilEdad").textContent = p.edad ?? "—";
        document.getElementById("perfilSexo").textContent = p.sexo;
        document.getElementById("perfilEstadoCivil").textContent =
            p.estado_civil;
        document.getElementById("perfilFechaRegistro").textContent =
            p.fecha_registro;
        document.getElementById("perfilEstadoCuenta").textContent = p.estado;
        document.getElementById("perfilRolSistema").textContent = p.rol ?? "—";
        // Si el rol no viene, asumir paciente
        if (!p.rol) {
            document.getElementById("perfilRolSistema").textContent =
                "Paciente";
        }
        //mostrar los datos de arriba
        document.getElementById("perfilRol").textContent = p.rol ?? "—";
        document.getElementById("perfilEstado").textContent = p.estado;
    }

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
        if (
            !historyCards.length ||
            !modulesView ||
            !emptyView ||
            !listView ||
            !title
        )
            return;

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
            return (
                {
                    medicina: "Medicina General",
                    psiquiatria: "Psiquiatría",
                }[m] || "Módulo"
            );
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
            tipo === "psiquiatria" ? "Psiquiatría" : "Medicina General";

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
        modal.querySelectorAll("[data-next]").forEach((btn) => {
            btn.addEventListener("click", () => {
                page1.classList.remove("active");
                page2.classList.add("active");
            });
        });

        // Volver al frente
        modal.querySelectorAll("[data-prev]").forEach((btn) => {
            btn.addEventListener("click", () => {
                page2.classList.remove("active");
                page1.classList.add("active");
            });
        });

        // Cerrar historia
        modal.querySelectorAll(".btn-cerrar").forEach((btn) => {
            btn.addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        });
    }

    /*ESTO CONTROLA EL SELECT DEL REGISTRO*/
    // document.addEventListener("DOMContentLoaded", () => {
    //     /* ===== LOGIN CON FETCH (SIN RECARGA) ===== */
    //     const loginForm = document.querySelector("#loginForm");

    //     if (loginForm) {
    //         loginForm.addEventListener("submit", async (e) => {
    //             e.preventDefault();

    //             const loginError = document.getElementById("loginError");
    //             if (loginError) {
    //                 loginError.classList.add("oai-hidden");
    //             }

    //             const formData = new FormData(loginForm);
    //             console.log("Enviando login...");
    //             try {
    //                 const response = await fetch(
    //                     "backend/controllers/login.php",
    //                     {
    //                         method: "POST",
    //                         body: formData,
    //                     },
    //                 );
    //                 console.log("Respuesta recibida", response);
    //                 const data = await response.json();

    //                 if (!data.success) {
    //                     if (loginError) {
    //                         loginError.textContent = data.message;
    //                         loginError.classList.remove("oai-hidden");
    //                     }
    //                     return;
    //                 }

    //                 window.location.href = data.redirect;
    //             } catch (err) {
    //                 if (loginError) {
    //                     loginError.textContent =
    //                         "Error de conexión con el servidor";
    //                     loginError.classList.remove("oai-hidden");
    //                 }
    //             }
    //         });
    //     }

    //     /* ===== EL RESTO DE TU JS SIGUE NORMAL ===== */
    // });

    // ================================
    // OVERLAY CREAR MÉDICO (JEFE MÉDICO)
    // ================================
    document.addEventListener("DOMContentLoaded", () => {
        const btnAbrirCrearMedico = document.getElementById(
            "btnAbrirCrearMedico",
        );
        const crearMedicoOverlay =
            document.getElementById("crearMedicoOverlay");
        const btnCerrarCrearMedico = document.getElementById(
            "btnCerrarCrearMedico",
        );
        const btnCancelarCrearMedico = document.getElementById(
            "btnCancelarCrearMedico",
        );

        if (!btnAbrirCrearMedico || !crearMedicoOverlay) return;

        btnAbrirCrearMedico.addEventListener("click", (e) => {
            e.preventDefault();
            crearMedicoOverlay.classList.remove("oai-hidden");
        });

        function cerrarOverlay() {
            crearMedicoOverlay.classList.add("oai-hidden");
        }

        btnCerrarCrearMedico?.addEventListener("click", (e) => {
            e.preventDefault();
            cerrarOverlay();
        });

        btnCancelarCrearMedico?.addEventListener("click", (e) => {
            e.preventDefault();
            cerrarOverlay();
        });
    });

    //=======CERRAR OVERLAYS=======
    document
        .getElementById("btnCerrarCrearMedico")
        ?.addEventListener("click", () => {
            document
                .getElementById("crearMedicoOverlay")
                ?.classList.add("oai-hidden");
        });

    document.addEventListener("DOMContentLoaded", () => {
        document
            .getElementById("btnCerrarLogin")
            ?.addEventListener("click", () => {
                document
                    .getElementById("loginOverlay")
                    ?.classList.add("oai-hidden");
            });

        document
            .getElementById("btnCerrarRegistro")
            ?.addEventListener("click", () => {
                document
                    .getElementById("registroOverlay")
                    ?.classList.add("oai-hidden");
            });

        document
            .getElementById("btnCerrarRecuperar")
            ?.addEventListener("click", () => {
                document
                    .getElementById("recuperarOverlay")
                    ?.classList.add("oai-hidden");
            });

        document
            .getElementById("btnCerrarCodRecuperacion")
            ?.addEventListener("click", () => {
                document
                    .getElementById("codigoOverlay")
                    ?.classList.add("oai-hidden");
            });

        document
            .getElementById("btnCerrarNuevaClave")
            ?.addEventListener("click", () => {
                document
                    .getElementById("nuevaClaveOverlay")
                    ?.classList.add("oai-hidden");
            });
    });

    /* =======FORMULARIO PARA CREAR MEDICOS========= */
    const formCrearMedico = document.querySelector("#formCrearMedico");
    const msgCrearMedico = document.querySelector("#crearMedicoMsg");
    const overlayCrearMedico = document.querySelector("#crearMedicoOverlay");

    if (formCrearMedico) {
        formCrearMedico.addEventListener("submit", async (e) => {
            e.preventDefault(); // ⛔ clave

            msgCrearMedico.classList.add("oai-hidden");
            msgCrearMedico.classList.remove("error", "success");

            const formData = new FormData(formCrearMedico);

            try {
                const response = await fetch(
                    "backend/controllers/registrarMedico.php",
                    {
                        method: "POST",
                        body: formData,
                    },
                );

                const data = await response.json();

                if (!data.ok) {
                    msgCrearMedico.textContent =
                        data.mensaje || "Error al registrar médico";
                    msgCrearMedico.classList.add("error");
                    msgCrearMedico.classList.remove("oai-hidden");
                    return;
                }

                // ✅ Éxito
                msgCrearMedico.textContent =
                    "Especialista registrado correctamente";
                msgCrearMedico.classList.add("success");
                msgCrearMedico.classList.remove("oai-hidden");

                // limpiar form
                formCrearMedico.reset();

                // cerrar overlay luego de 1.5s
                setTimeout(() => {
                    overlayCrearMedico.classList.add("oai-hidden");
                    msgCrearMedico.classList.add("oai-hidden");
                }, 1500);
            } catch (err) {
                msgCrearMedico.textContent =
                    "Error de conexión con el servidor";
                msgCrearMedico.classList.add("error");
                msgCrearMedico.classList.remove("oai-hidden");
                console.error(err);
            }
        });
    }

    /* ========REGISTRAR PACIENTE (REAL)========
   - Mantiene tu overlay de registro
   - Evita que el navegador bloquee el submit por campos ocultos (estudiante/personal)
   - Llama al backend real: backend/controllers/registrarPaciente.php
*/

    // document.addEventListener("DOMContentLoaded", () => {
    //   const registroOverlay = document.getElementById("registroOverlay");
    //   const formPaciente = document.querySelector("#formRegistroPaciente");

    //   // Si no estamos en index o no existe el form, salir sin romper nada
    //   if (!registroOverlay || !formPaciente) return;

    //   const tipoPaciente = document.getElementById("tipoPaciente");
    //   const selectCarrera = document.getElementById("selectCarrera");
    //   const selectPersonal = document.getElementById("selectPersonal");

    //   // Desactiva validación nativa (porque un select hidden + required bloquea el submit ANTES del JS)
    //   formPaciente.noValidate = true;

    //   function resetSelects() {
    //     if (selectCarrera) {
    //       selectCarrera.classList.add("hidden");
    //       selectCarrera.required = false;
    //       selectCarrera.value = "";
    //       selectCarrera.classList.remove("active");
    //     }
    //     if (selectPersonal) {
    //       selectPersonal.classList.add("hidden");
    //       selectPersonal.required = false;
    //       selectPersonal.value = "";
    //       selectPersonal.classList.remove("active");
    //     }
    //   }

    //   // Estado inicial (por si el overlay se abre con valores previos)
    //   resetSelects();

    //   // Mostrar/ocultar según tipo (esto reemplaza la lógica anterior)
    //   tipoPaciente?.addEventListener("change", () => {
    //     resetSelects();

    //     const value = tipoPaciente.value;

    //     if (value === "estudiante" && selectCarrera) {
    //       selectCarrera.classList.remove("hidden");
    //       selectCarrera.required = true;
    //     }

    //     if (value === "personal" && selectPersonal) {
    //       selectPersonal.classList.remove("hidden");
    //       selectPersonal.required = true;
    //     }
    //   });

    //   // Submit real
    //   formPaciente.addEventListener("submit", async (e) => {
    //     e.preventDefault();
    //     e.stopPropagation();

    //     // Validación mínima manual para los campos condicionales
    //     const tipo = (tipoPaciente?.value || "").trim();

    //     if (!tipo) {
    //       alert("Seleccione el tipo de paciente");
    //       return;
    //     }

    //     if (tipo === "estudiante" && selectCarrera && !selectCarrera.value) {
    //       alert("Seleccione la carrera");
    //       return;
    //     }

    //     if (tipo === "personal" && selectPersonal && !selectPersonal.value) {
    //       alert("Seleccione el tipo de personal");
    //       return;
    //     }

    //     const formData = new FormData(formPaciente);

    //     try {
    //       const res = await fetch("backend/controllers/registrarPaciente.php", {
    //         method: "POST",
    //         body: formData
    //       });

    //       // Leemos texto primero por si el PHP imprime algo extra
    //       const text = await res.text();
    //       let data;

    //       try {
    //         data = JSON.parse(text);
    //       } catch {
    //         console.error("Respuesta NO JSON en registrarPaciente.php:", text);
    //         alert("Error: el servidor no devolvió JSON válido.");
    //         return;
    //       }

    //       if (!data.success) {
    //         mostrarMensajeRegistroPaciente(data.message || "Error al registrar", "error");
    //         return;
    //       }

    //       // ✅ ÉXITO
    //       cedulaRegistroPaciente = formPaciente.querySelector('[name="cedula"]').value;

    //       mostrarMensajeRegistroPaciente(
    //         "Registro exitoso. Ahora establezca su contraseña.",
    //         "success"
    //       );

    //       // Esperar un momento y pasar a nueva contraseña
    //       setTimeout(() => {
    //         registroOverlay.classList.add("oai-hidden");
    //         document.getElementById("nuevaClaveOverlay")?.classList.remove("oai-hidden");
    //       }, 1200);

    //     } catch (err) {
    //       console.error(err);
    //       alert("Error de conexión");
    //     }
    //   });
    // });

    /* ===== SELECTS CON PLACEHOLDER GRIS / TEXTO NEGRO ===== */
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll("select").forEach((select) => {
            select.addEventListener("change", () => {
                if (select.value) {
                    select.classList.add("active");
                } else {
                    select.classList.remove("active");
                }
            });
        });
    });

    /* ========= MOSTRAR MENSAJES EN EL REGISTRO (PACIENTE)=============*/
    function mostrarMensajeRegistroPaciente(texto, tipo) {
        let msg = document.getElementById("registroPacienteMsg");

        if (!msg) return;

        msg.textContent = texto;
        msg.classList.remove("oai-hidden", "error", "success");
        msg.classList.add(tipo);
    }
    /* ================================================
ESTO ES PARA LA RECUPERACION DE CONTRASEÑA
===================================================*/

    /*******************************************************
     * PASO 2 — CREAR USUARIO (NUEVA CONTRASEÑA)
     * Usa submit REAL (type="submit")
     *******************************************************/
    document.addEventListener("DOMContentLoaded", () => {
        const nuevaClaveOverlay = document.getElementById("nuevaClaveOverlay");
        const formNuevaClave = document.getElementById("formNuevaClave");

        if (!nuevaClaveOverlay || !formNuevaClave) return;

        // Contenedor de mensaje (se crea si no existe)
        let nuevaClaveMsg = document.getElementById("nuevaClaveMsg");
        if (!nuevaClaveMsg) {
            nuevaClaveMsg = document.createElement("div");
            nuevaClaveMsg.id = "nuevaClaveMsg";
            nuevaClaveMsg.className = "form-msg oai-hidden";
            formNuevaClave.appendChild(nuevaClaveMsg);
        }

        function mostrarMsg(texto, tipo) {
            nuevaClaveMsg.textContent = texto;
            nuevaClaveMsg.classList.remove("oai-hidden", "error", "success");
            nuevaClaveMsg.classList.add(tipo);
        }

        function ocultarMsg() {
            nuevaClaveMsg.classList.add("oai-hidden");
            nuevaClaveMsg.classList.remove("error", "success");
        }
        //  resetear clave revisar
        //     formNuevaClave.addEventListener("submit", async (e) => {
        //         e.preventDefault();
        //         e.stopPropagation();
        //         ocultarMsg();

        //         // La cédula viene del PASO 1
        //         if (!cedulaRegistroPaciente) {
        //             mostrarMsg("Error interno: no se encontró la cédula.", "error");
        //             return;
        //         }

        //         const pass1 = document.getElementById("newPass")?.value || "";
        //         const pass2 = document.getElementById("confirmPass")?.value || "";

        //         if (!pass1 || !pass2) {
        //             mostrarMsg("Debe completar ambos campos.", "error");
        //             return;
        //         }

        //         if (pass1 !== pass2) {
        //             mostrarMsg("Las contraseñas no coinciden.", "error");
        //             return;
        //         }

        //         const formData = new FormData();
        //         formData.append("cedula", cedulaRegistroPaciente);
        //         formData.append("clave", pass1);

        //         try {
        //             const response = await fetch(
        //                 "backend/controllers/crearPasswordPaciente.php",
        //                 {
        //                     method: "POST",
        //                     body: formData,
        //                 },
        //             );

        //             const text = await response.text();
        //             let data;
        //             try {
        //                 data = JSON.parse(text);
        //             } catch {
        //                 console.error("Respuesta no JSON:", text);
        //                 mostrarMsg("Error del servidor.", "error");
        //                 return;
        //             }

        //             if (!data.success) {
        //                 mostrarMsg(
        //                     data.message || "No se pudo crear la contraseña.",
        //                     "error",
        //                 );
        //                 return;
        //             }

        //             // ✅ ÉXITO
        //             mostrarMsg("Contraseña creada correctamente.", "success");

        //             // Limpiar estado
        //             cedulaRegistroPaciente = null;
        //             formNuevaClave.reset();

        //             // Pasar al login
        //             setTimeout(() => {
        //                 nuevaClaveOverlay.classList.add("oai-hidden");
        //                 document
        //                     .getElementById("loginOverlay")
        //                     ?.classList.remove("oai-hidden");
        //             }, 1000);
        //         } catch (err) {
        //             console.error(err);
        //             mostrarMsg("Error de conexión con el servidor.", "error");
        //         }
        //     });
        // });

        document.addEventListener("DOMContentLoaded", () => {
            const formEmail = document.getElementById("formRecuperarEmail");
            const formCodigo = document.getElementById("formRecuperarCodigo");
            const paso1 = document.getElementById("recuperarPaso1");
            const paso2 = document.getElementById("recuperarPaso2");

            const contadorEl = document.getElementById("contadorTiempo");
            const btnReenviar = document.getElementById("btnReenviar");

            let tiempo = 120;
            let intervalo = null;

            function iniciarContador() {
                tiempo = 120;
                contadorEl.textContent = tiempo;
                btnReenviar.disabled = true;

                intervalo = setInterval(() => {
                    tiempo--;
                    contadorEl.textContent = tiempo;

                    if (tiempo <= 0) {
                        clearInterval(intervalo);
                        btnReenviar.disabled = false;
                        contadorEl.textContent = 0;
                    }
                }, 1000);
            }

            formEmail?.addEventListener("submit", (e) => {
                e.preventDefault();

                // Simular envío de correo
                paso1.classList.add("oai-hidden");
                paso2.classList.remove("oai-hidden");

                iniciarContador();
            });

            btnReenviar?.addEventListener("click", () => {
                iniciarContador();
                console.log("Reenviar código...");
            });
        });
    });
});


/*******************************************************
 * RECUPERACIÓN DE CONTRASEÑA (CONTADOR FRONTEND)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
  const countdownEl = document.getElementById("reenvioCountdown");
  const countdownBtnEl = document.getElementById("reenvioCountdownBtn");
  const btnReenviar = document.getElementById("btnReenviar");
  const form = document.getElementById("formRecuperarEmail");
  if (!countdownEl || !countdownBtnEl || !btnReenviar || !form) return;

  let seconds = 120;
  btnReenviar.disabled = true;

  const tick = () => {
    countdownEl.textContent = String(seconds);
    countdownBtnEl.textContent = String(seconds);
    if (seconds <= 0) {
      btnReenviar.disabled = false;
      btnReenviar.textContent = "Reenviar correo";
      return;
    }
    seconds -= 1;
    setTimeout(tick, 1000);
  };
  tick();

  btnReenviar.addEventListener("click", () => {
    // Solo UI: reenviar = reenviar submit
    seconds = 120;
    btnReenviar.disabled = true;
    btnReenviar.innerHTML = 'Reenviar correo (<span id="reenvioCountdownBtn">120</span>s)';
    // re-bind countdownBtnEl reference
    const newCountdownBtn = document.getElementById("reenvioCountdownBtn");
    if (newCountdownBtn) {
      // update variable in closure by reading from DOM each tick
    }
    form.requestSubmit();
    setTimeout(() => {
      const el = document.getElementById("reenvioCountdownBtn");
      if (el) el.textContent = "120";
    }, 0);
    // start ticking again
    const tick2 = () => {
      const el1 = document.getElementById("reenvioCountdown");
      const el2 = document.getElementById("reenvioCountdownBtn");
      if (!el1 || !el2) return;
      el1.textContent = String(seconds);
      el2.textContent = String(seconds);
      if (seconds <= 0) {
        btnReenviar.disabled = false;
        btnReenviar.textContent = "Reenviar correo";
        return;
      }
      seconds -= 1;
      setTimeout(tick2, 1000);
    };
    tick2();
  });
});

//=========================================================================
//ESTO ES NEUEVO
//=========================================================================

(function () {
  "use strict";

  function qs(sel, root = document) { return root.querySelector(sel); }
  function qsa(sel, root = document) { return Array.from(root.querySelectorAll(sel)); }

  function setActiveButton(btn) {
    const nav = btn.closest("nav");
    if (!nav) return;
    qsa(".nav-btn", nav).forEach(b => b.classList.remove("active"));
    btn.classList.add("active");
  }

  function showView(container, viewName) {
    const views = qsa(".view", container);
    views.forEach(v => v.classList.add("hidden"));
    const target = qs(`#view-${viewName}`, container);
    if (target) target.classList.remove("hidden");
  }

  function initSidebarNavigation() {
    const sidebars = qsa(".sidebar");

    sidebars.forEach(sidebar => {
      const containerId = sidebar.id === "sidebarJefeMedico" ? "viewsJefeMedico" : "viewsMedico";
      const container = qs(`#${containerId}`);
      if (!container) return;

      qsa("[data-view]", sidebar).forEach(btn => {
        btn.addEventListener("click", () => {
          const view = btn.getAttribute("data-view");
          setActiveButton(btn);

          // Registrar Familiar: mostrar overlay si existe
          if (view === "solicitar") {
            const overlay = qs("#crearFamiliarOverlay", container) || qs("#crearFamiliarOverlay");
            if (overlay) {
              overlay.classList.remove("hidden");
              // Si el overlay vive dentro de una vista, también podrías mostrar esa vista aquí.
            }
            return;
          }

          // Normal
          showView(container, view);
        });
      });
    });
  }

  function startReportsCountdown() {
    const el = qs("#reportsCountdown");
    if (!el) return;

    function nextMonthStart(now) {
      const y = now.getFullYear();
      const m = now.getMonth(); // 0-11
      return new Date(y, m + 1, 1, 0, 0, 0);
    }

    function pad(n) { return String(n).padStart(2, "0"); }

    function tick() {
      const now = new Date();
      const target = nextMonthStart(now);
      const diff = target.getTime() - now.getTime();

      if (diff <= 0) {
        el.textContent = "00:00:00";
        return;
      }

      const totalSeconds = Math.floor(diff / 1000);
      const hours = Math.floor((totalSeconds % (60 * 60 * 24)) / 3600);
      const minutes = Math.floor((totalSeconds % 3600) / 60);
      const seconds = totalSeconds % 60;

      // Si quieres días, lo agregas, pero por ahora HH:MM:SS es suficiente
      el.textContent = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
    }

    tick();
    setInterval(tick, 1000);
  }

  function monthName(m) {
    const names = [
      "ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO",
      "JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"
    ];
    const idx = Number(m) - 1;
    return names[idx] || "MES";
  }

  function openPrintableReportTemplate({ mes, anio }) {
    // Basado en el formato institucional del Word, pero SIN datos.
    // Solo estructura + placeholders.
    const MES = mes ? monthName(mes) : "MES";
    const ANIO = anio ? String(anio) : "AÑO";

    const html = `<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Informe Mensual - ${MES} ${ANIO}</title>
  <style>
    body{font-family: Arial, sans-serif; color:#111; margin:24px;}
    .center{text-align:center;}
    .muted{color:#555;}
    h1,h2,h3{margin:10px 0;}
    .hr{height:1px; background:#ddd; margin:18px 0;}
    table{width:100%; border-collapse:collapse; margin:12px 0;}
    th,td{border:1px solid #999; padding:8px; font-size:12px;}
    th{background:#f3f4f6;}
    .sig{margin-top:28px;}
    .sig .line{margin-top:50px; border-top:1px solid #111; width:320px;}
    .block{margin:14px 0;}
  </style>
</head>
<body>

  <div class="block">
    <p><b>Para:</b> Profesora Claudia De Andrade</p>
    <p>Jefa de Departamento de Desarrollo y Bienestar Estudiantil</p>
    <p><b>De:</b> Dra. Yuderkys Torres</p>
    <p>Jefa del Servicio Médico</p>
    <div class="hr"></div>
    <p class="muted">
      (Este documento es una plantilla. Los datos serán inyectados por el backend.)
    </p>
  </div>

  <div class="center">
    <h2>INFORME MENSUAL DE ACTIVIDADES ASISTENCIALES DEL SERVICIO MÉDICO</h2>
    <h3>UNETRANS - Dr. Federico Rivero Palacio</h3>
    <h3>${MES} ${ANIO}</h3>
  </div>

  <div class="block">
    <p>
      El presente resumen informativo se emite a partir de la prestación del servicio de un equipo multidisciplinario...
      <span class="muted">(texto completo puede mantenerse aquí o lo puede inyectar backend)</span>
    </p>
  </div>

  <div class="block">
    <h3>PACIENTES (Distribución)</h3>
    <table>
      <thead>
        <tr>
          <th>ESTUDIANTE</th>
          <th>PERSONAL ADMINISTRATIVO</th>
          <th>PERSONAL OBRERO</th>
          <th>DOCENTE</th>
          <th>PRE-ESCOLAR</th>
          <th>VISITANTE</th>
          <th>TOTAL PACIENTES</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ estudiantes }}</td>
          <td>{{ administrativo }}</td>
          <td>{{ obrero }}</td>
          <td>{{ docente }}</td>
          <td>{{ preescolar }}</td>
          <td>{{ visitante }}</td>
          <td>{{ total_pacientes }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="block">
    <h3>MEDICINA GENERAL</h3>
    <table>
      <thead>
        <tr>
          <th>TOTAL DE CONSULTAS REALIZADAS</th>
          <th>CONTROL DE NIÑOS SANOS</th>
          <th>CONSULTA PARTO HUMANIZADO</th>
          <th>PLANIFICACIÓN FAMILIAR / PESQUISA</th>
          <th>PACIENTES DE APOYO VITAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ total_consultas_mg }}</td>
          <td>{{ control_ninos }}</td>
          <td>{{ parto_humanizado }}</td>
          <td>{{ planificacion }}</td>
          <td>{{ apoyo_vital }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="block">
    <h3>ACTIVIDADES REALIZADAS POR ENFERMERÍA</h3>
    <table>
      <thead>
        <tr>
          <th>TOTAL ACTIVIDADES</th>
          <th>CURAS</th>
          <th>TRATAMIENTOS</th>
          <th>NEBULIZACIONES</th>
          <th>CONTROL GLICEMIA CAPILAR</th>
          <th>CONTROL TENSIÓN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ total_enfermeria }}</td>
          <td>{{ curas }}</td>
          <td>{{ tratamientos }}</td>
          <td>{{ nebulizaciones }}</td>
          <td>{{ glicemia }}</td>
          <td>{{ tension }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="block">
    <h3>ESPECIALIDADES</h3>
    <table>
      <thead>
        <tr>
          <th>TRAUMATOLOGÍA</th>
          <th>PSIQUIATRÍA</th>
          <th>FISIATRÍA</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ total_trauma }}</td>
          <td>{{ total_psiq }}</td>
          <td>{{ total_fisiatria }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="sig">
    <div class="line"></div>
    <p><b>Dra. Yuderkys Torres</b><br>Jefa del Servicio Médico</p>
  </div>

  <script>
    // Si quieres imprimir automático, descomenta:
    // window.onload = () => window.print();
  </script>
</body>
</html>`;

    const w = window.open("", "_blank");
    if (!w) {
      alert("El navegador bloqueó la ventana emergente. Permite pop-ups para descargar el reporte.");
      return;
    }
    w.document.open();
    w.document.write(html);
    w.document.close();
  }

  function initReportTemplateButton() {
    const btn = qs('[data-action="download-report-template"]');
    if (!btn) return;

    btn.addEventListener("click", () => {
      openPrintableReportTemplate({
        mes: btn.getAttribute("data-mes"),
        anio: btn.getAttribute("data-anio"),
      });
    });
  }

  function initUIActions() {
    // Botones genéricos
    qsa('[data-action="back"]').forEach(b => {
      b.addEventListener("click", () => history.back());
    });

    const openConsulta = qs('[data-action="open-consulta-form"]');
    const closeConsulta = qs('[data-action="close-consulta-form"]');
    const wrapConsulta = qs("#consultaFormWrap");
    if (openConsulta && wrapConsulta) {
      openConsulta.addEventListener("click", () => wrapConsulta.classList.remove("hidden"));
    }
    if (closeConsulta && wrapConsulta) {
      closeConsulta.addEventListener("click", () => wrapConsulta.classList.add("hidden"));
    }

    const openHistoria = qs('[data-action="open-historia-form"]');
    const closeHistoria = qs('[data-action="close-historia-form"]');
    const wrapHistoria = qs("#historiaFormWrap");
    if (openHistoria && wrapHistoria) {
      openHistoria.addEventListener("click", () => wrapHistoria.classList.remove("hidden"));
    }
    if (closeHistoria && wrapHistoria) {
      closeHistoria.addEventListener("click", () => wrapHistoria.classList.add("hidden"));
    }
  }

  document.addEventListener("DOMContentLoaded", () => {
    initSidebarNavigation();
    startReportsCountdown();
    initReportTemplateButton();
    initUIActions();
  });

})();