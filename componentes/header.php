<?php
if($_SESSION["autenticado"] != true){
    echo "<script>location.href='index.php';</script>";
}
$mostrarBotonAdmin = "hide";
if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "general"){
    $mostrarBotonAdmin = "show";
}

?>

<div class="headerNormal">
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
    <div class="row rowHeader d-flex justify-content-around">
        <div class="col-4 logoInicioHeader">
        </div>
        <div class="col-2 d-flex align-items-center justify-content-end">
            <nav>
                <div onclick="mostrarMenu()">
                    <label class="iconoBurguer" for="menu"> ☰ </label>
                </div>
            </nav>
        </div>
    </div>
    <nav class="navegadorResponsive">
       <?php echo $_COOKIE['seccion'] ?>
    </nav>
    <form method="GET" class="row hide menuBurguer" onclick="mostrarMenu()" id="menuBurguer" action="inicio.php">
        <div class="col-12 contenedorMenuBurguer">
            <button name="inicio" class="row asideButton" id="btnInicio" data-toggle="tooltip" data-placement="bottom" >
                <div class="nameButtonAside">Inicio</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="icono bi bi-house-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg>
            </button>
            <button name="perfil" class="row asideButton" id="btnPerfil" data-toggle="tooltip" data-placement="bottom" onclick="activarBoton('perfil', 'perfilSeccion')">
                <div class=" nameButtonAside">Perfil</div> 
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="icono bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
            </button>
            <button name="admin" class="row asideButton <?php echo $mostrarBotonAdmin?>" onclick="resetStorage()" id="admin" data-toggle="tooltip" data-placement="bottom" onclick="activarBoton('admin', 'adminSeccion')">
                <div class="nameButtonAside">Admin</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="icono bi bi-gear-fill" viewBox="0 0 16 16">
                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
            </button>
            <button name="pedidos" class="row asideButton" id="pedidos" data-toggle="tooltip" data-placement="bottom" onclick="activarBoton('listadoPedidos', 'listadoPedidosSeccion')">
                <div class="nameButtonAside">Pedidos</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="icono bi bi-cart-fill" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            </button>
            <button name="ayuda" class="row asideButton <?php echo $mostrarBotonAdmin?>" id="ayuda" data-toggle="tooltip" data-placement="bottom" onclick="activarBoton('admin', 'adminSeccion')">
                <div class="nameButtonAside">Ayuda</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="icono bi bi-question-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
                </svg>
            </button>
            <button name="desloguear" class="row asideButton" id="desloguear" onclick="resetStorage()" data-toggle="tooltip" data-placement="bottom" onclick="activarBoton('cerrarSesion', 'cerrarSesion')">
                <div class="nameButtonAside">Cerrar sesión</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" id="icondesloguear" class="icono bi bi-door-open" viewBox="0 0 16 16">
                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                </svg>
            </button>
        </div>
    </form>
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
    function mostrarMenu(){
        let menuBurguer = document.getElementById("menuBurguer")
        if (menuBurguer.classList.contains("hide")) {
            menuBurguer.classList.remove("hide")
        } else {
            menuBurguer.classList.add("hide")
        }
    }

</script>