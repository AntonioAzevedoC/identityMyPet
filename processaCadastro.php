<?php
// Conexão com o banco de dados
$usuario = 'u390593335_bdalpha';
$senha = 'Bolsom1to@';
$database = 'u390593335_bdalpha';
$host = '127.0.0.1';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->connect_error) {
    die("Falha ao se conectar com o banco de dados: " . $mysqli->connect_error);
}

include "inclusao/inclusao.php";
include "globalValues.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Declarando variáveis
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confSenha =  $_POST["confSenha"];

    // Verificação cadastro nome
    $nome = $validar->validarNome($nome, $erros['nomePr'], $erros['nomeInv'], $regexNome);
    
    // Verificação cadastro email
    $email = $validar->validarEmail($email, $erros['emailPr'], $erros['emailInv'], $regexEmail);
    
    // Verificação cadastro senha
    $senha = $validar->validarSenha($senha, $erros['senhaPr'], $erros['senhaInv']);
    
    // Verificação cadastro confirmação de senha
    $confSenha = $validar->validarSenha($confSenha, $erros['confirmInv'], $erros['confirmInv']);
    
    // Verificação se as senhas são iguais
    if ($senha !== $confSenha) {
        $validar->addErros($erros['confirmCorr']);
    }

    // Verificação se o email já está cadastrado
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    if ($result) {
        $validar->addErros($erros['emailCad']);
    }

    // Verificação se não existem erros antes da inserção
    if ($GLOBALS["nmrErros"] === 0){
        $idioma = 'pt-br';
        // Inserção de dados na tabela de usuários
        $sql = "INSERT INTO usuarios (nome, email, senha, idioma) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssss', $nome, $email, sha1(md5($senha)), $idioma);
        $stmt->execute();

        // Seleciona a tabela pet para pegar o id do usuario
        $sqlUser = "SELECT * FROM usuarios WHERE email = ?";
        $stmtUser = $mysqli->prepare($sqlUser);
        $stmtUser->bind_param('s', $email);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result()->fetch_assoc();
        $imagem = "userDefault.png";

        // Insert Foto
        if ($resultUser) {
            $idUsuario = $resultUser['idUsuario'];
            $sqlInsert = "INSERT INTO fotosusuarios (idUsuario, imagem, data) VALUES (?, ?, NOW())";
            $stmtInsert = $mysqli->prepare($sqlInsert);
            $stmtInsert->bind_param('ss', $idUsuario, $imagem);
            if ($stmtInsert->execute()) {
                echo "Cadastro feito";
            } else {
                echo "Erro ao cadastrar foto no banco de dados.";
            }
        }

        header($urlLogPage);
        exit;
    } else {
        echo "Erro ao cadastrar no banco de dados.";
    }
} else {
    header($urlCadPage);
}

// Fechar a conexão
$mysqli->close();
?>
