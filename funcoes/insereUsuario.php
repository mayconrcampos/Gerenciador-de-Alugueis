<?php
session_start();
include_once("db.php");
include_once("funcs.php");

if(!empty($_POST['usuario']) and !empty($_POST['senha']) and !empty($_POST['senha1'])){
    $usuario = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_EMAIL));
    $senha = md5(mysqli_real_escape_string($conn, $_POST['senha']));
    $senha2 = md5(mysqli_real_escape_string($conn, $_POST['senha1']));
    $permissão = 0;
    $status = false;

    // Testar se não existe usuario no banco de dados;
    $existeUser = mysqli_query($conn, "SELECT usuario FROM usuario WHERE usuario='$usuario'");
    $resultUser = mysqli_fetch_assoc($existeUser);

    if(empty($resultUser)){
        // Testar se as duas senhas inseridas conferem.
        if($senha == $senha2){
            // Inserir usuário
            $insertUser = mysqli_query($conn, "INSERT INTO usuario (usuario, senha, permissao, status) VALUES ('$usuario', '$senha', '$permissão', '$status')");

            if(mysqli_affected_rows($conn)){
                sendEmail($usuario);
                $_SESSION['sucesso'] = "Usuario ".$usuario." Senha: ".$senha." Senha2: ".$senha2;
                header("Location: ../index.php");
            }else{
                $_SESSION['sucesso'] = "ERRO ao cadastrar usuário.";
                header("Location: ../index1.php");
            }

        }else{
            $_SESSION['senha'] = "Senhas não conferem.";
            header("Location: ../index1.php");
        }

    }else{
        $_SESSION['existe'] = "Usuário já existe, tente outro.";
        header("Location: ../index1.php");
    }
}
