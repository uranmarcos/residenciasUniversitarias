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
            <!-- <img src="../img/si.jpg" class="logoHeaderResponsive"> -->

        </div>
        <div class="col-2 d-flex align-items-center justify-content-end">
            <nav class="navBurguer">
                <input type="checkbox" id="menu">
                <label class="iconoBurguer" for="menu"> ☰ </label>
                <form method="POST" class="menuResponsive" action="inicio.php">
                    <button name="cerrarSesion" class="asideButton" id="cerrarSesion" onclick="activarBoton('cerrarSesion', 'cerrarSesion')">Cerrar sesión</button>
                    <button name="perfil" class="asideButton" disabled id="btnPerfil" onmouseover="alert('sección en construcción')" onclick="activarBoton('perfil', 'perfilSeccion')">Perfil</button>
                    <button name="admin" style="display:<?php echo $mostrarBotonAdmin ?>"  class="asideButton" id="admin" onclick="activarBoton('admin', 'adminSeccion')">Admin</button>
                    <button name="pedidosAnteriores" class="asideButton" id="listadoPedidos" onclick="activarBoton('listadoPedidos', 'listadoPedidosSeccion')">Mis pedidos</button>
                    <button name="iniciarPedido" class="asideButton" id="pedido" onclick="activarBoton('pedido', 'pedidoSeccion')">Iniciar pedido</button>
                </form>
            </nav>
        </div>
    </div>
</div>

   