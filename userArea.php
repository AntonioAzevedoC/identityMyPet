<?php

include "inclusao/inclusao.php";
include "globalValues.php";
$validar->pegarDadosUsuario($id);
$rsFoto = $validar->pegarFotoUsuario($id);

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
<html lang="<?php echo $_SESSION['idioma'];?>">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Pet</title>
    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/darkmode/darkModeUser.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/userArea.css" />   
    <!-- SCRIPTS -->
    <script defer src="js/traducao.js"></script>
    <script defer src="js/fontSize.js"></script>
    <script defer src="js/configPanel.js"></script>
    <script defer src="js/modals.js"></script>
    <script defer src="js/validacaoUserArea.js"></script>
    <script defer src="js/image.js"></script>
</head>
<body class="<?= ($_SESSION['darkMode'] == 2 ? "darkmode " : ""); ?><?= ($_SESSION['font'] ? $_SESSION['font'] : ""); ?>">
    <div class="container">
        <!--MENU-->
        <?php
            include 'menu.php';
        ?>
        <div class="content">
            <div class="boxContent">
                <!-- PAINEL CONFIGURAÇÕES -->
                <div class="painel-config">
                    <div class="icone-config">
                        <i class="fa fa-cog" id="iconConf" aria-hidden="true"></i>
                    </div>
                    <div class="opcoes">
                        <form id="formFontSize" action="inclusao/caminhos.php" method="POST">
                            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>" />
                            <input type='hidden' name='atualizaFontSize' />
                            <select id="fontSize" name="fontSize">
                                <option value="" id="fontLabel" selected>Tamanho da fonte</option>
                                <option value="small" id="font75">Pequeno</option>
                                <option value="medium" id="font100">Médio</option>
                                <option value="large" id="font125">Grande</option>
                            </select> 
                        </form>
                        <hr />
                        <form id="formIdioma" action="inclusao/caminhos.php" method="POST">
                            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>" />
                            <input type='hidden' name='atualizaIdioma' />
                            <select id="traducao" name="idioma">
                                <option value="" id="idiomaLabel" selected>Idioma</option>
                                <option value="pt-br" id="idiomaPt">Português Brasil</option>
                                <option value="en-us" id="idiomaEn">English USA</option>
                                <option value="es-mx" id="idiomaEs">Español México</option>
                                <option value="fr-be" id="idiomaFr">Belgique Française</option>
                            </select>
                        </form>
                        <hr />
                        <form id="formDark" action="inclusao/caminhos.php" method="POST">
                            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>" />
                            <input type='hidden' name='atualizaDarkMode' />
                            <select id="modo" name="modo">
                            <!--<i class="fa fa-sun-o" aria-hidden="true"></i>-->
                                <option value="" id="modoLabel" selected>Modo</option>
                                <option value="1" id="modoClaro">Modo Claro</option>
                                <option value="2" id="modoDark">Modo Escuro</option>
                            </select>
                        </form>
                        <hr />
                        <button type="button" class="btnUpdate" id="modalDelete"><i class="fa fa-trash-o" aria-hidden="true"></i>Deletar conta</button>  
                        <hr />
                        <!-- Botão Habilitar Edição -->
                        <button class="btnEditUser" id="btnEditUser"><i class="fa fa-pencil" aria-hidden="true"></i>Habilitar Edição</button>
                        <hr />
                        <button id="btnSair"><a href="sair.php">Sair</a></button> 
                    </div>
                </div>
                <!-- INFORMAÇÕES USUÁRIO -->
                <form class="formSpace" id="formUser" action="inclusao/caminhos.php" method="POST" enctype="multipart/form-data">
                    <fieldset id="fieldset" disabled>
                        <!-- IMAGEM -->
                        <div id="inputFile">
                            <img id="output" src="upload/fotosusers/<?= $rsFoto['imagem']; ?>" alt="" />
                            <div id="btnInputFile" class="hidden">
                                <input type="file" accept="image/*" name="fotoPerfil" class="inputDoc inputFotoUser" id="file" />
                                <label for="file" class="inputFotoUser" name="fotoPerfil" id="inputDocLbl" value="Selecionar imagem ▲"></label>
                            </div>
                        </div>
                        <div id="inforUser">
                            <h1 id="welcomeUsuario">Bem-vindo</h1>
                            <!-- Informações do Usuário -->
                            <h2 id="myInfo">Minhas informações</h2>
                            <p id="nome">Nome</p>
                            <div class="boxInfUser">
                                <input type="text" class="inputUser" name="nomeUsuario" id="nomeUsuario" minlength="5" maxlength="80" value="<?php echo $nome ?>" required />
                            </div>
                            <p id="email">Email</p>
                            <div class="boxInfUser">
                                <span><?php echo $email ?></span>
                            </div>
                            <input type='hidden' name='atualizaUsuario' />
                            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>" />
                            <!-- Botão Atualizar -->
                            <button class="btnEditUser hidden" id="btnSubmit"><i class="fa fa-pencil" aria-hidden="true"></i>Salvar</button>
                        </div>
                    </fieldset>
                </form>
                <!-- MODAL DE DELETAR CONTA -->
                <div class="modal hidden">
                    <button class="closeModal">&times;</button>
                    <form action="inclusao/caminhos.php" method="POST">
                        <h1 id="deleteAccount">Deseja mesmo deletar sua conta?</h1>
                        <input type='hidden' name='deleteUser' />
                        <input type="hidden" name="idUsuario" value="<?=$_SESSION['id']; ?>" />
                        <input type="hidden" name="nome" value="<?=$_SESSION['nome']; ?>" />
                        <input type="hidden" name="email" value="<?=$_SESSION['email']; ?>" />
                        <input class="inputs" id="btnDeletarUser" type="submit" name="deletar" value="Deletar conta" />
                    </form>
                </div>
            </div>
        </div>
        <div class="overlay hidden"></div>
    </div>
</body>
</html>
