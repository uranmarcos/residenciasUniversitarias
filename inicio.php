<?php
session_start();
require("funciones/pdo.php");

// $mostrarConfirmacion = "none";

if(isset($_POST["iniciarPedido"])){
    header("Location: pedido.php");
}
if(isset($_POST["admin"])){
    header("Location: admin.php");
}
if(isset($_POST["cerrarSesion"])){
    header("Location: destroy.php");
}
if(isset($_POST["modificarPedido"])){
    header("Location: pedido.php");
}
$pedido = [];
$mostrarInicio = "block";
$mostrarPedido = "none";
$mensajePedido = "";
if(isset($_POST["confirmar"])){
    $pedido["sede"] = $_SESSION["sede"];
    $pedido["casa"] = $_SESSION["casa"];
    $pedido["nombre"] = $_SESSION["name"];
    $pedido["apellido"] = $_SESSION["apellido"];
    $pedido["fecha"] = getDate();

    foreach ($_POST["articulo"] as $producto){
        if($producto["cantidad"] != 0){
            array_push($pedido, $producto);
        }  
    }
   
    try{
        $json_string = json_encode($pedido);
        $file = 'json/pedidos.json';
        file_put_contents($file, $json_string, FILE_APPEND);
    }catch(Exception $e){
        header("Location: error.php");
        echo $e;
        return;
    }
    $mensajePedido="Listo! El pedido se realizó correctamente!";
    $mostrarInicio = "none";
    $mostrarPedido = "block";
}


?>
<html>
    <head>
        <title>Pedidos Sí</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="css/master.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="row contenedorSecundario">               
                <aside class="col-12 aside col-md-3">
                    <nav class="row centrarTexto navAside">
                        <div class="col-12">
                            MENU              
                        </div>    
                    </nav> 
                    <?php require("componentes/aside.php") ?>
                </aside> 
                <main class="col-12 col-md-9">
                    <nav class="row navHome justify-content-around ">
                        <div class="col-12 alignRight">
                            <p>Hola <?php echo $_SESSION["name"]?>!</p>
                        </div>    
                    </nav> 
                    <div class="section">
                        <div class="logoInicio" style="display: <?php echo $mostrarInicio ?>">
                           
                        </div>
                        <div style="display: <?php echo $mostrarPedido ?>">
                            <div class="bloque">
                                <div class="cajaInternaPedido">
                                    <?php echo $mensajePedido ?>
                                </div>    
                            </div>                   
                        </div>
                     
                    </div>
                </main>        
            </div>        
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>