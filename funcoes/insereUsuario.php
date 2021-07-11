<?php
session_start();
include_once("db.php");
include_once("funcs.php");

if(!empty($_POST['usuario']) and !empty($_POST['senha']) and !empty($_POST['senha1'])){
    $usuario = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_EMAIL));
    $senha = md5(mysqli_real_escape_string($conn, $_POST['senha']));
    $senha2 = md5(mysqli_real_escape_string($conn, $_POST['senha1']));
    $permissao = 1;
    $status = 0; // O banco de dados não insere valor false ou true, mesmo sendo declarado como booleano. Ele só aceita tiny int, 0 e 1.

    // Testar se não existe usuario no banco de dados;
    $existeUser = mysqli_query($conn, "SELECT usuario FROM usuarios WHERE usuario='$usuario'");
    $resultUser = mysqli_fetch_assoc($existeUser);

    if(empty($resultUser)){
        // Testar se as duas senhas inseridas conferem.
        if($senha == $senha2){
            // Inserir usuário
            $insereUser = mysqli_query($conn, "INSERT INTO usuarios (usuario, senha, permissao, status) VALUES ('$usuario', '$senha', '$permissao', '$status')");

            // Testar se deu certo
            if(mysqli_affected_rows($conn)){
                //sendEmail($usuario);
                $_SESSION['sucesso'] = "Usuario ".$usuario." <br>Senha: ".$senha." <br>Senha2: ".$senha2;
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
