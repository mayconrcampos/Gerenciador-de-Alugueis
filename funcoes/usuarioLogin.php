<?php
session_start();
include_once("../funcoes/db.php");

if(!empty($_POST['usuario']) and !empty($_POST['senha'])){
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = md5(mysqli_real_escape_string($conn, $_POST['senha']));

    // Verifica se existe usuario
    $existeUser = mysqli_query($conn, "SELECT usuario FROM usuarios WHERE usuario='$usuario'");
    $resultExiste = mysqli_fetch_assoc($existeUser);

    // Se não existir
    if(empty($resultExiste)){
        $_SESSION['existe'] = "ERRO, usuário não cadastrado.";
        header("Location: ../index.php");
    //se Existir
    }else{
        // Verificar se usuário está ativado
        $ativado = 1;
        $ativadoUser = mysqli_query($conn, "SELECT id, usuario FROM usuarios WHERE status='$ativado'");
        $resultAtivado = mysqli_fetch_assoc($ativadoUser);

        if(empty($resultAtivado)){
            $_SESSION['ativado'] = "Usuário não está ativado!  <a href='./funcoes/funcs.php?usuario=".$usuario."'>Clique aqui para ativar.</a>";
            header("Location: ../index.php");
        }else{
            $queryUser = mysqli_query($conn, "SELECT id, usuario, senha FROM usuarios WHERE usuario='$usuario' AND senha='$senha'");
            $resultUser = mysqli_fetch_assoc($queryUser);

            if(empty($resultUser)){
                $_SESSION['login'] = "Usuário ou senha incorretos.";
                header("Location: ../index.php");
            }else{
                $_SESSION['logado'] = true;
                $_SESSION['user'] = $usuario;
                $_SESSION['iduser'] = $resultUser['id'];

                header("Location: ../cadastroPF.php");
            }
        }

        
    }

    

}