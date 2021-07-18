//FUNCIONES ASIDE
function ajustarAside(){
    if(localStorage.getItem("aside")){
        if(localStorage.getItem("aside") == "true"){
            expandirAside();
        }else{
            reducirAside();
        }
    }
}
function reducir(){
    localStorage.setItem("aside", false);
    reducirAside();
}
function reducirAside(){
    let aside = document.getElementById("asideBox");
    let main = document.getElementById("mainBox");
    let nameButtonAside = document.querySelectorAll(".nameButtonAside");
    let flechaLeft = document.getElementById("flechaLeftAside");
    let flechaRight = document.getElementById("flechaRightAside");
    let columnaBotones = document.getElementById("columnaBotonesAside");
    let columnaFlecha = document.getElementById("columnaFlechaAside");
    let botonAside = document.querySelectorAll(".asideButton");
    aside.classList.remove("col-md-3");
    main.classList.remove("col-md-9");
    aside.classList.add("col-md-1");
    flechaLeft.classList.add("hidden");
    flechaRight.classList.remove("hidden");
    columnaBotones.classList.remove("col-10");
    columnaBotones.classList.add("col-8");
    columnaFlecha.classList.remove("col-2");
    columnaFlecha.classList.add("col-4");
    main.classList.add("col-md-11");
    for(item of nameButtonAside){
        item.classList.add("hidden")
    }
    for(item of botonAside){
        item.classList.add("centrarIcono")
    }
}
function expandir(){
    localStorage.setItem("aside", true);
    expandirAside();
}
function expandirAside(){
    let aside = document.getElementById("asideBox");
    let main = document.getElementById("mainBox");
    let nameButtonAside = document.querySelectorAll(".nameButtonAside");
    let flechaLeft = document.getElementById("flechaLeftAside");
    let flechaRight = document.getElementById("flechaRightAside");
    let columnaBotones = document.getElementById("columnaBotonesAside");
    let columnaFlecha = document.getElementById("columnaFlechaAside");
    let botonAside = document.querySelectorAll(".asideButton");
    columnaBotones.classList.remove("col-8");
    columnaBotones.classList.add("col-10");
    columnaFlecha.classList.remove("col-4");
    columnaFlecha.classList.add("col-2");
    aside.classList.remove("col-md-1");
    main.classList.remove("col-md-11");
    aside.classList.add("col-md-3");
    main.classList.add("col-md-9");
    flechaLeft.classList.remove("hidden");
    flechaRight.classList.add("hidden");
    for(item of nameButtonAside){
        item.classList.remove("hidden")
    }
    for(item of botonAside){
        item.classList.remove("centrarIcono")
    }
}




//USUARIOS SECTION
function ocultarMensajeNewUser(){
    let cajaMensaje = document.getElementById("mensajeNewUser");
    cajaMensaje.classList.add("hidden");
}
function cargarSede(){
    let selectSede = document.getElementById("selectSede");
    selectSede.value = localStorage.getItem("sedeSeleccionada");
}
function changeSede(){
    let select = document.getElementById("selectSede");
    localStorage.setItem("sedeSeleccionada", select.value);
}
function resetSede(){
    localStorage.setItem("sedeSeleccionada", "todos");
}

//INICIAR PEDIDO
function cargarPedido(){
    let inputs = document.getElementsByTagName("input");
    for(let input of inputs){
        let id = input.id;
        let valorGuardado = localStorage.getItem(id);
        if(valorGuardado != undefined && id == "textareaOtros"){
            if(valorGuardado != ""){
                input.value = valorGuardado;
            }
        }
        else if(valorGuardado != undefined && id!= "textareaOtros"){
            if(valorGuardado != 0 && valorGuardado != "NaN"){
                input.value = valorGuardado;
            }
        }else{
            input.value = 0;
            let inputOtros= document.getElementById("textareaOtros");
            inputOtros.value = "";
        }
    }   
    let buscador = document.getElementById("buscadorProducto");
    buscador.value="";
    recordarCategoriaSeleccionada();
}
function resetPedido(){
    localStorage.clear();
}
function recordarCategoriaSeleccionada(){
    let cat = localStorage.getItem("categoriaSeleccionada");
    let opciones = document.getElementsByTagName("option");
    for (opcion of opciones){
        if(opcion.value != cat){
            opcion.removeAttribute("selected");
        }else{
            opcion.setAttribute("selected", true);
        }
    }
}
function inputFocusOut(param){
    validarCantidad(param);
    desmarcarProducto();
}



//FUNCIONES GENERICAS
function ocultarCaja(id, id2){
    let caja = document.getElementById(id);
    caja.classList.add("hidden");
}
function mostrarCaja(id, id2){
    let caja = document.getElementById(id);
    caja.classList.remove("hidden");
}
function resetForm(clase){
    let campos = document.getElementsByClassName(clase);
    for (let campo of campos) {
        campo.value = "";
    } 

}
function validarFormulario(param1, param2, param3 ){
    let campos = document.getElementsByClassName(param1);
    for (let campo of campos) {
        if(campo.value == ""){
            mostrarAlert(param2);
            return;
        }
    } 
    ocultarCaja(param2);
    mostrarCaja(param3);
}
function mostrarAlert(idAlert){
    let box = document.getElementById(idAlert);
    box.classList.remove("hidden");

}
function validarCantidad(param){
    let input = document.getElementById(param);
    let valor = input.value;
    if(valor == "" ){
        input.value = 0;
    }else{
        input.value = parseInt( valor, 10 )
    }
    localStorage.setItem(param, parseInt( valor, 10 ));
}
function guardarOtros(param){
    let input = document.getElementById(param);
    let valor = input.value;
    localStorage.setItem(param, valor);
}
function limpiarBuscador(id){
    let buscador = document.getElementById(id);
    buscador.value="";
    let listaProductos = document.querySelectorAll(".productos");
    for (item of listaProductos){
       item.parentNode.classList.remove("hidden");
    }
}
function changeCategoria(){
    let select = document.getElementById("selectCategoria");
    localStorage.setItem("categoriaSeleccionada", select.value);
}
function buscarProducto(){
    let buscador = document.getElementById("buscadorProducto");
    let producto = buscador.value;
    let listaProductos = document.querySelectorAll(".productos");
    for (item of listaProductos){
        if(producto.toLowerCase() == item.innerHTML.substring(0, producto.length).toLowerCase()){
            item.parentNode.classList.remove("hidden");
        }
        else{
            item.parentNode.classList.add("hidden");
        }
    }
    if(producto == ""){
        for (item of listaProductos){
            
                item.parentNode.classList.remove("hidden");
         
        }   
    }
}
function buscarUsuario(){
    let buscador = document.getElementById("buscadorUsuario");
    let usuario = buscador.value;
 
    let listadoFilas = document.querySelectorAll(".filaUsuario");
    for(item of listadoFilas){
        if(usuario.toLowerCase() == item.firstElementChild.innerHTML.substring(0, usuario.length).toLowerCase() ||
            usuario.toLowerCase() == item.firstElementChild.nextElementSibling.innerHTML.substring(0, usuario.length).toLowerCase() ||
            usuario.toLowerCase() == item.firstElementChild.nextElementSibling.nextElementSibling.innerHTML.substring(0, usuario.length).toLowerCase()){
            item.classList.remove("hidden");
        }
        else{
            item.classList.add("hidden");
        }
    }
}

function inputFocusOn(){
    marcarProducto();
    if(document.activeElement.value == 0){
        document.activeElement.value = "";
    }
}
function borrarCantidad(param){
    let input = document.getElementById('input'+param)
    input.value = 0;
    localStorage.setItem('input' + param, parseInt(0));
}
function desmarcarProducto(){
    let filas = document.getElementsByTagName("tr");
    for (let fila of filas) {
        if(fila.classList.contains("productoSeleccionado") == true){
            fila.classList.remove("productoSeleccionado");
        }
    } 
}
function limpiarInputFocus(){
    let focusedElement = document.activeElement;  
    if(focusedElement.value == 0){
        focusedElement.value="";
    }
}
function marcarProducto(){
    let focusedElement = document.activeElement;  
    
    let filas = document.getElementsByTagName("tr");
    for (let fila of filas) {
        if(fila.classList.contains("productoSeleccionado") == true){
            fila.classList.remove("productoSeleccionado");
        }
    } 
    focusedElement.parentNode.parentNode.classList.add("productoSeleccionado");
}
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
function mostrarSpinner(){
    let cajaConfirmarPedido = document.getElementById("cajaConfirmarPedido");
    cajaConfirmarPedido.classList.add("hidden");
    let spinner = document.getElementById("spinner");
    spinner.classList.remove("hidden")
}



//HEADER
function activarBurguer(){
    // let aside = document.getElementById("asideBox");
    let main = document.getElementById("mainBox");
    let menuBurguer = document.getElementById("menuBurguer");
    console.log(menuBurguer);
    if(menuBurguer.classList.contains("hidden") == false){
        // aside.classList.remove("asideHidden");
        main.classList.remove("mainHidden");
        menuBurguer.classList.add("hidden");
    }else{
        menuBurguer.classList.remove("hidden");
        main.classList.add("mainHidden");
    }

}




//SIN USO
function quitarClase(selector, clase){
    let asideBotones = document.getElementsByClassName(selector)
    
    for (let item of asideBotones) {
        if(item.classList.contains(clase)){
            item.classList.remove(clase)
        }
    } 
}
function activarBoton(param){
    quitarClase("asideButton", "botonRemarcado")

    let botonSeleccionado = document.getElementById(param)
    botonSeleccionado.classList.add("botonRemarcado")
}



