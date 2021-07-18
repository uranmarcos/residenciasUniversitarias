<?php
    $user =  $_COOKIE["usuario"];
    $consulta = $baseDeDatos ->prepare("SELECT id, mail, rol, nombre, apellido, dni, sede, casa FROM usuarios WHERE id = $user");
    $consulta->execute();
    $usuario = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $selectedAdmin = "";
    $selectedVol = "";
    if($usuario[0]["rol"] == "voluntario"){
        $selectedVol = "selected";
    }else{
        $selectedAdmin = "selected";
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
        <div class="d-flex anchoTotal borderBottom justify-content-between">
            <div class="subtitle" id="subtitleUser">
                Editar usuario
            </div>
        </div>
        <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
            <div class="row anchoTotal">
                    <div class="errorValidacionForm hidden" id="errorNewUser">
                        Debe completar todos los campos
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-1">
                            <label class="labelForm"> Cód: </label>
                            <input class="campoFormNewUser" readonly name="inputId" value="<?php echo $usuario[0]['id']?>">
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="labelForm"> Nombre: </label>
                            <input class="campoFormNewUser" id="inputName" name="nombre" value="<?php echo $usuario[0]['nombre']?>">
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="labelForm"> Apellido: </label>               
                            <input class="campoFormNewUser" name="apellido" value="<?php echo $usuario[0]['apellido']?>">  
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-6">
                            <label class="labelForm"> Mail: </label>
                            <input class="campoFormNewUser" name="mail" value="<?php echo $usuario[0]['mail']?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="labelForm"> Sede: </label>
                            <input class="campoFormNewUser" name="sede" value="<?php echo $usuario[0]['sede']?>">
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-4">
                            <label class="labelForm"> DNI: </label>
                            <input class="campoFormNewUser" name="dni" value="<?php echo $usuario[0]['dni']?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="labelForm"> Rol: </label>
                            <select class=" campoFormNewUser" name="rol">
                                <option <?php echo($selectedVol)?> value="voluntario">Voluntario</option>
                                <option <?php echo($selectedAdmin)?> value="admin">Admin</option>
                            </select>  
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="labelForm"> Casa: </label>
                            <input type="number" value="1" min="1" class="campoFormNewUser" name="casa" value="<?php echo $usuario[0]['casa']?>">
                        </div>
                    </div> 
                    <div class="row rowConfirmar mt-3 justify-content-around">
                        <button type="submit" name="cancelCrearUsuario" onclick="cancelEditUser()" class="button">Cancelar</button>
                        <div onclick="validarFormulario('campoFormNewUser', 'errorNewUser', 'modalNewUser')" class="button">Confirmar</div>
                    </div> 
            </div>
            <div class="row modalBox hidden" id="modalNewUser">
                <div class="centrarTexto">¿Confirma la modificación del usuario?</div>
                <div class="row justify-content-around">
                    <div onclick="ocultarCaja('modalNewUser')" class="button">Cerrar</div>
                    <button type="submit" name="editUser" class="button">Editar</button>
                </div>
            </div>  
        </form>
    </div>
</div>