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

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Declarando variáveis
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verificação cadastro email
    $email = $validar->validarEmail($email, $erros['emailPr'], $erros['emailInc'], $regexEmail);

    // Verificação cadastro senha
    $senha = sha1(md5($validar->validarSenha($senha, $erros['senhaPr'], $erros['senhaInc'])));

    // Verificação se o email está correto
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (!$result) {
        $validar->addErros($erros['emailInc']);
        $validar->addErros($erros['senhaInc']);
    }

    // Verificação se não existem erros antes da inserção
    if ($GLOBALS['nmrErros'] == 0) {
        // Verifica se o nome de usuário e a senha estão corretos
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $senha);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user) {
            // Destroi a sessão caso uma já exista
            session_destroy();

            // Remove todas as informações nas variáveis globais
            unset($_SESSION);

            // Inicia nova sessão e redireciona para a página inicial
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['idUsuario'];
            $_SESSION['idioma'] = $user['idioma'];
            $_SESSION['darkMode'] = $user['darkMode'];
            $_SESSION['font'] = $user['fonte'];
            header($urlIndex);
            exit;
        } else {
            // Exibe uma mensagem de erro caso o login não seja válido
            echo "Erro ao fazer Login";
        }
    } else {
        // Inicia sessão para erros de tentativa de login
        if (!isset($_SESSION)) {
            session_start();
        }

        // Aumenta o número de erros de login a cada erro
        $_SESSION['tentativaLog'] = isset($_SESSION['tentativaLog']) ? $_SESSION['tentativaLog'] : 0;
        if ($_SESSION['tentativaLog'] >= 0) {
            $_SESSION['tentativaLog']++;
        }

        // Leva para a tela de login com os erros
        header($urlLogPage);
        exit;
    }
}

// Fechar a conexão
$mysqli->close();
?>
