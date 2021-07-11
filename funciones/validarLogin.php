<?php

$dni = null;
$password = null;


$dni = $_POST["dni"];
$password = $_POST["password"];

$consulta = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
$consulta->execute();
$datosUsuarios =$consulta -> fetchAll(PDO::FETCH_ASSOC);

if(empty($datosUsuarios)){
    $error = "El DNI ingresado no está registrado";
}else{    
    if($password == $datosUsuarios[0]["pass"]){
        $_SESSION["autenticado"] = true;
        $_SESSION["name"] = $datosUsuarios[0]["nombre"];
        $_SESSION["apellido"] = $datosUsuarios[0]["apellido"];
        $_SESSION["rol"] = $datosUsuarios[0]["rol"];
        $_SESSION["dni"] = $datosUsuarios[0]["dni"];
        $_SESSION["sede"] = $datosUsuarios[0]["sede"];
        $_SESSION["casa"] = $datosUsuarios[0]["casa"];
       

        echo "<script>location.href='inicio.php';</script>";
    } else {
        $error="Los datos ingresados son erróneos";
    }
        // if($_SESSION["rol"]=="postulante"){
        //                 echo "<script>location.href='menu.php';</script>";        
        //             }else{
        //                 echo "<script>location.href='admin.php';</script>";
        //             }
        //     }else{
        //         $errorLogin="Los datos ingresados son erróneos";
        //     }
    }        
?>