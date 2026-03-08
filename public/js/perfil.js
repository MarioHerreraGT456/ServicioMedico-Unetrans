//tengo que identar esto correctamente
function editarCampo(id){

let input = document.getElementById(id);

input.removeAttribute("readonly");
input.focus();

input.addEventListener("keypress", function(e){

if(e.key === "Enter"){

e.preventDefault();

Swal.fire({
title: "¿Guardar cambios?",
text: "Se actualizará la información del perfil",
icon: "question",
showCancelButton: true,
confirmButtonText: "Guardar",
cancelButtonText: "Cancelar"

}).then((result)=>{

if(result.isConfirmed){
guardarContacto();
}else{
location.reload();
}

});

}

});

}

function guardarContacto(){

    fetch(window.perfilUpdateUrl,{

    method:"POST",

    headers:{
    'Content-Type':'application/json',
    'X-CSRF-TOKEN': window.csrfToken
    },

    body:JSON.stringify({

    correo: document.getElementById("perfilCorreo").value,
    telefono: document.getElementById("perfilTelefono").value,
    direccion: document.getElementById("perfilDireccion").value

    })

    })

    .then(res=>res.json())
    .then(data=>{

    if(data.success){

    Swal.fire("Actualizado","Datos guardados correctamente","success")
    .then(()=> location.reload());

    }else{

    Swal.fire("Error",data.message,"error");

    }
});

}
