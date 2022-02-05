<?php
session_start();
require("funciones/pdo.php");
require("funciones/funcionesPerfil.php");

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
                        <span class="pointer" onclick="redirect('inicio')">Inicio</span> -<span class="grey"> Mi perfil </span>
                    </div>
                </div>
                <div>
                    <div class="alert alert-danger mt-3 centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
                        <?php echo $mensajeAlertError ?>
                    </div>
                    <div class="alert alert-success mt-3 centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
                        <?php echo $mensajeAlertConfirmacion ?>
                    </div>
                    <!-- BOX CAMBIO DE CONTRASEÑA -->
                    <div class="hide" id="boxChangePassword">
                        <form name="form" method="POST" action="perfil.php">
                            <!-- BOX CONTRASEÑA -->
                            <div class="bloque  mb-4">
                                <div class="d-flex anchoTotal justify-content-between">
                                    <div class="subtitle mb-2">
                                        Cambio de Contraseña
                                    </div> 
                                </div>
                                <div class="row d-flex justify-content-center mt-1 mb-2">
                                    <div class="col-12 col-md-6 col-lg-4 columnaBloque">
                                        <label>Ingrese su actual contraseña </label>
                                        <div class="row m-0">
                                            <input class="col-10" maxlength="15" type="password" onkeyup="validarFormPass()" name="inputPassword" autocomplete="off" id="inputPassword">
                                            <div class="col-2">
                                                <div class="eyeButton pt-1" id="mostrarContraseniaPerfil" onclick="mostrarContrasenia('mostrarContraseniaPerfil', 'ocultarContraseniaPerfil', 'inputPassword')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </div>
                                                <div class="hide eyeButton pt-1" id="ocultarContraseniaPerfil" onclick="ocultarContrasenia('mostrarContraseniaPerfil', 'ocultarContraseniaPerfil', 'inputPassword')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hide errorValidacion" id="errorInputPassword"></div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 columnaBloque">
                                        <label>Ingrese su nueva contraseña </label>
                                        <div class="row m-0">
                                            <input class="col-10" maxlength="15" type="password" onkeyup="validarPassword(), validarFormPass()" name="inputNewPassword" autocomplete="off" id="inputNewPassword"> 
                                            <div class="col-2">
                                                <div class="eyeButton pt-1" id="mostrarNewContraseniaPerfil" onclick="mostrarContrasenia('mostrarNewContraseniaPerfil', 'ocultarNewContraseniaPerfil', 'inputNewPassword')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </div>
                                                <div class="hide eyeButton pt-1" id="ocultarNewContraseniaPerfil" onclick="ocultarContrasenia('mostrarNewContraseniaPerfil', 'ocultarNewContraseniaPerfil', 'inputNewPassword')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hide errorValidacion" id="errorNewPassword">Entre 8 y 15 caracteres</div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 columnaBloque">
                                        <label>Repita su nueva contraseña: </label>
                                        <div class="row m-0">
                                            <input class="col-10" maxlength="15" type="password" name="confirmPassword" autocomplete="off" onkeyup="compararContrasenias(), validarFormPass()" id="inputConfirmPassword">
                                                <div class="col-2">
                                                    <div class="eyeButton pt-1" id="mostrarConfirmContraseniaPerfil" onclick="mostrarContrasenia('mostrarConfirmContraseniaPerfil', 'ocultarConfirmContraseniaPerfil', 'inputConfirmPassword')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="hide eyeButton pt-1" id="ocultarConfirmContraseniaPerfil" onclick="ocultarContrasenia('mostrarConfirmContraseniaPerfil', 'ocultarConfirmContraseniaPerfil', 'inputConfirmPassword')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="hide errorValidacion" id="errorConfirmPassword">Las contraseñas no coinciden</div>
                                    </div>                      
                                    <div class="col-12 col-md-6 col-lg-12 d-flex align-items-end justify-content-around mt-4  mb-2 pb-md-1 mb-md-0">
                                        <button type="button" name="botonCancelar" onclick="cancelarChangePassword()" class="btn botonCancelar ">Cancelar</button>
                                        <button type="button" name="botonGenerar" disabled id="botonPassword" class="btn boton" data-bs-toggle="modal" data-bs-target="#modalPassword">
                                            Modificar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL CONFIRMACION CAMBIO CONTRASEÑA -->
                            <div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header centrarTexto">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body centrarTexto">
                                        ¿Desea confirmar el cambio de contraseña?
                                    </div>
                                    <div class="modal-footer d-flex justify-content-around">
                                        <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="cambiarPassword" id="btnChangePassword" onclick="mostrarLoading('btnChangePassword', 'botonEditPassword')" class="btn boton">Confirmar</button>
                                        <button type="button" class="boton hide" id="botonEditPassword" >
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                    <!-- BOX MI PERFIL -->
                    <div class="bloque <?php echo $hayDatos?>" id="boxEditarUsuario">
                        <!-- BOTONES CAMBIAR CONTRASEÑA Y EDITAR PERFIL-->
                        <div class="d-flex anchoTotal justify-content-between mb-4">
                            <div class="col-6 d-flex p-0 align-items-center justify-content-start">
                                <button type="button" name="botonEditarPassword" onclick="editarPassword()" id="botonEditarPassword" class="btn boton">Cambiar Contraseña</button>        
                            </div> 
                            <div class="col-6 d-flex p-0 align-items-center justify-content-end">
                                <button type="button" name="botonEditar" onclick="editarPerfil()" id="botonEditar" class="btn boton">Editar Perfil</button>        
                            </div>
                        </div>   
                        <form name="form" method="POST" action="perfil.php">          
                            <!-- CONTENEDOR DATOS MI PERFIL -->
                            <div class="row  d-flex justify-content-center">
                                <div class="col-1 col-md-1 col-lg-3 hide columnaBloque">
                                    <label># </label>
                                    <input maxlength="12" name="idPerfil" disabled value="<?php echo $perfil[0]["id"]?>" id="idPerfil">
                                    <div class="hide errorValidacion" id="errorIdPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Primer Nombre: </label>
                                    <input maxlength="12" disabled name="nombrePerfil" autocomplete="off" onkeyup="validarCampoFormulario('nombrePerfil', 'errorNombrePerfil')" value="<?php echo $perfil[0]["nombre"]?>" id="nombrePerfil">
                                    <div class="hide errorValidacion" id="errorNombrePerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Segundo Nombre: </label>
                                    <input maxlength="12" disabled name="segundoNombrePerfil" autocomplete="off" onkeyup="validarCampoFormulario('segundoNombrePerfil', 'errorSegundoNombrePerfil' )" value="<?php echo $perfil[0]["segundoNombre"]?>" id="segundoNombrePerfil">
                                    <div class="hide errorValidacion" id="errorSegundoNombrePerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Apellido: </label>
                                    <input maxlength="12" disabled name="apellidoPerfil" autocomplete="off" onkeyup="validarCampoFormulario('apellidoPerfil', 'errorApellidoPerfil')" value="<?php echo $perfil[0]["apellido"]?>" id="apellidoPerfil">
                                    <div class="hide errorValidacion" id="errorApellidoPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>DNI: </label>
                                    <input maxlength="8" disabled name="dniPerfil" autocomplete="off" value="<?php echo $perfil[0]["dni"]?>" id="dniPerfil">
                                    <div class="hide errorValidacion" id="errorDniPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Rol: </label>
                                    <input maxlength="8" disabled name="rolPerfil" autocomplete="off" value="<?php echo $perfil[0]["rol"]?>" id="rolPerfil">
                                    <div class="hide errorValidacion" id="errorRolPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Mail: </label>
                                    <input name="mailPerfil" disabled type="email" autocomplete="off" onkeyup="validarCampoFormulario('mailPerfil', 'errorMailPerfil')" value="<?php echo $perfil[0]["mail"]?>" id="mailPerfil"> 
                                    <div class="hide errorValidacion" id="errorMailPerfil"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Sede: </label>
                                    <input name="sedePerfil" disabled type="text" autocomplete="off" value="<?php echo $perfil[0]["nombreSede"]?>" id="sedePerfil"> 
                                    <div class="hide errorValidacion" id="errorSedeEditarUsuario"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 columnaBloque">
                                    <label>Casa: </label>
                                    <input name="casaPerfil" disabled type="text" autocomplete="off" value="<?php echo $perfil[0]["casa"]?>" id="casaPerfil"> 
                                    <div class="hide errorValidacion" id="errorCasaPerfil"></div>
                                </div>
                                <div class="col-12 col-lg-9  hide  mt-4 mb-2 mb-md-0 " id="botonesEdicionPerfil">
                                    <div class="col-12 d-flex align-items-end justify-content-around" style="height:100%" >
                                        <button type="submit" name="botonCancelar" onclick="cancelarEdicion()" class="btn botonCancelar">Cancelar</button>
                                        <button type="button" name="botonEditar" onmouseover="validarFormularioCompleto()" id="botonEditar" class="btn boton" data-bs-toggle="modal" data-bs-target="#modalEdicionPerfil">
                                            Confirmar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL CONFIRMACION EDICION PERFIL -->
                            <div class="modal fade" id="modalEdicionPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body black centrarTexto">
                                            ¿Confirma los cambios: <br><span id="spanEditarPerfil"></span>?
                                        </div>
                                        <div class="modal-footer d-flex justify-content-around">
                                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" id="botonEditarPerfil" name="editarPerfil" onclick="mostrarLoading('botonEditarPerfil', 'botonEditLoading')" class="btn boton">Confirmar</button>
                                            <button type="button" class="boton hide" id="botonEditLoading" >
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- BOX SIN DATOS -->
                    <div class="bloque mb-4 pb-0 <?php echo $noHayDatos?>" id="">
                        <table class="table <?php echo $noHayDatos?>">
                            <thead class="d-flex justify-content-center">
                                <tr>
                                    <th scope="col" style="width:100%">NO SE ENCONTRARON DATOS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>           
        <script type="text/javascript"  src="js/funcionesCompartidas.js"></script> 
        <script type="text/javascript"  src="js/funcionesPerfil.js"></script> 
    </body>
</html>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>