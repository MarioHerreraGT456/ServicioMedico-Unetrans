function handleFotos() {
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById("foto-upload");
        if (!container) return;

        const input = container.querySelector("#foto");
        const preview = container.querySelector("#preview");

        // 🚨 Bloquear comportamiento por defecto (abrir imagen en otra pestaña)
        document.addEventListener("dragover", (e) => e.preventDefault());
        document.addEventListener("drop", (e) => e.preventDefault());

        // 👉 CLICK (móvil)
        container.addEventListener("click", () => {
            input.click();
        });

        input.addEventListener("change", () => {
            processFiles(Array.from(input.files));
        });

        // 👉 DRAG & DROP (desktop)
        container.addEventListener("dragover", (e) => {
            e.preventDefault();
            container.classList.add("dragging");
        });

        container.addEventListener("dragleave", () => {
            container.classList.remove("dragging");
        });

        container.addEventListener("drop", (e) => {
            e.preventDefault();
            container.classList.remove("dragging");

            const files = Array.from(e.dataTransfer.files);
            processFiles(files);
        });

        function processFiles(files) {
            let currentImages = preview.querySelectorAll("img").length;

            if (currentImages + files.length > 5) {
                alert("Máximo 5 fotos");
                files = files.slice(0, 5 - currentImages);
            }

            const dataTransfer = new DataTransfer();

            // Mantener las imágenes ya seleccionadas
            Array.from(input.files).forEach((file) => {
                dataTransfer.items.add(file);
            });

            files.forEach((file) => {
                if (!file.type.startsWith("image/")) return;

                dataTransfer.items.add(file);

                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });

            input.files = dataTransfer.files;
        }
    });
}

// 🚀 Se ejecuta automáticamente
handleFotos();
