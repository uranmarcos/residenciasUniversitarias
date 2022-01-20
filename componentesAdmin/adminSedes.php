<?php
   
    $idUsuarioLogueado = $_SESSION["id"];
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    // // ACCION CREAR SEDE
    if(isset($_POST["crearSede"])){
        $descripcion = $_POST['inputNuevaSede'];
        $casas = $_POST['selectCasas'];
        $date = date("Y-m-d h:i:s");
        $insertSede = $baseDeDatos ->prepare("INSERT into sedes VALUES(default, '$descripcion','$casas', 1, '$date', '$date', '$idUsuarioLogueado)");
        try{
            $insertSede->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La sede se creó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }
    // // ACCION EDITAR SEDE
    if (isset($_POST["editarSede"])){
        $id = $_POST["idSedePorEditar"];
        $descripcion = $_POST["inputEditarSede"];
        $habilitado = $_POST["selectEditarHabilitado"];
        $casas = $_POST["selectEditarCasas"];
        $date = date("Y-m-d h:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE sedes SET habilitado = '$habilitado', modified = '$date', descripcion = '$descripcion', casas = '$casas', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La sede se modificó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }
    // ACCION ELIMINAR SEDE
    if(isset($_POST["eliminarSede"])){
        $id = $_POST["idSedeEliminar"];
        $date = date("Y-m-d h:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE sedes SET habilitado = 0, modified = '$date', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La sede se eliminó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }
    // CONSULTA LISTADO DE SEDES
    $consultaSedes = $baseDeDatos ->prepare("SELECT * FROM sedes");
    try {
        $consultaSedes->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $sedes = $consultaSedes -> fetchAll(PDO::FETCH_ASSOC);
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($sedes) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }


?>
    <div class="sectionBloque">
        <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
            Hubo un error de conexión. Por favor actualizá la página
        </div>
        <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
            <?php echo $mensajeAlertConfirmacion ?>
        </div>
        <!-- CREACION DE SEDE -->
        <div>
            <form name="form1" method="POST" action="admin.php?adminSedes=">
                <!-- BOX NUEVA SEDE -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxCrearSede">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Nueva Sede
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-9 col-md-6 col-lg-6 columna">
                            <label >Descripcion</label>
                            <input maxlength="30" style="width:100%" autocomplete="off" name="inputNuevaSede" id="inputNuevaSede" onkeyup="habilitarBoton(value, 5,'botonGenerar', 'mensajeValidacionCrear')">
                        </div>
                        <div class="col-12 col-sm-3 col-md-2 col-lg-1 columna">
                            <label> Casas: </label>
                            <select id="selectCasas" name="selectCasas" onchange="actualizarDatosModalCrear(value)" style="width:100%; height:30px">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option> 
                            </select>   
                        </div>
                        <div class="col-12 col-md-4 col-lg-5 d-flex align-items-end justify-content-around mt-2 mt-md-0 mb-2 mb-md-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxCrearSede', 'botonNuevaSede')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonGenerar" disabled id="botonGenerar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Generar
                            </button>
                        </div>
                    </div>
                    <div class="hide errorValidacion marginl100" id="mensajeValidacionCrear">5 o mas caracteres</div>
                </div>
                <!-- MODAL CONFIRMACION CREACION SEDE -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma la nueva sede: <b><span id="spanSede"></span></b>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="crearSede" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- EDICION DE SEDE -->
        <div>
            <form name="formEdicion" method="POST" action="admin.php?adminSedes=">
                <!-- BOX EDICION SEDE -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxEditarSede">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Editar Sede
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-2 col-md-1  col-lg-1 columna">
                            <label >#</label>
                            <input type="text" style="width:100%" readonly class="centrarTexto" name="idSedePorEditar" id="idSedePorEditar">
                        </div>
                        <div class="col-10 col-md-7 col-lg-4 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" name="inputEditarSede" onkeyup="habilitarBoton(value, 3, 'botonEditar', 'mensajeValidacionEditar')" id="inputEditarSede">
                        </div>
                        <div class="col-6 col-sm-2 col-md-2 col-lg-1 columna">
                            <label> Casas: </label>
                            <select id="selectEditarCasas" style="width:100%; height:30px" name="selectEditarCasas" onchange="habilitarBotonDirecto('botonEditar')" style="width:100px">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option> 
                            </select>
                        </div>
                        <div class="col-6 col-sm-2 col-md-2 col-lg-2 columna">
                            <label> Habilitar: </label>
                            <select name="selectEditarHabilitado"  style="width:100%; height:30px" onchange="habilitarBotonDirecto('botonEditar')" id="selectEditarHabilitado" >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-8 col-md-12 col-lg-4 d-flex align-items-end justify-content-around mt-2  mb-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxEditarSede')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonEditarSede" onclick="enviarDatosEdicion('inputEditarSede', 'selectEditarHabilitado', 'selectEditarCasas')" disabled id="botonEditar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#modalEdicionSede">
                                Editar
                            </button>
                        </div>
                    </div>
                    <div class="hide errorValidacion marginl100" id="mensajeValidacionEditar">3 o mas caracteres</div>
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
                            <button type="submit" name="editarSede" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
            <!-- BOX LISTADO SEDES -->
            <div class="contenedorSeccion contenedorModal">
                <div class="d-flex anchoTotal row">
                    <div class="subtitle col-6">
                        Sedes Disponibles
                    </div>
                    <div class="col-6 d-flex align-items-end justify-content-end">
                        <button type="submit" name="botonNuevaSede" onclick="mostrarCaja('boxCrearSede', 'boxEditarSede', 'botonNuevaSede')" id="botonNuevaSede" class="btn botonConfirmar col-6 col-md-3">Nueva</button>        
                    </div>
                </div>
                <!-- TABLA CON LISTA DE SEDES -->
                <div class="table-responsive">
                    <table class="table <?php echo $hayDatos ?>">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="width:60%">Localidad</th>
                                <th scope="col" style="width:10%; text-align:center">Casas</th>
                                <th scope="col" style="width:10%">Habilitado</th>
                                <th scope="col" style="width:10%"></th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <form name="form2" method="POST" action="admin.php?adminSedes=">
                        <tbody>
                            <?php foreach($sedes as $sede){ ?>
                                <tr>
                                    <td><?php echo $sede["id"] ?></td>
                                    <td><?php echo $sede["descripcion"] ?></td>
                                    <td style="text-align: center"><?php echo $sede["casas"] ?></td>
                                    <td style="text-align: center"><?php echo $sede["habilitado"] == 1 ? 'Sí' : 'No' ?></td>
                                    <td class="d-flex justify-content-end"> 
                                        <button type="button" onmouseover="deshabilitarBotonTrash(<?php echo $sede['id']?>, <?php echo $sede['habilitado']?>)" name="trashButton<?php echo $sede['id']?>" id="trashButton<?php echo $sede['id']?>" class="btn trashButton" onclick="eliminarSedes(<?php echo $sede['id']?>, '<?php echo $sede['descripcion'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn editButton" onclick="mostrarCaja('boxEditarSede', 'boxCrearSede', 'botonNuevaSede'), cargarDatosEdicion('<?php echo $sede['id']?>', '<?php echo $sede['descripcion']?>', '<?php echo $sede['casas']?>', <?php echo $sede['habilitado']?>)">
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
                            ¿Confirma que desea eliminar la sede <b><span id="sedeAEliminar"></span></b>?</br> Si desea habilitarla nuevamente, en la opción editar podrá hacerlo.
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="eliminarSede" class="btn botonConfirmar">Confirmar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
    </div>
<script>
    function mostrarCaja(idCaja, idCajaOcultar, idBoton=null) {
        ocultarCaja(idCajaOcultar)
        document.getElementById(idCaja).classList.remove("hide")
        document.getElementById(idCaja).scrollIntoView();
        if (idBoton != null) {
            document.getElementById(idBoton).classList.add("hide")
        }
    }
    function ocultarCaja(idCaja, idBoton=null) {
        document.getElementById(idCaja).classList.add("hide")
        if (idBoton != null) {
            document.getElementById(idBoton).classList.remove("hide")
        }
    }
    // FUNCION PARA HABILITAR UN BOTON EN BASE A VALIDACION DE INPUT - PARAMETROS: VALUE, LENGTH, IDBOTON A HABILITAR 
    function habilitarBoton(value, length, id, idMensajeValidacion) {
        let boton = document.getElementById(id)
        let mensajeValidacion = document.getElementById(idMensajeValidacion)
        let spanSede = document.getElementById("spanSede")
        let casas = document.getElementById("selectCasas").value
        if(value.length >= length) {
            boton.removeAttribute("disabled");
            mensajeValidacion.classList.add('hide')
            spanSede.innerHTML = value + " con " + (casas == 1 ? "1 casa" : casas + " casas")
        }else{
            boton.setAttribute("disabled", true)
            mensajeValidacion.classList.remove('hide')
        }
    }
    //ACTUALIZACION DE DATOS EN MODAL CONFIRMACION DE CREACION DE SEDE, AL CAMBIAR CANTIDAD DE CASAS
    function actualizarDatosModalCrear(cantidad){
        let descripcion = document.getElementById("inputNuevaSede").value
        let spanSede = document.getElementById("spanSede")
        if (descripcion != "") {
            spanSede.innerHTML = descripcion + " con " + (cantidad == 1 ? "1 casa" : cantidad + " casas")
        } 
    }
    function eliminarSedes(id, descripcion) {
        document.getElementById("sedeAEliminar").innerHTML = " - " + descripcion + " - "
        document.getElementById("idSedeEliminar").value = id
    }
    function deshabilitarBotonTrash (id, habilitado) {
        if (habilitado == 0){
            document.getElementById("trashButton"+id).setAttribute("disabled", true)    
        }
    }
    function habilitarBotonDirecto (id) {
        let boton = document.getElementById(id)
        if (boton.hasAttribute("disabled")){
            boton.removeAttribute("disabled")    
        }
    }
    // CARGA LOS DATOS DE BASE DE LA SEDE EN EL BOX EDITABLE 
    function cargarDatosEdicion(id, descripcion, casas, habilitado){
        document.getElementById("idSedePorEditar").value = id
        document.getElementById("inputEditarSede").value = descripcion
        document.getElementById("selectEditarHabilitado").value = habilitado
        document.getElementById("selectEditarCasas").value = casas
    }
    // CARGA LOS DATOS NUEVOS DE LA SEDE EN EL MODAL PIDIENDO CONFIRMACION
    function enviarDatosEdicion(descripcion, habilitado, casas) {
        let descripcionSede = document.getElementById(descripcion).value
        let habilitadoSede = document.getElementById(habilitado).value
        let casasSede = document.getElementById(casas).value
        let spanEdicionSede = document.getElementById("spanEdicionSede")
        spanEdicionSede.innerHTML = descripcionSede + " - " + (habilitadoSede == 0 ? "Eliminado" : "Habilitado") + " - " +  (casasSede == 1 ? " 1 casa" : casasSede + " casas")
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
    function ocultarAlertConfirmacion(){
        let alertConfirmacion = document.getElementById("alertConfirmacion")
        alertConfirmacion.classList.remove('show')
        alertConfirmacion.classList.add('hide')
    }
    function ocultarAlertError(){
        let alertErrorConexion = document.getElementById("alertErrorConexion")
        alertErrorConexion.classList.remove('show')
        alertErrorConexion.classList.add('hide')
    }
</script>