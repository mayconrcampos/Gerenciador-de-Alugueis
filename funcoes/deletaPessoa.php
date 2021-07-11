<?php
session_start();
include_once("db.php");

$id = $_GET['id'];

// Deletar registro
$deletePessoa = mysqli_query($conn, "DELETE FROM locats WHERE id='$id'");

if(mysqli_affected_rows($conn)){
    // Deletado com sucesso.
    $_SESSION['sucesso'] = "Registro excluído com sucesso.";
    header("Location: ../listaLocadores.php");
}else{
    // Erro ao deletar registro
    $_SESSION['sucesso'] = "Erro ao excluir registro.";
    header("Location: ../listaLocadores.php");
}