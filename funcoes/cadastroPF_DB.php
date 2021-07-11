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
$iduser = $_SESSION['iduser'];

if(!empty($nome) and !empty($est_civil) and !empty($profissao) and !empty($rg) and !empty($cpf) and !empty($data_nasc) and !empty($email) and !empty($logradouro) and !empty($bairro) and !empty($cidade) and !empty($cep) and !empty($locat)){

    // Verificar se já existe locador ou locatário na base de dados.
    $existeLoc = mysqli_query($conn, "SELECT nome FROM locats WHERE nome='$nome' AND cpf='$cpf'");
    $resultadoExisteLoc = mysqli_fetch_assoc($existeLoc);

    // Se tiver vazio, pode cadastrar.
    if(empty($resultadoExisteLoc)){ 
        // pode cadastrar
        $insereLoc = mysqli_query($conn, "INSERT INTO 
                        locats  (nome, 
                                est_civil, 
                                profissao, 
                                rg, 
                                cpf, 
                                data_nasc, 
                                email,
                                logradouro,
                                numero,
                                complemento,
                                bairro,
                                cidade,
                                cep,
                                locat,
                                id_usuario) VALUES 
                                ('$nome',
                                '$est_civil',
                                '$profissao',
                                '$rg',
                                '$cpf',
                                '$data_nasc',
                                '$email',
                                '$logradouro',
                                '$numero',
                                '$complemento',
                                '$bairro',
                                '$cidade',
                                '$cep',
                                '$locat',
                                '$iduser')");
        
        if(mysqli_affected_rows($conn)){
            $_SESSION['sucesso'] = "$locat inserido com sucesso.";
            header("Location: ../listaLocadores.php");
        }else{
            $_SESSION['sucesso'] = "Erro ao inserir $locat .";
            header("Location: ../cadastroPF.php");
        }
    }else{
        // Usuário já existe na base de dados. Não precisa cadastrar de novo, seu monte de bosta.
        $_SESSION['existe'] = "$nome já existe na base de dados.";
        header("Location: ../listaLocadores.php");
    }
}

