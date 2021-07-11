<?php 

function ocultarBloques(){
    $mostrarInicio = "none";
    $mostrarAdmin = "none";
}
$pedidoGuardado = false;
function enviarMail(){
     //----PEDIDO QUE SE GENERA
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
    //----INFO A MANDAR POR MAIL
    $fecha = getDate();
    $day = $fecha["mday"];
    $month = $fecha["month"];
    $year = $fecha["year"];
    $pedidoMail = $_SESSION["sede"] . " - Casa " . $_SESSION["casa"] . " - " . $_SESSION["name"] . " " . $_SESSION["apellido"] . "<br>".
        $day . "/" . $month . "/" . $year . " - " . "<br>";
    
    foreach($pedido as $p){
       $pedidoMail = $pedidoMail . $p["producto"] . ": " . $p["cantidad"] . ",<br>"; 
    }
    $message = $pedidoMail;
   
    //ALMACENO EN PEDIDO QUE VIENE DE JSON EL PEDIDO NUEVO
    $pedidosAnteriores = file_get_contents("json/pedidos.json");
    $data = json_decode($pedidosAnteriores);
    $pedidoGenerado[] = [
            "id" => count($data) + 1,
            "sede" => $_SESSION["sede"],
            "casa" => $_SESSION["casa"],
            "nombre" => $_SESSION["name"] ." " . $_SESSION["apellido"],
            "fecha" => getDate(),
            "pedido" => $pedido
    ];
    array_push($data, $pedidoGenerado);
    try{
        $json_string = json_encode($data);
        file_put_contents("json/pedidos.json", $json_string);
        $pedidoGuardado = true;
    }catch(\Exception $e){
        $mostrarInicio = "none";
        $mostrarBloque = "block";
        $bloque = "main/error.php";
        return;
    }
    if($pedidoGuardado == true){
        try{
            include("mail.php");
        }catch(Exception $e){
            header("Location: error.php");
            echo $e;
            return;
        }
    }
}


function enviarMail2(){
     //----PEDIDO QUE SE GENERA
    $pedido = [];
    foreach($_POST as $producto => $cantidad){
        if($cantidad != 0 && $producto["id"] != "otros"){
            $p = [];
            $p["id"] = $producto;
            $p["cantidad"]= $cantidad;
            array_push($pedido, $p);
        };
    }
    if(($_POST["otros"]) != ""){
        $otros = [];
        $otros["id"] = "Otros";
        $otros["cantidad"] = $_POST["otros"];        
        array_push($pedido, $otros);
    }
 
    //----INFO A MANDAR POR MAIL
    $fecha = getDate();
    $pedidoMail = $_SESSION["sede"] . " - Casa " . $_SESSION["casa"] . " - " . $_SESSION["name"] . " " . $_SESSION["apellido"] . "<br>";
        // $day . "/" . $month . "/" . $year . " - " . "<br>";
    $listado = "";
    foreach($pedido as $p){
        if($p["id"] != "Otros"){
            $key = array_search($p["id"], array_column($_SESSION["productos"], "id"));
            $prod = $_SESSION["productos"][$key];
            $listado = $listado . $prod["producto"] . ": " . $p["cantidad"] . " " . $prod["medida"] . ",<br>"; 
        }
        if($p["id"] == "Otros"){
            $listado = $listado . "Otros: " . $p["cantidad"] . ",<br>"; 
        }
    }
    $message = $pedidoMail . $listado;
   
    //ALMACENO EN PEDIDO QUE VIENE DE JSON EL PEDIDO NUEVO
    $pedidosAnteriores = file_get_contents("json/pedidos.json");
    $data = json_decode($pedidosAnteriores);
    $pedidoGenerado[] = [
            "id" => count($data) + 1,
            "sede" => $_SESSION["sede"],
            "casa" => $_SESSION["casa"],
            "nombre" => $_SESSION["name"] ." " . $_SESSION["apellido"],
            "fecha" => getDate(),
            "pedido" => $listado
    ];
    array_push($data, $pedidoGenerado);
    try{
        $json_string = json_encode($data);
        file_put_contents("json/pedidos.json", $json_string);
        $pedidoGuardado = true;
    }catch(\Exception $e){
        $mostrarInicio = "none";
        $mostrarBloque = "block";
        $bloque = "main/error.php";
        return;
    }
    if($pedidoGuardado == true){
        try{
            include("mail.php");
        }catch(Exception $e){
            header("Location: error.php");
            echo $e;
            return;
        }
    }
}







