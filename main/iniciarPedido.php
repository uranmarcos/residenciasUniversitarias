<?php
    $producto="";
    $categoria="";
    $medida="";
    $mensaje = "";
    $pedido = null;
    $sede = $_SESSION["sede"];

    $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto ASC");
    $consultaProductos->execute();
    $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["productos"] = $productos;

    if(isset($_POST["productoAsc"])){
        $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto DESC");
        $consultaProductos->execute();
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["productoDesc"])){
        $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto ASC");
        $consultaProductos->execute();
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["categoriaAsc"])){
        $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY categoria DESC, producto ASC");
        $consultaProductos->execute();
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["categoriaDesc"])){
        $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY categoria ASC, producto ASC");
        $consultaProductos->execute();
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["filtrarCategorias"])){
        $cat = $_POST["categoria"];
        if($cat == "todos"){
            $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos ORDER BY producto ASC");    
        }else{
           $consultaProductos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='$cat' ORDER BY producto ASC");
        }
        $consultaProductos->execute();
        $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    }
?>
<script>
    function pulsar(e) {
        tecla = (document.querySelectorAll) ? e.keyCode : e.which;
        return (tecla != 13);
    }      
</script>    
<div class="col-12 paddingCero">
    <div class="titleSection">
        Iniciar pedido
    </div>
    <div class="sectionBloque">
        <div class="contenedorSeccion contenedorModal <?php echo $mostrarListadoUsuarios ?>">
            <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
                <div class="row modalBox hidden" id="avisoPedidoVacio">
                    <div class="row d-flex justify-content-center">
                        <div class="centrarTexto mb-5">Disculpe, no puede generar un pedido vacio.</div>
                        <div onclick="ocultarPedidoVacio('modalNewUser')" class="button">Aceptar</div>
                    </div>    
                </div>
                <div class="row modalBox hidden" id="confirmacionPedido">
                    <div  class="d-flex align-items-center justify-content-center ">
                        <div class="row confirmacionPedido">
                            <div class="col-12 rowConfirmarPedido">
                                ¿Desea confirmar el pedido?
                            </div>
                            <div class="col-12 rowConfirmarPedido d-flex justify-content-around" id="cajaConfirmarPedido">
                                <div class="button " onclick="ocultarConfirmarPedido()">
                                    Cancelar
                                </div>
                                <button class="button" onclick="mostrarSpinner()" type="submit" name="confirmar">Confirmar</button>   
                            </div> 
                        </div>  
                        <div class="row hidden confirmacionPedido " id="spinner">
                            <div class="col-12 rowConfirmarPedido d-flex align-items-center">
                                <div class="spinner-border text-secondary" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="table-responsive">
                    <table class="table" id="tableUsuarios">
                        <div class="row">
                            <div class="col-12 col-lg-5 colBuscador">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </div>
                                <input type="textarea" onkeyup="buscarProducto()" id="buscador" value ="">
                                <div class="editButton" onclick="limpiarBuscador()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg m-1" viewBox="0 0 16 16">
                                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                    </svg>
                                </div>
                            </div>    
                            <div class="col-12 col-lg-5 colBuscador">
                                <select name="categoria" onchange="changeCategoria()" id="selectCategoria">
                                    <option value="todos">Todas</opcion>
                                    <option value="alimentos" >Alimentos</opcion>
                                    <option value="merienda">Desayuno/merienda</opcion>
                                    <option value="limpieza">Limpieza</opcion>
                                    <option value="usoPersonal">Uso Personal</opcion>
                                </select>   
                                <button type="submit" name="filtrarCategorias" class="editButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                            </div> 
                            <div class="col-12 col-lg-2 colBuscador">
                                <button type="submit" name="reiniciarPedido" onclick="resetPedido()" class="editButton">
                                   Reiniciar
                                </button>
                            </div> 
                        </div>
                        <thead>
                            <tr>
                                <!-- <th scope="col">
                                    Cód
                                </th> -->
                                <th scope="col">
                                    Producto
                                    <button name="productoDesc" onclick="resetCategoriaSeleccionada()" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>    
                                    <button name="productoAsc" onclick="resetCategoriaSeleccionada()" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                                        </svg>
                                    </button>
                                </th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Medida</th>
                                <th scope="col">
                                    Categoria
                                    <button name="categoriaDesc" onclick="resetCategoriaSeleccionada()" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                    <button name="categoriaAsc" onclick="resetCategoriaSeleccionada()" class="editButton">
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
                                    <td class="productos"><?php echo $producto["producto"] ?></td>
                                    <td><input type="number" min=0 id="input<?php echo $producto["id"]?>" value="0" onfocus="inputFocusOn()" onkeydown="limpiarInputFocus" onblur="inputFocusOut('input<?php echo $producto['id']?>')" class="cantidadProducto" name="<?php echo $producto['id']?>"></td>
                                    <td><?php echo $producto["medida"] ?></td>
                                    <td><?php echo $producto["categoria"] ?></td>
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
                            <a href="#confirmacionPedido" >
                                <button type="button" onclick="mostrarConfirmarPedido()" class="button">Confirmar</button>
                            </a>
                        </div>
                    </div> 
                </div>                          
            </form>
        </div>
    </div>
</div>
<script>
    cargarPedido();
</script>
