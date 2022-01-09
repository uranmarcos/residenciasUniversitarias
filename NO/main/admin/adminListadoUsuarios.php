<?php 
    $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY apellido ASC");
    $consultaUsuarios->execute();
    $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST["filtrarSede"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY sede DESC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY sede ASC");
        }
        
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["nameAsc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY nombre ASC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY nombre ASC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["nameDesc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY nombre DESC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY nombre DESC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["apellidoAsc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY apellido ASC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY apellido ASC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["apellidoDesc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY apellido DESC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY apellido DESC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["dniAsc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY dni ASC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY dni ASC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["dniDesc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY dni DESC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY dni DESC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["sedeAsc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY sede ASC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY sede ASC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST["sedeDesc"])){
        $mostrarTitle = "block";
        $title= "Admin - Sedes";
        $bloque = "main/admin/adminListadoUsuarios.php";
        $sede = $_POST["filtrarSede"];
        if( $sede == "todos"){
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY sede DESC");
        }else{
            $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE sede='$sede' ORDER BY sede DESC");
        }
        $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    }
?>
<script>
    function pulsar(e) {
        tecla = (document.querySelectorAll) ? e.keyCode : e.which;
        return (tecla != 13);
    }      
</script>   
<form method="POST" action="inicio.php">
        <div class="row navAdmin">
            <button type="submit" name="adminSedes" class="btn botonNavAdmin col-6 col-md-3">Sedes</button>
            <button type="submit" name="adminCategorias" class="btn botonNavAdmin col-6 col-md-3">Categorias</button>
            <button type="submit" name="adminUsuarios" onclick="resetSede()" class="btn botonNavAdmin col-6 col-md-3">Usuarios</button>
            <button type="submit" name="adminArticulos" class="btn botonNavAdmin col-6 col-md-3">Articulos</button>           
        </div>
</form>
<div class="sectionBloque">    
    <div class="contenedorSeccion contenedorModal">
        <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
            <div class="row modalBox hidden" id="eliminacionUsuario">
                <div  class="d-flex align-items-center justify-content-center ">
                    <div class="row confirmacionPedido">
                        <div class="col-12 rowConfirmarPedido">
                            Confirma la eliminación del usuario:
                            <div id="nameUserBox"> </div>
                        </div>
                        <div class="col-12 rowConfirmarPedido d-flex justify-content-around" id="cajaEliminarUsuario">
                            <div class="button " onclick="cancelDeleteUser('eliminacionUsuario')">
                                Cancelar
                            </div>
                            <button class="button" onclick="mostrarSpinner('cajaEliminarUsuario', 'spinnerUser')" type="submit" name="deleteUser">Confirmar</button>   
                        </div> 
                    </div> 
                    <div class="row hidden confirmacionPedido " id="spinnerUser">
                        <div class="col-12 rowConfirmarPedido d-flex align-items-center">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="d-flex anchoTotal justify-content-between">
                <div class="subtitle" id="subtitleUser">
                    Usuarios Existentes
                </div>
            </div>
            <div class="confirmacionNewUser <?php echo $cajaMensajeConfirmacion ?>" id="mensajeNewUser"> 
                <script> setTimeout(function(){ ocultarMensajeNewUser(); }, 5000);</script>
                <?php echo $mensajeConfirmacionAccion ?>
            </div>
            <!-- TABLA LISTADO USUARIOS -->
            <div class="table-responsive">
                <table class="table" id="tableUsuarios">
                    <div class="row bg-grey d-flex align-items-center justify-content-around">
                        <div class="col-12 col-lg-4 colBuscador">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            <input type="textarea" onkeyup="buscarUsuario()" id="buscadorUsuario" value ="">
                            <div class="editButton" onclick="limpiarBuscador('buscadorUsuario')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg m-1" viewBox="0 0 16 16">
                                    <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                </svg>
                            </div>
                        </div>    
                        <div class="col-12 col-lg-4 colBuscador">
                            Sede:
                            <select name="filtrarSede" onchange="changeSede()" id="selectSede">
                                <option value="todos">Todas</opcion>
                                <option value="Cordoba" >Cordoba</opcion>
                                <option value="Jujuy">Jujuy</opcion>
                                <option value="Baticity">Baticity</opcion>
                                <option value="San Luis">San Luis</opcion>
                            </select>   
                            <button type="submit" name="filtrarCategorias" class="editButton">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div> 
                        <div class="col-12 col-lg-2 colBuscador">
                            <button type="submit" class="button" id="botonNewUser" name="crearUsuario">
                                Crear
                            </button>
                        </div> 
                    </div>
                    <thead>
                        <tr>
                            <th scope="col" style="min-width:90px; text-align:center">
                                Nombre
                                <div>
                                    <button name="nameAsc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
                                            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>    
                                    <button name="nameDesc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                                            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
                                            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
                                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>   
                                </div>        
                            </th>
                            <th scope="col" style="min-width:90px; text-align:center">
                                Apellido
                                <div>
                                    <button name="apellidoAsc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
                                            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>    
                                    <button name="apellidoDesc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                                            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
                                            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
                                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" style="min-width:80px; text-align:center">
                                Dni
                                <div>
                                    <button name="dniAsc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-numeric-down" viewBox="0 0 16 16">
                                            <path d="M12.438 1.668V7H11.39V2.684h-.051l-1.211.859v-.969l1.262-.906h1.046z"/>
                                            <path fill-rule="evenodd" d="M11.36 14.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.835 1.973-1.835 1.09 0 2.063.636 2.063 2.687 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98z"/>
                                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>    
                                    <button name="dniDesc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-numeric-down-alt" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.36 7.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.836 1.973-1.836 1.09 0 2.063.637 2.063 2.688 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98z"/>
                                            <path d="M12.438 8.668V14H11.39V9.684h-.051l-1.211.859v-.969l1.262-.906h1.046zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" style="text-align:center">
                                Rol
                                <div><br></div>
                            </th>
                            <th scope="col" style="min-width:90px; text-align:center">
                                Sede
                                <div>
                                    <button name="sedeAsc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
                                            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>    
                                    <button name="sedeDesc" class="editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                                            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
                                            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
                                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" style="text-align:center">
                                Casa
                                <div><br></div>
                            </th>
                            <th scope="col" style="text-align:center">
                                Mail
                                <div><br></div>
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST" action="inicio.php">
                            <?php foreach($usuarios as $usuario){ ?>
                                <tr class="filaUsuario">
                                    <td ><?php echo $usuario["nombre"] ?></td>
                                    <td><?php echo $usuario["apellido"] ?></td>
                                    <td><?php echo $usuario["dni"] ?></td>
                                    <td><?php echo $usuario["rol"] ?></td>
                                    <td><?php echo $usuario["sede"] ?></td>
                                    <td style="text-align:center"><?php echo $usuario["casa"] ?></td>
                                    <td><?php echo $usuario["mail"] ?></td>
                                    <td>
                                        <button class="editButton" name="editarUsuario" onclick="editUser(<?php echo $usuario['id']?>)" id="<?php echo $usuario["id"]?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg> 
                                        </button>
                                    </td>
                                    <td> 
                                        <div class="editButton pt-1" name="deleteUsuario" onclick="eliminarUsuario('eliminacionUsuario', <?php echo $usuario['id']?> )" id="<?php echo $usuario["id"]?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>                  
                        </form>   
                    </tbody>
                </table>             
            </div>
        </form>
    </div> 
</div>
<script>
    cargarSede();
</script>