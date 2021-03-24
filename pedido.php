<?php
session_start();
require("funciones/pdo.php");

$producto="";
$categoria="";
$medida="";
$mensaje = "";


$consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
$consultaAlimentos->execute();
$alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

$consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
$consultaLimpieza->execute();
$limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);

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
                        <div class="col-6 col-md-4 leftTexto">
                            <p>Hola <?php echo $_SESSION["name"]?>!</p>
                        </div>    
                        
                        <div class="col-6 col-md-5" class="row d-flex justify-end">
                            Sede: <?php echo $_SESSION["sede"]?> -
                            <script>
                                var f = new Date();
                                document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
                            </script>                   
                        </div>    
                    </nav> 
                    <div class="section">
                        <!-- <div class="opcionSection" id="inicioSeccion" name="inicio"> -->
                            <?php require("componentes/subcomponentes/pedido.php")?>
                        <!-- </div> -->
                    </div>
                </main>        
            </div>        
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script typescript="javascript" src="js/funciones.js"></script>
        <!-- <script>
            activarBoton("pedido")
        </script> -->
    </body>
</html>