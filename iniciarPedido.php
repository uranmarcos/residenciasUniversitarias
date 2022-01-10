<?php
session_start();
require("funciones/pdo.php");
//require("funciones/pedidos.php");
// $producto="";
    // $categoria="";
    // $medida="";
    //$mensaje = "";
    //$pedido = null;
    // variables de sesion
    $sede = $_SESSION["sede"];
    $casa = $_SESSION["casa"];
    $idUser = $_SESSION["id"];
    // variables de pedido
    $pedidoGuardado = false;
    $pedidoEnviado = false;
    $pedidoActualizado = false;
    $date = date("Y-m-d h:i:s");

    // variables de alertas
    $alertErrorConexion= "hide";
    $modalConfirmacion ="hide";
    $modalActualizacion ="hide";
    $tituloModalConfirmacion= "";
    $mensajeModalConfirmacion = "";
    $botonActualizarPedido ="hide";
    $botonConfirmarPedido ="hide";


    // variables de filtros
    $productosAsc = "hide";
    $productosDesc= "show";
    $categoriaAsc = "show";
    $categoriaDesc= "hide";

    // CONSULTA DE PRODUCTOS DISPONIBLES A BASE DE DATOS
    $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
    INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE A.habilitado = 1 ORDER BY descripcion ASC");
    try {
        $consultaProductos->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    
    // CONSULTA DE CATEGORIAS DISPONIBLES A BASE DE DATOS PARA EL SELECT
    $consultaCategorias = $baseDeDatos ->prepare("SELECT * FROM categorias WHERE habilitado = 1");
    try {
        $consultaCategorias->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $categorias = $consultaCategorias -> fetchAll(PDO::FETCH_ASSOC);
    
    
    
    //$_SESSION["productos"] = $productos;
    // FUNCIONALIDADES 
    // REACOMODO PRODUCTOS POR DESCRIPCION EN ORDEN ASCENDENTE
    if(isset($_POST["productoAsc"])){
        $cat = $_POST["categoria"];
        $productosAsc = "hide";
        $productosDesc= "show";
        if($cat == "todos"){
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE A.habilitado = 1 ORDER BY descripcion ASC");    
        }else{
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE categoria='$cat',  A.habilitado = 1 ORDER BY descripcion DESC");
        }
        try {
            $consultaProductos->execute();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    // REACOMODO PRODUCTOS POR DESCRIPCION EN ORDEN DESCENDENTE
    if(isset($_POST["productoDesc"])){
        $cat = $_POST["categoria"];
        $productosAsc = "show";
        $productosDesc= "hide";
        if($cat == "todos"){
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id ORDER BY descripcion DESC");    
        }else{
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE categoria='$cat' ORDER BY descripcion DESC");
        }
        try {
            $consultaProductos->execute();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    // REACOMODO PRODUCTOS POR CATEGORIA EN ORDEN ASCENDENTE
    if(isset($_POST["categoriaAsc"])){
        $cat = $_POST["categoria"];
        if($cat == "todos"){
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE A.habilitado = 1 ORDER BY categoria ASC, descripcion ASC");   
        }else{
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE categoria='$cat', A.habilitado = 1 ORDER BY categoria ASC, descripcion ASC");  
        }
        $categoriaAsc = "hide";
        $categoriaDesc= "show";
        try {
            $consultaProductos->execute();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    // REACOMODO PRODUCTOS POR CATEGORIA EN ORDEN DESCENDENTE
    if(isset($_POST["categoriaDesc"])){
        $cat = $_POST["categoria"];
        if($cat == "todos"){
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE A.habilitado = 1 ORDER BY categoria DESC, descripcion ASC");   
        }else{
            $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
                INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id WHERE categoria='$cat', A.habilitado = 1 ORDER BY categoria DESC, descripcion ASC");  
        }
        $categoriaAsc = "show";
        $categoriaDesc= "hide";
        try {
            $consultaProductos->execute();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }

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
        // EJECUTO INSERT DEL PEDIDO
        $insertPedido = $baseDeDatos ->prepare("INSERT into pedidosnuevos VALUES(default, '$sede', '$casa', '$idUser', '$pedido', 0, '$date')"); 
        try {
            $insertPedido->execute();
            $pedidoGuardado = true;
        } catch (\Throwable $th) {
            $modalConfirmacion ="show";
            $tituloModalConfirmacion= "ERROR";
            $mensajeModalConfirmacion = "Hubo un error y el pedido no pudo generarse.<br> Por favor intentalo nuevamente.";
            $botonActualizarPedido ="hide";
            $botonReenviarPedido ="hide";
            $botonConfirmarPedido ="show";
        }
        // SI EL PEDIDO SE GUARDO EN BASE DE DATOS CONTINUO PARA GENERAR EL PDF
        if($pedidoGuardado){
            try {
                // CONSULTO EL ID DEL PEDIDO GUARDO PARA GENERAR EL PDF Y ENVIAR EL MAIL
                $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevo WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
                $consultaUltimoPedido->execute();
                $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
                $id = $id[0]["id"];
                require("funciones/pdf.php");
                require("funciones/pdfMail.php");
                include("mail.php");
                $pedidoEnviado = true;
            } catch (\Throwable $th) {
                $modalConfirmacion ="show";
                $tituloModalConfirmacion= "ERROR";
                $mensajeModalConfirmacion = "Hubo un error y el pedido se guardó, pero no se envió.<br> No es necesario que lo genere nuevamente.<br> Presione reintentar para enviarlo nuevamente.";
                $botonActualizarPedido ="hide";
                $botonReenviarPedido ="show";
                $botonConfirmarPedido ="hide";
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
            } catch (\Throwable $th) {
                $modalActualizacion ="show";
            }
        }
    }
    if(isset($_POST["botonReenviar"])){
        try {
            // CONSULTO EL ID DEL PEDIDO GUARDO PARA GENERAR EL PDF Y ENVIAR EL MAIL
            $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
            $consultaUltimoPedido->execute();
            $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
            $id = $id[0]["id"];
            require("funciones/pdf.php");
            require("funciones/pdfMail.php");
            include("mail.php");
            $pedidoEnviado = true;
        } catch (\Throwable $th) {
            $modalConfirmacion ="show";
            $tituloModalConfirmacion= "ERROR";
            $mensajeModalConfirmacion = "Hubo un error y el pedido se guardó, pero no se envió.<br> No es necesario que lo genere nuevamente.<br> Presione reintentar para enviarlo nuevamente.";
            $botonActualizarPedido ="hide";
            $botonReenviarPedido ="show";
            $botonConfirmarPedido ="hide";
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
            } catch (\Throwable $th) {
                $modalActualizacion ="show";
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
            $modalActualizacion ="show";
        }
    }
    if($pedidoActualizado == true) {
        echo "<script>location.href='pedidos.php';</script>";
    }
    if($_SESSION["errorMail"]){
        $modalConfirmacion ="show";
        $tituloModalConfirmacion= "ERROR";
        $mensajeModalConfirmacion = "Hubo un error y el pedido se guardó, pero no se envió.<br> No es necesario lo genere nuevamente.<br> Presione reintentar para enviarlo nuevamente.";
        $botonActualizarPedido ="hide";
        $botonConfirmarPedido ="show";
        $_SESSION["errorMail"] = false;
    }
    
    // if(isset($_POST["filtrarCategorias"])){
    //     $cat = $_POST["categoria"];
    //     if($cat == "todos"){
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto ASC");    
    //     }else{
    //        $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY producto ASC");
    //     }
    //     $consultaProductos->execute();
    //     $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // }
?>
<script>
    function pulsar(e) {
        tecla = (document.querySelectorAll) ? e.keyCode : e.which;
        return (tecla != 13);
    }      
</script>    
<html>
    <head>
        <title>Pedidos Sí</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="css/master.css" rel="stylesheet">
        <link href="css/master1.css" rel="stylesheet">
    </head>
    <body onbeforeunload="return resetFiltros()">
        <div class="contenedorPrincipal">
            <div class="headerFull">
                <?php require("componentes/header.php")?>
            </div>
            <div class="sectionBloque mt-2">
                <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" role="alert" >
                    Hubo un error de conexión. Por favor actualizá la página
                </div>
            </div>
            <div class="col-12 paddingCero">
                <div class="titleSection">
                    Generar Pedido
                </div>
            </div>
            <div class="sectionBloque mt-1">
                <div class="contenedorSeccion contenedorModal">
                    <form method="POST" action="iniciarPedido.php" onkeypress="return pulsar(event)">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablePedidos">
                                <!-- FILTROS -->
                                <div class="row bg-grey d-flex align-items-center p-0 m-0 justify-content-around" style="width:100%">
                                    <div class="col-12 col-sm-6 col-md-5">
                                        <div class="row rowFiltro">
                                            <input type="textarea" class="col-12" placeholder="Buscar por producto" onkeyup="filtrar(), guardarFiltro('buscadorProducto')" name="buscadorProducto" id="buscadorProducto">
                                        </div>
                                    </div>    
                                    <div class="col-12 col-sm-6 col-md-5">
                                        <div class="row rowFiltro">
                                            <select style="height:30px" class="col-12" onchange="filtrar(), guardarFiltro('selectCategoria')" name="categoria" id="selectCategoria">
                                                <option value="todos">Filtrar las categorias</opcion>
                                                <?php foreach($categorias as $categoria){ ?>
                                                    <option value="<?php echo $categoria['descripcion'] ?>" ><?php echo $categoria["descripcion"]?></opcion>
                                                <?php } ?>
                                            </select>   
                                        </div>
                                    </div> 
                                    <div class="col-12 col-md-2 mb-2 hide mb-md-0" id="boxBotonFiltro">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button type="submit" class="botonQuitarFiltro" name="reiniciarPedido" onclick="quitarFiltros()" class="editButton botonReiniciar">
                                                Quitar
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                                <!-- TABLA -->
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="row" style="width:90%; margin:0px">
                                                <div class="col-auto">
                                                    Producto
                                                </div>
                                                <div class="col d-flex align-items-center"  style="padding-left:0">
                                                    <button name="productoAsc" class="<?php echo $productosAsc?> buttonSort">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                                        </svg>
                                                    </button>
                                                    <button name="productoDesc" class="<?php echo $productosDesc?> buttonSort">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col" name="thCategoria">
                                            <div class="row d-flex justify-content-center" style="width:90%; margin:0px">
                                                <div class="col-auto">
                                                    Categoria
                                                </div>
                                                <div class="col-auto d-flex align-items-center" style="padding-left:0">
                                                    <button name="categoriaAsc" class="<?php echo $categoriaAsc?> buttonSort">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                                        </svg>
                                                    </button>
                                                    <button name="categoriaDesc" class="<?php echo $categoriaDesc?> buttonSort">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($productos as $producto){ ?>
                                        <tr name="rowTable">
                                            <td class="productos">
                                                <div id="producto<?php echo $posicion = array_search($producto, $productos)?>">
                                                    <?php echo $producto["descripcion"] ?>
                                                </div>
                                                <div style="font-size:10px"><?php echo $producto["medida"] ?></div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <input type="number" min=0 id="input<?php echo $producto["id"]?>" value="0" onfocus="inputFocusOn()" onkeydown="limpiarInputFocus" onblur="inputFocusOut('input<?php echo $producto['id']?>')" class="cantidadProducto inputProducto col-8 col-sm-10" name="<?php echo $producto['id']?>">
                                                    <div class="editButton pt-1 col-1" style="height:27px; margin-left:2px"  onclick="borrarCantidad('<?php echo $producto['id']?>')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="categorias centrarTexto" name="tdCategoria">
                                                <div id="categoria<?php echo $posicion = array_search($producto, $productos)?>">
                                                    <?php echo $producto["categoria"] ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>                    
                                </tbody>
                            </table>             
                            <div class="row cajaInternaBloque" id="cajaOtros">
                                <div class="centrarTexto">¿Falta algo en el listado?</div>
                                    <div class="row anchoTotal">
                                        <input  type="textarea" id="textareaOtros" class="textarea" autocomplete="off" onblur="guardarOtros('textareaOtros')" name="otros" for="producto">    
                                    </div>    
                                </div> 
                            </div>
                            <div>
                                <div class="row rowBoton d-flex justify-content-center"> 
                                    <button type="submit" id="generarPedido" name="generarPedido" onmouseover="validarPedido()" class="button">Confirmar</button>
                                </div>
                            </div> 
                            <div class="modal" id="modalPedido">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center centrarTexto">
                                            <b>CONFIRMACIÓN</b>
                                        </div>
                                        <div class="modal-body centrarTexto" id="mensajeModalPedido">
                                            
                                        </div>
                                        <div class="modal-footer d-flex justify-content-around">
                                            <button type="button" class="btn botonCancelar" onclick="cerrarModalPedido()">Cancelar</button>
                                            <button type="submit" id="botonConfirmar" name="botonConfirmar" class="btn botonConfirmar" onclick="confirmarPedido()">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="modalSpinner">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="min-height:200px; height:200px">
                                        <div class="modal-header d-flex justify-content-center centrarTexto violeta">
                                            <b>GENERANDO EL PEDIDO</b>
                                        </div>
                                        <div style="height:100%" class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border violeta" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer d-flex justify-content-around">
                                            <button type="button" class="btn botonCancelar" onclick="cerrarModalPedido()">Cancelar</button>
                                            <button type="button" id="botonConfirmar" name="botonConfirmar" class="btn botonConfirmar" onclick="confirmarPedido()">Confirmar</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal <?php echo $modalConfirmacion ?>" id="modalConfirmacion">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center centrarTexto">
                                            <b><?php echo $tituloModalConfirmacion?></b>
                                        </div>
                                        <div class="modal-body centrarTexto" id="mensajeModalPedido">
                                            <?php echo $mensajeModalConfirmacion ?>
                                        </div>
                                        <div class="<?php echo $botonConfirmarPedido ?>">
                                            <div class="modal-footer d-flex justify-content-around">
                                                <button type="button" class="btn botonCancelar" onclick="cerrarModalConfirmacion()">Cancelar</button>
                                                <button type="submit" id="botonConfirmar" name="botonConfirmar" class="btn botonConfirmar" onclick="reintentarPedido()">Reintentar</button>
                                            </div>
                                        </div>
                                        <div class="<?php echo $botonReenviarPedido ?>">
                                            <div class="modal-footer d-flex justify-content-around">
                                                <button type="button" class="btn botonCancelar" onclick="cerrarModalConfirmacion()">Cancelar</button>
                                                <button type="submit" id="botonReenviar" name="botonReenviar" class="btn botonConfirmar" onclick="reintentarPedido()">Reenviar</button>
                                            </div>
                                        </div>
                                        <div class="<?php echo $botonActualizarPedido ?>">
                                            <div class="modal-footer d-flex justify-content-around">
                                                <button type="button" class="btn botonCancelar" onclick="cerrarModalPedidoGenerado()">ACEPTAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal <?php echo $modalActualizacion ?>" id="modalActualizacion">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header violeta d-flex justify-content-center centrarTexto">
                                            <b>¡ATENCIÓN!</b>
                                        </div>
                                        <div id="mensajeActualizacion">
                                            <div class="modal-body centrarTexto">
                                                El pedido se generó y se envió correctamente, pero no se actualizó como enviado.
                                                <br>Por favor presione aceptar para solucionarlo.
                                                <br>
                                                ¡Gracias!
                                            </div>
                                            <div>
                                                <div class="modal-footer d-flex justify-content-around">
                                                    <button type="submit" class="btn botonCancelar" name="actualizarEnviado" onclick="cerrarModalActualizacion()">ACEPTAR</button>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="modal-body hide centrarTexto" id="spinnerActualizacion">
                                            <div style="min-height:100px" class="d-flex justify-content-center align-items-center">
                                                <div class="spinner-border violeta" role="status">
                                                        <span class="sr-only"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                          
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript"  src="js/iniciarPedido.js"></script> 
    </body>
</html>