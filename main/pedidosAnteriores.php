<?php
$pedidosPorSede = [];
$data = file_get_contents('json/pedidos.json');
$pedidos = json_decode($data, true);

foreach($pedidos as $pedido){
    if($pedido[0]["sede"] == $_SESSION["sede"]){
        $pedidoMail = [];
            $pedidoMail["id"] = $pedido[0]["id"];
            $pedidoMail["fecha"] = $pedido[0]["fecha"];
            $pedidoMail["nombre"] = $pedido[0]["nombre"];
            $pedidoMail["pedido"] = $pedido[0]["pedido"];
            array_push($pedidosPorSede, $pedidoMail);
        
    }
    //     $pedido = [];
    //     // var_dump($_POST);
    //     foreach($_POST as $producto => $cantidad){
    //         if($cantidad != 0){
    //             $p = [];
    //             $p["id"] = $producto;
    //             $p["cantidad"]= $cantidad;
    //             array_push($pedido, $p);
    //         };
    //     }
    //     if(($_POST["otros"]) != ""){
    //         $otros = [];
    //         $otros["producto"] = "Otros";
    //         $otros["cantidad"] = $_POST["otros"];        
    //         array_push($pedido, $otros);
    //     }
    // }
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
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePedido<?php echo $pedido['id']?>" aria-expanded="true" aria-controls="collapsePedido<?php echo $pedido['id']?>">
                                    <?php 
                                        $day = $pedido["fecha"]["mday"];
                                        $month = $pedido["fecha"]["month"];
                                        $year = $pedido["fecha"]["year"];
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
                                        echo($day . "/" . $mes . "/" . $year . " - Realizado por: " . $pedido["nombre"]);
                                    ?>
                                </button>
                            </h2>
                            <div id="collapsePedido<?php echo $pedido['id']?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionAlimentos">
                                <div class="accordion-body">
                                    <div class="row cajaInternaBloque" id="cajaAlimentos">
                                        <?php 
                                            echo $pedido["pedido"];
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
                      