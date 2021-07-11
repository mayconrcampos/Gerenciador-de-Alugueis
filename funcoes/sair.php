<?php
session_start();

if($_SESSION['logado']){
    $_SESSION['logado'] = false;
    
    header("Location: ../index.php");
}

