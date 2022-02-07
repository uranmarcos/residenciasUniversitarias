<?php
session_start();
require("funciones/pdo.php");
require("funciones/pedidos.php");


?>
<html>
    <head>
        <title>Pedidos Sí</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- <link href="css/master.css" rel="stylesheet"> -->
        <link href="css/master2.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="col-md-11 main">
                <!-- START BREADCRUMB -->
                <div class="col-12 p-0">
                    <div class="titleSection">
                        <span class="pointer" onclick="redirect('inicio')">Inicio</span> -<span class="grey"> Pedidos Realizados </span>
                    </div>
                </div>
                <!-- END BREADCRUMB -->
                <!-- START ALERTS -->
                <div class="alert alert-danger mt-3 centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
                    <?php echo $mensajeAlertError ?>
                </div>
                <div class="alert alert-secondary mt-3 centrarTexto <?php echo $hayDatos ?>"  role="alert" >
                   Si un pedido figura no enviado, puede reenviarlo clickeando el icono de error.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success mt-3 centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
                    <?php echo $mensajeAlertConfirmacion ?>
                </div>
                <!-- END ALERTS -->
                <!-- START TABLA SIN DATOS -->
                <div class="bloque mb-4 pb-0 <?php echo $noHayDatos?>">
                    <table class="table">
                        <thead class="d-flex justify-content-center">
                            <tr>
                                <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- END TABLA SIN DATOS -->
                <!-- TABLA CON LISTA DE PEDIDOS -->
                <div class="<?php echo $hayDatos?>">
                    <!-- START TABLA ROL STOCK -->
                    <div class="table-responsive bloque mb-4 pb-0 <?php echo $mostrarStock ?>">
                        <table class="table">
                            <div class="d-flex anchoTotal row">
                                <div class="col-12 col-sm-6 d-flex align-items-end justify-content-start dataSede">
                                    <div>
                                        Sede: <?php echo $pedidos[0]["nombreSede"]?> - Casa:  <?php echo $_SESSION["casa"]?>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex align-items-end justify-content-end">
                                    <button type="submit" name="nuevoPedido" onclick="redirect('iniciarPedido')"  id="nuevoPedido" class="btn mb-3 boton">Generar Pedido</button>        
                                </div>
                            </div> 
                            <thead style="width:100%">
                                <tr>
                                    <th scope="col" style="width:10%" class="hide">#</th>
                                    <th scope="col" style="width:20%" class="centrarTexto">Fecha</th>
                                    <th scope="col" style="width:30%" class="centrarTexto">Voluntario</th>
                                    <th scope="col" style="width:10%" class="centrarTexto">Enviado</th>
                                    <th scope="col" style="width:10%" class="centrarTexto">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pedidos as $pedido){ ?>
                                    <form method="POST" action="pedidos.php">
                                        <tr>
                                            <td class="hide"><input type="text" style ="width:50px; border: none" name="id" readonly value="<?php echo $pedido["id"] ?>"></td>
                                            <td class="centrarTexto"><?php echo $newDate = date("d/m/Y H:i:s", strtotime($pedido["fecha"]));?></td>
                                            <td class="centrarTexto">
                                                    <?php echo $pedido["nombre"] . " " . $pedido["segundoNombre"] . " " . $pedido["apellido"] ?>   
                                            </td>
                                            <td class="tdEnviado centrarTexto" style="min-width: 120px">
                                                <?php $enviado = $pedido["enviado"] == 0 ? "hide" : "show"; $noEnviado = $pedido["enviado"] == 0 ? "show" : "hide"   ?>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="btn <?php echo $noEnviado?> reenviarButton" name="reenviarPedido" id="botonReenviar<?php echo $pedido['id']?>" onclick="enviarPedido(<?php echo $pedido['id']?>)"  onmouseout="outReenviar(<?php echo $pedido['id']?>)" onmouseover="overReenviar(<?php echo $pedido['id']?>)" data-bs-toggle="modal" data-bs-target="#modalPedidos">
                                                        <span id="btnReenviar<?php echo $pedido['id']?>" class="hide btnReenviar">Enviar</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" id="iconoReenviar<?php echo $pedido['id']?>" height="22" fill="currentColor" class="bi red bi-send-x-fill" viewBox="0 0 16 16">
                                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-4.854-1.354a.5.5 0 0 0 0 .708l.647.646-.647.646a.5.5 0 0 0 .708.708l.646-.647.646.647a.5.5 0 0 0 .708-.708l-.647-.646.647-.646a.5.5 0 0 0-.708-.708l-.646.647-.646-.647a.5.5 0 0 0-.708 0Z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="btn botonEnviado <?php echo $enviado?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi green bi-send-check-fill iconoEnviado" viewBox="0 0 16 16">
                                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center"> 
                                                <button type="submit" class="btn" name="verPedido">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi purple bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>   
                            </tbody>               
                        </table>
                    </div>
                    <!-- END TABLA ROL STOCK -->
                    <!-- START TABLA ROL ADMIN -->
                    <div class="table-responsive bloque mb-4 pb-0 <?php echo $mostrarAdmin?>">
                        <table class="table">
                            <div class="d-flex anchoTotal row">
                                <div class="col-12 col-sm-6 d-flex align-items-end justify-content-start dataSede">
                                    <div>
                                        Filtros
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex align-items-end justify-content-end">
                                    <button type="submit" name="nuevoPedido" onclick="redirect('iniciarPedido')"  id="nuevoPedido" class="btn mb-3 boton">Generar Pedido</button>        
                                </div>
                            </div> 
                            <thead style="width:100%">
                                <tr>
                                    <th scope="col" style="width:10%" class="hide">#</th>
                                    <th scope="col" style="width:20%" class="centrarTexto">Fecha</th>
                                    <th scope="col" style="width:30%" class="centrarTexto">Voluntario</th>
                                    <th scope="col" style="width:20%" class="centrarTexto">Sede / Casa</th>
                                    <!-- <th scope="col" style="width:10%">Casa</th> -->
                                    <th scope="col" style="width:10%" class="centrarTexto">Enviado</th>
                                    <th scope="col" style="width:10%" class="centrarTexto">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pedidos as $pedido){ ?>
                                    <form method="POST" action="pedidos.php">
                                        <tr>
                                            <td class="hide"><input type="text" style ="width:50px; border: none" name="id" readonly value="<?php echo $pedido["id"] ?>"></td>
                                            <td class="centrarTexto"><?php echo $newDate = date("d/m/Y H:i:s", strtotime($pedido["fecha"]));?></td>
                                            <td class="centrarTexto"><?php echo $pedido["nombre"] . " " . $pedido["segundoNombre"] . " " . $pedido["apellido"] ?></td>
                                            <td class="centrarTexto"><?php echo $pedido["nombreSede"] . " / " . $pedido["casa"] ?></td>
                                            <td class="tdEnviado centrarTexto" style="min-width: 120px">
                                                <?php $enviado = $pedido["enviado"] == 0 ? "hide" : "show"; $noEnviado = $pedido["enviado"] == 0 ? "show" : "hide"   ?>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="btn <?php echo $noEnviado?> reenviarButton" name="reenviarPedido" id="botonReenviar<?php echo $pedido['id']?>" onclick="enviarPedido(<?php echo $pedido['id']?>)"  onmouseout="outReenviar(<?php echo $pedido['id']?>)" onmouseover="overReenviar(<?php echo $pedido['id']?>)" data-bs-toggle="modal" data-bs-target="#modalPedidos">
                                                        <span id="btnReenviar<?php echo $pedido['id']?>" class="hide btnReenviar">Enviar</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" id="iconoReenviar<?php echo $pedido['id']?>" height="22" fill="currentColor" class="bi red bi-send-x-fill" viewBox="0 0 16 16">
                                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-4.854-1.354a.5.5 0 0 0 0 .708l.647.646-.647.646a.5.5 0 0 0 .708.708l.646-.647.646.647a.5.5 0 0 0 .708-.708l-.647-.646.647-.646a.5.5 0 0 0-.708-.708l-.646.647-.646-.647a.5.5 0 0 0-.708 0Z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="<?php echo $enviado?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi green bi-send-check-fill iconoEnviado" viewBox="0 0 16 16">
                                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> 
                                                <button type="submit" class="btn" name="verPedido" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi purple bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>   
                            </tbody>               
                        </table>
                    </div>
                    <!-- END TABLA ROL ADMIN -->
                </div>
                <!-- END TABLA PEDIDOS -->
        
                <!-- <div class="modal-open centered" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div> -->

                 <!-- END MODAL CONFIRMACION REEENVIO DE PEDIDO -->
                <div class="modalConfirmacion <?php echo $modalActualizacion?>" id="modalActualizacion">
                    <form method="POST" action="pedidos.php">
                    <div class="">
                        <div  class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header violeta d-flex justify-content-center centrarTexto">
                                    <b>¡ATENCIÓN!</b>
                                </div>
                                <div id="mensajeActualizacion">
                                    <div class="modal-body centrarTexto">
                                        El pedido se envió correctamente, pero no se actualizó y figurará como NO enviado.
                                        <br>Por favor presioná aceptar para solucionarlo.
                                        <br>
                                        ¡Gracias!
                                    </div>
                                    <input type="text" class="hide" name="idActualizarPedido" id="idActualizarPedido" value="<?php echo $idPorActualizar?>">
                                    <div>
                                        <div class="modal-footer d-flex justify-content-around">
                                            <button type="submit" class="btn botonCancelar" id="btnActualizarEnviado" name="actualizarEnviado" onclick="actualizarPedidoEnviado()">ACEPTAR</button>
                                            <button type="button" class="boton hide" id="btnCircleActualizarEnviado" >
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </button>
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
                    </form>
                </div>

                <!-- START MODAL CONFIRMACION REENVIO DE PEDIDO -->
                <div class="modal show" id="modalPedidos">
                    <form method="POST" action="pedidos.php">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center centrarTexto">
                                    <b>CONFIRMACIÓN</b>
                                </div>
                                <div class="modal-body centrarTexto" id="mensajeModalPedido">
                                </div>
                            <input type="text" class="hide" name="idReenviarPedido" id="idReenviarPedido" value="">
                            <div class="modal-footer d-flex justify-content-around">
                                <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" id="botonReenviarPedido" name="botonReenviarPedido" class="btn boton" onclick="reenviarPedido()">Confirmar</button>
                                <button type="button" class="btnReenviarCircle hide" id="botonCircle" >
                                    <div class="spinner-border spinnerReenviar" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                
            </div>   
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>           
        <script type="text/javascript"  src="js/funcionesCompartidas.js"></script> 
        <script type="text/javascript"  src="js/pedidos.js"></script> 
    </body>
</html>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>