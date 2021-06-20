<?php
    $producto="";
    $categoria="";
    $medida="";
    $mensaje = "";
    $pedido = null;
    $sede = $_SESSION["sede"];

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
<div class="col-12 paddingCero">
    <div class="titleSection">
        Iniciar Pedido
    </div>
    <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
        <!-- BLOQUE ALIMENTOS -->
        <div class="sectionBloque">  
            <div class="accordion" id="accordionAlimentos">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlimentos" aria-expanded="true" aria-controls="collapseAlimentos">
                            Alimentos
                        </button>
                    </h2>
                    <div id="collapseAlimentos" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionAlimentos">
                        <div class="accordion-body">
                            <div class="row cajaInternaBloque" id="cajaAlimentos">
                            <!-- <div class="row rowTitle justify-content-around"> -->
                                <?php foreach($alimentos as $alimento){ ?>
                                    <div class="row rowProducto justify-content-around">
                                        <div class="col-12 col-md-7">
                                            <input class="anchoTotal" readonly value="<?php echo $alimento['producto']?>" name="articulo[<?php echo $alimento['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                        </div>                        
                                        <div class="col-6 col-md-3">
                                            <input class="anchoTotal" type="number" min="0" value="0"  class="col-2" for="cantidad" name="articulo[<?php echo $alimento['id']?>][cantidad]">
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <input class="anchoTotal" readonly value = "<?php echo $alimento["medida"] ?>" name="articulo[<?php echo $alimento["id"] ?>][medida]?>" class="col-2" for="medida">
                                        </div>
                                        <div class="col-12">
                                            <input  style="display:none" value = "<?php echo $alimento["categoria"] ?>" name="articulo[<?php echo $alimento["id"] ?>][categoria]?>" class="col-1" for="medida">
                                        </div>
                                        <br>
                                    </div>                 
                                <?php } ?>
                            </div>    
                        </div> 
                    </div>
                </div>
            </div>             
        </div>
        <!-- BLOQUE DESAYUNOS/MERIENDAS -->                                
        <div class="sectionBloque">  
            <div class="accordion" id="accordionDesayunos">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDesayunos" aria-expanded="true" aria-controls="collapseDesayunos">
                            Desayunos/Meriendas
                        </button>
                    </h2>
                    <div id="collapseDesayunos" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionDesayunos">
                        <div class="accordion-body">
                            <div class="row cajaInternaBloque" id="cajaMeriendas">
                            <!-- <div class="row rowTitle justify-content-around"> -->
                                <?php foreach($meriendas as $merienda){ ?>
                                    <div class="row rowProducto justify-content-around">
                                        <div class="col-12 col-md-7">
                                            <input class="anchoTotal" readonly value="<?php echo $merienda['producto']?>" name="articulo[<?php echo $merienda['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                        </div>                        
                                        <div class="col-6 col-md-3">
                                            <input class="anchoTotal" type="number" min="0" value="0"  class="col-2" for="cantidad" name="articulo[<?php echo $merienda['id']?>][cantidad]">
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <input class="anchoTotal" readonly value = "<?php echo $merienda["medida"] ?>" name="articulo[<?php echo $merienda["id"] ?>][medida]?>" class="col-2" for="medida">
                                        </div>
                                        <div class="col-12">
                                            <input  style="display:none" value = "<?php echo $merienda["categoria"] ?>" name="articulo[<?php echo $merienda["id"] ?>][categoria]?>" class="col-1" for="medida">
                                        </div>
                                        <br>
                                    </div>                
                                <?php } ?>
                            <!-- </div>      -->
                            </div> 
                        </div>             
                    </div>
                </div>
            </div>
        </div>  
        <!-- BLOQUE USO PERSONAL -->
        <div class="sectionBloque">  
            <div class="accordion" id="accordionUsoPersonal">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUsoPersonal" aria-expanded="true" aria-controls="collapseUsoPersonal">
                            Uso personal
                        </button>
                    </h2>
                    <div id="collapseUsoPersonal" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionUsoPersonal">
                        <div class="accordion-body">
                            <div class="row cajaInternaBloque" id="cajaUsoPersonal">
                                <?php foreach($usosPersonales as $usoPersonal){ ?>
                                    <div class="row rowProducto justify-content-around">
                                        <div class="col-12 col-md-7">
                                            <input class="anchoTotal" readonly value="<?php echo $usoPersonal['producto']?>" name="articulo[<?php echo $usoPersonal['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                        </div>                        
                                        <div class="col-6 col-md-3">
                                            <input class="anchoTotal" type="number" min="0" value="0"  class="col-2" for="cantidad" name="articulo[<?php echo $usoPersonal['id']?>][cantidad]">
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <input class="anchoTotal" readonly value = "<?php echo $usoPersonal["medida"] ?>" name="articulo[<?php echo $usoPersonal["id"] ?>][medida]?>" class="col-2" for="medida">
                                        </div>
                                        <div class="col-12">
                                            <input  style="display:none" value = "<?php echo $usoPersonal["categoria"] ?>" name="articulo[<?php echo $usoPersonal["id"] ?>][categoria]?>" class="col-1" for="medida">
                                        </div>
                                        <br>
                                    </div>
                                    
                                <?php } ?>
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
        </div>
        <!-- BLOQUE LIMPIEZA -->
        <div class="sectionBloque">  
            <div class="accordion" id="accordionOtros">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLimpieza" aria-expanded="true" aria-controls="collapseLimpieza">
                            Limpieza
                        </button>
                    </h2>
                    <div id="collapseLimpieza" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionLimpieza">
                        <div class="accordion-body">
                            <div class="row cajaInternaBloque" id="cajaLimpieza">
                                <?php foreach($limpieza as $producto){ ?>
                                    <div class="row  justify-content-around">
                                        <div class="col-12 col-md-7">
                                            <input  readonly class="anchoTotal" value="<?php echo $producto['producto']?>" name="articulo[<?php echo $producto['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <input type="number"  min="0" value="0" class="anchoTotal" for="cantidad" name="articulo[<?php echo $producto['id']?>][cantidad]">
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <input readonly class="anchoTotal"  value = "<?php echo $producto["medida"] ?>" name="articulo[<?php echo $producto["id"] ?>][medida]?>" class="col-2" for="medida">
                                        </div>    
                                        <div class="col-12">
                                            <input style="display:none" value = "<?php echo $producto["categoria"] ?>" name="articulo[<?php echo $producto["id"] ?>][categoria]?>" class="col-1" for="medida">
                                        </div>
                                        <br>
                                    </div>                       
                                <?php } ?> 
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
        </div>
        <!-- BLOQUE OTROS -->
        <div class="sectionBloque">  
            <div class="accordion" id="accordionOtros">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtros" aria-expanded="true" aria-controls="collapseOtros">
                            Otros
                        </button>
                    </h2>
                    <div id="collapseOtros" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionOtros">
                        <div class="accordion-body">
                            <div class="row cajaInternaBloque" id="cajaOtros">
                                <div class="row justify-content-around">
                                    <input  type="textarea" class="textarea" autocomplete="off" name="otros" for="producto">    
                                </div>    
                            </div>    
                        </div>             
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row rowBoton justify-content-center"> 
                <a href="#confirmacionPedido" class=" col-10 col-md-2">
                    <button type="button" onclick="mostrarConfirmarPedido()" class="btn btn-secondary">Confirmar</button>
                    <!-- <div onclick="mostrarConfirmarPedido()">Confirmar</div> -->
                </a>
            </div>
        </div> 
        <div id="confirmacionPedido" class="sectionBloque bloqueConfirmar hidden">
            <div class="row confirmacionPedido">
                <div class="col-12 rowConfirmarPedido">
                    ¿Desea confirmar el pedido?
                </div>
                <div class="col-12 rowConfirmarPedido" id="cajaConfirmarPedido">
                    <div class="botonConfirmarPedido col-10 col-md-4 col-lg-3" onclick="ocultarConfirmarPedido()">
                        Cancelar
                    </div>
                    <input class="botonConfirmarPedido col-10 col-md-4 col-lg-3" onclick="mostrarSpinner()" type="submit" name="confirmar" value="Confirmar">   
                </div> 
            </div>  
            <div class="col-12 row confirmacionPedido hidden" id="spinner">
                <div class="col-12 rowConfirmarPedido d-flex align-items-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>