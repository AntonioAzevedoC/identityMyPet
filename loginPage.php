<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <?php 
            include "inclusao/inclusao.php";
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['tentativaLog'] = isset($_SESSION['tentativaLog']) ? $_SESSION['tentativaLog'] : 1;
            $erroEmail = isset($_GET['erroEmail']) ? $_GET['erroEmail'] : '';
            $erroSenha = isset($_GET['erroSenha']) ? $_GET['erroSenha'] : '';
        ?>
        <!-- ESTILOS -->
        <link rel="stylesheet" href="css/loginCadastroPageStyle.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <!-- SCRIPTS -->
        <script defer src="js/validacaoLogin.js"></script>
    </head>
    <body>
        <div class="container">
            <!--PARTE DA ESQUERDA, ONDE ESTÃO OS CAMPOS-->
            <div class="formSpace">
                <div class="formSpaceContent">
                    <p id="welcome">Bem-vindo ao</p>
                    <img src="img/logoMyPet.png" alt="" />
                    <!--FORMULARIO-->
                    <fieldset id="fieldset">
                        <form class="<?= ($_SESSION['tentativaLog'] % 4 === 0 ? "ErroLogin" : ""); ?>" id="form" method="POST" action="processaLogin.php"> 
                            <!--input EMAIL-->
                            <div class="inputBox">    
                                <label for="email" class="labelInput" id="labelEmail">email</label>                  
                                <input type="email" name="email" class="inputLogin" id="emailLogin" onchange="" required />
                            </div>
                            <!--span ERRO DE EMAIL -->
                            <span class="span" id="erroEmail" style="color: red;">
                                <?php
                                    echo $validar->exibirMensagemErro($erroEmail);
                                ?>
                            </span>
                            <!--input SENHA-->
                            <div class="inputBox"> 
                                <label for="senha" class="labelInput" id="labelSenha">senha</label>
                                <input type="password" name="senha" class="inputLogin" id="senhaLogin" onchange="" maxlength="30" required />    
                            </div>
                            <!--span ERROS DE INSERÇÃO DE SENHA-->
                            <span class="span" id="erroSenha" style="color: red;">
                                <?php
                                    echo $validar->exibirMensagemErro($erroSenha);
                                ?>
                            </span>
                            <input type="submit" class="btn" id="btnSubmit" name="entrar" value="Entrar" />
                        </form>
                    </fieldset>
                    <!--FIM FORMULARIO-->
                    <p id="cadastar">Não tem conta? <a href="cadastroPage.php">Cadastre-se agora</a></p>
                </div>
            </div>
            <!--PARTE DA DIREITA, ONDE ESTÁ A IMAGEM-->
            <div class="imageSpace">
                <div class="imageSpaceBg">
                    <div class="imageSpaceContent">
                        <img src="img/logo.png" alt="" />
                        <p id="descricao">A ferramenta perfeita para proporcionar segurança e tranquilidade tanto para você quanto para seu amado pet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>