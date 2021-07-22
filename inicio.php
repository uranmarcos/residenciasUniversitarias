<?php
session_start();
require("funciones/pdo.php");
$bloque = "main/inicioLogo.php";
$bloqueAdmin="hidden";
$title= "";
$mostrarTitle = "none";
$cajaMensajeConfirmacion="hidden";
$subSeccionAdmin="";
$mensajeConfirmacionAccion = "";
if(isset($_POST["errorMail"])){
    $mostrarTitle = "block";
    $title= "Confirmacion";
    $bloque = "main/confirmarPedido.php";
}

if(isset($_POST["errorCancelar"])){
    $mostrarTitle = "block";
    $title= "Confirmacion";
    $bloque = "main/confirmarPedido.php";
}
if(isset($_POST["generarPedido"])){
    $mostrarTitle = "block";
    $title= "Confirmacion";
    $bloque = "main/confirmarPedido.php";
}
if(isset($_POST["errorPedido"])){
    $mostrarTitle = "block";
    $title= "Generar Pedido";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["errorConsulta"])){
    $mostrarTitle = "block";
    $title= "Pedidos realizados - " . $_SESSION["sede"] . " - Casa" . $_SESSION["casa"];
    $bloque = "main/pedidosAnteriores.php";
}
if(isset($_POST["cancelarPedido"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
    try{
        $id = $_SESSION['idPedido'];
        $consulta = $baseDeDatos ->prepare("DELETE FROM pedidos where id ='$id'");
        $consulta->execute();
    }catch(Exception $exception){
        echo "<script>location.href='errorCancelar.php';</script>";
        die;
    }
}
if(isset($_POST["enviarMail"])){
    $mostrarTitle = "block";
    $title= "Listo!";
    $bloque = "main/confirmacion.php";
}
//BOTONES ASIDE
if(isset($_POST["cerrarSesion"])){
    header("Location: destroy.php");
}
if(isset($_POST["perfil"])){
    $mostrarTitle = "block";
    $title= "Mi perfil";
    $bloque = "main/perfil.php";
}
if(isset($_POST["admin"])){
    $mostrarTitle = "block";
    $title= "Admin";
    $bloque = "main/admin.php";
}
if(isset($_POST["pedidosAnteriores"])){
    $mostrarTitle = "block";
    $title= "Pedidos realizados - " . $_SESSION["sede"] . " - Casa" . $_SESSION["casa"];
    $bloque = "main/pedidosAnteriores.php";
}
if(isset($_POST["iniciarPedido"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["volver"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
}

//BOTONES INICIAR PEDIDO
if(isset($_POST["productoAsc"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/admin/iniciarPedido.php";
}
if(isset($_POST["productoDesc"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["categoriaAsc"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["categoriaDesc"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["filtrarCategorias"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";
    $bloque = "main/iniciarPedido.php";
}
if(isset($_POST["reiniciarPedido"])){
    $mostrarTitle = "block";
    $title= "Generar pedido";   
    $bloque = "main/iniciarPedido.php";
}


//BOTONES ADMIN
if(isset($_POST["adminSedes"])){
    $mostrarTitle = "block";
    $title= "Admin - Sedes";
    $bloque = "main/admin/adminSedes.php";
}
if(isset($_POST["adminCategorias"])){
    $mostrarTitle = "block";
    $title= "Admin - Categorias";
    $bloque = "main/admin/adminCategorias.php";
}
if(isset($_POST["adminUsuarios"])){
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminListadoUsuarios.php";
}
if(isset($_POST["adminArticulos"])){
    $mostrarTitle = "block";
    $title= "Admin - Articulos";
    $bloque = "main/admin/adminListadoArticulos.php";
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
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminListadoUsuarios.php";
    $cajaMensajeConfirmacion="";
    $mensajeConfirmacionAccion = "El usuario se creó correctamente!";
}
if(isset($_POST["nameAsc"]) || 
    (isset($_POST["nameDesc"])) ||
    (isset($_POST["apellidoAsc"])) ||
    (isset($_POST["apellidoDesc"])) ||
    (isset($_POST["dniAsc"])) ||
    (isset($_POST["dniDesc"])) ||
    (isset($_POST["sedeAsc"])) ||
    (isset($_POST["sedeDesc"])) ||
    (isset($_POST["filtrarSede"]))
    ){
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminListadoUsuarios.php";
}
if(isset($_POST["crearUsuario"])){
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminCrearUsuario.php";
}
if(isset($_POST["editarUsuario"])){
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminEditarUsuario.php";
}
if(isset($_POST["editUser"])){
    $id = $_POST["inputId"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $sede = $_POST["sede"];
    $casa = $_POST["casa"];
    $rol = $_POST["rol"];
    $mail = $_POST["mail"];
    try{
        $consulta = $baseDeDatos ->prepare("UPDATE usuarios SET
            mail = '$mail',
            rol = '$rol',
            nombre = '$nombre',
            apellido ='$apellido',
            dni = '$dni',
            sede = '$sede',
            casa = '$casa'
            WHERE
            id = '$id'
            ");
        $consulta->execute();
    }catch(Exception $exception){
        $exception = "UPS, hubo error y el usuario no pudo modificarse! Por favor intentalo nuevamente";   
        $mensajeUsuario = $exception;
        return;
    }
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminListadoUsuarios.php";
    $cajaMensajeConfirmacion="";
    $mensajeConfirmacionAccion = "El usuario se modificó correctamente!";
}
if(isset($_POST["deleteUser"])){
    $id = $_COOKIE["deleteUser"];
    try{
        $consulta = $baseDeDatos ->prepare("DELETE FROM usuarios WHERE id = '$id' ");
        $consulta->execute();
    }catch(Exception $exception){
        $exception = "UPS, hubo error y el usuario no pudo modificarse! Por favor intentalo nuevamente";   
        $mensajeUsuario = $exception;
        echo $mensajeUsuario;
        return;
    }
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminListadoUsuarios.php";
    $cajaMensajeConfirmacion="";
    $mensajeConfirmacionAccion = "El usuario se eliminó correctamente!";
}
if(isset($_POST["cancelCrearUsuario"])){
    $mostrarTitle = "block";
    $title= "Admin - Usuarios";
    $bloque = "main/admin/adminListadoUsuarios.php";
}
if(isset($_POST["articuloAsc"]) || 
    (isset($_POST["articuloDesc"])) ||
    (isset($_POST["medidaAsc"])) ||
    (isset($_POST["medidaDesc"])) ||
    (isset($_POST["catAsc"])) ||
    (isset($_POST["catDesc"])) ||
    (isset($_POST["filtrarCates"]))
    ){
    $mostrarTitle = "block";
    $title= "Admin - Articulos";
    $bloque = "main/admin/adminListadoArticulos.php";
}
if(isset($_POST["crearArticulo"])){
    header("Location: admin.php");
}
$pedido = [];
$mostrarPedido = "none";
$mensajePedido = "";
if(isset($_POST["confirmar"])){
    enviarMail2();

    $mostrarTitle = "block";
    $title= "Listo!";
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
        <link href="css/aside.css" rel="stylesheet">
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
                    <div class="section" >
                        <div class="col-12 paddingCero">
                            <div class="titleSection" style="display: <?php echo $mostrarTitle?>">
                                <?php echo $title?>
                            </div>
                            <div>
                                <?php require($bloque) ?>
                            </div>
                        </div>
                    </div>
                </main>
                <main class="col-12 hidden" id="menuBurguer">
                    <nav class="row navHome justify-content-around ">
                        <div class="col-12 alignRight">
                            <p>Hola <?php echo $_SESSION["name"]?>!</p>
                        </div>    
                    </nav>
                    <div class="section">
                        <div>
                            <?php require("componentes/menu.php") ?>
                        </div>
                    </div> 
                </main>        
            </div>        
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>     
        <script type="text/javascript"  src="js/funciones.js"></script>        
    </body>
</html>
<script>
    ajustarAside();
</script>