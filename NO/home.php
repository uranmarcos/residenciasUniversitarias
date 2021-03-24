<?php
session_start();
require("funciones/pdo.php");

$mostrarConfirmacion = "none";

if(isset($_POST["prepararPedido"])){
    $mostrarConfirmacion = "block";

}
if(isset($_POST["modificarPedido"])){
    $mostrarConfirmacion = "none";
}

// require("funciones/funcionesPedidos.php");
// include("componentes/header.php");

// $producto= null;
// $categoria= null;
// $medida= null;
// $mensajeProducto = null;
// $mensajeUsuario = null;
// $colorMensaje="";
// $nombre = null;
// $apellido = null;
// $dni = null;
// $rol = null;
// $mail = null;
// $password = null;
// $seccion = "componentes/inicio.php";
// if($_POST){
//     if(isset($_POST["iniciarPedido"])){
//         // header("Location:http://localhost/repositorioPedidos/componentes/pedidos.php");
//         $seccion = "componentes/pedidosNuevo.php";
//     }
//     if(isset($_POST["miPerfil"])){
//         $seccion = "componentes/perfil.php";
//         // header("Location:http://localhost/repositorioPedidos/componentes/perfil.php");
//     }
//     if(isset($_POST["admin"])){
//         $seccion = "componentes/admin.php";

//         // header("Location:http://localhost/repositorioPedidos/componentes/admin.php");
//     }

//     // Creo en base de datos el producto
//     if(isset($_POST["crearArticulo"])){
//         $producto = $_POST["producto"];
//         $categoria = $_POST["categoria"];
//         $medida = $_POST["medida"];
//         $seccion = "componentes/admin.php";
//         try{
//             $consulta = $baseDeDatos ->prepare("INSERT into productos (producto, categoria, medida) VALUES('$producto', '$categoria', '$medida')");
//             $consulta->execute();
            
//             $mensajeProducto = "El producto se creó correctamente";
//             $colorMensaje= "green";
        
//         }catch(Exception $exception){
//             $exception = "Hubo un error en la conexión, el producto no pudo crearse";   
//             $mensajeProducto = $exception;
//             $colorMensaje= "red";
            
//         }
//     }
//     if(isset($_POST["crearUsuario"])){
//         $nombre = $_POST["nombre"];
//         $apellido = $_POST["apellido"];
//         $mail = $_POST["mail"];
//         $dni = $_POST["dni"];
//         $password = $_POST["dni"];
//         $rol = $_POST["rol"];
  
//         try{
//             $consulta = $baseDeDatos ->prepare("INSERT into usuarios (nombre, apellido, mail, dni, password, rol) VALUES('$nombre', '$apellido', '$mail', '$dni', '$password', '$rol')");
//             $consulta->execute();
            
//             $mensajeUsuario = "El usuario se creó correctamente";
//             $colorMensaje= "green";
        
//         }catch(Exception $exception){
//             $exception = "Hubo un error en la conexión, el usuario no pudo crearse";   
//             $mensajeUsuario = $exception;
//             $colorMensaje= "red";
//         }    
//     } 
// }



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
                        <div class="opcionSection" id="inicioSeccion" name="inicio">
                            <?php require("componentes/subcomponentes/inicio.php")?>
                        </div>
                        <div class="opcionSection hidden" id="pedidoSeccion" name="pedido">
                            <?php require("componentes/subcomponentes/pedido.php")?>
                        </div>
                        <div class="opcionSection hidden" id="adminSeccion" name="admin">
                            <?php require("componentes/subcomponentes/admin.php")?>
                        </div>
                    </div>
                </main> 
                <section class="col-12 confirmarPedido" style="display:<?php echo $mostrarConfirmacion ?>">
                        <div id="confirmSeccion" name="confirmPedido">
                            <?php require("componentes/subcomponentes/confirmPedido.php")?>
                        </div>
                </section>               
            </div>        
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script typescript="javascript" src="js/funciones.js"></script>
    </body>
</html>