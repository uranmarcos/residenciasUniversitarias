<?php
    $consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
    $consultaAlimentos->execute();
    $alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

    $consultaMeriendas = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='merienda' ORDER BY producto ASC");
    $consultaMeriendas->execute();
    $meriendas = $consultaMeriendas -> fetchAll(PDO::FETCH_ASSOC);

    $consultaUsosPersonales = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='uso personal' ORDER BY producto ASC");
    $consultaUsosPersonales->execute();
    $usosPersonales = $consultaUsosPersonales -> fetchAll(PDO::FETCH_ASSOC);

    $consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
    $consultaLimpieza->execute();
    $limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);

    $consultaUsuarios = $baseDeDatos ->prepare("SELECT * FROM usuarios ORDER BY apellido ASC");
    $consultaUsuarios->execute();
    $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    $mensajeProducto ="";
    $mensajeUsuario = "";

    if(isset($_POST["crearUsuario"])){
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST["dni"];
            $sede = $_POST["sede"];
            $casa = $_POST["casa"];
            $rol = $_POST["rol"];
            $mail = $_POST["mail"];

            try{
                $consulta = $baseDeDatos ->prepare("INSERT into usuarios VALUES(default, '$mail', '$rol',
                '$dni', '$nombre', '$apellido', '$dni', '$sede', '$casa')");
                $consulta->execute();
                $usuario =$consulta -> fetchAll(PDO::FETCH_ASSOC);
                $mensajeUsuario = "El usuario se creó correctamene";
            }catch(Exception $exception){
                $exception = "UPS, hubo error y el usuario no pudo crearse! Por favor intentalo nuevamente";   
                $mensajeUsuario = $exception;
                return;
            }
    }
    if(isset($_POST["crearArticulo"])){
        $producto = $_POST["producto"];
        $categoria = $_POST["categoria"];
        $medida = $_POST["medida"];
        $disponible = 1;
        try{
            $consulta = $baseDeDatos ->prepare("INSERT into productos VALUES(default, '$producto', '$categoria',
            '$medida', '$disponible')");
            $consulta->execute();
            $producto =$consulta -> fetchAll(PDO::FETCH_ASSOC);
            $mensajeProducto = "El producto se creó correctamene";
        }catch(Exception $exception){
            $exception = "UPS, hubo error y el usuario no pudo crearse! Por favor intentalo nuevamente";   
            $mensajeProducto = $exception;
            return;
        }
    }

?>
<div class="col-12 paddingCero">
    <div class="titleSection">
        Admin
    </div>
    <form method="POST" action="inicio.php" onkeypress="return pulsar(event)">
    <!-- CAJA SEDES -->  
    <div class="sectionBloque">  
        <div class="accordion" id="accordionSedes">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSedes" aria-expanded="true" aria-controls="collapseSedes">
                        Sedes
                    </button>
                </h2>
                <div id="collapseSedes" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionSedes">
                    <div class="accordion-body">
                        CREAR SEDE
                    </div>
                </div>
            </div>             
        </div>
    </div>     
    
    <!-- CAJA CATEGORIAS -->  
    <div class="sectionBloque">  
        <div class="accordion" id="accordionCategorias">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategorias" aria-expanded="true" aria-controls="collapseCategorias">
                        Categorias
                    </button>
                </h2>
                <div id="collapseCategorias" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionCategorias">
                    <div class="accordion-body">
                        CREAR CATEGORIA
                    </div>
                </div>
            </div>             
        </div>
    </div>     
    <!-- CAJA USUARIOS -->  
    <div class="sectionBloque">  
        <?php require("subsecciones/usuariosSection.php") ?>                                      
    </div>     
    <!-- CAJA ARTICULOS -->
    <div class="sectionBloque">  
        <?php require("subsecciones/articulosSection.php")?>
    </div>  
    </form>   
</div> 

