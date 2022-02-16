<?php    
    $alertError = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertError="";
    $mensajeAlertConfirmacion="";
    $idUsuarioLogueado = $_SESSION["id"];
    // // ACCION CREAR SEDE
    if(isset($_POST["crearArticulo"])){
        $descripcion = $_POST['descripcionNuevoArticulo'];
        $categoria = $_POST['categoriaNuevoArticulo'];
        $medida = $_POST['medidaNuevoArticulo'];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $insertArticulo = $baseDeDatos ->prepare("INSERT into articulos VALUES(default, '$descripcion', '$medida', '$categoria', 1, '$date', '$date', '$idUsuarioLogueado')");
        try{
            $insertArticulo->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El articulo se creó correctamente";
        } catch (\Throwable $th) {
            $alertError= "show";
        }
    }

    // ACCION EDITAR ARTICULO
    if (isset($_POST["editarArticulo"])){
        $id = $_POST["idArticuloPorEditar"];
        $descripcion = $_POST["descripcionEditarArticulo"];
        $medida = $_POST["medidaEditarArticulo"];
        $categoria = $_POST["categoriaEditarArticulo"];
        $habilitado = $_POST["habilitadoEditarArticulo"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE articulos SET habilitado = '$habilitado', modified = '$date', descripcion = '$descripcion', medida = '$medida', categoria = '$categoria', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El articulo se modificó correctamente";
        } catch (\Throwable $th) {
            $alertError= "show";
        }
    }

    // ACCION ELIMINAR ARTICULO   OK!
    if(isset($_POST["eliminarArticulo"])){
        $id = $_POST["idArticuloEliminar"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consulta = $baseDeDatos ->prepare("DELETE from articulos WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El artículo se eliminó correctamente";
        } catch (\Throwable $th) {
            $alertError= "show";
            $mensajeAlertError = "Hubo un error de conexión. Por favor intente nuevamente.";
        }
    }

    // CONSULTAS INICIALES LISTADO DE ARTICULOS, MEDIDAS Y CATEGORIAS
    $consultaArticulos = $baseDeDatos ->prepare("SELECT A.id, A.descripcion, A.categoria 'idCategoria', C.descripcion 'categoria',  A.medida 'idMedida', M.descripcion 'medida', A.habilitado FROM articulos A INNER JOIN categorias C ON A.categoria = C.id INNER JOIN medidas M ON A.medida = M.id");
    $consultaMedidas = $baseDeDatos ->prepare("SELECT * FROM medidas");
    $consultaCategorias = $baseDeDatos ->prepare("SELECT * FROM categorias WHERE habilitado = 1");
    
    try {
        $consultaArticulos->execute();
        $consultaMedidas->execute();
        $consultaCategorias->execute();
    } catch (\Throwable $th) {
        $alertError= "show";
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