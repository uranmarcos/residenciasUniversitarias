<?php
session_start();
require("funciones/pdo.php");
session_destroy();
header("Location: index.php");

?>
