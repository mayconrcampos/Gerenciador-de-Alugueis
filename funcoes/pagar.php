<?php
session_start();
include_once("./db.php");

$id = $_POST['idparcela'];
$data_pagto = $_POST['data_pagto'];
$valor = $_POST['valor'];
$comentario = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_STRING));
$status = 1;
if(!empty($data_pagto) and !empty($valor)){
    // Pagar Parcela
    $pagaParcela = mysqli_query($conn, "UPDATE mensalidades SET data_pagto='$data_pagto', valor='$valor', status='$status', comentario='$comentario' WHERE id='$id'");

    if(mysqli_affected_rows($conn)){
        $_SESSION['sucesso'] = "Parcela paga com sucesso.";
        header("Location: ../listarContratos.php");
    }else{
        $_SESSION['sucesso'] = "Parcela paga com sucesso.";
        header("Location: ../listarContratos.php");
    }
    

}else{
    $_SESSION['sucesso'] = "ERRO! É preciso preencher os campos.";
    header("Location: ../pagarParcela.php");
}
