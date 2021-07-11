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

    $consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
    $consultaAlimentos->execute();
    $alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

    $consultaMerienda = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='merienda' ORDER BY producto ASC");
    $consultaMerienda->execute();
    $meriendas = $consultaMerienda -> fetchAll(PDO::FETCH_ASSOC);

    $consultaUsoPersonal = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='uso personal' ORDER BY producto ASC");
    $consultaUsoPersonal->execute();
    $usosPersonales = $consultaUsoPersonal -> fetchAll(PDO::FETCH_ASSOC);

    $consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
    $consultaLimpieza->execute();
    $limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);
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
                        <thead>
                            <tr>
                                <th scope="col">
                                    Cód
                                </th>
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
                                <th scope="col">Medida</th>
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
                                    <td><?php echo $producto["id"] ?></td>
                                    <td><?php echo $producto["producto"] ?></td>
                                    <td><input type="number" id="input<?php echo $producto["id"]?>" value="0" onblur="validarCantidad('input<?php echo $producto['id']?>')" class="cantidadProducto" name="<?php echo $producto['id']?>"></td>
                                    <td><?php echo $producto["medida"] ?></td>
                                    <td><?php echo $producto["categoria"] ?></td>
                                    <td> 
                                        <button class="editButton" name="editarUsuario" id="<?php echo $usuario["id"]?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>                    
                        </tbody>
                    </table>             
                    <div class="row cajaInternaBloque" id="cajaOtros">
                        <div class="centrarTexto">¿Falta algo en el listado?</div>
                            <div class="row anchoTotal">
                                <input  type="textarea" id="textareaOtros" class="textarea" autocomplete="off" name="otros" for="producto">    
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
