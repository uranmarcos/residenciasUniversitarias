function mostrarCaja(idCaja, idCajaOcultar, idBoton=null) {
    ocultarCaja(idCajaOcultar)
    document.getElementById(idCaja).classList.remove("hide")
    if (idBoton != null) {
        document.getElementById(idBoton).classList.add("hide")
    }
}
function ocultarCaja(idCaja, idBoton=null) {
    document.getElementById(idCaja).classList.add("hide")
    if (idBoton != null) {
        document.getElementById(idBoton).classList.remove("hide")
    }
}
// FUNCION PARA HABILITAR UN BOTON EN BASE A VALIDACION DE INPUT - PARAMETROS: VALUE, LENGTH, IDBOTON A HABILITAR 
function habilitarBoton(value, length, id, idMensajeValidacion) {
    let boton = document.getElementById(id)
    let mensajeValidacion = document.getElementById(idMensajeValidacion)
    let spanArticulo = document.getElementById("spanArticulo")
    let categoria = document.getElementById("categoriaNuevoArticulo")
    let categoriaSelected = categoria.options[categoria.selectedIndex].text;
    let medida = document.getElementById("medidaNuevoArticulo")
    let medidaSelected = medida.options[medida.selectedIndex].text;
    if(value.length >= length) {
        boton.removeAttribute("disabled");
        mensajeValidacion.classList.add('hide')
        spanArticulo.innerHTML = value + " en " + medidaSelected + " para " + categoriaSelected 
    }else{
        boton.setAttribute("disabled", true)
        mensajeValidacion.classList.remove('hide')
    }
}
//ACTUALIZACION DE DATOS EN MODAL CONFIRMACION DE CREACION DE SEDE, AL CAMBIAR CANTIDAD DE CASAS
function actualizarDatosModalCrear(){
    let descripcion = document.getElementById("descripcionNuevoArticulo").value
    let categoria = document.getElementById("categoriaNuevoArticulo")
    let categoriaSelected = categoria.options[categoria.selectedIndex].text;
    let medida = document.getElementById("medidaNuevoArticulo")
    let medidaSelected = medida.options[medida.selectedIndex].text;
    let spanArticulo = document.getElementById("spanArticulo")
    if (descripcion != "") {
        spanArticulo.innerHTML = descripcion + " en " + medidaSelected + " para " + categoriaSelected 
    } 
}
function eliminarArticulos(id, descripcion) {
    document.getElementById("articuloAEliminar").innerHTML = " - " + descripcion + " - "
    document.getElementById("idArticuloEliminar").value = id
}
function deshabilitarBotonTrash (id, habilitado) {
    if (habilitado == 0){
        document.getElementById("trashButton"+id).setAttribute("disabled", true)    
    }
}
function habilitarBotonDirecto (id) {
    let boton = document.getElementById(id)
    if (boton.hasAttribute("disabled")){
        boton.removeAttribute("disabled")    
    }
}
// CARGA LOS DATOS DE BASE DE LA SEDE EN EL BOX EDITABLE 
function cargarDatosEdicion(id, descripcion, medida, categoria, habilitado){
    document.getElementById("botonEditar").setAttribute("disabled", true)
    document.getElementById("idArticuloPorEditar").value = id
    document.getElementById("descripcionEditarArticulo").value = descripcion
    document.getElementById("medidaEditarArticulo").value = medida
    document.getElementById("categoriaEditarArticulo").value = categoria
    document.getElementById("habilitadoEditarArticulo").value = habilitado
}
// CARGA LOS DATOS NUEVOS DE LA SEDE EN EL MODAL PIDIENDO CONFIRMACION
function enviarDatosEdicion(descripcion, medida, categoria, habilitado) {
    let descripcionArticulo = document.getElementById(descripcion).value
    let medidaArticulo = document.getElementById(medida)
    let medidaSelected = medidaArticulo.options[medidaArticulo.selectedIndex].text;
    let categoriaArticulo = document.getElementById(categoria)
    let categoriaSelected = categoriaArticulo.options[categoriaArticulo.selectedIndex].text;
    let habilitadoArticulo = document.getElementById(habilitado).value
    let spanEdicionArticulo = document.getElementById("spanEdicionArticulo")
    spanEdicionArticulo.innerHTML = descripcionArticulo + " en " + medidaSelected + " para " +  categoriaSelected + " - " + (habilitadoArticulo == 0 ? "Eliminado" : "Habilitado")

}