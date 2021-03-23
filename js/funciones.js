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