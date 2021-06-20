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
function activarBoton(param){
    quitarClase("asideButton", "botonRemarcado")

    let botonSeleccionado = document.getElementById(param)
    botonSeleccionado.classList.add("botonRemarcado")
}

//FUNCIONES PARA MOSTRAR/OCULTAR CONFIRMACION DE PEDIDO
let confirmarPedido = document.getElementById("confirmacionPedido")
function mostrarConfirmarPedido(){
    confirmarPedido.classList.remove("hidden")
}
function ocultarConfirmarPedido(){
    confirmarPedido.classList.add("hidden")
}

function mostrarSpinner(){
    console.log("a");
    let cajaConfirmarPedido = document.getElementById("cajaConfirmarPedido");
    cajaConfirmarPedido.classList.add("hidden");
    let spinner = document.getElementById("spinner");
    spinner.classList.remove("hidden")
}






// let cajasSecciones = document.getElementsByClassName("opcionSection")

// function mostrarSection(param){
//     for (let item of cajasSecciones) {
//         if(item.classList.contains("hidden") == false){
//             item.classList.add("hidden")
//         }
//     } 
//     let opcionSeleccionada = document.getElementById(param)
//     opcionSeleccionada.classList.remove("hidden")

// }

//FUNCIONES CAJA ALIMENTOS
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

//FUNCIONES CAJA MERIENDA
let cajaMeriendas = document.getElementById("cajaMeriendas")
let textoMeriendas = "+"
let navMeriendas = document.getElementById("navMeriendas")

navMeriendas.innerHTML = textoMeriendas
function mostrarMeriendas(){
    if(textoMeriendas == "+"){
        textoMeriendas = "-"
        navMeriendas.innerHTML = textoMeriendas
        cajaMeriendas.classList.remove("hidden")
    } else{
        textoMeriendas = "+"
        navMeriendas.innerHTML = textoMeriendas
        cajaMeriendas.classList.add("hidden")
    }
}

//FUNCIONES CAJA USO PERSONAL
let cajaUsoPersonal = document.getElementById("cajaUsoPersonal")
let textoUsoPersonal = "+"
let navUsoPersonal = document.getElementById("navUsoPersonal")

navUsoPersonal.innerHTML = textoUsoPersonal
function mostrarUsoPersonal(){
    if(textoUsoPersonal == "+"){
        textoUsoPersonal = "-"
        navUsoPersonal.innerHTML = textoUsoPersonal
        cajaUsoPersonal.classList.remove("hidden")
    } else{
        textoUsoPersonal = "+"
        navUsoPersonal.innerHTML = textoUsoPersonal
        cajaUsoPersonal.classList.add("hidden")
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
