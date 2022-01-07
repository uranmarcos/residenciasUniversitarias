<?php
session_start();
require("funciones/pdo.php");
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";

    // CONSULTAS INICIALES LISTADO DE ARTICULOS, MEDIDAS Y CATEGORIAS
    $consultaPedidos = $baseDeDatos ->prepare("SELECT PN.id, PN.fecha, A.nombre, A.segundoNombre, A.apellido FROM pedidosnuevos PN INNER JOIN
     agentes A ON PN.usuario = A.id ORDER BY PN.fecha DESC");
    //$consultaSedes = $baseDeDatos ->prepare("SELECT * FROM sedes WHERE habilitado = '1'");
    
    try {
        $consultaPedidos->execute();
        //$consultaSedes->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $pedidos = $consultaPedidos -> fetchAll(PDO::FETCH_ASSOC);
    //$sedes = $consultaSedes -> fetchAll(PDO::FETCH_ASSOC);
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
        <link href="css/aside.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="headerFull">
                <?php require("componentes/header2.php")?>
            </div>
            <div class="col-12 paddingCero">
                <div class="titleSection">
                    Pedidos Generados
                </div>
            </div>
            <div class="sectionBloque">
                <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" role="alert" >
                    Hubo un error de conexión. Por favor actualizá la página
                </div>
                <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" role="alert">
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
                                    <th scope="col" >#</th>
                                    <th scope="col" style="width:50%">Fecha</th>
                                    <th scope="col" style="width:40%">Voluntario</th>
                                    <th scope="col" style="width:10%">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($pedidos as $pedido){ ?>
                                        <tr>
                                            <td><?php echo $pedido["id"] ?></td>
                                            <td><?php echo $pedido["fecha"]?></td>
                                            <td><?php echo $pedido["nombre"] . " " . $pedido["segundoNombre"] . " " . $pedido["apellido"] ?></td>
                                            <td class="d-flex justify-content-start"> 
                                                <button type="button" class="btn editButton" onclick="abrirPedido()" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </button>
                                            </td>
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
            
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    function redirect() {
        window.location.href="iniciarPedido2.php"
    }
    function abrirPedido(){
        window.open('_blank');
    }
</script>