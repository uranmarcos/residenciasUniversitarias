<?php
session_start();
require("funciones/pdo.php");
require("funciones/adminUsuarios.php");
if($_SESSION["rol"] != "admin" && $_SESSION["rol"] != "general"){
    echo "<script> window.location.href='inicio.php' </script>";
}
?>
<html>
    <head>
        <title>Pedidos Sí</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="css/master2.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedorPrincipal">
            <div class="header">
                <?php require("componentes/header.php")?>
            </div>
            <div class="col-md-11 main">
                <div class="col-12 p-0">
                    <div class="titleSection">
                        <span class="pointer" onclick="redirect('inicio')">Inicio</span> -<span class="pointer" onclick="redirect('admin')"> Admin </span> - <span class="grey"> Admin USUARIOS</span>
                    </div>
                </div>
                
                <!-- CREACION DE USUARIO -->
                <div class="bloque hide" id="boxCrearUsuario">
                    <form name="form1" method="POST" action="adminSedes.php">
                        <!-- BOX NUEVA SEDE -->
                        <div class="contenedorSeccion contenedorModal mb-4">
                            <div class="d-flex anchoTotal justify-content-between">
                                <div class="subtitle mb-2">
                                    Nueva Sede
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-5 columna">
                                    <label >Provincia</label>
                                    <select id="selectProvincia" name="selectProvincia" onchange="validarFormCreacion()" style="width:100%; height:30px">
                                        <option value="">Seleccione</option>
                                        <option value="Buenos Aires">Buenos Aires</option>
                                        <option value="Catamarca">Catamarca</option>
                                        <option value="Chaco">Chaco</option>
                                        <option value="Chubut">Chubut</option>
                                        <option value="Córdoba">Córdoba</option>
                                        <option value="Corrientes">Corrientes</option>
                                        <option value="Entre Ríos">Entre Ríos</option>
                                        <option value="Formosa">Formosa</option>
                                        <option value="Jujuy">Jujuy</option>
                                        <option value="La Pampa">La Pampa</option>
                                        <option value="La Rioja">La Rioja</option>
                                        <option value="Mendoza">Mendoza</option>
                                        <option value="Misiones">Misiones</option>
                                        <option value="Nequén">Neuquén</option>
                                        <option value="Río Negro">Río Negro</option>
                                        <option value="Salta">Salta</option>
                                        <option value="San Juan">San Juan</option>
                                        <option value="San Luis">San Luis</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
                                        <option value="Santa Fe">Santa Fe</option>
                                        <option value="Santiago del Estero">Santiago del Estero</option>
                                        <option value="Tierra del Fuego">Tierra del Fuego</option>
                                        <option value="Tucumán">Tucumán</option>
                                    </select>   
                                </div>
                                <div class="col-12 col-md-5 columna">
                                    <label >Ciudad</label>
                                    <input maxlength="30" style="width:100%" autocomplete="off" name="inputNuevaSede" id="inputNuevaSede" onkeyup="validarFormCreacion(), validarSedeExistente('mensajeErrorCrear', value)">
                                    <div class="hide errorValidacion" id="mensajeErrorCrear"></div>
                                    <div class="hide errorValidacion" id="mensajeValidacionCrear">5 o mas caracteres</div>
                                    <div class="hide errorValidacion" id="mensajeSedeExistente"></div>
                                </div>
                                <div class="col-12 col-md-2 columna">
                                    <label> Casas: </label>
                                    <select id="selectCasas" name="selectCasas" style="width:100%; height:30px">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option> 
                                    </select>   
                                </div>
                                <div class="col-12 d-flex align-items-end justify-content-around mt-5">
                                    <button type="submit" name="botonCancelar" class="btn botonCancelar">Cancelar</button>
                                    <button type="button" name="botonGenerar" disabled onclick="crearNuevaSede()" id="botonCrearSede" class="btn boton" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Generar
                                    </button>
                                </div>
                            </div>
                        </div>
                         
                        <!-- MODAL CONFIRMACION CREACION SEDE -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        CONFIRMACIÓN
                                    </div>
                                    <div class="modal-body centrarTexto">
                                        ¿Confirma la nueva sede: <b><span id="spanNuevaSede"></span></b>?
                                    </div>
                                    <div class="modal-footer d-flex justify-content-around">
                                        <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="crearSede" onclick="confirmarCrearSede()" id="botonConfirmarCrearSede" class="btn boton">Confirmar</button>
                                        <button type="button" class="btnReenviarCircle hide" id="spinnerGenerarSede" >
                                            <div class="spinner-border spinnerReenviar" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </form>
                </div>
                <!-- END CREACION DE USUARIO -->
                
                    
                <!-- EDICION DE USUARIO -->
                <div class="bloque hide" id="boxEditarUsuario">
                    <form name="formEdicion" method="POST" action="adminUsuarios.php">
                        <!-- BOX EDICION SEDE -->
                        <div class="contenedorSeccion contenedorModal mb-4" id="boxEditarUsuario">
                            <div class="d-flex anchoTotal justify-content-between">
                                <div class="subtitle mb-2">
                                    Editar Usuario
                                </div> 
                            </div>             
                            <div class="row">
                                <div class="col-1 hide col-md-1 col-lg-3 columna">
                                    <label># </label>
                                    <input maxlength="12" name="idUsuarioPorEditar" readonly  id="idUsuarioPorEditar">
                                    <div class="hide errorValidacion" id="errorIdUsuarioPorEditar"></div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 columna">
                                    <label >Primer Nombre: </label>
                                    <input  maxlength="12" style="width:100%" name="primerNombreEditarUsuario" id="primerNombreEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('primerNombreEditarUsuario', 'errorPrimerNombreEditarUsuario')" id="primerNombreNuevoUsuario">
                                    <div class="hide row errorValidacion" id="errorPrimerNombreEditarUsuario"></div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 columna">
                                    <label>Segundo Nombre: </label>
                                    <input maxlength="12"  style="width:100%" name="segundoNombreEditarUsuario" id="segundoNombreEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('segundoNombreEditarUsuario', 'errorSegundoNombreEditarUsuario' )" id="segundoNombreEditarUsuario">
                                    <div class="hide errorValidacion" id="errorSegundoNombreEditarUsuario"></div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 columna">
                                    <label>Apellido: </label>
                                    <input maxlength="12"  style="width:100%" name="apellidoEditarUsuario" id="apellidoEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('apellidoEditarUsuario', 'errorApellidoEditarUsuario')" id="apellidoEditarUsuario">
                                    <div class="hide errorValidacion" id="errorApellidoEditarUsuario"></div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3 columna">
                                    <label>DNI: </label>
                                    <input maxlength="8"  style="width:100%" disabled name="dniEditarUsuario" id="dniEditarUsuario" autocomplete="off" onkeyup="validarCampoFormulario('dniEditarUsuario', 'errorDniEditarUsuario')" id="dniEditarUsuario">
                                    <div class="hide errorValidacion" id="errorDniEditarUsuario"></div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3 columna">
                                    <label>Rol: </label>
                                    <select id="rolEditarUsuario"  style="width:100%; height: 30px"  name="rolEditarUsuario" id="rolEditarUsuario" onchange="confirmarRol(value, 'editar'), habilitarBotonDirecto('botonEditarUsuario') " style="width:100%; height:30px">
                                        <?php foreach($roles as $rol){ ?>
                                            <option value="<?php echo $rol["value"] ?>"><?php echo $rol["descripcion"] ?></option>
                                        <?php } ?>
                                    </select>   
                                    <div class="hide errorValidacion" id="errorRolEditarUsuario"></div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 columna">
                                    <label>Mail: </label>
                                    <br>
                                    <input name="mailEditarUsuario"  style="width:100%" type="email" autocomplete="off" onkeyup="validarCampoFormulario('mailEditarUsuario', 'errorMailEditarUsuario')" id="mailEditarUsuario"> 
                                    <div class="hide errorValidacion" id="errorMailEditarUsuario"></div>
                                </div>
                                <div class="col-9 col-md-9 col-lg-3 columna">
                                    <label>Sede: </label>
                                    <br>
                                    <select style="height:30px; width: 100%;" id="sedeEditarUsuario" name="sedeEditarUsuario" onchange="selectSede(value), validarCampoFormulario('sedeEditarUsuario', 'errorSedeEditarUsuario')">
                                        <?php foreach($sedes as $sede){ ?>
                                            <option value="<?php echo $sede['id']?>"><?php echo $sede['provincia'] . " - " . $sede['descripcion']?></option>
                                        <?php } ?> 
                                    </select>    
                                    <div class="hide errorValidacion" id="errorSedeEditarUsuario"></div>
                                </div>
                                <div class="col-3 col-md-3 col-lg-3 columna">
                                    <label>Casa: </label>
                                    <br>
                                    <select  id="casaEditarUsuario" name="casaEditarUsuario" style="height:30px; width:100%" onchange="habilitarBotonDirecto('botonEditarUsuario')" onkeyup="validarCampoFormulario('casaEditarUsuario', 'errorCasaEditarUsuario')">
                                        <option value="0" disabled name="opcionSelectCasa">0</option>
                                        <option value="1" name="opcionSelectCasa">1</option>
                                        <option value="2" name="opcionSelectCasa">2</option>
                                        <option value="3" name="opcionSelectCasa">3</option>
                                        <option value="4" name="opcionSelectCasa">4</option>
                                        <option value="5" name="opcionSelectCasa">5</option>
                                    </select>    
                                    <div class="hide errorValidacion" id="errorCasaEditarUsuario"></div>
                                </div>
                                <div class="col-12 d-flex align-items-end justify-content-around mt-4 mb-2 pb-md-1 mb-md-0">
                                    <button type="button" name="botonCancelar" onclick="ocultarCaja('boxEditarUsuario', 'botonNuevoUsuario'), limpiarValidaciones('editar')" class="btn botonCancelar">Cancelar</button>
                                    <button type="button" name="botonEditar" onmouseover="validarFormularioCompleto('editar')" id="botonEditarUsuario" class="btn boton" data-bs-toggle="modal" data-bs-target="#modalEdicionArticulo">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL CONFIRMACION EDICION USUARIO -->
                        <div class="modal fade" id="modalEdicionArticulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body centrarTexto">
                                    ¿Confirma los cambios: <br><span id="spanEditarUsuario"></span>?
                                </div>
                                <div class="modal-footer d-flex justify-content-around">
                                    <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="editarUsuario" id="confirmarEditarUsuario" onclick="mostrarSpinner('confirmarEditarUsuario','spinnerEditarUsuario' )" class="btn boton">Confirmar</button>
                                    <button type="button" class="btnReenviarCircle hide" id="spinnerEditarUsuario" >
                                        <div class="spinner-border spinnerReenviar" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END EDICION DE USUARIO -->



                
                <!-- BOX LISTADO USUARIOS -->
                <div class="bloque">
                    <div class="alert alert-danger centrarTexto <?php echo $alertError ?>" id="alertErrorConexion" role="alert" >
                        <?php echo $mensajeAlertError ?>
                    </div>
                    <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
                        <?php echo $mensajeAlertConfirmacion ?>
                    </div>
                    <div class="contenedorSeccion contenedorModal">
                        <form name="form2" method="POST" action="adminUsuarios.php">
                            <div class="d-flex anchoTotal MB-2 row">
                                <div class="subtitle col-6">
                                    Usuarios Disponibles
                                </div>
                                <div class="col-6 d-flex align-items-end justify-content-end">
                                    <button type="submit" name="botonNuevoUsuario" onclick="mostrarCaja('boxCrearUsuario', 'boxEditarUsuario', 'botonNuevoUsuario')" id="botonNuevoUsuario" class="btn boton">Nuevo Usuario</button>        
                                </div>
                            </div>
                            <!-- START TABLA CON LISTA DE USUARIOS -->
                            <div class="table-responsive">
                                <table class="table <?php echo $hayDatos ?>">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="hide">#</th>
                                            <th scope="col" style="width:20%">Nombre</th>
                                            <th scope="col" style="width:20%">Apellido</th>
                                            <th scope="col" style="width:20%; text-align:center">Sede</th>
                                            <th scope="col" style="width:5%; text-align:center">Casa</th>
                                            <th scope="col" style="width:10%; text-align:center">Rol</th>
                                            <th scope="col" style="width:150px; text-align:center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($usuarios as $usuario){ ?>
                                            <tr>
                                                <td class="hide"><?php echo $usuario["id"] ?></td>
                                                <td><?php echo $usuario["nombre"] . " " . $usuario["segundoNombre"] ?></td>
                                                <td><?php echo $usuario["apellido"] ?></td>
                                                <td style="text-align: center"><?php echo $usuario["provincia"] . " - " . $usuario["sede"] ?></td>
                                                <td style="text-align: center"><?php echo $usuario["casa"] ?></td>
                                                <td style="text-align: center"><?php echo $usuario["rol"] ?></td>
                                                <td class="pl-0 pr-0" style="width:150px; text-align:center"> 
                                                    <div class="row" style="width:145px; margin:auto;">
                                                        <!-- BOTON TRASH -->
                                                        <div style="width:45px" onmouseover="overBotonAccion('btnTrash<?php echo $usuario['id']?>','btnTrashFill<?php echo $usuario['id']?>')" onmouseout="overBotonAccion('btnTrashFill<?php echo $usuario['id']?>', 'btnTrash<?php echo $usuario['id']?>')" name="trashButton<?php echo $usuario['id']?>" id="trashButton<?php echo $usuario['id']?>" class="trashButton" onclick="eliminarUsuarios(<?php echo $usuario['id']?>, '<?php echo $usuario['nombre'];?>', '<?php echo $usuario['apellido'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" id="btnTrash<?php echo $usuario['id']?>" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg>    
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi hide bi-trash-fill" id="btnTrashFill<?php echo $usuario['id']?>" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                        </div>
                                                        <!-- BOTON EDIT -->
                                                        <div style="width:45px" class="editButton" id="editButton<?php echo $usuario['id']?>" onmouseover="deshabilitarBotonEdit(<?php echo $usuario['id']?>, '<?php echo $usuario['rol']?>'), overBotonAccion('btnPen<?php echo $usuario['id']?>','btnPenFill<?php echo $usuario['id']?>')" onmouseout="overBotonAccion('btnPenFill<?php echo $usuario['id']?>', 'btnPen<?php echo $usuario['id']?>')" onclick="mostrarCaja('boxEditarUsuario', 'boxCrearUsuario', 'botonNuevoUsuario'), cargarDatosEdicion('<?php echo $usuario['id']?>', '<?php echo $usuario['nombre']?>', '<?php echo $usuario['segundoNombre']?>', '<?php echo $usuario['apellido']?>', '<?php echo $usuario['dni']?>', '<?php echo $usuario['rol']?>', '<?php echo $usuario['mail']?>', '<?php echo $usuario['idSede']?>', <?php echo $usuario['casa']?>)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="btnPen<?php echo $usuario['id']?>" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="btnPenFill<?php echo $usuario['id']?>" class="bi hide bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg> 
                                                        </div>
                                                        <!-- BOTON KEY -->
                                                        <div style="width:45px" class="editButton" id="passwordButton<?php echo $usuario['id']?>" onmouseover="deshabilitarBotonPass(<?php echo $usuario['id']?>, '<?php echo $usuario['rol']?>'), overBotonAccion('btnKey<?php echo $usuario['id']?>','btnKeyFill<?php echo $usuario['id']?>')"  onmouseout=" overBotonAccion('btnKeyFill<?php echo $usuario['id']?>', 'btnKey<?php echo $usuario['id']?>')" onclick="cargarResetPassword('<?php echo $usuario['id']?>', '<?php echo $usuario['dni']?>', '<?php echo $usuario['nombre']?>', '<?php echo $usuario['segundoNombre']?>', '<?php echo $usuario['apellido']?>')" data-bs-toggle="modal" data-bs-target="#modalResetPassword" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" id="btnKey<?php echo $usuario['id']?>" viewBox="0 0 16 16">
                                                                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi hide bi-key-fill" id="btnKeyFill<?php echo $usuario['id']?>" viewBox="0 0 16 16">
                                                                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                            </svg>    
                                                        </div>
                                                    </div>
                                                </td>                                            
                                            </tr>
                                        <?php } ?>   
                                    </tbody>               
                                </table>
                            </div>
                            <!-- END TABLA CON LISTA DE USUARIOS -->
                            <!-- START TABLA SIN DATOS -->
                            <table class="table <?php echo $noHayDatos?>">
                                <thead class="d-flex justify-content-center">
                                    <tr>
                                        <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- END TABLA SIN DATOS -->
                        </form>
                    </div>





                    <!-- START MODAL CONFIRMACION ELIMINACION USUARIO -->
                    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="adminUsuarios.php" method="POST">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="text" hidden name="idUsuarioEliminar" id="idUsuarioEliminar"></input>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body centrarTexto">
                                        ¿Confirma que desea eliminar el usuario <b><span id="usuarioAEliminar"></span></b>?
                                    </div>
                                    <div class="modal-footer d-flex justify-content-around">
                                        <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="eliminarUsuario" id="btnEliminarUsuario" onclick="mostrarSpinner('btnEliminarUsuario', 'spinnerEliminarUsuario')" class="btn boton">Confirmar</button>
                                        <button type="button" class="btnReenviarCircle hide" id="spinnerEliminarUsuario">
                                            <div class="spinner-border spinnerReenviar" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END MODAL CONFIRMACION ELIMINACION USUARIO -->
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>          
        <script type="text/javascript"  src="js/funcionesCompartidas.js"></script> 
        <script type="text/javascript"  src="js/adminUsuarios.js"></script> 
    </body>
</html>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
function selectSede(param) {
    if(param != 0) {
        let sedes = <?php echo json_encode($sedes)?> 
        let casas = sedes.filter(e=> e.id == param)
        casas = parseInt(casas[0].casas)
        let opciones = document.getElementsByName("opcionSelectCasa")
        let selectCasas = document.getElementById("casaNuevoUsuario")
        selectCasas.value = 1
        let selectCasasEditar = document.getElementById("casaEditarUsuario")
        selectCasasEditar.value = 1
        opciones = Array.from(opciones);
        opciones.forEach(e => {
            e.removeAttribute("disabled")
        })
        opciones.forEach(e => {
            if (e.value > casas || e.value == 0){
                e.setAttribute("disabled", true)
            }
        })
    }
}
function validarFormularioCompleto(accion) {
    let campos = null
    let camposErrores = null
    if(accion == "crear"){
        campos = <?php  echo json_encode($camposCreacion) ?>;
        camposErrores = <?php  echo json_encode($camposErroresCreacion); ?>;
    } else {
        campos = <?php  echo json_encode($camposEdicion); ?>;
        camposErrores = <?php  echo json_encode($camposErroresEdicion); ?>;
    }
    let validacion = true;
    campos.forEach(e => {
        switch (e) {
        // case primer nombre
        case campos[0]:
            let valuePrimerNombre = document.getElementById(campos[0]).value
            let campoErrorPrimerNombre = document.getElementById(camposErrores[0])
            campoErrorPrimerNombre.classList.remove("hide")
            if (valuePrimerNombre.trim() == "") {
                campoErrorPrimerNombre.innerHTML = "Campo requerido"
                validacion = false
            } else if (valuePrimerNombre.trim().length < 3) {
                campoErrorPrimerNombre.innerHTML = "Mínimo 3 dígitos"
                validacion = false
            } else {
                if (!soloLetras(valuePrimerNombre)){
                    campoErrorPrimerNombre.innerHTML = "Solo letras y espacios"
                    validacion = false
                } else {
                    campoErrorPrimerNombre.classList.add("hide")
                }
            }
        break;
        // case segundo nombre
        case campos[1]:
            let valueSegundoNombre = document.getElementById(campos[1]).value
            let campoErrorSegundoNombre = document.getElementById(camposErrores[1])
            campoErrorSegundoNombre.classList.remove("hide")
            if(valueSegundoNombre.trim() != ""){
                if (valueSegundoNombre.length < 3) {
                    campoErrorSegundoNombre.innerHTML = "Mínimo 3 dígitos"
                    validacion = false
                } else {
                    if (!soloLetras(valueSegundoNombre)){
                        campoErrorSegundoNombre.innerHTML = "Solo letras y espacios"
                        validacion = false
                    } else {
                        campoErrorSegundoNombre.classList.add("hide")
                    }
                }
            } else {
                campoErrorSegundoNombre.classList.add("hide")
            }
        break;
        // case apellido
        case campos[2]:
            let valueApellido = document.getElementById(campos[2]).value
            let campoErrorApellido = document.getElementById(camposErrores[2])
            campoErrorApellido.classList.remove("hide")
            if (valueApellido.trim() == "") {
                campoErrorApellido.innerHTML = "Campo requerido"
                validacion = false
            } else if (valueApellido.trim().length < 3) {
                campoErrorApellido.innerHTML = "Mínimo 3 dígitos"
                validacion = false
            } else {
                if (!soloLetras(valueApellido)){
                    campoErrorApellido.innerHTML = "Solo letras y espacios"
                    validacion = false
                } else {
                    let validacion = true;
                    campoErrorApellido.classList.add("hide")
                }
            }
        break;
        //case dni
        case campos[3]:
            let valueDni = document.getElementById(campos[3]).value
            let campoErrorDni = document.getElementById(camposErrores[3])
            campoErrorDni.classList.remove("hide")
            if (valueDni.trim() == "") {
                campoErrorDni.innerHTML = "Campo requerido"
                validacion = false
            } else if (valueDni.length < 8) {
                campoErrorDni.innerHTML = "8 dígitos"
                validacion = false
            } else {
                if (!isNumber(valueDni)){
                    campoErrorDni.innerHTML = "Campo numérico"
                    validacion = false
                } else {
                    campoErrorDni.classList.add("hide")
                }
            }
        break;
        //case mail
        case campos[4]:
            let valueMail = document.getElementById(campos[4]).value
            let campoErrorMail = document.getElementById(camposErrores[4])
            campoErrorMail.classList.remove("hide")
            if (valueMail.trim() == "") {
                campoErrorMail.innerHTML = "Campo requerido"
                validacion = false
            } else if (!isEmailAddress(valueMail)){
                campoErrorMail.innerHTML = "Formato incorrecto"
                validacion = false
            } else {
                campoErrorMail.classList.add("hide")
            }
        break;  
        //case sede
        case campos[5]:
            let valueSede = document.getElementById(campos[5]).value
            let campoErrorSede = document.getElementById(camposErrores[5])
            campoErrorSede.classList.remove("hide")
            if (valueSede == 0){
                campoErrorSede.innerHTML = "Campo requerido"
                validacion = false
            } else {
                campoErrorSede.classList.add("hide")
            }
        break;  
        default:
        break;
        }
    })
    if(accion == "crear"){
        let boton = document.getElementById("botonCrearUsuario")
        if(validacion){
            boton.removeAttribute("disabled")
            actualizarDatosModalCrear()
        }else{
            boton.setAttribute("disabled", true)
        }
    } else {
        let boton = document.getElementById("botonEditarUsuario")
        if(validacion){
            boton.removeAttribute("disabled")
            actualizarDatosModalEditar()
        }else{
            boton.setAttribute("disabled", true)
        }
    }
}

</script>