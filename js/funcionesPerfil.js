window.onload = function(){
    let alertConfirmacion = document.getElementById("alertConfirmacion")
    if (alertConfirmacion.classList.contains('show')) {
        setTimeout(ocultarAlertConfirmacion, 5000)
    }
    let alertErrorConexion = document.getElementById("alertErrorConexion")
    if (alertErrorConexion.classList.contains('show')) {
        setTimeout(ocultarAlertError, 5000)
    }
}
function ocultarAlertConfirmacion(id){
    let alertConfirmacion = document.getElementById("alertConfirmacion")
    alertConfirmacion.classList.remove('show')
    alertConfirmacion.classList.add('hide')
}
function ocultarAlertError(){
    let alertErrorConexion = document.getElementById("alertErrorConexion")
    alertErrorConexion.classList.remove('show')
    alertErrorConexion.classList.add('hide')
}
function editarPerfil(){
    let botonEditar = document.getElementById("botonEditar")
    botonEditar.classList.add("hide")
    let botonesEdicionPerfil = document.getElementById("botonesEdicionPerfil")
    botonesEdicionPerfil.classList.remove("hide")
    let nombrePerfil = document.getElementById("nombrePerfil")
    nombrePerfil.removeAttribute("disabled")
    let segundoNombrePerfil = document.getElementById("segundoNombrePerfil")
    segundoNombrePerfil.removeAttribute("disabled")
    let apellidoPerfil = document.getElementById("apellidoPerfil")
    apellidoPerfil.removeAttribute("disabled")
    let mailPerfil = document.getElementById("mailPerfil")
    mailPerfil.removeAttribute("disabled")
}
function cancelarEdicion(){
    let botonEditar = document.getElementById("botonEditar")
    botonEditar.classList.remove("hide")
    let botonesEdicionPerfil = document.getElementById("botonesEdicionPerfil")
    botonesEdicionPerfil.classList.add("hide")
    let nombrePerfil = document.getElementById("nombrePerfil")
    nombrePerfil.setAttribute("disabled", true)
    let segundoNombrePerfil = document.getElementById("segundoNombrePerfil")
    segundoNombrePerfil.setAttribute("disabled", true)
    let apellidoPerfil = document.getElementById("apellidoPerfil")
    apellidoPerfil.setAttribute("disabled", true)
    let mailPerfil = document.getElementById("mailPerfil")
    mailPerfil.setAttribute("disabled", true)
}
function validarFormularioCompleto() {
    let campos = ["nombrePerfil", "segundoNombrePerfil", "apellidoPerfil", "mailPerfil"]
    let camposErrores = ["errorNombrePerfil", "errorSegundoNombrePerfil", "errorApellidoPerfil", "errorMailPerfil"]
   
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
            //case mail
            case campos[3]:
                let valueMail = document.getElementById(campos[3]).value
                let campoErrorMail = document.getElementById(camposErrores[3])
                campoErrorMail.classList.remove("hide")
                if (valueMail.trim() == "") {
                    console.log(valueMail)
                    campoErrorMail.innerHTML = "Campo requerido"
                    validacion = false
                } else if (!isEmailAddress(valueMail)){
                    campoErrorMail.innerHTML = "Formato incorrecto"
                    validacion = false
                } else {
                    campoErrorMail.classList.add("hide")
                }
            break;  
            default:
            break;
        }
    })
    let boton = document.getElementById("botonEditarPerfil")
    if(validacion){
        boton.removeAttribute("disabled")
        actualizarDatosModalEditar()
    }else{
        boton.setAttribute("disabled", true)
    }
}
function validarCampoFormulario(idCampo, idError){
    let botonE = document.getElementById("botonEditarPerfil")
    botonE.removeAttribute("disabled")
    let value = document.getElementById(idCampo).value
    let campoError = document.getElementById(idError)
    campoError.classList.remove("hide")
    switch (idCampo) {
        case "nombrePerfil":
            if (value.trim() == "") {
                campoError.innerHTML = "Campo requerido" 
            } else if (value.trim().length < 3) {
                campoError.innerHTML = "Mínimo 3 dígitos"
            } else {
                if (!soloLetras(value)){
                    campoError.innerHTML = "Solo letras y espacios"
                } else {
                    campoError.classList.add("hide")
                }
            }
        break;
        case "segundoNombreEditarPerfil":
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
        case "apellidoPerfil":
            if (value.trim() == "") {
                campoError.innerHTML = "Campo requerido" 
            } else if (value.length < 3) {
                campoError.innerHTML = "Mínimo 3 dígitos"
            } else {
                if (!soloLetras(value)){
                    campoError.innerHTML = "Solo letras y espacios"
                } else {
                    campoError.classList.add("hide")
                }
            }
        break;
        case "mailPerfil":
            if (value.trim() == "") {
                campoError.innerHTML = "Campo requerido"
            } else if (!isEmailAddress(value)){
                campoError.innerHTML = "Formato incorrecto"
            } else {
                campoError.classList.add("hide")
            }
        break;  
        default:
        break;
    }  
}
function actualizarDatosModalEditar(){
    let nombre = document.getElementById("nombrePerfil").value + " " + document.getElementById("segundoNombrePerfil").value
    let apellido = document.getElementById("apellidoPerfil").value
    let mail = document.getElementById("mailPerfil").value
    let spanEditarPerfil = document.getElementById("spanEditarPerfil")
    spanEditarPerfil.innerHTML = "Usuario: <b>" + nombre + " " + apellido + "<br></b>  Mail: <b>" + mail + "</b>"
}
function editarPassword() {
    let boxChangePassword = document.getElementById("boxChangePassword")
    boxChangePassword.classList.remove("hide")
    let botonEditarPassword = document.getElementById("botonEditarPassword")
    botonEditarPassword.setAttribute("disabled", true)
}
function cancelarChangePassword() {
    let boxChangePassword = document.getElementById("boxChangePassword")
    boxChangePassword.classList.add("hide")
    let botonEditarPassword = document.getElementById("botonEditarPassword")
    botonEditarPassword.removeAttribute("disabled")
    resetForm()
}
function mostrarPassword(id){
  var tipo = document.getElementById(id);
  if(tipo.type == "password"){
      tipo.type = "text";
  }else{
      tipo.type = "password";
  }
}
function resetForm(){
    let inputPassword = document.getElementById("inputPassword")
    let inputNewPassword = document.getElementById("inputNewPassword")
    let inputConfirmPassword = document.getElementById("inputConfirmPassword")
    inputPassword.value = ""
    inputNewPassword.value = ""
    inputConfirmPassword.value = ""
}
function compararContrasenias () {
    let newPassword = document.getElementById("inputNewPassword").value
    let confirmPassword = document.getElementById("inputConfirmPassword").value
    let errorConfirmPassword = document.getElementById("errorConfirmPassword")
    if ( confirmPassword != "" && confirmPassword != newPassword ) {
        return  errorConfirmPassword.classList.remove("hide")
    }
    errorConfirmPassword.classList.add("hide")
}
function validarPassword() {
    let newPassword = document.getElementById("inputNewPassword").value
    let errorNewPassword = document.getElementById("errorNewPassword")
    if ( newPassword.trim().length < 8 && newPassword != "") {
        return errorNewPassword.classList.remove("hide") 
    }
    errorNewPassword.classList.add("hide")
}
function validarFormPass() {
    let pass = document.getElementById("inputPassword").value
    let newPass = document.getElementById("inputNewPassword").value
    let confirmPass = document.getElementById("inputConfirmPassword").value
    let boton = document.getElementById("botonPassword")
    if ((pass.length >= 8) && (newPass.length >= 8) && (newPass == confirmPass)) {
        boton.removeAttribute("disabled")
    } else {
        boton.setAttribute("disabled", true)
    }
}