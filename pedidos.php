<?php
session_start();
require("funciones/pdo.php");
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
        
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
    if(isset($_POST["verPedido"])){
        $id = $_POST["id"];
        require("funciones/pdf.php");
        require("funciones/armarPdf.php");
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
                                    <form method="POST" target="_blank" action="pedidos.php">
                                        <tr>
                                            <td><input type="text" style ="width:50px; border: none" name="id" readonly value="<?php echo $pedido["id"] ?>"></td>
                                            <td><?php echo $newDate = date("d/m/Y H:i:s", strtotime($pedido["fecha"]));?></td>
                                            <td><?php echo $pedido["nombre"] . " " . $pedido["segundoNombre"] . " " . $pedido["apellido"] ?></td>
                                            <td><?php echo $pedido["nombreSede"]?></td>
                                            <td><?php echo $pedido["casa"]?></td>
                                            <td><?php echo $pedido["enviado"] == 0 ?  "No enviado"  : "Enviado" ?></td>
                                            <td> 
                                                <button type="submit" class="btn editButton" name="verPedido"  data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
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
                    <!-- TABLA SIN DATOS -->
                    <table class="table <?php echo $noHayDatos?>">
                        <thead class="d-flex justify-content-center">
                            <tr>
                                <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    function redirect() {
        window.location.href="iniciarPedido.php"
    }
    function abrirPedido(){
        window.open('_blank');
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