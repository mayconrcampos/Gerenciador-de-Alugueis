<?php
session_start();
include_once("db.php");
include_once("funcs.php");

$descrição = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
$utilizacao = filter_input(INPUT_POST, "utilizacao", FILTER_SANITIZE_STRING);
$wc = filter_input(INPUT_POST, "wc", FILTER_SANITIZE_NUMBER_INT);
$area = valida_float($_POST['area']);
$garagem = filter_input(INPUT_POST, "garagem", FILTER_SANITIZE_STRING);
$designacao = filter_input(INPUT_POST, "designacao", FILTER_SANITIZE_STRING);
$logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_STRING);
$numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
$complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRING);
$cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
$id_imovel = $_POST['id_imovel'];
$id_usuario = $_POST['id_usuario'];

if(!empty($descrição) and !empty($utilizacao) and !empty($wc) and !empty($area) and !empty($garagem) and !empty($designacao) and !empty($logradouro) and !empty($numero) and !empty($complemento) and !empty($bairro) and !empty($cidade) and !empty($cep)){

    // Fazer o update com os dados atualizados.
    $updateImovel = mysqli_query($conn, "UPDATE imoveis SET 
                                        descricao='$descrição',
                                        utilizacao='$utilizacao',
                                        wc='$wc',
                                        area='$area',
                                        garagem='$garagem',
                                        designacao='$designacao',
                                        logradouro='$logradouro',
                                        numero='$numero',
                                        complemento='$complemento',
                                        bairro='$bairro',
                                        cidade='$cidade',
                                        cep='$cep',
                                        id_usuario='$id_usuario'
                                        WHERE id='$id_imovel'");
    if(mysqli_affected_rows($conn)){
        $_SESSION['sucesso'] = "Registro atualizado com sucesso.";
        header("Location: ../listarImoveis.php");
    }else{
        $_SESSION['sucesso'] = "ERRO ao atualizar registro.";
        header("Location: ../listarImoveis.php");
    }
}else{
    $_SESSION['sucesso'] = "ERRO! É preciso preencher todos os campos, exceto número e complemento.";
    header("Location: ../listarImoveis.php");
}