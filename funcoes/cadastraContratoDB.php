<?php
session_start();

$locador = $_POST['locador'];      
$locatario = $_POST['locatario'];
$imovel = $_POST['imovel'];

echo $locador." ".$locatario." ".$imovel;
$_SESSION['msg'] = "Deu serto!";

header("Location: ../listarContratos.php ");
    
