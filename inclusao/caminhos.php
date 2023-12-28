<?php
include 'inclusao.php';

if(isset($_POST['atualizaPet'])){

    $pet = new pet;
    $pet->atualizarPet($_POST['nomeResponsavel'], $_POST['telefoneResponsavel'], $_POST['nomePet'], $_POST['especie'], $_POST['raca'], $_POST['sexo'], $_POST['tamanho'], $_POST['idade'], isset($_POST['castrado']) ? 1 : 0, isset($_POST['vermifugo']) ? 1 : 0, isset($_POST['antipulgas']) ? 1 : 0, isset($_POST['vacinaV8v10']) ? 1 : 0, isset($_POST['vacinaAntirrabica']) ? 1 : 0, isset($_POST['vacinaBronchiGuard']) ? 1 : 0, $_POST['idPet']);
    
    $pet = new pet;
    if(file_exists($_FILES['fotoPerfil']['tmp_name']) || is_uploaded_file($_FILES['fotoPerfil']['tmp_name'])){
        $arquivo = $_FILES['fotoPerfil'];
        
        if($arquivo['error']) {
            die('Falha ao enviar arquivo');
        }
        
        $diretorio =  "../upload/fotospets/";~
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
        
        $pet->atualizarFotoPet($novoNome, $_POST['idPet']);
    }
    
    header("Location: ../index.php");
    
} else if (isset($_POST['deletePet'])){

    $pet = new pet;
    $pet->deletarPet($_POST['idPet']);
    header("Location: ../index.php");

} else if (isset($_POST['deleteUser'])){

    $validar = new validar;
    $validar->deletarUsuario($_POST['idUsuario']);
    header("Location: ../sair.php");

} else if (isset($_POST['atualizaUsuario'])){

    $validar = new validar;
    $validar->atualizarUsuario($_POST['nomeUsuario'], $_POST['idUsuario']);
    
    $validar = new validar;
    if(file_exists($_FILES['fotoPerfil']['tmp_name']) || is_uploaded_file($_FILES['fotoPerfil']['tmp_name'])){
        $arquivo = $_FILES['fotoPerfil'];
        
        if($arquivo['error']) {
            //die('Falha ao enviar arquivo');
        }
        
        $diretorio =  "../upload/fotosusers/";
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
        
        $validar->atualizarFotoUsuario($novoNome, $_POST['idUsuario']);
    }
    
    header("Location: ../userArea.php");

} else if (isset($_POST['atualizaFontSize'])){

    $validar = new validar;
    $validar->atualizarFontSize($_POST['idUsuario'], $_POST['fontSize']);
    header("Location: ../userArea.php");

} else if (isset($_POST['atualizaIdioma'])){

    $validar = new validar;
    $validar->atualizarIdioma($_POST['idUsuario'], $_POST['idioma']);
    header("Location: ../userArea.php");

} else if (isset($_POST['atualizaDarkMode'])){

    $validar = new validar;
    $validar->atualizarDarkMode($_POST['idUsuario'], $_POST['modo']);
    header("Location: ../userArea.php");

} else {
    echo "Algo deu errado";
}

?>