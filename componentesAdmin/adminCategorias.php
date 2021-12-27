<div class="sectionBloque">
    <div class="contenedorSeccion contenedorModal hide mb-4" id="boxCrearCategoria">
        <div class="d-flex anchoTotal justify-content-between">
            <div class="subtitle mb-2">
                Nueva categoria
            </div> 
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="labelForm"> Descripción: </label>
                <input class="campoFormNewUser" name="descripcion">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-end justify-content-around">
                <button type="submit" name="botonCancelar" onclick="ocultarCaja('boxCrearCategoria', 'botonNuevaCategoria')" class="btn botonCancelar col-6 col-md-3">Cancelar</button>
                <button type="submit" name="botonGenerar" class="btn botonConfirmar col-6 col-md-3">Generar</button>        
            </div>
        </div>
    </div>
    <div class="contenedorSeccion contenedorModal">
        <div class="d-flex anchoTotal row">
            <div class="subtitle col-6">
                Categorias disponibles
            </div>
            <div class="col-6 d-flex align-items-end justify-content-end">
                <button type="submit" name="botonNuevaCategoria" onclick="mostrarCaja('boxCrearCategoria', 'botonNuevaCategoria')" id="botonNuevaCategoria" class="btn botonConfirmar col-6 col-md-3">Nueva</button>        
            </div>
        </div>
        <div class="d-flex anchoTotal justify-content-between">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width:70%">Descripción</th>
                    <th scope="col" style="width:10%"></th>
                    <th scope="col" style="width:10%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Otto</td>
                    <td> 
                        <div class="trashButton pt-1"  onclick="borrarCantidad('<?php echo $producto['id']?>')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </div>
                    </td>
                    <td>
                        <div class="editButton pt-1" onclick="editUser(<?php echo $articulo['id']?>)" id="<?php echo $usuario["id"]?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg> 
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Otto</td>
                    <td> 
                        <div class="trashButton pt-1"  onclick="borrarCantidad('<?php echo $producto['id']?>')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </div>
                    </td>
                    <td>Otto</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script>
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
</script>