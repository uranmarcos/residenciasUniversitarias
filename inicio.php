<?php
session_start();
require("funciones/pdo.php");
require("funciones/funciones.php");

$mostrarInicio = "block";
$mostrarBloque = "none";
$bloque = "";
$bloqueAdmin="hidden";
$cajaMensajeConfirmacion="hidden";
$subSeccionAdmin="";
$ABMUserTitle = "";
//BOTONES ASIDE
if(isset($_POST["cerrarSesion"])){
    header("Location: destroy.php");
}
if(isset($_POST["perfil"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/perfil.php";
}
if(isset($_POST["admin"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/admin.php";
}
if(isset($_POST["pedidosAnteriores"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/pedidosAnteriores.php";
}
if(isset($_POST["iniciarPedido"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["productoAsc"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["productoDesc"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["categoriaAsc"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["categoriaDesc"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/iniciarPedido.php";
}

//BOTONES ADMIN
if(isset($_POST["adminSedes"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/admin.php";
    $bloqueAdmin ="";
    $subSeccionAdmin = "main/subsecciones/sedesSection.php";
}
if(isset($_POST["adminCategorias"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/admin.php";
    $bloqueAdmin ="";
    $subSeccionAdmin = "main/subsecciones/categoriasSection.php";
}
if(isset($_POST["adminUsuarios"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloqueAdmin ="";
    $bloque = "main/admin.php";
    $subSeccionAdmin = "main/subsecciones/usuariosSection.php";
    $mostrarListadoUsuarios = "block";
    $mostrarABMUsuarios = "hidden";
}
if(isset($_POST["adminArticulos"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloqueAdmin ="";
    $bloque = "main/admin.php";
    $subSeccionAdmin = "main/subsecciones/articulosSection.php";
}
if(isset($_POST["crearUsuario"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloqueAdmin ="";
    $bloque = "main/admin.php";
    $subSeccionAdmin = "main/subsecciones/usuariosSection.php";
    $mostrarListadoUsuarios = "hidden";
    $mostrarABMUsuarios = "block";    
    $ABMUserTitle = "Crear usuario";
}
if(isset($_POST["editarUsuario"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloqueAdmin ="";
    $bloque = "main/admin.php";
    $subSeccionAdmin = "main/subsecciones/usuariosSection.php";
    $mostrarListadoUsuarios = "hidden";
    $mostrarABMUsuarios = "block";    
    $ABMUserTitle = "Editar usuario";
}
if(isset($_POST["cancelCrearUsuario"])){
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloqueAdmin ="";
    $bloque = "main/admin.php";
    $subSeccionAdmin = "main/subsecciones/usuariosSection.php";
    $mostrarListadoUsuarios = "block";
    $mostrarABMUsuarios = "hidden";    
}
if(isset($_POST["newUser"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $sede = $_POST["sede"];
    $casa = $_POST["casa"];
    $rol = $_POST["rol"];
    $mail = $_POST["mail"];
    try{
        $consulta = $baseDeDatos ->prepare("INSERT into usuarios (mail, rol, pass, nombre, apellido, dni, sede, casa)
            VALUES ('$mail', '$rol', '$dni', '$nombre', '$apellido', '$dni', '$sede', '$casa')");
        $consulta->execute();
    }catch(Exception $exception){
        $exception = "UPS, hubo error y el usuario no pudo crearse! Por favor intentalo nuevamente";   
        $mensajeUsuario = $exception;
        return;
    }
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloqueAdmin ="";
    $bloque = "main/admin.php";
    $subSeccionAdmin = "main/subsecciones/usuariosSection.php";
    $cajaMensajeConfirmacion="";
    $mostrarListadoUsuarios = "block";
    $mostrarABMUsuarios = "hidden";
}















if(isset($_POST["modificarPedido"])){
    header("Location: pedido.php");
}
// if(isset($_POST["crearUsuario"])){
//     header("Location: admin.php");
// }
if(isset($_POST["crearArticulo"])){
    header("Location: admin.php");
}
$pedido = [];

$mostrarPedido = "none";
$mensajePedido = "";
if(isset($_POST["confirmar"])){
    enviarMail2();
    $mostrarInicio = "none";
    $mostrarBloque = "block";
    $bloque = "main/confirmacion.php";        
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
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="row contenedorSecundario">   
                <!-- ASIDE -->            
                <aside class="col-12 asideHidden col-md-3" id="asideBox">
                    <nav class="row centrarTexto navAside">
                        <div class="col-12">
                            MENU                       
                        </div>    
                        
                    </nav> 
                    <?php require("aside/aside.php") ?>
                </aside> 
                <!-- MAIN -->
                <main class="col-12 col-md-9" id="mainBox">
                    <nav class="row navHome justify-content-around ">
                        <div class="col-12 alignRight">
                            <p>Hola <?php echo $_SESSION["name"]?>!</p>
                        </div>    
                    </nav> 
                    <div class="section" style="display: <?php echo $mostrarInicio ?>">
                        <div class="logoInicio">
                           
                        </div>
                    </div>
                    <div class="section" style="display: <?php echo $mostrarBloque ?>">
                        <div>
                            <?php require($bloque) ?>
                        </div>
                    </div>
                  
                </main>        
            </div>        
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>     
        <script type="text/javascript"  src="js/funciones.js"></script>        
    </body>
</html>