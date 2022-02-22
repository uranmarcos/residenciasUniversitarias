<?php
session_start();
require("funciones/pdo.php");
require("funciones/adminSedes.php");
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
                        <span class="pointer" onclick="redirect('inicio')">Inicio</span> -<span class="pointer" onclick="redirect('admin')"> Admin </span> - <span class="grey"> Admin SEDES</span>
                    </div>
                </div>
                

                <!-- BOX LISTADO SEDES -->
                <form name="form2" method="POST" action="adminSedes.php">
                <div class="bloque">
                    <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
                        <?php echo $mensajeAlertError ?>
                    </div>
                    <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
                        <?php echo $mensajeAlertConfirmacion ?>
                    </div>
                    <div class="contenedorSeccion contenedorModal">
                        <div class="d-flex anchoTotal MB-2 row">
                            <div class="subtitle col-6">
                                Sedes Disponibles
                            </div>
                            <div class="col-6 d-flex align-items-end justify-content-end">
                                <button type="button" class="btn boton" data-toggle="modal" data-target="#creacionSedeModal">Nueva Sede</button>        
                            </div>
                        </div>
                        <!-- TABLA CON LISTA DE SEDES -->
                        <div class="table-responsive">
                            <table class="table <?php echo $hayDatos ?>">
                                <thead>
                                    <tr>
                                        <th scope="col" class="hide">#</th>
                                        <th scope="col" style="width:40%">Provincia</th>
                                        <th scope="col" style="width:40%">Localidad</th>
                                        <th scope="col" style="width:10%; text-align:center">Casas</th>
                                        <th scope="col" style="width:100px; text-align:center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($sedes as $sede){ ?>
                                        <tr>
                                            <td class="hide"><?php echo $sede["id"] ?></td>
                                            <td><?php echo $sede["provincia"] ?></td>
                                            <td><?php echo $sede["descripcion"] ?></td>
                                            <td style="text-align: center"><?php echo $sede["casas"] ?></td>
                                            <td class="pl-0 pr-0" style="width:100px; text-align:center"> 
                                                <div class="row" style="width:90px; margin:auto;">
                                                    <!-- START BOTON TRASH -->
                                                    <div style="width:45px" name="trashButton<?php echo $sede['id']?>" id="trashButton<?php echo $sede['id']?>" class="trashButton" onmouseover="overBotonAccion('btnTrash<?php echo $sede['id']?>','btnTrashFill<?php echo $sede['id']?>')"  onmouseout="overBotonAccion('btnTrashFill<?php echo $sede['id']?>', 'btnTrash<?php echo $sede['id']?>')" onclick="eliminarSedes(<?php echo $sede['id']?>, '<?php echo $sede['provincia'] . ', ' .$sede['descripcion'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" id="btnTrash<?php echo $sede['id']?>" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>    
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi hide bi-trash-fill" id="btnTrashFill<?php echo $sede['id']?>" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                        </svg>
                                                    </div>
                                                    <!-- END BOTON TRASH -->
                                                    <!-- START BOTON EDIT -->
                                                    <div style="width:45px" class="editButton" onmouseover="overBotonAccion('btnPen<?php echo $sede['id']?>','btnPenFill<?php echo $sede['id']?>')"  onmouseout="overBotonAccion('btnPenFill<?php echo $sede['id']?>', 'btnPen<?php echo $sede['id']?>')" onclick="cargarDatosEdicion('<?php echo $sede['id']?>', '<?php echo $sede['provincia']?>', '<?php echo $sede['descripcion']?>', '<?php echo $sede['casas']?>')" data-bs-toggle="modal" data-bs-target="#edicionSedeModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="btnPen<?php echo $sede['id']?>" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="btnPenFill<?php echo $sede['id']?>" class="bi hide bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg> 
                                                    </div>
                                                    <!-- END BOTON EDIT -->
                                                </div>
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
                        <!-- </div> -->
                    </div>

                </form>


                <!-- START MODAL CONFIRMACION ELIMINACION SEDE -->
                <form name="formCreacion" method="POST" action="adminSedes.php">
                    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <input type="text" hidden name="idSedeEliminar" id="idSedeEliminar"></input>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body centrarTexto">
                                    ¿Confirma que desea eliminar la sede <b><span id="sedeAEliminar"></span></b>?
                                </div>
                                <div class="modal-footer d-flex justify-content-around">
                                    <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="eliminarSede" onclick="confirmarEliminarSede()" id="btnEliminarSede" class="btn boton">Confirmar</button>
                                    <button type="button" class="btnReenviarCircle hide" id="spinnerEliminarSede" >
                                        <div class="spinner-border spinnerReenviar" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END MODAL CONFIRMACION ELIMINACION SEDE -->


                <!----     START MODAL CREACION DE SEDES    ----->
                <form name="formCreacion" method="POST" action="adminSedes.php">
                    <div class="modal fade" id="creacionSedeModal" tabindex="-1" role="dialog" aria-labelledby="creacionSedeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title centrarTexto purple" id="creacionSedeModalLabel">CREACIÓN DE SEDE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="bodyModalCrear">
                                    <div class="contenedorSeccion purple contenedorModal mb-4">        
                                        <div class="row">
                                            <div class="col-12 columna">
                                                <button type="button" class="btn botonLimpiar" id="btnLimpiarCreacion" onclick="limpiarFormularioCreacion()">Limpiar Formulario</button>
                                            </div>
                                            <div class="col-12 columna">
                                                <label >Provincia</label>
                                                <select id="provinciaCreacion" name="provinciaCreacion" style="width:100%; height:30px">
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
                                            <div class="col-10 columna">
                                                <label >Ciudad</label>
                                                <input maxlength="30" style="width:100%" autocomplete="off" name="sedeCreacion" id="sedeCreacion" onkeyup="validarSedeCreacion(value)">
                                                <div class="hide errorValidacion" id="mensajeErrorCrear"></div>
                                            </div>
                                            <div class="col-2 columna">
                                                <label> Casas: </label>
                                                <select id="casasCreacion" name="casasCreacion" style="width:100%; height:30px">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option> 
                                                </select>   
                                            </div>           
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-12" id="botonesModalCreacion">
                                        <div class="d-flex align-items-center justify-content-around">
                                            <button type="button" class="btn botonCancelar" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn boton" id="btnCrear" disabled onclick="pedirConfirmacion('botonesModalCreacion', 'confirmacionCreacion', 'crear')">Confirmar</button>
                                        </div>
                                    </div>
                                    <div class="col-12  hide" id="confirmacionCreacion">
                                        <div class="d-flex align-items-center mb-3 purple justify-content-around">
                                            ¿Confirma la creación de la sede?
                                        </div>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <button type="button" class="btn botonCancelar" onclick="cancelarConfirmacion('confirmacionCreacion', 'botonesModalCreacion', 'crear')">Cancelar</button>
                                            <button type="submit" name="crearSede" id="btnCrearSede" onclick="desbloquearFormularioCreacion(), mostrarSpinner('btnCrearSede','spinnerCrearSede')" class="btn boton">Confirmar</button>
                                            <button type="button" class="btnReenviarCircle hide" id="spinnerCrearSede" >
                                                <div class="spinner-border spinnerReenviar" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!----     END MODAL CREACION DE SEDES    ----->


                <!----     START MODAL EDICION DE SEDES    ----->
                <form name="formEdicion" method="POST" action="adminSedes.php">
                    <div class="modal fade" id="edicionSedeModal" tabindex="-1" role="dialog" aria-labelledby="edicionSedeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title centrarTexto purple" id="edicionSedeModalLabel">EDICIÓN DE SEDE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="bodyModalEditar">
                                    <div class="contenedorSeccion purple contenedorModal mb-4">        
                                        <div class="row">
                                            <div class="col-12 columna">
                                                <button type="button" class="btn botonLimpiar" id="btnLimpiarEdicion" onclick="limpiarFormularioEdicion()">Limpiar Formulario</button>
                                            </div>
                                            <input name="idSedeEdicion" id="idSedeEdicion" class="hide">                                          
                                            <div class="col-12 columna ">
                                                <label >Provincia</label>
                                                <select id="provincia" name="provincia" onchange="validarFormEdicion()" style="width:100%; height:30px">
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
                                            <div class="col-10 columna ">
                                                <label >Ciudad</label>
                                                <input maxlength="30" style="width:100%" autocomplete="off" name="sede" id="sede" onkeyup="validarSedeEdicion(value)">
                                                <div class="hide errorValidacion" id="mensajeErrorEditar"></div>
                                            </div>


                                            <!-- <div class="col-12 columna">
                                                <label >Provincia</label>
                                                <select id="provinciaEdicion" name="provinciaEdicion" onchange="validarFormEdicion()" style="width:100%; height:30px">
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
                                            <div class="col-10 columna">
                                                <label >Ciudad</label>
                                                <input maxlength="30" style="width:100%" autocomplete="off" name="sedeEdicion" id="sedeEdicion" onkeyup="validarSedeEdicion(value)">
                                                <div class="hide errorValidacion" id="mensajeErrorEditar"></div>
                                            </div> -->
                                            <div class="col-2 columna">
                                                <label> Casas: </label>
                                                <select id="casas" name="casas" onchange="validarFormEdicion()" style="width:100%; height:30px">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option> 
                                                </select>   
                                            </div>           
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-12" id="botonesModalEdicion">
                                        <div class="d-flex align-items-center justify-content-around">
                                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn boton" id="btnEditar" disabled onclick="pedirConfirmacion('botonesModalEdicion', 'confirmacionEdicion', 'editar')">Confirmar</button>
                                        </div>
                                    </div>
                                    <div class="col-12  hide" id="confirmacionEdicion">
                                        <div class="d-flex align-items-center mb-3 purple justify-content-around">
                                            ¿Confirma la edición de la sede?
                                        </div>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <button type="button" class="btn botonCancelar" onclick="cancelarConfirmacion('confirmacionEdicion', 'botonesModalEdicion', 'editar')">Cancelar</button>
                                            <button type="submit" name="editarSede" id="btnEditarSede" onclick="desbloquearFormularioCreacion(), mostrarSpinner('btnEditarSede','spinnerEditarSede')" class="btn boton">Confirmar</button>
                                            <button type="button" class="btnReenviarCircle hide" id="spinnerEditarSede" >
                                                <div class="spinner-border spinnerReenviar" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!----     END MODAL EDICION DE SEDES    ----->


                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>          
        <script type="text/javascript"  src="js/funcionesCompartidas.js"></script> 
        <script type="text/javascript"  src="js/adminSedes.js"></script> 
    </body>
</html>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

window.onload = function(){
    let alertConfirmacion = document.getElementById("alertConfirmacion")
    if (alertConfirmacion.classList.contains('show')) {
        setTimeout(ocultarAlertConfirmacion, 5000)
    }
    let alertErrorConexion = document.getElementById("alertErrorConexion")
    if (alertErrorConexion.classList.contains('show')) {
        setTimeout(ocultarAlertError, 5000)
    }
}




function validarSedeEdicion(value){
    let mensajeError = document.getElementById("mensajeErrorEditar")
    let btnEdicion = document.getElementById("btnEditar")
    btnEdicion.setAttribute("disabled", true)
    let sedes = <?php  echo json_encode($sedes) ?>;
    if(value.length >=5) {
        let sedesExistentes = sedes.filter(element => element.descripcion.toLowerCase().includes(value.toLowerCase()))
        let descripcionesSedesExistentes = ""
        sedesExistentes.forEach(function callback(value, index) {
            descripcionesSedesExistentes = descripcionesSedesExistentes + value.descripcion + " "
        })
        if(sedesExistentes.length > 0) {
            mensajeError.classList.remove("hide")
            mensajeError.innerHTML = "Ya existen las siguientes sedes: " + descripcionesSedesExistentes
        }else{
            btnEdicion.removeAttribute("disabled")
            mensajeError.classList.add("hide")
        }
    } else {
        mensajeError.classList.remove("hide")
        mensajeError.innerHTML = "5 o mas caracteres"
    }
}
function validarSedeCreacion(value){
    let mensajeError = document.getElementById("mensajeErrorCrear")
    let btnEdicion = document.getElementById("btnCrear")
    btnEdicion.setAttribute("disabled", true)
    let sedes = <?php  echo json_encode($sedes) ?>;
    if(value.length >=5) {
        let sedesExistentes = sedes.filter(element => element.descripcion.toLowerCase().includes(value.toLowerCase()))
        let descripcionesSedesExistentes = ""
        sedesExistentes.forEach(function callback(value, index) {
            descripcionesSedesExistentes = descripcionesSedesExistentes + value.descripcion + " "
        })
        if(sedesExistentes.length > 0) {
            mensajeError.classList.remove("hide")
            mensajeError.innerHTML = "Ya existen las siguientes sedes: " + descripcionesSedesExistentes
        }else{
            btnEdicion.removeAttribute("disabled")
            mensajeError.classList.add("hide")
        }
    } else {
        mensajeError.classList.remove("hide")
        mensajeError.innerHTML = "5 o mas caracteres"
    }
}


function validarFormEdicion () {
    let sede  = document.getElementById("sede").value
    let btnEditar  = document.getElementById("btnEditar")
    btnEditar.setAttribute("disabled", true)
    if (sede.length >= 5) {
        btnEditar.removeAttribute("disabled")
    }
}

function cargarDatosEdicion(id, provincia, sede, casas){
    document.getElementById("idSedeEdicion").value = id
    document.getElementById("provincia").value = provincia
    document.getElementById("sede").value = sede
    document.getElementById("casas").value = casas
    limpiarValidaciones("editar")
}

function pedirConfirmacion(idOcultar, idMostrar, accion) {
    let cajaOcultar = document.getElementById(idOcultar)
    cajaOcultar.classList.add("hide")
    let cajaMostrar = document.getElementById(idMostrar)
    cajaMostrar.classList.remove("hide")
    if (accion == "crear") {
        bloquearFormularioCreacion()
    } else {
        bloquearFormularioEdicion()
    }
}
function cancelarConfirmacion(idOcultar, idMostrar, accion) {
    let cajaOcultar = document.getElementById(idOcultar)
    cajaOcultar.classList.add("hide")
    let cajaMostrar = document.getElementById(idMostrar)
    cajaMostrar.classList.remove("hide")
    if (accion == "crear") {
        desbloquearFormularioCreacion()
    } else {
        desbloquearFormularioEdicion()
    }
}
function limpiarFormularioCreacion () {
    document.getElementById("provinciaCreacion").value = "Buenos Aires"
    document.getElementById("sedeCreacion").value = ""
    document.getElementById("casasCreacion").value = 1
    let btnCreacion = document.getElementById("btnCrear")
    btnCreacion.setAttribute("disabled", true)
    limpiarValidaciones("crear")
}
function limpiarFormularioEdicion () {
    document.getElementById("provincia").value = "Buenos Aires"
    document.getElementById("sede").value = ""
    document.getElementById("casas").value = 1
    let btnEdicion = document.getElementById("btnEditar")
    btnEdicion.setAttribute("disabled", true)
    limpiarValidaciones("editar")
}



function bloquearFormularioCreacion() {
    let btnLimpiar = document.getElementById("btnLimpiarCreacion")
    btnLimpiar.setAttribute("disabled", true)
    let provincia = document.getElementById("provinciaCreacion")
    provincia.setAttribute("disabled", true)
    let sede = document.getElementById("sedeCreacion")
    sede.setAttribute("disabled", true)
    let casas = document.getElementById("casasCreacion")
    casas.setAttribute("disabled", true)
}
function desbloquearFormularioCreacion() {
    let btnLimpiar = document.getElementById("btnLimpiarCreacion")
    btnLimpiar.removeAttribute("disabled")
    let provincia = document.getElementById("provinciaCreacion")
    provincia.removeAttribute("disabled")
    let sede = document.getElementById("sedeCreacion")
    sede.removeAttribute("disabled")
    let casas = document.getElementById("casasCreacion")
    casas.removeAttribute("disabled")
}
function bloquearFormularioEdicion() {
    let btnLimpiar = document.getElementById("btnLimpiarEdicion")
    btnLimpiar.setAttribute("disabled", true)
    let provincia = document.getElementById("provincia")
    provincia.setAttribute("disabled", true)
    let sede = document.getElementById("sede")
    sede.setAttribute("disabled", true)
    let casas = document.getElementById("casas")
    casas.setAttribute("disabled", true)
}
function desbloquearFormularioEdicion() {
    let btnLimpiar = document.getElementById("btnLimpiarEdicion")
    btnLimpiar.removeAttribute("disabled")
    let provincia = document.getElementById("provincia")
    provincia.removeAttribute("disabled")
    let sede = document.getElementById("sede")
    sede.removeAttribute("disabled")
    let casas = document.getElementById("casas")
    casas.removeAttribute("disabled")
}

function limpiarValidaciones(accion) {
    if(accion == "crear") {
        document.getElementById("mensajeErrorCrear").classList.add("hide")
    } else {
        document.getElementById("mensajeErrorEditar").classList.add("hide")
    }
}

</script>