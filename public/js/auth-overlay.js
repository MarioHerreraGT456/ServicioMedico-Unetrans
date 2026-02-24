/*******************************************************
 * AUTH DINÁMICO (OVERLAYS)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("authOverlayContainer");
    if (!container) return;

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

    // (Opcional) Interceptar enlaces de autenticación si se descomenta
    /*
    document.querySelectorAll(`
        a[href*='login'],
        a[href*='register'],
        a[href*='passwordRequest'],
        a[href*='forgot']
    `).forEach(link => {
        link.addEventListener("click", function(e) {
            const url = this.getAttribute("href");
            if (url.includes("login") || url.includes("register") ||
                url.includes("passwordRequest") || url.includes("forgot")) {
                e.preventDefault();
                abrirAuth(url);
            }
        });
    });
    */
});
