<?php 

$producto="";
$categoria="";
$medida="";
$mensaje = "";


$consultaAlimentos = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='alimentos' ORDER BY producto ASC");
$consultaAlimentos->execute();
$alimentos = $consultaAlimentos -> fetchAll(PDO::FETCH_ASSOC);

$consultaLimpieza = $baseDeDatos ->prepare("SELECT * FROM productos WHERE categoria='limpieza'");
$consultaLimpieza->execute();
$limpieza = $consultaLimpieza -> fetchAll(PDO::FETCH_ASSOC);

?>