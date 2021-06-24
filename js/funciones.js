// let asideBotones = document.getElementsByClassName("asideButton")

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

function desmarcarProducto(){
    let inputs = document.getElementsByTagName("input");
    for (let item of inputs) {
        if(item.parentNode.classList.contains("productoSeleccionado") == true){
            item.parentNode.classList.remove("productoSeleccionado");
        }
    } 
}

function marcarProducto(){
    let focusedElement = document.activeElement;
    let inputs = document.getElementsByTagName("input");
    
    for (let item of inputs) {
        if(item.parentNode.classList.contains("productoSeleccionado") == true){
            item.parentNode.classList.remove("productoSeleccionado");
        }
    } 

    focusedElement.parentNode.previousElementSibling.classList.add("productoSeleccionado");
   
}
//FUNCIONES PARA MOSTRAR/OCULTAR CONFIRMACION DE PEDIDO
function mostrarConfirmarPedido(){
    
    let confirmarPedido = document.getElementById("confirmacionPedido");
    let avisoPedidoVacio = document.getElementById("avisoPedidoVacio");
    let camposCantidad = document.querySelectorAll(".cantidadProducto");
    let campoOtros = document.getElementById("textareaOtros");
    let campos = Array.from(camposCantidad);
    if(campos.find(element => element.value !=0) || (campoOtros.value != "")){
        confirmarPedido.classList.remove("hidden");
        return;
    }else{
        avisoPedidoVacio.classList.remove("hidden");
    }
}
function ocultarConfirmarPedido(){
    let confirmarPedido = document.getElementById("confirmacionPedido");
    confirmarPedido.classList.add("hidden");
}
function ocultarPedidoVacio(){
    let avisoPedidoVacio = document.getElementById("avisoPedidoVacio");
    avisoPedidoVacio.classList.add("hidden");

}




function activarBurguer(){
    let aside = document.getElementById("asideBox");
    let main = document.getElementById("mainBox");

    if(aside.classList.contains("asideHidden") == false){
        aside.classList.add("asideHidden");
        main.classList.remove("mainHidden");
    }else{
        aside.classList.remove("asideHidden");
        main.classList.add("mainHidden");
    }

}

function mostrarSpinner(){
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
