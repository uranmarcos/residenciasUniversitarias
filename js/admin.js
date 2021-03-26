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


let cajaAdminUsuarios = document.getElementById("adminUsuarios")
let textoAdminUsuarios = "+"
let navAdminUsuarios = document.getElementById("navAdminUsuarios")
navAdminUsuarios.innerHTML = textoAdminUsuarios
function mostrarAdminUsuarios(){
    if(textoAdminUsuarios == "+"){
        textoAdminUsuarios = "-"
        navAdminUsuarios.innerHTML = textoAdminUsuarios
        cajaAdminUsuarios.classList.remove("hidden")
    } else{
        textoAdminUsuarios = "+"
        navAdminUsuarios.innerHTML = textoAdminUsuarios
        cajaAdminUsuarios.classList.add("hidden")
    }
}
