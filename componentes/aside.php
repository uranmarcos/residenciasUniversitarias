<?php
$mostrarAdmin = "none";
if($_SESSION["rol"] == "admin"){
    $mostrarAdmin = "block";
}
?>

<form method="POST" action="inicio.php" class="botonesAside">
    <button name="cerrarSesion" class="asideButton" id="perfil" onclick="activarBoton('perfil', 'perfilSeccion')">Cerrar sesión</button>
    <button name="admin" style="display:<?php echo $mostrarAdmin ?>"  class="asideButton" id="admin" onclick="activarBoton('admin', 'adminSeccion')">Admin</button>
    <button name="iniciarPedido" class="asideButton" id="pedido" onclick="activarBoton('pedido', 'pedidoSeccion')">Pedidos</button>
</form>