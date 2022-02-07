<?php 

    // $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcio, M.descripcion medida, C.descripcion categoria  FROM articulos A 
    // INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id ORDER BY descripcion ASC");
    // try {
    //     $consultaProductos->execute();
    // } catch (\Throwable $th) {
    //     $alertErrorConexion= "show";
    //   //  return $alertErrorConexion;
    // }
    // $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // //return $productos;
// START VARIABLES UTILIZADAS //
$alertErrorConexion = "hide";
$alertConfirmacion = "hide";
$mensajeAlertConfirmacion="";
$pedidoEnviado = false;
$pedidoActualizado = false;
$sede = $_SESSION["sede"];
$casa = $_SESSION["casa"];
$noHayDatos = "show";
$hayDatos = "hide";
$mostrarStock = "hide";
$mostrarAdmin = "hide";    
$modalActualizacion = "hide";
$idPorActualizar = null;

// START ACCION VER PDF - ABRIR PEDIDO //        
if(isset($_POST["verPedido"])){
  $id = $_POST["id"];
  try {
    require("funciones/pdf.php");
    require("funciones/armarPdf.php");
    echo '<script>window.open("_blank")</script>';
  } catch (\Throwable $th) {
    $alertErrorConexion ="show";
    $mensajeAlertError = "Hubo un error de conexión y el pedido no pudo reenviarse. Por favor intentalo nuevamente.";
  }
}
// END ACCION VER PDF - ABRIR PEDIDO //  

// START MOSTRAR ALERT PARA PEDIDO ENVIADO //  
if(isset($_COOKIE["pedidoEnviado"])){
  if ($_COOKIE["pedidoEnviado"]) {
    $alertConfirmacion = "show";
    $mensajeAlertConfirmacion="El pedido se envió correctamente.";
    setcookie("pedidoEnviado", false, time() + (86400 * 30), "/");
  }
}
// END MOSTRAR ALERT PARA PEDIDO ENVIADO //  
    

// START REENVIAR PEDIDO //
if(isset($_POST["botonReenviarPedido"])){
  $id = $_POST["idReenviarPedido"];
  try {
    $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos  WHERE id = '$id'"); 
    $consultaUltimoPedido->execute();
    $tipoMail = "reenvio";
    require("funciones/pdf.php");
    require("funciones/pdfMail.php");
    include("mail.php");
    $pedidoEnviado = true;
  } catch (\Throwable $th) {
    $alertErrorConexion ="show";
    $mensajeAlertError = "Hubo un error de conexión y el pedido no pudo reenviarse. Por favor intentalo nuevamente.";
  }
        
  // SI EL PEDIDO SE ENVIO, ACTUALIZO EN BASE DE DATOS EL CAMPO "ENVIADO"
  if($pedidoEnviado) {
    try {
      date_default_timezone_set('America/Argentina/Cordoba');
      $date = date("Y-m-d h:i:s");
      $usuario = $_SESSION["id"];
      $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1, usuario = '$usuario', fecha = '$date' WHERE id = '$id'"); 
      $consultaEnviado->execute();
      $pedidoActualizado = true;
    } catch (\Throwable $th) {
      $idPorActualizar = $id;
      $modalActualizacion ="show";
    }
  }
}

// SI EL PEDIDO SE ENVIO, PERO NO SE ACTUALIZO EN BASE DE DATOS COMO ENVIADO
if(isset($_POST["actualizarEnviado"])){
  $id = $_POST["idActualizarPedido"];
  try {
    date_default_timezone_set('America/Argentina/Cordoba');
    $date = date("Y-m-d h:i:s");
    $usuario = $_SESSION["id"];
    $modalActualizacion = "hide";
    $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1, usuario = '$usuario', fecha = '$date'  WHERE id = '$id'"); 
    $consultaEnviado->execute();
    $pedidoActualizado = true;
  } catch (\Throwable $th) {
    $idPorActualizar = $id;
    $modalActualizacion ="show";
  }
}
if($pedidoActualizado) {
  $alertConfirmacion = "show";
  $mensajeAlertConfirmacion="El pedido se envió correctamente.";
}
if($_SESSION["errorMail"]){
  $alertErrorConexion ="show";
  $mensajeAlertError = "Hubo un error de conexión y el pedido no pudo reenviarse. Por favor intentalo nuevamente.";
  $_SESSION["errorMail"] = false;
}

    
    
//START CONSULTA DE PEDIDOS REALIZADOS
if($_SESSION["rol"] == "stock") {
  $sede = $_SESSION["sede"];
  $consultaPedidos = $baseDeDatos ->prepare("SELECT PN.id, PN.sede, PN.fecha, PN.enviado, PN.casa, A.nombre, A.segundoNombre, A.apellido, S.descripcion nombreSede FROM pedidosnuevos PN INNER JOIN
    agentes A ON PN.usuario = A.id INNER JOIN sedes S on PN.sede = S.id WHERE PN.sede = $sede AND PN.casa = $casa ORDER BY PN.fecha DESC"); 
    $mostrarStock = "show";   
} else {
  $consultaPedidos = $baseDeDatos ->prepare("SELECT PN.id, PN.sede, PN.fecha, PN.enviado, A.nombre, PN.casa, A.segundoNombre, A.apellido, S.descripcion nombreSede FROM pedidosnuevos PN INNER JOIN
    agentes A ON PN.usuario = A.id INNER JOIN sedes S on PN.sede = S.id ORDER BY PN.fecha DESC"); 
    $mostrarAdmin = "show";     
}

try {
  $consultaPedidos->execute();
} catch (\Throwable $th) {
  $alertErrorConexion= "show";
  $mensajeAlertError ="Hubo un error de conexión. Por favor actualice la página";
}
$pedidos = $consultaPedidos -> fetchAll(PDO::FETCH_ASSOC);

if(sizeof($pedidos) != 0) {
  $noHayDatos = "hide";
  $hayDatos = "show";
}
// END CONSULTA PEDIDOS REALIZADOS




