<?php
session_start();
require("funciones/pdo.php");

$error = "";

if($_POST){
    if(isset($_POST["ingresar"])){
        require("funciones/validarLogin.php");
        // header("Location:http://localhost/repositorioPedidos/componentes/home.php");
    }
}



?>
<script>
    localStorage.clear();
</script>
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
                <div class="col-10 col-md-6 col-xl-4">
                    <!-- caja botones login y registro  -->
                    <div class="row">
                    <img src="img/si.jpg">
                        <form class="col-12" action="index.php" method="POST">
                            
                            <div class="row rowForm">
                                <label class="col-12 col-md-9 textoLabel" for="user"> DNI: </label>
                            </div>
                            <div class="row rowForm">
                                <input class="col-12 col-md-9 inputLabel" type="text" name="dni" value="">
                            </div>
                            <div class="row rowForm">
                                <label for="password" class="textoLabel col-12 col-md-9"> Contraseña: </label>
                            </div>
                            <div class="row rowForm">                                
                                <input class="col-12 col-md-9 inputLabel" type="text" name="password" value="">
                            </div>
                            <div class="mensajeError"> <?php echo $error ?> </div>
                            <div class="row justify-content-center" >
                                <input type="submit" class="col-6 botonSubmit" name="ingresar" value="Ingresar">
                            </div>     
                        </form>
                    </div>
                </div>
            </div>    
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>