<?php
session_start();
include_once("db.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$est_civil = filter_input(INPUT_POST, 'est_civil');
$profissao = filter_input(INPUT_POST, "profissao", FILTER_SANITIZE_STRING);
$rg = filter_input(INPUT_POST, "rg", FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRING);
$data_nasc = filter_input(INPUT_POST, "data_nasc"); 
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); 
$logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRING); 
$numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
$complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRING); 
$cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
$locat = filter_input(INPUT_POST, "locat");
$iduser = $_POST['id'];

if(!empty($nome) and !empty($est_civil) and !empty($profissao) and !empty($rg) and !empty($cpf) and !empty($data_nasc) and !empty($email) and !empty($logradouro) and !empty($bairro) and !empty($cidade) and !empty($cep) and !empty($locat)){

    // Atualiza tabela com novos dados atualizados
    $atualizaLocat = mysqli_query($conn, "UPDATE locats SET 
                                                nome='$nome',
                                                est_civil='$est_civil',
                                                profissao='$profissao',
                                                rg='$rg',
                                                cpf='$cpf',
                                                data_nasc='$data_nasc',
                                                email='$email',
                                                logradouro='$logradouro',
                                                numero='$numero',
                                                complemento='$complemento',
                                                bairro='$bairro',
                                                cidade='$cidade',
                                                cep='$cep',
                                                locat='$locat' WHERE id='$iduser'");
        
    if(mysqli_affected_rows($conn)){
        // Se alguma linha da tabela foi afetada pelas mudanças
        $_SESSION['sucesso'] = "Registro atualizado com sucesso.";
        header("Location: ../listaLocadores.php");
    }else{
        // Se nenhuma linha foi afetada, deu merda.
        $_SESSION['sucesso'] = "ERRO ao atualizar registro.";
        header("Location: ../editaLocadores.php");
    }
}else{
    $_SESSION['sucesso'] = "É preciso preencher todos os campos, exceto numero e complemento.";
    header("Location: ../listaLocadores.php");
}
