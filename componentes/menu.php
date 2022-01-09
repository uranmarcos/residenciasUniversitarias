<?php
$mostrarBotonAdmin = "none";
if($_SESSION["rol"] == "admin"){
    $mostrarBotonAdmin = "flex-box";
}
?>
<form method="POST" class="row rowAside" action="inicio.php">
    <div class="col-12 colBotonesAside" id="columnaBotonesAside">
        <button name="cerrarSesion" class="asideButton" id="cerrarSesion" onclick="resetStorage()" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesion" onclick="activarBoton('cerrarSesion', 'cerrarSesion')">
            <div class="nameButtonMenu">Cerrar sesión</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="icono bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
               <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </button>
        <button name="perfil" class="asideButton" id="btnPerfil" onmouseover="alert('sección en construcción')" data-toggle="tooltip" data-placement="bottom" title="Mi perfil (en construcción)" onclick="activarBoton('perfil', 'perfilSeccion')">
            <div class="nameButtonMenu">Perfil</div> 
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="icono bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
        </button>
        <button name="admin" style="display:<?php echo $mostrarBotonAdmin ?>" onclick="resetStorage()" class="asideButton" id="admin" data-toggle="tooltip" data-placement="bottom" title="Administrador" onclick="activarBoton('admin', 'adminSeccion')">
            <div class="nameButtonMenu">Admin</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="icono bi bi-gear-fill" viewBox="0 0 16 16">
               <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
            </svg>
        </button>
        <button name="pedidosAnteriores" class="asideButton" id="listadoPedidos" data-toggle="tooltip" data-placement="bottom" title="Ver pedidos anteriores" onclick="activarBoton('listadoPedidos', 'listadoPedidosSeccion')">
            <div class="nameButtonMenu">Mis pedidos</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="icono bi bi-cart-fill" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
        </button>
        <button name="iniciarPedido" class="asideButton" id="pedido" data-toggle="tooltip" onclick="resetStorage()" data-placement="bottom" title="Nuevo pedido" onclick="activarBoton('pedido', 'pedidoSeccion')">
            <div class="nameButtonMenu">Iniciar pedido</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="icono bi bi-pen-fill" viewBox="0 0 16 16">
                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
            </svg>
        </button>
    </div>
</form>