<?php
if($_SESSION["autenticado"] != true){
    echo "<script>location.href='index.php';</script>";
}
$mostrarBotonAdmin = "hide";
if($_SESSION["rol"] == "admin"){
    $mostrarBotonAdmin = "show";
}
?>

<div>
    <img src="img/logohor.jpg" class="logoFull">
    <nav class="navegador">
        <form method="GET" action="inicio.php">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perfil.php">Perfil</a>
                </li>
                <li class="nav-item <?php echo $mostrarBotonAdmin?>">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
                <li class="nav-item <?php echo $mostrarBotonAdmin?>">
                    <a class="nav-link" href="ayuda.php">Ayuda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos.php">Pedidos</a>
                </li>
                <li class="nav-item">
                    <button class="buttonLogOut" type="submit" onmouseover="overLogOut()" onmouseout="outLogOut()" name="logOut" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" id="iconLogOut" class="bi bi-door-open" viewBox="0 0 16 16">
                            <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                            <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                        </svg>
                        <div id="textoLogOut" class="hide">DESLOGUEARSE</div>
                    </button>
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
<script>
    function overLogOut(){
        let iconLogOut= document.getElementById("iconLogOut")
        iconLogOut.classList.remove("show")
        iconLogOut.classList.add("hide")
        let textoLogOut= document.getElementById("textoLogOut")
        textoLogOut.classList.remove("hide")
        textoLogOut.classList.add("show")
    }
    function outLogOut(){
        let iconLogOut= document.getElementById("iconLogOut")
        iconLogOut.classList.remove("hide")
        iconLogOut.classList.add("show")
        let textoLogOut= document.getElementById("textoLogOut")
        textoLogOut.classList.remove("show")
        textoLogOut.classList.add("hide")
    }

</script>