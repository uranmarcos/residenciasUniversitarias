let asideBotones = document.getElementsByClassName("asideButton")

// quito clase botones aside
function quitarClase(selector, clase){
    let asideBotones = document.getElementsByClassName(selector)
    
    for (let item of asideBotones) {
        if(item.classList.contains(clase)){
            item.classList.remove(clase)
        }
    } 
}

//asigno clase" boton remarcado" al boton aside seleccionado
function activarBoton(param, param2){
    quitarClase("asideButton", "botonRemarcado")

    let botonSeleccionado = document.getElementById(param)
    botonSeleccionado.classList.add("botonRemarcado")
    mostrarSection(param2)
}


let cajasSecciones = document.getElementsByClassName("opcionSection")

function mostrarSection(param){
    for (let item of cajasSecciones) {
        if(item.classList.contains("hidden") == false){
            item.classList.add("hidden")
        }
    } 
    let opcionSeleccionada = document.getElementById(param)
    opcionSeleccionada.classList.remove("hidden")

}


let cajaAlimentos = document.getElementById("cajaAlimentos")
let textoAlimentos = "+"
let navAlimentos = document.getElementById("navAlimentos")

navAlimentos.innerHTML = textoAlimentos

function mostrarAlimentos(){
    if(textoAlimentos == "+"){
        textoAlimentos = "-"
        navAlimentos.innerHTML = textoAlimentos
        cajaAlimentos.classList.remove("hidden")
    } else{
        textoAlimentos = "+"
        navAlimentos.innerHTML = textoAlimentos
        cajaAlimentos.classList.add("hidden")
    }
}

let cajaLimpieza = document.getElementById("cajaLimpieza")
let textoLimpieza = "+"
let navLimpieza = document.getElementById("navLimpieza")

navLimpieza.innerHTML = textoLimpieza

function mostrarLimpieza(){
    if(textoLimpieza == "+"){
        textoLimpieza = "-"
        navLimpieza.innerHTML = textoLimpieza
        cajaLimpieza.classList.remove("hidden")
    } else{
        textoLimpieza = "+"
        navLimpieza.innerHTML = textoLimpieza
        cajaLimpieza.classList.add("hidden")
    }
}

let cajaOtros = document.getElementById("cajaOtros")
let textoOtros = "+"
let navOtros = document.getElementById("navOtros")

navOtros.innerHTML = textoOtros

function mostrarOtros(){
    if(textoOtros == "+"){
        textoOtros = "-"
        navOtros.innerHTML = textoOtros
        cajaOtros.classList.remove("hidden")
    } else{
        textoOtros = "+"
        navOtros.innerHTML = textoOtros
        cajaOtros.classList.add("hidden")
    }
}