<?php

session_start();
session_destroy();

//Remove todas as informações nas variaveis globais
unset($_SESSION);

//Redirecionar o usuário para a página de login
header("Location: loginPage.php");

?>