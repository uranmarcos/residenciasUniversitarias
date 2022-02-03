<?php
session_start();
require("funciones/pdo.php");
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
        
    if(isset($_POST["verPedido"])){
        $id = $_POST["id"];
        require("funciones/pdf.php");
        require("funciones/armarPdf.php");
        echo '<script>window.open("_blank")</script>';
    }
    if(isset($_COOKIE["pedidoEnviado"])){
        if ($_COOKIE["pedidoEnviado"]) {
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El pedido se envió correctamente.";
            setcookie("pedidoEnviado", false, time() + (86400 * 30), "/");
        }
    }
    $pedidoActualizado = false;
    if(isset($_POST["reenviarPedido"])){
        $pedidoEnviado = false;
        $id = $_POST["id"];
        try {
            $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE id = '$id'"); 
            $consultaUltimoPedido->execute();
            require("funciones/pdf.php");
            require("funciones/pdfMail.php");
            include("mail.php");
            $pedidoEnviado = true;
        } catch (\Throwable $th) {
            $modalConfirmacion ="show";
            $tituloModalConfirmacion= "ERROR";
            $mensajeModalConfirmacion = "Hubo un error y el pedido se guardó, pero no se envió.<br> No es necesario que lo generes nuevamente.<br> Presioná reintentar para enviarlo.";
            $botonActualizarPedido ="hide";
            $botonReenviarPedido ="show";
            $botonConfirmarPedido ="hide";
        }
        
        // SI EL PEDIDO SE ENVIO, ACTUALIZO EN BASE DE DATOS EL CAMPO "ENVIADO"
        if($pedidoEnviado) {
            try {
                $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE id = '$id'"); 
                $consultaUltimoPedido->execute();
                $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1 WHERE id = '$id'"); 
                $consultaEnviado->execute();
                $pedidoActualizado = true;
            } catch (\Throwable $th) {
                $modalActualizacion ="show";
            }
        }
    }

            // SI EL PEDIDO SE GUARDO EN BASE DE DATOS CONTINUO PARA GENERAR EL PDF
          
        // }
        // if(isset($_POST["botonReenviar"])){
        //     try {
        //         // CONSULTO EL ID DEL PEDIDO GUARDO PARA GENERAR EL PDF Y ENVIAR EL MAIL
        //         $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
        //         $consultaUltimoPedido->execute();
        //         $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
        //         $id = $id[0]["id"];
        //         require("funciones/pdf.php");
        //         require("funciones/pdfMail.php");
        //         include("mail.php");
        //         $pedidoEnviado = true;
        //     } catch (\Throwable $th) {
        //         $modalConfirmacion ="show";
        //         $tituloModalConfirmacion= "ERROR";
        //         $mensajeModalConfirmacion = "Hubo un error y el pedido se guardó, pero no se envió.<br> No es necesario que lo generes nuevamente.<br> Presioná reintentar para enviarlo nuevamente.";
        //         $botonActualizarPedido ="hide";
        //         $botonReenviarPedido ="show";
        //         $botonConfirmarPedido ="hide";
        //     }
        //     if($pedidoEnviado) {
        //         // SI EL PEDIDO SE ENVIO, ACTUALIZO EN BASE DE DATOS EL CAMPO "ENVIADO"
        //         try {
        //             $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
        //             $consultaUltimoPedido->execute();
        //             $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
        //             $id = $id[0]["id"];
        //             $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1 WHERE id = '$id'"); 
        //             $consultaEnviado->execute();
        //             //$pedidoActualizado = true;
        //         } catch (\Throwable $th) {
        //             $modalActualizacion ="show";
        //         }
        //     }
        // }
        // if(isset($_POST["actualizarEnviado"])){
        //     try {
        //         $consultaUltimoPedido = $baseDeDatos ->prepare("SELECT id FROM pedidosnuevos WHERE usuario = '$idUser' ORDER BY fecha DESC LIMIT 1 "); 
        //         $consultaUltimoPedido->execute();
        //         $id = $consultaUltimoPedido -> fetchAll(PDO::FETCH_ASSOC);
        //         $id = $id[0]["id"];
        //         $modalActualizacion = "hide";
        //         $consultaEnviado = $baseDeDatos ->prepare("UPDATE pedidosnuevos SET enviado = 1 WHERE id = '$id'"); 
        //         $consultaEnviado->execute();
        //         $pedidoActualizado = true;
        //     } catch (\Throwable $th) {
        //         $modalActualizacion ="show";
        //     }
        // }
        if($pedidoActualizado) {
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El pedido se envió correctamente.";
        }
        // if($_SESSION["errorMail"]){
        //     $modalConfirmacion ="show";
        //     $tituloModalConfirmacion= "ERROR";
        //     $mensajeModalConfirmacion = "Hubo un error y el pedido se guardó, pero no se envió.<br> No es necesario lo generes nuevamente.<br> Presioná reintentar para enviarlo nuevamente.";
        //     $botonActualizarPedido ="hide";
        //     $botonConfirmarPedido ="show";
        //     $_SESSION["errorMail"] = false;
        // }

              // CONSULTAS DE TODOS LOS PEDIDOS
    $sede = $_SESSION["sede"];
    
    if($_SESSION["rol"] == "stock") {
                $consultaPedidos = $baseDeDatos ->prepare("SELECT PN.id, PN.sede, PN.fecha, PN.enviado, PN.casa, A.nombre, A.segundoNombre, A.apellido, S.descripcion nombreSede FROM pedidosnuevos PN INNER JOIN
        agentes A ON PN.usuario = A.id INNER JOIN sedes S on PN.sede = S.id WHERE PN.sede = $sede ORDER BY PN.fecha DESC");    
    } else {
        $consultaPedidos = $baseDeDatos ->prepare("SELECT PN.id, PN.sede, PN.fecha, PN.enviado, A.nombre, PN.casa, A.segundoNombre, A.apellido, S.descripcion nombreSede FROM pedidosnuevos PN INNER JOIN
        agentes A ON PN.usuario = A.id INNER JOIN sedes S on PN.sede = S.id ORDER BY PN.fecha DESC");    
    }
    //$consultaPedidos->execute();
    try {
        $consultaPedidos->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $pedidos = $consultaPedidos -> fetchAll(PDO::FETCH_ASSOC);

    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($pedidos) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }









?>
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
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="col-12 paddingCero">
                <div class="titleSection">
                    Pedidos Generados
                </div>
            </div>
            <div class="sectionBloque">
                <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
                    Hubo un error de conexión. Por favor actualizá la página
                </div>
                <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
                    <?php echo $mensajeAlertConfirmacion ?>
                </div>
                <!-- BOX LISTADO PEDIDOS -->
                <div class="contenedorSeccion contenedorModal">
                    <div class="d-flex anchoTotal row">
                        <div class="subtitle col-6">
                            Pedidos Realizados
                        </div>
                        <div class="col-6 d-flex align-items-end justify-content-end">
                            <button type="submit" name="nuevoPedido" onclick="redirect()"  id="nuevoPedido" class="btn botonConfirmar col-6 col-md-3">Nuevo</button>        
                        </div>
                    </div>
                    <!-- TABLA CON LISTA DE PEDIDOS -->
                    <div class="table-responsive">
                            <table class="table <?php echo $hayDatos ?>">
                                <thead style="width:100%">
                                    <tr>
                                        <th scope="col" style="width:10%" >#</th>
                                        <th scope="col" style="width:20%">Fecha</th>
                                        <th scope="col" style="width:30%">Voluntario</th>
                                        <th scope="col" style="width:20%">Sede</th>
                                        <th scope="col" style="width:10%">Casa</th>
                                        <th scope="col" style="width:10%">Enviado</th>
                                        <th scope="col" style="width:10%">Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pedidos as $pedido){ ?>
                                        <form method="POST" action="pedidos.php">
                                            <tr>
                                                <td><input type="text" style ="width:50px; border: none" name="id" readonly value="<?php echo $pedido["id"] ?>"></td>
                                                <td><?php echo $newDate = date("d/m/Y H:i:s", strtotime($pedido["fecha"]));?></td>
                                                <td><?php echo $pedido["nombre"] . " " . $pedido["segundoNombre"] . " " . $pedido["apellido"] ?></td>
                                                <td><?php echo $pedido["nombreSede"]?></td>
                                                <td><?php echo $pedido["casa"]?></td>
                                                    <td class="tdEnviado">
                                                        <span><?php echo $pedido["enviado"] == 0 ?  "No enviado"  : "Enviado" ?></span>
                                                        <div class="btn reenviarButton hide" name="reenviarPedido" id="botonReenviar<?php echo $pedido['id']?>" onclick="enviarPedido(<?php echo $pedido['id']?>)" onmouseout="outReenviar(<?php echo $pedido['id']?>)" onmouseover="overReenviar(<?php echo $pedido['id']?>)" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                            <span id="textoReenviar<?php echo $pedido['id']?>">Reenviar</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="iconoReenviar<?php echo $pedido['id']?>" class="bi bi-send hide" viewBox="0 0 16 16">
                                                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                                            </svg>
                                                        </div>
                                                        <!-- <button type="button" class="btn reenviarButton hide" id="botonCircle<?php echo $pedido['id']?>" >
                                                            <div class="spinner-border spinnerReenviar" role="status">
                                                                <span class="sr-only"></span>
                                                            </div>
                                                        </button> -->
                                                    </td>
                                                <!-- </form>
                                                <form method="POST" target="_blank" action="pedidos.php"> -->
                                                    <td> 
                                                        <button type="submit" class="btn editButton" name="verPedido"  data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                    <?php } ?>   
                                </tbody>               
                            </table>
                    </div>
                    <!-- TABLA SIN DATOS -->
                    <table class="table <?php echo $noHayDatos?>">
                        <thead class="d-flex justify-content-center">
                            <tr>
                                <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal" id="modalPedidos">
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
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>           
    </body>
</html>
<script type="text/javascript">
    function redirect() {
        window.location.href="iniciarPedido.php"
    }
    function abrirPedido(){
        window.open('_blank');
    }
    function overReenviar(id) {
        let textoReenviar = document.getElementById("textoReenviar" + id)
        let iconoReenviar = document.getElementById("iconoReenviar" + id)
        textoReenviar.classList.add("hide")
        iconoReenviar.classList.remove("hide")
    }
    function outReenviar(id) {
        let textoReenviar = document.getElementById("textoReenviar" + id)
        let iconoReenviar = document.getElementById("iconoReenviar" + id)
        textoReenviar.classList.remove("hide")
        iconoReenviar.classList.add("hide")
    }
    function enviarPedido(id) {
        console.log(id)
        // let botonReenviar = document.getElementById("botonReenviar" + id)
        // botonReenviar.classList.add("hide")
        // let botonCircle = document.getElementById("botonCircle" + id)
        // botonCircle.classList.remove("hide")
        let modalPedido = document.getElementById("modalPedido")
        modalPedido.classList.remove("hide")
        document.getElementById("modalPedido").innerHTML = "¿Confirma que desea reenviar el pedido?"
    }
    window.onload = function(){
        let alertConfirmacion = document.getElementById("alertConfirmacion")
        if (alertConfirmacion.classList.contains('show')) {
            setTimeout(ocultarAlertConfirmacion, 5000)
        }
        let alertErrorConexion = document.getElementById("alertErrorConexion")
        if (alertErrorConexion.classList.contains('show')) {
            setTimeout(ocultarAlertError, 5000)
        }

        // MUESTRO BOTON REENVIAR EN LOS CASOS EN QUE EL PEDIDO NO SE ENVIO
        let tdEnviado = document.getElementsByClassName("tdEnviado")
        tdEnviado = Array.from(tdEnviado)
        tdEnviado.forEach(function callback(value, index) {
            if(value.firstElementChild.innerHTML.includes("No enviado")){   
                value.firstElementChild.classList.add("hide")
                value.firstElementChild.nextElementSibling.classList.remove("hide")
            }
        })
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
</script>