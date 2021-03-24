<?php
$consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
$consultaAlimentos->execute();
$alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

$consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
$consultaLimpieza->execute();
$limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);

$consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY apellido ASC");
$consultaUsuarios->execute();
$usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
?>

<div class="titleSection">
            Admin
        </div>

<form class="col-12 contenedorBloques" action="home.php" method="POST">
    <div class="bloque">
        <div class="row justify-content-between rowTipoProducto" onclick="mostrarAdminArticulos()">
            <div class="col-6">
                Articulos
            </div> 
            <div class="col-1" id="navAdminArticulos">
            </div>       
        </div>

        <!-- CAJA ARTICULOS -->
        <div class=" anchoTotal hidden" id="adminArticulos">
            <!-- CAJA CREACION -->
            <div class="row cajaInternaBloque">
                <div class="row anchoTotal">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <label class="col-11" for="producto"> Producto: </label>
                                <input class="col-11" name="producto">
                            </div>
                        </div>    
                        <div class="col-3">
                            <div class="row">    
                                <label class="col-11" for="medida"> Medida: </label>
                                <select class="col-11" name="medida">
                                    <option value="">Seleccionar</option>
                                    <option value="kg">Kilogramos</option>
                                    <option value="lt">Litros</option>   
                                </select> 
                            </div>
                        </div> 
                        <div class="col-3">
                            <div class="row">
                                <label class="col-11" for="categoria"> Categoria: </label>
                                <select class="col-11" name="categoria">  
                                    <option value="">Seleccionar</option>
                                    <option value="limpieza">Limpieza</option>
                                    <option value="alimentos">Alimentos</option>
                                </select>
                            </div>
                        </div>        
                    </div>
                    <div class="row rowConfirmar">     
                        <input type="submit" class="col-4" name="crearArticulo" value="Confirmar">
                        <div class="mensaje" style="color: <?php echo $colorMensaje ?>"><?php echo $mensajeProducto ?></div>
                    </div>
                </div>
            </div>    
            <!-- CAJA EDICION -->
            <div class="row cajaInternaBloque">
                <div class="row anchoTotal">
                    <div class="cajaSeparadoraListado">
                        <div class="navTitle">Alimentos</div>
                        <div class="row rowTitle justify-content-around">
                            <label class="col-4" for="producto"> Producto: </label>           
                            <label class="col-2" for="cantidad"> Medida: </label>
                            <label class="col-2" for="cantidad"> Disponible: </label>
                           
                            <label class="col-1" for="cantidad">  </label>
                            <label class="col-1" for="cantidad">  </label>
                        </div>
                        <?php foreach($alimentos as $alimento){?>
                            <div class="row rowProducto justify-content-around">
                                <input class="col-4" value="<?php echo $alimento['producto']?>" name="articulo[<?php echo $alimento['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                <input  value = "<?php echo $alimento["medida"] ?>" name="articulo[<?php echo $alimento["id"] ?>][medida]?>" class="col-2" for="medida">
                                <input class="col-2" type="text"  value="<?php if($alimento["disponible"] == 0){ echo "No";} else {echo "Sí";} ?>">    
                               
                                <button class="col-1"> E </button>
                                <button class="col-1" > B </button>
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="cajaSeparadoraListado">
                        <div class="navTitle">Limpieza</div>
                            <div class="row rowTitle justify-content-around">
                                <label class="col-4" for="producto"> Producto: </label>        
                                <label class="col-2" for="cantidad"> Medida: </label>
                                <label class="col-2" for="cantidad"> Disponible: </label>
                               
                                <label class="col-1" for="cantidad">  </label>
                                <label class="col-1" for="cantidad">  </label>
                            </div>
                            <?php foreach($limpieza as $articulo){ ?>
                                <div class="row rowProducto justify-content-around">
                                    <input class="col-4" value="<?php echo $articulo['producto']?>" name="articulo[<?php echo $articulo['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                    <input  value = "<?php echo $articulo["medida"] ?>" name="articulo[<?php echo $articulo["id"] ?>][medida]?>" class="col-2" for="medida">
                                    <input class="col-2" type="text"  value="<?php if($articulo["disponible"] == 0){ echo "No";} else {echo "Sí";} ?>">    
                                    
                                    <button class="col-1"> E </button>
                                    <button class="col-1"> B </button>
                                </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>        
        </div>    
        <!-- CAJA USUARIOS -->  
        <div class="bloque">            
            <div class="row justify-content-between rowTipoProducto" onclick="mostrarAdminUsuarios()">
                <div class="col-6">
                    Usuarios
                </div> 
                <div class="col-1" id="navAdminUsuarios">
                </div>       
            </div>    
            <div class="hidden" id="adminUsuarios">
                <div class="row cajaInternaBloque">
                    <div class="row">
                        <div class="row justify-content-between">
                            <label class="col-5" > Nombre: </label>
                            <label class="col-5" > Apellido: </label>               
                        </div>
                        <div class="row justify-content-between">
                            <input class="col-5" name="nombre">
                            <input class="col-5" name="apellido">                              
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-5" > Mail: </label>
                            <label class="col-2" > DNI: </label>
                            <label class="col-2" > Rol: </label>
                        </div>
                        <div class="row justify-content-between">
                            <input class="col-5" name="mail">
                            <input class="col-2" name="dni">
                            <select class="col-2" name="rol">
                                <option value="">Seleccionar</option>
                                <option value="voluntario">Voluntario</option>
                                <option value="admin">Admin</option>
                            </select>  
                        </div> 
                        <div class="row rowConfirmar">
                            <input type="submit" class="col-4" name="crearUsuario" value="Crear Usuario">
                            <div class="mensaje" style="color: <?php echo $colorMensaje ?>"><?php echo $mensajeUsuario ?></div>
                        </div> 
                    </div>
                </div>  
                <div class="row cajaInternaBloque">
                    <div class="cajaSeparadoraListado">
                        <div class="navTitle">Usuarios</div>
                        <div class="row rowTitle justify-content-around">
                            <label class="col-4" for="producto"> Nombre: </label>
                            
                            <label class="col-2" for="cantidad"> Apellido: </label>
                            <label class="col-2" for="cantidad"> Disponible: </label>
                            <label class="col-1" for="cantidad">  </label>
                            <label class="col-1" for="cantidad">  </label>
                            <label class="col-1" for="cantidad">  </label>
                        </div>
                        <?php foreach($usuarios as $usuario){ ?>
                            <div class="row rowProducto justify-content-around">
                                <input class="col-4" value="<?php echo $usuario['nombre']?>" name="articulo[<?php echo $usuario['id']?>][producto]?>]" autocomplete="off" for="producto"> 
                                <input  value = "<?php echo $usuario["apellido"] ?>" name="articulo[<?php echo $usuario["id"] ?>][medida]?>" class="col-2" for="medida">
                                
                                <button class="col-1"> + </button>
                                <button class="col-1"> E </button>
                                <button class="col-1"> B </button>
                            </div>
                        <?php } ?> 
                    </div>
                </div>
            </div>  
        </div>      
    </div>                        
</form>
<script type="text/javascript"  src="js/admin.js"></script>
     
               