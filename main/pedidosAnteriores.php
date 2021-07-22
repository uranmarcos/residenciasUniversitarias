<?php
$pedidosPorSede = [];
$sede = $_SESSION["sede"];

try{
    $consulta = $baseDeDatos ->prepare("SELECT * FROM PEDIDOS WHERE sede = '$sede'");
    $consulta->execute();
    $pedidos =$consulta -> fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $exception){
    echo "<script>location.href='errorConsulta.php';</script>";
    die;
}


foreach($pedidos as $pedido){
  
    if($pedido["sede"] == $_SESSION["sede"]){
        $pedidoMail = [];
            $pedidoMail["id"] = $pedido["id"];
            $pedidoMail["fecha"] = $pedido["fecha"];
            $pedidoMail["usuario"] = $pedido["usuario"];
            $pedidoMail["pedido"] = $pedido["pedido"];
            array_push($pedidosPorSede, $pedidoMail);
        
    }
  
};
?>
    <div class="d-flex flex-column-reverse">
        <?php 
            if(count($pedidosPorSede) == 0){
        ?> 
            <div class="sectionBloque">
                <div class="contenedorSeccion d-flex justify-content-center contenedorModal">
                    <div class="d-flex  justify-center">
                        <div class="subtitle centrarTexto green">
                            <div>
                                Aún no hay pedidos generados para esta residencia.
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-emoji-wink-fill" viewBox="0 0 16 16">
                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM7 6.5C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5zM4.285 9.567a.5.5 0 0 0-.183.683A4.498 4.498 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.498 3.498 0 0 1 8 11.5a3.498 3.498 0 0 1-3.032-1.75.5.5 0 0 0-.683-.183zm5.152-3.31a.5.5 0 0 0-.874.486c.33.595.958 1.007 1.687 1.007.73 0 1.356-.412 1.687-1.007a.5.5 0 0 0-.874-.486.934.934 0 0 1-.813.493.934.934 0 0 1-.813-.493z"/>
                            </svg>
                            Los pedidos anteriores serán cargados en breve.
                        </div>
                    </div>
                </div>   
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
                                        echo($pedido["fecha"] . " - Realizado por: " . $pedido["usuario"]);
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
  
<!-- </div>  -->
                      