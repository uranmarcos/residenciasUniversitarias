<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Usuarios
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="container">
                    <div class="btn-group btn-group-justified d-flex justify-space-around">
                        <div class="btn btn-primary btn-opciones">Filtrar/buscar</div>
                        <div class="btn btn-primary btn-opciones">Crear</div>
                    </div>
                </div>
                <!-- FILTRAR USUARIO -->
                <div class="row cajaInternaBloque">     
                    <div class="row anchoTotal">
                        Filtro:
                        <div class="row justify-content-between">    
                            <select class="cols-12 col-md-4">
                                <option></option> 
                                <option>Residencia</option> 
                                <option>Nombre</option> 
                                <option>Apellido</option> 
                                <option>DNI</option> 
                            </select>             
                        </div>
                        <div class="row justify-content-between">
                            <input class="col-5" name="nombre">
                            <input class="col-6" name="apellido">                              
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-5" > Mail: </label>
                            <label class="col-5" > Sede: </label>
                        </div>
                        <div class="row justify-content-between">
                            <input class="col-5" name="mail">
                            <input class="col-5" name="sede">
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-3" > DNI: </label>
                            <label class="col-3" > Rol: </label>
                            <label class="col-3" > Casa: </label>
                        </div> 
                        <div class="row justify-content-between">
                            <input class="col-3" name="dni">
                            <select class="col-3" name="rol">
                                <option value="">Seleccionar</option>
                                <option value="voluntario">Voluntario</option>
                                <option value="admin">Admin</option>
                            </select>  
                            <input type="number" value="1" min="1" class="col-3" name="casa">
                        </div> 
                        <div class="row rowConfirmar justify-content-center">
                            <input type="submit" class="botonConfirmar" name="crearUsuario" value="Crear Usuario">
                            <div class="mensaje" style="color: <?php echo $colorMensaje ?>">
                                <?php echo $mensajeUsuario ?>
                            </div>
                        </div> 
                    </div>
                </div> 
                <!-- CREAR USUARIO -->
                <div class="row cajaInternaBloque">     
                    <div class="row anchoTotal">
                        <div class="row justify-content-between">
                            <label class="col-5" > Nombre: </label>
                            <label class="col-6" > Apellido: </label>               
                        </div>
                        <div class="row justify-content-between">
                            <input class="col-5" name="nombre">
                            <input class="col-6" name="apellido">                              
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-5" > Mail: </label>
                            <label class="col-5" > Sede: </label>
                        </div>
                        <div class="row justify-content-between">
                            <input class="col-5" name="mail">
                            <input class="col-5" name="sede">
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-3" > DNI: </label>
                            <label class="col-3" > Rol: </label>
                            <label class="col-3" > Casa: </label>
                        </div> 
                        <div class="row justify-content-between">
                            <input class="col-3" name="dni">
                            <select class="col-3" name="rol">
                                <option value="">Seleccionar</option>
                                <option value="voluntario">Voluntario</option>
                                <option value="admin">Admin</option>
                            </select>  
                            <input type="number" value="1" min="1" class="col-3" name="casa">
                        </div> 
                        <div class="row rowConfirmar justify-content-center">
                            <input type="submit" class="botonConfirmar" name="crearUsuario" value="Crear Usuario">
                            <div class="mensaje" style="color: <?php echo $colorMensaje ?>">
                                <?php echo $mensajeUsuario ?>
                            </div>
                        </div> 
                    </div>
                </div>  
                <!-- listado usuarios -->
                <div class="row cajaInternaBloque">
                    <div class="cajaSeparadoraListado">
                        <div class="subtitle">
                            Usuarios Existentes
                        </div>
                        <?php foreach($usuarios as $usuario){ ?>
                            <div class="row rowProducto justify-content-around">
                                <?php echo $usuario["nombre"] . " " . $usuario["apellido"] . 
                                    " - " . $usuario["rol"] . " - " . $usuario["sede"] ." - Casa: " . 
                                    $usuario["casa"] ?>                               
                            </div>
                        <?php } ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>             
</div>