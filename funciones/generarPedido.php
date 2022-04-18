<?php 
$modalPedidoNoGenerado = "hide";
$modalPedidoNoEnviado = "hide";
$modalPedidoNoActualizado = "hide";
$idPedido = null;
// START FUNCIONES GENERACION DE PEDIDO
    
// BOTON CONFIRMACION DE GENERAR PEDIDO
if(isset($_POST["generarPedido"])){
    //ARMO PEDIDO PARA LA BDD RECORRIENDO INPUT DEL FORMULARIO Y CAMPO OTROS
    $pedido = "";
    for($i = 1; $i<= 6; $i++ ){
        if(isset($_POST[$i])){
            if($_POST[$i] != 0) {
                $pedido = $pedido . $i . ":" . $_POST[$i] . ";";
            }
        }
    }
    if($_POST["otros"] != ""){
        $pedido = $pedido . "otros:" . $_POST["otros"] . ";";  
    }
    
    //GUARDO EL PEDIDO EN BASE DE DATOS 
    $insertPedido = $baseDeDatos ->prepare("INSERT into pedidosnuevos VALUES(default, '$sede', '$casa', '$idUser', '$pedido', 0, '$date')"); 
    try {
        $insertPedido->execute();
        $pedidoGuardado = true;
    } catch (\Throwable $th) {
        $modalPedidoNoGenerado ="show";
    }
    
    // SI EL PEDIDO SE GUARDO EN BASE DE DATOS CONTINUO PARA GENERAR EL PDF
    if($pedidoGuardado){
        try {
            // CONSULTO EL ID DEL PEDIDO GUARDO PARA GENERAR EL PDF Y ENVIAR EL MAIL
            $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
            $consultaUltimoPedido->execute();
            $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
            $idPedido = $id[0]["id"];
            $tipoMail = "envio";
            $sedePedido = $sede[0]["provincia"] . ", " . $sede[0]["localidad"];
            require("funciones/pdf.php");
            require("funciones/pdfMail.php");
            include("mail.php");
            $pedidoEnviado = true;
        } catch (\Throwable $th) {
            $modalPedidoNoGenerado ="show";
        }
    }
    if($pedidoEnviado) {
        // SI EL PEDIDO SE ENVIO, ACTUALIZO EN BASE DE DATOS EL CAMPO "ENVIADO"
        try {
            $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
            $consultaUltimoPedido->execute();
            $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
            $id = $id[0]["id"];
            $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1 WHERE id = '$idPedido'"); 
            $consultaEnviado->execute();
            $pedidoActualizado = true;
        } catch (\Throwable $th) {
            $modalPedidoNoActualizado ="show";
        }
    }
}

// CUANDO SE ENVIA EL PEDIDO PERO NO SE ACTUALIZO COMO ENVIADO
if(isset($_POST["actualizarEnviado"])){
    try {
        $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
        $consultaUltimoPedido->execute();
        $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
        $id = $id[0]["id"];
        $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1 WHERE id = '$id'"); 
        $consultaEnviado->execute();
        $pedidoActualizado = true;
    } catch (\Throwable $th) {
        $modalPedidoNoActualizado ="show";
    }
}


if($pedidoActualizado) {
    setcookie("pedidoEnviado", true, time() + (86400 * 30), "/");
    echo "<script>location.href='pedidos.php';</script>";
}
if($_SESSION["errorMail"]){
    $modalPedidoNoEnviado ="show";
    $_SESSION["errorMail"] = false;
}