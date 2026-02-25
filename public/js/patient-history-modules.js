/*******************************************************
 * HISTORIAS CLÍNICAS – PACIENTE (POR MÓDULO)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    const historyCards = qsa(".history-card");
    const modulesView = qs("#histories-modules");
    const emptyView = qs("#histories-empty");
    const listView = qs("#histories-list");
    const title = qs("#histories-module-title");

    // Si no existen los contenedores, salir sin ejecutar
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
