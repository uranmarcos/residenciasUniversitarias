
<div class="row contenedorSeccion">
    <div class="col-12 paddingCero">
        <div class="titleSection">
            Iniciar Pedido
        </div>
        <form method="POST" action="inicio.php">
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
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarLimpieza()">
                    <div class="col-4">
                        Limpieza/Higiene
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
                    <input class="botonSubmit col-10 col-md-8 col-lg-4" type="submit" name="confirmar" value="Confirmar">
                </div>
            </div>  
        </form>
    </div>
</div>