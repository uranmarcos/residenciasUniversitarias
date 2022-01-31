<?php
require("funciones/pdo.php");
$alertError = "hide";
$mensajeError = "";
$alertConfirmacion="hide";
$mensajeAlertConfirmacion = "";
if (isset($_COOKIE["errorRecuperar"])) {
    if ($_COOKIE["errorRecuperar"]){
        $alertError = "show";
        $mensajeError = "Hubo un error de conexión. <br> Por favor intentá nuevamente.";
    }
}
setcookie("errorRecuperar", false, time() + (1000), "/");
if (isset($_POST["recuperar"])) {
    $mail = $_POST["mail"];
    $consulta = $baseDeDatos ->prepare("SELECT * FROM agentes WHERE mail = '$mail'");
    try {
        $consulta->execute();
        $datosUsuarios = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        if (count($datosUsuarios) == 0) {
            $alertError = "show";
            $mensajeError = "El mail ingresado no se encuentra registrado";
        } else {
            $token = bin2hex(openssl_random_pseudo_bytes((10 - (4 % 2)) / 2));   
            date_default_timezone_set('America/Argentina/Cordoba');
            $fechaCreated = new DateTime();
            $created =  $fechaCreated->format('Y-m-d H:i:s');
            $fechaExpired = new DateTime();
            $fechaExpired->modify("+30 minute")->format("Y-m-d h:i:s");
            $expired =  $fechaExpired->format('Y-m-d H:i:s');
            $horaExpired = $fechaExpired->format('H:i:s');
            // verifico si existe en recupero el mail para consulta tipo insert o update
            $consultaMailRecupero = $baseDeDatos ->prepare("SELECT * FROM recuperos WHERE mail = '$mail'");
            try {
                $consultaMailRecupero -> execute();
                $recupero = $consultaMailRecupero -> fetchAll(PDO::FETCH_ASSOC);
                if (count($recupero) >= 1) {
                    $consultaToken = $baseDeDatos ->prepare("UPDATE recuperos SET token = '$token', created = '$created', expired = '$expired', vigente = 1 WHERE mail = '$mail'"); 
                } else {
                    $consultaToken = $baseDeDatos ->prepare("INSERT into recuperos VALUES(default, '$mail', '$token', '$created', '$expired', 1)"); 
                }
                try {
                    $consultaToken->execute();
                    include("mailRecuperoPassword.php");
                    $alertConfirmacion = "show";
                    $mensajeAlertConfirmacion = "Te enviamos un mail con los pasos para realizar el cambio de contraseña. Podrás realizarlo durante 30 minutos. <br> No olvides revisar el spam si no recibes el mail.";
                } catch (\Throwable $th) {
                    $alertError = "show";
                    $mensajeError = "Hubo un error de conexión. <br> Por favor intentá nuevamente.";
                }
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
                        <form class="col-12 pb-0" action="recuperar.php" method="POST"> 
                            <div class="alert alert-danger alertBorder centrarTexto <?php echo $alertError ?>" id="alertErrorConexion" role="alert" >
                               <?php echo $mensajeError ?>
                            </div>
                            <div class="alert alert-success alertBorder centrarTexto <?php echo $alertConfirmacion?>" id="alertConfirmacion" role="alert">
                                <?php echo $mensajeAlertConfirmacion ?>
                            </div>
                            <div class="tituloRecuperar">
                                RECUPERÁ TU CONTRASEÑA
                            </div>
                            <div class="row rowForm">
                                <label class="col-12 col-md-9 centrarTexto textoLabel" for="user" > Ingresá tu correo electrónico </label>
                            </div>
                            <div class="row rowForm mb-3">
                                <input class="col-12 col-md-9 inputLabel" autocomplete="off" onkeyup="validarForm()"  type="mail" name="mail" id="mail">
                                <div class="hide col-12 col-md-9 centrarTexto errorValidacion" id="errorMail"></div>
                            </div> 
                            <div class="row justify-content-center" >
                                <input type="submit" class="col-6 botonSubmit" id="botonRecuperar" onmouseover="validarForm()" onclick="recuperarPass()" name="recuperar" value="Recuperar">
                                <button type="button" class="col-6 hide botonSubmit" id="botonLoading" >
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </button>
                            </div>  
                            <div class="row rowForm mt-2">
                               <label class="recuperar"><a href="index.php">Volver</a></label>
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
    function isEmailAddress(str) {
        var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return pattern.test(str);  // returns a boolean
    }
</script>