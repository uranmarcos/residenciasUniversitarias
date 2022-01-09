<?php
session_start();
require("funciones/pdo.php");
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    
    // CONSULTAS DE TODOS LOS PEDIDOS
    $consultaPedidos = $baseDeDatos ->prepare("SELECT PN.id, PN.sede, PN.fecha, A.nombre, A.segundoNombre, A.apellido FROM pedidosnuevos PN INNER JOIN
     agentes A ON PN.usuario = A.id ORDER BY PN.fecha DESC");    
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
        //consulto a base de datos el pedido clickeado para ver
        $pedidoConsultado = $baseDeDatos ->prepare("SELECT PN.pedido, PN.sede, PN.fecha, PN.casa, A.nombre, A.segundoNombre, A.apellido FROM pedidosnuevos PN INNER JOIN
        agentes A ON PN.usuario = A.id WHERE PN.id = $id");
        try {
            $pedidoConsultado->execute();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        $pedido = $pedidoConsultado -> fetchAll(PDO::FETCH_ASSOC);
        $idSede = $pedido[0]["sede"];


        //consulta de la sede del pedido
        $consultaSede = $baseDeDatos ->prepare("SELECT * from sedes WHERE id = '$idSede'");
        try {
            $consultaSede->execute();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        $sede = $consultaSede -> fetchAll(PDO::FETCH_ASSOC);
        // conversion de formato de fecha
        $newDate = date("d-m-Y", strtotime($pedido[0]["fecha"]));
        $otrosTabla = "";
        $pedidoTabla = [];

        // consulta listado de articulos
        $consultaArticulos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, A.medida, M.descripcion medida from articulos A INNER JOIN medidas M WHERE A.medida = M.id");
        $consultaArticulosValidada = false;
        try {
            $consultaArticulos->execute();
            $consultaArticulosValidada = true;
        } catch (\Throwable $th) {
            $alertErrorConexion = "show";
        }
        if ($consultaArticulosValidada) {
            $articulos = $consultaArticulos -> fetchAll(PDO::FETCH_ASSOC);
            $pedidoAMostrar = explode(";", $pedido[0]["pedido"]);
            foreach($pedidoAMostrar as $p){
                $item = explode(":", $p);
                if($item[0] != "otros" && $item[0] != "" ){
                    $key = array_search($item[0], array_column($articulos, "id"));
                    $nuevoItem = [];
                    array_push($nuevoItem, $articulos[$key]["descripcion"] . ": " . $item[1] . " " . $articulos[$key]["medida"]); 
                    array_push($pedidoTabla, $nuevoItem);
                }
                if($item[0] == "otros"){
                    $otrosTabla = $item[1];
                }
            }
            sort($pedidoTabla);
            require("armarPdf.php");
        try {
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $header = array('Listado de articulos pedidos');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,5,"Pedido Mensual de " . utf8_decode($sede[0]["descripcion"]),0,1,'C');
            $pdf->Cell(0,10,'Fecha: ' . $newDate,0,1);
            $pdf->Cell(0,10,'Casa: ' . $pedido[0]["casa"] . " -  Voluntario: " . $pedido[0]["nombre"] . " " . $pedido[0]["segundoNombre"] . " " . $pedido[0]["apellido"],0,1);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,10,'Articulos pedidos: ' ,0,1);
            $pdf->SetFont('Arial','',12);
            $pdf->TablaSimple($header,$pedidoTabla);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,10,'Otros: ' ,0,1);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(190,50,utf8_decode($otrosTabla),1);
            $pdf->Output();
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
        }
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
                                    <form method="POST" target="_blank" action="pedidos2.php">
                                        <tr>
                                            <td><input type="text" style ="width:50px; border: none" name="id" readonly value="<?php echo $pedido["id"] ?>"></td>
                                            <td><?php echo $pedido["fecha"]?></td>
                                            <td><?php echo $pedido["nombre"] . " " . $pedido["segundoNombre"] . " " . $pedido["apellido"] ?></td>
                                            <td class="d-flex justify-content-start"> 
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
        window.location.href="iniciarPedido2.php"
    }
    function abrirPedido(){
        window.open('_blank');
    }
</script>