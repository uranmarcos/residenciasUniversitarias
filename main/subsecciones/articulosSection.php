<div class="accordion" id="accordionArticulos">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseArticulos" aria-expanded="true" aria-controls="collapseArticulos">
                Articulos
            </button>
        </h2>
        <div id="collapseArticulos" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionArticulos">
            <div class="accordion-body">
                <div class="row cajaInternaBloque justify-content-around" id="adminArticulos">
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
            </div>
        </div>             
    </div>
</div>    