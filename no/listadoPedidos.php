<?php
    session_start();
    require("funciones/pdo.php");

    $pedidosPorSede = [];
    $data = file_get_contents('json/pedidos.json');
    $pedidos = json_decode($data, true);
    foreach($pedidos as $pedido){
        if($pedido[0]["sede"] == $_SESSION["sede"]){
            array_push($pedidosPorSede, $pedido);
        }
    };

?>
<html>
    <head>
        <title>Pedidos Sí</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="css/master.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="row contenedorSecundario">               
                <aside class="col-12 aside col-md-3">
                    <nav class="row centrarTexto navAside">
                        <div class="col-12">
                            MENU              
                        </div>    
                    </nav> 
                    <?php require("componentes/aside.php") ?>
                </aside> 
                <main class="col-12 col-md-9">
                    <nav class="row navHome justify-content-around ">
                        <div class="col-12 alignRight">
                            <p>Hola <?php echo $_SESSION["name"]?>!</p>
                        </div>    
                    </nav> 
                    <div class="section">
                        <div class="opcionSection" id="inicioSeccion" name="inicio">
                            <div class="row contenedorSeccion">
                                <div class="col-12 paddingCero">
                                    <div class="titleSection">
                                        Pedidos Realizados - <?php echo $_SESSION["sede"] . " - Casa " . $_SESSION["casa"] ?>
                                    </div>
                                    <form class="col-12 contenedorBloques" action="admin.php" method="POST">
                                        <div class="bloque px-2 py-2">
                                            <?php 
                                                if(count($pedidosPorSede) == 0){
                                                    ?> <div class="text-center">
                                                    <?php
                                                        echo "Aún no hay pedidos generados para esta residencia.";
                                                    ?>
                                                    </div>
                                                    <?php
                                                }else{
                                                    foreach($pedidosPorSede as $pedido){
                                            ?>
                                                <div class="row justify-content-between rowTipoProducto" onclick="mostrarAdminUsuarios()">
                                                    <div class="col-12">
                                                
                                                        <?php 
                                                            $day = $pedido[0]["fecha"]["mday"];
                                                            $month = $pedido[0]["fecha"]["month"];
                                                            $year = $pedido[0]["fecha"]["year"];
                                                            $hora = $pedido[0]["fecha"]["hours"];
                                                            $minutos = $pedido[0]["fecha"]["minutes"];
                                                            $segundos = $pedido[0]["fecha"]["seconds"];
                                                            echo($day . "/" . $month . "/" . $year . " - ". $hora. ":" . $minutos . ":" . $segundos . "hs -". $_SESSION["name"] . " " . $_SESSION["apellido"]);
                                                            ?>
                                                    </div> 
                                                    <div class="col-1" id="navAdminUsuarios">
                                                    </div>
                                                </div>    
                                                <div class="px-4 py-4">
                                                    <?php foreach($pedido[0]["pedido"] as $producto){
                                                        if($producto == [] || $producto == ""){
                                                            echo "Pedido vacio";
                                                        }else{
                                                            if($producto["producto"]){
                                                                echo $producto["producto"] . ": " . $producto["cantidad"] . " " . $producto["medida"] . " ; ";
                                                               
                                                            };
                                                        }
                                                    }
                                                    ?>
                                                </div> 
                                            <?php }; 
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </div> 
                            </div>   
                        </div>       
                    </div>
                </main>        
            </div>        
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script type="text/javascript"  src="js/admin.js"></script>
    </body>
</html>