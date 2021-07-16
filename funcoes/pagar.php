<?php
session_start();
include_once("./db.php");

$id = $_POST['idparcela'];
$data_pagto = $_POST['data_pagto'];
$valor = $_POST['valor'];
$comentario = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_STRING));
$status = 1;
if(!empty($data_pagto) and !empty($valor)){
    // Pegar id_contrato
    $queryID = mysqli_query($conn, "SELECT id_contrato from mensalidades WHERE id='$id'");
    $id_contrato = mysqli_fetch_assoc($queryID);

    // Pagar Parcela
    $pagaParcela = mysqli_query($conn, "UPDATE mensalidades SET data_pagto='$data_pagto', valor='$valor', status='$status', comentario='$comentario' WHERE id='$id'");

    if(mysqli_affected_rows($conn)){
        $_SESSION['ide'] = $pagaParcela['id_contrato']; 
        $_SESSION['sucesso'] = "Parcela paga com sucesso.";
        header("Location: ../vencimentosParcelas.php");
        
    }else{
        $_SESSION['sucesso'] = "ERRO ao pagar parcela.";
        header("Location: ../listarContratos.php");
    }
    

}else{
    $_SESSION['sucesso'] = "ERRO! É preciso preencher os campos.";
    header("Location: ../pagarParcela.php");
}
