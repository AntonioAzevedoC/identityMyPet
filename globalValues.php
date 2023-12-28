<?php

// Definindo variáveis de caminhos
$urlLogPage = "Location: loginPage.php";
$urlCadPage = "Location: cadastroPage.php";
$urlCadPetPage = "Location: cadastroPetPage.php";
$urlIndex = "Location: index.php";

$id = $_SESSION['id'];

// Definindo variáveis de inputs e de erros
$nmrErros = 0;
$erros = [
	"nomePr" => "erroNome=Nome precisa ser preenchido",
	"nomeInv" => "erroNome=Nome Inválido",
	"emailPr" => "erroEmail=Email precisa ser preenchido",
	"emailInv" => "erroEmail=Email Inválido",
    "emailInc" => "erroEmail=Email incorreto",
	"emailCad" => "erroEmail=Este email já está cadastrado",
	"senhaPr" => "erroSenha=Senha precisa ser preenchida",
    "senhaInc" => "erroSenha=Senha incorreta",
	"senhaInv" => "erroSenha=Senha inválida",
	"confirmInv" => "erroConfirm=Senha inválida",
	"confirmCorr" => "erroConfirm=As senhas não correspondem",
    "cadastroPr" => "erroCadastro=Todos os dados precisam estar preenchidos",
	"cadastroErr" => "erroCadastro=Dados invalidos, tente novamente",
];
$regexNome = "/[^A-Za-z\sÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüý]/";
$regexEmail = "/^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/";

$Pets = [
    "campos" => "(idUsuario, nomeResponsavel, telefoneResponsavel, nomePet, especie, raca, sexo, tamanho, idade, castrado, vermifugo, antipulgas, vacinaV8v10, vacinaAntirrabica, vacinaBronchiGuard)",
    "selecoes" => "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
];

?>