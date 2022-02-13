<?php 
$modalPedidoNoGenerado = "hide";
$modalPedidoNoEnviado = "hide";
$modalPedidoNoActualizado = "hide";
// START FUNCIONES GENERACION DE PEDIDO
    
// BOTON CONFIRMACION DE GENERAR PEDIDO
if(isset($_POST["botonConfirmar"])){
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
    // EJECUTO INSERT DEL PEDIDO EN TABLA PEDIDOS
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
            $id = $id[0]["id"];
            $tipoMail = "envio";
            require("funciones/pdf.php");
            require("funciones/pdfMail.php");
            include("mail.php");
            $pedidoEnviado = true;
        } catch (\Throwable $th) {
            $modalPedidoNoEnviado = "show";
        }
    }
    if($pedidoEnviado) {
        // SI EL PEDIDO SE ENVIO, ACTUALIZO EN BASE DE DATOS EL CAMPO "ENVIADO"
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
}

    if(isset($_POST["botonReenviar"])){
        echo "reenvio";
        try {
            // CONSULTO EL ID DEL PEDIDO GUARDO PARA GENERAR EL PDF Y ENVIAR EL MAIL
            $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
            $consultaUltimoPedido->execute();
            $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
            $id = $id[0]["id"];
            $tipoMail = "envio";
            require("funciones/pdf.php");
            require("funciones/pdfMail.php");
            include("mail.php");
            $pedidoEnviado = true;
        } catch (\Throwable $th) {
            $modalPedidoNoEnviado ="show";
        }
        if($pedidoEnviado) {
            // SI EL PEDIDO SE ENVIO, ACTUALIZO EN BASE DE DATOS EL CAMPO "ENVIADO"
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
    }
    if(isset($_POST["actualizarEnviado"])){
        try {
            $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
            $consultaUltimoPedido->execute();
            $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
            $id = $id[0]["id"];
            $modalActualizacion = "hide";
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