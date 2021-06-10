<?php
session_start();
require("funciones/pdo.php");
require("funciones/funciones.php");

$mostrarInicio = "block";
$mostrarBloque = "none";
$bloque = "";

if(isset($_POST["iniciarPedido"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["admin"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/admin.php";
}
if(isset($_POST["pedidosAnteriores"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/pedidosAnteriores.php";
}
if(isset($_POST["cerrarSesion"])){
    header("Location: destroy.php");
}
if(isset($_POST["modificarPedido"])){
    header("Location: pedido.php");
}
if(isset($_POST["crearUsuario"])){
    header("Location: admin.php");
}
if(isset($_POST["crearArticulo"])){
    header("Location: admin.php");
}
$pedido = [];

$mostrarPedido = "none";
$mensajePedido = "";
if(isset($_POST["confirmar"])){
        
    // PEDIDO QUE SE GENERA
    $pedido = [];
    foreach ($_POST["articulo"] as $producto){
        if($producto["cantidad"] != 0){
            array_push($pedido, $producto);
        }  
    }
    // array_push($pedido, $_POST["otros"]);
    if(($_POST["otros"]) != ""){
        $otros = [];
        $otros["producto"] = "Otros";
        $otros["cantidad"] = $_POST["otros"];
        $otros["medida"] = "";
        
        array_push($pedido, $otros);
    }
    
    

    //para mandar por mail
    $fecha = getDate();
    $day = $fecha["mday"];
    $month = $fecha["month"];
    $year = $fecha["year"];
    $hora = $fecha["hours"];
    $minutos = $fecha["minutes"];
    $segundos = $fecha["seconds"];
        
    $pedidoMail = $_SESSION["sede"] . " - Casa " . $_SESSION["casa"] . " - " . $_SESSION["name"] . " " . $_SESSION["apellido"] . "<br>".
        $day . "/" . $month . "/" . $year . " - " . $hora . ":" . $minutos . "hs.<br>";
    
    foreach($pedido as $p){
       $pedidoMail = $pedidoMail . $p["producto"] . ": " . $p["cantidad"] . " " . $p["medida"] . ",<br>"; 
    }

    
    $message = $pedidoMail;
   
    //ALMACENO EN PEDIDO QUE VIENE DE JSON EL PEDIDO NUEVO
    $pedidosAnteriores = file_get_contents("json/pedidos.json");
    $data = json_decode($pedidosAnteriores);
    $pedidoGenerado[] = [
            "sede" => $_SESSION["sede"],
            "casa" => $_SESSION["casa"],
            "nombre" => $_SESSION["name"] ." " . $_SESSION["apellido"],
            "fecha" => getDate(),
            "pedido" => $pedido
    ];
    array_push($data, $pedidoGenerado);
  
    try{
        // $json_string = json_encode($pedido);
        // $file = 'json/pedidos.json';
        // file_put_contents($file, $json_string, FILE_APPEND);
        $json_string = json_encode($data);
        file_put_contents("json/pedidos.json", $json_string);
        // echo $message;
        include("mail.php");
        // mail($to, $subject, $message);
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
                <!-- ASIDE -->            
                <aside class="col-12 aside col-md-3">
                    <nav class="row centrarTexto navAside">
                        <div class="col-12">
                            MENU              
                        </div>    
                    </nav> 
                    <?php require("aside/aside.php") ?>
                </aside> 
                <!-- MAIN -->
                <main class="col-12 col-md-9">
                    <nav class="row navHome justify-content-around ">
                        <div class="col-12 alignRight">
                            <p>Hola <?php echo $_SESSION["name"]?>!</p>
                        </div>    
                    </nav> 
                    <div class="section" style="display: <?php echo $mostrarInicio ?>">
                        <div class="logoInicio">
                           
                        </div>
                    </div>
                    <div class="section" style="display: <?php echo $mostrarBloque ?>">
                        <div>
                            <?php require($bloque) ?>
                        </div>
                    </div>
                  
                </main>        
            </div>        
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script type="text/javascript"  src="js/admin.js"></script>        

    </body>
</html>