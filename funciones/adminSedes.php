<?php
    $idUsuarioLogueado = $_SESSION["id"];
    $alertErrorConexion = "hide";
    $alertConfirmacion = "hide";
    $mensajeAlertConfirmacion="";
    $mensajeAlertError="";
    // // ACCION CREAR SEDE
    if(isset($_POST["crearSede"])){
        $provincia = $_POST['selectProvincia'];
        $descripcion = $_POST['inputNuevaSede'];
        $casas = $_POST['selectCasas'];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d h:i:s");

        $insertSede = $baseDeDatos ->prepare("INSERT into sedes VALUES(default, '$provincia', '$descripcion', '$casas', '$date', '$date', '$idUsuarioLogueado')");
        try{
            $insertSede->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La sede se creó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
            $mensajeAlertError="Hubo un error de conexión. Por favor intente nuevamente.";
        }
    }
    // // ACCION EDITAR SEDE
    if (isset($_POST["editarSede"])){
        $id = $_POST["idSedePorEditar"];
        $descripcion = $_POST["inputEditarSede"];
        $habilitado = $_POST["selectEditarHabilitado"];
        $casas = $_POST["selectEditarCasas"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE sedes SET habilitado = '$habilitado', modified = '$date', descripcion = '$descripcion', casas = '$casas', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="La sede se modificó correctamente";
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
            $mensajeAlertConfirmacion="La sede se eliminó correctamente";
        }
    }
    // ACCION ELIMINAR SEDE
    if(isset($_POST["eliminarSede"])){
        $id = $_POST["idSedeEliminar"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consultaValidacion = $baseDeDatos -> prepare("SELECT count(*) from usuarios WHERE sede = '$id'");
        $consulta = $baseDeDatos ->prepare("UPDATE sedes SET habilitado = 0, modified = '$date', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        try {
            $consultaValidacion->execute();
            $validacion = $consultaValidacion -> fetchAll(PDO::FETCH_ASSOC);
            $cantidad = count($validacion);
            if($cantidad > 0 ){
                $alertErrorConexion= "show";
                $mensajeAlertError = "La sede no puede eliminarse ya que existen usuarios pertenecientes a la misma. <br> Modifique primero los usuarios y luego elimine la sede.";
            } else {
                try {
                    $consulta->execute();
                    $alertConfirmacion = "show";
                    $mensajeAlertConfirmacion="La sede se eliminó correctamente";
                } catch (\Throwable $th) {
                    $alertErrorConexion= "show";
                    $mensajeAlertError = "Hubo un error de conexión. <br> Por favor intente nuevamente";
                }
            }
        } catch (\Throwable $th) {
            $alertErrorConexion= "show";
            $mensajeAlertError = "Hubo un error de conexión. <br> Por favor intente nuevamente";
        }
    }
    // CONSULTA LISTADO DE SEDES
    $consultaSedes = $baseDeDatos ->prepare("SELECT * FROM sedes");
    try {
        $consultaSedes->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
        $mensajeAlertError = "Hubo un error de conexión. <br> Por favor intente nuevamente";
    }
    $sedes = $consultaSedes -> fetchAll(PDO::FETCH_ASSOC);
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($sedes) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }