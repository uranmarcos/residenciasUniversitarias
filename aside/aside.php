<?php
$mostrarBotonAdmin = "none";
if($_SESSION["rol"] == "admin"){
    $mostrarBotonAdmin = "block";
}
?>

<form method="POST" action="inicio.php">
    <button name="cerrarSesion" class="asideButton" id="cerrarSesion" onclick="activarBoton('cerrarSesion', 'cerrarSesion')">Cerrar sesión</button>
    <button name="perfil" class="asideButton" disabled id="btnPerfil" onmouseover="alert('sección en construcción')" onclick="activarBoton('perfil', 'perfilSeccion')">Perfil</button>
    <button name="admin" style="display:<?php echo $mostrarBotonAdmin ?>"  class="asideButton" id="admin" onclick="activarBoton('admin', 'adminSeccion')">Admin</button>
    <button name="pedidosAnteriores" class="asideButton" id="listadoPedidos" onclick="activarBoton('listadoPedidos', 'listadoPedidosSeccion')">Mis pedidos</button>
    <button name="iniciarPedido" class="asideButton" id="pedido" onclick="activarBoton('pedido', 'pedidoSeccion')">Iniciar pedido</button>
</form>