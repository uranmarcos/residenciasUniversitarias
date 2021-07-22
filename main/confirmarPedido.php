<?php
    if(isset($_POST["generarPedido"])){
        $pedido = [];
        foreach($_POST as $producto => $cantidad){
            if($cantidad != 0 && $producto["id"] != "otros"){
                $p = [];
                $p["id"] = $producto;
                $p["cantidad"]= $cantidad;
                array_push($pedido, $p);
            };
        }
        if(($_POST["otros"]) != ""){
            $otros = [];
            $otros["id"] = "Otros";
            $otros["cantidad"] = $_POST["otros"];        
            array_push($pedido, $otros);
        }

        $pedidoMail = $_SESSION["sede"] . " - Casa " . $_SESSION["casa"] . " - " . $_SESSION["name"] . " " . $_SESSION["apellido"] . "<br>";
        $listado = "";

        foreach($pedido as $p){
            if($p["id"] != "Otros"){
                $key = array_search($p["id"], array_column($_SESSION["productos"], "id"));
                $prod = $_SESSION["productos"][$key];
                $listado = $listado . $prod["producto"] . ": " . $p["cantidad"] . " " . $prod["medida"] . ", "; 
            }
            if($p["id"] == "Otros"){
                $listado = $listado . "Otros: " . $p["cantidad"] . " ."; 
            }
        }
        
        try{
            $consulta = $baseDeDatos ->prepare("SELECT MAX(id) FROM pedidos;");
            $consulta->execute();
            $consulta2 = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            $id = $consulta2[0]["MAX(id)"] +1;
            $_SESSION["idPedido"] = $id;
        }catch(Exception $exception){
            echo $exception;
            echo "error";
            return;
        }
        $sede = $_SESSION["sede"];
        $fecha = date("Y-m-d");
        $usuario = $_SESSION["name"] . " " . $_SESSION["apellido"];
        $pedido = $listado;
 
        try{
            $consulta = $baseDeDatos ->prepare("INSERT into pedidos VALUES($id, '$sede', '$usuario', '$fecha', '$pedido')");
            $consulta->execute();
        }catch(Exception $exception){
            echo "<script>location.href='errorPedido.php';</script>";
            die;
        }
        $message = $pedidoMail . $listado;
        $_SESSION["pedidoMail"] = $message;
    }
?>
<div class="sectionBloque">
    <div class="contenedorSeccion d-flex justify-content-center contenedorModal">
        <div class="centrarTexto">
            <div>
                <p class="pb-2 purple">
                    Armaste el siguiente pedido. Estás seguro de confirmarlo?
                </p>
                <p>
                    <?php echo $_SESSION["pedidoMail"] ?>  
                </p>
                <form method="POST" action="inicio.php">
                    <div class="col-12 rowConfirmarPedido d-flex justify-content-around" id="cajaConfirmarPedido">
                        <div>
                            <button class="button" type="submit" name="cancelarPedido">Cancelar</button>   
                        </div>
                        <div>
                            <button class="button" onclick="mostrarSpinner('cajaConfirmarPedido', 'spinnerPedido' )" type="submit" name="enviarMail">Confirmar</button>   
                        </div> 
                </form>            
            </div>
        </div>
        <div class="row modalBox hidden " id="spinnerPedido">
            <div class="col-12 rowConfirmarPedido d-flex align-items-center">
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only"></span>
                </div> 
            </div>
        </div>
    </div>   
</div>