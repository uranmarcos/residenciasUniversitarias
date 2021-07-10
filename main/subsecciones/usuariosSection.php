<script>
    function pulsar(e) {
        tecla = (document.querySelectorAll) ? e.keyCode : e.which;
        return (tecla != 13);
    }      
</script>   
<div class="contenedorSeccion <?php echo $mostrarListadoUsuarios ?>">
    <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
        <div class="d-flex anchoTotal justify-content-between">
            <div class="subtitle" id="subtitleUser">
                Usuarios Existentes
            </div>
            <button type="submit" class="botonNew" id="botonNewUser" name="crearUsuario">
                Crear
            </button> 
        </div>
        <div class="confirmacionNewUser <?php echo $cajaMensajeConfirmacion ?>" id="mensajeNewUser"> 
            <script> setTimeout(function(){ ocultarMensajeNewUser(); }, 5000);</script>
            El usuario se creó correctamente!
        </div>
        <!-- TABLA LISTADO USUARIOS -->
        <div class="table-responsive">
            <table class="table" id="tableUsuarios">
                <thead>
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Casa</th>
                        <th scope="col">Mail</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <form method="POST" action="inicio.php">
                        <?php foreach($usuarios as $usuario){ ?>
                            <tr>
                                <td><?php echo $usuario["id"] ?></td>
                                <td><?php echo $usuario["nombre"] ?></td>
                                <td><?php echo $usuario["apellido"] ?></td>
                                <td><?php echo $usuario["rol"] ?></td>
                                <td><?php echo $usuario["sede"] ?></td>
                                <td><?php echo $usuario["casa"] ?></td>
                                <td><?php echo $usuario["mail"] ?></td>
                                <td>
                                    <button class="editButton" name="editarUsuario" id="<?php echo $usuario["id"]?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg> 
                                    </button>
                                </td>
                                <td> 
                                    <button class="editButton" name="editarUsuario" id="<?php echo $usuario["id"]?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>                  
                    </form>   
                </tbody>
            </table>             
        </div>
    </form>
</div>
<!-- CAJA NUEVO USUARIO -->
<div class="contenedorSeccion contenedorModal  <?php echo $mostrarABMUsuarios ?>">
    <div class="d-flex anchoTotal justify-content-between">
        <div class="subtitle" id="subtitleUser">
            <?php echo  $ABMUserTitle ?>
        </div>
    </div>
    <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
        <div class="row anchoTotal">
                <div class="errorValidacionForm hidden" id="errorNewUser">
                    Debe completar todos los campos
                </div>
                <div class="row justify-content-between">
                    <label class="col-5" > Nombre: </label>
                    <label class="col-6" > Apellido: </label>               
                </div>
                <div class="row justify-content-between">
                    <input class="col-5 campoFormNewUser" id="inputName" name="nombre">
                    <input class="col-6 campoFormNewUser" name="apellido">                              
                </div>
                <div class="row justify-content-between">
                    <label class="col-5" > Mail: </label>
                    <label class="col-6" > Sede: </label>
                </div>
                <div class="row justify-content-between">
                    <input class="col-5 campoFormNewUser" name="mail">
                    <input class="col-6 campoFormNewUser" name="sede">
                </div>
                <div class="row justify-content-between">
                    <label class="col-3" > DNI: </label>
                    <label class="col-3" > Rol: </label>
                    <label class="col-3" > Casa: </label>
                </div> 
                <div class="row justify-content-between">
                    <input class="col-3 campoFormNewUser" name="dni">
                    <select class="col-3 campoFormNewUser" name="rol">
                        <option value="">Seleccionar</option>
                        <option value="voluntario">Voluntario</option>
                        <option value="admin">Admin</option>
                    </select>  
                    <input type="number" value="1" min="1" class="col-3" name="casa">
                </div> 
                <div class="row rowConfirmar justify-content-around">
                    <button type="submit" name="cancelCrearUsuario" class="botonNew">Cancelar</button>
                    <div onclick="validarFormulario('campoFormNewUser', 'errorNewUser', 'modalNewUser')" class="botonNew">Confirmar</div>
                </div> 
        </div>
        <div class="row modalBox hidden" id="modalNewUser">
            <div class="centrarTexto">¿Confirma la creación del usuario?</div>
            <div onclick="ocultarCaja('modalNewUser')" class="botonNew">Cerrar</div>
            <button type="submit" name="newUser" class="botonNew">Crear</button>
        </div>  
    </form>
</div>

