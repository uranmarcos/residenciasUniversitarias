<?php 

$producto="";
$categoria="";
$medida="";
$mensaje = "";


$consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
$consultaAlimentos->execute();
$alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

$consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
$consultaLimpieza->execute();
$limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);

?>
<div class="row contenedorSeccion">
    <div class="col-12 paddingCero">
        <div class="titleSection">
            Iniciar Pedido
        </div>
        <form method="POST" action="pedidos.php">
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarAlimentos()">
                    <div class="col-4">
                        Alimentos
                    </div>
                    <div class="col-1 textoNavCaja" id="navAlimentos">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaAlimentos">
                    <div class="row rowTitle justify-content-around">
                        <label class="col-6 col-md-4" for="producto"> Producto: </label>
                        <label class="col-2" for="cantidad"> Cantidad: </label>
                        <label class="col-2" for="cantidad"> Medida: </label>
                    </div>
                    <?php foreach($alimentos as $alimento){ ?>
                        <div class="row rowProducto justify-content-around">
                            <input class="col-6 col-md-4" value="<?php echo $alimento['producto']?>" name="articulo[<?php echo $alimento['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                            <input type="number"  min="<?php echo $alimento["producto"] ?>" class="col-2" for="cantidad" name="articulo[<?php echo $alimento['id']?>][cantidad]">
                            <input  value = "<?php echo $alimento["medida"] ?>" name="articulo[<?php echo $alimento["id"] ?>][medida]?>" class="col-2" for="medida">
                            <input style="display:none" value = "<?php echo $alimento["categoria"] ?>" name="articulo[<?php echo $alimento["id"] ?>][categoria]?>" class="col-2" for="medida">
                        </div>
                    <?php } ?> 
                </div>    
            </div>    
            <div class="bloque">
                <div class="row rowTipoProducto justify-content-between" onclick="mostrarLimpieza()">
                    <div class="col-4">
                        Limpieza
                    </div>
                    <div class="col-1 textoNavCaja" id="navLimpieza">
                    </div>
                </div>    
                <div class="row cajaInternaBloque hidden" id="cajaLimpieza">
                    <div class="row rowTitle justify-content-around">
                        <label class="col-4" for="producto"> Producto: </label>
                        <label class="col-2" for="cantidad"> Cantidad: </label>
                        <label class="col-2" for="cantidad"> Medida: </label>
                    </div>
                    <?php foreach($limpieza as $producto){ ?>
                        <div class="row rowProducto justify-content-around">
                            <input class="col-4" value="<?php echo $producto['producto']?>" name="articulo[<?php echo $producto['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                            <input type="number"  min="<?php echo $producto["producto"] ?>" class="col-2" for="cantidad" name="articulo[<?php echo $producto['id']?>][cantidad]">
                            <input  value = "<?php echo $producto["medida"] ?>" name="articulo[<?php echo $producto["id"] ?>][medida]?>" class="col-2" for="medida">
                            <input style="display:none" value = "<?php echo $producto["categoria"] ?>" name="articulo[<?php echo $producto["id"] ?>][categoria]?>" class="col-2" for="medida">
                        </div>
                    <?php } ?> 
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
                    <input class="botonSubmit col-10 col-md-8 col-lg-4" type="submit" name="prepararPedido" value="Revisar pedido">
                </div>
            </div>  
        </form>
    </div>
</div>