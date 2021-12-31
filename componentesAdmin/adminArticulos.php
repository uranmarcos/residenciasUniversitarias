<?php
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    // // ACCION CREAR SEDE
    if(isset($_POST["crearArticulo"])){
        $descripcion = $_POST['descripcionNuevoArticulo'];
        $categoria = $_POST['categoriaNuevoArticulo'];
        $medida = $_POST['medidaNuevoArticulo'];
        $date = date("Y-m-d h:i:s");
        $insertArticulo = $baseDeDatos ->prepare("INSERT into articulos VALUES(default, '$descripcion', '$medida', '$categoria', 1, '$date', '$date', 17)");
        try{
            $insertArticulo->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El articulo se creó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }

    // // ACCION EDITAR SEDE
    // if (isset($_POST["editarSede"])){
    //     $id = $_POST["idSedePorEditar"];
    //     $descripcion = $_POST["descripcionNuevoArticulo"];
    //     $habilitado = $_POST["selectEditarHabilitado"];
    //     $casas = $_POST["selectEditarCasas"];
    //     $date = date("Y-m-d h:i:s");
    //     $consulta = $baseDeDatos ->prepare("UPDATE sedes SET habilitado = '$habilitado', modified = '$date', descripcion = '$descripcion', casas = '$casas' WHERE id = '$id'");
    //     try {
    //         $consulta->execute();
    //         $alertConfirmacion = "show";
    //         $mensajeAlertConfirmacion="La sede se modificó correctamente";
    //     } catch (\Throwable $th) {
    //         $alertErrorConexion= "show";
    //     }
    // }

    // ACCION ELIMINAR ARTICULO
    if(isset($_POST["eliminarArticulo"])){
        $id = $_POST["idArticuloEliminar"];
        $date = date("Y-m-d h:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE articulos SET habilitado = 0, modified = '$date' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El artículo se eliminó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
        }
    }

    // CONSULTAS INICIALES LISTADO DE ARTICULOS, MEDIDAS Y CATEGORIAS
    $consultaArticulos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, C.descripcion 'categoria', M.descripcion 'medida', A.habilitado FROM articulos A INNER JOIN categorias C ON A.categoria = C.id INNER JOIN medidas M ON A.medida = M.id");
    $consultaMedidas = $baseDeDatos ->prepare("SELECT * FROM medidas");
    $consultaCategorias = $baseDeDatos ->prepare("SELECT * FROM categorias WHERE habilitado = 1");
    
    try {
        $consultaArticulos->execute();
        $consultaMedidas->execute();
        $consultaCategorias->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
    }
    $articulos = $consultaArticulos -> fetchAll(PDO::FETCH_ASSOC);
    $medidas = $consultaMedidas -> fetchAll(PDO::FETCH_ASSOC);
    $categorias = $consultaCategorias -> fetchAll(PDO::FETCH_ASSOC);
    
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($articulos) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }


?>
    <div class="sectionBloque">
        <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" role="alert" >
            Hubo un error de conexión. Por favor actualizá la página
        </div>
        <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" role="alert">
            <?php echo $mensajeAlertConfirmacion ?>
        </div>
        <!-- CREACION DE ARTICULO -->
        <div>
            <form name="form1" method="POST" action="admin2.php?adminArticulos=">
                <!-- BOX NUEVO ARTICULO -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxCrearArticulo">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Nuevo Articulo
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" name="descripcionNuevoArticulo" onkeyup="habilitarBoton(value, 3, 'botonGenerar', 'mensajeValidacionCrear')" id="descripcionNuevoArticulo">
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 columna">
                            <label class="labelForm"> Medida: </label>
                            <select id="medidaNuevoArticulo"  name="medidaNuevoArticulo" onchange="actualizarDatosModalCrear(value)" style="width:150px; height:30px">
                            <?php foreach($medidas as $medida){ ?>
                                    <option value="<?php echo $medida['id']?>"><?php echo $medida['descripcion']?></option>
                                <?php } ?> 
                            </select>   
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 columna">
                            <label class="labelForm"> Categoria: </label>
                            <select id="categoriaNuevoArticulo" name="categoriaNuevoArticulo" onchange="actualizarDatosModalCrear()" style="width:150px; height:30px">
                                <?php foreach($categorias as $categoria){ ?>
                                    <option value="<?php echo $categoria['id']?>"><?php echo $categoria['descripcion']?></option>
                                <?php } ?>  
                            </select>   
                        </div>
                        <div class="col-12  col-sm-4 col-md-3 d-flex align-items-end justify-content-around mt-2 mt-md-0 mb-2 pb-md-1 mb-md-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxCrearArticulo', 'botonNuevoArticulo')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonGenerar" disabled id="botonGenerar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Generar
                            </button>
                        </div>
                    </div>
                    <div class="hide errorValidacion marginl100" id="mensajeValidacionCrear">3 o mas caracteres</div>
                </div>
                <!-- MODAL CONFIRMACION CREACION ARTICULO -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma el articulo: <b><span id="spanArticulo"></span></b>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="crearArticulo" class="btn botonConfirmar">Confirmar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- EDICION DE ARTICULO -->
        <div>
            <form name="formEdicion" method="POST" action="admin2.php?adminArticulos=">
                <!-- BOX EDICION ARTICULO -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxEditarSede">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Editar Sede
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-1 columna">
                            <label >#</label>
                            <input type="text" style="max-width:50px" readonly class="centrarTexto" name="idSedePorEditar" id="idSedePorEditar">
                        </div>
                        <div class="col-9 col-sm-10 col-md-6 col-lg-4 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" name="descripcionNuevoArticulo" onkeyup="habilitarBoton(value, 3, 'botonEditar', 'mensajeValidacionEditar')" id="descripcionNuevoArticulo">
                        </div>
                        <div class="col-4 col-sm-2 col-md-2 col-lg-1 columna">
                            <label> Casas: </label>
                            <select id="selectEditarCasas" style="max-width:50px; height:30px" name="selectEditarCasas" onchange="habilitarBotonDirecto('botonEditar')" style="width:100px">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option> 
                            </select>
                        </div>
                        <div class="col-4 col-sm-8 col-md-2 col-lg-2 columna">
                            <label> Habilitar: </label>
                            <select name="selectEditarHabilitado"  style="height:30px" onchange="habilitarBotonDirecto('botonEditar')" id="selectEditarHabilitado" >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="col-4 col-sm-12 col-lg-4 d-flex align-items-end justify-content-around mt-2 mt-l-0 pb-2 mb-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxEditarSede')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonEditarSede" onclick="enviarDatosEdicion('descripcionNuevoArticulo', 'selectEditarHabilitado', 'selectEditarCasas')" disabled id="botonEditar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#modalEdicionCategoria">
                                Editar
                            </button>
                        </div>
                    </div>
                    <div class="hide errorValidacion marginl100" id="mensajeValidacionEditar">3 o mas caracteres</div>
                </div>
                <!-- MODAL CONFIRMACION EDICION SEDE -->
                <div class="modal fade" id="modalEdicionCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
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
        
            <!-- BOX LISTADO ARTICULOS -->
            <div class="contenedorSeccion contenedorModal">
                <div class="d-flex anchoTotal row">
                    <div class="subtitle col-6">
                        Articulos Disponibles
                    </div>
                    <div class="col-6 d-flex align-items-end justify-content-end">
                        <button type="submit" name="botonNuevoArticulo" onclick="mostrarCaja('boxCrearArticulo', 'botonNuevoArticulo')" id="botonNuevoArticulo" class="btn botonConfirmar col-6 col-md-3">Nuevo</button>        
                    </div>
                </div>
                <!-- TABLA CON LISTA DE ARTICULOS -->
                <div class="table-responsive">
                    <table class="table <?php echo $hayDatos ?>">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="width:50%">Descripcion</th>
                                <th scope="col" style="width:10%; text-align:center">Medida</th>
                                <th scope="col" style="width:10%; text-align:center">Categoria</th>
                                <th scope="col" style="width:10%">Habilitado</th>
                                <th scope="col" style="width:10%"></th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <form name="form2" method="POST" action="admin2.php?adminArticulos=">
                        <tbody>
                            <?php foreach($articulos as $articulo){ ?>
                                <tr>
                                    <td><?php echo $articulo["id"] ?></td>
                                    <td><?php echo $articulo["descripcion"] ?></td>
                                    <td style="text-align: center"><?php echo $articulo["medida"] ?></td>
                                    <td style="text-align: center"><?php echo $articulo["categoria"] ?></td>
                                    <td style="text-align: center"><?php echo $articulo["habilitado"] == 1 ? 'Sí' : 'No' ?></td>
                                    <td class="d-flex justify-content-end"> 
                                        <button type="button" onmouseover="deshabilitarBotonTrash(<?php echo $articulo['id']?>, <?php echo $articulo['habilitado']?>)" name="trashButton<?php echo $articulo['id']?>" id="trashButton<?php echo $articulo['id']?>" class="btn trashButton" onclick="eliminarArticulos(<?php echo $articulo['id']?>, '<?php echo $articulo['descripcion'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn editButton" onclick="mostrarCaja('boxEditarSede'), cargarDatosEdicion('<?php echo $articulo['id']?>', '<?php echo $articulo['descripcion']?>', '<?php echo $articulo['casas']?>', <?php echo $articulo['habilitado']?>)">
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" hidden name="idArticuloEliminar" id="idArticuloEliminar"></input>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma que desea eliminar el articulo <b><span id="articuloAEliminar"></span></b>?</br> Si desea habilitarlo nuevamente, en la opción editar podrá hacerlo.
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="eliminarArticulo" class="btn botonConfirmar">Confirmar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
    </div>

<script type="text/javascript">
    let categoriaEliminable = null
    function mostrarCaja(idCaja, idBoton=null) {
        let box = document.getElementById(idCaja)
        box.classList.remove("hide")
        if (idBoton != null) {
            let boton = document.getElementById(idBoton)
            boton.classList.add("hide")
        }
    }
    function ocultarCaja(idCaja, idBoton=null) {
        let box = document.getElementById(idCaja)
        box.classList.add("hide")
        if (idBoton != null) {
            let boton = document.getElementById(idBoton)
            boton.classList.remove("hide")
        }
    }
    // FUNCION PARA HABILITAR UN BOTON EN BASE A VALIDACION DE INPUT - PARAMETROS: VALUE, LENGTH, IDBOTON A HABILITAR 
    function habilitarBoton(value, length, id, idMensajeValidacion) {
        let boton = document.getElementById(id)
        let mensajeValidacion = document.getElementById(idMensajeValidacion)
        let spanArticulo = document.getElementById("spanArticulo")
        let categoria = document.getElementById("categoriaNuevoArticulo")
        let categoriaSelected = categoria.options[categoria.selectedIndex].text;
        let medida = document.getElementById("medidaNuevoArticulo")
        let medidaSelected = medida.options[medida.selectedIndex].text;
        if(value.length >= length) {
            boton.removeAttribute("disabled");
            mensajeValidacion.classList.add('hide')
            spanArticulo.innerHTML = value + " en " + medidaSelected + " para " + categoriaSelected 
        }else{
            let spanArticulo = document.getElementById("spanArticulo")
            boton.setAttribute("disabled", true)
            mensajeValidacion.classList.remove('hide')
        }
    }
    //ACTUALIZACION DE DATOS EN MODAL CONFIRMACION DE CREACION DE SEDE, AL CAMBIAR CANTIDAD DE CASAS
    function actualizarDatosModalCrear(){
        let descripcion = document.getElementById("descripcionNuevoArticulo").value
        let categoria = document.getElementById("categoriaNuevoArticulo")
        let categoriaSelected = categoria.options[categoria.selectedIndex].text;
        let medida = document.getElementById("medidaNuevoArticulo")
        let medidaSelected = medida.options[medida.selectedIndex].text;
        let spanArticulo = document.getElementById("spanArticulo")
        if (descripcion != "") {
            spanArticulo.innerHTML = descripcion + " en " + medidaSelected + " para " + categoriaSelected 
        } 
    }
    function eliminarArticulos(id, descripcion) {
        let articuloAEliminar = document.getElementById("articuloAEliminar")
        articuloAEliminar.innerHTML = " - " + descripcion + " - "
        let idArticuloEliminar = document.getElementById("idArticuloEliminar")
        idArticuloEliminar.value = id
    }
    function deshabilitarBotonTrash (id, habilitado) {
        let boton = document.getElementById("trashButton"+id)
        if (habilitado == 0){
            boton.setAttribute("disabled", true)    
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
        let idSedePorEditar = document.getElementById("idSedePorEditar")
        let selectEditarHabilitado = document.getElementById("selectEditarHabilitado")
        let descripcionNuevoArticulo = document.getElementById("descripcionNuevoArticulo")
        let selectEditarCasas = document.getElementById("selectEditarCasas")
        idSedePorEditar.value = id
        descripcionNuevoArticulo.value = descripcion
        selectEditarHabilitado.value = habilitado
        selectEditarCasas.value = casas
    }
    // CARGA LOS DATOS NUEVOS DE LA SEDE EN EL MODAL PIDIENDO CONFIRMACION
    function enviarDatosEdicion(descripcion, habilitado, casas) {
        let descripcionSede = document.getElementById(descripcion).value
        let habilitadoSede = document.getElementById(habilitado).value
        let casasSede = document.getElementById(casas).value
        let spanEdicionSede = document.getElementById("spanEdicionSede")
        spanEdicionSede.innerHTML = descripcionSede + " - " + (habilitadoSede == 0 ? "Eliminado" : "Habilitado") + " - " +  (casasSede == 1 ? " 1 casa" : casasSede + " casas")
    
}
</script>