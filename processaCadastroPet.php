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

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Declarando variáveis
    $idUsuario = $_SESSION['id'];
    $nomeResponsavel = $_POST["nomeResponsavel"];
    $telefoneResponsavel = $_POST["telefoneResponsavel"];
    $nomePet = $_POST["nomePet"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $sexo = $validar->validate($_POST['sexo']);
    $tamanho = $validar->validate($_POST['tamanho']);
    $idade = $validar->validate($_POST['idade']);
    $castrado = isset($_POST['castrado']) ? 1 : 0;
    $vermifugo = isset($_POST['vermifugo']) ? 1 : 0;
    $antipulgas = isset($_POST['antipulgas']) ? 1 : 0;
    $vacinaV8v10 = isset($_POST['vacinaV8v10']) ? 1 : 0;
    $vacinaAntirrabica = isset($_POST['vacinaAntirrabica']) ? 1 : 0;
    $vacinaBronchiGuard = isset($_POST['vacinaBronchiGuard']) ? 1 : 0;

    // Verificação cadastro nome responsável
    $nomeResponsavel = $validar->validarNome($nomeResponsavel, $erros['cadastroPr'], $erros['cadastroErr'], $regexNome);

    // Verificação cadastro telefone Responsável
    $telefoneResponsavel = $validar->validarTelefone($telefoneResponsavel, $erros['cadastroPr'], $erros['cadastroErr']);

    // Verificação cadastro nome pet
    $nomePet = $validar->validarNome($nomePet, $erros['cadastroPr'], $erros['cadastroErr'], $regexNome);

    // Verificação cadastro espécie
    $especie = $validar->validarNome($especie, $erros['cadastroPr'], $erros['cadastroErr'], $regexNome);

    // Verificação cadastro raça
    $raca = $validar->validarNome($raca, $erros['cadastroPr'], $erros['cadastroErr'], $regexNome);
    
    // Inserção de dados
    if ($GLOBALS["nmrErros"] == 0) {
        
        
        $sql = "INSERT INTO pets (idUsuario, nomeResponsavel, telefoneResponsavel, nomePet, especie, raca, sexo, tamanho, idade, castrado, vermifugo, antipulgas, vacinaV8v10, vacinaAntirrabica, vacinaBronchiGuard) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sssssssssssssss', $idUsuario, $nomeResponsavel, $telefoneResponsavel, $nomePet, $especie, $raca, $sexo, $tamanho, $idade, $castrado, $vermifugo, $antipulgas, $vacinaV8v10, $vacinaAntirrabica, $vacinaBronchiGuard);
        $stmt->execute();
        
        // Insert Foto 
        if(file_exists($_FILES['fotoPerfil']['tmp_name']) || is_uploaded_file($_FILES['fotoPerfil']['tmp_name'])){
            $arquivo = $_FILES['fotoPerfil'];
            
            if($arquivo['error']) {
                die('Falha ao enviar arquivo');
            }
            
            $diretorio =  "upload/fotospets/";~
            $nome = $arquivo['name'];
            $extensao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
            $novoNome = uniqid() . "." . $extensao;
            
            if($extensao != 'png' && $extensao != 'jpg' && $extensao != 'jpeg'){
                die("Tipo de arquivo não aceito");
            }
            
            $movimento = move_uploaded_file($arquivo['tmp_name'], $diretorio . $novoNome);
            if($movimento) {
                echo "Deu certo";
            } else {
                echo "deu errado";
            }
        } else {
            $novoNome = "petDefault.png";
        }
        
        // Seleciona a tabela pet para pegar o id do usuario
        $sqlId = "SELECT * FROM pets WHERE (idUsuario, nomeResponsavel, telefoneResponsavel, nomePet, especie, raca, sexo, tamanho, idade, castrado, vermifugo, antipulgas, vacinaV8v10, vacinaAntirrabica, vacinaBronchiGuard) = (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sqlId);
        $stmt->bind_param('sssssssssssssss', $idUsuario, $nomeResponsavel, $telefoneResponsavel, $nomePet, $especie, $raca, $sexo, $tamanho, $idade, $castrado, $vermifugo, $antipulgas, $vacinaV8v10, $vacinaAntirrabica, $vacinaBronchiGuard);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $idPet = $result['idPet'];     
        
        // Insert Foto
        if ($result) {
            $query = "INSERT INTO fotospets (idUsuario, idPet, imagem, data) VALUES (?, ?, ?, NOW())";
            $result = $mysqli->prepare($query);
            $result->bind_param('sss', $idUsuario, $idPet, $novoNome);
            if ($result->execute()) {
                echo "Cadastro feito";
            } else {
                echo "Erro ao cadastrar foto no banco de dados.";
            }
        }
        header($urlIndex);
    } else {
        header($urlCadPetPage);
    }
}


// Fechar a conexão
$mysqli->close();
?>
