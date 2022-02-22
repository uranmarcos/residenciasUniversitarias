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

function mostrarPassword(id){
  var tipo = document.getElementById(id);
  if(tipo.type == "password"){
      tipo.type = "text";
  }else{
      tipo.type = "password";
  }
}


function validarPassword() {
    let newPassword = document.getElementById("inputNewPassword").value
    let errorNewPassword = document.getElementById("errorNewPassword")
    if ( newPassword.trim().length < 8 && newPassword != "") {
        errorNewPassword.innerHTML = "Entre 8 y 15 caracteres"
        return errorNewPassword.classList.remove("hide") 
    }
    if ( newPassword.includes(' ')) {
        errorNewPassword.innerHTML = "No puede poseer espacios en blanco"
        return errorNewPassword.classList.remove("hide") 
    }
    if(!tiene_letras(newPassword) || !tiene_numeros(newPassword)) {
        errorNewPassword.innerHTML = "Debe tener letras y números"
        return errorNewPassword.classList.remove("hide")
    }
    errorNewPassword.classList.add("hide")
}
function tiene_letras(texto){
    var letras="abcdefghyjklmnñopqrstuvwxyz";
    texto = texto.toLowerCase();
    for(i=0; i<texto.length; i++){
       if (letras.indexOf(texto.charAt(i),0)!=-1){
          return 1;
       }
    }
    return 0;
 }
 function tiene_numeros(texto){
    var letras="0123456789";
    texto = texto.toLowerCase();
    for(i=0; i<texto.length; i++){
       if (letras.indexOf(texto.charAt(i),0)!=-1){
          return 1;
       }
    }
    return 0;
 }
// function validarFormPass() {
//     let pass = document.getElementById("inputPassword").value
//     let newPass = document.getElementById("inputNewPassword").value
//     let confirmPass = document.getElementById("inputConfirmPassword").value
//     let boton = document.getElementById("botonPassword")
//     if ((pass.length >= 8) && (newPass.length >= 8) && (newPass == confirmPass)) {
//         boton.removeAttribute("disabled")
//     } else {
//         boton.setAttribute("disabled", true)
//     }
// }