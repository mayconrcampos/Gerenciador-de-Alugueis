<?php

session_start();

$servidor = "localhost";
$usuario = "root";
$senha = "5DaJ10.,Xw,8";
$nomeDB = "aluguel";

// Criando conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $nomeDB);

if(!$conn){
    die("Falha na conexão!".mysqli_connect_error());
}