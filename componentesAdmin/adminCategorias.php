<?php
    $alertError = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    $idUsuarioLogueado = $_SESSION["id"];
    $mensajeAlertError="";
    // ACCION CREAR CATEGORIA
    if(isset($_POST["confirmarCategoria"])){
        $categoria = $_POST['inputNuevaCategoria'];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $insertCategoria = $baseDeDatos ->prepare("INSERT into categorias VALUES(default, '$categoria', 1, '$date', '$date', '$idUsuarioLogueado')");
        try{
            $insertCategoria->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La categoria se creó correctamente";
        } catch (\Throwable $th) {
            $alertError= "show";
            $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
        }
    }
    // ACCION EDITAR CATEGORIA
    if (isset($_POST["editarCategoria"])){
        $id = $_POST["idCategoriaPorEditar"];
        $descripcion = $_POST["inputEditarCategoria"];
        $habilitado = $_POST["selectEditarCategoria"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE categorias SET habilitado = '$habilitado', modified = '$date', descripcion = '$descripcion', idUser = '$idUsuarioLogueado' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La categoria se modificó correctamente";
        } catch (\Throwable $th) {
            $alertError= "show";
            $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
        }
    }
    // ACCION ELIMINAR CATEGORIA
    if(isset($_POST["eliminarCategoria"])){
        $id = $_POST["inputCategoriaEliminar"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consultaValidacion = $baseDeDatos -> prepare("SELECT count(*) from articulos WHERE categoria = '$id'");
        $consulta = $baseDeDatos ->prepare("UPDATE categorias SET habilitado = 0, modified = '$date', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        
        try {
            $consultaValidacion->execute();
            $validacion = $consultaValidacion -> fetchAll(PDO::FETCH_ASSOC);
            $cantidad = count($validacion);
            if($cantidad > 0 ){
                $alertError= "show";
                $mensajeAlertError = "La categoria no puede eliminarse ya que existen articulos pertenecientes a la misma. <br> Modifique primero los articulos y luego elimine la categoria.";
            } else {
                try {
                    $consulta->execute();
                    $alertConfirmacion = "show";
                    $mensajeAlertConfirmacion="La categoria se eliminó correctamente";
                } catch (\Throwable $th) {
                    $alertError= "show";
                    $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
                }
            }
        } catch (\Throwable $th) {
            $alertError= "show";
            $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
        }
    }
    // CONSULTA LISTADO DE CATEGORIAS
    $consultaCategorias = $baseDeDatos ->prepare("SELECT * FROM categorias");
    try {
        $consultaCategorias->execute();
    } catch (\Throwable $th) {
        $alertError= "show";
        $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
    }
    $categorias = $consultaCategorias -> fetchAll(PDO::FETCH_ASSOC);
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($categorias) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }
?>
    <div class="sectionBloque">
        <div class="alert alert-danger centrarTexto <?php echo $alertError ?>" id="alertError" role="alert" >
            <?php echo $mensajeAlertError ?>
        </div>
        <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
            <?php echo $mensajeAlertConfirmacion ?>
        </div>
        <!-- CREACION DE CATEGORIA -->
        <div>
            <form name="form1" method="POST" action="admin.php?adminCategorias=">
                <!-- BOX NUEVA CATEGORIA -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxCrearCategoria">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Nueva Categoria
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4 col-lg-1 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" autocomplete="off" name="inputNuevaCategoria" onkeyup="habilitarBoton(value, 3,'botonGenerar', 'mensajeValidacionCrear'), validarCategoriaExistente(value)" name="descripcion">
                            <div class="hide errorValidacion" id="mensajeValidacionCrear">3 o mas caracteres</div>
                            <div class="hide errorValidacion" id="mensajeCategoriaExistente"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-8 d-flex align-items-end justify-content-around mt-2 mt-md-0 mb-2 mb-sm-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxCrearCategoria', 'botonNuevaCategoria')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonGenerar" disabled id="botonGenerar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Generar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- MODAL CONFIRMACION CREACION CATEGORIA -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma la nueva categoria: <b><span id="spanCategoria"></span></b>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="confirmarCategoria" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- EDICION DE CATEGORIA -->
        <div>
            <form name="formEdicion" method="POST" action="admin.php?adminCategorias=">
                <!-- BOX EDICION CATEGORIA -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxEditarCategoria">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Editar categoria
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-2 col-sm-2 col-lg-1 columna">
                            <label> # </label>
                            <input type="text" style="width:100%" readonly class="centrarTexto" name="idCategoriaPorEditar" id="idCategoriaPorEditar">
                        </div>
                        <div class="col-10 col-sm-7 col-lg-6 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" name="inputEditarCategoria" onkeyup="habilitarBoton(value, 3, 'botonEditar', 'mensajeValidacionEditar')" id="inputEditarCategoria">
                        </div>
                        <div class="col-6 col-sm-3 col-lg-2 columna">
                            <label> Habilitar: </label>
                            <select name="selectEditarCategoria" style="height:30px" onchange="habilitarBotonDirecto('botonEditar')" id="selectEditarCategoria" >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="col-6 col-sm-12 col-lg-3 d-flex align-items-end justify-content-around mt-2 mt-l-0 mb-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxEditarCategoria')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonEditarCategoria" onclick="enviarDatosEdicion('inputEditarCategoria', 'selectEditarCategoria')" disabled id="botonEditar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#modalEdicionCategoria">
                                Editar
                            </button>
                        </div>
                    </div>
                    <div class="hide errorValidacion marginl100" id="mensajeValidacionEditar">3 o mas caracteres</div>
                </div>
                <!-- MODAL CONFIRMACION EDICION CATEGORIA -->
                <div class="modal fade" id="modalEdicionCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma los cambios: <b><span id="spanEdicionCategoria"></span></b>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="editarCategoria" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
            <!-- BOX LISTADO CATEGORIAS -->
            <div class="contenedorSeccion contenedorModal">
                <div class="d-flex anchoTotal row">
                    <div class="subtitle col-6">
                        Categorias Disponibles
                    </div>
                    <div class="col-6 d-flex align-items-end justify-content-end">
                        <button type="submit" name="botonNuevaCategoria" onclick="mostrarCaja('boxCrearCategoria', 'boxEditarCategoria', 'botonNuevaCategoria')" id="botonNuevaCategoria" class="btn botonConfirmar col-6 col-md-3">Nueva</button>        
                    </div>
                </div>
                <!-- TABLA CON LISTA DE CATEGORIAS -->
                <div class="table-responsive">
                    <table class="table <?php echo $hayDatos ?>">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="width:70%">Descripción</th>
                                <th scope="col" style="width:10%">Habilitado</th>
                                <th scope="col" style="width:10%"></th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <form name="form2" method="POST" action="admin.php?adminCategorias=">
                        <tbody>
                            <?php foreach($categorias as $categoria){ ?>
                                <tr>
                                    <td><?php echo $categoria["id"] ?></td>
                                    <td><?php echo $categoria["descripcion"] ?></td>
                                    <td style="text-align: center"><?php echo $categoria["habilitado"] == 1 ? 'Sí' : 'No' ?></td>
                                    <td class="d-flex justify-content-end"> 
                                        <button type="button" onmouseover="deshabilitarBotonTrash(<?php echo $categoria['id']?>, <?php echo $categoria['habilitado']?>)" name="trashButton<?php echo $categoria['id']?>" id="trashButton<?php echo $categoria['id']?>" class="btn trashButton" onclick="eliminarCategorias(<?php echo $categoria['id']?>, '<?php echo $categoria['descripcion'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn editButton" onclick="mostrarCaja('boxEditarCategoria', 'boxCrearCategoria', 'botonNuevaCategoria'), cargarDatosEdicion('<?php echo $categoria['id']?>', '<?php echo $categoria['descripcion']?>', <?php echo $categoria['habilitado']?>)">
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
            <!-- MODAL CONFIRMACION ELIMINACION CATEGORIA -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" hidden name="inputCategoriaEliminar" id="inputCategoriaEliminar"></input>
                            <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma que desea eliminar la categoria <b><span id="categoriaAEliminar"></span></b>?</br> Si desea habilitarla nuevamente, en la opción editar podrá hacerlo.
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="eliminarCategoria" class="btn botonConfirmar">Confirmar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
    </div>
<script>
    function validarCategoriaExistente(value){
        let boxMensajeCategoriaExistente = document.getElementById("mensajeCategoriaExistente")
        let categorias = <?php  echo json_encode($categorias) ?>;
        if(value.length >=3) {
            let categoriasExistentes = categorias.filter(element => element.descripcion.toLowerCase().includes(value))
            let descripcionesCategoriasExistentes = ""
            categoriasExistentes.forEach(function callback(value, index) {
                descripcionesCategoriasExistentes = descripcionesCategoriasExistentes + value.descripcion + " "
            })
            if(categoriasExistentes.length > 0) {
                boxMensajeCategoriaExistente.classList.remove("hide")
                boxMensajeCategoriaExistente.innerHTML = "Ya existen la/s siguiente/s categoria/s : " + descripcionesCategoriasExistentes
            }else{
                boxMensajeCategoriaExistente.classList.add("hide")
            }
        } else {
            boxMensajeCategoriaExistente.classList.add("hide")
        }
    }
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
        let spanCategoria = document.getElementById("spanCategoria")
        if(value.length >= length) {
            boton.removeAttribute("disabled");
            mensajeValidacion.classList.add('hide')
            spanCategoria.innerHTML = value
        }else{
            boton.setAttribute("disabled", true)
            mensajeValidacion.classList.remove('hide')
        }
    }
    function eliminarCategorias(id, descripcion) {
        document.getElementById("categoriaAEliminar").innerHTML = " - " + descripcion + " - "
        document.getElementById("inputCategoriaEliminar").value = id
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
    function cargarDatosEdicion(id, descripcion, habilitado){
        document.getElementById("idCategoriaPorEditar").value = id
        document.getElementById("inputEditarCategoria").value = descripcion
        document.getElementById("selectEditarCategoria").value = habilitado
    }
    function enviarDatosEdicion(idInput, idSelect) {
        let input = document.getElementById(idInput).value
        let select = document.getElementById(idSelect).value
        let spanEdicionCategoria = document.getElementById("spanEdicionCategoria")
        spanEdicionCategoria.innerHTML = input + " - " + (select == 0 ? "Eliminado" : "Habilitado")     
    }
    window.onload = function(){
        let alertConfirmacion = document.getElementById("alertConfirmacion")
        if (alertConfirmacion.classList.contains('show')) {
            setTimeout(ocultarAlertConfirmacion, 5000)
        }
        let alertError = document.getElementById("alertError")
        if (alertError.classList.contains('show')) {
            setTimeout(ocultarAlertError, 5000)
        }
    }
    function ocultarAlertConfirmacion(){
        let alertConfirmacion = document.getElementById("alertConfirmacion")
        alertConfirmacion.classList.remove('show')
        alertConfirmacion.classList.add('hide')
    }
    function ocultarAlertError(){
        let alertError = document.getElementById("alertError")
        alertError.classList.remove('show')
        alertError.classList.add('hide')
    }
</script>