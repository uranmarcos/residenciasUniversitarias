<?php
$pedidosPorSede = [];
$data = file_get_contents('json/pedidos.json');
$pedidos = json_decode($data, true);
foreach($pedidos as $pedido){
    if($pedido[0]["sede"] == $_SESSION["sede"]){
        array_push($pedidosPorSede, $pedido);
    }
};
?>
<div class="col-12 paddingCero">
    <div class="titleSection">
        Pedidos Realizados - <?php echo $_SESSION["sede"] . " - Casa " . $_SESSION["casa"] ?>
    </div>
    <div>
   
        <?php 
            if(count($pedidosPorSede) == 0){
        ?> 
            <div class="text-center">
                <?php
                    echo "Aún no hay pedidos generados para esta residencia.";
                ?>
            </div>
        <?php
            }else{
                foreach($pedidosPorSede as $pedido){
        ?>
                <div class="sectionBloque">  
                    <div class="accordion" id="accordionAlimentos">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlimentos" aria-expanded="true" aria-controls="collapseAlimentos">
                                    <?php 
                                        $day = $pedido[0]["fecha"]["mday"];
                                        $month = $pedido[0]["fecha"]["month"];
                                        $year = $pedido[0]["fecha"]["year"];
                                        $hora = $pedido[0]["fecha"]["hours"];
                                        $minutos = $pedido[0]["fecha"]["minutes"];
                                        $segundos = $pedido[0]["fecha"]["seconds"];
                                        echo($day . "/" . $month . "/" . $year . " - ". $hora. ":" . $minutos . ":" . $segundos . "hs -". $_SESSION["name"] . " " . $_SESSION["apellido"]);
                                    ?>
                                </button>
                            </h2>
                            <div id="collapseAlimentos" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionAlimentos">
                                <div class="accordion-body">
                                    <div class="row cajaInternaBloque" id="cajaAlimentos">
                                        <?php 
                                            foreach($pedido[0]["pedido"] as $producto){
                                                if($producto == [] || $producto == ""){
                                                    echo "Pedido vacio";
                                                }else{
                                                    if($producto["producto"]){
                                                        echo $producto["producto"] . ": " . $producto["cantidad"] 
                                                        . " " . $producto["medida"] . " ; ";
                                                    };
                                                }
                                            }
                                        ?> 
                                    </div>    
                                </div> 
                            </div>
                        </div>
                    </div>             
                </div>
            <?php 
                    }; 
                }
            ?>
  
</div> 
                      