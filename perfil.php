<?php
session_start();
require("funciones/pdo.php");
require("funciones/funcionesPerfil.php");

?>
<html>
    <head>
        <title>Pedidos Sí</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="css/master2.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="col-md-11 main">
                <div class="col-12 p-0">
                    <div class="titleSection">
                        <span class="pointer" onclick="redirect('inicio')">Inicio</span> -<span class="grey"> Mi perfil </span>
                    </div>
                </div>
                <div>
                    <div class="alert alert-danger mt-3 centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
                        <?php echo $mensajeAlertError ?>
                    </div>
                    <div class="alert alert-success mt-3 centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
                        <?php echo $mensajeAlertConfirmacion ?>
                    </div>
                    <!-- BOX MI PERFIL -->
                    <form name="form" method="POST" action="perfil.php">   
                        <div class="bloque <?php echo $hayDatos?>" id="boxEditarUsuario">
                            <!-- BOTONES CAMBIAR CONTRASEÑA Y EDITAR PERFIL-->
                            <div class="d-flex anchoTotal justify-content-between mb-4">
                                <div class="col-6 d-flex p-0 align-items-center justify-content-start">
                                    <button type="button" name="botonEditarPassword" id="botonEditarPassword" class="btn boton" data-bs-toggle="modal" data-bs-target="#passwordModal">Cambiar Contraseña</button>        
                                </div> 
                                <div class="col-6 d-flex p-0 align-items-center justify-content-end">
                                    <button type="button" onclick="editarPerfilCompleto()" class="btn boton">Editar Perfil</button>        
                                </div>
                            </div>   
                            <!-- CONTENEDOR DATOS MI PERFIL -->
                            <div class="row  d-flex justify-content-center">
                                <div class="col-1 col-md-1 col-lg-3 hide columnaBloque">
                                    <label># </label>
                                    <input maxlength="12" name="idPerfil" disabled value="<?php echo $perfil[0]["id"]?>" id="idPerfil">
                                    <div class="hide errorValidacion" id="errorIdPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Primer Nombre: </label>
                                    <input maxlength="12" disabled name="nombrePerfil" autocomplete="off" onkeyup="validarCampoFormulario('nombrePerfil', 'errorNombrePerfil'), validarFormulario()" value="<?php echo $perfil[0]["nombre"]?>" id="nombrePerfil">
                                    <div class="hide errorValidacion" id="errorNombrePerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Segundo Nombre: </label>
                                    <input maxlength="12" disabled name="segundoNombrePerfil" autocomplete="off" onkeyup="validarCampoFormulario('segundoNombrePerfil', 'errorSegundoNombrePerfil'), validarFormulario()" value="<?php echo $perfil[0]["segundoNombre"]?>" id="segundoNombrePerfil">
                                    <div class="hide errorValidacion" id="errorSegundoNombrePerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Apellido: </label>
                                    <input maxlength="12" disabled name="apellidoPerfil" autocomplete="off" onkeyup="validarCampoFormulario('apellidoPerfil', 'errorApellidoPerfil'), validarFormulario()" value="<?php echo $perfil[0]["apellido"]?>" id="apellidoPerfil">
                                    <div class="hide errorValidacion" id="errorApellidoPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>DNI: </label>
                                    <input maxlength="8" disabled name="dniPerfil" autocomplete="off" value="<?php echo $perfil[0]["dni"]?>" id="dniPerfil">
                                    <div class="hide errorValidacion" id="errorDniPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Rol: </label>
                                    <input maxlength="8" disabled name="rolPerfil" autocomplete="off" value="<?php echo $perfil[0]["rol"]?>" id="rolPerfil">
                                    <div class="hide errorValidacion" id="errorRolPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Mail: </label>
                                    <input name="mailPerfil" disabled type="email" autocomplete="off" onkeyup="validarCampoFormulario('mailPerfil', 'errorMailPerfil'), validarFormulario()" value="<?php echo $perfil[0]["mail"]?>" id="mailPerfil"> 
                                    <div class="hide errorValidacion" id="errorMailPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Sede: </label>
                                    <input name="sedePerfil" disabled type="text" autocomplete="off" value="<?php echo $perfil[0]["nombreSede"]?>" id="sedePerfil"> 
                                    <div class="hide errorValidacion" id="errorSedeEditarUsuario"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Casa: </label>
                                    <input name="casaPerfil" disabled type="text" autocomplete="off" value="<?php echo $perfil[0]["casa"]?>" id="casaPerfil"> 
                                    <div class="hide errorValidacion" id="errorCasaPerfil"></div>
                                </div>
                                <div class="col-12 col-lg-9  hide  mt-4 mb-2 mb-md-0 " id="botonesEdicionPerfil">
                                    <div class="col-12 d-flex align-items-end justify-content-around" style="height:100%" >
                                        <button type="submit" name="botonCancelar" onclick="cancelarEdicion()" class="btn botonCancelar">Cancelar</button>
                                        <button type="button" disabled id="botonEditar" onclick="actualizarDatosModalEditar()" class="btn boton" data-bs-toggle="modal" data-bs-target="#modalEdicionPerfil">
                                            Confirmar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL CONFIRMACION EDICION PERFIL -->
                            <div class="modal fade" id="modalEdicionPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body black centrarTexto">
                                            ¿Confirma los cambios: <br><span id="spanEditarPerfil"></span>?
                                        </div>
                                        <div class="modal-footer d-flex justify-content-around">
                                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" id="botonEditarPerfil" name="editarPerfil" onclick="mostrarLoading('botonEditarPerfil', 'botonEditLoading')" class="btn boton">Confirmar</button>
                                            <button type="button" class="boton hide" id="botonEditLoading" >
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- BOX SIN DATOS -->
                    <div class="bloque mb-4 pb-0 <?php echo $noHayDatos?>" id="">
                        <table class="table <?php echo $noHayDatos?>">
                            <thead class="d-flex justify-content-center">
                                <tr>
                                    <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <!----     START MODAL CAMBIO DE CONTRASEÑA   ----->
                    <form name="formEdicion" method="POST" action="perfil.php">
                        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title centrarTexto purple" id="passwordModalLabel">CAMBIO DE CONTRASEÑA</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="bodyModalCrear">
                                        <div class="contenedorSeccion purple contenedorModal mb-4">        
                                            <div class="row">
                                                <div class="col-12 columna">
                                                    <button type="button" class="btn botonLimpiar" id="btnLimpiarEdicion" onclick="limpiarFormularioEdicion()">Limpiar Formulario</button>
                                                </div>
                                                <input id="idPerfilEdicion" name="idPerfilEdicion" class="hide">
                                                <!-- START INPUT PASSWORD -->
                                                <div class="col-12 columna">
                                                    <label>Ingrese su actual contraseña </label>
                                                    <div class="row m-0">
                                                        <input class="col-11" maxlength="15" type="password" onkeyup="validarPassword(), validarFormPass()" name="inputPassword" autocomplete="off" id="inputPassword">
                                                        <div class="col-1">
                                                            <div class="eyeButton pt-1" id="mostrarContraseniaPerfil" onclick="mostrarContrasenia('mostrarContraseniaPerfil', 'ocultarContraseniaPerfil', 'inputPassword')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                </svg>
                                                            </div>
                                                            <div class="hide eyeButton pt-1" id="ocultarContraseniaPerfil" onclick="ocultarContrasenia('mostrarContraseniaPerfil', 'ocultarContraseniaPerfil', 'inputPassword')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" errorValidacion" id="errorInputPassword"></div>
                                                </div>
                                                <!-- END INPUT PASSWORD -->

                                                <!-- START INPUT NEW PASSWORD -->
                                                <div class="col-12 columna">
                                                    <label>Ingrese su nueva contraseña </label>
                                                    <div class="row m-0">
                                                        <input class="col-11" maxlength="15" type="password" onkeyup="validarNewPassword(), validarFormPass()" name="inputNewPassword" autocomplete="off" id="inputNewPassword"> 
                                                        <div class="col-1">
                                                            <div class="eyeButton pt-1" id="mostrarNewContraseniaPerfil" onclick="mostrarContrasenia('mostrarNewContraseniaPerfil', 'ocultarNewContraseniaPerfil', 'inputNewPassword')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                </svg>
                                                            </div>
                                                            <div class="hide eyeButton pt-1" id="ocultarNewContraseniaPerfil" onclick="ocultarContrasenia('mostrarNewContraseniaPerfil', 'ocultarNewContraseniaPerfil', 'inputNewPassword')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" errorValidacion" id="errorNewPassword"></div>
                                                </div>
                                                <!-- END INPUT NEW PASSWORD -->

                                                <!-- START INPUT REPEAT NEW PASSWORD -->
                                                <div class="col-12 columna">
                                                    <label>Repita su nueva contraseña: </label>
                                                    <div class="row m-0">
                                                        <input class="col-11" maxlength="15" type="password" name="confirmPassword" autocomplete="off" onkeyup="compararContrasenias(), validarFormPass()" id="inputConfirmPassword">
                                                        <div class="col-1">
                                                            <div class="eyeButton pt-1" id="mostrarConfirmContraseniaPerfil" onclick="mostrarContrasenia('mostrarConfirmContraseniaPerfil', 'ocultarConfirmContraseniaPerfil', 'inputConfirmPassword')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                </svg>
                                                            </div>
                                                            <div class="hide eyeButton pt-1" id="ocultarConfirmContraseniaPerfil" onclick="ocultarContrasenia('mostrarConfirmContraseniaPerfil', 'ocultarConfirmContraseniaPerfil', 'inputConfirmPassword')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" errorValidacion" id="errorConfirmPassword"></div>
                                                </div>     
                                                <!-- END INPUT REPEAT NEW PASSWORD -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-12" id="botonesModalEdicion">
                                            <div class="d-flex align-items-center justify-content-around">
                                                <button type="button" class="btn botonCancelar" onclick="limpiarFormularioEdicion()" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn boton" disabled id="btnEdicion" onclick="pedirConfirmacion('botonesModalEdicion', 'confirmacionEdicion', 'editar')">Confirmar</button>
                                            </div>
                                        </div>
                                        <div class="col-12  hide" id="confirmacionEdicion">
                                            <div class="d-flex align-items-center mb-3 purple justify-content-around">
                                                ¿Confirma la edición de la categoria?
                                            </div>
                                            <div class="d-flex align-items-center justify-content-around">
                                                <button type="button" class="btn botonCancelar" onclick="cancelarConfirmacion('confirmacionEdicion', 'botonesModalEdicion', 'editar')">Cancelar</button>
                                                <button type="submit" name="editarCategoria" id="btnEditarCategoria" onclick="desbloquearFormularioEdicion(), mostrarSpinner('btnEditarCategoria','spinnerEditarCategoria')" class="btn boton">Confirmar</button>
                                                <button type="button" class="btnReenviarCircle hide" id="spinnerEditarCategoria" >
                                                    <div class="spinner-border spinnerReenviar" role="status">
                                                        <span class="sr-only"></span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!----     END MODAL CAMBIO DE CONTRASEÑA    ----->
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>           
        <script type="text/javascript"  src="js/funcionesCompartidas.js"></script> 
        <script type="text/javascript"  src="js/funcionesPerfil.js"></script> 
    </body>
</html>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

//funciones edicion password
function limpiarFormularioEdicion () {
    document.getElementById("inputPassword").value = ""
    document.getElementById("inputNewPassword").value = ""
    document.getElementById("inputConfirmPassword").value = ""
    let btnEdicion = document.getElementById("btnEdicion")
    btnEdicion.setAttribute("disabled", true)
    limpiarValidaciones()
}
function limpiarValidaciones() {
    document.getElementById("errorInputPassword").classList.add("hide")
    document.getElementById("errorNewPassword").classList.add("hide")
    document.getElementById("errorConfirmPassword").classList.add("hide")
    
}
function validarPassword () {
    let password = document.getElementById("inputPassword").value
    let boxError = document.getElementById("errorInputPassword")

    if ( password.length == 0 ) {
        boxError.innerHTML = "Campo requerido"
        boxError.classList.remove("hide")
        return
    }  else if ( password.length < 8 ) {
        boxError.innerHTML = "Entre 8 y 15 caracteres"
        boxError.classList.remove("hide")
        return
    } 
        boxError.innerHTML = ""
        boxError.classList.add("hide")
        return
}
function validarFormPass () {
    let password = document.getElementById("inputPassword").value
    let newPassword = document.getElementById("inputNewPassword").value
    let confirmPassword = document.getElementById("inputConfirmPassword").value
    let errorPassword = document.getElementById("errorInputPassword").innerHTML
    let errorNewPassword = document.getElementById("errorNewPassword").innerHTML
    let errorConfirmPassword = document.getElementById("errorConfirmPassword").innerHTML
    console.log
    if ( password.trim() != "" && newPassword.trim() != "" && confirmPassword.trim() != "" && errorPassword == "" && errorNewPassword == ""  && errorConfirmPassword == "") {
        let btnEdicion = document.getElementById("btnEdicion")
        return btnEdicion.removeAttribute("disabled")
    } 
    return btnEdicion.setAttribute("disabled", true)
}
function validarNewPassword () {
    let password = document.getElementById("inputNewPassword").value
    let boxError = document.getElementById("errorNewPassword")
    let confirmPassword = document.getElementById("inputConfirmPassword").value
    if(confirmPassword != "") {
        compararContrasenias()
    }

    if ( password.length == 0 ) {
        boxError.innerHTML = "Campo requerido"        
        return boxError.classList.remove("hide")
    }  else if ( password.length < 8 ) {
        boxError.innerHTML = "Entre 8 y 15 caracteres"
        return boxError.classList.remove("hide")
    } else if ( password.includes(' ')) {
        boxError.innerHTML = "No puede poseer espacios en blanco"
        return boxError.classList.remove("hide") 
    } else if (!tiene_letras(password) || !tiene_numeros(password)) {
        boxError.innerHTML = "Debe tener letras y números"
        return boxError.classList.remove("hide")
    } 
    boxError.innerHTML = ""
    boxError.classList.add("hide")
    return
}
function compararContrasenias () {
    let newPassword = document.getElementById("inputNewPassword").value
    let confirmPassword = document.getElementById("inputConfirmPassword").value
    let errorConfirmPassword = document.getElementById("errorConfirmPassword")
    if ( confirmPassword != "" && confirmPassword != newPassword ) {
        errorConfirmPassword.innerHTML = "Las contraseñas no coinciden"
        return errorConfirmPassword.classList.remove("hide")
    }
    errorConfirmPassword.innerHTML = ""
    return errorConfirmPassword.classList.add("hide")
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



// funciones edicion datos perfil
function editarPerfilCompleto(){
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
function validarCampoFormulario(idCampo, idError){
    let botonEditar = document.getElementById("botonEditar")
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
                    campoError.innerHTML = ""
                    campoError.classList.add("hide")
                }
            }
        break;
        case "segundoNombrePerfil":
            if(value.trim() != ""){
                if (value.length < 3) {
                    campoError.innerHTML = "Mínimo 3 dígitos"
                } else {
                    if (!soloLetras(value)){
                        campoError.innerHTML = "Solo letras y espacios"
                    } else {
                        campoError.innerHTML = ""
                        campoError.classList.add("hide")
                    }
                }
            } else{
                campoError.innerHTML = ""
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
                    campoError.innerHTML = ""
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
                campoError.innerHTML = ""
                campoError.classList.add("hide")
            }
        break;  
        default:
        break;
    }  
}
function validarFormulario () {
    let botonEditar = document.getElementById("botonEditar")
    botonEditar.setAttribute("disabled", true)
    let errorNombre = document.getElementById("errorNombrePerfil").innerHTML
    let errorSegundoNombre = document.getElementById("errorSegundoNombrePerfil").innerHTML
    let errorApellido = document.getElementById("errorApellidoPerfil").innerHTML
    let errorMail = document.getElementById("errorMailPerfil").innerHTML
    if(errorNombre == "" && errorSegundoNombre == "" && errorApellido == "" && errorMail == "") {
        botonEditar.removeAttribute("disabled")
    }
}


</script>