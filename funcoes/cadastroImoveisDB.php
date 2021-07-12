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
$status = 0; // 0 - Não alugado | 1 - Alugado
$id_ususario = $_SESSION['iduser'];

if(!empty($descrição) and !empty($utilizacao) and !empty($wc) and !empty($area) and !empty($garagem) and !empty($designacao) and !empty($logradouro) and !empty($numero) and !empty($complemento) and !empty($bairro) and !empty($cidade) and !empty($cep)){

    // Se tudo estiver preenchido, vamos fazer a query para inserir o imóvel ao DB.
    $insereImovel = mysqli_query($conn, "INSERT INTO imoveis (
                                        descricao,
                                        utilizacao,
                                        wc,
                                        area,
                                        garagem,
                                        designacao,
                                        logradouro,
                                        numero,
                                        complemento,
                                        bairro,
                                        cidade,
                                        cep,
                                        status,
                                        id_usuario) VALUES (
                                            '$descrição',
                                            '$utilizacao',
                                            '$wc',
                                            '$area',
                                            '$garagem',
                                            '$designacao',
                                            '$logradouro',
                                            '$numero',
                                            '$complemento',
                                            '$bairro',
                                            '$cidade',
                                            '$cep',
                                            '$status',
                                            '$id_ususario'
                                        )");
    if(mysqli_affected_rows($conn)){
        // Se a inserção deu certo.
        $_SESSION['sucesso'] = "Imóvel cadastrado com sucesso.";
        header("Location: ../listarImoveis.php");
    }else{
        // Se a inserção deu errado.
        $_SESSION['sucesso'] = "Erro ao cadastrar imóvel.";
        header("Location: ../cadastroImoveis.php");
    }
}else{
    // Se não for preenchidos os campos obrigatórios, mensagem de erro e redirecionamento para a tela cadastroImoveis.php
    $_SESSION['sucesso'] = "ERRO! É preciso preencher todos os campos, exceto número e complemento.";
    header("Location: ../cadastroImoveis.php");

}