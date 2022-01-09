<?php
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    // VARIABLES CON LOS CAMPOS A REVISAR AL VALIDAR EL FORMULARIO DE EDICION/CREACION
    $camposCreacion = ["primerNombreNuevoUsuario", "segundoNombreNuevoUsuario", "apellidoNuevoUsuario", "dniNuevoUsuario", "mailNuevoUsuario", "sedeNuevoUsuario"];
    $camposErroresCreacion = ["errorPrimerNombreNuevoUsuario", "errorSegundoNombreNuevoUsuario", "errorApellidoNuevoUsuario",
    "errorDniNuevoUsuario", "errorMailNuevoUsuario", "errorSedeNuevoUsuario" ];
    $camposEdicion = ["primerNombreEditarUsuario", "segundoNombreEditarUsuario", "apellidoEditarUsuario", "dniEditarUsuario", "mailEditarUsuario", "sedeEditarUsuario"];
    $camposErroresEdicion = ["errorPrimerNombreEditarUsuario", "errorSegundoNombreEditarUsuario", "errorApellidoEditarUsuario",
    "errorDniEditarUsuario", "errorMailEditarUsuario", "errorSedeEditarUsuario" ];
    // ACCION CREAR USUARIO
    if(isset($_POST["crearUsuario"])){
        $nombres = $_POST['primerNombreNuevoUsuario'] . " " . $_POST['segundoNombreNuevoUsuario']; 
        $apellido = $_POST['apellidoNuevoUsuario'];
        $dni = $_POST['dniNuevoUsuario'];
        $password = $_POST['dniNuevoUsuario'];
        $rol = $_POST["rolNuevoUsuario"];
        $mail = $_POST["mailNuevoUsuario"];
        if ($rol == "general") {
            $sede = 6;
            $casa = 0;
        } else {
            $sede = $_POST["sedeNuevoUsuario"];
            $casa = $_POST["casaNuevoUsuario"];
        }
        $date = date("Y-m-d h:i:s");
        $insertUsuario = $baseDeDatos ->prepare("INSERT into agentes VALUES(default, '$dni', '$nombres', '$apellido', '$mail', '$rol', '$password', '$sede', '$casa',1, '$date', '$date', 1)");
        try{
            $insertUsuario->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El usuario se creó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }

    // ACCION EDITAR USUARIO
    if (isset($_POST["editarUsuario"])){
        $id = $_POST["idUsuarioPorEditar"];
        $primerNombre = $_POST["primerNombreEditarUsuario"];
        $segundoNombre = $_POST["segundoNombreEditarUsuario"];
        $apellido = $_POST["apellidoEditarUsuario"];
        $rol = $_POST["rolEditarUsuario"];
        $mail = $_POST["mailEditarUsuario"];
        if ($rol == "general") {
            $sede = 6;
            $casa = 0;
        } else {
            $sede = $_POST["sedeEditarUsuario"];
            $casa = $_POST["casaEditarUsuario"];
        }
        $habilitado = $_POST["habilitadoEditarUsuario"];
        $date = date("Y-m-d h:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE agentes SET nombre = '$primerNombre', segundoNombre = '$segundoNombre',
        apellido = '$apellido', rol = '$rol', mail = '$mail', sede = '$sede', casa = '$casa', habilitado = '$habilitado',  modified = '$date' WHERE id = '$id'");
        //$consulta->execute();
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El usuario se modificó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }

    // ACCION ELIMINAR ARTICULO
    if(isset($_POST["eliminarUsuario"])){
        $id = $_POST["idUsuarioEliminar"];
        $date = date("Y-m-d h:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE agentes SET habilitado = 0, modified = '$date' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El usuario se eliminó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }

    // CONSULTAS INICIALES LISTADO DE ARTICULOS, MEDIDAS Y CATEGORIAS
    $consultaUsuarios = $baseDeDatos ->prepare("SELECT U.id, U.nombre, U.segundoNombre, U.apellido, U.mail, U.dni, U.sede idSede, U.rol, S.descripcion 'sede', U.casa, U.habilitado FROM agentes U INNER JOIN sedes S ON U.sede = S.id");
    $consultaSedes = $baseDeDatos ->prepare("SELECT * FROM sedes WHERE habilitado = '1'");
    
    try {
        $consultaUsuarios->execute();
        $consultaSedes->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    $sedes = $consultaSedes -> fetchAll(PDO::FETCH_ASSOC);
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($usuarios) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }
 
    // OPCIONES DE ROLES PARA LA CREACION DE USUARIOS
    $rol = "general";
    if($rol == "admin") {
        $roles = [
            [ "value"=> "admin", "descripcion"=> "Admin"],
            ["value"=> "general", "descripcion"=> "General"],
            [ "value"=> "stock", "descripcion"=> "Stock"]
        ];
    } else if($rol == "general") {
        $roles = [
            [ "value"=> "stock", "descripcion"=> "Stock"],
            ["value"=> "general", "descripcion"=> "General"]
        ];
    }


?>
    <div class="sectionBloque">
        <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" role="alert" >
            Hubo un error de conexión. Por favor actualizá la página
        </div>
        <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" role="alert">
            <?php echo $mensajeAlertConfirmacion ?>
        </div>
        <!-- CREACION DE USUARIOS -->
        <div>
            <form name="form1" method="POST" action="admin.php?adminUsuarios=">
                <!-- BOX NUEVO USUARIO -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxCrearUsuario">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Nuevo Usuario
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Primer Nombre: </label>
                            <input maxlength="12" name="primerNombreNuevoUsuario" autocomplete="off" onkeyup="validarCampoFormulario('primerNombreNuevoUsuario', 'errorPrimerNombreNuevoUsuario')" id="primerNombreNuevoUsuario">
                            <div class="hide errorValidacion" id="errorPrimerNombreNuevoUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Segundo Nombre: </label>
                            <input maxlength="12" name="segundoNombreNuevoUsuario" autocomplete="off" onkeyup="validarCampoFormulario('segundoNombreNuevoUsuario', 'errorSegundoNombreNuevoUsuario' )" id="segundoNombreNuevoUsuario">
                            <div class="hide errorValidacion" id="errorSegundoNombreNuevoUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Apellido: </label>
                            <input maxlength="12" name="apellidoNuevoUsuario" autocomplete="off" onkeyup="validarCampoFormulario('apellidoNuevoUsuario', 'errorApellidoNuevoUsuario')" id="apellidoNuevoUsuario">
                            <div class="hide errorValidacion" id="errorApellidoNuevoUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>DNI: </label>
                            <input maxlength="8" name="dniNuevoUsuario" autocomplete="off" onkeyup="validarCampoFormulario('dniNuevoUsuario', 'errorDniNuevoUsuario')" id="dniNuevoUsuario">
                            <div class="hide errorValidacion" id="errorDniNuevoUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Rol: </label>
                            <select id="rolNuevoUsuario"  name="rolNuevoUsuario" onchange="confirmarRol(value, 'crear')" style="width:100%; height:30px">
                                <?php foreach($roles as $rol){ ?>
                                    <option value="<?php echo $rol["value"] ?>"><?php echo $rol["descripcion"] ?></option>
                                <?php } ?>
                            </select>   
                            <div class="hide errorValidacion" id="errorRolNuevoUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Mail: </label>
                            <input name="mailNuevoUsuario" type="email" autocomplete="off" onkeyup="validarCampoFormulario('mailNuevoUsuario', 'errorMailNuevoUsuario')" id="mailNuevoUsuario"> 
                            <div class="hide errorValidacion" id="errorMailNuevoUsuario">3 o mas caracteres</div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Sede: </label>
                            <select style="height:30px" id="sedeNuevoUsuario" name="sedeNuevoUsuario" onchange="selectSede(value), validarCampoFormulario('sedeNuevoUsuario', 'errorSedeNuevoUsuario')">
                                <option value="0">Requerido</option>
                                <?php foreach($sedes as $sede){ ?>
                                    <option value="<?php echo $sede['id']?>"><?php echo $sede['descripcion']?></option>
                                <?php } ?> 
                            </select>    
                            <div class="hide errorValidacion" id="errorSedeNuevoUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Casa: </label>
                            <select  id="casaNuevoUsuario" name="casaNuevoUsuario" style="height:30px" onkeyup="validarCampoFormulario('casaNuevoUsuario', 'errorCasaNuevoUsuario')">
                                <option value="0" disabled name="opcionSelectCasa">0</option>
                                <option value="1" name="opcionSelectCasa">1</option>
                                <option value="2" name="opcionSelectCasa">2</option>
                                <option value="3" name="opcionSelectCasa">3</option>
                                <option value="4" name="opcionSelectCasa">4</option>
                                <option value="5" name="opcionSelectCasa">5</option>
                            </select>    
                            <div class="hide errorValidacion" id="errorCasaNuevoUsuario"></div>
                        </div>
                        <div class="col-12 d-flex align-items-end justify-content-around mt-2 mt-md-2 mb-2 pb-md-1 mb-md-0">
                            <button type="button" name="botonCancelar" onclick="ocultarCaja('boxCrearUsuario','botonNuevoUsuario'), limpiarValidaciones('crear')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonGenerar" onmouseover="validarFormularioCompleto('crear')" id="botonCrearUsuario" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Generar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- MODAL CONFIRMACION CREACION USUARIO -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma el Usuario: <br>
                            <span id="spanNuevoUsuario"></span>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="crearUsuario" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL CONFIRMACION ROL GENERAL -->
                <div class="modal hide" id="modalConfirmacionRol">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header centrarTexto">
                            <b>NECESITAMOS CONFIRMACION</b>
                        </div>
                        <div class="modal-body ">
                            El rol "General" permite crear, editar y eliminar: sedes, categorias, usuarios y articulos, además de tener acceso a todos los pedidos realizados por las distintas sedes. 
                            <br>
                            ¿Confirma que desea crear un usuario general? Si lo que desea es un usuario que solo realice pedidos, por favor seleccione el rol "Stock".
                            
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" onclick="cancelarRolGeneral()">Cancelar</button>
                            <button type="button" class="btn botonConfirmar" onclick="confirmarRolGeneral()">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- EDICION DE USUARIO -->
        <div>
            <form name="formEdicion" method="POST" action="admin.php?adminUsuarios=">
                <!-- BOX EDICION USUARIO -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxEditarUsuario">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Editar Usuario
                        </div> 
                    </div>             
                    <div class="row">
                        <div class="col-1 col-md-1 col-lg-3 columna">
                            <label># </label>
                            <input maxlength="12" name="idUsuarioPorEditar" readonly  id="idUsuarioPorEditar">
                            <div class="hide errorValidacion" id="errorIdUsuarioPorEditar"></div>
                        </div>
                        <div class="col-11 col-md-5 col-lg-3 columna">
                            <label>Primer Nombre: </label>
                            <input maxlength="12" name="primerNombreEditarUsuario" id="primerNombreEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('primerNombreEditarUsuario', 'errorPrimerNombreEditarUsuario')" id="primerNombreNuevoUsuario">
                            <div class="hide errorValidacion" id="errorPrimerNombreEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Segundo Nombre: </label>
                            <input maxlength="12" name="segundoNombreEditarUsuario" id="segundoNombreEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('segundoNombreEditarUsuario', 'errorSegundoNombreEditarUsuario' )" id="segundoNombreEditarUsuario">
                            <div class="hide errorValidacion" id="errorSegundoNombreEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Apellido: </label>
                            <input maxlength="12" name="apellidoEditarUsuario" id="apellidoEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('apellidoEditarUsuario', 'errorApellidoEditarUsuario')" id="apellidoEditarUsuario">
                            <div class="hide errorValidacion" id="errorApellidoEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>DNI: </label>
                            <input maxlength="8" disabled name="dniEditarUsuario" id="dniEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('dniEditarUsuario', 'errorDniEditarUsuario')" id="dniEditarUsuario">
                            <div class="hide errorValidacion" id="errorDniEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Rol: </label>
                            <select id="rolEditarUsuario"  name="rolEditarUsuario" id="rolEditarUsuario" onchange="confirmarRol(value, 'editar')" style="width:100%; height:30px">
                                <?php foreach($roles as $rol){ ?>
                                    <option value="<?php echo $rol["value"] ?>"><?php echo $rol["descripcion"] ?></option>
                                <?php } ?>
                            </select>   
                            <div class="hide errorValidacion" id="errorRolEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Mail: </label>
                            <input name="mailEditarUsuario" type="email" autocomplete="off" onkeyup="validarCampoFormulario('mailEditarUsuario', 'errorMailEditarUsuario')" id="mailEditarUsuario"> 
                            <div class="hide errorValidacion" id="errorMailEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label>Sede: </label>
                            <select style="height:30px" id="sedeEditarUsuario" name="sedeEditarUsuario" onchange="selectSede(value), validarCampoFormulario('sedeEditarUsuario', 'errorSedeEditarUsuario')">
                                <option value="0">Requerido</option>
                                <?php foreach($sedes as $sede){ ?>
                                    <option value="<?php echo $sede['id']?>"><?php echo $sede['descripcion']?></option>
                                <?php } ?> 
                            </select>    
                            <div class="hide errorValidacion" id="errorSedeEditarUsuario"></div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-3 columna">
                            <label>Casa: </label>
                            <select  id="casaEditarUsuario" name="casaEditarUsuario" style="height:30px" onkeyup="validarCampoFormulario('casaEditarUsuario', 'errorCasaEditarUsuario')">
                                <option value="0" disabled name="opcionSelectCasa">0</option>
                                <option value="1" name="opcionSelectCasa">1</option>
                                <option value="2" name="opcionSelectCasa">2</option>
                                <option value="3" name="opcionSelectCasa">3</option>
                                <option value="4" name="opcionSelectCasa">4</option>
                                <option value="5" name="opcionSelectCasa">5</option>
                            </select>    
                            <div class="hide errorValidacion" id="errorCasaEditarUsuario"></div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-3 columna">
                            <label>Habilitado: </label>
                            <select  id="habilitadoEditarUsuario" name="habilitadoEditarUsuario" style="height:30px" onkeyup="validarCampoFormulario('habilitadoEditarUsuario', 'errorhabilitadoEditarUsuario')">
                                <option value="0" name="opcionSelectCasa">No</option>
                                <option value="1" name="opcionSelectCasa">Si</option>
                            </select>    
                            <div class="hide errorValidacion" id="errorhabilitadoEditarUsuario"></div>
                        </div>
                        <div class="col-12 col-lg-6 d-flex align-items-end justify-content-around mt-2 mt-md-2 mb-2 pb-md-1 mb-md-0">
                            <button type="button" name="botonCancelar" onclick="ocultarCaja('boxEditarUsuario', 'botonNuevoUsuario'), limpiarValidaciones('editar')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonEditar" onmouseover="validarFormularioCompleto('editar')" id="botonEditarUsuario" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#modalEdicionArticulo">
                                Confirmar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- MODAL CONFIRMACION EDICION USUARIO -->
                <div class="modal fade" id="modalEdicionArticulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma los cambios: <br><span id="spanEditarUsuario"></span>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="editarUsuario" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- BOX LISTADO USUARIOS -->
        <div class="contenedorSeccion contenedorModal">
            <div class="d-flex anchoTotal row">
                <div class="subtitle col-6">
                    Usuarios Disponibles
                </div>
                <div class="col-6 d-flex align-items-end justify-content-end">
                    <button type="submit" name="botonNuevoUsuario" onclick="mostrarCaja('boxCrearUsuario', 'boxEditarUsuario', 'botonNuevoUsuario')" id="botonNuevoUsuario" class="btn botonConfirmar col-6 col-md-3">Nuevo</button>        
                </div>
            </div>
            <!-- TABLA CON LISTA DE USUARIOS -->
            <div class="table-responsive">
                <table class="table <?php echo $hayDatos ?>">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width:20%">Nombre</th>
                            <th scope="col" style="width:20%">Apellido</th>
                            <th scope="col" style="width:10%; text-align:center">Sede</th>
                            <th scope="col" style="width:10%; text-align:center">Casa</th>
                            <th scope="col" style="width:10%; text-align:center">Rol</th>
                            <th scope="col" style="width:10%">Habilitado</th>
                            <th scope="col" style="width:10%"></th>
                            <th scope="col" style="width:10%"></th>
                        </tr>
                    </thead>
                    <form name="form2" method="POST" action="admin.php?adminUsuarios=">
                        <tbody>
                            <?php foreach($usuarios as $usuario){ ?>
                                <tr>
                                    <td><?php echo $usuario["id"] ?></td>
                                    <td><?php echo $usuario["nombre"] . " " . $usuario["segundoNombre"] ?></td>
                                    <td><?php echo $usuario["apellido"] ?></td>
                                    <td style="text-align: center"><?php echo $usuario["sede"] ?></td>
                                    <td style="text-align: center"><?php echo $usuario["casa"] ?></td>
                                    <td style="text-align: center"><?php echo $usuario["rol"] ?></td>
                                    <td style="text-align: center"><?php echo $usuario["habilitado"] == 1 ? 'Sí' : 'No' ?></td>
                                    <td class="d-flex justify-content-end"> 
                                        <button type="button" onmouseover="deshabilitarBotonTrash(<?php echo $usuario['id']?>, '<?php echo $usuario['rol']?>', <?php echo $usuario['habilitado']?>)" name="trashButton<?php echo $usuario['id']?>" id="trashButton<?php echo $usuario['id']?>" class="btn trashButton" onclick="eliminarUsuarios(<?php echo $usuario['id']?>, '<?php echo $usuario['nombre'];?>', '<?php echo $usuario['apellido'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn editButton" id="editButton<?php echo $usuario['id']?>" onmouseover="deshabilitarBotonEdit(<?php echo $usuario['id']?>, '<?php echo $usuario['rol']?>')" onclick="mostrarCaja('boxEditarUsuario', 'boxCrearUsuario', 'botonNuevoUsuario'), cargarDatosEdicion('<?php echo $usuario['id']?>', '<?php echo $usuario['nombre']?>', '<?php echo $usuario['segundoNombre']?>', '<?php echo $usuario['apellido']?>', '<?php echo $usuario['dni']?>', '<?php echo $usuario['rol']?>', '<?php echo $usuario['mail']?>', '<?php echo $usuario['idSede']?>', <?php echo $usuario['casa']?>, <?php echo $usuario['habilitado']?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg> 
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>   
                        </tbody>               
                </table>
            </div>
            <!-- TABLA SIN DATOS -->
            <table class="table <?php echo $noHayDatos?>">
                <thead class="d-flex justify-content-center">
                    <tr>
                        <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- MODAL CONFIRMACION ELIMINACION USUARIO -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" hidden name="idUsuarioEliminar" id="idUsuarioEliminar"></input>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body centrarTexto">
                        ¿Confirma que desea eliminar el usuario <b><span id="usuarioAEliminar"></span></b>?</br> Si desea habilitarlo nuevamente, en la opción editar podrá hacerlo.
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="eliminarUsuario" class="btn botonConfirmar">Confirmar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>