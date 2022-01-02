<?php
session_start();
require("funciones/pdo.php");
    $producto="";
    $categoria="";
    $medida="";
    $mensaje = "";
    $pedido = null;
    $sede = $_SESSION["sede"];
    $alertErrorConexion= "hide";


    $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, M.descripcion medida, C.descripcion categoria  FROM articulos A 
    INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id ORDER BY descripcion ASC");
    $consultaProductos->execute();
    $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    
    $consultaCategorias = $baseDeDatos ->prepare("SELECT * FROM categorias WHERE habilitado = 1");
    try {
        $consultaCategorias->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $categorias = $consultaCategorias -> fetchAll(PDO::FETCH_ASSOC);

    $_SESSION["productos"] = $productos;
    // if(isset($_POST["productoAsc"])){
    //     $cat = $_POST["categoria"];
    //     if($cat == "todos"){
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto DESC");    
    //     }else{
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY producto DESC");
    //     }
    //     $consultaProductos->execute();
    //     $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // }
    // if(isset($_POST["productoDesc"])){
    //     $cat = $_POST["categoria"];
    //     if($cat == "todos"){
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto ASC");    
    //     }else{
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY producto ASC");
    //     }
    //     $consultaProductos->execute();
    //     $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // }
    // if(isset($_POST["categoriaAsc"])){
    //     $cat = $_POST["categoria"];
    //     if($cat == "todos"){
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY categoria DESC, producto ASC");    
    //     }else{
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY categoria DESC, producto ASC");
    //     }
    //     $consultaProductos->execute();
    //     $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // }
    // if(isset($_POST["categoriaDesc"])){
    //     $cat = $_POST["categoria"];
    //     if($cat == "todos"){
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY categoria ASC, producto ASC");    
    //     }else{
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY categoria ASC, producto ASC");
    //     }
    //     $consultaProductos->execute();
    //     $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // }
    // if(isset($_POST["filtrarCategorias"])){
    //     $cat = $_POST["categoria"];
    //     if($cat == "todos"){
    //         $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto ASC");    
    //     }else{
    //        $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY producto ASC");
    //     }
    //     $consultaProductos->execute();
    //     $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    // }
?>
<script>
    function pulsar(e) {
        tecla = (document.querySelectorAll) ? e.keyCode : e.which;
        return (tecla != 13);
    }      
</script>    
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
            <div class="sectionBloque mt-2">
                <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" role="alert" >
                    Hubo un error de conexión. Por favor actualizá la página
                </div>
            </div>
            <div class="col-12 paddingCero">
                <div class="titleSection">
                    Generar Pedido
                </div>
            </div>
            <div class="sectionBloque mt-1">
                <div class="contenedorSeccion contenedorModal <?php echo $mostrarListadoUsuarios ?>">
                    <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
                        <div class="table-responsive">
                            <table class="table" id="tableUsuarios">
                                <div class="row bg-grey d-flex align-items-center p-0 m-0 justify-content-around" style="width:100%">
                                    <div class="col-12 col-sm-6 col-md-5">
                                        <div class="row rowFiltro">
                                            <input type="textarea" class="col-12 " placeholder="Buscar por producto" onkeyup="filtrar()" id="buscadorProducto" value ="">
                                        </div>
                                    </div>    
                                    <div class="col-12 col-sm-6 col-md-5">
                                        <div class="row rowFiltro">
                                            <select style="height:30px" class="col-12" name="categoria" onchange="filtrar()" id="selectCategoria">
                                                <option value="todos">Filtrar las categorias</opcion>
                                                <?php foreach($categorias as $categoria){ ?>
                                                    <option value="<?php echo $categoria['descripcion'] ?>" ><?php echo $categoria["descripcion"]?></opcion>
                                                <?php } ?>
                                            </select>   
                                        </div>
                                    </div> 
                                    <div class="col-12 col-md-2 mb-2 hide mb-md-0" id="boxBotonFiltro">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button type="submit" class="botonQuitarFiltro" name="reiniciarPedido" onclick="resetPedido()" class="editButton botonReiniciar">
                                                Quitar
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Producto
                                            <button name="productoDesc" class="editButton">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </button>    
                                            <button name="productoAsc" class="editButton">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                                                </svg>
                                            </button>
                                        </th>
                                        <th scope="col">Cantidad</th>
                
                                        <th scope="col">
                                            Categoria
                                            <button name="categoriaDesc" class="editButton">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </button>
                                            <button name="categoriaAsc" class="editButton">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                                                </svg>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($productos as $producto){ ?>
                                        <tr>
                                            <td class="productos">
                                                <?php echo $producto["descripcion"] ?>
                                                <br>
                                                <div style="font-size:10px"><?php echo $producto["medida"] ?></div>
                                            </td>
                                            <td><input type="number" min=0 id="input<?php echo $producto["id"]?>" value="0" onfocus="inputFocusOn()" onkeydown="limpiarInputFocus" onblur="inputFocusOut('input<?php echo $producto['id']?>')" class="cantidadProducto" name="<?php echo $producto['id']?>"></td>
                                            <td class="categorias"><?php echo $producto["categoria"] ?></td>
                                            <td> 
                                                <div class="editButton pt-1"  onclick="borrarCantidad('<?php echo $producto['id']?>')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>                    
                                </tbody>
                            </table>             
                            <div class="row cajaInternaBloque" id="cajaOtros">
                                <div class="centrarTexto">¿Falta algo en el listado?</div>
                                    <div class="row anchoTotal">
                                        <input  type="textarea" id="textareaOtros" class="textarea" autocomplete="off" onblur="guardarOtros('textareaOtros')" name="otros" for="producto">    
                                    </div>    
                                </div> 
                            </div>
                            <div>
                                <div class="row rowBoton d-flex justify-content-center"> 
                                    <button type="submit" name="generarPedido" class="button">Confirmar</button>
                                </div>
                            </div> 
                        </div>                          
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    cargarPedido();
    function filtrar() {
        let producto = document.getElementById("buscadorProducto").value;
        let boxBotonFiltro = document.getElementById("boxBotonFiltro");
        let categoria = document.getElementById("selectCategoria").value;
        if(producto.trim() != "" && categoria != "todos"){
            buscarProducto(producto)
            filtrarCategoria(categoria)
            boxBotonFiltro.classList.remove("hide")
        } else if(producto.trim() != "" && categoria == "todos") {
            quitarFiltros("categorias")
            buscarProducto(producto)
            boxBotonFiltro.classList.remove("hide")
        }
        else if(producto.trim() == "" && categoria != "todos") {
            quitarFiltros("productos")
            filtrarCategoria(categoria)
            boxBotonFiltro.classList.remove("hide")
        } else {
            quitarFiltros("productos")
            quitarFiltros("categorias")
            boxBotonFiltro.classList.add("hide")
        }
    }
    function quitarFiltros(parametro){
        let listaProductos = document.querySelectorAll("."+parametro);
        for (item of listaProductos){
            item.parentNode.classList.remove("hidden");
        }
    }
    function buscarProducto(producto){
        let listaProductos = document.querySelectorAll(".productos");
        for (item of listaProductos){
            if(producto.toLowerCase() != item.innerHTML.trim().substring(0, producto.length).toLowerCase()){
                item.parentNode.classList.add("hidden");
            }
        }
    }
    function filtrarCategoria(categoria){
        let listaProductos = document.querySelectorAll(".categorias");
        for (item of listaProductos){
            if(categoria.toLowerCase() != item.innerHTML.trim().substring(0, categoria.length).toLowerCase()){
                item.parentNode.classList.add("hidden");
            }
        }
    }
</script>
