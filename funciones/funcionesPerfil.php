<?php
$id = $_SESSION["id"];
$alertErrorConexion = "hide";
$alertConfirmacion = "hide";
$mensajeAlertError = "";
$mensajeAlertConfirmacion = "";

if (isset($_POST["editarPerfil"])) {
    $nombre = $_POST["nombrePerfil"];
    $segundoNombre = $_POST["segundoNombrePerfil"];
    $apellido = $_POST["apellidoPerfil"];
    $mail = $_POST["mailPerfil"];
    $edicion = $baseDeDatos ->prepare("UPDATE agentes SET nombre = '$nombre', segundoNombre = '$segundoNombre', apellido = '$apellido', mail = '$mail' WHERE id = '$id'");
    try { 
        $edicion->execute();
        $alertConfirmacion ="show";
        $mensajeAlertConfirmacion = "Los datos se modificaron correctamente";
    } catch (\Throwable $th) {
        $mensajeAlertError = "Hubo un error de conexión. Por favor realizá los cambios nuevamente.";
        $alertErrorConexion = "show";
    }
}

$consulta = $baseDeDatos ->prepare("SELECT A.id, A.dni, A.nombre, A.segundoNombre, A.apellido, A.mail, A.sede, A.casa, A.rol, S.descripcion nombreSede FROM agentes A INNER JOIN sedes S on A.sede = S.id WHERE A.id = $id");
try {
    $consulta->execute();
} catch (\Throwable $th) {
    $mensajeAlertError = "Hubo un error de conexión. Por favor actualizá la página.";
    $alertErrorConexion = "show";
}
$perfil = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$noHayDatos = "show";
$hayDatos = "hide";
if(sizeof($perfil) != 0) {
    $perfil[0]["rol"] = ucfirst($perfil[0]["rol"]);
    $noHayDatos = "hide";
    $hayDatos = "show";
}
if (isset($_POST["cambiarPassword"])) {
    //$pass = password_hash($_POST["inputPassword"], PASSWORD_DEFAULT);
    $pass = $_POST["inputPassword"];
    $newPass = password_hash($_POST["inputNewPassword"], PASSWORD_DEFAULT);
    $consulta = $baseDeDatos ->prepare("SELECT password FROM agentes A WHERE A.id = '$id'");
    try {
        $consulta->execute();
        $password = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        if(password_verify($pass, $password[0]["password"])) {
            $update = $baseDeDatos ->prepare("UPDATE agentes SET password = '$newPass' WHERE id = '$id'");
            try {
                $update->execute();
                $mensajeAlertConfirmacion = "¡La contraseña se modificó correctamente!";
                $alertConfirmacion = "show";
            } catch (\Throwable $th) {
                $mensajeAlertError = "Hubo un error de conexión. Por favor realizá el cambio nuevamente";
                $alertErrorConexion = "show";
            }
        } else{
            $mensajeAlertError = "La contraseña actual que ingresó no es correcta";
            $alertErrorConexion = "show";
        }
    } catch (\Throwable $th) {  
        $mensajeAlertError = "Hubo un error de conexión. Por favor intente nuevamente";
        $alertErrorConexion = "show";
    }
}
?>