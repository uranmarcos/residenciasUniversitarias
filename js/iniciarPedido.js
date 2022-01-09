window.onload = function(){
    document.getElementById("buscadorProducto").value = localStorage.getItem("buscadorProducto");
    document.getElementById("selectCategoria").value = localStorage.getItem("selectCategoria");
    filtrar()
};
// INICIO COLUMNA CATEGORIA RESPONSIVE
window.addEventListener("resize", function(){
    let ancho =  window.innerWidth
    ajustarColumnaCategoria (ancho)
});
function guardarFiltro(param){
    let input = document.getElementById(param);
    let valor = input.value;
    localStorage.setItem(param, valor);
}
let ancho =  window.innerWidth
let thCategoria = document.getElementsByName("thCategoria")
let tdCategoria = document.getElementsByName("tdCategoria")
ajustarColumnaCategoria (ancho)
function ajustarColumnaCategoria (ancho) {
    if(ancho < 767){
        for (th of thCategoria){
            th.classList.add("hide")
        }
        for (td of tdCategoria){
            td.classList.add("hide")
        }
    } else{
        for (th of thCategoria){
            th.classList.remove("hide")
        }
        for (td of tdCategoria){
            td.classList.remove("hide")
        }
    }
}
// FIN COLUMNA CATEGORIA RESPONSIVE
cargarPedido();
function filtrar() {
    let producto = document.getElementById("buscadorProducto").value;
    let boxBotonFiltro = document.getElementById("boxBotonFiltro");
    let categoria = document.getElementById("selectCategoria").value;
    if(producto.trim() != "" && categoria != "todos"){
        filtrarFilas(producto.toLowerCase(), categoria)
        boxBotonFiltro.classList.remove("hide")
    } else if(producto.trim() != "" && categoria == "todos") {
        filtrarFilasPorParametro("producto", producto.toLowerCase())
        boxBotonFiltro.classList.remove("hide")
    }  else if(producto.trim() == "" && categoria != "todos") {
        filtrarFilasPorParametro("categoria", categoria.toLowerCase())
        boxBotonFiltro.classList.remove("hide")
    } else {
        quitarFiltros()
        boxBotonFiltro.classList.add("hide")
    }
}
function quitarFiltros(){
    resetFiltros()
    let listaFilas = document.getElementsByName("rowTable");
    listaFilas = Array.from(listaFilas)
    listaFilas.forEach(function callback(value, index) {
        value.classList.remove("hide")
    })
}
function filtrarFilas(param1, param2){
    let listaFilas = document.getElementsByName("rowTable");
    listaFilas = Array.from(listaFilas)
    listaFilas.forEach(function callback(value, index) {
       let producto = document.getElementById("producto"+index).innerHTML.trim().toLowerCase()
       let categoria = document.getElementById("categoria"+index).innerHTML.trim()
       if(!producto.includes(param1) || !categoria.includes(param2)){
           value.classList.add("hide")
       } else {
            value.classList.remove("hide")
       }
    })
}
function filtrarFilasPorParametro(param1, param2){
    let listaFilas = document.getElementsByName("rowTable");
    listaFilas = Array.from(listaFilas)
    listaFilas.forEach(function callback(value, index) {
        if(param1 == "producto") {
            let producto = document.getElementById("producto"+index).innerHTML.trim().toLowerCase()
            if(!producto.includes(param2) ){
                value.classList.add("hide")
            } else {
                value.classList.remove("hide")
            }
        }
        if(param1 == "categoria") {
            let categoria = document.getElementById("categoria"+index).innerHTML.trim().toLowerCase()
            if(!categoria.includes(param2) ){
                value.classList.add("hide")
            } else {
                value.classList.remove("hide")
            }
        }
    })
}
function resetFiltros(){
    localStorage.setItem("buscadorProducto", "")
    localStorage.setItem("selectCategoria", "todos")
}
// PEDIDO
function validarPedido() {
    let listaInput = document.getElementsByClassName("inputProducto")
    let claves = Object.keys(listaInput)
    let formularioValidado = false
    let otrosValidado = false
    for(let i=0; i< claves.length; i++){
        let clave = claves[i];
        if(listaInput[clave].value != 0) {
            formularioValidado = true
        }
    }
    let textarea= document.getElementById("textareaOtros")
    if(textarea.value.trim() != ""){
        otrosValidado = true
    }
    showModal(otrosValidado, formularioValidado)
}
function showModal(otrosValidado, formularioValidado) {
    let modalPedido = document.getElementById("modalPedido")
    let mensajeModalPedido = document.getElementById("mensajeModalPedido")
    let botonConfirmar = document.getElementById("botonConfirmar")
    if(!otrosValidado && !formularioValidado) {
        modalPedido.classList.remove("hide")
        modalPedido.classList.add("show")
        mensajeModalPedido.innerHTML="Disculpe, no puede generar un pedido vacio."
        botonConfirmar.classList.add("hide")
        botonConfirmar.classList.remove("show")
    } else if (otrosValidado && !formularioValidado){
        modalPedido.classList.remove("hide")
        modalPedido.classList.add("show")
        botonConfirmar.classList.add("show")
        botonConfirmar.classList.remove("show")
        mensajeModalPedido.innerHTML="El pedido no tiene productos del listado cargados. Solo se pedirá lo agregado en el campo adicional. <br> ¿Desea confirmar el pedido?"
    } else {
        modalPedido.classList.remove("hide")
        modalPedido.classList.add("show")
        botonConfirmar.classList.add("show")
        botonConfirmar.classList.remove("hide")
        mensajeModalPedido.innerHTML="¿Desea confirmar el pedido?"
    }
}
function cerrarModalPedido() {
    let modalPedido = document.getElementById("modalPedido")
    modalPedido.classList.remove("show")
    modalPedido.classList.add("hide")
}
function confirmarPedido(){
    let modalSpinner = document.getElementById("modalSpinner")
    modalSpinner.classList.remove("hide")
    modalSpinner.classList.add("show")
}
function cerrarModalConfirmacion() {
    let modalConfirmacion = document.getElementById("modalConfirmacion")
    modalConfirmacion.classList.remove("show")
    modalConfirmacion.classList.add("hide")
}