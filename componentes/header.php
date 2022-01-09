<?php
if($_SESSION["autenticado"] != true){
    echo "<script>location.href='index.php';</script>";
}
$mostrarBotonAdmin = "none";
if($_SESSION["rol"] == "admin"){
    $mostrarBotonAdmin = "block";
}
?>

<div>
    <img src="img/logohor.jpg" class="logoFull">
    <nav class="navegador">
        <form method="GET" action="inicio2.php">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                <!-- <button type="submit" class="btn btn-primary btn-lg" name="inicio">Inicio</button> -->
                <!-- <button type="submit" class="btn btn-outline-primary" name="inicio">Inicio</button> -->
                    <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perfil.php">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ayuda.php">Ayuda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos.php">Pedidos</a>
                </li>
            </ul>
        </form>    
    </nav>
</div>

<div class="headerResponsive">
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
