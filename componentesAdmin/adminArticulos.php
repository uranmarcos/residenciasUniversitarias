<?php
?>
    <div class="sectionBloque">
        <div class="alert alert-danger centrarTexto <?php echo $alertErrorConexion ?>" id="alertErrorConexion" role="alert" >
            Hubo un error de conexión. Por favor actualizá la página
        </div>
        <div class="alert alert-success centrarTexto <?php echo $alertConfirmacion ?>" id="alertConfirmacion" role="alert">
            <?php echo $mensajeAlertConfirmacion ?>
        </div>
        <!-- CREACION DE ARTICULO -->
        <div>
            <form name="form1" method="POST" action="admin.php?adminArticulos=">
                <!-- BOX NUEVO ARTICULO -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxCrearArticulo">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Nuevo Articulo
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" name="descripcionNuevoArticulo" autocomplete="off" onkeyup="habilitarBoton(value, 3, 'botonGenerar', 'mensajeValidacionCrear'), validarArticuloExistente(value)" id="descripcionNuevoArticulo">
                            <div class="hide errorValidacion" id="mensajeValidacionCrear">3 o mas caracteres</div>
                            <div class="hide errorValidacion" id="mensajeArticuloExistente"></div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 columna">
                            <label class="labelForm"> Medida: </label>
                            <select id="medidaNuevoArticulo"  name="medidaNuevoArticulo" onchange="actualizarDatosModalCrear(value)" style="width:100%; height:30px">
                            <?php foreach($medidas as $medida){ ?>
                                    <option value="<?php echo $medida['id']?>"><?php echo $medida['descripcion']?></option>
                                <?php } ?> 
                            </select>   
                        </div>
                        <div class="col-6 col-sm-6 col-md-3  columna">
                            <label class="labelForm"> Categoria: </label>
                            <select id="categoriaNuevoArticulo" name="categoriaNuevoArticulo" onchange="actualizarDatosModalCrear()" style="width:100%; height:30px">
                                <?php foreach($categorias as $categoria){ ?>
                                    <option value="<?php echo $categoria['id']?>"><?php echo $categoria['descripcion']?></option>
                                <?php } ?>  
                            </select>   
                        </div>
                        <div class="col-12 col-lg-3 d-flex align-items-end justify-content-around mt-2 mt-md-2 mb-2 pb-md-1 mb-md-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxCrearArticulo', 'botonNuevoArticulo')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonGenerar" disabled id="botonGenerar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Generar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- MODAL CONFIRMACION CREACION ARTICULO -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
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
            <form name="formEdicion" method="POST" action="admin.php?adminArticulos=">
                <!-- BOX EDICION ARTICULO -->
                <div class="contenedorSeccion contenedorModal hide mb-4" id="boxEditarArticulo">
                    <div class="d-flex anchoTotal justify-content-between">
                        <div class="subtitle mb-2">
                            Editar Articulo
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-1 columna">
                            <label >#</label>
                            <input type="text" style="max-width:50px" readonly class="centrarTexto" name="idArticuloPorEditar" id="idArticuloPorEditar">
                        </div>
                        <div class="col-10 col-md-10 col-lg-3 columna">
                            <label> Descripción: </label>
                            <input maxlength="30" name="descripcionEditarArticulo" autocomplete="off" onkeyup="habilitarBoton(value, 3, 'botonEditar', 'mensajeValidacionEditar')" id="descripcionEditarArticulo">
                        </div>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2 columna">
                            <label class="labelForm"> Medida: </label>
                            <select id="medidaEditarArticulo"  name="medidaEditarArticulo" onchange="habilitarBotonDirecto('botonEditar')" style="width:100%; height:30px">
                            <?php foreach($medidas as $medida){ ?>
                                    <option value="<?php echo $medida['id']?>"><?php echo $medida['descripcion']?></option>
                                <?php } ?> 
                            </select>   
                        </div>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2 columna">
                            <label class="labelForm"> Categoria: </label>
                            <select id="categoriaEditarArticulo" name="categoriaEditarArticulo" onchange="habilitarBotonDirecto('botonEditar')" style="width:100%; height:30px">
                                <?php foreach($categorias as $categoria){ ?>
                                    <option value="<?php echo $categoria['id']?>"><?php echo $categoria['descripcion']?></option>
                                <?php } ?>  
                            </select>   
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-1 columna">
                            <label> Habilitar: </label>
                            <select name="habilitadoEditarArticulo"  style="height:30px" onchange="habilitarBotonDirecto('botonEditar')" id="habilitadoEditarArticulo" >
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="col-8 col-sm-12 col-lg-3 d-flex align-items-end justify-content-around mt-2 mt-l-0  mb-0">
                            <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxEditarArticulo')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                            <button type="button" name="botonEditarArticulo" onclick="enviarDatosEdicion('descripcionEditarArticulo', 'medidaEditarArticulo', 'categoriaEditarArticulo', 'habilitadoEditarArticulo')" disabled id="botonEditar" class="btn botonConfirmar col-6 col-md-3" data-bs-toggle="modal" data-bs-target="#modalEdicionArticulo">
                                Editar
                            </button>
                        </div>
                    </div>
                    <div class="hide errorValidacion marginl100" id="mensajeValidacionEditar">3 o mas caracteres</div>
                </div>
                <!-- MODAL CONFIRMACION EDICION ARTICULO -->
                <div class="modal fade" id="modalEdicionArticulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body centrarTexto">
                            ¿Confirma los cambios: <b><span id="spanEdicionArticulo"></span></b>?
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn botonCancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="editarArticulo" class="btn botonConfirmar">Confirmar</button>
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
                    <button type="submit" name="botonNuevoArticulo" onclick="mostrarCaja('boxCrearArticulo', 'boxEditarArticulo', 'botonNuevoArticulo')" id="botonNuevoArticulo" class="btn botonConfirmar col-6 col-md-3">Nuevo</button>        
                </div>
            </div>
            <form name="form2" method="POST" action="admin.php?adminArticulos=">
                <!-- TABLA CON LISTA DE ARTICULOS -->
                <div class="table-responsive">
                    <table class="table <?php echo $hayDatos ?>">
                        <div class="row bg-grey d-flex align-items-center p-0 mt-2 mb-2 justify-content-around" style="width:100%">
                            <div class="col-11 col-sm-5 col-md-4">
                                <div class="row rowFiltro">
                                    <input type="textarea" autocomplete="off" class="col-12" placeholder="Buscar por producto" onkeyup="filtrar()" name="buscadorProducto" id="buscadorProducto">
                                </div>
                            </div>    
                            <div class="col-11 col-sm-5 col-md-4">
                                <div class="row rowFiltro">
                                    <select style="height:30px" class="col-12" onchange="filtrar()" name="categoria" id="selectCategoria">
                                        <option value="todos">Todas las categorias</opcion>
                                            <?php foreach($categorias as $categoria){ ?>
                                                <option value="<?php echo $categoria['descripcion'] ?>" ><?php echo $categoria["descripcion"]?></opcion>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div> 
                                <div class="col-12 col-md-2 mb-2 hide mb-md-0" id="boxBotonFiltro">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button type="submit" class="botonQuitarFiltro" name="reiniciarPedido" onclick="quitarFiltros()" class="editButton botonReiniciar">
                                            Quitar
                                        </button>
                                    </div>
                                </div> 
                            </div>
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
                            <tbody>
                                <?php foreach($articulos as $articulo){ ?>
                                    <tr name="rowTable">
                                        <td><?php echo $articulo["id"] ?></td>
                                        <td class="productos">
                                            <div id="producto<?php echo $posicion = array_search($articulo, $articulos)?>">
                                                <?php echo $articulo["descripcion"] ?>
                                            </div>    
                                        </td>
                                        <td style="text-align: center"><?php echo $articulo["medida"] ?></td>
                                        <td class="categorias centrarTexto">
                                            <div id="categoria<?php echo $posicion = array_search($articulo, $articulos)?>">
                                                <?php echo $articulo["categoria"] ?>
                                            </div>
                                        </td>
                                        <td style="text-align: center"><?php echo $articulo["habilitado"] == 1 ? 'Sí' : 'No' ?></td>
                                        <td class="d-flex justify-content-end"> 
                                            <button type="button" onmouseover="deshabilitarBotonTrash(<?php echo $articulo['id']?>, <?php echo $articulo['habilitado']?>)" name="trashButton<?php echo $articulo['id']?>" id="trashButton<?php echo $articulo['id']?>" class="btn trashButton" onclick="eliminarArticulos(<?php echo $articulo['id']?>, '<?php echo $articulo['descripcion'];?>')" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                </svg>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn editButton" onclick="mostrarCaja('boxEditarArticulo', 'boxCrearArticulo', 'botonNuevoArticulo'), cargarDatosEdicion('<?php echo $articulo['id']?>', '<?php echo $articulo['descripcion']?>', '<?php echo $articulo['idMedida']?>', '<?php echo $articulo['idCategoria']?>', <?php echo $articulo['habilitado']?>)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg> 
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>   
                            </tbody>               
                    </table>
                    
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
                </div>
            </form>
        </div>
    </div>
<script>

function validarArticuloExistente(value){
    let boxMensajeArticuloExistente = document.getElementById("mensajeArticuloExistente")
    let articulos = <?php  echo json_encode($articulos) ?>;
    if(value.length >=3) {
        let articulosExistentes = articulos.filter(element => element.descripcion.toLowerCase().includes(value))
        let descripcionesArticulosExistentes = ""
        articulosExistentes.forEach(function callback(value, index) {
            descripcionesArticulosExistentes = descripcionesArticulosExistentes + value.descripcion + " "
        })
        if(articulosExistentes.length > 0) {
            boxMensajeArticuloExistente.classList.remove("hide")
            boxMensajeArticuloExistente.innerHTML = "Ya existen los siguientes articulos: " + descripcionesArticulosExistentes
        }else{
            boxMensajeArticuloExistente.classList.add("hide")
        }
    } else {
        boxMensajeArticuloExistente.classList.add("hide")
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
    document.getElementById("articuloAEliminar").innerHTML = " - " + descripcion + " - "
    document.getElementById("idArticuloEliminar").value = id
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
function cargarDatosEdicion(id, descripcion, medida, categoria, habilitado){
    document.getElementById("botonEditar").setAttribute("disabled", true)
    document.getElementById("idArticuloPorEditar").value = id
    document.getElementById("descripcionEditarArticulo").value = descripcion
    document.getElementById("medidaEditarArticulo").value = medida
    document.getElementById("categoriaEditarArticulo").value = categoria
    document.getElementById("habilitadoEditarArticulo").value = habilitado
}
// CARGA LOS DATOS NUEVOS DE LA SEDE EN EL MODAL PIDIENDO CONFIRMACION
function enviarDatosEdicion(descripcion, medida, categoria, habilitado) {
    let descripcionArticulo = document.getElementById(descripcion).value
    let medidaArticulo = document.getElementById(medida)
    let medidaSelected = medidaArticulo.options[medidaArticulo.selectedIndex].text;
    let categoriaArticulo = document.getElementById(categoria)
    let categoriaSelected = categoriaArticulo.options[categoriaArticulo.selectedIndex].text;
    let habilitadoArticulo = document.getElementById(habilitado).value
    let spanEdicionArticulo = document.getElementById("spanEdicionArticulo")
    spanEdicionArticulo.innerHTML = descripcionArticulo + " en " + medidaSelected + " para " +  categoriaSelected + " - " + (habilitadoArticulo == 0 ? "Eliminado" : "Habilitado")

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
function filtrar() {
    let producto = document.getElementById("buscadorProducto").value;
    let boxBotonFiltro = document.getElementById("boxBotonFiltro");
    let categoria = document.getElementById("selectCategoria").value;
    if(producto.trim() != "" && categoria != "todos"){
        filtrarFilas(producto.toLowerCase(), categoria)
        boxBotonFiltro.classList.remove("hide")
    } else if(producto.trim() != "" && categoria == "todos") {
        filtrarFilasPorParametro("producto", producto.toLowerCase())
        boxBotonFiltro.classList.remove("hide")
    }  else if(producto.trim() == "" && categoria != "todos") {
        filtrarFilasPorParametro("categoria", categoria.toLowerCase())
        boxBotonFiltro.classList.remove("hide")
    } else {
        quitarFiltros()
        boxBotonFiltro.classList.add("hide")
    }
}
function quitarFiltros(){
    resetFiltros()
    let listaFilas = document.getElementsByName("rowTable");
    listaFilas = Array.from(listaFilas)
    listaFilas.forEach(function callback(value, index) {
        value.classList.remove("hide")
    })
}
function filtrarFilas(param1, param2){
    let listaFilas = document.getElementsByName("rowTable");
    listaFilas = Array.from(listaFilas)
    listaFilas.forEach(function callback(value, index) {
       let producto = document.getElementById("producto"+index).innerHTML.trim().toLowerCase()
       let categoria = document.getElementById("categoria"+index).innerHTML.trim()
       if(!producto.includes(param1) || !categoria.includes(param2)){
           value.classList.add("hide")
       } else {
            value.classList.remove("hide")
       }
    })
}
function filtrarFilasPorParametro(param1, param2){
    let listaFilas = document.getElementsByName("rowTable");
    listaFilas = Array.from(listaFilas)
    listaFilas.forEach(function callback(value, index) {
        if(param1 == "producto") {
            let producto = document.getElementById("producto"+index).innerHTML.trim().toLowerCase()
            if(!producto.includes(param2) ){
                value.classList.add("hide")
            } else {
                value.classList.remove("hide")
            }
        }
        if(param1 == "categoria") {
            let categoria = document.getElementById("categoria"+index).innerHTML.trim().toLowerCase()
            if(!categoria.includes(param2) ){
                value.classList.add("hide")
            } else {
                value.classList.remove("hide")
            }
        }
    })
}
function resetFiltros(){
    localStorage.setItem("buscadorProducto", "")
    localStorage.setItem("selectCategoria", "todos")
}
function guardarFiltro(param){
    let input = document.getElementById(param);
    let valor = input.value;
    localStorage.setItem(param, valor);
}

</script>