<?php
session_start();
require("funciones/pdo.php");
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";

    // CONSULTAS INICIALES LISTADO DE ARTICULOS, MEDIDAS Y CATEGORIAS
    $consultaUsuarios = $baseDeDatos ->prepare("SELECT U.id, U.nombre, U.segundoNombre, U.apellido, U.mail, U.dni, U.sede idSede, U.rol, S.descripcion 'sede', U.casa, U.habilitado FROM agentes U INNER JOIN sedes S ON U.sede = S.id");
    $consultaSedes = $baseDeDatos ->prepare("SELECT * FROM sedes WHERE habilitado = '1'");
    
    try {
        $consultaUsuarios->execute();
        $consultaSedes->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    $sedes = $consultaSedes -> fetchAll(PDO::FETCH_ASSOC);
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($usuarios) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }
 
    // OPCIONES DE ROLES PARA LA CREACION DE USUARIOS
    $rol = "general";
    if($rol == "admin") {
        $roles = [
            [ "value"=> "admin", "descripcion"=> "Admin"],
            ["value"=> "general", "descripcion"=> "General"],
            [ "value"=> "stock", "descripcion"=> "Stock"]
        ];
    } else if($rol == "general") {
        $roles = [
            [ "value"=> "stock", "descripcion"=> "Stock"],
            ["value"=> "general", "descripcion"=> "General"]
        ];
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
                            <thead>
                                <tr>
                                    <th scope="col" >#</th>
                                    <th scope="col" style="width:40%">Fecha</th>
                                    <th scope="col" style="width:40%">Voluntario</th>
                                    <th scope="col" style="width:10%">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($usuarios as $usuario){ ?>
                                        <tr>
                                            <td><?php echo $usuario["id"] ?></td>
                                            <td><?php echo $usuario["nombre"] . " " . $usuario["segundoNombre"] ?></td>
                                            <td><?php echo $usuario["nombre"] . " " . $usuario["segundoNombre"] ?></td>
                                            <td class="d-flex justify-content-end"> 
                                                <button type="button" class="btn editButton" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
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
</script>