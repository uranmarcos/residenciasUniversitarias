    let categoriaEliminable = null
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
        let spanCategoria = document.getElementById("spanCategoria")
        if(value.length >= length) {
            boton.removeAttribute("disabled");
            mensajeValidacion.classList.add('hide')
            spanCategoria.innerHTML = value
        }else{
            boton.setAttribute("disabled", true)
            mensajeValidacion.classList.remove('hide')
        }
    }
    function eliminarCategorias(id, descripcion) {
        document.getElementById("categoriaAEliminar").innerHTML = " - " + descripcion + " - "
        document.getElementById("inputCategoriaEliminar").value = id
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
    function cargarDatosEdicion(id, descripcion, habilitado){
        document.getElementById("idCategoriaPorEditar").value = id
        document.getElementById("inputEditarCategoria").value = descripcion
        document.getElementById("selectEditarCategoria").value = habilitado
    }
    function enviarDatosEdicion(idInput, idSelect) {
        let input = document.getElementById(idInput).value
        let select = document.getElementById(idSelect).value
        let spanEdicionCategoria = document.getElementById("spanEdicionCategoria")
        spanEdicionCategoria.innerHTML = input + " - " + (select == 0 ? "Eliminado" : "Habilitado")     
    }