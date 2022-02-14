<?php

$alertError = "hide";
$mensajeAlertError = "";
$alertConfirmacion = "hide";
$mensajeAlertConfirmacion="";
$idUsuarioLogueado = $_SESSION["id"];
    // VARIABLES CON LOS CAMPOS A REVISAR AL VALIDAR EL FORMULARIO DE EDICION/CREACION
    $camposCreacion = ["primerNombreNuevoUsuario", "segundoNombreNuevoUsuario", "apellidoNuevoUsuario", "dniNuevoUsuario", "mailNuevoUsuario", "sedeNuevoUsuario"];
    $camposErroresCreacion = ["errorPrimerNombreNuevoUsuario", "errorSegundoNombreNuevoUsuario", "errorApellidoNuevoUsuario",
    "errorDniNuevoUsuario", "errorMailNuevoUsuario", "errorSedeNuevoUsuario" ];
    $camposEdicion = ["primerNombreEditarUsuario", "segundoNombreEditarUsuario", "apellidoEditarUsuario", "dniEditarUsuario", "mailEditarUsuario", "sedeEditarUsuario"];
    $camposErroresEdicion = ["errorPrimerNombreEditarUsuario", "errorSegundoNombreEditarUsuario", "errorApellidoEditarUsuario",
    "errorDniEditarUsuario", "errorMailEditarUsuario", "errorSedeEditarUsuario" ];
    // ACCION CREAR USUARIO
    if(isset($_POST["crearUsuario"])){
        $nombre = $_POST['primerNombreNuevoUsuario'];
        $segundoNombre = $_POST['segundoNombreNuevoUsuario']; 
        $apellido = $_POST['apellidoNuevoUsuario'];
        $dni = $_POST['dniNuevoUsuario'];
        $password = password_hash($dni, PASSWORD_DEFAULT);
        $rol = $_POST["rolNuevoUsuario"];
        $mail = $_POST["mailNuevoUsuario"];
        if ($rol == "general") {
            $sede = 6;
            $casa = 0;
        } else {
            $sede = $_POST["sedeNuevoUsuario"];
            $casa = $_POST["casaNuevoUsuario"];
        }
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $insertUsuario = $baseDeDatos ->prepare("INSERT into agentes VALUES(default, '$dni', '$nombre', '$segundoNombre', '$apellido', '$mail', '$rol', '$password', '$sede', '$casa',1, '$date', '$date', '$idUsuarioLogueado')");
        $consultaDni = $baseDeDatos ->prepare("SELECT id from agentes WHERE dni = $dni");
        try{
            $consultaDni->execute();
            $dni = $consultaDni -> fetchAll(PDO::FETCH_ASSOC);
            if( count($dni) == 0) {
                try{
                    $insertUsuario->execute();
                    $alertConfirmacion = "show";
                    $mensajeAlertConfirmacion="El usuario se creó correctamente";
                } catch (\Throwable $th) {
                    $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
                    $alertError= "show";
                }
            } else {
                $alertError= "show";
                $mensajeAlertError="El dni ingresado ya está registrado";
            }
        } catch (\Throwable $th) {
            $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
            $alertError= "show";
        }
    }

    // ACCION EDITAR USUARIO
    if (isset($_POST["editarUsuario"])){
        $id = $_POST["idUsuarioPorEditar"];
        $primerNombre = $_POST["primerNombreEditarUsuario"];
        $segundoNombre = $_POST["segundoNombreEditarUsuario"];
        $apellido = $_POST["apellidoEditarUsuario"];
        $rol = $_POST["rolEditarUsuario"];
        $mail = $_POST["mailEditarUsuario"];
        if ($rol == "general") {
            $sede = 6;
            $casa = 0;
        } else {
            $sede = $_POST["sedeEditarUsuario"];
            $casa = $_POST["casaEditarUsuario"];
        }
        $habilitado = $_POST["habilitadoEditarUsuario"];
        date_default_timezone_set('America/Argentina/Cordoba');
        $date = date("Y-m-d H:i:s");
        $consulta = $baseDeDatos ->prepare("UPDATE agentes SET nombre = '$primerNombre', segundoNombre = '$segundoNombre',
        apellido = '$apellido', rol = '$rol', mail = '$mail', sede = '$sede', casa = '$casa', habilitado = '$habilitado',  modified = '$date', userId = '$idUsuarioLogueado' WHERE id = '$id'");
        //$consulta->execute();
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El usuario se modificó correctamente";
        } catch (\Throwable $th) {
            $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
            $alertError= "show";
        }
    }

    // ACCION ELIMINAR USUARIO
    if(isset($_POST["eliminarUsuario"])){
        $id = $_POST["idUsuarioEliminar"];
        $consulta = $baseDeDatos ->prepare("DELETE from agentes WHERE id = '$id'");
        try {
            $consulta->execute();
            $alertConfirmacion = "show";
            $mensajeAlertConfirmacion="El usuario se eliminó correctamente";
        } catch (\Throwable $th) {
            $mensajeAlertError = "Hubo un error de conexión. Por favor intentalo nuevamente";
            $alertError= "show";
        }
    }

    if (isset($_POST["resetPassword"])){
        $id = $_POST["idUsuarioResetPassword"];
        $pass = password_hash($_POST["dniUsuarioResetPassword"], PASSWORD_DEFAULT);
        // $dni = $_POST["dniUsuarioResetPassword"];
        $reset = $baseDeDatos ->prepare("UPDATE agentes SET password = '$pass', userId = '$idUsuarioLogueado' WHERE id = '$id'"); 
        try {
            $reset->execute();
            $mensajeAlertConfirmacion = "El reseteo de contraseña se realizó correctamente.";
            $alertConfirmacion= "show";
        } catch (\Throwable $th) {
            $mensajeAlertError = "Hubo un error de conexión. Por favor intentá nuevamente";
            $alertError= "show";
        }
    }

    // CONSULTAS INICIALES LISTADO DE ARTICULOS, MEDIDAS Y CATEGORIAS
    $consultaUsuarios = $baseDeDatos ->prepare("SELECT U.id, U.nombre, U.segundoNombre, U.apellido, U.mail, U.dni, U.sede idSede, U.rol, S.descripcion 'sede', U.casa FROM agentes U INNER JOIN sedes S ON U.sede = S.id");
    $consultaSedes = $baseDeDatos ->prepare("SELECT * FROM sedes");
    
    try {
        $consultaUsuarios->execute();
        $consultaSedes->execute();
    } catch (\Throwable $th) {
        $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página";
        $alertError= "show";
    }

    $usuarios = $consultaUsuarios -> fetchAll(PDO::FETCH_ASSOC);
    $sedes = $consultaSedes -> fetchAll(PDO::FETCH_ASSOC);
    $noHayDatos = "show";
    $hayDatos = "hide";
    if(sizeof($usuarios) != 0) {
        $noHayDatos = "hide";
        $hayDatos = "show";
    }
 
    // OPCIONES DE ROLES PARA LA CREACION DE USUARIOS
    $rol = "general";
    if($rol == "admin") {
        $roles = [
            [ "value"=> "admin", "descripcion"=> "Admin"],
            ["value"=> "general", "descripcion"=> "General"],
            [ "value"=> "stock", "descripcion"=> "Stock"]
        ];
    } else if($rol == "general") {
        $roles = [
            [ "value"=> "stock", "descripcion"=> "Stock"],
        ];
    }

