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
    <div class="d-flex flex-column-reverse">
   
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
                                        $mes = "";
                                        if($month == "January"){
                                            $mes = "Enero";
                                        }elseif($month == "February"){
                                            $mes = "Febrero";
                                        }elseif($month == "March"){
                                            $mes = "Marzo";
                                        }elseif($month == "April"){
                                            $mes = "Abril";
                                        }elseif($month == "May"){
                                            $mes = "Mayo";
                                        }elseif($month == "June"){
                                            $mes = "Junio";
                                        }elseif($month == "July"){
                                            $mes = "Julio";
                                        }elseif($month == "August"){
                                            $mes = "Agosto";
                                        }elseif($month == "September"){
                                            $mes = "Septiembre";
                                        }elseif($month == "October"){
                                            $mes = "Octubre";
                                        }elseif($month == "November"){
                                            $mes = "Noviembre";
                                        }else{
                                            $mes = "Diciembre";
                                        }
                                        
                                         
                                        echo($day . "/" . $mes . "/" . $year . " - " . $_SESSION["name"] . " " . $_SESSION["apellido"]);
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
                                                       . " ; ";
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
                      