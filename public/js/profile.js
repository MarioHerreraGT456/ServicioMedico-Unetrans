/*******************************************************
 * PERFIL DE USUARIO (CARGA Y MUESTRA)
 *******************************************************/
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
    document.getElementById("perfilEstadoCivil").textContent = p.estado_civil;
    document.getElementById("perfilFechaRegistro").textContent =
        p.fecha_registro;
    document.getElementById("perfilEstadoCuenta").textContent = p.estado;
    document.getElementById("perfilRolSistema").textContent =
        p.rol ?? "Paciente";
    document.getElementById("perfilRol").textContent = p.rol ?? "—";
    document.getElementById("perfilEstado").textContent = p.estado;
}
