<?php
session_start();
require("funciones/pdo.php");
$subSeccionAdmin = null;
$mostrarBloque="hide";
if(isset($_GET["adminSedes"])){
    $subSeccionAdmin = "componentesAdmin/adminSedes.php";
    $mostrarBloque="show";
}
if(isset($_GET["adminCategorias"])){
    $mostrarBloque="show";
    $subSeccionAdmin = "componentesAdmin/adminCategorias.php";
    
}
if(isset($_GET["adminArticulos"])){
    $mostrarBloque="show";
    $subSeccionAdmin = "componentesAdmin/adminArticulos.php";
}
if(isset($_GET["adminUsuarios"])){
    $mostrarBloque="show";
    $subSeccionAdmin = "componentesAdmin/adminUsuarios.php";
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
            <div class="submenu">
                <form method="GET" action="admin.php">
                    <div class="row navAdmin">
                        <button type="submit" name="adminSedes" class="btn botonNavAdmin col-6 col-md-3">Sedes</button>
                        <button type="submit" name="adminCategorias" class="btn botonNavAdmin col-6 col-md-3">Categorias</button>
                        <button type="submit" name="adminUsuarios" onclick="resetSede()" class="btn botonNavAdmin col-6 col-md-3">Usuarios</button>
                        <button type="submit" name="adminArticulos" class="btn botonNavAdmin col-6 col-md-3">Articulos</button>           
                    </div>
                </form>
            </div>
            <div class="<?php echo $mostrarBloque?>">
                <?php require($subSeccionAdmin)?>
            </div>    
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>           
        <script type="text/javascript"  src="js/adminArticulos.js"></script> 
        <script type="text/javascript"  src="js/adminCategorias.js"></script> 
        <script type="text/javascript"  src="js/adminSedes.js"></script> 
        <script type="text/javascript"  src="js/adminUsuarios.js"></script> 
    </body>
</html>