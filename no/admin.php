<?php
    session_start();
    require("funciones/pdo.php");

    $consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
    $consultaAlimentos->execute();
    $alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

    $consultaMeriendas = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='merienda' ORDER BY producto ASC");
    $consultaMeriendas->execute();
    $meriendas = $consultaMeriendas -> fetchAll(PDO::FETCH_ASSOC);

    $consultaUsosPersonales = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='uso personal' ORDER BY producto ASC");
    $consultaUsosPersonales->execute();
    $usosPersonales = $consultaUsosPersonales -> fetchAll(PDO::FETCH_ASSOC);

    $consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
    $consultaLimpieza->execute();
    $limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);

    $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY apellido ASC");
    $consultaUsuarios->execute();
    $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    $mensajeProducto ="";
    $mensajeUsuario = "";

    if(isset($_POST["crearUsuario"])){
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST["dni"];
            $sede = $_POST["sede"];
            $casa = $_POST["casa"];
            $rol = $_POST["rol"];
            $mail = $_POST["mail"];

            try{
                $consulta = $baseDeDatos ->prepare("INSERT into usuarios VALUES(default, '$mail', '$rol',
                '$dni', '$nombre', '$apellido', '$dni', '$sede', '$casa')");
                $consulta->execute();
                $usuario =$consulta -> fetchAll(PDO::FETCH_ASSOC);
                $mensajeUsuario = "El usuario se creó correctamene";
            }catch(Exception $exception){
                $exception = "UPS, hubo error y el usuario no pudo crearse! Por favor intentalo nuevamente";   
                $mensajeUsuario = $exception;
                return;
            }
    }
    if(isset($_POST["crearArticulo"])){
        $producto = $_POST["producto"];
        $categoria = $_POST["categoria"];
        $medida = $_POST["medida"];
        $disponible = 1;
        try{
            $consulta = $baseDeDatos ->prepare("INSERT into productos VALUES(default, '$producto', '$categoria',
            '$medida', '$disponible')");
            $consulta->execute();
            $producto =$consulta -> fetchAll(PDO::FETCH_ASSOC);
            $mensajeProducto = "El producto se creó correctamene";
        }catch(Exception $exception){
            $exception = "UPS, hubo error y el usuario no pudo crearse! Por favor intentalo nuevamente";   
            $mensajeProducto = $exception;
            return;
        }
    }

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
                                        Admin
                                    </div>
                                    <form class="col-12 contenedorBloques" action="inicio.php" method="POST">
                                         <!-- CAJA USUARIOS -->  
                                         <div class="bloque">            
                                            <div class="row justify-content-between rowTipoProducto" onclick="mostrarAdminUsuarios()">
                                                <div class="col-6">
                                                    Usuarios
                                                </div> 
                                                <div class="col-1" id="navAdminUsuarios">
                                                </div>
                                            </div>           
                                            <div class="row hidden cajaInternaBloque justify-content-around" id="adminUsuarios">
                                                <div class="row cajaInternaBloque">
                                                    <div class="row anchoTotal">
                                                        <div class="row justify-content-between">
                                                            <label class="col-5" > Nombre: </label>
                                                            <label class="col-6" > Apellido: </label>               
                                                        </div>
                                                        <div class="row justify-content-between">
                                                            <input class="col-5" name="nombre">
                                                            <input class="col-6" name="apellido">                              
                                                        </div>
                                                        <div class="row justify-content-between">
                                                            <label class="col-5" > Mail: </label>
                                                            <label class="col-5" > Sede: </label>
                                                        </div>
                                                        <div class="row justify-content-between">
                                                            <input class="col-5" name="mail">
                                                            <input class="col-5" name="sede">
                                                        </div>
                                                        <div class="row justify-content-between">
                                                            <label class="col-3" > DNI: </label>
                                                            <label class="col-3" > Rol: </label>
                                                            <label class="col-3" > Casa: </label>
                                                        </div> 
                                                        <div class="row justify-content-between">
                                                            <input class="col-3" name="dni">
                                                            <select class="col-3" name="rol">
                                                                <option value="">Seleccionar</option>
                                                                <option value="voluntario">Voluntario</option>
                                                                <option value="admin">Admin</option>
                                                            </select>  
                                                            <input type="number" value="1" min="1" class="col-3" name="casa">
                                                        </div> 
                                                        <div class="row rowConfirmar justify-content-center">
                                                            <input type="submit" class="botonConfirmar" name="crearUsuario" value="Crear Usuario">
                                                            <div class="mensaje" style="color: <?php echo $colorMensaje ?>">
                                                                <?php echo $mensajeUsuario ?>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>  
                                                <div class="row cajaInternaBloque">
                                                    <div class="cajaSeparadoraListado">
                                                        <div class="subtitle">
                                                            Usuarios Existentes
                                                        </div>
                                                        <?php foreach($usuarios as $usuario){ ?>
                                                            <div class="row rowProducto justify-content-around">
                                                                <?php echo $usuario["nombre"] . " " . $usuario["apellido"] . 
                                                                " - " . $usuario["rol"] . " - " . $usuario["sede"] ." - Casa: " . 
                                                                $usuario["casa"] ?>                               
                                                            </div>
                                                        <?php } ?> 
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>      
                                        <!-- CAJA ARTICULOS -->
                                        <div class="bloque">
                                            <div class="row justify-content-between rowTipoProducto" onclick="mostrarAdminArticulos()">
                                                <div class="col-6">
                                                    Articulos
                                                </div> 
                                                <div class="col-1" id="navAdminArticulos">
                                                </div>       
                                            </div>
                                            <div class="row hidden cajaInternaBloque justify-content-around" id="adminArticulos">
                                                <div class="row rowTitle justify-content-around">    
                                                    <div class="col-5">
                                                        <div class="row">
                                                            <label class="col-11" for="producto"> Nuevo producto: </label>
                                                            <input class="col-11" name="producto">
                                                        </div>
                                                    </div>    
                                                    <div class="col-5">
                                                        <div class="row">    
                                                            <label class="col-11" for="medida"> Medida: </label>
                                                            <select class="col-11" name="medida">
                                                                <option value="">Seleccionar</option>
                                                                <option value="Cajas">Cajas</option>
                                                                <option value="Kilogramos">Kilogramos</option>
                                                                <option value="Latas">Latas</option>
                                                                <option value="Litros">Litros</option>
                                                                <option value="Rollos">Rollos</option>
                                                                <option value="Saquitos">Saquitos</option>
                                                                <option value="Sobres">Sobres</option>
                                                                <option value="Unidades">Unidades</option>   
                                                            </select> 
                                                        </div>
                                                    </div> 
                                                    <div class="col-5">
                                                        <div class="row">
                                                            <label class="col-11" for="categoria"> Categoria: </label>
                                                            <select class="col-11" name="categoria">  
                                                                <option value="">Seleccionar</option>
                                                                <option value="alimentos">Alimentos</option>
                                                                <option value="merienda">Merienda</option>
                                                                <option value="uso personal">Uso Personal</option>
                                                                <option value="limpieza">Limpieza</option>
                                                            </select>
                                                        </div>
                                                    </div>        
                                                    <div class="col-5">     
                                                        <input type="submit" class="botonConfirmar" name="crearArticulo" value="Confirmar">
                                                        <div class="mensaje" style="color: <?php echo $colorMensaje ?>">
                                                            <?php echo $mensajeProducto ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row  cajaInternaBloque">
                                                    <div class="row anchoTotal">
                                                        <div class="cajaSeparadoraListado">
                                                            <div class="subtitle">Alimentos</div>
                                                            <div class="row rowTitle justify-content-around">
                                                                <label class="col-8" for="producto"> Producto: </label>           
                                                                <label class="col-2" for="cantidad"> Medida: </label>   
                                                            </div>
                                                            <?php foreach($alimentos as $alimento){?>
                                                                <div class="row rowProducto justify-content-around">
                                                                    <input readonly class="col-8" value="<?php echo $alimento['producto']?>" name="articulo[<?php echo $alimento['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                                                    <input readonly value = "<?php echo $alimento["medida"] ?>" name="articulo[<?php echo $alimento["id"] ?>][medida]?>" class="col-2" for="medida">
                                                                </div>
                                                            <?php } ?> 
                                                        </div>
                                                        <div class="cajaSeparadoraListado">
                                                            <div class="subtitle">Desayuno/Merienda</div>
                                                            <div class="row rowTitle justify-content-around">
                                                                <label class="col-8" for="producto"> Producto: </label>           
                                                                <label class="col-2" for="cantidad"> Medida: </label>   
                                                            </div>
                                                            <?php foreach($meriendas as $merienda){?>
                                                                <div class="row rowProducto justify-content-around">
                                                                    <input readonly class="col-8" value="<?php echo $merienda['producto']?>" name="articulo[<?php echo $merienda['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                                                    <input readonly value = "<?php echo $merienda["medida"] ?>" name="articulo[<?php echo $merienda["id"] ?>][medida]?>" class="col-2" for="medida">
                                                                </div>
                                                            <?php } ?> 
                                                        </div>
                                                        <div class="cajaSeparadoraListado">
                                                            <div class="subtitle">Uso Personal</div>
                                                            <div class="row rowTitle justify-content-around">
                                                                <label class="col-8" for="producto"> Producto: </label>           
                                                                <label class="col-2" for="cantidad"> Medida: </label>   
                                                            </div>
                                                            <?php foreach($usosPersonales as $usoPersonal){?>
                                                                <div class="row rowProducto justify-content-around">
                                                                    <input readonly class="col-8" value="<?php echo $usoPersonal['producto']?>" name="articulo[<?php echo $usoPersonal['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                                                    <input readonly value = "<?php echo $usoPersonal["medida"] ?>" name="articulo[<?php echo $usoPersonal["id"] ?>][medida]?>" class="col-2" for="medida">
                                                                </div>
                                                            <?php } ?> 
                                                        </div>
                                                        <div class="cajaSeparadoraListado">
                                                            <div class="subtitle">Limpieza</div>
                                                                <div class="row rowTitle justify-content-around">
                                                                    <label class="col-8" for="producto"> Producto: </label>        
                                                                    <label class="col-2" for="cantidad"> Medida: </label>            
                                                                </div>
                                                                <?php foreach($limpieza as $articulo){ ?>
                                                                    <div class="row rowProducto justify-content-around">
                                                                        <input readonly class="col-8" value="<?php echo $articulo['producto']?>" name="articulo[<?php echo $articulo['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                                                        <input readonly value = "<?php echo $articulo["medida"] ?>" name="articulo[<?php echo $articulo["id"] ?>][medida]?>" class="col-2" for="medida">
                                                                    </div>
                                                                <?php } ?> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
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