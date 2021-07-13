<?php
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
<div class="col-12 paddingCero">
    <div class="titleSection">
        Admin
    </div>
    <form method="POST" action="inicio.php">
        <div class="row navAdmin">
            <button type="submit" name="adminSedes" class="btn botonNavAdmin col-6 col-md-3">Sedes</button>
            <button type="submit" name="adminCategorias" class="btn botonNavAdmin col-6 col-md-3">Categorias</button>
            <button type="submit" name="adminUsuarios" class="btn botonNavAdmin col-6 col-md-3">Usuarios</button>
            <button type="submit" name="adminArticulos" class="btn botonNavAdmin col-6 col-md-3">Articulos</button>           
        </div>
    </form>
    <div class="sectionBloque <?php echo $bloqueAdmin ?>">  
        <?php require($subSeccionAdmin)?>
    </div>  

</div> 

