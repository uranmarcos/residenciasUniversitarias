
<div class="row contenedorSeccion">
    <div class="col-12 paddingCero">
        <div class="titleSection">
            Iniciar Pedido
        </div>
        <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
            <!-- BLOQUE ALIMENTOS -->
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarAlimentos()">
                    <div class="col-4">
                        Alimentos
                    </div>
                    <div class="col-1 textoNavCaja" id="navAlimentos">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaAlimentos">
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
                    <!-- </div>      -->
                </div>    
            </div>    
            <!-- BLOQUE DESAYUNOS/MERIENDA -->
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarMeriendas()">
                    <div class="col-4">
                        Desayunos / Meriendas
                    </div>
                    <div class="col-1 textoNavCaja" id="navMeriendas">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaMeriendas">
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
            <!-- BLOQUE USO PERSONAL -->
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarUsoPersonal()">
                    <div class="col-4">
                        Uso personal
                    </div>
                    <div class="col-1 textoNavCaja" id="navUsoPersonal">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaUsoPersonal">
                    <!-- <div class="row rowTitle justify-content-around"> -->
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
                    <!-- </div>      -->
                </div>    
            </div>
            <!-- BLOQUE LIMPIEZA -->
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarLimpieza()">
                    <div class="col-4">
                        Limpieza
                    </div>
                    <div class="col-1 textoNavCaja" id="navLimpieza">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaLimpieza">
                    <!-- <div class="row rowTitle justify-content-around"> -->
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
                    <!-- </div>     -->
                </div>
            </div> 
            <!-- BLOQUE OTROS -->   
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarOtros()">
                    <div class="col-4">
                        Otros
                    </div>
                    <div class="col-1 textoNavCaja" id="navOtros">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaOtros">
                    <div class="row justify-content-around">
                        <input  type="textarea" class="textarea" autocomplete="off" name="otros" for="producto">    
                    </div>    
                </div>    
            </div>
            <div>
                <div class="row rowBoton justify-content-center"> 
                    <!-- <input class="botonSubmit col-10 col-md-8 col-lg-4" type="submit" name="confirmar" value="Confirmar"> -->
                    <a href="#confirmacionPedido" class="botonConfirmarPedido col-10 col-md-8 col-lg-4">
                        <div onclick="mostrarConfirmarPedido()">Confirmar</div>
                    </a>
                </div>
            </div> 
            <div id="confirmacionPedido" class="row confirmacionPedido hidden">
                    <div class="col-12 rowConfirmarPedido">
                        ¿Desea confirmar el pedido?
                    </div>
                    <div class="col-10 rowConfirmarPedido">
                        <div class="botonConfirmarPedido col-10 col-md-8 col-lg-4" onclick="ocultarConfirmarPedido()">Cancelar</div>
                        <input class="botonConfirmarPedido col-10 col-md-8 col-lg-4" type="submit" name="confirmar" value="Confirmar">
                    </div>        
            </div> 
        </form>
    </div>
</div>