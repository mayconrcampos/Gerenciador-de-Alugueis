<?php
session_start();
include_once("../funcoes/db.php");

if(!empty($_POST['usuario']) and !empty($_POST['senha'])){
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = md5(mysqli_real_escape_string($conn, $_POST['senha']));

    // Verifica se existe usuario
    $existeUser = mysqli_query($conn, "SELECT usuario FROM usuario WHERE usuario='$usuario'");
    $resultExiste = mysqli_fetch_assoc($existeUser);

    if(empty($resultExiste)){
        $_SESSION['existe'] = "ERRO, usuário não cadastrado.";
        header("Location: ../index.php");
    }else{
        $queryUser = mysqli_query($conn, "SELECT id, usuario, senha FROM usuario WHERE usuario='$usuario' AND senha='$senha'");
        $resultUser = mysqli_fetch_assoc($queryUser);

        if(empty($resultUser)){
            $_SESSION['login'] = "Usuário ou senha incorretos.";
            header("Location: index.php");
        }else{
            $_SESSION['iduser'] = $resultUser['id'];
            header("Location: cadastroPF.php");
        }
    }

    

}