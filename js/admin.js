let cajaAdminArticulos = document.getElementById("adminArticulos")
let textoAdminArticulos = "+"
let navAdminArticulos = document.getElementById("navAdminArticulos")
navAdminArticulos.innerHTML = textoAdminArticulos
function mostrarAdminArticulos(){
    if(textoAdminArticulos == "+"){
        textoAdminArticulos = "-"
        navAdminArticulos.innerHTML = textoAdminArticulos
        cajaAdminArticulos.classList.remove("hidden")
    } else{
        textoAdminArticulos = "+"
        navAdminArticulos.innerHTML = textoAdminArticulos
        cajaAdminArticulos.classList.add("hidden")
    }
}

