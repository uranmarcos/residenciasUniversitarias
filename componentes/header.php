<?php


if($_SESSION["autenticado"] != true){
    echo "<script>location.href='index.php';</script>";
}
$mostrarBotonAdmin = "none";
if($_SESSION["rol"] == "admin"){
    $mostrarBotonAdmin = "block";
}
?>

<div class="col-12 logoHeader">
    <img src="img/logohor.jpg">
   
</div>
<div class=" headerResponsive">
    <div class="row d-flex justify-content-around">
        <div class="col-4 logoInicioHeader">
          

        </div>
        <div class="col-2 d-flex align-items-center justify-content-end">
            <nav>
                <div onclick="activarBurguer()">
                    <label class="iconoBurguer" for="menu"> ☰ </label>
                </div>
            </nav>
        </div>
    </div>
</div>
<script type="text/javascript"  src="js/funciones.js"></script>     
   