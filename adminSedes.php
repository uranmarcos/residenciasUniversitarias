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
                
                <!-- CREACION DE SEDE -->
                <div class="bloque hide" id="boxCrearSede">
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
                <!-- END CREACION DE SEDE -->
                
                    
                <!-- EDICION DE SEDE -->
                <div class="bloque hide" id="boxEditarSede">
                
                        <form name="formEdicion" method="POST" action="adminSedes.php">
                            <!-- BOX EDICION SEDE -->
                            <div class="contenedorSeccion contenedorModal mb-4" id="boxEditarSede">
                                <div class="d-flex anchoTotal justify-content-between">
                                    <div class="subtitle mb-2">
                                        Editar Sede
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class=" hide columna">
                                        <label >#</label>
                                        <input type="text" style="width:100%" readonly class="centrarTexto" name="idSedePorEditar" id="idSedePorEditar">
                                    </div>
                                    <div class="col-12 col-md-5 columna">
                                        <label >Provincia</label>
                                        <select id="selectEdicionProvincia" name="selectEdicionProvincia" onchange="validarFormEdicion()" style="width:100%; height:30px">
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
                                        <label> Ciudad: </label>
                                        <input maxlength="30" autocomplete="off" style="width:100%" name="inputEditarSede" onkeyup="validarFormEdicion(), validarSedeExistente('mensajeErrorEditar', value)" id="inputEditarSede">
                                        <div class="hide errorValidacion" id="mensajeErrorEditar"></div>
                                        <div class="hide errorValidacion" id="mensajeValidacionEditar">5 o mas caracteres</div>
                                    </div>
                                    <div class="col-12 col-md-2 columna">
                                        <label> Casas: </label>
                                        <select id="selectEditarCasas" style="width:100%; height:30px" name="selectEditarCasas" onchange="validarFormEdicion()" style="width:100px">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option> 
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex align-items-end justify-content-around mt-5">
                                        <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxEditarSede')" class="btn botonCancelar">Cancelar</button>
                                        <button type="button" name="botonEditarSede" onclick="enviarDatosEdicion('selectEdicionProvincia', 'inputEditarSede', 'selectEditarCasas')" disabled id="botonEditar" class="btn boton" data-bs-toggle="modal" data-bs-target="#modalEdicionSede">
                                            Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL CONFIRMACION EDICION SEDE -->
                            <div class="modal fade" id="modalEdicionSede" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body centrarTexto">
                                            ¿Confirma los cambios: <b><span id="spanEdicionSede"></span></b>?
                                        </div>
                                        <div class="modal-footer d-flex justify-content-around">
                                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="editarSede" id="confirmarEditarSede" onclick="mostrarSpinner('confirmarEditarSede','spinnerEditarSede' )" class="btn boton">Confirmar</button>
                                            <button type="button" class="btnReenviarCircle hide" id="spinnerEditarSede" >
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
                <!-- END EDICION DE SEDE -->

                <!-- BOX LISTADO SEDES -->
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
                                <button type="submit" name="botonNuevaSede" onclick="mostrarCaja('boxCrearSede', 'boxEditarSede', 'botonNuevaSede')" id="botonNuevaSede" class="btn boton">Nueva Sede</button>        
                            </div>
                        </div>
                        <!-- TABLA CON LISTA DE SEDES -->
                        <div class="table-responsive">
                            <table class="table <?php echo $hayDatos ?>">
                                <thead>
                                    <tr>
                                        <th scope="col" class="hide">#</th>
                                        <th scope="col" style="width:40%">Provincia</th>
                                        <th scope="col" style="width:35%">Localidad</th>
                                        <th scope="col" style="width:10%; text-align:center">Casas</th>
                                        <th scope="col" style="width:10%"></th>
                                        <th scope="col" style="width:10%"></th>
                                    </tr>
                                </thead>
                                <form name="form2" method="POST" action="adminSedes.php">
                                <tbody>
                                    <?php foreach($sedes as $sede){ ?>
                                        <tr>
                                            <td class="hide"><?php echo $sede["id"] ?></td>
                                            <td><?php echo $sede["provincia"] ?></td>
                                            <td><?php echo $sede["descripcion"] ?></td>
                                            <td style="text-align: center"><?php echo $sede["casas"] ?></td>
                                            <td class="d-flex justify-content-end"> 
                                                <div name="trashButton<?php echo $sede['id']?>" id="trashButton<?php echo $sede['id']?>" class="trashButton" onclick="eliminarSedes(<?php echo $sede['id']?>, '<?php echo $sede['provincia'] . ', ' .$sede['descripcion'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="editButton" onclick="mostrarCaja('boxEditarSede', 'boxCrearSede', 'botonNuevaSede'), cargarDatosEdicion('<?php echo $sede['id']?>', '<?php echo $sede['provincia']?>', '<?php echo $sede['descripcion']?>', '<?php echo $sede['casas']?>')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg> 
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
                    <!-- MODAL CONFIRMACION ELIMINACION SEDE -->
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
                        </form>
                    </div>
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

function validarSedeExistente(idBox, value){
    let boxMensaje = document.getElementById(idBox)
    let sedes = <?php echo json_encode($sedes) ?>;
    if(value.length >=5) {
        let sedesExistentes = sedes.filter(element => element.descripcion.toLowerCase().includes(value.toLowerCase()))
        let descripcionesSedesExistentes = ""
        sedesExistentes.forEach(function callback(value, index) {
            descripcionesSedesExistentes = descripcionesSedesExistentes + value.descripcion + " "
        })
        if(sedesExistentes.length > 0) {
            console.log("hey")
            boxMensaje.classList.remove("hide")
            boxMensaje.innerHTML = "Ya existen las siguientes sedes: " + descripcionesSedesExistentes
        }else{
            boxMensaje.classList.add("hide")
        }
    } else {
        boxMensaje.classList.remove("hide")
        boxMensaje.innerHTML = "Minimo 5 caracteres"
    }
}

</script>