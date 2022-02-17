<?php
$alertError = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    $idUsuarioLogueado = $_SESSION["id"];
    $mensajeAlertError="";
    // ACCION CREAR CATEGORIA
    if(isset($_POST["crearCategoria"])){
        $categoria = $_POST['descripcionCreacion'];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $insertCategoria = $baseDeDatos ->prepare("INSERT into categorias VALUES(default, '$categoria', '$date', '$date', '$idUsuarioLogueado')");
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