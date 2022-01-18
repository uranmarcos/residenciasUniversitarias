<?php
//session_start();
require("funciones/pdo.php");
$dni = null;
$password = null;

$dni = $_POST["dni"];
$password = $_POST["password"];

$consulta = $baseDeDatos ->prepare("SELECT * FROM agentes WHERE dni = $dni");
$consulta->execute();
$datosUsuarios = $consulta -> fetchAll(PDO::FETCH_ASSOC);

if(empty($datosUsuarios)){
    $error = "El DNI ingresado no está registrado";
}else{    
    if(password_verify($password, $datosUsuarios[0]["password"])) {
        $_SESSION["autenticado"] = true;
        $_SESSION["name"] = $datosUsuarios[0]["nombre"] . " " . $datosUsuarios[0]["segundoNombre"];
        $_SESSION["apellido"] = $datosUsuarios[0]["apellido"];
        $_SESSION["rol"] = $datosUsuarios[0]["rol"];
        $_SESSION["dni"] = $datosUsuarios[0]["dni"];
        $_SESSION["sede"] = $datosUsuarios[0]["sede"];
        $_SESSION["casa"] = $datosUsuarios[0]["casa"];
        $_SESSION["id"] = $datosUsuarios[0]["id"];
        $_SESSION["errorMail"] = false;
        echo "<script>location.href='inicio.php';</script>";
    } else {
        $error="Los datos ingresados son erróneos";
    }
}        
?>