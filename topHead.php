<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    include "inclusao/inclusao.php";
    include "globalValues.php";

    // Verifica se o usuário está logado, caso contrário redireciona para a página de login
    if(!isset($_SESSION['nome']) || !isset($_SESSION['email']) || !isset($_SESSION['id'])) {
        // Se não estiver autenticado, redireciona para a página de login
        header('Location: loginPage.php');
        exit;
    } else {
        $nome = $_SESSION['nome'];
        $email = $_SESSION['email'];
        $idUsuario = $_SESSION['id'];
    }

?>

<!DOCTYPE html>