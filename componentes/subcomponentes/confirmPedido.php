
    <div class="row rowTitulo justify-content-center">
            Pedido Generado
    </div> 
    <div class="contenedorConfirmar">
    <div class="row cajaProductos"> 
        <div class="col-10 col-md-6 cardPedido">
            <div class="listadoTitle">
                Alimentos:
            </div>
            <?php foreach ($_POST["articulo"] as $producto){?>
                <div class="row listado">
                    <?php 
                        if($producto["categoria"] == "alimentos"){
                            if($producto["cantidad"] != ""){
                                echo($producto["producto"] . ": " . $producto["cantidad"]   . $producto["medida"] . "<br>" );
                            }
                        }    
                    ?>       
                </div>
            <?php } ?>  
      
        
            <div class="listadoTitle">
                Limpieza:
            </div>
            <?php foreach ($_POST["articulo"] as $producto){?>
                <div class="row listado">
                    <?php 
                        if($producto["categoria"] == "limpieza"){
                            if($producto["cantidad"] != ""){
                                echo($producto["producto"] . ": " . $producto["cantidad"]   . $producto["medida"] . "<br>" );
                            }
                        }    
                    ?>       
                </div>
            <?php } ?>  
      
            <div class="listadoTitle">
                Otros:
            </div>
            <div class="row listado">
                <?php 
                    echo($_POST["otros"])
                ?>
            </div> 
        </div>    
</div>
<div class="row justify-content-around">
    <div class="col-10 col-md-6">
        <form action="home.php" method="POST">
            <input class="botonSubmit" type="submit" name="modificarPedido" value="Modificar">
            <input class="botonSubmit" type="submit" name="confirmarPedido" value="Confirmar">
        </form>
                    </div>    
</div>