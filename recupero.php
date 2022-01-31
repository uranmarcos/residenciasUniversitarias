<?php
require("funciones/pdo.php");
$alertError = "hide";
$mensajeError = "";
$alertConfirmacion="hide";
$mensajeAlertConfirmacion = "";

if (isset($_POST["recuperar"])) {
    $mail = $_POST["mail"];
    $token = $_POST["token"];
    $pass = password_hash($_POST["inputNewPassword"], PASSWORD_DEFAULT);
    $consulta = $baseDeDatos ->prepare("SELECT * FROM recuperos WHERE mail = '$mail'");
    date_default_timezone_set('America/Argentina/Cordoba');
    $date = new DateTime();
    $date =  $date->format('Y-m-d H:i:s');
    try {
        $consulta->execute();
        $datosRecupero = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        if (count($datosRecupero) == 0) {
            $alertError = "show";
            $mensajeError = "No se encontró un pedido de recupero de contraseña para el mail ingresado";      
        } else if ($datosRecupero[0]["expired"] < $date) {
            $alertError = "show";
            $mensajeError = "El código de validación ya expiró.";     
        } else if ( $datosRecupero[0]["vigente"] != 1) {
            $alertError = "show";
            $mensajeError = "El código de validación ya fue utilizado.";
        } else if ( $datosRecupero[0]["token"] != $token) {
            $alertError = "show";
            $mensajeError = "El código de validación ingresado es incorrecto.";
        } else{
            $cambiarPassword = $baseDeDatos ->prepare("UPDATE agentes SET password = '$pass' WHERE mail = '$mail'");
            $actualizarRecupero = $baseDeDatos ->prepare("UPDATE recuperos SET vigente = 0 WHERE mail = '$mail'"); 
            try {
                $cambiarPassword -> execute();
                $actualizarRecupero -> execute();
                $alertConfirmacion = "show";
                $mensajeAlertConfirmacion = "La contraseña se modificó exitosamente.";
            } catch (\Throwable $th) {
                $alertError = "show";
                $mensajeError = "Hubo un error de conexión. <br> Por favor intentá nuevamente.";
            }
        }
    } catch (\Throwable $th) {
        $alertError = "show";
        $mensajeError = "Hubo un error de conexión. <br> Por favor intentá nuevamente.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
      <title>Pedidos Sí</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.8">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <link href="css/index.css" rel="stylesheet">
    </head>
    <body>
        <main class="container">
            <div class="row cajaForm justify-content-center">
                <div class="col-10 col-md-8  col-xl-6 contenedorRecuperar">
                    <!-- caja botones login y registro  -->
                    <div class="row">
                        <form class="col-12 pb-0" action="recupero.php" method="POST"> 
                            <div class="alert alert-danger alertBorder centrarTexto <?php echo $alertError ?>" id="alertErrorConexion" role="alert" >
                               <?php echo $mensajeError ?>
                            </div>
                            <div class="alert alert-success alertBorder centrarTexto <?php echo $alertConfirmacion?>" id="alertConfirmacion" role="alert">
                                <?php echo $mensajeAlertConfirmacion ?>
                            </div>
                            <div class="tituloRecuperar">
                                RECUPERÁ TU CONTRASEÑA
                            </div>
                            <!-- CORREO ELECTRONICO -->
                            <div class="row rowForm">
                                <label class="col-12 col-md-9 centrarTexto textoLabel" for="user" > Ingresá tu correo electrónico </label>
                            </div>
                            <div class="row rowForm mb-2">
                                <input class="col-12 col-md-9 inputRecupero" autocomplete="off" onkeyup="validarMail()"  type="mail" name="mail" id="mail">
                                <div class="hide col-12 col-md-9 centrarTexto errorValidacion" id="errorMail"></div>
                            </div> 
                            <!-- TOKEN -->
                            <div class="row rowForm">
                                <label class="col-12 col-md-9 centrarTexto textoLabel" for="user" > Ingresá el código de validación </label>
                            </div>
                            <div class="row rowForm mb-2">
                                <input class="col-12 col-md-9 inputRecupero" autocomplete="off" onkeyup="validarToken()"  type="text" name="token" id="token">
                                <div class="hide col-12 col-md-9 centrarTexto errorValidacion" id="errorToken"></div>
                            </div>
                            <!-- NUEVA CONTRASEÑA --> 
                            <div class="row rowForm">
                                <label class="col-12 col-md-9 centrarTexto textoLabel">Ingresá tu nueva contraseña </label>
                            </div>
                            <div class="row rowForm mb-2">
                                <input class="col-10 col-md-8 inputRecupero" autocomplete="off" maxlength="12" type="password" onkeyup="validarPassword('inputNewPassword', 'errorNewPassword')" name="inputNewPassword" autocomplete="off" id="inputNewPassword"> 
                                <div class="col-1 eyeButton" id="mostrarContrasenia" onclick="mostrarContrasenia('mostrarContrasenia', 'inputNewPassword', 'ocultarContrasenia')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </div>
                                <div class="col-1 hide eyeButton" id="ocultarContrasenia" onclick="ocultarContrasenia('mostrarContrasenia', 'inputNewPassword', 'ocultarContrasenia')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                    </svg>
                                </div>
                                <div class="hide col-12 col-md-9 centrarTexto errorValidacion" id="errorNewPassword"></div>
                            </div>
                            <!-- CONFIRMACION NUEVA CONTRASEÑA -->
                            <div class="row rowForm">
                                <label class="col-12 col-md-9 centrarTexto textoLabel">Repetí tu nueva contraseña </label>
                            </div>
                            <div class="row rowForm mb-2">
                                <input class="col-10 col-md-8 inputRecupero" autocomplete="off" maxlength="12" type="password" onkeyup="validarPassword('inputConfirmPassword', 'errorConfirmPassword')" name="inputConfirmPassword" autocomplete="off" id="inputConfirmPassword"> 
                                <div class="col-1 eyeButton" id="mostrarConfirmContrasenia"Confirm onclick="mostrarContrasenia('mostrarConfirmContrasenia', 'inputConfirmPassword', 'ocultarConfirmContrasenia')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </div>
                                <div class="col-1 hide eyeButton" id="ocultarConfirmContrasenia" onclick="ocultarContrasenia('mostrarConfirmContrasenia', 'inputConfirmPassword', 'ocultarConfirmContrasenia')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                    </svg>
                                </div>
                                <div class="hide col-12 centrarTexto errorValidacion" id="errorConfirmPassword">Las contraseñas no coinciden</div>
                            </div>              
                            <div class="row justify-content-center mt-4" >
                                <input type="submit" class="col-6 botonSubmit" id="botonRecuperar" onmouseover="validarForm()" name="recuperar" value="Recuperar">
                                <button type="button" class="col-6 hide botonSubmit" id="botonLoading" >
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </button>
                            </div>   
                            <div class="row rowForm mt-2">
                               <label class="recuperar"><a href="index.php">Login</a></label>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>    
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>
<script>
    window.onload = function(){
        let alertConfirmacion = document.getElementById("alertConfirmacion")
        if (alertConfirmacion.classList.contains('show')) {
            setTimeout(ocultarAlertConfirmacion, 10000)
        }
        let alertErrorConexion = document.getElementById("alertErrorConexion")
        if (alertErrorConexion.classList.contains('show')) {
            setTimeout(ocultarAlertError, 10000)
        }
    }
    function ocultarAlertConfirmacion(){
        let alertConfirmacion = document.getElementById("alertConfirmacion")
        alertConfirmacion.classList.remove('show')
        alertConfirmacion.classList.add('hide')
    }
    function ocultarAlertError(){
        let alertErrorConexion = document.getElementById("alertErrorConexion")
        alertErrorConexion.classList.remove('show')
        alertErrorConexion.classList.add('hide')
    }
    function recuperarPass() {
        console.log("recuperar")
        let botonRecuperar = document.getElementById("botonRecuperar")
        let botonLoading = document.getElementById("botonLoading")
        botonRecuperar.classList.add("hide")
        botonLoading.classList.remove("hide")
    }
    function validarForm(){
        validarMail()
        validarToken()
        validarPassword('inputNewPassword', 'errorNewPassword')
        validarPassword('inputConfirmPassword', 'errorConfirmPassword')
    }
    function validarMail(){
        let mail = document.getElementById("mail").value
        if ((mail.trim() == "")){
            document.getElementById("errorMail").classList.remove("hide")
            document.getElementById("errorMail").innerHTML = "Campo requerido"
            let botonRecuperar = document.getElementById("botonRecuperar")
            botonRecuperar.setAttribute("disabled", true)
        } else {
            if (!isEmailAddress(mail)){
                document.getElementById("errorMail").classList.remove("hide")
                document.getElementById("errorMail").innerHTML = "Formato incorrecto"
                let botonRecuperar = document.getElementById("botonRecuperar")
                botonRecuperar.setAttribute("disabled", true)
            } else {
                document.getElementById("errorMail").classList.add("hide")
                document.getElementById("botonRecuperar").removeAttribute("disabled")
            }

        }
    }
    function validarToken(){
        let token = document.getElementById("token").value
        if ((token.trim() == "")){
            document.getElementById("errorToken").classList.remove("hide")
            document.getElementById("errorToken").innerHTML = "Campo requerido"
            let botonRecuperar = document.getElementById("botonRecuperar")
            botonRecuperar.setAttribute("disabled", true)
        } else {
            document.getElementById("errorToken").classList.add("hide")
            document.getElementById("botonRecuperar").removeAttribute("disabled")
        }
    }
    function mostrarContrasenia(idBotonOcultar, idInput, idBotonMostrar){
        let botonOcultar = document.getElementById(idBotonOcultar)
        let input = document.getElementById(idInput)
        input.setAttribute("type", "text")
        botonOcultar.classList.add("hide")
        let botonMostrar = document.getElementById(idBotonMostrar)
        botonMostrar.classList.remove("hide")
    }
    function ocultarContrasenia(idBotonMostrar, idInput, idBotonOcultar){
        let boxMostrarContrasenia = document.getElementById(idBotonMostrar)
        let inputNewPassword = document.getElementById(idInput)
        inputNewPassword.setAttribute("type", "password")
        boxMostrarContrasenia.classList.remove("hide")
        let boxOcultarContrasenia = document.getElementById(idBotonOcultar)
        boxOcultarContrasenia.classList.add("hide")
    }
    function isEmailAddress(str) {
        var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return pattern.test(str);  // returns a boolean
    }
    function compararContrasenias () {
        let newPassword = document.getElementById("inputNewPassword").value
        let confirmPassword = document.getElementById("inputConfirmPassword").value
        let errorConfirmPassword = document.getElementById("errorConfirmPassword")
        if ( confirmPassword != "" && confirmPassword != ""  && confirmPassword != newPassword ) {
            errorConfirmPassword.innerHTML = "Las contraseñas no coinciden"
            return  errorConfirmPassword.classList.remove("hide")
        }
        errorConfirmPassword.classList.add("hide")
    }
    function validarPassword(idInput, idError) {
        let newPassword = document.getElementById(idInput).value
        let errorNewPassword = document.getElementById(idError)
        if ( newPassword.trim() == "") {
            errorNewPassword.innerHTML = "Campo requerido"
            return errorNewPassword.classList.remove("hide") 
        }
        if ( newPassword.trim().length < 8 && newPassword != "") {
            errorNewPassword.innerHTML = "Mínimo 8 caracteres"
            return errorNewPassword.classList.remove("hide") 
        }
        errorNewPassword.classList.add("hide")
        compararContrasenias()
    }

</script>