
    let categoriaEliminable = null
    function mostrarCaja(idCaja, idCajaOcultar, idBoton=null) {
        ocultarCaja(idCajaOcultar)
        let box = document.getElementById(idCaja)
        box.classList.remove("hide")
        if (idBoton != null) {
            let boton = document.getElementById(idBoton)
            boton.classList.add("hide")
        }
    }
    function ocultarCaja(idCaja, idBoton=null) {
        let box = document.getElementById(idCaja)
        box.classList.add("hide")
        if (idBoton != null) {
            let boton = document.getElementById(idBoton)
            boton.classList.remove("hide")
        }
    }
    //ACTUALIZACION DE DATOS EN MODAL CONFIRMACION DE CREACION DE USUARIO
    function actualizarDatosModalCrear(){
        let nombre = document.getElementById("primerNombreNuevoUsuario").value + " " + document.getElementById("segundoNombreNuevoUsuario").value
        let apellido = document.getElementById("apellidoNuevoUsuario").value
        let dni = document.getElementById("dniNuevoUsuario").value
        let rol = document.getElementById("rolNuevoUsuario")
        let rolSelected = rol.options[rol.selectedIndex].text;
        let mail = document.getElementById("mailNuevoUsuario").value
        let sede = document.getElementById("sedeNuevoUsuario")
        let sedeSelected = sede.options[sede.selectedIndex].text;
        let casa = document.getElementById("casaNuevoUsuario").value
        let spanNuevoUsuario = document.getElementById("spanNuevoUsuario")
        spanNuevoUsuario.innerHTML = "Usuario: <b>" + nombre + " " + apellido + "</b>  - DNI: <b>" + dni + "</b> - rol: <b>" + rolSelected + "</b> - mail: <b>" + mail + "</b> - sede: <b>" + sedeSelected + "</b> - casa: <b>" + casa +"</b>"
    }
    function actualizarDatosModalEditar(){
        let nombre = document.getElementById("primerNombreEditarUsuario").value + " " + document.getElementById("segundoNombreEditarUsuario").value
        let apellido = document.getElementById("apellidoEditarUsuario").value
        let dni = document.getElementById("dniEditarUsuario").value
        let rol = document.getElementById("rolEditarUsuario")
        let rolSelected = rol.options[rol.selectedIndex].text;
        let mail = document.getElementById("mailEditarUsuario").value
        let sede = document.getElementById("sedeEditarUsuario")
        let sedeSelected = sede.options[sede.selectedIndex].text;
        let casa = document.getElementById("casaEditarUsuario").value
        let spanEditarUsuario = document.getElementById("spanEditarUsuario")
        spanEditarUsuario.innerHTML = "Usuario: <b>" + nombre + " " + apellido + "</b>  - DNI: <b>" + dni + "</b> - rol: <b>" + rolSelected + "</b> - mail: <b>" + mail + "</b> - sede: <b>" + sedeSelected + "</b> - casa: <b>" + casa +"</b>"
    }
    function eliminarUsuarios(id, nombre, apellido) {
        let usuarioAEliminar = document.getElementById("usuarioAEliminar")
        usuarioAEliminar.innerHTML = " - " + nombre + "  " + apellido + " - "
        let idUsuarioEliminar = document.getElementById("idUsuarioEliminar")
        idUsuarioEliminar.value = id
    }
    function deshabilitarBotonTrash (id, rol, habilitado) {
        let boton = document.getElementById("trashButton"+id)
        if (habilitado == 0 || rol == "admin"){
            boton.setAttribute("disabled", true)    
        }
    }
    function deshabilitarBotonEdit (id, rol) {
        let boton = document.getElementById("editButton"+id)
        if (rol == "admin"){
            boton.setAttribute("disabled", true)    
        }
    }
    function habilitarBotonDirecto (id) {
        let boton = document.getElementById(id)
        if (boton.hasAttribute("disabled")){
            boton.removeAttribute("disabled")    
        }
    }
    // CARGA LOS DATOS DE BASE DE LA SEDE EN EL BOX EDITABLE 
    function cargarDatosEdicion(id, nombre, segundoNombre, apellido, dni, rol, mail, sede, casa, habilitado){
        let boton = document.getElementById("botonEditarUsuario")
        boton.setAttribute("disabled", true)
        document.getElementById("idUsuarioPorEditar").value = id
        document.getElementById("primerNombreEditarUsuario").value = nombre
        document.getElementById("segundoNombreEditarUsuario").value = segundoNombre
        document.getElementById("apellidoEditarUsuario").value = apellido
        document.getElementById("dniEditarUsuario").value = dni
        document.getElementById("rolEditarUsuario").value = rol
        document.getElementById("mailEditarUsuario").value = mail
        document.getElementById("sedeEditarUsuario").value = sede
        document.getElementById("casaEditarUsuario").value = casa
        document.getElementById("habilitadoEditarUsuario").value = habilitado
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
    function confirmarRol(rol, accion){
        if(rol == "general") {
            let sedeParam = accion == "crear" ? "sedeNuevoUsuario" : "sedeEditarUsuario"
            let casaParam = accion == "crear" ? "casaNuevoUsuario" : "casaEditarUsuario"
            let modal = document.getElementById("modalConfirmacionRol")
            modal.classList.remove("hide")
            modal.classList.add("show")
            let sede = document.getElementById(sedeParam)
            sede.value = 6
            sede.setAttribute("disabled", true)
            let selectCasas = document.getElementById(casaParam)
            selectCasas.value = 0
            selectCasas.setAttribute("disabled", true)
        }
    }
    function cancelarRolGeneral() {
        let modal = document.getElementById("modalConfirmacionRol")
        let rol = document.getElementById("rolNuevoUsuario")
        rol.value="stock"
        modal.classList.remove("show")
        modal.classList.add("hide")
        let sede = document.getElementById("sedeNuevoUsuario")
        sede.value = 0
        sede.removeAttribute("disabled")
        let selectCasas = document.getElementById("casaNuevoUsuario")
        selectCasas.value = 1
        selectCasas.removeAttribute("disabled")

        let rolE = document.getElementById("rolEditarUsuario")
        rolE.value="stock"
        let sedeE = document.getElementById("sedeEditarUsuario")
        sedeE.value = 0
        sedeE.removeAttribute("disabled")
        let selectCasasE = document.getElementById("casaEditarUsuario")
        selectCasasE.value = 1
        selectCasasE.removeAttribute("disabled")
    }
    function confirmarRolGeneral () {
        let modal = document.getElementById("modalConfirmacionRol")
        modal.classList.remove("show")
        modal.classList.add("hide")
    }
    function selectSede(param) {
        if(param != 0) {
            let sedes = <?php echo json_encode($sedes)?> 
            let casas = sedes.filter(e=> e.id == param)
            casas = parseInt(casas[0].casas)
            let opciones = document.getElementsByName("opcionSelectCasa")
            let selectCasas = document.getElementById("casaNuevoUsuario")
            selectCasas.value = 1
            opciones = Array.from(opciones);
            opciones.forEach(e => {
                    e.removeAttribute("disabled")
            })
            opciones.forEach(e => {
                if (e.value > casas){
                    e.setAttribute("disabled", true)
                }
            })
        }
    }
    // FUNCIONES DE VALIDACIONES DE FORMULARIO
    function validarCampoFormulario(idCampo, idError){
        let botonC = document.getElementById("botonCrearUsuario")
        let botonE = document.getElementById("botonEditarUsuario")
        botonC.removeAttribute("disabled")
        botonE.removeAttribute("disabled")
        let value = document.getElementById(idCampo).value
        let campoError = document.getElementById(idError)
        campoError.classList.remove("hide")
        switch (idCampo) {
            case "primerNombreNuevoUsuario":
            case "primerNombreEditarUsuario":
                if (value.trim().length < 3) {
                    campoError.innerHTML = "Mínimo 3 dígitos"
                } else {
                    if (!soloLetras(value)){
                        campoError.innerHTML = "Solo letras y espacios"
                    } else {
                        campoError.classList.add("hide")
                    }
                }
            break;
            case "segundoNombreNuevoUsuario":
            case "segundoNombreEditarUsuario":
                if(value.trim() != ""){
                    if (value.length < 3) {
                        campoError.innerHTML = "Mínimo 3 dígitos"
                    } else {
                        if (!soloLetras(value)){
                            campoError.innerHTML = "Solo letras y espacios"
                        } else {
                            campoError.classList.add("hide")
                        }
                    }
                } else{
                    campoError.classList.add("hide")
                }
            break;
            case "apellidoNuevoUsuario":
            case "apellidoEditarUsuario":
                if (value.length < 3) {
                    campoError.innerHTML = "Mínimo 3 dígitos"
                } else {
                    if (!soloLetras(value)){
                        campoError.innerHTML = "Solo letras y espacios"
                    } else {
                        campoError.classList.add("hide")
                    }
                }
            break;
            case "dniNuevoUsuario":
            case "dniEditarUsuario":
                if (value.length < 8) {
                    campoError.innerHTML = "8 dígitos"
                } else {
                    if (!isNumber(value)){
                        campoError.innerHTML = "Campo numérico"
                    } else {
                        campoError.classList.add("hide")
                    }
                }
            break;
            case "mailNuevoUsuario":
            case "mailEditarUsuario":
                if (!isEmailAddress(value)){
                    campoError.innerHTML = "Formato incorrecto"
                } else {
                    campoError.classList.add("hide")
                }
            break;  
            case "sedeNuevoUsuario":
            case "sedeEditarUsuario":
                if (value == 0){
                    campoError.innerHTML = "Campo Requerido"
                } else {
                    campoError.classList.add("hide")
                }
            break;  
            default:
            break;
        }  
    }
    function isNumber(str) {
        var pattern = /^\d+$/;
        return pattern.test(str);  // returns a boolean
    }
    function isEmailAddress(str) {
        var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return pattern.test(str);  // returns a boolean
    }
    function soloLetras(str) {
        // const pattern = new RegExp('^[A-Z]+$', 'i');
        const pattern = RegExp(/^[A-Za-z\s]+$/g);
        return pattern.test(str);  // returns a boolean
    }
    function validarFormularioCompleto(accion) {
        let campos = null
        let camposErrores = null
        if(accion == "crear"){
            campos = <?php  echo json_encode($camposCreacion) ?>;
            camposErrores = <?php  echo json_encode($camposErroresCreacion); ?>;
        } else {
            campos = <?php  echo json_encode($camposEdicion); ?>;
            camposErrores = <?php  echo json_encode($camposErroresEdicion); ?>;
        }
        let validacion = true;
        campos.forEach(e => {
            switch (e) {
                // case primer nombre
                case campos[0]:
                    let valuePrimerNombre = document.getElementById(campos[0]).value
                    let campoErrorPrimerNombre = document.getElementById(camposErrores[0])
                    campoErrorPrimerNombre.classList.remove("hide")
                    if (valuePrimerNombre.trim() == "") {
                        campoErrorPrimerNombre.innerHTML = "Campo requerido"
                        validacion = false
                    } else if (valuePrimerNombre.trim().length < 3) {
                        campoErrorPrimerNombre.innerHTML = "Mínimo 3 dígitos"
                        validacion = false
                    } else {
                        if (!soloLetras(valuePrimerNombre)){
                            campoErrorPrimerNombre.innerHTML = "Solo letras y espacios"
                            validacion = false
                        } else {
                            campoErrorPrimerNombre.classList.add("hide")
                        }
                    }
                break;
                // case segundo nombre
                case campos[1]:
                    let valueSegundoNombre = document.getElementById(campos[1]).value
                    let campoErrorSegundoNombre = document.getElementById(camposErrores[1])
                    campoErrorSegundoNombre.classList.remove("hide")
                    if(valueSegundoNombre.trim() != ""){
                        if (valueSegundoNombre.length < 3) {
                            campoErrorSegundoNombre.innerHTML = "Mínimo 3 dígitos"
                            validacion = false
                        } else {
                            if (!soloLetras(valueSegundoNombre)){
                                campoErrorSegundoNombre.innerHTML = "Solo letras y espacios"
                                validacion = false
                            } else {
                                campoErrorSegundoNombre.classList.add("hide")
                            }
                        }
                    }else{
                        campoErrorSegundoNombre.classList.add("hide")
                    }
                break;
                // case apellido
                case campos[2]:
                    let valueApellido = document.getElementById(campos[2]).value
                    let campoErrorApellido = document.getElementById(camposErrores[2])
                    campoErrorApellido.classList.remove("hide")
                    if (valueApellido.trim() == "") {
                        campoErrorApellido.innerHTML = "Campo requerido"
                        validacion = false
                    } else if (valueApellido.trim().length < 3) {
                        campoErrorApellido.innerHTML = "Mínimo 3 dígitos"
                        validacion = false
                    } else {
                        if (!soloLetras(valueApellido)){
                            campoErrorApellido.innerHTML = "Solo letras y espacios"
                            validacion = false
                        } else {
                            let validacion = true;
                            campoErrorApellido.classList.add("hide")
                        }
                    }
                break;
                //case dni
                case campos[3]:
                    let valueDni = document.getElementById(campos[3]).value
                    let campoErrorDni = document.getElementById(camposErrores[3])
                    campoErrorDni.classList.remove("hide")
                    if (valueDni.trim() == "") {
                        campoErrorDni.innerHTML = "Campo requerido"
                        validacion = false
                    } else if (valueDni.length < 8) {
                        campoErrorDni.innerHTML = "8 dígitos"
                        validacion = false
                    } else {
                        if (!isNumber(valueDni)){
                            campoErrorDni.innerHTML = "Campo numérico"
                            validacion = false
                        } else {
                            campoErrorDni.classList.add("hide")
                        }
                    }
                break;
                //case mail
                case campos[4]:
                    let valueMail = document.getElementById(campos[4]).value
                    let campoErrorMail = document.getElementById(camposErrores[4])
                    campoErrorMail.classList.remove("hide")
                    if (valueMail.trim() == "") {
                        campoErrorMail.innerHTML = "Campo requerido"
                        validacion = false
                    } else if (!isEmailAddress(valueMail)){
                        campoErrorMail.innerHTML = "Formato incorrecto"
                        validacion = false
                    } else {
                        campoErrorMail.classList.add("hide")
                    }
                break;  
                //case sede
                case campos[5]:
                    let valueSede = document.getElementById(campos[5]).value
                    let campoErrorSede = document.getElementById(camposErrores[5])
                    campoErrorSede.classList.remove("hide")
                    if (valueSede == 0){
                        campoErrorSede.innerHTML = "Campo requerido"
                        validacion = false
                    } else {
                        campoErrorSede.classList.add("hide")
                    }
                break;  
                default:
                break;
            }
        })
        if(accion == "crear"){
            let boton = document.getElementById("botonCrearUsuario")
            if(validacion){
                boton.removeAttribute("disabled")
                actualizarDatosModalCrear()
            }else{
                boton.setAttribute("disabled", true)
            }
        } else {
            let boton = document.getElementById("botonEditarUsuario")
            if(validacion){
                boton.removeAttribute("disabled")
                actualizarDatosModalEditar()
            }else{
                boton.setAttribute("disabled", true)
            }
        }
    }
    function limpiarValidaciones(accion) {
        if(accion == "crear") {
            document.getElementById("errorPrimerNombreNuevoUsuario").classList.add("hide")
            document.getElementById("errorSegundoNombreNuevoUsuario").classList.add("hide")
            document.getElementById("errorApellidoNuevoUsuario").classList.add("hide")
            document.getElementById("errorDniNuevoUsuario").classList.add("hide")
            document.getElementById("errorMailNuevoUsuario").classList.add("hide")
            document.getElementById("errorSedeNuevoUsuario").classList.add("hide")
        } else {
            document.getElementById("errorPrimerNombreEditarUsuario").classList.add("hide")
            document.getElementById("errorSegundoNombreEditarUsuario").classList.add("hide")
            document.getElementById("errorApellidoEditarUsuario").classList.add("hide")
            document.getElementById("errorDniEditarUsuario").classList.add("hide")
            document.getElementById("errorMailEditarUsuario").classList.add("hide")
            document.getElementById("errorSedeEditarUsuario").classList.add("hide")
        }
    }